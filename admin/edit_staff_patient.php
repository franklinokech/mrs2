<?php


require_once '../config.php';
require_once '../database_connection.php';
include 'header.php';

 if(isset($_GET['reg_no'])){
    $reg_no = $_GET['reg_no'];
  }else{
    echo "No id found"; 
  }

  $query = "SELECT * FROM staff_patient WHERE reg_no='{$reg_no}' ";
  $results = mysqli_fetch_assoc(mysqli_query($connection, $query));

?>

<div class="container">
<div class="row">
  <ul class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li><a href="staff_patient.php">Staff Patient</a></li>
      <li class="active">Edit</li>
    </ul>
</div>

  <div class="row">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title"> Edit Patient</h3>
      </div>
      <div class="panel-body">

        <form action="process_form.php" class="form-horizontal" method="post" enctype="multipart/form-data"   autocomplete="off" name="f" onSubmit="return validateForm();" >
          
          <fieldset>      
                      <div class="form-group">
                          <label class="col-lg-4 control-label" for="profile_image"> </label>
                          <div class="col-lg-5">
                            <?php if ($results["profile_image"] == null ){ ?>
                               <img  src="../profile_image/no_avatar.png" class="thumbnail" alt="profile pick" width="100px" height="100px" >
                            <?php }else{ ?>
                               <a href="../profile_image/<?php echo $results['profile_image']?>" target="_blank"><img  src="../profile_image/<?php echo $results['profile_image']?>" alt="" width="100" height="100" class="thumbnail" ></a>
                           <?php }?>
                          </div>
                        </div>                          

                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="last_name"><span class="required">*</span>PF No:</label>
                            <div class="col-lg-5">
                              <input type="text" readonly value="<?php echo $results["reg_no"] ;?>" id="reg_no" class="form-control" name="reg_no">
                            </div>
                            </div>

                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="email_id"><span class="required">*</span>Intitution Email:</label>
                            <div class="col-lg-5">
                              <input type="text" value="<?php echo $results["its_email"] ;?>" id="its_email" class="form-control" name="its_email">
                            <span class="help-block">eg, maseno@maseno.ac.ke .</span>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="email_id"><span class="required">*</span> Email Address:</label>
                            <div class="col-lg-5">
                              <input type="text" value="<?php echo $results["email"] ;?>" id="email" class="form-control" name="email">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="d_o_b"><span class="required">*</span> Date OF Birth:</label>
                            <div class="col-lg-5">
                              <div class="input-group">
                              <input type="text" id="datetimepicker2" value="<?php echo $results["d_o_b"] ;?>" id="d_o_b" class="form-control" name="d_o_b" /><span id="datepicker" class="input-group-addon glyphicon glyphicon-calendar"></span> 
                              <!-- <span id="datepicker" class="input-group-addon glyphicon glyphicon-calendar"></span> -->
                              </div>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-lg-3 control-label"><span class="required">*</span>Contact</label>
                            <div class="col-lg-5">
                              <input type="text"value="<?php echo $results["contact"] ;?>" id="contact" class="form-control" name="contact">
                              <span class="help-block">Maximum of 10 digits only and only numbers.</span>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="course">Address</label>
                            <div class="col-lg-5">
                              <input type="text" value="<?php echo $results["address"] ;?>" id="address" class="form-control" name="address">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="profile_pic">New Profile picture:</label>
                            <div class="col-lg-5">
                              <input type="file" value="<?php echo $results["profile_image"] ;?>" id="profile_image" class="form-control file" name="profile_image">
                              <span class="help-block">Must be jpg, jpeg, png, gif, bmp image only.</span>
                            </div>
                          </div>

                          
                          <div class="form-group">
                            <label class="col-lg-3 control-label"><span class="required">*</span> Position :</label>
                            <div class="col-lg-5">
                              <input type="text" value="<?php echo $results["position"] ;?>" id="position" class="form-control" name="position">
                            </div>
                            </div>
                
                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="course">Status </label>
                            <div class="col-lg-5">
                              <div id="radioset">
                                <input type="radio" id="radio1" value="single" name="status"><label for="radio1">Single</label>
                                <input type="radio" id="radio2" value="married" name="status"><label for="radio2">married</label>
                          </div>
                          </div>
                          </div>
                

            
                            <div class="form-group">
                              <label class="col-lg-3 control-label" for="address">Health Information</label>
                              <div class="col-lg-5">
                                <textarea id="address" value="<?php echo $results["health_info"] ;?>" name="health_info" id="heal" style="resize:none" rows="3" class="form-control"></textarea>
                              </div>
                            </div> 
            
            <div class="form-group">
              <div class="col-lg-3 col-lg-offset-4">
                <input type="submit" name="update_details" class="btn btn-primary" value="Submit Update"</> 
              </div>
            </div>

          </fieldset>
        </form>
        </div>
      </div>
    </div>
  </div>
  <script>
          function isValidEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
          }

          function ValidEmail(its_email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(maseno\.)+(ac.ke)/;
            return regex.test(its_email);
          }

         function validateForm() {

                // var reg_no = document.forms['f']['reg_no'].value;
                var contact = document.forms['f']['contact'].value;
                var email = document.forms['f']['email'].value;
                var its_email = document.forms['f']['its_email'].value;
                var dob = document.forms['f']['d_o_b'].value;
                var position = document.forms['f']['position'].value;
                var status = document.forms['f']['status'].value;

               
                if (its_email == "") {
                    $("#its_email").focus();
                    alert("Institution email cannot be blank.");
                    return false;
                } else if (!ValidEmail(its_email)) {
                    $("#its_email").focus();
                    alert("Please enter a valid Institution email Address eg aa@maseno.ac.ke.");
                    return false;
                }
                 if (email == "") {
                    $("#email").focus();
                    alert("Email cannot be blank.");
                    return false;
                } else if (!isValidEmail(email)) {
                    $("#email").focus();
                    alert("Please enter a valid email Address.");
                    return false;
                }

                if (dob == "") {
                    $("#d_o_b").focus();
                    alert("Please enter a date of Birth.");
                    return false;
                }
                      
                if (contact == "") {
                    $("#contact").focus();
                    alert("Enter Contact no.");
                    return false;
                } else if (contact.length < 9) {
                    $("#contact").focus();
                    alert("contact must be 10 character.");
                    return false;
                } else if (contact.length > 10) {
                    $("#contact").focus();
                    alert("contact must be 10 character.");
                    return false;
                } else if (!$.isNumeric(contact) ) {
                    $("#contact").focus();
                    alert("Must be digits only.");
                    return false;
                }
                if (position == "") {
                    alert("Please enter Your position in ypour fuculty.");
                    $("#position").focus();
                    return false;
                } else if (position.length < 3) {
                    alert("Must be atlest 4 characters.");
                    $("#position").focus();
                    return false;
                }
                if (status == "") {
                    $("#status").focus();
                    alert("verify your status.");
                    return false;
                }
 

                return true;
            }


        </script>
<?php
include 'footer.php';
?>
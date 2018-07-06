<?php

require_once '../config.php';
require_once '../functions.php';
include 'header.php';
if($_SESSION['level']==0 || $_SESSION['level']== 5 ){

if (isset($_POST['okey'])){
  pre($_POST);
}

?>

<div class="container">
      <div class="row">
        <ul class="breadcrumb">
            <li><a href="reception.php">Home</a></li>
            <li class="active"> New Patient </li>
          </ul>
      </div>

<div class="col-md-8">
  <div class="row">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title"> New Staff </h3>
      </div>
      <div class="panel-body">

        <form class="form-horizontal" autocomplete="off" name="f" onSubmit="return validateForm();" enctype="multipart/form-data" method="post" action="process_form.php">
          
          <fieldset>

                         <div class="form-group">
                            <label class="col-lg-3 control-label" for="first_name"><span class="required">*</span>First Name:</label>
                            <div class="col-lg-5">
                              <input type="text" placeholder="First Name" id="first_name" class="form-control" name="first_name">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="middle_name">Last Name:</label>
                            <div class="col-lg-5">
                              <input type="text" placeholder="Last Name" id="last_name" class="form-control" name="last_name">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="last_name"><span class="required">*</span>PF No:</label>
                            <div class="col-lg-5">
                              <input type="text" placeholder=" CI/00097/014 " id="reg_no" class="form-control" name="reg_no">
                            </div>
                            </div>

                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="email_id"><span class="required">*</span>Institution Email:</label>
                            <div class="col-lg-5">
                              <input type="text" id="its_email" placeholder=" Valid Institution Address " class="form-control" name="its_email">
                            <span class="help-block">eg, maseno@maseno.ac.ke .</span>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="email_id"><span class="required">*</span> Email Address:</label>
                            <div class="col-lg-5">
                              <input type="text" placeholder="Must be Valid Email Address" id="email" class="form-control" name="email">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="d_o_b"><span class="required">*</span> Date OF Birth:</label>
                            <div class="col-lg-5">
                              <div class="input-group">
                              <input type="text" id="datetimepicker2" placeholder="Must be Valid year below <?php echo date("Y");?>" id="d_o_b" class="form-control" name="d_o_b" /><span id="datepicker" class="input-group-addon glyphicon glyphicon-calendar"></span> 
                              <!-- <span id="datepicker" class="input-group-addon glyphicon glyphicon-calendar"></span> -->
                              </div>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="contact_no1"><span class="required">*</span>Contact</label>
                            <div class="col-lg-5">
                              <input type="text"  placeholder="Contact Number" id="contact" class="form-control" name="contact"><span id="contact_err" class="error"></span>
                              <span class="help-block">Maximum of 10 digits only and only numbers.</span>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="course">Address</label>
                            <div class="col-lg-5">
                              <input type="text"  placeholder="Contact Number" id="address" class="form-control" name="address">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="profile_pic">Profile picture:</label>
                            <div class="col-lg-5">
                              <input type="file"  id="profile_image" class="form-control file" name="profile_image">
                              <span class="help-block">Must be jpg, jpeg, png, gif, bmp image only.</span>
                            </div>
                          </div>

                          <div class="form-group">
                                <label class="col-lg-3 control-label" for="course"> Fuculty </label>
                                <div class="col-lg-5">
                                  <select class="form-control" id="fuculty" name="fuculty" placeholder="school">
                                        <option value='Mathematics'> Mathematics </option>
                                        <option value='Computing'> Computing </option>
                                        <option value='Medicine'> Medicine </option>
                                        <option value='Education'> Education </option>
                                        <option value='Arts and Social Sciences'> Arts and Social Sciences </option>
                                  </select><span id="fuculty_err" class="error"></span>
                                </div>
                              </div>
                          
                          <div class="form-group">
                            <label class="col-lg-3 control-label"><span class="required">*</span> Position :</label>
                            <div class="col-lg-5">
                              <input type="text" placeholder=" Please enter your position eg Lecturer " id="position" class="form-control" name="position">
                            </div>
                            </div>

                          <div class="form-group">
                            <label class="col-lg-3 control-label"><span class="required">*</span> Date Employed:</label>
                            <div class="col-lg-5">
                              <div class="input-group">
                              <input type="text" id="datetimepicker1" id="emp_date" placeholder="Must be Valid year below <?php echo date("Y");?>" class="form-control" name="emp_date" /><span id="datepicker" class="input-group-addon glyphicon glyphicon-calendar"></span>  
                              </div>
                            </div>
                          </div>
                
                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="course">Status </label>
                            <div class="col-lg-5">
                              <div id="radioset">
                                <input type="radio" id="radio1" value="single" name="status"><label for="radio1">Single</label>
                                <input type="radio" id="radio2" value="married" name="status" checked="checked"><label for="radio2">married</label>
                          </div>
                          </div>
                          </div>
                

            
                            <div class="form-group">
                              <label class="col-lg-3 control-label" for="address">Health Information</label>
                              <div class="col-lg-5">
                                <textarea id="address" name="health_info" id="heal" style="resize:none" rows="3" class="form-control"></textarea>
                              </div>
                            </div> 
            
            <div class="form-group">
              <div class="col-lg-3 col-lg-offset-4">
                <input type="submit" name="okey" class="btn btn-primary" value="Add patient"</> 
              </div>
            </div>
          </fieldset>
        </form>

      </div>
    </div>
  </div>
</div>
<div class="col-md-4">
  <div class="panel panel-success">
    <div class="panel-heading">
     <h3 class="panel-title">Navigation</h3>
      </div>
          <div class="panel-body">
            <ul class="nav nav-list ">
                <ul class="nav nav-pills nav-stacked">
<?php
$loo = $_SESSION['email'];
$re = 0;
$ree = 1;
try {
  $sql = " SELECT * FROM message WHERE too ='{$loo}' AND `read` ='{$ree}' ";
  $stmt = $DB->prepare($sql);
  $stmt->execute();
  $total_count = count($stmt->fetchAll());
} catch (Exception $ex) {
  echo $ex->getMessage();
} 

try {
  $sql = " SELECT * FROM message WHERE too ='{$loo}' AND `read` ='{$re}' ";
  $stmt = $DB->prepare($sql);
  $stmt->execute();
  $tot_count = count($stmt->fetchAll());
} catch (Exception $ex) {
  echo $ex->getMessage();
} 
?>
                        <li><a href="reception.php"> Home  <span class="glyphicon glyphicon-home pull-right"></a></li>
                        <li><a href="add_patient.php"> Add patient <span class="glyphicon glyphicon-plus pull-right"></span></a></li>
                        <li class="active"><a href="add_patient2.php"> Add patient Staff <span class="glyphicon glyphicon-plus pull-right"></span></a></li>
                        <li><a href="daily_record.php"> Today's Record <span class="glyphicon glyphicon-sort pull-right"></span></a></li>
                        <li><a href="birth_day.php"> Birthday's <span class="glyphicon glyphicon-bell pull-right"></a></li>
                        <li><a href="../messages/send_message.php?mode=read"> Messages <?php if($tot_count > 0){ ?>
                          <span class="required badge pull-right"><?php echo ($tot_count.'/'.$total_count);?></span>
                          <?php }elseif($tot_count==0){ ?>
                          <span class="badge pull-right"><?php echo ($tot_count.'/'.$total_count);?></span>
                          <?php }; ?>
                        </a></li>
                        <li><a href="../messages/mail.php"> Send Email <span class="glyphicon glyphicon-envelope pull-right"></a></li>
                        
                    </ul>
            </ul>
          </div>
  </div>

      </div>  
</div>	
  <script>
          function isValidEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
          }

          function ValidEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@maseno.ac.ke/;
            return regex.test(email);
          }

         function validateForm() {

                var first = document.forms['f']['first_name'].value;
                var last = document.forms['f']['last_name'].value;
                var reg_no = document.forms['f']['reg_no'].value;
                var contact = document.forms['f']['contact'].value;
                var email = document.forms['f']['email'].value;
                var its_email = document.forms['f']['its_email'].value;
                var dob = document.forms['f']['d_o_b'].value;
                var position = document.forms['f']['position'].value;
                var status = document.forms['f']['status'].value;
                var emp_date = document.forms['f']['emp_date'].value;
                // var subject = $.trim($("#subject").val());
                // var msg = $.trim($("#msg").val());

                if (first == "") {
                    alert("First Name cannot be blank.");
                    $("#first_name").focus();
                    return false;
                } else if (first.length < 3) {
                    $("#first_name").focus();
                    alert("First name cannot be less than 3 characters.");
                    return false;
                }

                if (last == "") {
                    alert("Last name cannot be blank.");
                    $("#last_name").focus();
                    return false;
                } else if (last.length < 3) {
                    alert("Last name cannot be less than 3 characters.");
                    $("#last_name").focus();
                    return false;
                }

                if (reg_no == "") {
                    alert("Please enter the PF number.");
                    $("#reg_no").focus();
                    return false;
                } else if (reg_no.length < 11) {
                    alert("The PF No# Must be 12 characters.");
                    $("#reg_no").focus();
                    return false;
                }
               
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
                    alert("TMust be atlest 4 characters.");
                    $("#position").focus();
                    return false;
                }if (emp_date == "") {
                    $("#emp_date").focus();
                    alert("Please enter a date of your employment.");
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
</div>
  <?php } else{?>
<div class="col-lg-12 center alert danger"> Access to the page is denied. Only allowed to Receptionists</div>

    <?php
  }
      include 'footer.php';
      ?>
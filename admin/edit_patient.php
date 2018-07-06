<?php


require_once '../config.php';
require_once '../database_connection.php';
include 'header.php';

 if(isset($_GET['reg_no'])){
    $reg_no = $_GET['reg_no'];
  }else{
    echo "No id found"; 
  }

  $query = "SELECT * FROM student_patient WHERE reg_no='{$reg_no}' ";
  $results = mysqli_fetch_assoc(mysqli_query($connection, $query));

?>
<?php

?>

<div class="container">
<div class="row">
  <ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li><a href="student.php">Student Patients</a></li>
    <li class="active">Edit Patient Details</li>
    </ul>
</div>

  <div class="row">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title"> Edit <?php echo ucwords($results["first_name"].' '.$results["last_name"]); ?> Details</h3>
      </div>
      <div class="panel-body">

        <form class="form-horizontal" name="f" id="f" enctype="multipart/form-data" method="post" action="process_form.php" onSubmit="return validateForm();">
          
          <input type="hidden" name="reg_no" value="<?php echo $results["reg_no"]; ?>" >
          
          <fieldset>
            
            <div class="form-group">
                <label class="col-lg-4 control-label"><span class="required">*</span> Date of birth:</label>
                  <div class="col-lg-5">
                      <div class="input-group"><span id="datepicker" class="input-group-addon glyphicon glyphicon-calendar"></span>
                      <input type="text" id="datetimepicker2" id="d_o_b" class="form-control" name="d_o_b" value="<?php echo $results['d_o_b'] ?>"/>
                      </div>
                  </div>
            </div>      
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="email_id"><span class="required">*</span>Email Address:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results["email"] ?>" placeholder="Email ID" id="email_id" class="form-control" name="email_id">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="reg_no"> Course :</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results["course"] ?>" placeholder="Regidtration" id="course" class="form-control" name="course">
                
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="contact_no">Contact No#:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results["contact"] ?>" placeholder="Contact Number" id="contact_no" class="form-control" name="contact_no">
                <span class="help-block">Maximum of 10 digits only and only numbers.</span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="profile_pic">Profile picture:</label>
              <div class="col-lg-5">
                <input type="file" id="profile_image" class="form-control file" name="profile_image">
                <span class="help-block">Must me jpg, jpeg, png, gif, bmp image only.</span>
              </div>
            </div>
              <input type="hidden" name="old_pic" value="<?php echo $results["profile_image"]; ?>" >
            
            
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="address">Address:</label>
              <div class="col-lg-5">
                <input id="address" name="address" rows="3" class="form-control " value="<?php echo $results["address"] ?>">
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-lg-5 col-lg-offset-4">
                <input type="submit" name="edit" class="form-control btn-info" value="Submit">  
              </div>
            </div>
          </fieldset>
        </form>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
 function validateForm() {

                var contact = document.forms['f']['contact_no'].value;
                var email = document.forms['f']['email_id'].value;
                var cos = document.forms['f']['course'].value;
                var dob = document.forms['f']['d_o_b'].value;

                if (dob == "") {
                    $("#d_o_b").focus();
                    alert("Please enter a date of Birth.");
                    return false;
                }

                 if (email == "") {
                    $("#email_id").focus();
                    alert("Email cannot be blank.");
                    return false;
                } else if (!isValidEmail(email)) {
                    $("#email_id").focus();
                    alert("Please enter a valid email Address.");
                    return false;
                }
                 if (cos == "") {
                    $("#course").focus();
                    alert("Cannot be blank.");
                    return false;
                } else if (cos.length< 3 ) {
                    $("#course").focus();
                    alert("Must be more than 3 characters");
                    return false;
                }             
                if (contact == "") {
                    $("#contact_not").focus();
                    alert("Enter Contact no.");
                    return false;
                } else if (contact.length < 9) {
                    $("#contact_no").focus();
                    alert("contact must be 10 character.");
                    return false;
                } else if (contact.length > 10) {
                    $("#contact_no").focus();
                    alert("contact must be 10 character.");
                    return false;
                } else if (!$.isNumeric(contact) ) {
                    $("#contact_no").focus();
                    alert("Must be digits only.");
                    return false;
                }

                return true;
            }
	


function isValidEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
</script>
<?php
include 'footer.php';
?>
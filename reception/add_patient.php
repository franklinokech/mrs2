<?php

require_once '../config.php';
require_once '../functions.php';
include 'header.php';
if($_SESSION['level']==0 || $_SESSION['level']==5 ){
?>

<div class="container">
      <div class="row">
        <ul class="breadcrumb">
            <li><a href="reception.php">Home</a></li>
            <li class="active"><?php echo ($_GET["m"] == "update") ? "Edit" : "Add"; ?> Contacts</li>
          </ul>
      </div>

  <div class="row">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo ($_GET["m"] == "update") ? "Edit" : "Add"; ?> New Contact</h3>
      </div>
      <div class="panel-body">

        <form class="form-horizontal" autocomplete="off" name="f" onSubmit="return validateForm();" enctype="multipart/form-data" method="post" action="process_form.php">
          
          <fieldset>
            <div class="form-group">
              <label class="col-lg-4 control-label" ><span class="required">*</span>First Name:</label>
              <div class="col-lg-5">
                <input type="text" placeholder="First Name" id="first_name" class="form-control" name="first_name">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="middle_name">Last Name:</label>
              <div class="col-lg-5">
                <input type="text" placeholder="Last Name" id="last_name" class="form-control" name="last_name">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="last_name"><span class="required">*</span>Registration Number:</label>
              <div class="col-lg-5">
                <input type="text" placeholder=" CI/00097/014 " id="reg_no" class="form-control" name="reg_no">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="email_id"><span class="required">*</span> Email Address:</label>
              <div class="col-lg-5">
                <input type="text" id="autocomplete" placeholder="Must be Valid Email Address" id="email" class="form-control" name="email">
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-4 control-label" for="d_o_b"><span class="required">*</span> Year OF Birth:</label>
              <div class="col-lg-5">
                <div class="input-group">
                <input type="text" id="datetimepicker2" placeholder="Must be Valid year below <?php echo date("Y");?>" id="d_o_b" class="form-control" name="d_o_b" /><span id="datepicker" class="input-group-addon glyphicon glyphicon-calendar"></span> 
                <!-- <span id="datepicker" class="input-group-addon glyphicon glyphicon-calendar"></span> -->
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-4 control-label" for="course"> Sex </label>
              <div class="col-lg-5">
                <div id="radioset">
                  <input type="radio" class="form-control" id="radio1" name="sex"><label for="radio1">Male</label>
                  <input type="radio" class="form-control" id="radio2" name="sex" checked="checked"><label for="radio2">Female</label>
              </div>
                <!-- <span class="help-block">Maximum of 10 digits only and only numbers.</span> -->
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="contact_no1"><span class="required">*</span>Contact</label>
              <div class="col-lg-5">
                <input type="text"  placeholder="Contact Number" id="contact" class="form-control" name="contact"><span id="contact_err" class="error"></span>
                <span class="help-block">Maximum of 10 digits only and only numbers.</span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="course">Address</label>
              <div class="col-lg-5">
                <input type="text"  placeholder="Contact Number" id="address" class="form-control" name="address">
                <!-- <span class="help-block">Maximum of 10 digits only and only numbers.</span> -->
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="profile_pic">Profile picture:</label>
              <div class="col-lg-5">
                <input type="file"  id="profile_image" class="form-control file" name="profile_image"><span id="profile_image_err" class="error"></span>
                <span class="help-block">Must be jpg, jpeg, png, gif, bmp image only.</span>
              </div>
            </div>

            
            <hr>

            <div class="form-group">
              <label class="col-lg-4 control-label" for="course"><span class="required">*</span> Course </label>
              <div class="col-lg-5">
                <input type="text" placeholder="eg BSc IT" id="course" class="form-control" name="course"><span id="course_err" class="error"></span>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-4 control-label" for="course">Fuculty</label>
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
              <label class="col-lg-4 control-label" for="address">Health Information</label>
              <div class="col-lg-5">
                <textarea id="address" name="health_info" id="heal" style="resize:none" rows="3" class="form-control"></textarea><span id="heal_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-lg-5 col-lg-offset-4">
                <input type="submit" onMouse="confirm('Are you sure')" name="submit" class="btn btn-primary" type="submit" value="Add patient"</> 
              </div>
            </div>
          </fieldset>
        </form>

      </div>
    </div>
  </div>

        <script>
          function isValidEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
          }

         function validateForm() {

                var first = document.forms['f']['first_name'].value;
                var last = document.forms['f']['last_name'].value;
                var reg_no = document.forms['f']['reg_no'].value;
                var contact = document.forms['f']['contact'].value;
                var email = document.forms['f']['email'].value;
                var dob = document.forms['f']['d_o_b'].value;
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
                    alert("Please enter the registration number.");
                    $("#reg_no").focus();
                    return false;
                } else if (reg_no.length < 11) {
                    alert("The Registration No# Must be 12 characters.");
                    $("#reg_no").focus();
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
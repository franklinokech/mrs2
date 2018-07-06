<?php

require_once '../functions.php';
require_once '../config.php';
include 'header.php';
?>

<?php
  if(isset($_GET['page'])){
    $current_page = $_GET['page'] - 1;
  }else{
    $current_page = 0;
  }
?>

<div class="container">
<!-- <div class="row"> -->
  <ul class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li><a href="staf.php">Hospital Staff</a></li>
      <li class="active">Add Staff</li>
    </ul>
<!-- </div> -->

  <div class="row">
    <div class="col-md-8">

		<?php echo messages(); ?>

    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title"> Register new staff </h3>
      </div>
      <div class="panel-body" style="height:auto">
       
         
	      <div class="clearfix"></div>
				
				<form action="process_form.php" method="post"  enctype="multipart/form-data" autocomplete="off" name="f" onSubmit="return validateForm();">
			          <table width="600" align="centre"><tr><td>
			            <div class="panel-body"></div>
			            <div class="input-group input-group-sm" >
			                  <span class="input-group-addon glyphicon glyphicon-user"></span>
			                  <input type="text" class="form-control" id="sname" name="sname" placeholder="Firstname" >
			            </div>
			            <br />    
			            
			            <div class="input-group input-group-sm">
			                  <span class="input-group-addon glyphicon glyphicon-user"></span>
			                  <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" >
			            </div>
			            <br />
			            
			            <div class="input-group input-group-sm">
			                  <span class="input-group-addon">@</span>
			                  <input type="text" class="form-control" id="username" name="username"  placeholder="Username">
			            </div>
			            <br />

                  <div class="input-group input-group-sm">
                    <span class="input-group-addon glyphicon glyphicon-user"></span>
                        <input type="file"  id="profile_image" class="form-control file" name="profile_image">
                    </div>
                    <span class="help-block pull-centre"> Must be jpg, jpeg, png, gif, bmp image only.</span>
                  <br />

			            <div class="input-group input-group-sm">
			                  <span class="input-group-addon">Position</span>
			                  <select id="level" name="level" class="form-control" >
			                  		<option value="">Select category</option>
			                        <option value="2">DR</option>
			                        <option value="0">Receptionist</option>
			                        <option value="4">Lab tech</option>
			                        <option value="1">Nurse</option>
			                        <option value="3">Pharmacist</option>
			                        <option value="5">Administrator</option>
			                  </select>
			            </div>
			            <br />

			            <div class="input-group input-group-sm">
			                  <input name="submit" type="submit" class="pull-centre" id="submit" value="+ Add staff">
			            </div>
			            <br /> 
			            </div>
			          </td></tr></table>        
			          
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

                var first = document.forms['f']['sname'].value;
                var last = document.forms['f']['lname'].value;
                var username = document.forms['f']['username'].value;
                var level = document.forms['f']['level'].value;


                if (first == "") {
                    alert("First Name cannot be blank.");
                    $("#sname").focus();
                    return false;
                } else if (first.length < 3) {
                    $("#sname").focus();
                    alert("First name cannot be less than 3 characters.");
                    return false;
                }

                if (last == "") {
                    alert("Last name cannot be blank.");
                    $("#lname").focus();
                    return false;
                } else if (last.length < 3) {
                    alert("Last name cannot be less than 3 characters.");
                    $("#lname").focus();
                    return false;
                }

                if (username == "") {
                    alert("Please enter the Username.");
                    $("#username").focus();
                    return false;
                } else if (username.length < 5) {
                    alert("The Username Must be atleast 6 characters.");
                    $("#username").focus();
                    return false;
                } else if ($.isNumeric(username)) {
                    alert("Cannot be digits.");
                    $("#username").focus();
                    return false;
                }

              
                if (level == "") {
                    $("#level").focus();
                    alert("Please select one.");
                    return false;
                }
                      
               

                return true;
            }


        </script>    

    <div class="col-md-4">
				    <div class="panel panel-primary">
				    	<?php echo messages(); ?>
						  <div class="panel-heading">
							<h3 class="panel-title"> Navigation </h3>
						  </div>
						  <div class="panel-body" style="height:auto">
                    <?php
                      include 'nav.php';
                    ?>
						  </div>
					</div>
    </div>
  </div>
  </div>

      <?php
      include 'footer.php';
      ?>
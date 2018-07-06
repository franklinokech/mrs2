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


  if(isset($_GET['username'])){
    $username = $_GET['username'];
  }else{
    $username = $_SESSION['username']; 
  }
?>

<div class="container">

  <ul class="breadcrumb">
    <?php if ($_SESSION['level']==5){ ?>
      <li><a href="index.php">Home</a></li>
      <li><a href="staf.php">Hospital Staff</a></li>
      <li class="active">Staff Details</li>
      <?php }elseif ($_SESSION['level']==2) { ?>
        <li><a href="../doctor/index.php">Home</a></li>
        <li class="active">Staff Details</li>
      <?php }elseif ($_SESSION['level']==3) { ?>
        <li><a href="../pharmacy/index.php">Home</a></li>
        <li class="active">Staff Details</li>
      <?php }elseif ($_SESSION['level']==0) { ?>
        <li><a href="../reception/reception.php">Home</a></li>
        <li class="active">Staff Details</li>
      <?php }elseif ($_SESSION['level']==1) { ?>
        <li><a href="../nurse/index.php">Home</a></li>
        <li class="active">Staff Details</li>      
      <?php }; ?>
    </ul>

  <div class="row">
    <div class="col-md-8">

		<?php echo messages(); ?>

    <div class="panel panel-primary">
			            <?php 
			            $query = "SELECT * FROM staff WHERE username='{$username}' ";
      					$staff = mysqli_fetch_assoc(mysqli_query($connection, $query)); 
      					?>
      
      <div class="panel-heading">
        <h3 class="panel-title"><?php if($staff['password']=='maseno') {?>
        	Welcome <?php echo ucwords($staff['first_name']." ". $staff['last_name']); ?> This is your first welcome
        	<?php }else{ ?>
        	Welcome back <?php echo ucwords($staff['first_name']." ". $staff['last_name']); ?> Please update your profile
        </h3>
        <?php }; ?>
      </div>
      <div class="panel-body" style="height:auto">
       
         
	      <div class="clearfix"></div>
				
				<form action="process_form.php" method="post" autocomplete="off" name="f" onSubmit="return validateForm();">
			          <table width="600" align="centre"><tr><td>
			            <div class="panel-body"></div>

			            
        				<div class="input-group input-group-sm">
                            <span class="input-group-addon">New password</span>
                              <input type="text"  class="form-control" id="password1" name="password1" placeholder="NEW PASSWORD" >
                        </div>
                        <br />

                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">confirm password</span>
                              <input type="text" class="form-control" name="password2"  name="password2" placeholder="CONFIRM NEW PASSWORD">
                        </div>
                        <br />
        				

			            <div class="input-group input-group-sm">
			                  <span class="input-group-addon">@</span>
			                  <input type="text" value="<?php echo $staff['email']; ?>" class="form-control" id="email" name="email"  placeholder="Email">
			            </div>
			            <br />
			            
			            <div class="input-group input-group-sm">
			                  <span class="input-group-addon glyphicon glyphicon-phone"></span>
			                  <input type="text" value="<?php echo $staff['tel']; ?>" class="form-control" id="tel" name="tel" placeholder="Mobile" >
			            </div>
			            <br />
			            
			            <div class="input-group input-group-sm">
			                  <span class="input-group-addon">ID No#</span>
			                  <input type="text" value="<?php echo $staff['id_no']; ?>" id="id" class="form-control" name="id"  placeholder=" ID number ">
			            </div>
			            <br />
			            
			            <div class="input-group input-group-sm">
			                  <span class="input-group-addon">Address</span>
			                  <input type="text" value="<?php echo $staff['address']; ?>" class="form-control" name="address" placeholder=" Address/Hostel">
			            </div>
			            <br /> 

			            <div class="input-group">
			                  <span class="input-group-addon"> D.O.B</span>
			                  <input type='text' value="<?php echo $staff['dob']; ?>" class="form-control" id="dob" name="dob" placeholder=" YYYY/MM/DD ">
			            </div>
			            <br />

			            <div class="input-group input-group-sm">
			                  <span class="input-group-addon">sex</span>
			                  <select name="SEX" class="form-control" required>
			                    
			                        <option value="M">Male</option>
			                        <option value="F">Female</option>
			                
			                  </select>
			            </div>
			            <br />


			            <div class="input-group input-group-sm">
			            	<input name="username" type="hidden" value="<?php echo $username ;?>">
			                  <input name="update" type="submit" class="pull-centre" id="submit" value="Update details">
			            </div>
			            <br /> 
			            </div>
			          </td></tr></table>
			          
     			</form>
      		
      		<!-- </div> -->
	      </div>
    </div>
   </div>

    <div class="col-md-4">
    	<?php echo messages(); ?>
				    <div class="panel panel-primary">
						  <div class="panel-heading">
							<h3 class="panel-title"> Account Instructions </h3>
						  </div>
						  <div class="panel-body" style="height:auto">
						  	<?php echo messages(); ?>

						                <ol class="">
											  <li>All accounts must be kept private</li>
											  <li>Do not share your password</li>
											  <li>All user data are protected and encrypted</li>

										</ol>
						  </div>
					</div>

				    <div class="panel panel-info">
						  <div class="panel-heading">
							<h3 class="panel-title"> Account Activities </h3>
						  </div>
						  <div class="panel-body" style="height:auto">
						  			<?php
						  			
                    require_once 'staff_querry.php';
						  			?>
						  
			
					                <ul class="nav nav-pills nav-stacked">
									<?php if($staff['level'] == '0'){ ?>
							              	  <li><a href="#">Total Visits<span class="badge pull-right"><?php echo $visit_count;?></span></a></li>
											  <li><a href="#"> Created Visits<span class="badge pull-right"><?php echo $visit;?></span></a></li>
											  <li><a href="#">Total Patients <span class="badge pull-right"><?php echo $Patient;?></span></a></li>
							           <?php }elseif($staff['level'] == '1'){ ?>
							                  <li><a href="#">Total Visits<span class="badge pull-right"></a><?php echo $visit_count;?></li>
											  <li><a href="#"> Examined Patients<span class="badge pull-right"><?php echo $exam;?></span></a></li>
							           <?php }elseif ($staff['level'] == '2'){ ?>
							                  <li><a href="#">Total Visit<span class="badge pull-right"><?php echo $visit_count;?></a></li>
											  <li><a href="#"> Patient Seen <span class="badge pull-right"><?php echo $seen;?></span></a></li>
											  <li><a href="#"> Recomended test <span class="badge pull-right"><?php echo $submit;?></span></a></li>
											  <li><a href="#"> Prescribed <span class="badge pull-right"><?php echo $Prescribed_by;?></span></a></li>
							           <?php }elseif ($staff['level'] == '4'){ ?>
							              	  <li><a href="#">Total Visits <span class="badge pull-right"><?php echo $visit_count;?></a></li>
											  <li><a href="#"> Lab test Performed <span class="badge pull-right"><?php echo $test_by;?></span></a></li>
											  <li><a href="#"> Total Lab test Done <span class="badge pull-right"><?php echo $lab_test;?></span></a></li>
							           <?php }elseif ($staff['level'] == '3'){ ?>
							             	  <li><a href="index.php">Total visits<span class="badge pull-right"></span></a></li>
											  <li><a href="#"> Exited patients <span class="badge pull-right"><?php echo $drug;?></span></a></li>
											  <li><a href="#"> Issued Medicine <span class="badge pull-right"><?php echo $drug;?></span></a></li>
							           <?php }elseif($staff['level'] == '5'){ ?>
							             	  <li><a href="#">Total Patients <span class="badge pull-right"><?php echo $Patient;?></span></a></li>
											  <li><a href="#"> Active Accounts <span class="badge pull-right"><?php echo $active;?></span></a></li>
											  <li><a href="#"> Inactive accounts <span class="badge pull-right"><?php echo $inactive;?></span></a></li>
											  <li><a href="#"> Total staff <span class="badge pull-right"><?php echo $stafff;?></span></a></li>
							          <?php  }; ?>	 
										</ul>				  
							</div>
					</div>

				
    </div>		
  </div>
  </div>
 
        <script>
          function isValidEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
          }

         function validateForm() {

                var pass1 = document.forms['f']['password1'].value;
                var pass2 = document.forms['f']['password2'].value;
                var email = document.forms['f']['email'].value;
                var contact = document.forms['f']['tel'].value;
                var id = document.forms['f']['id'].value;
                var dob = document.forms['f']['dob'].value;
                

                if (pass1 == "") {
                    alert("Password cannot be blank.");
                    $("#password1").focus();
                    return false;
                } else if (pass1.length < 7) {
                    $("#password2").focus();
                    alert("password cannot be less than 8 characters.");
                    return false;
                }

                if (password2 == "") {
                    alert("password 2 cannot be blank.");
                    $("#password2").focus();
                    return false;
                } else if (pass2 == ! pass1) {
                    alert("Passwords do not match.");
                    $("#password2").focus();
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

                if (contact == "") {
                    $("#tel").focus();
                    alert("Enter Contact no.");
                    return false;
                } else if (contact.length < 9) {
                    $("#tel").focus();
                    alert("contact must be 10 character.");
                    return false;
                } else if (contact.length > 10) {
                    $("#tel").focus();
                    alert("contact must be 10 character.");
                    return false;
                } else if (!$.isNumeric(contact) ) {
                    $("#tel").focus();
                    alert("Must be digits only.");
                    return false;
                }

                if (id == "") {
                    alert("Please enter the registration number.");
                    $("#id").focus();
                    return false;
                } else if (id.length < 8 || id.length > 8 ) {
                    alert("The Identification No# Must be 8 characters.");
                    $("#id").focus();
                    return false;
                } else if (!$.isNumeric(is) ) {
                    $("#id").focus();
                    alert("Must be digits only.");
                    return false;
                }


                if (dob == "") {
                    $("#dob").focus();
                    alert("Please enter a date of Birth.");
                    return false;
                }
                      
                
                return true;
            }


        </script>   

      <?php
      include 'footer.php';
      ?>
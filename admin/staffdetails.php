<?php

require_once '../functions.php';
require_once '../config.php';
include 'header.php';

                    
require_once 'staff_querry.php';
                  
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

    <div class="panel panel-success">
			            <?php 
			            $query = "SELECT * FROM staff WHERE username='{$username}' ";
      					$staff = mysqli_fetch_assoc(mysqli_query($connection, $query)); 
      					?>
      
      <div class="panel-heading">
        <h3 class="panel-title">Staff Information</h3>
      </div>
      <div class="panel-body" style="height:auto">
       
         
	      <div class="clearfix"></div>

            <div class="form-group">
              <label class="col-lg-4 control-label" for="profile_image">  </label>
              <div class="col-lg-5">
                <?php if ($staff["profile_image"] == null ){ ?>
                   <img  src="../profile_image/no_avatar.png" alt="profile pick" width="100px" height="100px" >
                <?php }else{ ?>
                   <a href="../profile_image/staff/<?php echo $staff['profile_image']?>" target="_blank"><img  src="../profile_image/staff/<?php echo $staff['profile_image']?>" alt="" width="100" height="100" class="thumbnail" ></a>
               <?php }?>
              </div>
            </div>				

      		<form class="form-horizontal">
      		<div class="form-group">
              <label class="col-lg-4 control-label" for="first_name"><span class="required"></span> Name:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo ucwords($staff["first_name"]." ".$staff["last_name"]); ?>" class="form-control" >
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="middle_name"> Email Address: </label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $staff["email"]; ?>"  class="form-control" >
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-4 control-label" for="contact_no2"> Date of Birth :</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $staff["dob"] ?>" class="form-control">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" f><span class="required"></span>Sex:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $staff["sex"] ?>"   class="form-control">
              </div>
            </div>
            
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="email_id"><span class="required"></span> Address :</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $staff["address"] ?>" class="form-control">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label"><span class="required">*</span>Identification No#:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $staff["id_no"] ?>" class="form-control" >
              </div>
            </div>

            </form>  
      			
      		
      		<!-- </div> -->
	      </div>
    </div>
   </div>

    <div class="col-md-4">
    	<?php echo messages(); ?>

				    <div class="panel panel-info">
						  <div class="panel-heading">
							<h3 class="panel-title"> Account Activities </h3>
						  </div>
						  <div class="panel-body" style="height:auto">
						  			<?php
						  			$name = ucwords($staff['first_name']." ".$staff['last_name']);

						  			$sql = "SELECT * FROM student_patient ";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$patient = count($stmt->fetchAll());

						  			$sql = "SELECT * FROM student_patient ";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$Patient = count($stmt->fetchAll());

  									$sql = "SELECT * FROM laboratory_test WHERE attended=2 ";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$lab_test = count($stmt->fetchAll());

  									$sql = "SELECT * FROM laboratory_test WHERE conducted_by='{$name}' ";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$test_by = count($stmt->fetchAll());

  									$sql = "SELECT * FROM visit WHERE attended=3";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$visit_count = count($stmt->fetchAll());

  									$sql = "SELECT * FROM visit WHERE created_by='{$name}' ";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$visit = count($stmt->fetchAll());  									

  									$sql = "SELECT * FROM visit WHERE examined_by='{$name}' ";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$exam = count($stmt->fetchAll());

  									$sql = "SELECT * FROM treatment WHERE seen_by='{$name}' ";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$Seen = count($stmt->fetchAll());

  									$sql = "SELECT * FROM laboratory_test WHERE submited_by='{$name}' ";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$submit = count($stmt->fetchAll());

  									$sql = "SELECT * FROM treatment WHERE prescribed_by='{$name}' ";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$prescribed_by = count($stmt->fetchAll());

  									$sql = "SELECT * FROM treatment WHERE druged_by='{$name}' ";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$drug = count($stmt->fetchAll());

  									$sql = "SELECT * FROM staff WHERE status=1 ";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$active = count($stmt->fetchAll());

  									$sql = "SELECT * FROM staff WHERE status=0 ";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$inactive = count($stmt->fetchAll());

  									$sql = "SELECT * FROM staff ";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$stafff = count($stmt->fetchAll());

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

				<?php if ($_SESSION['level']==5){ ;?>	
				    <div class="panel panel-success">
				    	
						  <div class="panel-heading">
							<h3 class="panel-title"> Account Status<a class="pull-right" href="index.php"> Home <span class="primary glyphicon glyphicon-home "></span></a></h3>
						  </div>
						  <div class="panel-body" style="height:auto">
						  	<form method="post" action="process_form.php">
						  		<?php if(($staff['status'])=='0'){ 
						  			echo 'Account Inactive';
						  		 ?><br>
						  			<input name="username" type="hidden" value="<?php echo $username ;?>">
						  			<input name="activate" type="submit" class="pull-centre alert-warning" id="submit" value="Activate Account">
						  		<?php }elseif(($staff['status'])=='1'){
						  			echo 'Account Active';
						  		 ?><br>
						  			<input name="username" type="hidden" value="<?php echo $username ;?>">
						  			<input name="deactivate" type="submit" class="pull-centre alert-info" id="submit" value="Deactivate Account">
						  		<?php };?>
						  	</form>		
						  </div>
					</div>
				<?php };?>					
    </div>		
  </div>
  </div>

      <?php
      include 'footer.php';
      ?>
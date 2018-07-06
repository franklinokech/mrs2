<?php

require_once '../config.php';
require_once '../database_connection.php';
require_once '../functions.php';
include 'header.php';


   if(isset($_GET['visit_no'])){
    $visit_no = $_GET['visit_no'];
  }else{
    echo "No id found"; 
  }

// echo $visit_no;
// echo $reg_no;
?>

<?php
 $visit = mysqli_fetch_assoc(find_nurs($visit_no));  
$results = mysqli_fetch_assoc(find_patient($visit['reg_no']));
              
?>
<?php
// if (isset($_POST ['lab'])){
//   $signs = trim($_POST['signs']);
//   $notes = trim($_POST['notes']);
//   $visit_no = trim($_POST['visit_no']);
//   $reg_no = trim($_POST['reg_no']);
//   $seen = trim($_POST['seen_by']);
//   $attendd = 2;

//   pre($_POST);
// }
?>


<div class="container">
<div class="row">
  <ul class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li class="active">View Patient Details</li>
    </ul>
</div>

  <div class="row">
    <div class="col-md-8">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Patient </h3>
      </div>
      <div class="panel-body" style="height:auto">
      
			
			<form class="form-horizontal" Autocomplet="off" style="height:auto" name="vist_form" id="visit_form" enctype="multipart/form-data" method="post" action="process_form.php">
                      <fieldset>
                                <div class="form-group">
                                  <label class="col-lg-2 control-label" for="temp"><span class="required">*</span> Signs & Symptoms :</label>
                                  <div class="col-lg-9">
                                    <textarea placeholder="Symptoms and sign here" style="width:800px;height:80px auto;resize:none;" id="signs"  max="70" required class="form-control" name="signs"></textarea>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-lg-2 control-label" for="bp"><span class="required">*</span>Doctor's Notes:</label>
                                  <div class="col-lg-9">
                                    <textarea placeholder="Short Notes"  style="width:700px;height:80px auto;resize:none;" id="notes"  max="70" required class="form-control textarea" name="notes"></textarea>
                                  </div>
                                </div>
                                                        

                                <input type="hidden" value="<?php echo $visit['visit_no'] ?>"    required class="form-control" name="visit_no">     
                                <input type="hidden" value="<?php echo $visit['reg_no']; ?>"   required class="form-control" name="reg_no">
                                <input type="hidden" value="<?php echo ucwords($_SESSION['fname']." ".$_SESSION['lname']); ?>" required class="form-control" name="seen_by">
				<table class="table table-striped table-hover table-bordered ">
					<tbody><tr>
						<th>Action </th>
					  </tr>
					  <tr>					  
                               <td><input type="submit" class="btn btn-primary btn-lg pull-right" name="preccribe" onClick="return confirm('Are you sure You want to prescribe?')" value=" Prescribe Drugs !" />
							   <input type="submit" class="btn btn-primary btn-lg pull-left danger" onClick="return confirm('Are you sure you want to recomend a test?')" name="lab" value=" Lab Test !" /></td>
						</tr>
					</tbody></table>	
                      </fieldset>
					  <script>
							CKEDITOR.replace('signs');
						</script>
						<script>				  
							CKEDITOR.replace('notes');
                      </script>
                </form>
				
          </fieldset>

      </div>
    </div>
   </div>

    <div class="col-md-4">
                <?php echo messages(); ?>
                <div class="alert alert-info" > Examination Details <span id="ct" ></span></div>
					
			<div class="form-group">

            <div class="form-group">
              <label class="col-lg-5 control-label" for="first_name"><span class="required"></span> Name:</label>
              <div class="col-lg-7">
                <input type="text" readonly="" placeholder="First Name" value="<?php echo $results["first_name"] ?> <?php echo $results[0]["last_name"] ?>" id="first_name" class="form-control" name="first_name"><span id="first_name_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 control-label" for="middle_name"> Last Name: </label>
              <div class="col-lg-7">
                <input type="text" readonly="" value="<?php echo $results["last_name"] ?>" placeholder="Last Name"  class="form-control" >
              </div>
            </div>
                  <?php
                    $d=$results["d_o_b"];
                    $age = date_diff(date_create($d), date_create('today'))->y;
                    
                  ?>

            <div class="form-group">
              <label class="col-lg-5 control-label" for="contact_no2"> Age :</label>
              <div class="col-lg-7">
                <input type="text" readonly="" value="<?php echo $age.' yrs' ?>" placeholder="Contact Number"  class="form-control"><span id="contact_no2_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 control-label" for="last_name"><span class="required"></span>Registration No#:</label>
              <div class="col-lg-7">
                <input type="text" readonly="" value="<?php echo $results["reg_no"] ?>" placeholder="Last Name" name="rg_no"  class="form-control"><span id="last_name_err" class="error"></span>
              </div>
            </div>
            
			<hr>
            
            <div class="form-group">
              <label class="col-lg-5 control-label" for="email_id"> Temperature :</label>
              <div class="col-lg-7">
                <input type="text" readonly="" value="<?php echo $visit['temp']." oC" ?>"  class="form-control">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 control-label" > Blood Pressure :</label>
              <div class="col-lg-7">
                <input type="text" readonly="" value="<?php echo $visit['bp']." mmHg" ?>"  class="form-control" >
              </div>
            </div>
            

    </div>
	</div>
  </div>
  </div>
<script src="ckeditor/ckeditor.js"></script>  
<?php
include 'footer.php';
?>
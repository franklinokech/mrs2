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
 if (isset($_POST ['psb'])){

  $prescribe = ($_POST['prescribe']);
  $reg_no = ($_POST['reg_no']);
  $visit_no = ($_POST['visit_no']);

  pre($_POST);
}
?>


<div class="container">
<div class="row">
  <ul class="breadcrumb">
      <li><a href="index.php">Home</a></li>
	  <li><a href="view_patients.php">View the Patient details</a></li>
      <li class="active">Drug prescription</li>
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
                                  <label class="col-lg-2 control-label" for="temp"><span class="required">*</span> Prescription :</label>
                                  <div class="col-lg-9">
                                    <textarea placeholder="Prescription in list format" style="width:300px;height:100px auto;resize:none;" id="prescribe"  max="70" required class="form-control" name="prescribe"></textarea>
                                  </div>
                                </div>
                                
                                                  <?php  
                                                     $visit = mysqli_fetch_assoc(find_nurs($visit_no));
                                                  
                                                  ?>

                                     
                                <input type="hidden" value="<?php echo $visit['visit_no'] ?>"  id="bp" min="3" max="5" required class="form-control" name="visit_no">
								<input type="hidden" value="<?php echo $visit['reg_no'] ?>"  id="bp" min="3" max="5" required class="form-control" name="reg_no">
				<table class="table table-striped table-hover table-bordered ">
					<tbody><tr>
						<th></th>
					  </tr>
					  <tr>					  
                               <td><input type="submit" class="btn btn-primary btn-lg centre" name="psb" value=" Submit Prescription !" /></td>
						</tr>
					</tbody></table>	
                      </fieldset>
					  <script>
							CKEDITOR.replace('prescribe');
						</script>
                </form>
				
          </fieldset>

      </div>
    </div>
   </div>

    <div class="col-md-4">

                <div class="alert alert-info" > Examination Details <span id="ct" ></span></div>
					
			<div class="form-group">
              <?php 
				 $reg_no = $visit['reg_no'];
                 $results = mysqli_fetch_assoc(find_patient($reg_no));
              
                ?>
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

            <div class="form-group">
              <label class="col-lg-5 control-label" for="contact_no2"> Date of Birth :</label>
              <div class="col-lg-7">
                <input type="text" readonly="" value="<?php echo $results["d_o_b"] ?>" placeholder="Contact Number"  class="form-control"><span id="contact_no2_err" class="error"></span>
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
                <input type="text" readonly="" value="<?php echo $visit['temp'] ?>"  class="form-control">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 control-label" for="contact_no1"> Blood Pressure :</label>
              <div class="col-lg-7">
                <input type="text" readonly="" value="<?php echo $visit['bp'] ?>"  class="form-control" >
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
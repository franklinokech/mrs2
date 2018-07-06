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

$medication = mysqli_fetch_assoc(issue_medication($visit_no));
$results = mysqli_fetch_assoc(find_patient($medication['reg_no']));
?>


<div class="container">
<div class="row">
  <ul class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li class="active">Give Medication</li>
    </ul>
</div>

  <div class="row">
    <div class="col-md-8">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Patient </h3>
      </div>
      <div class="panel-body" style="height:auto">
                  <?php
                    $d=$results["d_o_b"];
                    $age = date_diff(date_create($d), date_create('today'))->y;
                    
                  ?>
			
			<form class="form-horizontal" Autocomplet="off" style="height:auto" name="vist_form" id="visit_form" enctype="multipart/form-data" method="post" action="process_form.php">
                      <fieldset>
                                <div class="form-group">
                                  <label class="col-lg-2 control-label" for="temp"><span class="required"></span></label>
                                  <div class="col-lg-9">
                                    <textarea readonly="" style="width:800px;height:80px auto;resize:none;" id="signs"  max="70" required class="form-control" name="signs">
                                      <b>Please give the following drugs to <strong><?php echo ucwords($results["first_name"]." ".$results["last_name"]) ?></strong> ( <?php echo $age." yrs old";?>)</b>
                                          <ol>
                                            <li><?php echo $medication['prescription'] ?></li>
                                          </ol>

                                          Prescribed by: DR. <?php echo $medication['prescribed_by'] ?> 
                                    </textarea>
                                  </div>
                                </div>

                                <input type="hidden" value="<?php echo $medication['visit_no'] ?>" class="form-control" name="visit_no">
                                <input type="hidden" value="<?php echo ucwords($_SESSION['fname']." ".$_SESSION['lname'])?>" class="form-control" name="attended_by">     
					                   <div class="form-group">
                                  <label class="col-lg-5 control-label" for="temp"><span class="required"></span></label>
                                  <div class="col-lg-6">
                                    <input type="submit" class="btn btn-primary btn-lg centre" name="exit" value=" Exit Patient " />
                              </div>
                                </div>
						
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
   
       <div class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">Patient Information </h3>
          </div>
              <div class="panel-body" style="height:auto">
					
			<div class="form-group">

            <div class="form-group">
              <label class="col-lg-5 control-label" for="first_name"><span class="required"></span> Name:</label>
              <div class="col-lg-7">
                <input type="text" readonly="" placeholder="First Name" value="<?php echo $results["first_name"] ?>" id="first_name" class="form-control" >
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
                <input type="text" readonly="" value="<?php echo $results["d_o_b"] ?>" placeholder="Contact Number"  class="form-control">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 control-label" for="last_name"><span class="required"></span>Registration No#:</label>
              <div class="col-lg-7">
                <input type="text" readonly="" value="<?php echo $results["reg_no"] ?>"  class="form-control">
              </div>
            </div>

            
        </div>
    </div>
</div>
    </div>
	</div>
  </div>
  <!-- </div> -->
<script src="ckeditor/ckeditor.js"></script>  
<?php
include 'footer.php';
?>
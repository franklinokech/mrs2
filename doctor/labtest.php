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


$visit = mysqli_fetch_assoc(find_nurs($visit_no));
$results = mysqli_fetch_assoc(find_patient($visit['reg_no']));
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
                                  <label class="col-lg-4 control-label" for="temp"><span class="required">*</span> Test 1 :</label>
                                  <div class="col-lg-6">
                                  <select class="form-control" id="fuculty" name="test1" placeholder="">
                                        <option value=''> Speceify TEST 1 </option>
                                        <option value='Malaria'> MALARIA </option>
                                        <option value='typhoid'> TYPHOID </option>
                                        <option value='typhid'> TB </option>
                                        <option value='HIV'> HIV/AIDS </option>
                                        
                                  </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-lg-4 control-label" for="temp"><span class="required">*</span> Test 2 :</label>
                                  <div class="col-lg-6">
                                     <select class="form-control" id="fuculty" name="test2" placeholder="school">
                                          <option value=''>  Speceify TEST 2 </option>
                                          <option value='Malaria'> MALARIA </option>
                                          <option value='typhoid'> TYPHOID </option>
                                          <option value='typhid'> TB </option>
                                          <option value='HIV'> HIV/AIDS </option>
                                    </select>
                                  </div>
                                </div>


                                <div class="form-group">
                                  <label class="col-lg-4 control-label" for="temp"><span class="required">*</span> Test 3 :</label>
                                  <div class="col-lg-6">
                                    <textarea placeholder="" style="width:800px;height:80px auto;resize:none;" id="test3"  max="70" required class="form-control" name="test3"></textarea>
                                  </div>
                                </div>
                                


                                <input type="hidden" value="<?php echo $visit['visit_no'] ?>"    required class="form-control" name="visit_no">     
                                <input type="hidden" value="<?php echo $visit['reg_no']; ?>"   required class="form-control" name="reg_no">
                                <input type="hidden" value="<?php echo ucwords($_SESSION['fname']." ".$_SESSION['lname'])?>" required class="form-control" name="submited_by">
									  
                           <div class="form-group">
                              <label class="col-lg-5 control-label" for="temp"><span class="required"></span></label>    
							             <input type="submit" class="btn btn-primary btn-lg danger" name="submit_test" value=" Submit Test !" />
                           </div>
                              
							
                      </fieldset>
					  <script>
							CKEDITOR.replace('test3');
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
              <?php  
                 $results = mysqli_fetch_assoc(find_patient($visit['reg_no']));
              
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
                                <?php
                    $d=$results["d_o_b"];
                    // $d1=strtotime($d);
                      // echo date($d1);

                      $age = date_diff(date_create($d), date_create('today'))->y;
                      // echo $age.'years';
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
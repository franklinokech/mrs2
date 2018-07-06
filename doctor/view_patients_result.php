<?php

require_once '../config.php';
require_once '../database_connection.php';
require_once '../functions.php';
include 'header.php';


 if(isset($_GET['reg_no'])){
    $reg_no = $_GET['reg_no'];
  }else{
    echo "No id found"; 
  }

   if(isset($_GET['visit_no'])){
    $visit_no = $_GET['visit_no'];
    $value=4;
$sql = "UPDATE laboratory_test SET attended  = '{$value}' WHERE `visit_no` = '{$visit_no}' ";

     try {
      $stmt = $DB->prepare($sql);

      
      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
    } catch (Exception $ex) {
      $_SESSION["message"] = $ex->getMessage();
    }

  }else{
    echo "No id found"; 
  }

 // if(isset($_GET['mode'])){
 //    $mode = $_GET['mode'];
 //    

 // if ($mode=="read"){
   
 // }  
 //  }else{
 //    echo "No mode found";
 //  }
?>

              <?php  
                 $results = mysqli_fetch_assoc(find_patient($reg_no));
              
                ?>


<div class="container">
<div class="row">
  <ul class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li class="active">View Patient Laboratory Result</li>
    </ul>
</div>

  <div class="row">
    <div class="col-md-8">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Patient </h3>
      </div>
      <div class="panel-body" style="height:auto">
      
			                      <fieldset>

                                                  <?php  
                                                     $visit = mysqli_fetch_assoc(find_laboratory_result($visit_no));
                                                  
                                                  ?>


                                <div class="form-group">
                                  <label class="col-lg-2 control-label" for="temp"><span class="required">*</span> Laboratory Results :</label>
                                  <div class="col-lg-9">
                                    <textarea readonly="" style="width:800px;height:80px auto;resize:none;" id="signs"  max="70" required class="form-control" name="signs">
                                         <p><b> The following test(s) was/were conducted</b></p>
                                          <?php echo $visit['test'] ?>
                                            
                                          <?php if($visit['result']=="" ){
                                            echo "And the results(s) are still being procesced ";
                                          }else{ ?>
                                          <p><b> The following result(s) was/were obtained</b></p>
                                           <?php 
                                            echo $visit['result'] ;
                                         }; ?> 
                                    </textarea>
                                  </div>
                                </div>


                                <input type="hidden" value="<?php echo $visit['visit_no'] ?>"    required class="form-control" name="visit_no">     
                                <input type="hidden" value="<?php echo $reg_no; ?>"   required class="form-control" name="reg_no">
				<table class="table table-striped table-hover table-bordered ">
					<tbody><tr>
						<th></th>
					  </tr>
					  <tr>
                <?php if($visit['result']==""){ ?>
                         <td><input type="submit" class="btn btn-primary btn-lg disabled" name="preccribe" value=" Prescribe Drugs !" /></td>
                     <?php }else{ ?>
                         <td><a href="prescribe.php?visit_no=<?php echo $visit_no; ?>"><button class="btn btn-primary btn-lg"> Prescribe Drugs !</button></a></td>
                      <?php }; ?>

                
						</tr>
					</tbody></table>	
                      </fieldset>
					  <script>
							CKEDITOR.replace('signs');
						</script>
						<script>				  
							CKEDITOR.replace('notes');
                      </script>
                
				
          </fieldset>

      </div>
    </div>
   </div>

    <div class="col-md-4">
<?php echo messages() ;?>
                <div class="alert alert-info" > Examination Details <span id="ct" ></span></div>
					
			<div class="form-group">
              <?php  
                 $results = mysqli_fetch_assoc(find_patient($reg_no));
                 $tp = mysqli_fetch_assoc(find_nurs($visit_no));
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
                <input type="text" readonly="" value="<?php echo $tp['temp']." oC" ?>"  class="form-control">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 control-label" > Blood Pressure :</label>
              <div class="col-lg-7">
                <input type="text" readonly="" value="<?php echo $tp['bp']." mmHg" ?>"  class="form-control" >
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
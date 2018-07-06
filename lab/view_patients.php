<?php

require_once '../config.php';
require_once '../database_connection.php';
require_once '../functions.php';
include 'header.php';


 //if(isset($_GET['reg_no'])){
   // $reg_no = $_GET['reg_no'];
 // }else{
   // echo "No id found"; 
 // }

   if(isset($_GET['visit_no'])){
    $visit_no = $_GET['visit_no'];
  }else{
    echo "No id found"; 
  }

 // if(isset($_GET['attend'])){
   // $attend = $_GET['attend'];
 // }else{
   // echo "No id found"; 
  //}

// echo $visit_no;
// echo $reg_no;
?>

<?php 
 $visit = mysqli_fetch_assoc(find_laboratory_result($visit_no)); 
$results = mysqli_fetch_assoc(find_patient($visit['reg_no']));
              
?>


<div class="container">
<div class="row">
  <ul class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li class="active"><?php if($visit['attended']==0){ echo 'View Recomended Laboratory Tests'; }elseif ($visit['attended']==1) { echo 'Submit Laboratory Results'; }; ?></li>
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

                                <div class="form-group">
                                 
                                  <div class="col-lg-11">
                                <?php if($visit['attended']==0){ ?>    
                                    <textarea readonly="" style="width:800px;height:80px auto;resize:none;" id="signs"  max="70" required class="form-control" name="signs">
                                       <?php if ($visit['test'] ==!"") { ?>
                                         <p><b> Please Perform the following test on <?php echo ucwords($results["first_name"] . " " . $results["last_name"]); ?></b></p>
                                          <?php 
                                            echo $visit['test'];
                                           } else {
                                         echo "There must have been a mistake";
                                       }
                                        ?>  
                                     <u>Submitted by</u>
                                          DR. <?php echo $visit['submited_by']; ?>   
                                    </textarea>
                                  </div>
                                </div>


                                     
      <form name="form1" class="form-conrol" method="POST" action="process_form.php">                   
				<table class="table table-striped table-hover table-bordered ">
					<tbody><tr>
						<th></th>
					  </tr>
					  <tr>
               <input type="hidden" value="<?php echo $visit_no ?>" required class="form-control" name="visit_no">
            <td><input type="submit" class="btn btn-primary btn-lg" name="wait" value=" Alright wait!" /></td>
               
						</tr>
					</tbody></table>
      </form>
      <?php }elseif ($visit['attended']==1) { ?>
        
        <form name="form1" class="form-conrol form-horizontal" method="POST" action="process_form.php">
                                  <?php if ($visit['test'] ==!"") { ?>
                                         <p><b> Tests conducted on  <?php echo ucwords($results["first_name"] . " " . $results["last_name"]); ?></b></p>
                                           <?php 
                                            echo $visit['test'];
                                            } else {
                                         echo "There must have been a mistake";
                                       }
                                        ?>  
                                     <br><u>Submitted by</u>
                                          DR. <?php echo $visit['submited_by']; ?>    
                               

            <div class="form-group">
              <label class="col-lg-5 control-label" for="last_name"><span class="required"></span>Result for test 1:</label>
              <div class="col-lg-7">
                <textarea style="width:250px;height:80px auto;resize:none;"   max="70" required class="form-control" name="result1"></textarea>
              </div>
            </div>

                  <div class="form-group">
                    <label class="col-lg-5 control-label" for="last_name"><span class="required"></span>Result for test 2:</label>
                    <div class="col-lg-7">
                      <textarea style="width:250px;height:80px auto;resize:none;"  max="70" required class="form-control" name="result2"></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-lg-5 control-label" for="last_name"><span class="required"></span>Result for test 3:</label>
                    <div class="col-lg-7">
                      <textarea style="width:250px;height:80px auto;resize:none;"  max="70" required class="form-control" name="result3"></textarea>
                    </div>
                  </div>

            <input type="hidden" value="<?php echo $visit_no ?>" required class="form-control" name="visit_no">
			<input type="hidden" value="<?php echo ucwords($_SESSION['first_name']." ".$_SESSION['last_name'])?>" required class="form-control" name="conducted_by">
            <input type="hidden" value="1" required class="form-control" name="attended">
              
              <div style="height:20px; padding:10px"></div>

              <div class="col-lg-12 center form-group"> 
                  <input type="submit" class="btn btn-primary" name="submit" value="Submit Result!" />
              </div>   
        </form>
    <?php }; ?>



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

                <div class="alert alert-info" > Patient Information <span id="ct" ></span></div>
					
            <div class="form-group">
              <label class="col-lg-5 control-label" for="first_name"><span class="required"></span> First Name:</label>
              <div class="col-lg-7">
                <input type="text" readonly="" value="<?php echo $results["first_name"] ?>"  class="form-control" >
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 control-label" for="middle_name"> Last Name: </label>
              <div class="col-lg-7">
                <input type="text" readonly="" value="<?php echo $results["last_name"] ?>"   class="form-control" >
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-5 control-label" for="contact_no2"> Date of Birth :</label>
              <div class="col-lg-7">
                <input type="text" readonly="" value="<?php echo $results["d_o_b"] ?>" class="form-control">
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
<script src="ckeditor/ckeditor.js"></script>  
<?php
include 'footer.php';
?>
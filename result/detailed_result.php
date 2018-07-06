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
  }else{
    echo "No id found"; 
  }

// echo $visit_no;
// echo $reg_no;
?>
<?php
  $pherm = mysqli_fetch_assoc(issue_medication($visit_no));
  $visit = mysqli_fetch_assoc(find_laboratory_result($visit_no));
  $exam = mysqli_fetch_assoc(find_nurs($visit_no));
  $recept = mysqli_fetch_assoc(find_patient($reg_no));
?>

<div class="container">
<div class="row">
  <ul class="breadcrumb">
    <?php if ($_SESSION['level']==5){ ?>
      <li><a href="../admin/index.php">Home</a></li>
      <?php }elseif ($_SESSION['level']==2) { ?>
      <li><a href="../doctor/index.php">Home</a></li>
      <?php }elseif ($_SESSION['level']==0) { ?>
      <li><a href="../reception/reception.php">Home</a></li>
   <?php }; ?>
      <li><a href="report.php"> Cleared Patients </a></li>
      <li class="active"> Print Report </li>
    </ul>
</div>
  <div class="row">
    <div class="col-md-8">
            <script src="jQuery.print.js"></script> 
            <script>
                $(document).ready(function() {
                    $(".print_div").find('button').on('click', function() {

                        var dv_id = $(this).parents(".print_div").attr('id');

                        //Print ele4 with custom options
                        $('#' + dv_id).print({
                            //Use Global styles
                            globalStyles: false,
                            //Add link with attrbute media=print
                            mediaPrint: false,
                            //Custom stylesheet
                            stylesheet: "http://fonts.googleapis.com/css?family=Inconsolata",
                            //Print in a hidden iframe
                            iframe: true,
                            //Don't print this
                            noPrintSelector: ".avoid-this"
                        });
                    });
                });
            </script>      

    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Patient </h3>
      </div>
      <div class="panel-body" style="height:auto">
      <div id='print-div2' class="print_div">
			                      <fieldset>
                                <div class="form-group">
                                  
                                  <div class="col-lg-12">

                                      MASENO UNIVERSITY HOSPITAL
                                      <br />
                                      <i>Private BAG</i> 1234
                                      <br />
                                      TELL : 5798752
                                      <br />
                                      <U>DATE: <?php echo date('d/m/y'); ?></U>
                                      <br />
                                      <br />
                                      <i>Our ref..........................
                                      <br />
                                      your ref.........................</i>
                                      <br /> 
                                      <br /> 
                                      <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><b>REF: MEDICAL REPORT</b></u></strong>
                                      <hr>
                                      VISIT NO: <?php echo $visit_no; ?>
                                      <br />
                                      NAME : <?php echo ucwords($recept["first_name"]." ".$recept["last_name"]) ?>
                                      <br />
                                      REG N0#: <?php echo $recept["reg_no"]; ?>
                                      <br />
                                      DATE : <?php $ty=$exam["date"]; $syp = strtotime($ty); echo date("m.d.Y", $syp); ?>
                                      <br />
                                      <br />
                                      The above named person attended this hospital on the above specified date and was having <?php echo $pherm['signs'] ; ?> signs.

                                      <?php if($visit['test1']==!""|| $visit['test2']==!"" || $visit['test3']==!""){ ?>
                                        He was diagnosed with: <?php echo($visit['result1'].",".$visit['result2']." and ".$visit['result3']); ?>
                                        and was later prescribed with <?php echo $pherm['prescribe']; ?> drugs.
                                      <?php }else { ?> the signs were not serious ones hence was prescribed with <?php echo $pherm['prescribe']; ?> drugs.
                                      <?php };?> 

                                      <br />
                                      <hr>
                                      Yours faithfully<br>
                                      <?php echo ucwords($_SESSION['fname']." ".$_SESSION['lname']); ?>

                                      <br>
                                      <br>
                                      <br>
                                      <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button  onclick="return confirm('Are you sure?')" class="btn-lg btn-info print-link avoid-this"> Print  <span class="glyphicon glyphicon-print"></span> </button></div></div>
                                        </div>
                                  </div>
                                <!-- </div> -->

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
					
			<div class="form-group">
              <?php  
                 $results = mysqli_fetch_assoc(find_patient($reg_no));
                 $tp = mysqli_fetch_assoc(find_nurs($visit_no));
                ?>
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">Patient Information </h3>
                </div>
                <div class="panel-body" style="height:auto">          
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
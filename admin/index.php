<?php

// require_once '../functions.php';
require_once '../config.php';
include 'header.php';
include 'morris-data.php';



if (!$_SESSION['level']){
  $_SESSION['message'] = 'You must Login';
  redirect_to('../login.php');
}else if($_SESSION['level']==5){
 $last =  $_SESSION['last_login'];
 inactive($last);
?>

  <div class="row" style="padding-left:10px; padding-right:10px;" >

    <div class="col-md-9">

		<?php echo messages(); ?>
                   <?php
                    if ($_GET["msg"] == "success") {
                        echo successMessage("Email has been send successfully");
                    } elseif ($_GET["msg"] == "error") {
                        echo errorMessage("There was some problem sending mail");
                    }

try {
$sql = "SELECT * FROM visit ";
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $total_visits = count($stmt->fetchAll());
} catch (Exception $ex) {
    echo $ex->getMessage();
}
try {
    $sql = " SELECT * FROM laboratory_test ";
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    $total_labs = count($stmt->fetchAll());
} catch (Exception $ex) {
    echo $ex->getMessage();
}
try {
    $sql = " SELECT * FROM message ";
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    $total_msg = count($stmt->fetchAll());
} catch (Exception $ex) {
    echo $ex->getMessage();
}
try {
    $sql = " (SELECT reg_no FROM staff_patient) union (SELECT reg_no FROM student_patient) ";
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    $total_patients = count($stmt->fetchAll());
} catch (Exception $ex) {
    echo $ex->getMessage();
}
try {
    $sql = " SELECT * FROM staff WHERE active='YES'";
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    $user = count($stmt->fetchAll());
} catch (Exception $ex) {
    echo $ex->getMessage();
}
                    ?>

<script type="text/javascript">
$( "#menu" ).menu();
</script>
              <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $total_msg ;?></div>
                                        <div>Messages sent!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $total_labs?></div>
                                        <div>Laboratory test!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="lab_test_done.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="glyphicon glyphicon-list-alt fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $total_visits?></div>
                                        <div>Total Visits!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="vist.php" title="Click to view all visits">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x "></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $total_patients ;?></div>
                                        <div>Patients!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                  <span class="pull-left">
                                  <ul class="wel sm">
                                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">View Details<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                    <ul class="dropdown-menu alert-dropdown" >
                        <!-- <li>
                            <a href="all_patient.php"> All Patients </a>
                        </li> -->
                        <li>
                            <a href="staff_patient.php"> University staff </a>
                        </li>
                        <li>
                            <a href="student.php" title="clic to view"> Student </a>
                        </li>

                    </ul>
</li>
</ul>
</span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
            </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i>Last three days attendance</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-donut"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i>Messages</h3>
                            </div>
                            <div class="panel-body">
                                <?php include 'message.php' ?>
                            </div>
                                <div class="panel-footer text-right">
                                    <a href="../messages/send_message.php?mode=read">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                        </div>
                    </div>
</p>

<div id="dialog" title="Pending Visits"><?php include 'daily_content/pending.php'; ?></div>
<div id="doctor" title="Pending Visits"><?php include 'daily_content/doctor.php'; ?></div>
<div id="exam" title="Pending Visits"><?php include 'daily_content/exam.php'; ?></div>
<div id="lab" title="Pending Visits"><?php include 'daily_content/lab.php'; ?></div>
<div id="drug" title="Pending Visits"><?php include 'daily_content/drug.php'; ?></div>
<div id="visit" title="Pending Visits"><?php include 'daily_content/visit.php'; ?></div>




                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Tasks Panel</h3>
                            </div>
                          <?php require_once 'status_query.php'; ?>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="#" id="dialog-link" class="list-group-item">
                                        <span class="badge"><?php echo $pend ?></span>
                                        <i class="fa fa-fw fa-calendar"></i> Todal pending visits
                                    </a>
                                    <a href="#" id="doctor-link" class="list-group-item">
                                        <span class="badge"><?php echo $Waiting_doctor ?></span>
                                        <i class="fa fa-fw fa-comment"></i> Waiting Doctor's attendance
                                    </a>
                                    <a href="#" id="exam-link" class="list-group-item">
                                        <span class="badge"><?php echo $Waiting_exam ?></span>
                                        <i class="fa fa-fw fa-truck"></i> Waiting Examinitions
                                    </a>
                                    <a href="#" id="lab-link" class="list-group-item">
                                        <span class="badge"><?php echo $Waiting_result ?></span>
                                        <i class="fa fa-fw fa-money"></i> Waiting laboratory results
                                    </a>
                                    <a href="#" id="drug-link" class="list-group-item">
                                        <span class="badge"><?php echo $drugs ?></span>
                                        <i class="fa fa-fw fa-list"></i> Unavailable drugs
                                    </a>
                                    <a href="#" id="visit-link" class="list-group-item">
                                        <span class="badge"><?php echo $now ?></span>
                                        <i class="fa fa-fw fa-check"></i> Total visits today
                                    </a>
                                    <a href="active.php" class="list-group-item">
                                        <span class="badge"><?php echo $user ?></span>
                                        <i class="fa fa-fw fa-user"></i> Active users
                                    </a>

                                </div>
                                <!--
                                <div class="text-right">
                                    <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                                </div> -->
                            </div>
                        </div>
                    </div>

        </div>
        <?php include 'month_query.php' ;

        ?>
        <div class="row mt" style="margin-left:10px; margin-right:10px;">
                              <!--CUSTOM CHART START -->
                              <div class="border-head">
                                  <h3>VISITS</h3>
                              </div>
                              <div class="custom-bar-chart">
                                  <ul class="y-axis">
                                      <li><span>10.000</span></li>
                                      <li><span>8.000</span></li>
                                      <li><span>6.000</span></li>
                                      <li><span>4.000</span></li>
                                      <li><span>2.000</span></li>
                                      <li><span>0</span></li>
                                  </ul>
                                  <div class="bar">
                                      <div class="title">JAN</div>
                                      <div class="value tooltips" data-original-title="<?php echo $jan ?>" data-toggle="tooltip" data-placement="top"><?php $jann =  ($jan/$sum)*100; echo $jann ;?></div>
                                  </div>
                                  <div class="bar ">
                                      <div class="title">FEB</div>
                                      <div class="value tooltips" data-original-title="<?php echo $feb ?>" data-toggle="tooltip" data-placement="top"><?php echo $res =  ($feb/$sum)*100;?></div>
                                  </div>
                                  <div class="bar ">
                                      <div class="title">MAR</div>
                                      <div class="value tooltips" data-original-title="<?php echo $mar ?>" data-toggle="tooltip" data-placement="top"><?php echo $marr =  ($mar/$sum)*100;?></div>
                                  </div>
                                  <div class="bar ">
                                      <div class="title">APR</div>
                                      <div class="value tooltips" data-original-title="<?php echo $apr ?>" data-toggle="tooltip" data-placement="top"><?php echo $aprr =  ($apr/$sum)*100;?></div>
                                  </div>
                                  <div class="bar">
                                      <div class="title">MAY</div>
                                      <div class="value tooltips" data-original-title="<?php echo $may ?>" data-toggle="tooltip" data-placement="top"><?php echo $mayy =  ($may/$sum)*100;?></div>
                                  </div>
                                  <div class="bar ">
                                      <div class="title">JUN</div>
                                      <div class="value tooltips" data-original-title="<?php echo $jun ?>" data-toggle="tooltip" data-placement="top"><?php echo $junn =  ($jun/$sum)*100;?></div>
                                  </div>
                                  <div class="bar">
                                      <div class="title">JUL</div>
                                      <div class="value tooltips" data-original-title="<?php echo $jul ?>" data-toggle="tooltip" data-placement="top"><?php echo $jull =  ($jul/$sum)*100;?></div>
                                  </div>
                                  <div class="bar">
                                      <div class="title">AUG</div>
                                      <div class="value tooltips" data-original-title="<?php echo $aug ?>" data-toggle="tooltip" data-placement="top"><?php echo $augg =  ($aug/$sum)*100;?></div>
                                  </div>
                                  <div class="bar">
                                      <div class="title">SEPT</div>
                                      <div class="value tooltips" data-original-title="<?php echo $sep ?>" data-toggle="tooltip" data-placement="top"><?php echo $sepp =  ($sep/$sum)*100;?></div>
                                  </div>
                                  <div class="bar">
                                      <div class="title">OCT</div>
                                      <div class="value tooltips" data-original-title="<?php echo $oct ?>" data-toggle="tooltip" data-placement="top"><?php echo $octt =  ($oct/$sum)*100;?></div>
                                  </div>
                                  <div class="bar">
                                      <div class="title">NOV</div>
                                      <div class="value tooltips" data-original-title="<?php echo $nov ?>" data-toggle="tooltip" data-placement="top"><?php echo $novv =  ($nov/$sum)*100;?></div>
                                  </div>
                                  <div class="bar">
                                      <div class="title">DEC</div>
                                      <div class="value tooltips" data-original-title="<?php echo $dec ?>" data-toggle="tooltip" data-placement="top"><?php echo $decc =  ($dec/$sum)*100;?></div>
                                  </div>
                              </div>
                              <!--custom chart end-->
        					</div><!-- /row -->


 </div>
<!-- Navigation -->
          <div class="col-md-3">

      				    <div class="panel panel-success">
      						  <div class="panel-heading">
      							<h3 class="panel-title"> Navigation </h3>
      						  </div>
      						  <div class="panel-body" style="height:auto">
      						  <?php  include 'nav.php'; ?>

      							</div>
      					</div>


                <!-- CALENDAR-->



                        <div class="panel panel-default panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i>Calendar</h3>
                            </div>
                            <div class="panel-body">
                                <div><?php include ('calendar/index.php');?></div>


                            </div>
                        </div>








<!-- / calendar -->


          </div>
  </div>

  <?php } else{?>
<div class="col-lg-12 center alert danger"> Access to the page is denied. Only allowed to administrators </div>

    <?php
  }
      include 'footer.php';
      ?>

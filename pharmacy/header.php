<?php session_start();
  require_once('../functions.php');
  require_once '../config.php';

                    $loo = $_SESSION['email'];
                    $re = 0;
                    $ree = 1;
                    try {
                      $sql = " SELECT * FROM message WHERE too ='{$loo}' ORDER BY time desc  Limit 5 ";
                      $stmt = $DB->prepare($sql);
                      $stmt->execute();
                      $msges = $stmt->fetchAll();
                      // $tt_count = count($stmt->fetchAll());
                    } catch (Exception $ex) {
                      echo $ex->getMessage();
                    }


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> KENYA MRS </title>

    <!-- Bootstrap Core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <!-- Custom CSS -->
    <!-- <link href="bootstrap/css/small-business.css" rel="stylesheet"> -->
          <script src="jquery-1.9.0.min.js"></script>
             <!-- // <script src="jquery.js"></script> -->
              <script src="../elements/jquery.validate.js"></script>
             <script src="../elements/ckeditor/ckeditor.js"></script>
             <script type="text/javascript" src="../elements/jQuery.print.js"></script>
             <link href="../elements/jquery-ui.css" rel="stylesheet">
             <link href="CLEditor/jquery.cleditor.css" rel="stylesheet">
             <link rel="stylesheet" type="text/css" href="../elements/jquery.datetimepicker.css"/>

            <!-- // <script src="jquery-1.9.0.min.js"></script> -->
             <!-- // <script src="jquery.js"></script> -->
              <!-- // <script src="jquery.validate.js"></script> -->
             <script src="../elements/ckeditor/ckeditor.js"></script>
             <link href="../elements/jquery-ui.css" rel="stylesheet">
             <link rel="stylesheet" type="text/css" href="../elements/jquery.datetimepicker.css"/>

                <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <link href="../elements/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../elements/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../elements/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

   <script type="text/javascript">
          $(function() {
            $( "#dialog-1" ).dialog({
               autoOpen: false,
            });
            $( "#opener" ).click(function() {
               $( "#dialog-1" ).dialog( "open" );
            });
         });
}

</script>


</head>
<body>
    <div class="navbar navbar-default navbar-static-top navbar navbar-inverse header" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header container-fluid">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand collapse navbar-collapse" href="#" target="_blank"> <h4><span class="glyphicon glyphicon-user"> <?php echo ucwords($_SESSION['fname'].' '.$_SESSION['lname']); ?></span></h4></a>
        </div>
        <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1" >

                    <ul class="nav navbar-nav">


                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                      <?php foreach ($msges as $msg) {?>
                        <li class="message-preview">

                            <a href="../messages/send_message.php?mode=read">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong><?php echo $msg['fromm'];?></strong>
                                        </h5>
                  <?php
                    // $date1 = date('I Y-m-d h:i:s');
                    $d= $msg["time"];
                    $age = strtotime($d);
                    $date1 = date('l F d h:i', $age);
                  ?>

                                        <p class="small text-muted"><i class="fa fa-clock-o "> </i><?php echo ' '.$date1;?></p>
                                        <p><?php echo $msg['message']; ;?></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <?php } ?>

                        <li class="message-footer">
                            <a href="../messages/send_message.php?mode=read">Read All New Messages</a>
                        </li>
                    </ul>
                </li>

                 <li><a href="../admin/staffdedails.php"> Account </a></li>
               <?php if ($_SESSION['level']==5){?>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i>Modules <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="../reception/reception.php">Reception </a>
                        </li>
                        <li>
                            <a href="../nurse/index.php"> Nurse </a>
                        </li>
                        <li>
                            <a href="../doctor/index.php">Doctor </a>
                        </li>
                        <li>
                            <a href="../lab/index.php">Laboratory</a>
                        </li>
                        <li>
                            <a href="../pharmacy/index.php">Pharmacy</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>

                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo ucwords($_SESSION['fname'].' '.$_SESSION['lname']); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../admin/staffdedails.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="../messages/send_message.php?mode=read"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="../lock_screen.php"><i class="fa fa-fw fa-lock"></i> Lock Account </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>

            </ul>

                                        </li>

                                    </ul>


        </div>
      </div>
    </div>

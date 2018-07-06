<?php

require_once '../config.php';
require_once '../database_connection.php';
require_once '../functions.php';
include 'header.php';


?>

<?php
$loo = $_SESSION['email'];
try {
   $sql = "SELECT * FROM message WHERE too='{$loo}' ORDER BY time desc ";
   $stmt = $DB->prepare($sql);
   // $stmt->bindValue(":reg_no", intval($_GET["reg_no"]));
   
   $stmt->execute();
   $vist = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}  
?>




<div class="container">
<div class="row">
  <ul class="breadcrumb">
    <?php if($_SESSION['level']==0){ ?>
      <li><a href="../reception/reception.php">Home</a></li>
    <?php }elseif($_SESSION['level']==1){ ?> 
      <li><a href="../nurse/index.php">Home</a></li>
    <?php }elseif($_SESSION['level']==2){ ?>
      <li><a href="../doctor/index.php">Home</a></li>
    <?php }elseif($_SESSION['level']==3){ ?> 
      <li><a href="../pharmacy/index.php">Home</a></li>
    <?php }elseif($_SESSION['level']==4){ ?> 
      <li><a href="../lab/index.php">Home</a></li>
    <?php }elseif($_SESSION['level']==5){ ?>
      <li><a href="../admin/index.php">Home</a></li>
    <?php } ?>    
      <li class="active"> Inbox </li>
    </ul>
</div>
  <div class="row">

    <div class="col-md-5">
            <script src="jQuery.print.js"></script> 
            <script type="text/javascript" src="CLEditor/jquery.cleditor.min.js"></script>
            <script>
                $(document).ready(function() {
                  // $("#msg").cleditor({width: 410, height: 150});

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
<?php echo messages();?>
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Message Inbox </h3>
      </div>
      <div class="panel-body" style="height:auto">
                                  
                                  <div class="col-lg-13">
                                  <div id="accordion">
                                    <?php foreach ($vist as $vt) { 
                                       // $pherm = mysqli_fetch_assoc(issue_medication($vt["visit_no"]));
                                       //  $visit = mysqli_fetch_assoc(find_laboratory_result($vt["visit_no"]));
                                       //  $exam = mysqli_fetch_assoc(find_nurs($vt["visit_no"]));
                                       //  $recept = mysqli_fetch_assoc(find_patient($vt["reg_no"]));
                                     ?>
                                      <h3>From: <?php echo $vt["fromm"]; ?> <span class="glyphicon glyphicon-calendar pull-right"> <?php $d=strtotime($vt["time"]); echo date("d.m.Y", $d); ?> </span></h3>
                                      <div>
                                      <div id='print-div2' class="print_div">
                                        <!-- <strong><u><b>REF: MEDICAL REPORT</b></u></strong> -->
                                      <hr>
                                      From <?php echo $vt["fromm"]; ?>
                                      <br />
                                      To : <?php echo $vt["too"] ?>
                                      <br />
                                      Subject: <?php echo $vt["subject"]; ?>
                                      <br />
                                      DATE : <?php $ty=$vt["time"]; $syp = strtotime($ty); echo date("M.d.Y", $syp); ?>
                                      <br />
                                      Time :<?php $ty=$vt["time"]; $syp = strtotime($ty); echo date("H:m", $syp); ?> 
                                      <br />
                                      <br />
                                      Message:
                                      <br />
                                        <?php echo $vt['message']; ?>

                                      <br />
                                      <hr>
                                      Yours faithfully<br>
                                      <?php echo $vt['from']; ?>

                                      <br>
                                      </div>
                                      </div>
                                      <?php }; ?>
                                  </div>

                                      <br>
                                      </div>
                                        </div>
                                
                                <!-- </div> -->

                      

      </div>
      <script type="text/javascript">
        CKEDITOR.replace('msg');
      </script>
    <!-- </div> -->
   </div>

    <div class="col-md-7">
					         <?php
                    if ($_GET["msg"] == "success") {
                        echo successMessage("Email has been send successfully");
                    } elseif ($_GET["msg"] == "error") {
                        echo errorMessage("There was some problem sending mail");
                    }
                    ?>
			<div class="form-group">

          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title"> Send Email </h3>
                </div>
              <div class="panel-body" style="height:auto">
           <form action="process_mail.php" class="form-horizontal" method="post" name="f" onSubmit="return validateForm();">             
            <div class="form-group">
              <label class="col-lg-2 control-label"><span class="required">*</span> To :</label>
              <div class="col-lg-9">
                <input type="text" id="email" class="form-control" placeholder="email" name="email" >
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-2 control-label" for="middle_name"> Subject: </label>
              <div class="col-lg-9">
                <input type="text" id="subject" class="form-control" placeholder="Subject" name="subject" >
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-2 control-label" for="contact_no2">Message :</label>
              <div class="col-lg-9">
                    <textarea name="msg" class="msg" class="form-control" id="msg" style="width:200px;"> </textarea>              
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-2 control-label"><span class="glyphicon glyphicon-file pull-left"></span>Attmnt</label>
              <div class="col-lg-9">
                    <input type="file" name="attachment" class="attachment" class="form-control file" id="attachment"  >            
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-2 control-label" for="last_name"><span class="required"></span></label>
              <div class="col-lg-9">
                <input type="submit" name="send" Value="send" class="form-control btn-info">
              </div>
            </div>
              </form>
          </div>
        </div>  
        <script>
        CKEDITOR.replace('msg');
      
          function isValidEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
          }

        $("#msg").cleditor({width: 455, height: 250});
        // CKEDITOR.replace('msg');
         function validateForm() {

                var email = $.trim($("#email").val());
                var subject = $.trim($("#subject").val());
                var msg = $.trim($("#msg").val());

                if (email == "") {
                    alert("Please enter Receivers email.");
                    $("#email").focus();
                    return false;
                } else if (!isValidEmail(email)) {
                    $("#email").focus();
                    alert("Please enter a valid email Address.");
                    return false;
                }


                if (subject == "") {
                    $("#subject").focus();
                    alert("Enter subject line.");
                    return false;
                } else if (subject.length <= 4) {
                    $("#subject").focus();
                    alert("Subject line must be atleast 5 character.");
                    return false;
                }
                if (msg == "") {
                    $("#msg").focus();
                    alert("Enter Message.");
                    return false;
                } else if (msg.length <= 9) {
                    $("#msg").focus();
                    alert("Message must be atleast 10 character.");
                    return false;
                }

                return true;
            }


        </script>          
            

    </div>
	</div>
  </div>
  </div>
<script src="ckeditor/ckeditor.js"></script>  
<?php
include 'footer.php';
?>
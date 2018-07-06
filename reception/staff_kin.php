<?php

require_once '../config.php';
require_once '../functions.php';
include 'header.php';
if($_SESSION['level']==0 || $_SESSION['level']==5 ){

  if(isset($_GET['reg_no'])){
    $reg_no = $_GET['reg_no'];
  }else{
    echo "No id found";
  }

if (isset($_POST['okey'])){
  pre($_POST);
}

$res = mysqli_fetch_assoc(find_patient($reg_no));
?>

<div class="container">
      <div class="row">
        <ul class="breadcrumb">
            <li><a href="reception.php">Home</a></li>
            <li class="active"> New Patient </li>
          </ul>
      </div>

<div class="col-md-8">
  <div class="row">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo ucwords($res['first_name']." ".$res['last_name'].' Next of Kin')?> </h3>
      </div>
      <div class="panel-body">

        <form class="form-horizontal" autocomplete="off" name="f" onSubmit="return validateForm();" enctype="multipart/form-data" method="post" action="process_form.php">
          
          <fieldset>
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="profile_pic"> Passport :</label>
                            <div class="col-lg-5">
                              <input type="file"  id="profile_image" class="form-control file" name="profile_image">
                              <span class="help-block">Must be jpg, jpeg, png, gif, bmp image only.</span>
                            </div>
                          </div>

                         <div class="form-group">
                            <label class="col-lg-3 control-label" for="first_name"><span class="required">*</span>First Name:</label>
                            <div class="col-lg-5">
                              <input type="text" placeholder="First Name" id="first_name" class="form-control" name="first_name">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="middle_name">Last Name:</label>
                            <div class="col-lg-5">
                              <input type="text" placeholder="Last Name" id="last_name" class="form-control" name="last_name">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="last_name"><span class="required">*</span>PF No:</label>
                            <div class="col-lg-5">
                              <input type="text" readonly=""id="reg_no" value="<?php echo $reg_no ?>" class="form-control" name="reg_no">
                            </div>
                            </div>

                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="d_o_b"><span class="required">*</span> Date OF Birth:</label>
                            <div class="col-lg-5">
                              <div class="input-group">
                              <input type="text" id="datetimepicker2" placeholder="Must be Valid year below <?php echo date("Y");?>" id="d_o_b" class="form-control" name="d_o_b" /><span id="datepicker" class="input-group-addon glyphicon glyphicon-calendar"></span> 
                              <!-- <span id="datepicker" class="input-group-addon glyphicon glyphicon-calendar"></span> -->
                              </div>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="contact_no1"><span class="required"></span>Contact</label>
                            <div class="col-lg-5">
                              <input type="text"  placeholder="Contact Number" id="contact" class="form-control" name="contact"><span id="contact_err" class="error"></span>
                              <span class="help-block">Maximum of 10 digits only and only numbers.</span>
                            </div>
                          </div>

                          <div class="form-group">
                                <label class="col-lg-3 control-label" for="course"> Ralationship </label>
                                <div class="col-lg-5">
                                  <select class="form-control" id="rship" name="rship">
                                        <option value=''> Ralationship </option>
                                        <option value='wife'> WIFE </option>
                                        <option value='son'> SON </option>
                                        <option value='daughter'> DAUGHTER </option>
                                  </select><span id="fuculty_err" class="error"></span>
                                </div>
                              </div>
                          
                          
                
                          <div class="form-group">
                            <label class="col-lg-3 control-label" for="course"><span class="required">*</span> Sex </label>
                            <div class="col-lg-5">
                              <div id="radioset">
                                <input type="radio" id="radio1" value="M" name="sex"><label for="radio1">Male</label>
                                <input type="radio" id="radio2" value="F" name="sex"><label for="radio2">Female</label>
                          </div>
                          </div>
                          </div>
                

            
                            <div class="form-group">
                              <label class="col-lg-3 control-label" for="address">Health Information</label>
                              <div class="col-lg-5">
                                <textarea id="address" name="health_info" id="heal" style="resize:none" rows="3" class="form-control"></textarea>
                              </div>
                            </div> 
            
            <div class="form-group">
              <div class="control-label col-lg-7"><input type="checkbox" name="new" value='add'> Add some more Next of Kin.</div>
            </div>  

            <div class="form-group">
              <div class="col-lg-3 col-lg-offset-4">
                <input type="submit" name="kin" class="btn btn-primary" value="Add <?php echo ucwords($res['first_name'].' Next of Kin')?>"</>

              </div>
            </div>
          </fieldset>
        </form>

      </div>
    </div>
  </div>
</div>
<div class="col-md-4">
  <?php echo messages(); ?>
  <div class="panel panel-success">
    <div class="panel-heading">
     <h3 class="panel-title">Navigation</h3>
      </div>
          <div class="panel-body">
            <ul class="nav nav-list ">
                <ul class="nav nav-pills nav-stacked">
<?php
$loo = $_SESSION['email'];
$re = 0;
$ree = 1;
try {
  $sql = " SELECT * FROM message WHERE too ='{$loo}' AND `read` ='{$ree}' ";
  $stmt = $DB->prepare($sql);
  $stmt->execute();
  $total_count = count($stmt->fetchAll());
} catch (Exception $ex) {
  echo $ex->getMessage();
} 

try {
  $sql = " SELECT * FROM message WHERE too ='{$loo}' AND `read` ='{$re}' ";
  $stmt = $DB->prepare($sql);
  $stmt->execute();
  $tot_count = count($stmt->fetchAll());
} catch (Exception $ex) {
  echo $ex->getMessage();
} 
?>
                        <li><a href="reception.php"> Home  <span class="glyphicon glyphicon-home pull-right"></a></li>
                        <li><a href="add_patient.php"> Add patient <span class="glyphicon glyphicon-plus pull-right"></span></a></li>
                        <li><a href="add_patient2.php"> Add patient Staff <span class="glyphicon glyphicon-plus pull-right"></span></a></li>
                        <li><a href="daily_record.php"> Today's Record <span class="glyphicon glyphicon-sort pull-right"></span></a></li>
                        <li><a href="birth_day.php"> Birthday's <span class="glyphicon glyphicon-bell pull-right"></a></li>
                        <li><a href="../messages/send_message.php?mode=read"> Messages <?php if($tot_count > 0){ ?>
                          <span class="required badge pull-right"><?php echo ($tot_count.'/'.$total_count);?></span>
                          <?php }elseif($tot_count==0){ ?>
                          <span class="badge pull-right"><?php echo ($tot_count.'/'.$total_count);?></span>
                          <?php }; ?>
                        </a></li>
                        <li><a href="../messages/mail.php"> Send Email <span class="glyphicon glyphicon-envelope pull-right"></a></li>
                        
                    </ul>
            </ul>
          </div>
  </div>

      </div>  
</div>  
  <script>
          function isValidEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
          }

         function validateForm() {

                var first = document.forms['f']['first_name'].value;
                var last = document.forms['f']['last_name'].value;
                var reg_no = document.forms['f']['reg_no'].value;
                var rship = document.forms['f']['rship'].value;
                var sex = document.forms['f']['sex'].value;
                var dob = document.forms['f']['d_o_b'].value;
                var contact = document.forms['f']['contact'].value;

                if (first == "") {
                    alert("First Name cannot be blank.");
                    $("#first_name").focus();
                    return false;
                } else if (first.length < 3) {
                    $("#first_name").focus();
                    alert("First name cannot be less than 3 characters.");
                    return false;
                }

                if (last == "") {
                    alert("Last name cannot be blank.");
                    $("#last_name").focus();
                    return false;
                } else if (last.length < 3) {
                    alert("Last name cannot be less than 3 characters.");
                    $("#last_name").focus();
                    return false;
                }

                if (reg_no == "") {
                    alert("We didnt catch your PF number well.");
                    $("#reg_no").focus();
                    return false;
                }
             
                if (dob == "") {
                    $("#d_o_b").focus();
                    alert("Please enter a date of Birth.");
                    return false;
                }
                if(!contact== ''){
                    if (contact.length < 9) {
                        $("#contact").focus();
                        alert("contact must be 10 character.");
                        return false;
                    } else if (contact.length > 10) {
                        $("#contact").focus();
                        alert("contact must be 10 character.");
                        return false;
                    } else if (!$.isNumeric(contact) ) {
                        $("#contact").focus();
                        alert("Must be digits only.");
                        return false;
                    }
                 }  

                if (rship == "") {
                    $("#rship").focus();
                    alert("Please Select the ralationship.");
                    return false;
                }
                if (sex == "") {
                    $("#sex").focus();
                    alert("verify his/her sex.");
                    return false;
                }
 

                return true;
            }


        </script> 
</div>
  <?php } else{?>
<div class="col-lg-12 center alert danger"> Access to the page is denied. Only allowed to Receptionists</div>

    <?php
  }
      include 'footer.php';
      ?>
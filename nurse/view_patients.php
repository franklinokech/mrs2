<?php

require_once '../config.php';
require_once '../database_connection.php';
require_once '../functions.php';
include 'header.php';


 // if(isset($_GET['reg_no'])){
 //    $reg_no = $_GET['reg_no'];
 //  }else{
 //    echo "No id found"; 
 //  }

   if(isset($_GET['visit_no'])){
    $visit_no = $_GET['visit_no'];
  }else{
    echo "No id found"; 
  }

  $visit = mysqli_fetch_assoc(find_nurs($visit_no));
                                                    

?>
<?php 
 if (isset($_POST ['Update_visit'])){

  $bp = ($_POST['bp']);
  $temp = ($_POST['temp']);
  $visit_no = ($_POST['visit_no']);

  pre($_POST);
}
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

    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Patient </h3>
      </div>
      <div class="panel-body" style="height:auto">
       
         
      

            <div class="form-group">
              <?php
              $query = "SELECT * FROM visit WHERE visit_no='{$visit_no}' ";
               $staff = mysqli_fetch_assoc(mysqli_query($connection, $query));  
                 
                 $results = mysqli_fetch_assoc(find_patient($visit['reg_no']));
              
                ?>
              <label class="col-lg-4 control-label" for="profile_image"> </label>
              <div class="col-lg-5">
                <?php if ($results["profile_image"] == null ){ ?>
                   <img  src="../profile_image/no_avatar.png" class="thumbnail" alt="profile pick" width="100px" height="100px" >
                <?php }else{ ?>
                   <a href="../profile_image/<?php echo $results['profile_image']?>" target="_blank"><img  src="../profile_image/<?php echo $results['profile_image']?>" alt="" width="100" height="100px" class="thumbnail img-circle" ></a>
               <?php }?>
              </div>
            </div>


            <div class="form-group">
              <label class="col-lg-4 control-label" for="first_name"><span class="required"></span> Name:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" placeholder="First Name" value="<?php echo $results["first_name"] ?> <?php echo $results[0]["last_name"] ?>" id="first_name" class="form-control" name="first_name"><span id="first_name_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="middle_name"> Last Name: </label>
              <div class="col-lg-5">
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
              <label class="col-lg-4 control-label" for="contact_no2"> Age :</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $age.' yrs' ?>" placeholder="Contact Number"  class="form-control"><span id="contact_no2_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="last_name"><span class="required"></span>Registration No#:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results["reg_no"] ?>" placeholder="Last Name" name="rg_no"  class="form-control"><span id="last_name_err" class="error"></span>
              </div>
            </div>
            
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="email_id">Email Address :</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results["email"] ?>" placeholder="Email ID" class="form-control"><span id="email_id_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="contact_no1">Contact No#:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results["contact"] ?>" placeholder="Contact Number"  class="form-control" ><span id="contact_no1_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="contact_no2">Course :</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results["course"] ?>" placeholder="Curse" class="form-control" >
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="address">Address:</label>
              <div class="col-lg-5">
              <input type="text" readonly="" value="<?php echo $results["address"] ?>" placeholder="Curse" class="form-control" >
              </div>

            </div>
          </fieldset>

      </div>
    </div>
   </div>

    <div class="col-md-4">
                 <?php echo messages(); ?>
                <!-- <div class="alert alert-info" ><span id="ct" ></span></div> -->
            <?php
                  // echo $results["reg_no"]; ;
                
                $visits = mysqli_fetch_assoc(find_visit_no($staff['$reg_no']));
                      // echo (count($visits));  
                $sql = "SELECT * FROM visit WHERE reg_no ='{$results['reg_no']}' ";
                $stmt = $DB->prepare($sql);
                $stmt->execute();
                $today = count($stmt->fetchAll());
            ?>
                

                    <ul class="nav nav-pills nav-stacked">

                      <li class="active"><a href="../result/specific_generate.php?reg_no=<?php echo $results["reg_no"]; ?>"> <i>Previous Visits</i> <span class="badge pull-right"> <?php echo $today; ?> </span></a></li>
                      
                    </ul>

                <h3 class="required"><marquee> <i>Medical Exermination results</i></marquee> </h3>
                  <form class="form-horizontal" autocomplete="off" name="f" onSubmit="return validateForm();"  method="post" action="process_form.php" >
                      <fieldset>

                              <div class="form-group">
                                  <label class="col-lg-4 control-label" for="bp"><span class="required">*</span>Blood pressure:</label>
                                  <div class="col-lg-5">
                                    <input type="text" placeholder="Blood pressure" id="bp" class="form-control" name="bp">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-lg-4 control-label" for="temp"><span class="required">*</span> Temp :</label>
                                  <div class="col-lg-5">
                                    <input type="text" placeholder="Temperature" id="temp" class="form-control" name="temp">
                                  </div>
                                </div>

                                

                                     
                                <input type="hidden" value="<?php echo $visit['visit_no'] ?>" required class="form-control" name="visit_no">
                                <input type="hidden" value="<?php echo ucwords($_SESSION['fname']." ".$_SESSION['lname'])?>" required class="form-control" name="examined_by">

                                    <input type="submit" class="btn btn-primary btn-lg pull-right" name="Update_visit" value="Update Results !" />
                      </fieldset>              
                </form>
    </div>
  </div>
  </div>
 <script>


  function validateForm() {

  var name = document.forms['f']['temp'].value;
  var name2 = document.forms['f']['bp'].value;


    if (name2 == "" ) {
        alert("Enter the blood pressure");
    $("#bp").focus();
      return false;
    }else if (name2.length < 2 ) {
    alert("Please provide a valid pressure.");
        $("#bp").focus();
     return false;
    }else if (!$.isNumeric(name2)) {
    alert("Must be digits Only.");
        $("#bp").focus();
     return false;
    }else if (name2 < 89 ) {
    alert("Please provide a valid pressure between 90-140 mmHg.");
        $("#bp").focus();
     return false;
    }else if (name2 > 140 ) {
    alert("Please provide a valid pressure cannot be more tahn 140 mmHg.");
        $("#bp").focus();
     return false;
    }

  if (name == "" ) {
        alert("Enter The tempereture please");
    $("#temp").focus();
      return false;
    }else if (name.length < 2 ) {
    alert("Please provide in decimal format.");
        $("#temp").focus();
     return false;
    }else if (!$.isNumeric(name)) {
    alert("Must be digits Only.");
        $("#temp").focus();
     return false;
    }else if (name < 30 ) {
    alert("Please provide  a valid Temperature.");
        $("#temp").focus();
     return false;
    }else if (name > 40 ) {
    alert("Temperature cannot be more than 40.");
        $("#temp").focus();
     return false;
    }

   

return true;
}


        </script> 

<?php
include 'footer.php';
?>
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


?>
<?php 
if (isset($_POST ['upload'])){
  $reg_no =  $_POST['reg_no'];
  $filename = "";
  $error = FALSE;

    if (is_uploaded_file($_FILES["profile_image"]["tmp_name"])) {
    $filename = time() . '_' . $_FILES["profile_image"]["name"];
    $filepath = '../profile_image/' . $filename;
    if (!move_uploaded_file($_FILES["profile_image"]["tmp_name"], $filepath)) {
      $error = TRUE;
    }
  }
    pre($_POST);
  if (!$error) {
    $sql = " UPDATE staff_patient SET profile_image= '{$filename}' where reg_no= '{$reg_no}'";

     try {
      $stmt = $DB->prepare($sql);

      
      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        // $_SESSION["errorType"] = "success";
        $_SESSION["message"] = "Profile Upload successfully.";
      } else {
        // $_SESSION["errorType"] = "danger";
        $_SESSION["message"] = "Failed to upload.";
      }
    } catch (Exception $ex) {
      $_SESSION["message"] = $ex->getMessage();
    }
  }
    redirect_to('edit_photo.php?reg_no='.$reg_no); 

}


?>



<div class="container">
<div class="row">
  <ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li><a href="staff_patient.php">Registered Staff</a></li>
    <li class="active">View Patient Details</li>
    </ul>
</div>

  <div class="row">
    <div class="col-md-7">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Patient</h3>
      </div>
      <div class="panel-body" style="height:auto">
 <div class="form-horizontal">      
          <fieldset>
      
            <div class="form-group">
              <?php  
                 $results = mysqli_fetch_assoc(find_patient_staff($reg_no));
              
                ?>
              <label class="col-lg-3 control-label" for="profile_image"> </label>
              <div class="col-lg-5">
                <?php if ($results["profile_image"] == null ){ ?>
                   <img  src="../profile_image/no_avatar.png" class="thumbnail" alt="profile pick" width="100px" height="100px" >
                <?php }else{ ?>
                   <a href="../profile_image/<?php echo $results['profile_image']?>" target="_blank"><img  src="../profile_image/<?php echo $results['profile_image']?>" alt="" width="100" height="100" class="thumbnail" ></a>
               <?php }?>
               
              </div>
            </div>


            <div class="form-group">
              <label class="col-lg-3 control-label" for="first_name"><span class="required"></span> Name:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" placeholder="First Name" value="<?php echo $results["first_name"] ?> <?php echo $results[0]["last_name"] ?>" id="first_name" class="form-control" name="first_name"><span id="first_name_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-3 control-label" for="middle_name"> Last Name: </label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results["last_name"] ?>"  class="form-control" >
              </div>
            </div>
                    <?php
                    $d=$results["d_o_b"];
                    $age = date_diff(date_create($d), date_create('today'))->y;
                    ?>

            <div class="form-group">
              <label class="col-lg-3 control-label" > Age :</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $age.' yrs' ?>" name="age"  class="form-control">
              </div>
            </div>
             
            <div class="form-group">
              <label class="col-lg-3 control-label"> Registration No#:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results["reg_no"] ?>"  class="form-control">
              </div>
            </div>
            
            
            <div class="form-group">
              <label class="col-lg-3 control-label" for="email_id">Email Address :</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results["email"] ?>" class="form-control">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-3 control-label" for="contact_no1">Contact No#:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results["contact"] ?>"  class="form-control" >
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-3 control-label" for="contact_no2">Depertment :</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results["fuculty"] ?>"class="form-control" >
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-3 control-label" for="address">Address:</label>
              <div class="col-lg-5">
              <input type="text" readonly="" value="<?php echo $results["address"] ?>" class="form-control" >
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 control-label" for="contact_no2">Status :</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results["status"] ?>" class="form-control" >
              </div>
            </div>
           
          </fieldset>
            </div>
      </div>
    </div>
   </div>

<div class="col-md-5">
<?php echo messages(); ?>   


<div class="panel panel-info ">
    <div class="panel-heading">
     <h3 class="panel-title">Profile View</h3>
    </div>
    <div class="panel-body">  

                <?php if ($results["profile_image"] == null ){ ?>
                   <img  src="../profile_image/no_avatar.png" class="thumbnail" alt="profile pick" width="200px" height="200px" >
                <?php }else{ ?>
                   <img  src="../profile_image/<?php echo $results['profile_image']?>" alt="" width="300px" height="300px" class="thumbnail" >
               <?php }?>

    </div>
    </div>


 
  <div class="panel panel-danger">
    <div class="panel-heading">
       <h3 class="panel-title">Update New Profile</h3>
    </div>
    <div class="panel-body">  
        <form class="form-horizontal" name="f" onSubmit="return validateForm();" enctype="multipart/form-data" method="post" action="edit_photo.php">
          
          <input type="hidden" name="reg_no" value="<?php echo $results["reg_no"] ?>" >
            <div class="form-group">
              <label class="col-lg-4 control-label" for="profile_pic">Profile picture:</label>
              <div class="col-lg-7">
                <input type="file"  id="profile_image" class="form-control file" name="profile_image">
                <span class="help-block">Must be jpg, jpeg, png, gif, bmp image only.</span>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-4 control-label"></label>
              <div class="col-lg-7">
                <input type="submit"  name="upload" class="btn btn-primary" value="Upload"</>
              </div>
            </div>            


        </form>  
    </div>
    </div>
    </div>

    </div>
  </div>
  </div>
  </div>
  </div>
<?php
include 'footer.php';
?>
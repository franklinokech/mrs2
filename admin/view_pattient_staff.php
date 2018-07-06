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
// echo $reg_no;

//     if (isset($_POST ['create_visit'])){
   
      
//       $reg_no = $_POST['rg_no'];
//       $reception = $_SESSION['name'];
//       $age = $_POST['age'];
//       $reception = $_POST['created_by'];
//         // pre($_POST);
//       // mysqli_select_db($DB, $database) or die(mysql_error());

//       $query = "INSERT INTO visit ( reg_no, created_by) VALUES ('{$reg_no}', '{$reception}')" ;
      
//       $result = $DB->prepare($query);
//       $result->execute();
//       $results = $result->rowCount();
    
//       $_SESSION['message'] = "The visit has been created succesfully!";

//       redirect_to('reception.php');
// }

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
    <div class="col-md-6">

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
              <label class="col-lg-2 control-label"></label> 
           <div class="col-lg-8">              
             <a href="edit_photo.php?reg_no=<?php echo $results["reg_no"]; ?>" > <u>Edit Profile Photo</u></a> || <a href="staff_kin_add.php?reg_no=<?php echo $results["reg_no"]; ?>" > <u>Add staff's next of kin</u></a>
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

<div class="col-md-6">
<?php
try {
   $sql = "SELECT * FROM staff_kin WHERE 1 AND reg_no ='{$reg_no}'";
   $stmt = $DB->prepare($sql);
   // $stmt->bindValue(":reg_no", intval($_GET["reg_no"]));
   
   $stmt->execute();
   $vistt = $stmt->fetchAll();
   $resu = count($vistt);
} catch (Exception $ex) {
  echo $ex->getMessage();
}

if ($resu> 0){  
?>

<div class="panel panel-info ">
    <div class="panel-heading">
     <h3 class="panel-title"><?php echo ucwords($results['first_name']." ".$results['last_name']);?>'s Next of Kin</h3>
    </div>
    <div class="panel-body">  
        <div class="pull-right" ><a href="staff_kin_add.php?reg_no=<?php echo $results['reg_no'];?>"><button class="btn-sm btn-success"><span class="glyphicon glyphicon-user"></span> Add more kins</button></a></div>
<table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Avater</th>
                <th>Name</th>
                <th>DOB</th>
                <th>R/ship</th>
                <th>T/Visits</th>
                <th>Action </th>
              </tr>
                <?php foreach ($vistt as $vt) { 
                    $reg_no = $vt['reg_no'];
              try {
                 $sql = "SELECT * FROM visit WHERE reg_no ='{$reg_no}'";
                 $stmt = $DB->prepare($sql);
                 // $stmt->bindValue(":reg_no", intval($_GET["reg_no"]));
                 
                 $stmt->execute();
                 $vi = $stmt->fetchAll();
                 $tt = count($vi);
              } catch (Exception $ex) {
                echo $ex->getMessage();
              }
              ?>
                <tr id="details" title="<?php include 'info_kin_staff.php'; ?>" >
                      <td>
                <?php if ($vt["profile_image"] == null ){ ?>
                   <img  src="../profile_image/no_avatar.png" alt="profile pick" width="50px" height="50px" >
                <?php }else{ ?>
                   <a href="../profile_image/<?php echo $vt['profile_image']?>" target="_blank"><img  src="../profile_image/<?php echo $vt["profile_image"]; ?>" alt="" width="50" height="50" ></a>
               <?php }?>
                      </td>
                      <td><a><span class="glyphicon glyphicon-user"></span> <?php echo ucwords($vt["first_name"].' '.$vt["last_name"]); ?></td></a>
                      <td><?php echo $vt["d_o_b"] ; ?></td>
                      <td><?php echo $vt["relationship"] ; ?></td>
                      <td><?php echo $tt; ?></td>
                      <td><a href="delete_kin.php?mode=delete & reg_no=<?php echo $results["reg_no"]; ?>"  onclick="return confirm('Are you sure?')"><button class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete </button></a>&nbsp;</td> 
               </tr>
  <?php } ?>
            </tbody></table>
          
                
    </div>
    </div>
 <?php };?> 

<?php
try {
   $sql = "SELECT * FROM visit WHERE 1 AND reg_no ='{$reg_no}' ORDER BY visit_no Desc LIMIT 5";
   $stmt = $DB->prepare($sql);
   $stmt->bindValue(":reg_no", intval($_GET["reg_no"]));
   
   $stmt->execute();
   $vist = $stmt->fetchAll();
   $resultt = count($vist);
} catch (Exception $ex) {
  echo $ex->getMessage();
}
?>

 <?php echo messages(); ?> 
  <div class="panel panel-danger">
    <div class="panel-heading">
       <h3 class="panel-title">Previous Visits <span class=" badge pull-right"><?php echo $resultt?></span></h3>
    </div>
    <div class="panel-body">  

<?php
if ($resultt> 0){  
?>
<table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                
                <th>Visit ID</th>
                <th>Date </th>

              </tr>
                <?php foreach ($vist as $vt) { ?>
                <tr>
                  <td><a href="view_visit.php?reg_no=<?php echo $results["reg_no"]; ?>&& visit_no=<?php echo $vt["visit_no"]; ?>"><?php echo $vt["visit_no"]; ?></a></td>
                  <td><?php $d=strtotime($vt["date"]); echo date("M. d. Y", $d); ?></td>
                </tr>
  <?php } ?>
            </tbody></table>
     <?php } else { ?>       
          <div class="well well-lg"> No Previous Visits records found for <br> <?php echo ucwords($results["first_name"].' '.$results["last_name"] ) ?> </div>    
      <?php }; ?>           
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
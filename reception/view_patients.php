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

    if (isset($_POST ['create_visit'])){
   
      
      $reg_no = $_POST['rg_no'];
      $reception = $_SESSION['name'];
      $age = $_POST['age'];
      $reception = $_POST['created_by'];
        // pre($_POST);
      // mysqli_select_db($DB, $database) or die(mysql_error());

      $query = "INSERT INTO visit ( reg_no, created_by) VALUES ('{$reg_no}', '{$reception}')" ;
      
      $result = $DB->prepare($query);
      $result->execute();
      $results = $result->rowCount();
    
      $_SESSION['message'] = "The visit has been created succesfully!";

      redirect_to('reception.php');
}

?>



<div class="container">
<div class="row">
  <ul class="breadcrumb">
    <?php if($_SESSION['username']==0){ ?>
      <li><a href="reception.php">Home</a></li>
      <li class="active">View Patient Details</li>
    <?php }elseif($_SESSION['username']==5){ ?>
    <li><a href="../admin/index.php">Home</a></li>
    <li><a href="../admin/student.php">Registered Patients</a></li>
    <li class="active">View Patient Details</li>
      <?php }; ?>  
      <!-- <li class="active">View Patient Details</li> -->
    </ul>
</div>

  <div class="row">
    <div class="col-md-8">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Patient</h3>
      </div>
      <div class="panel-body" style="height:auto">
       
          <fieldset>
      
<form class="form-horizontal" style="height:auto" name="vist_form" id="visit_form" enctype="multipart/form-data" method="post" action="view_patients.php">
            <div class="form-group">
              <?php  
                 $results = mysqli_fetch_assoc(find_patient($reg_no));
              
                ?>
              <label class="col-lg-4 control-label" for="profile_image"> </label>
              <div class="col-lg-5">
                <?php if ($results["profile_image"] == null ){ ?>
                   <img  src="../profile_image/no_avatar.png" class="thumbnail" alt="profile pick" width="100px" height="100px" >
                <?php }else{ ?>
                   <a href="../profile_image/<?php echo $results['profile_image']?>" target="_blank"><img  src="../profile_image/<?php echo $results['profile_image']?>" alt="" width="100" height="100" class="thumbnail" ></a>
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
                <input type="text" readonly="" value="<?php echo $age.' yrs' ?>" name="age"  class="form-control">
              </div>
            </div>
             
            <div class="form-group">
              <label class="col-lg-4 control-label" for="last_name"><span class="required"></span>Registration No#:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results["reg_no"] ?>" placeholder="Last Name" name="rg_no"  class="form-control"><span id="last_name_err" class="error"></span>
              </div>
            </div>
            
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="email_id"><span class="required"></span>Email Address :</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results["email"] ?>" placeholder="Email ID" class="form-control"><span id="email_id_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="contact_no1"><span class="required">*</span>Contact No#:</label>
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
      <!-- </div> -->
    </div>
   </div>

<div class="col-md-4">
 <?php echo messages(); ?> 
  <div class="panel panel-danger">
    <div class="panel-heading">
           
 
      <h3 class="panel-title">Previous Visits</h3>
    </div>
    <div class="panel-body">  

<?php
try {
   $sql = "SELECT * FROM visit WHERE 1 AND reg_no ='{$reg_no}'";
   $stmt = $DB->prepare($sql);
   $stmt->bindValue(":reg_no", intval($_GET["reg_no"]));
   
   $stmt->execute();
   $vist = $stmt->fetchAll();
   $resultt = count($vist);
} catch (Exception $ex) {
  echo $ex->getMessage();
}

if ($resultt> 0){  
?>


<table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
          
                <th>Visit ID</th>
                <th>Date </th>
                <th>Action </th>

              </tr>
                <?php foreach ($vist as $vt) { ?>
                <tr>
                  <td><?php echo $vt["visit_no"]; ?></td>
                  <td><?php $d=strtotime($vt["date"]);
                       echo date("d.m.Y", $d); ?></td>
                       <input type="hidden" value="<?php echo ucwords($_SESSION['fname']." ".$_SESSION['lname']); ?>" name="created_by">
                  <td>
                    <a class="btn btn-sm btn-info" href="view_visits.php?reg_no=<?php echo $results["reg_no"]; ?>&&visit_no=<?php echo $vt["visit_no"];?>"><span class="glyphicon glyphicon-zoom-in"></span> View</a>
                  </td>
                </tr>
  <?php } ?>
            </tbody></table>
     <?php } else { ?>       
          <div class="well well-lg"> No Previous Visits records found for <br> <?php echo ucwords($results["first_name"].' '.$results["last_name"] ) ?> </div>    
      <?php }; ?>           
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-primary " onClick="return confirm('Are youn sure?')" name="create_visit" value="Create new Visit !" /></p>
                </form>
    </div>
    </div>
    <!-- </div> -->
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

<div class="panel panel-danger">
    <div class="panel-heading">
     <h3 class="panel-title"><?php echo ucwords($results['first_name']." ".$results['last_name']);?>'s Next of Kin</h3>
    </div>
    <div class="panel-body">  

<table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
          
                <th>Name</th>
                <th>DOB</th>
                <th>Action </th>

              </tr>
                <?php foreach ($vistt as $vt) { ?>
                <tr>
                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="process_form.php">
              <input type="hidden" value="<?php echo $results["reg_no"] ?>" name="reg_no">
              <input type="hidden" value="<?php echo ucwords($_SESSION['fname']." ".$_SESSION['lname']); ?>" name="created_by">
                  <td><?php echo ucwords($vt["first_name"].' '.$vt["last_name"]); ?></td>
                  <td><?php echo $vt["d_o_b"] ; ?></td>
                  <td>
                    <input type="submit" class="btn btn-primary " onClick="return confirm('Create visit for <?php echo ucwords($vt["first_name"].' '.$vt["last_name"]); ?>?')" name="kin_visit" value="Create Visit !" />
                    <!-- <a class="btn btn-sm btn-success" onClick="return confirm('Create visit for <?php echo ucwords($vt["first_name"].' '.$vt["last_name"]); ?>?')" href="process_form.php?mode=created&& reg_no=<?php echo $results["reg_no"]; ?>"><span class="glyphicon glyphicon-plus"></span> Create Visit</a> -->
                  </td>
                </form>  
                </tr>
  <?php } ?>
            </tbody></table>
     <?php };?>       
                
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
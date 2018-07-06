<?php

require_once '../functions.php';
require_once '../config.php';
include 'header.php';
include 'query.php';

if($_SESSION['level']==5){

?>

<?php
  if(isset($_GET['page'])){
    $current_page = $_GET['page'] - 1;
  }else{
    $current_page = 0;
  }

  if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
  }else{
    $mode=a;
  }  
                    
?>

<div class="container">


  <div class="row">
<?php echo messages(); ?>
    <div class="col-md-4">

    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title"> Todays Data </h3>
      </div>
      <div class="panel-body" style="height:auto">
       
         
	      <div class="clearfix"></div>
        <?php if($mode==a){ ?>
                      <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="dailly.php?mode=a"> Total Visits <span class="badge pull-right"><?php echo $today_visit ;?></span></a></li>
                        <li><a href="dailly.php?mode=b"> Cleared visits <span class="badge pull-right"><?php echo $today_cleared ;?></span></a></li>
                        <li><a href="dailly.php?mode=c"> Total examined Patients <span class="badge pull-right"><?php echo $today_examined;?></span></a></li>
                        <li><a href="dailly.php?mode=d"> Total Active Visits <span class="badge pull-right"><?php echo $today_active;?></span></a></li>
                        <li><a href="dailly.php?mode=e"> Laboratory test done <span class="badge pull-right"><?php echo $today_lab_done;?></span></a></li>
                        <li><a href="dailly.php?mode=f"> Waiting Results <span class="badge pull-right"><?php echo $today_lab_wait;?></span></a></li>
                        
                    </ul> 
        <?php }elseif($mode==b){ ?>
                      <ul class="nav nav-pills nav-stacked">
                        <li><a href="dailly.php?mode=a"> Total Visits <span class="badge pull-right"><?php echo $today_visit ;?></span></a></li>
                        <li class="active"><a href="dailly.php?mode=b"> Cleared visits <span class="badge pull-right"><?php echo $today_cleared ;?></span></a></li>
                        <li><a href="dailly.php?mode=c"> Total examined Patients <span class="badge pull-right"><?php echo $today_examined;?></span></a></li>
                        <li><a href="dailly.php?mode=d"> Total Active Visits <span class="badge pull-right"><?php echo $today_active;?></span></a></li>
                        <li><a href="dailly.php?mode=e"> Laboratory test done <span class="badge pull-right"><?php echo $today_lab_done;?></span></a></li>
                        <li><a href="dailly.php?mode=f"> Waiting Results <span class="badge pull-right"><?php echo $today_lab_wait;?></span></a></li>
                        
                    </ul> 
        <?php }elseif($mode==c){ ?>
                      <ul class="nav nav-pills nav-stacked">
                        <li><a href="dailly.php?mode=a"> Total Visits <span class="badge pull-right"><?php echo $today_visit ;?></span></a></li>
                        <li><a href="dailly.php?mode=b"> Cleared visits <span class="badge pull-right"><?php echo $today_cleared ;?></span></a></li>
                        <li class="active"><a href="dailly.php?mode=c"> Total examined Patients <span class="badge pull-right"><?php echo $today_examined;?></span></a></li>
                        <li><a href="dailly.php?mode=d"> Total Active Visits <span class="badge pull-right"><?php echo $today_active;?></span></a></li>
                        <li><a href="dailly.php?mode=e"> Laboratory test done <span class="badge pull-right"><?php echo $today_lab_done;?></span></a></li>
                        <li><a href="dailly.php?mode=f"> Waiting Results <span class="badge pull-right"><?php echo $today_lab_wait;?></span></a></li>
                        
                    </ul> 
        <?php }elseif($mode==d){ ?>
                      <ul class="nav nav-pills nav-stacked">
                        <li><a href="dailly.php?mode=a"> Total Visits <span class="badge pull-right"><?php echo $today_visit ;?></span></a></li>
                        <li><a href="dailly.php?mode=b"> Cleared visits <span class="badge pull-right"><?php echo $today_cleared ;?></span></a></li>
                        <li><a href="dailly.php?mode=c"> Total examined Patients <span class="badge pull-right"><?php echo $today_examined;?></span></a></li>
                        <li class="active"><a href="dailly.php?mode=d"> Total Active Visits <span class="badge pull-right"><?php echo $today_active;?></span></a></li>
                        <li><a href="dailly.php?mode=e"> Laboratory test done <span class="badge pull-right"><?php echo $today_lab_done;?></span></a></li>
                        <li><a href="dailly.php?mode=f"> Waiting Results <span class="badge pull-right"><?php echo $today_lab_wait;?></span></a></li>
                        
                    </ul> 
        <?php }elseif($mode==e){ ?>
                      <ul class="nav nav-pills nav-stacked">
                        <li><a href="dailly.php?mode=a"> Total Visits <span class="badge pull-right"><?php echo $today_visit ;?></span></a></li>
                        <li><a href="dailly.php?mode=b"> Cleared visits <span class="badge pull-right"><?php echo $today_cleared ;?></span></a></li>
                        <li><a href="dailly.php?mode=c"> Total examined Patients <span class="badge pull-right"><?php echo $today_examined;?></span></a></li>
                        <li><a href="dailly.php?mode=d"> Total Active Visits <span class="badge pull-right"><?php echo $today_active;?></span></a></li>
                        <li class="active"><a href="dailly.php?mode=e"> Laboratory test done <span class="badge pull-right"><?php echo $today_lab_done;?></span></a></li>
                        <li><a href="dailly.php?mode=f"> Waiting Results <span class="badge pull-right"><?php echo $today_lab_wait;?></span></a></li>
                        
                    </ul> 
        <?php }elseif($mode==f){ ?>
                      <ul class="nav nav-pills nav-stacked">
                        <li><a href="dailly.php?mode=a"> Total Visits <span class="badge pull-right"><?php echo $today_visit ;?></span></a></li>
                        <li><a href="dailly.php?mode=b"> Cleared visits <span class="badge pull-right"><?php echo $today_cleared ;?></span></a></li>
                        <li><a href="dailly.php?mode=c"> Total examined Patients <span class="badge pull-right"><?php echo $today_examined;?></span></a></li>
                        <li><a href="dailly.php?mode=d"> Total Active Visits <span class="badge pull-right"><?php echo $today_active;?></span></a></li>
                        <li><a href="dailly.php?mode=e"> Laboratory test done <span class="badge pull-right"><?php echo $today_lab_done;?></span></a></li>
                        <li class="active"><a href="dailly.php?mode=f"> Waiting Results <span class="badge pull-right"><?php echo $today_lab_wait;?></span></a></li>
                        
                    </ul> 
        <?php }?>
  

	      </div>
    </div>
   </div>

<div class="col-md-5">
   <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">View here </h3>
      </div>
      <div class="panel-body" style="height:auto">

        <div class="clearfix"></div>

        <?php if($mode==a){ ?>
            <?php if($today_visit !==0){ ?>
<?php
try {
   $sql = "SELECT * FROM visit WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) ORDER BY visit_no DESC";
   $stmt = $DB->prepare($sql);
   // $stmt->bindValue(":reg_no", intval($_GET["reg_no"]));
   
   $stmt->execute();
   $vist = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}  
?>
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Visit No#</th>
                <th>Name</th>
              </tr>
                <?php foreach ($vist as $res) { 
                  $recept = mysqli_fetch_assoc(find_patient($res['reg_no']));
                  ?>
                <tr>
                  <td style="text-align: center;"><?php echo $res["visit_no"]; ?></td>
                  <td><a href="../result/print_result.php?reg_no=<?php echo $res["reg_no"]; ?>&&visit_no=<?php echo $res["visit_no"]; ?>"><?php echo ucwords($recept["first_name"] ." ".$recept["last_name"]); ?></a></td>
                <?php }; ?>  
                </tr>
               </tbody></table>
        </div> 
            <?php }else{ ?>
              <div class="well well-lg"> Result is empty </div>
            <?php };?>


        <?php }elseif($mode==b){ ?>
            <?php if($today_cleared !==0){ ?>
<?php
try {
   $sql = "SELECT * FROM visit WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended=3";
   $stmt = $DB->prepare($sql);
   // $stmt->bindValue(":reg_no", intval($_GET["reg_no"]));
   
   $stmt->execute();
   $today_cleareds = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}  
?>
            
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Visit No#</th>
                <th>Name</th>
              </tr>
                <?php foreach ($today_cleareds as $res) { 
                  $recept = mysqli_fetch_assoc(find_patient($res['reg_no']));
                  ?>
                <tr>
                  <td style="text-align: center;"><?php echo $res["visit_no"]; ?></td>
                  <td><a href="../result/print_result.php?reg_no=<?php echo $res["reg_no"]; ?>&&visit_no=<?php echo $res["visit_no"]; ?>"><?php echo ucwords($recept["first_name"] ." ".$recept["last_name"]); ?></a></td>
                <?php }; ?>  
                </tr>
               </tbody></table>
        </div>
            <?php }else{ ?>
              <div class="well well-lg"> Result is empty </div>
            <?php };?>
        <?php }elseif($mode==c){ ?>
            <?php if($today_examined !==0){ ?>

<?php
try {
   $sql = "SELECT * FROM visit WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended=1";
   $stmt = $DB->prepare($sql);
   // $stmt->bindValue(":reg_no", intval($_GET["reg_no"]));
   
   $stmt->execute();
   $today_examineds = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}  
?>            
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Visit No#</th>
                <th>Name</th>
              </tr>
                <?php foreach ($today_examineds as $res) { 
                  $recept = mysqli_fetch_assoc(find_patient($res['reg_no']));
                  ?>
                <tr>
                  <td style="text-align: center;"><?php echo $res["visit_no"]; ?></td>
                  <td><a href="../result/print_result.php?reg_no=<?php echo $res["reg_no"]; ?>&&visit_no=<?php echo $res["visit_no"]; ?>"><?php echo ucwords($recept["first_name"] ." ".$recept["last_name"]); ?></a></td>
                <?php }; ?>  
                </tr>
               </tbody></table>
        </div>
            <?php }else{ ?>
              <div class="well well-lg"> Result is empty </div>
            <?php };?> 
        <?php }elseif($mode==d){ ?>
            <?php if($today_active !==0){ ?>
<?php
try {
   $sql = "SELECT * FROM visit WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended=0 or attended=1 or attended=2";
   $stmt = $DB->prepare($sql);
   // $stmt->bindValue(":reg_no", intval($_GET["reg_no"]));
   
   $stmt->execute();
   $active = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}  
?>            
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Visit No#</th>
                <th>Name</th>
              </tr>
                <?php foreach ($active as $res) { 
                  $recept = mysqli_fetch_assoc(find_patient($res['reg_no']));
                  ?>
                <tr>
                  <td style="text-align: center;"><?php echo $res["visit_no"]; ?></td>
                  <td><a href="../result/print_result.php?reg_no=<?php echo $res["reg_no"]; ?>&&visit_no=<?php echo $res["visit_no"]; ?>"><?php echo ucwords($recept["first_name"] ." ".$recept["last_name"]); ?></a></td>
                <?php }; ?>  
                </tr>
               </tbody></table>
        </div>
            <?php }else{ ?>
              <div class="well well-lg"> Result is empty </div>
            <?php };?> 
        <?php }elseif($mode==e){ ?>
            <?php if($today_lab_done !==0){ ?>
<?php
try {
   $sql = "SELECT * FROM laboratory_test WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended=2";
   $stmt = $DB->prepare($sql);
   // $stmt->bindValue(":reg_no", intval($_GET["reg_no"]));
   
   $stmt->execute();
   $today_lab_dones = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}  
?>            
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Visit No#</th>
                <th>Name</th>
              </tr>
                <?php foreach ($today_lab_dones as $res) { 
                  $recept = mysqli_fetch_assoc(find_patient($res['reg_no']));
                  ?>
                <tr>
                  <td style="text-align: center;"><?php echo $res["visit_no"]; ?></td>
                  <td><a href="../result/print_result.php?reg_no=<?php echo $res["reg_no"]; ?>&&visit_no=<?php echo $res["visit_no"]; ?>"><?php echo ucwords($recept["first_name"] ." ".$recept["last_name"]); ?></a></td>
                <?php }; ?>  
                </tr>
               </tbody></table>
        </div>
            <?php }else{ ?>
              <div class="well well-lg"> Result is empty </div>
            <?php };?>
        <?php }elseif($mode==f){ ?>
            <?php if($today_lab_wait !==0){ ?>
<?php
try {
   $sql = "SELECT * FROM laboratory_test WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended=1 or attended=0 ";
   $stmt = $DB->prepare($sql);
   // $stmt->bindValue(":reg_no", intval($_GET["reg_no"]));
   
   $stmt->execute();
   $today_lab_dones = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}  
?>            
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Visit No#</th>
                <th>Name</th>
              </tr>
                <?php foreach ($today_lab_waits as $res) { 
                  $recept = mysqli_fetch_assoc(find_patient($res['reg_no']));
                  ?>
                <tr>
                  <td style="text-align: center;"><?php echo $res["visit_no"]; ?></td>
                  <td><a href="../result/print_result.php?reg_no=<?php echo $res["reg_no"]; ?>&&visit_no=<?php echo $res["visit_no"]; ?>"><?php echo ucwords($recept["first_name"] ." ".$recept["last_name"]); ?></a></td>
                <?php }; ?>  
                </tr>
               </tbody></table>
        </div>
            <?php }else{ ?>
              <div class="well well-lg"> Result is empty </div>
            <?php };?>
        <?php }?>  

        </div>
    </div>
    </div>
    <div class="col-md-3">
				    <div class="panel panel-success">
						  <div class="panel-heading">
							<h3 class="panel-title"> Navigation </h3>
						  </div>
						  <div class="panel-body" style="height:auto">
                    <?php
                      include 'nav.php';
                    ?>				  
							</div>
					</div>
    </div>
  </div>
  </div>
  <?php } else{?>
<div class="col-lg-12 center alert danger"> Access to the page is denied. Only allowed to administrators </div>

    <?php
  }
      include 'footer.php';
      ?>
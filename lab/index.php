<?php

require_once '../config.php';
require_once '../functions.php';
include 'header.php';

if (!$_SESSION['level']){
  $_SESSION['message'] = 'You must Login';
  redirect_to('../login.php');
}else if($_SESSION['level']==2 || $_SESSION['level']==5 ){
/*******PAGINATION CODE STARTS*****************/
if (!(isset($_GET['pagenum']))) {
  $pagenum = 1;
} else {
  $pagenum = $_GET['pagenum'];
}
$page_limit = ($_GET["show"] <> "" && is_numeric($_GET["show"]) ) ? $_GET["show"] : 8;


try {
  $keyword = trim($_GET["keyword"]);
  if ($keyword <> "" ) {
    $sql = "SELECT * FROM student_patient WHERE 1 AND "
            . " (first_name LIKE :keyword) ORDER BY first_name ";
    $stmt = $DB->prepare($sql);
    
    $stmt->bindValue(":keyword", $keyword."%");
    
  } else { 
    $sql = "SELECT * FROM laboratory_test WHERE attended=0 or attended=1 ORDER BY visit_no Asc";
    $stmt = $DB->prepare($sql);
  }
  
  $stmt->execute();
  $total_count = count($stmt->fetchAll());

  $last = ceil($total_count / $page_limit);

  if ($pagenum < 1) {
    $pagenum = 1;
  } elseif ($pagenum > $last) {
    $pagenum = $last;
  }

  $lower_limit = ($pagenum - 1) * $page_limit;
  $lower_limit = ($lower_limit < 0) ? 0 : $lower_limit;


  $sql2 = $sql . " limit " . ($lower_limit) . " ,  " . ($page_limit) . " ";
  
  $stmt = $DB->prepare($sql2);
  
  if ($keyword <> "" ) {
    $stmt->bindValue(":keyword", $keyword."%");
   }
   
  $stmt->execute();
  $results = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}
/*******PAGINATION CODE ENDS*****************/
?>
<div class="row">
<?php
    if ($_GET["msg"] == "success") {
    echo successMessage("Card has been send successfully");
  } elseif ($_GET["msg"] == "error") {
    echo errorMessage("There was some problem sending mail");
  }
?>  
<?php if ($ERROR_MSG <> "") { ?>
    <div class="alert alert-dismissable alert-<?php echo $ERROR_TYPE ?>">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <p><?php echo $ERROR_MSG; ?></p>
    </div>
<?php } ?>
  <script type="text/javascript">
// function refresh(){
//   $("#reload").load('index.php');
// }
// setInterval ('refresh()' , 5000);

function refresh1 (){
  window.location.reload('index.php');
}
setInterval ('refresh1()' , 7000);
</script>

<div class="container">
      <div class="col-md-8">
        <?php echo messages(); ?>
  <div class="panel panel-primary">
    <div class="panel-heading">
      
      <h3 class="panel-title">Patient Queue List</h3>
    </div>
    <div class="panel-body">

      <div class="clearfix"></div>
<?php if (count($results) > 0) { ?>
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered ">
          <tbody><tr>
						<th>Visit No</th>
						<th>Name</th>
						<th>Status</th>
						<th>Action </th>
            </tr>
            <tr>
          <?php foreach ($results as $patient) {
            $pati = mysqli_fetch_assoc(find_patient($patient["reg_no"]));
           ?>

              				<td style="text-align: center;"><?php echo $patient["visit_no"]; ?></td>

						  <td><?php echo ucwords($pati["first_name"]. " ". $pati['last_name']); ?></td>
						 
						  <td><?php  if($patient["attended"]==0){
								  		echo "Unread";
								  }elseif ($patient["attended"]==1) {
								  	echo "Being Processed. Waiting..";
								  } ?></td>
						  <td>
							<a href="view_patients.php?reg_no=<?php echo $patient["reg_no"]; ?> && visit_no=<?php echo $patient["visit_no"]; ?> && attend=<?php echo $patient["attended"]; ?>"><button class="btn btn-sm btn-info"><span class="glyphicon glyphicon-zoom-in"></span> View</button></a>&nbsp;
						  </td>
            </tr>
            <?php }; ?>
          </tbody></table>
        </div>
        
<div class="col-lg-12 center">
          <ul class="pagination pagination-sm">
  <?php
  //Show page links
  for ($i = 1; $i <= $last; $i++) {
    if ($i == $pagenum) {
      ?>
                <li class="active"><a href="javascript:void(0);" ><?php echo $i ?></a></li>
                <?php
              } else {
                ?>
                <li><a href="index.php?pagenum=<?php echo $i; ?>&keyword=<?php echo $_GET["keyword"]; ?>" class="links"  onclick="displayRecords('<?php echo $page_limit; ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
                <?php
              }
            }
            ?>
          </ul>
        </div>

          <?php } else { ?>
        <div class="well well-lg"> No patient </div>
<?php } ?>
    </div>
  </div>

  </div>
<div class="col-md-4">
  <div class="panel panel-success">
              <div class="panel-heading">
              <h3 class="panel-title"> Navigation </h3>
              </div>
              <div class="panel-body" style="height:auto">
<?php

						  			$sql = "SELECT * FROM laboratory_test WHERE attended=1 ";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$total_count = count($stmt->fetchAll());

  									$sql = "SELECT * FROM laboratory_test WHERE attended=2  ";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$totl_count = count($stmt->fetchAll());

  									$sql = "SELECT * FROM laboratory_test WHERE attended=0  ";
    								$stmt = $DB->prepare($sql);
    								$stmt->execute();
  									$totla_count = count($stmt->fetchAll());


									$loo = $_SESSION['email'];
									$re = 0;
									$ree = 1;
									try {
									  $sql = " SELECT * FROM message WHERE too ='{$loo}' AND `read` ='{$ree}' ";
									  $stmt = $DB->prepare($sql);
									  $stmt->execute();
									  $tt_count = count($stmt->fetchAll());
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
						  
						                <ul class="nav nav-pills nav-stacked">
											  <li class="active"><a href="index.php"> Home  <span class="glyphicon glyphicon-home pull-right"></a></li>
											  <li><a href="#"> Unread Test request  <span class="badge pull-right"><?php echo $totla_count ; ?></span></a></li>
											  <li><a href="#"> Waiting Result  <span class="badge pull-right"><?php echo $total_count ; ?></span></a></li>
											  <li><a href="#"> Cleared Laboratory test <span class="badge pull-right"><?php echo $totl_count ; ?></span></a></li>
											  <li><a href="../messages/send_message.php?mode=read"> Messages <?php if($tot_count > 0){ ?>
						                          <span class="required badge pull-right"><?php echo ($tot_count.'/'.$tt_count);?></span>
						                          <?php }elseif($tot_count==0){ ?>
						                          <span class="badge pull-right"><?php echo ($tot_count.'/'.$tt_count);?></span>
						                          <?php }; ?>
						                        </a></li>
											  <li><a href="#"> Statistics </a></li>
										</ul>
              </div>
          </div>

      </div>  
</div>
  <?php } else{?>
<div class="col-lg-12 center alert danger"> Access to the page is denied. Only allowed to the Lab techs</div>

    <?php
  }
      include 'footer.php';
      ?>
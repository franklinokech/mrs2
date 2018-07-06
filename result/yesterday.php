<?php

require_once '../config.php';
require_once '../functions.php';
include 'header.php';
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
    $sql = "SELECT * FROM visit WHERE attended='3' "
            . " (reg_no LIKE :keyword) ORDER BY visit_no DESC ";
    $stmt = $DB->prepare($sql);
    
    $stmt->bindValue(":keyword", $keyword."%");
    
  } else {
    $varr=3;
    $sql = "SELECT * FROM visit WHERE date BETWEEN date_add(CURDATE(),INTERVAL -1 DAY) AND CURDATE() ORDER BY visit_no DESC ";
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
<?php
  $pherm = mysqli_fetch_assoc(issue_medication($res['visit_no']));
  $lab = mysqli_fetch_assoc(find_laboratory_result($res['visit_no']));
  // $exam = mysqli_fetch_assoc(find_nurs($results['visit_no']));
  $recept = mysqli_fetch_assoc(find_patient($res['reg_no']));
?>
<div class="row"style="margin-left:10px;margin-right:10px;">

<!-- <div class="container"> -->

  <ul class="breadcrumb">
    <?php if ($_SESSION['level']==5){ ?>
      <li><a href="../admin/index.php">Home</a></li>
      <?php }elseif ($_SESSION['level']==2) { ?>
      <li><a href="../doctor/index.php"> Home </a></li>
      <?php }elseif ($_SESSION['level']==0) { ?>
      <li><a href="../reception/reception.php">Home</a></li>
   <?php }; ?>
      <li class="active"> Cleared Patients </li>
    </ul>
<div class="col-md-9">
  <div class="panel panel-success">
    <div class="panel-heading">
      <?php echo messages(); ?>
      <h3 class="panel-title">Patient List</h3>
    </div>
    <div class="panel-body">

      <div class="col-lg-12" style="padding-left: 0; padding-right: 0;" >
        <form action="yesterday.php" method="get" >
        <div class="col-lg-6 pull-left"style="padding-left: 0;"  >
          <span class="pull-left">  
            <label class="col-lg-12 control-label" for="keyword" style="padding-right: 0;">
              <input type="text" value="<?php echo $_GET["keyword"]; ?>" placeholder="search by Reg No#" id="" class="form-control" name="keyword" style="height: 41px;">
            </label>
            </span>
          <button class="btn btn-info">search</button>
        </div>
        </form>
        
      </div>

      <div class="clearfix"></div>
<?php if (count($results) > 0) { ?>
        <!-- <div class="table-responsive"> -->
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Visit No#</th>
                <th>Avater</th>
                <th>Name</th>
                <th>Registration No# </th>
                <th>Date</th>
                <th>View Report</th>

              </tr>
                <?php foreach ($results as $res) { $recept = mysqli_fetch_assoc(find_patient($res['reg_no'])); ?>
                <tr>

                  <td style="text-align: center;"><?php echo $res["visit_no"]; ?></td>
                  <td><?php if ($recept["profile_image"] == null ){ ?>
                   <img  src="../profile_image/no_avatar.png" alt="profile pick" width="50px" height="50px" >
                <?php }else{ ?>
                   <a href="../profile_image/<?php echo $recept['profile_image']?>" target="_blank"><img  src="../profile_image/<?php echo $recept['profile_image']?>" alt="" width="50" height="50" ></a>
                   <?php } ?></td>
                  <td><?php echo ucwords($recept["first_name"] ." ".$recept["last_name"]); ?></td>
                  <td><?php echo $res["reg_no"]; ?></td>
                  <td><?php $d=strtotime($res["date"]);
                       echo date("d.m.Y", $d); ?></td>
                  <td>
                    <a href="print_result.php?visit_no=<?php echo $res["visit_no"]; ?> & reg_no=<?php echo $res["reg_no"]?>"><button class="btn btn-sm btn-info"><span class="glyphicon glyphicon-print"></span> Generate Report</button></a>&nbsp;
                  </td>
                </tr>
  <?php } ?>
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
                <li><a href="yesterday.php?pagenum=<?php echo $i; ?>&keyword=<?php echo $_GET["keyword"]; ?>" class="links"  onclick="displayRecords('<?php echo $page_limit; ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
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
<div class="col-md-3">
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">Navigation</h3>
    </div>
    <div class="panel-body">

<?php 
  require_once 'querry.php';
?>


    </div>
    </div> 
 </div>     
</div>
      <?php
      include 'footer.php';
      ?>
<?php

require_once '../config.php';
require_once '../functions.php';
include 'header.php';

if($_SESSION['level']==3 || $_SESSION['level']==5 ){
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
    $sql = "SELECT * FROM treatment WHERE prescription is NOT NULL AND attended=0  ORDER BY visit_no Asc";
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
    echo successMessage("Email has been send successfully");
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
          
            <th>Registration No# </th>
            <th>Action </th>
            </tr>
            <tr>
          <?php foreach ($results as $res) {
            $pati = mysqli_fetch_assoc(find_patient($res["reg_no"]));
           ?>

              <td style="text-align: center;"><?php echo $res["visit_no"]; ?></td>
              <td><?php echo ucwords($pati["first_name"]. " ". $pati['last_name']); ?></td>
             
              <td><?php echo $res["reg_no"]; ?></td>
              <td>
              <a href="view_patients.php?reg_no=<?php echo $res["reg_no"]; ?> && visit_no=<?php echo $res["visit_no"]; ?>"><button class="btn btn-sm btn-info"><span class="glyphicon glyphicon-zoom-in"></span> View</button></a>&nbsp;
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
<div class="panel panel-info">
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
  <?php } else{?>
<div class="col-lg-12 center alert danger"> Access to the page is denied. Only allowed to Pharmacists</div>

    <?php
  }
      include 'footer.php';
      ?>
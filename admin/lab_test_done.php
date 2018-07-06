<?php

require_once '../config.php';
require_once '../functions.php';
include 'header.php';

if($_SESSION['level']==5 ){
/*******PAGINATION CODE STARTS*****************/
if (!(isset($_GET['pagenum']))) {
  $pagenum = 1;
} else {
  $pagenum = $_GET['pagenum'];
}
$page_limit = ($_GET["show"] <> "" && is_numeric($_GET["show"]) ) ? $_GET["show"] : 20;


try {
  $keyword = trim($_GET["keyword"]);
  if ($keyword <> "" ) {
    $sql = "SELECT * FROM staff WHERE 1 AND "
            . " (first_name LIKE :keyword) ORDER BY first_name ";
    $stmt = $DB->prepare($sql);

    $stmt->bindValue(":keyword", $keyword."%");

  } else {
    $sql = "SELECT * FROM laboratory_test  ORDER BY `date` DESC ";
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
<div class="row" style="margin-left:10px; margin-right:10px;">
  <div class='container'>
<?php if ($ERROR_MSG <> "") { ?>
    <div class="alert alert-dismissable alert-<?php echo $ERROR_TYPE ?>">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <p><?php echo $ERROR_MSG; ?></p>
    </div>
<?php } ?>
</div>

<div class="row">
    <ul class="breadcrumb ">
      <li><a href="index.php">Home</a></li>
      <li class="active">Laboratory test </li>
    </ul>
<div class="col-md-9">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <?php echo messages(); ?>
      <h3 class="panel-title">Laboratory Test</h3>
    </div>
    <div class="panel-body">

      <div class="clearfix"></div>
<div id="visit" title="Test done"><?php include 'daily_content/view.php'; ?></div>
<?php if (count($results) > 0) { ?>
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Avatar</th>
                <th>Name</th>
                <th>date</th>
                <th>Subject</th>
                <th>Test(s)</th>
                <th>Result</th>

              </tr>
                <?php foreach ($results as $rest) {
                  $res = mysqli_fetch_assoc(find_patient($rest["reg_no"]));
                  ?>
                <tr>
                  <td style="text-align: center;">
              <?php if ($res["profile_image"] == null ){ ?>
                   <img  src="../profile_image/no_avatar.png" alt="profile pick" width="50px" height="50px" >
                <?php }else{ ?>
                   <a href="../profile_image/<?php echo $res['profile_image']?>" target="_blank"><img  src="../profile_image/<?php echo $res['profile_image']?>" alt="" width="50" height="50" ></a>
               <?php }?>
                  </td>
                  <td><?php echo ucwords ($res["first_name"].' '. $res["last_name"]); ?></td>
                  <td><?php $d = strtotime($rest["date"]);
                  echo date(' d/m/y ', $d );?></td>
                  <td> <ol>
                    <li>Submitted by: <?php echo $rest["submited_by"]; ?></li>
                    <li> Counducted by: <?php echo $rest["conducted_by"]; ?> </li>
                  </ol> </td>
                  <td><?php echo $rest["test"]; ?> </td>
                  <td> <?php echo $rest["result"]; ?> </td>
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
                <li><a href="lab_test_done.php?pagenum=<?php echo $i; ?>&keyword=<?php echo $_GET["keyword"]; ?>" class="links"  onclick="displayRecords('<?php echo $page_limit; ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
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
            <div class="panel panel-success">
              <?php echo messages(); ?>
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
<div class="col-lg-12 center alert danger"> Access to the page is denied. Only allowed to Receptionists</div>

    <?php
  }
      include 'footer.php';
      ?>

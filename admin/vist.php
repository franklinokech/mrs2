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
$page_limit = ($_GET["show"] <> "" && is_numeric($_GET["show"]) ) ? $_GET["show"] :4;


try {
  $keyword = trim($_GET["keyword"]);
  if ($keyword <> "" ) {
    $sql = "(SELECT reg_no, first_name, email, last_name, profile_image, d_o_b FROM student_patient WHERE 1 AND "
            . " (first_name LIKE :keyword) ORDER BY first_name) "
            . "UNION ALL (SELECT  reg_no, first_name, email, last_name, last_name, d_o_b  FROM staff_patient WHERE 1 AND "
            . " (first_name LIKE :keyword) ORDER BY first_name )";
    $stmt = $DB->prepare($sql);

    $stmt->bindValue(":keyword", $keyword."%");

  } else {
    $sql = "SELECT * FROM visit  ORDER BY `date` DESC ";
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
      <li class="active"> Attendance </li>
    </ul>
<div class="col-md-9">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <?php echo messages(); ?>
      <h3 class="panel-title"> Hospital attendance </h3>
    </div>
    <div class="panel-body">

      <div class="col-lg-12" style="padding-left: 0; padding-right: 0;" >
        <form action="vist.php" method="get" >
        <div class="col-lg-6 pull-left"style="padding-left: 0;"  >
          <span class="pull-left">
            <label class="col-lg-12 control-label" for="keyword" style="padding-right: 0;">
              <input type="text" value="<?php echo $_GET["keyword"]; ?>" placeholder="search by first name" id="" class="form-control" name="keyword" style="height: 41px;">
            </label>
            </span>
          <button class="btn btn-info">search</button>
        </div>
        </form>
      </div>

      <div class="clearfix"></div>
<div id="visit" title="Test done"><?php include 'daily_content/view.php'; ?></div>
<?php if (count($results) > 0) { ?>
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Avatar</th>
                <th>Name</th>
                <th>Date</th>
                <th>Contact</th>
                <th>Age</th>
                <th>Total visits</th>

              </tr>
                <?php foreach ($results as $rest) {
                  $res = mysqli_fetch_assoc(find_patient($rest["reg_no"]));
                  try {
                      $sql = " SELECT * FROM visit WHERE reg_no = '{$rest["reg_no"]}' ";
                          $stmt = $DB->prepare($sql);
                          $stmt->execute();
                        $user = count($stmt->fetchAll());
                  } catch (Exception $ex) {
                      echo $ex->getMessage();
                  }
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
                  <td><?php $d = strtotime($rest["date"]); echo date(' d/m/y ', $d );?></td>
                  <td><?php echo $res["contact"]; ?></td>
                      <?php $d=$res["d_o_b"];
                        $age = date_diff(date_create($d), date_create('today'))->y;
                      ?>
                  <td><?php echo $age; ?> </td>
                  <td> <?php echo $user; ?> </td>
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
                <li><a href="vist.php?pagenum=<?php echo $i; ?>&keyword=<?php echo $_GET["keyword"]; ?>" class="links"  onclick="displayRecords('<?php echo $page_limit; ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
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
<div class="col-lg-12 center alert danger"> Access to the page is denied. Only allowed to the Receptionists</div>

    <?php
  }
      include 'footer.php';
      ?>

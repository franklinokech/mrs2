
<?php

require_once '../config.php';
require_once '../functions.php';
include 'header.php';

if (!$_SESSION['level']){
  $_SESSION['message'] = 'You must Login';
  redirect_to('../login.php');
}
else if ($_SESSION['level']==0 || $_SESSION['level']==5 ){
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
    $sql = "(SELECT reg_no, first_name, email, last_name, profile_image FROM student_patient WHERE 1 AND "
            . " (first_name LIKE :keyword) ORDER BY first_name) "
            . "UNION ALL (SELECT  reg_no, first_name, email, last_name, last_name  FROM staff_patient WHERE 1 AND "
            . " (first_name LIKE :keyword) ORDER BY first_name )";
    $stmt = $DB->prepare($sql);

    $stmt->bindValue(":keyword", $keyword."%");

  } else {
    $sql = "(SELECT reg_no, first_name, last_name, email, profile_image FROM student_patient) union (SELECT reg_no, first_name, last_name, email, profile_image FROM staff_patient) ORDER BY first_name ";
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

<div class="container">
      <div class="col-md-8">
        <?php echo messages(); ?>
  <div class="panel panel-primary">
    <div class="panel-heading">

      <h3 class="panel-title">Patient List</h3>
    </div>
    <div class="panel-body">

      <div class="col-lg-12" style="padding-left: 0; padding-right: 0;" >
        <form action="reception.php" method="get" >
        <div class="col-lg-6 pull-left"style="padding-left: 0;"  >
          <span class="pull-left">
            <label class="col-lg-12 control-label" for="keyword" style="padding-right: 0;">
              <input type="text" id="autocomplete" value="<?php echo $_GET["keyword"]; ?>" placeholder="search by first name" id="" class="form-control" name="keyword" style="height: 41px;">
            </label>
            </span>
          <button class="btn btn-info">search</button>
        </div>
        </form>
        <div class="pull-right" ><a href="add_patient.php"><button class="btn btn-success"><span class="glyphicon glyphicon-user"></span> Add New Patient</button></a></div>
      </div>

      <div class="clearfix"></div>
<?php if (count($results) > 0) { ?>
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Avatar</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Registration No# </th>
                <th>Email </th>
                <th>Action </th>

              </tr>
                <?php foreach ($results as $res) { ?>
                <tr>
                  <td style="text-align: center;">
                     <?php if ($res["profile_image"] == null ){ ?>
                   <img  src="../profile_image/no_avatar.png" alt="profile pick" width="50px" height="50px" >
                <?php }else{ ?>
                   <a href="../profile_image/<?php echo $res['profile_image']?>" target="_blank"><img  src="../profile_image/<?php echo $res['profile_image']?>" alt="" width="50" height="50" ></a>
               <?php }?>

                  </td>
                  <td><?php echo $res["first_name"]; ?></td>
                  <td><?php echo $res["last_name"]; ?></td>
                  <td><?php echo $res["reg_no"]; ?></td>
                  <td><?php echo $res["email"]; ?></td>
                  <td>
                    <a href="view_patients.php?reg_no=<?php echo $res["reg_no"]; ?>"><button class="btn btn-sm btn-info"><span class="glyphicon glyphicon-zoom-in"></span> View</button></a>&nbsp;
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
                <li><a href="reception.php?pagenum=<?php echo $i; ?>&keyword=<?php echo $_GET["keyword"]; ?>" class="links"  onclick="displayRecords('<?php echo $page_limit; ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
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
     <h3 class="panel-title">Navigation</h3>
      </div>
          <div class="panel-body">
              <?php
              include 'nav.php';
              ?>
          </div>
  </div>

      </div>
</div>
  <?php } else {?>
<div class="col-lg-12 center alert-danger"> Access to the page is denied. Only allowed to the Receptionists</div>
</div>
    <?php
  }
      include 'footer.php';
      ?>

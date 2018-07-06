
<?php

require_once '../config.php';
require_once '../functions.php';
include 'header.php';

//////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET["del"]) && $_GET["del"] != "") {
    $s_no = $_GET["del"];
    $sql = "DELETE FROM  " . drugs . " WHERE `s_no` = '{$s_no}'";
    try {
        $stmt = $DB->prepare($sql);
        // $stmt->bindValue(":em", $email_id);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Deleted!!.";
        } else if ($stmt->rowCount() == 0) {
            $_SESSION["errorType"] = "warning";
            $_SESSION["errorMsg"] = "No changes affected";
        } else {
            $_SESSION["errorType"] = "danger";
            $_SESSION["errorMsg"] = "Failed.";
        }
    } catch (Exception $ex) {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = $ex->getMessage();
    }
} else if (isset($_GET["s_no"]) && $_GET["s_no"] != "") {
    $s_no = $_GET["s_no"];
    $status = $_GET["status"];
    if ($s_no <> "" && $status <> "") {
        $sql = "UPDATE  " . drugs . " SET status = '{$status}' WHERE `s_no` = '{$s_no}'";
        try {
            $stmt = $DB->prepare($sql);
            // $stmt->bindValue(":st", $status);
            // $stmt->bindValue(":em", $email_id);

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $_SESSION["errorType"] = "success";
                $_SESSION["errorMsg"] = "Status Change!.";
            } else if ($stmt->rowCount() == 0) {
            $_SESSION["errorType"] = "warning";
            $_SESSION["errorMsg"] = "No changes affected";
            } else {
            $_SESSION["errorType"] = "danger";
            $_SESSION["errorMsg"] = "Failed!!";
            }
        } catch (Exception $ex) {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = $ex->getMessage();
        }
    } else {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "All fields are required";
    }
}
/////////////////////////////////////////////////////////////////////////////////////

if($_SESSION['level']==3 || $_SESSION['level']==5 ){
/*******PAGINATION CODE STARTS*****************/
if (!(isset($_GET['pagenum']))) {
  $pagenum = 1;
} else {
  $pagenum = $_GET['pagenum'];
}
$page_limit = ($_GET["show"] <> "" && is_numeric($_GET["show"]) ) ? $_GET["show"] : 15;


try {
  $keyword = trim($_GET["keyword"]);
  if ($keyword <> "" ) {
    $sql = "SELECT * FROM drugs WHERE 1 AND  (drug LIKE :keyword) ORDER BY drug ";
    $stmt = $DB->prepare($sql);

    $stmt->bindValue(":keyword", $keyword."%");

  } else {
    $sql = "SELECT * FROM drugs  ORDER BY weight asc ";
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
<!-- <div class="container"> -->
<!-- <div class="container"> -->

<!-- </div> -->
<div class="row" style="padding-left: 10px; padding-right: 10px;">
      <div class="col-md-8">
        <?php echo messages(); ?>
  <div class="panel panel-primary">
    <div class="panel-heading">

      <h3 class="panel-title">Drug List</h3>
    </div>
    <div class="panel-body">

      <div class="col-lg-12" style="padding-left: 0; padding-right: 0;" >
        <form action="drugs.php" method="get" >
        <div class="col-lg-6 pull-left"style="padding-left: 0;"  >
          <span class="pull-left">
            <label class="col-lg-12 control-label" for="keyword" style="padding-right: 0;">
              <input type="text" id="autocomplete" value="<?php echo $_GET["keyword"]; ?>" placeholder="Drug name" id="" class="form-control" name="keyword" style="height: 41px;">
            </label>
            </span>
          <button class="btn btn-info">search</button>
        </div>
        </form>
        <div class="pull-right" ><a data-toggle="modal" href="#addModal"><button class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add More Drugs</button></a></div>
      </div>

      <div class="clearfix"></div>
<?php if (count($results) > 0) { ?>
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>S/No</th>
                <th>Drug</th>
                <th>Chemical Composition</th>
                <th>Quantity Available</th>
                <th>Status</th>
                <th>Action </th>

              </tr>
                <?php foreach ($results as $res) { ?>
                <tr>
                  <td style="text-align: center;"><?php echo $res["s_no"]; ?></td>
                  <td><?php echo $res["drug"]; ?></td>
                  <td><?php echo $res["chem"]; ?></td>
                  <th><?php echo $res["weight"]. ' grams'; ?></th>
                  <td>
                    <?php if ($res["status"] == 'A') { ?>
                        <a href="drugs.php?s_no=<?php echo ($res["s_no"]); ?>&status=I&keyword=<?php echo $_GET["keyword"]; ?>&pagenum=<?php echo $_GET["pagenum"]; ?>" title="Click to make it Inactive">Active</a>
                    <?php } else if($res["status"] == 'I'){ ?>
                        <a href="drugs.php?s_no=<?php echo ($res["s_no"]); ?>&status=A&keyword=<?php echo $_GET["keyword"]; ?>&pagenum=<?php echo $_GET["pagenum"]; ?>" title="Click to make it Active">In Active</a>
                    <?php } ?>
                  </td>
                  <td>
                    <a  href="edit_drug.php?s_no=<?php echo ($res["s_no"]); ?>" title="Click to edit the quantity details"> Edit </a> | |
                    <a href="drugs.php?del=<?php echo ($res["s_no"]); ?>" title="Click to delete" onclick="return confirm('Are you sure?');">Delete</a>
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
                <li><a href="drugs.php?pagenum=<?php echo $i; ?>&keyword=<?php echo $_GET["keyword"]; ?>" class="links"  onclick="displayRecords('<?php echo $page_limit; ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
                <?php
              }
            }
            ?>
          </ul>
        </div>

          <?php } else { ?>
        <div class="well well-lg"> No Drus So far </div>
<?php } ?>
    </div>
  </div>

  </div>




  <!-- Modal -->


  <!-- modal -->

  <!-- Modal -->
  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="addModal" class="modal fade">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title"> Add Drug</h4>
              </div>
              <div class="modal-body">
                  <?php include 'drug_chek.php' ?>
              </div>

              </form>

          </div>
      </div>
  </div>



<div class="col-md-4">
<?php if ($ERROR_MSG <> "") { ?>
    <div class="alert alert-dismissable alert-<?php echo $ERROR_TYPE ?>">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <p><?php echo $ERROR_MSG; ?></p>
    </div>
<?php } ?>
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
<div class="col-lg-12 center alert-danger"> Access to the page is denied. Only allowed to Receptionists</div>
</div>
    <?php
  }
      include 'footer.php';
      ?>

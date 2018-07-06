
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
$page_limit = ($_GET["show"] <> "" && is_numeric($_GET["show"]) ) ? $_GET["show"] : 20;


try {
  $keyword = trim($_GET["keyword"]);
  if ($keyword <> "" ) {
    $sql = "SELECT * FROM drugs WHERE 1 AND  (drug LIKE :keyword) ORDER BY s_no ";
    $stmt = $DB->prepare($sql);

    $stmt->bindValue(":keyword", $keyword."%");

  } else {
    $sql = "SELECT * FROM drugs  ORDER BY s_no ";
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
/////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST["insert"])) {

    $drug = $_POST["drug"];
    $status = trim($_POST["status"]);

    if ($drug == "") {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Drug Field must be field.";
    } else {

        $sql = "INSERT INTO `" . drugs . "` ( `drug` , `status` ) VALUES ( '{$drug}', '{$status}')";

       try {
        $stmt = $DB->prepare($sql);
        // $stmt->bindValue(":em", $email_id);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Inserted Succesfully!!.";
        } else if ($stmt->rowCount() == 0) {
            $_SESSION["errorType"] = "info";
            $_SESSION["errorMsg"] = "No changes affected";
        } else {
            $_SESSION["errorType"] = "danger";
            $_SESSION["errorMsg"] = "Failed.";
        }
    } catch (Exception $ex) {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = $ex->getMessage();
    }

    }
}


/////////////////////////////////////////////////////////////////////////////////////

?>
<!-- <div class="container"> -->
      <div class="row" style="padding-left: 10px; padding-right: 10px;" >
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="drugs.php">View Drugs</a></li>
            <li class="active">Add Drugs</li>
          </ul>
      </div>
<!-- </div> -->
<div class="row" style="padding-left: 10px; padding-right: 10px;">
      <div class="col-md-8">
<?php if ($ERROR_MSG <> "") { ?>
    <div class="alert alert-dismissable alert-<?php echo $ERROR_TYPE ?>">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <p><?php echo $ERROR_MSG; ?></p>
    </div>
<?php } ?>

            <div class="panel panel-primary">
              <div class="panel-heading">

                <h3 class="panel-title">Add Drugs </h3>
              </div>
              <div class="panel-body">
                          <?php include 'drug_chek.php'; ?>
              </div>
            </div>


  </div>
<div class="col-md-4">



  <div class="panel panel-info">
    <div class="panel-heading">
     <h3 class="panel-title">Navigation</h3>
      </div>
          <div class="panel-body">
<?php include 'nav.php'; ?>
          </div>
  </div>

    <div class="panel panel-info">
    <div class="panel-heading">
     <h3 class="panel-title">Missing Drugs</h3>
      </div>
          <div class="panel-body">
 <?php
try {
   $sql = "SELECT * FROM drugs WHERE 1 AND status ='I'";
   $stmt = $DB->prepare($sql);

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
                <th>S/No</th>
                <th>Drug</th>

              </tr>
                <?php foreach ($vist as $res) { ?>
                <tr>
                  <td style="text-align: center;"><?php echo $res["s_no"]; ?></td>
                  <td><?php echo $res["drug"]; ?></td>

                </tr>
  <?php } ?>
            </tbody></table>

<?php }else { ?>
        <div class="required well well-sm "> No results</div>
<?php } ?>
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
<script>

    function validateForm() {
        var drug = document.getElementById("drug").value;
        drug = drug.trim();
        if (drug == "") {
            alert("Enter The name of the drug");
            document.getElementById("drug").focus();
            return false;
        } else if (drug.length < 3) {
            alert("Must be more than 3 characters");
            document.getElementById("drug").focus();
            return false;
        }
        return true;

    }
</script>

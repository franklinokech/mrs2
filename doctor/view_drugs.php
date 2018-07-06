
<?php

require_once '../config.php';
require_once '../functions.php';
include 'header.php';

//////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////

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


<!-- <div class="container"> -->
      <div class="row" style="padding-left: 10px; padding-right: 10px;" >
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active">View Drugs</li>
          </ul>
      </div>
<!-- </div> -->
<div class="row" style="padding-left: 10px; padding-right: 10px;">
      <div class="col-md-7">
<?php if ($ERROR_MSG <> "") { ?>
    <div class="alert alert-dismissable alert-<?php echo $ERROR_TYPE ?>">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <p><?php echo $ERROR_MSG; ?></p>
    </div>
<?php } ?>
  <div class="panel panel-primary">
    <div class="panel-heading">
      
      <h3 class="panel-title">Patient List</h3>
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
      </div>

      <div class="clearfix"></div>
<?php if (count($results) > 0) { ?>
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>S/No</th>
                <th>Drug</th>
                <th>Status</th>

              </tr>
                <?php foreach ($results as $res) { ?>
                <tr>
                  <td style="text-align: center;"><?php echo $res["s_no"]; ?></td>
                  <td><?php echo $res["drug"]; ?></td>
                  <td>
                    <?php if ($res["status"] == 'A') { 
                      echo "Available";
                    }else{
                      echo "Not available";
                    }?>
                    
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
<div class="col-md-4">


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
      
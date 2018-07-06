<?php

require_once '../config.php';
require_once '../functions.php';
include 'header.php';

if (!$_SESSION['level']){
  $_SESSION['message'] = 'You must Login';
  redirect_to('../login.php');
}else if($_SESSION['level']==1 || $_SESSION['level']==5 ){
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
    $sql = "SELECT * FROM visit WHERE 1 AND "
            . " (visit_no LIKE :keyword) ORDER BY ASC ";
    $stmt = $DB->prepare($sql);
    
    $stmt->bindValue(":keyword", $keyword."%");
    
  } else {
    $sql = "SELECT * FROM visit WHERE 1 and attended=0 ORDER BY visit_no ASC ";
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

<div class="container">
      <div class="col-md-8">
        <?php echo messages(); ?>
  <div class="panel panel-primary">
    <div class="panel-heading">
      
      <h3 class="panel-title">Patient List</h3>
    </div>
    <div class="panel-body">

      <div class="col-lg-12" style="padding-left: 0; padding-right: 0;" >
        <form action="index.php" method="get" >
        <div class="col-lg-6 pull-left"style="padding-left: 0;"  >
          <span class="pull-left">  
            <label class="col-lg-12 control-label" for="keyword" style="padding-right: 0;">
              <input type="text" id="autocomplete" value="<?php echo $_GET["keyword"]; ?>" placeholder="search by Vist No" id="" class="form-control" name="keyword" style="height: 41px;">
            </label>
            </span>
          <button class="btn btn-info">search</button>
        </div>
        </form>
        <!-- <div class="pull-right" ><a href="add_patient.php"><button class="btn btn-success"><span class="glyphicon glyphicon-user"></span> Add New Patient</button></a></div> -->
      </div>
  <script type="text/javascript">
// function refresh(){
//   $("#reload").load('index.php');
// }
// setInterval ('refresh()' , 5000);

function refresh1 (){
  window.location.reload('index.php');
}
setInterval ('refresh1()' , 18000);
</script>
      <div class="clearfix"></div>
<?php if (count($results) > 0) { ?>
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Visit No</th>
                <th>Name</th>
                <th>Time In</th>
                <th>Registration No# </th>
                <th>Action </th>

              </tr>
                <?php foreach ($results as $res) { 
                  $pati = mysqli_fetch_assoc(find_patient($res["reg_no"]));
                  ?>
                <tr>
                  <td style="text-align: center;"><?php echo $res["visit_no"]; ?></td>

                  <td><?php echo ucwords($pati["first_name"]. " ". $pati['last_name']); ?></td>
                  <td><?php echo $res["date"]; ?></td>
                  <td><?php echo $res["reg_no"]; ?></td>
                  <td>
                    <a href="view_patients.php?reg_no=<?php echo $res["reg_no"]; ?> && visit_no=<?php echo $res["visit_no"]; ?>"><button class="btn btn-sm btn-info"><span class="glyphicon glyphicon-zoom-in"></span> View</button></a>&nbsp;
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
     <h3 class="panel-title">Navigation</h3>
      </div>
          <div class="panel-body">
            <ul class="nav nav-list ">
                <ul class="nav nav-pills nav-stacked">
<?php
$loo = $_SESSION['email'];
$re = 0;
$ree = 1;
try {
  $sql = " SELECT * FROM message WHERE too ='{$loo}' AND `read` ='{$ree}' ";
  $stmt = $DB->prepare($sql);
  $stmt->execute();
  $total_count = count($stmt->fetchAll());
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
                        <li class="active"><a href="index.php"> Home  <span class="glyphicon glyphicon-home pull-right"></a></li>
                        <li><a href="../messages/send_message.php?mode=read"> Messages <?php if($tot_count > 0){ ?>
                          <span class="required badge pull-right"><?php echo ($tot_count.'/'.$total_count);?></span>
                          <?php }elseif($tot_count==0){ ?>
                          <span class="badge pull-right"><?php echo ($tot_count.'/'.$total_count);?></span>
                          <?php }; ?>
                        </a></li>
                        <li><a href="../messages/mail.php"> Send Email <span class="glyphicon glyphicon-envelope pull-right"></a></li>
                        
                    </ul>
            </ul>
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
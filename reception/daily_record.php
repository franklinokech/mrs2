<?php

require_once '../config.php';
require_once '../functions.php';
require_once '../database_connection.php';
include 'header.php';

if($_SESSION['level']==0 || $_SESSION['level']==5 ){
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
    $sql = "SELECT * FROM visit WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) ORDER BY visit_no DESC ";
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
  $rest = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}
/*******PAGINATION CODE ENDS*****************/
?>
<div class="row">
<?php if ($ERROR_MSG <> "") { ?>
    <div class="alert alert-dismissable alert-<?php echo $ERROR_TYPE ?>">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <p><?php echo $ERROR_MSG; ?></p>
    </div>
<?php } ?> 
            <script>
                $(document).ready(function() {
                    $(".print_div").find('button').on('click', function() {

                        var dv_id = $(this).parents(".print_div").attr('id');

                        //Print ele4 with custom options
                        $('#' + dv_id).print({
                            //Use Global styles
                            globalStyles: false,
                            //Add link with attrbute media=print
                            mediaPrint: false,
                            //Custom stylesheet
                            stylesheet: "http://fonts.googleapis.com/css?family=Inconsolata",
                            //Print in a hidden iframe
                            iframe: true,
                            //Don't print this
                            noPrintSelector: ".avoid-this"
                        });
                    });
                });
            </script>
<div class="container">
      <div class="col-md-8">
        <?php echo messages(); ?>
  <div class="panel panel-primary">
    
    <div class="panel-heading">
      
      <h3 class="panel-title"> Todays Visits </h3>
    </div>
    <div class="panel-body">



      <div class="clearfix"></div>
<?php if (count($rest) > 0) { ?>

    <div class="table-responsive">
      <div id='print-div2' class="print_div">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Visit No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Registration No# </th>
                <th>Email </th>
                <th>Action </th>

              </tr>
                <?php foreach ($rest as $ress) { 
                  // $sql = "SELECT * FROM student_patient WHERE `reg_no`= '{$ress['reg_no']}' ";
                  $res = mysqli_fetch_assoc(find_patient($ress['reg_no']));
                  ?>
                <tr>
                  <td style="text-align: center;"><?php echo $ress["visit_no"]; ?></td>
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
            <!-- <button class="btn-sm btn-info print-link avoid-this"> Print  <span class="glyphicon glyphicon-print"></span> </button> -->
        </div> 
      </div>
        <!-- </div> -->

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
                <li><a href="daily_record.php?pagenum=<?php echo $i; ?>&keyword=<?php echo $_GET["keyword"]; ?>" class="links"  onclick="displayRecords('<?php echo $page_limit; ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
                <?php
              }
            }
            ?>
          </ul>
        </div>

          <?php } else { ?>
        <div class="well well-lg"> No records Today </div>
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
  <?php } else{?>
<div class="col-lg-12 center alert danger"> Access to the page is denied. Only allowed to Receptionists</div>

    <?php
  }
      include 'footer.php';
      ?>
<?php

require_once '../functions.php';
require_once '../config.php';

// include 'query.php';
  
                    
?>

<div class="row">
<!-- <div class="col-md-5"> -->
   <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">View here </h3>
      </div>
      <div class="panel-body" style="height:auto">

        <div class="clearfix"></div>

<?php
try {
   $sql = "SELECT * FROM visit WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended=3 ORDER BY visit_no Asc";
   $stmt = $DB->prepare($sql);
   // $stmt->bindValue(":reg_no", intval($_GET["reg_no"]));
   
   $stmt->execute();
   $vist = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
} 
if (count($vist) >0){ 
?>
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Visit No#</th>
                <th>Name</th>
              </tr>
                <?php foreach ($vist as $res) { 
                  $recept = mysqli_fetch_assoc(find_patient($res['reg_no']));
                  ?>
                <tr>
                  <td style="text-align: center;"><?php echo $res["visit_no"]; ?></td>
                  <td><?php echo ucwords($recept["first_name"] ." ".$recept["last_name"]); ?></td>
                <?php }; ?>  
                </tr>
               </tbody></table>
        </div> 
            <?php }else{ ?>
              <div class="well well-lg"> Result is empty </div>
            <?php };?>


           

        </div>
    </div>
    </div>
    
  <!-- </div> -->
  <!-- </div> -->

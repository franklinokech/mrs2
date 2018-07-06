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
                        <li><a href="reception.php"> Home  <span class="glyphicon glyphicon-home pull-right"></a></li>
                        <li><a href="add_patient.php"> Add patient <span class="glyphicon glyphicon-plus pull-right"></span></a></li>
                        <li><a href="add_patient2.php"> Add patient Staff <span class="glyphicon glyphicon-plus pull-right"></span></a></li>
                        <li><a href="daily_record.php"> Today's Record <span class="glyphicon glyphicon-sort pull-right"></span></a></li>
                        <li><a href="birth_day.php"> Birthday's <span class="glyphicon glyphicon-bell pull-right"></a></li>
                        <li><a href="../messages/send_message.php?mode=read"> Messages <?php if($tot_count > 0){ ?>
                          <span class="required badge pull-right"><?php echo ($tot_count.'/'.$total_count);?></span>
                          <?php }elseif($tot_count==0){ ?>
                          <span class="badge pull-right"><?php echo ($tot_count.'/'.$total_count);?></span>
                          <?php }; ?>
                        </a></li>
                        <li><a href="../messages/mail.php"> Send Email <span class="glyphicon glyphicon-envelope pull-right"></a></li>
                        
                    </ul>
            </ul>
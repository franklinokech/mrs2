<?php
$loo = $_SESSION['email'];
$re = 0;
$ree = 1;
try {
  $sql = " SELECT * FROM message WHERE too ='{$loo}' AND `read` ='{$ree}' ";
  $stmt = $DB->prepare($sql);
  $stmt->execute();
  $tt_count = count($stmt->fetchAll());
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
              
                      <ul class="nav nav-pills nav-stacked">
                        <li><a href="index.php"> Home  <span class="glyphicon glyphicon-home pull-right"></a></li>
                        <li><a href="drugs.php"> Drugs <span class="glyphicon glyphicon-save pull-right"></span></a></li>
                        <li><a href="../result/report.php"> Cleared Patients <span class="glyphicon glyphicon-eject pull-right"></span></a></li>

                        <li><a href="../messages/send_message.php?mode=read"> Messages <?php if($tot_count > 0){ ?>
                                      <span class="required badge pull-right"><?php echo ($tot_count.'/'.$tt_count);?></span>
                                      <?php }elseif($tot_count==0){ ?>
                                      <span class="badge pull-right"><?php echo ($tot_count.'/'.$tt_count);?></span>
                                      <?php }; ?>
                                    </a></li>
                        <li><a href="../messages/mail.php"> Send Email <span class="glyphicon glyphicon-envelope pull-right"></a></li>            
                        <li><a href="statistics.php">Statistics</a></li>
                    </ul>
                    <?php

                    $sql = "SELECT * FROM laboratory_test WHERE attended=1 or attended=0 ";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $total_count = count($stmt->fetchAll());

                    $sql = "SELECT * FROM laboratory_test WHERE attended=2  ";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $totlll_count = count($stmt->fetchAll());

                    $sql = "SELECT * FROM visit WHERE attended=3  ";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $totla_count = count($stmt->fetchAll());

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
                        <li><a href="labresults.php"> Laboratory results <?php if($totlll_count==!0){ ?>
                                      <span class="required badge pull-right"><?php echo $totlll_count ;?></span>
                                      <?php }elseif($totlll_count==0){ ?>
                                      <span class="badge pull-right"><?php echo $totlll_count ;?></span>
                                      <?php }; ?>
                        </a></li>
                        <li><a href="lab_wait.php"> Waiting Result <span class="badge pull-right"><?php echo $total_count; ?></span></a></li>
                        <li><a href="../result/report.php"> Cleared Patients  <span class="badge pull-right"><?php echo $totla_count; ?></span></a></li>
                        <li><a href="../messages/send_message.php?mode=read"> Messages <?php if($tot_count > 0){ ?>
                                      <span class="required badge pull-right"><?php echo ($tot_count.'/'.$tt_count);?></span>
                                      <?php }elseif($tot_count==0){ ?>
                                      <span class="badge pull-right"><?php echo ($tot_count.'/'.$tt_count);?></span>
                                      <?php }; ?>
                                    </a></li>
                        <li><a href="../messages/mail.php" toggle="_blank"> Send Email <span class="glyphicon glyphicon-send pull-right"></a></li>            
                        <li><a href="statistics.php">Statistics</a></li>
                    </ul>
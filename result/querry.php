<?php 
try {
    $sql = "SELECT * FROM visit WHERE attended=3 ORDER BY visit_no DESC ";
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $all = count($stmt->fetchAll());

    $sql = "SELECT * FROM visit WHERE `date` BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) ORDER BY visit_no DESC ";
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $today = count($stmt->fetchAll());

    $sql = "SELECT * FROM visit WHERE `date` BETWEEN date_add(CURDATE(),INTERVAL -1 DAY) AND CURDATE() ORDER BY visit_no DESC ";
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $yesterday = count($stmt->fetchAll());

    $sql = "SELECT * FROM visit WHERE `date` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY visit_no DESC ";
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $Month = count($stmt->fetchAll());

    $sql = "SELECT * FROM visit WHERE `date` between DATE_SUB(now(), INTERVAL 1 WEEK) AND NOW() ORDER BY visit_no DESC ";
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $week = count($stmt->fetchAll());

    // $sql = "SELECT COUNT(*) as visits MONTHNAME(date) as month FROM visit GROUP BY MONTH(date) ";
    // $rows = $sql ->fetchAll();
    // $results = array();
    //   foreach ($rows as $row) {
    //         $results[$row['month']] = $row['visits'];
    //       }    

    //       echo json_encode($results);
} catch (Exception $ex) {
  echo $ex->getMessage();
}
?>


     <ul class="nav nav-pills nav-stacked">
                    <?php if ($_SESSION['level']==5){ ?>
                    <li><a href="../admin/index.php"> Home <span class="glyphicon glyphicon-home pull-right"></span></a></li>
                      <?php }elseif ($_SESSION['level']==2) { ?>
                    <li><a href="../doctor/index.php"> Home <span class="glyphicon glyphicon-home pull-right"></span> </a></li>
                      <?php }elseif ($_SESSION['level']==0) { ?>
                    <li><a href="../reception/reception.php">Home <span class="glyphicon glyphicon-homepull-right"></span></a></li>
                   <?php }; ?>
                    <li><a href="report.php"> All Records  <span class="badge pull-right"><?php  echo $all; ?></span></a></li>
                    <li><a href="specific.php"> Search by Date<span class="glyphicon glyphicon-sort-by-attributes-alt pull-right"></span></a></li>
                    <li><a href="detailed.php"> Detailed Report  <span class="badge pull-right"><?php  echo $all; ?></span></a></li>
                    <li><a href="today.php"> Today  <span class="badge pull-right"><?php  echo $today; ?></span></a></li>
                    <li><a href="yesterday.php"> Yesterday  <span class="badge pull-right"><?php  echo $yesterday; ?></span></a></li>
                    <li><a href="week.php">Last Week <span class="badge pull-right"><?php  echo $week; ?></span></a></li>
                    <li><a href="last_one_month.php">Last one Month <span class="badge pull-right"><?php  echo $Month; ?></span></a></li>
                </ul>
<?php 

    $sql = "SELECT * FROM visit WHERE `date` BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day)  ";
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $now = count($stmt->fetchAll());

    $var = 1 || 0 || 2 ;
    $sql = "SELECT * FROM visit WHERE `date` BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended= '{$var}'";
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $pend = count($stmt->fetchAll());

    $sql = "SELECT * FROM visit WHERE `date` BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended=0 ";
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $Waiting_exam = count($stmt->fetchAll());

    $sql = "SELECT * FROM visit WHERE `date` BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended=1 ";
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $Waiting_doctor = count($stmt->fetchAll());

$varr= 0 || 1;
    $sql = "SELECT * FROM laboratory_test WHERE `date` BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended='{$varr}' ";
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $Waiting_result = count($stmt->fetchAll());

    $sql = "SELECT * FROM drugs WHERE status='I' ";
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $drugs = count($stmt->fetchAll());

    $active = session_commit();

?>
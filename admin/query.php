<?php
require_once '../config.php';
require_once '../database_connection.php';

try {
$sql = "SELECT * FROM visit WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) ORDER BY visit_no DESC";
$stmt = $DB->prepare($sql);
$stmt->execute();
$today_visit = count($stmt->fetchAll());
$query ="SELECT * FROM visit WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) ORDER BY visit_no DESC";
$today_visits = mysqli_fetch_assoc(mysqli_query($connection, $query));
 

$sql = "SELECT * FROM visit WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended=3";
$stmt = $DB->prepare($sql);
$stmt->execute();
$today_cleared = count($stmt->fetchAll());
$query ="SELECT * FROM visit WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended=3";
$today_cleareds = mysqli_fetch_assoc(mysqli_query($connection, $query));


$sql = "SELECT * FROM visit WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended=1";
$stmt = $DB->prepare($sql);
$stmt->execute();
$today_examined = count($stmt->fetchAll());
$today_examineds = $stmt->fetchAll();

$sql = "SELECT * FROM visit WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended=0 or attended=1 or attended=2";
$stmt = $DB->prepare($sql);
$stmt->execute();
$today_active = count($stmt->fetchAll());
function active(){
$query ="SELECT * FROM visit WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended=0 or attended=1 or attended=2";
$lab_set = mysqli_query($query, $connection);
confirm_query($lab_set);
return $lab_set;
}

$sql = "SELECT * FROM laboratory_test WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended=2";
$stmt = $DB->prepare($sql);
$stmt->execute();
$today_lab_done = count($stmt->fetchAll());
$today_lab_dones = $stmt->fetchAll();

$sql = "SELECT * FROM laboratory_test WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day) AND attended=1 or attended=0 ";
$stmt = $DB->prepare($sql);
$stmt->execute();
$today_lab_wait = count($stmt->fetchAll());
$today_lab_waits = $stmt->fetchAll();

} catch (Exception $ex) {
  echo $ex->getMessage();
}
?>
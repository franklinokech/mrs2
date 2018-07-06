<?php
require_once '../config.php';
try {
    $sql = " SELECT  * FROM visit  WHERE `date` like '%-01-%' " ;
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    $jan = count($stmt->fetchAll());
    // echo $jan;
} catch (Exception $ex) {
    echo $ex->getMessage();
}

try {
    $sql = " SELECT  * FROM visit  WHERE `date` like '%-02-%' " ;
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    $feb = count($stmt->fetchAll());
    // echo $feb;
} catch (Exception $ex) {
    echo $ex->getMessage();
}

try {
    $sql = " SELECT  * FROM visit  WHERE `date` like '%-03-%' " ;
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    $mar = count($stmt->fetchAll());
    // echo $mar;
} catch (Exception $ex) {
    echo $ex->getMessage();
}

try {
    $sql = " SELECT  * FROM visit  WHERE `date` like '%-04-%' " ;
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    $apr = count($stmt->fetchAll());
    // echo $apr;
} catch (Exception $ex) {
    echo $ex->getMessage();
}

try {
    $sql = " SELECT  * FROM visit  WHERE `date` like '%-05-%' " ;
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    $may = count($stmt->fetchAll());
    // echo $may;
} catch (Exception $ex) {
    echo $ex->getMessage();
}

try {
    $sql = " SELECT  * FROM visit  WHERE `date` like '%-06-%' " ;
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    $jun = count($stmt->fetchAll());
    // echo $jun;
} catch (Exception $ex) {
    echo $ex->getMessage();
}

try {
    $sql = " SELECT  * FROM visit  WHERE `date` like '%-07-%' " ;
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    $jul = count($stmt->fetchAll());
    // echo $jul;
} catch (Exception $ex) {
    echo $ex->getMessage();
}

try {
    $sql = " SELECT  * FROM visit  WHERE `date` like '%-08-%' " ;
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    $aug = count($stmt->fetchAll());
    // echo $aug;
} catch (Exception $ex) {
    echo $ex->getMessage();
}

try {
    $sql = " SELECT  * FROM visit  WHERE `date` like '%-09-%' " ;
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    $sep = count($stmt->fetchAll());
    // echo $sep;
} catch (Exception $ex) {
    echo $ex->getMessage();
}

try {
    $sql = " SELECT  * FROM visit  WHERE `date` like '%-10-%' " ;
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    $oct = count($stmt->fetchAll());
    // echo $oct;
} catch (Exception $ex) {
    echo $ex->getMessage();
}


try {
    $sql = " SELECT  * FROM visit  WHERE `date` like '%-11-%' " ;
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    $nov = count($stmt->fetchAll());
    // echo $nov;
} catch (Exception $ex) {
    echo $ex->getMessage();
}

try {
    $sql = " SELECT  * FROM visit  WHERE `date` like '%-11-%' " ;
        $stmt = $DB->prepare($sql);
        $stmt->execute();
    $dec = count($stmt->fetchAll());
    // echo $dec;
} catch (Exception $ex) {
    echo $ex->getMessage();
}

$sum = $jan + $feb +  $mar + $apr + $may + $jun + $jul + $aug + $sep + $oct + $nov + $dec ;

// echo $sum;

?>

<?php

require '../config.php';
require '../functions.php';

if (isset($_POST ['Update_visit'])){
  $bp = trim($_POST['bp']);
  $temp = trim($_POST['temp']);
  $exam = trim($_POST['examined_by']);
  $visit_no = trim($_POST['visit_no']);
  $att = 1;

  if(!$bp || !$temp){
    $_SESSION["message"] = "All the fields are required.";
    redirect_to('view_patients.php?visit_no='.$visit_no);
  }elseif(is_int($bp)){
   $_SESSION["message"] = "Blood pressure must be a number.";
    redirect_to('view_patients.php?visit_no='.$visit_no);
  }elseif(is_int($temp)){
   $_SESSION["message"] = "Temperature must be a number.";
    redirect_to('view_patients.php?visit_no='.$visit_no);
  }elseif($bp<50 || $bp>250){
   $_SESSION["message"] = "Please enter a valid blood pressure.";
    redirect_to('view_patients.php?visit_no='.$visit_no);
  }elseif($temp<30 || $temp>40){
   $_SESSION["message"] = "Invalid temperature Value .";
    redirect_to('view_patients.php?visit_no='.$visit_no);
  }else{

    $sql = "UPDATE visit SET temp='{$temp}', bp='{$bp}', examined_by='{$exam}', attended='{$att}' "
            . "WHERE visit_no='{$visit_no}' ";

      $stmt = $DB->prepare($sql);

      $stmt->execute();
      $result = $stmt->rowCount();
      
        $_SESSION["message"] = "Details Added succesfully..";
      
      }
  redirect_to('index.php');
}

?> 
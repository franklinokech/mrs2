<?php

require '../config.php';
require '../functions.php';
require '../database_connection.php';

if (isset($_POST ['preccribe'])){
  $signs = trim($_POST['signs']);
  $notes = trim($_POST['notes']);
  $visit_no = trim($_POST['visit_no']);
  $reg_no = trim($_POST['reg_no']);
  $seen = trim($_POST['seen_by']);

  if (!$signs || !$notes){
    $_SESSION["message"] = "All the fields are required.";
    redirect_to('view_patients.php?visit_no='.($_POST['visit_no']));
  }elseif (!$seen || !$reg_no || !$visit_no){
      $_SESSION["message"] = "An important field Is missing It seems the system doesent recognize you Check with the Admin.";
      redirect_to('view_patients.php?visit_no='.$visit_no);
  }else{
   $sql = "INSERT INTO treatment ( visit_no, reg_no, signs, notes, seen_by ) VALUES ('{$visit_no}', '{$reg_no}', '{$signs}', '{$notes}', '{$seen}' )" ;

      $stmt = $DB->prepare($sql);

      $stmt->execute();
      $result = $stmt->rowCount();

   $sqlii = "UPDATE visit SET attended=2 WHERE visit_no='{$visit_no}'";

      $stmttt = $DB->prepare($sqlii);

      $stmttt->execute();
      $result = $stmttt->rowCount();   
       
        $_SESSION["message"] = "Details Added succesfully..";
    
      }
	redirect_to('prescribe.php?visit_no='.($_POST['visit_no']));
}

if (isset($_POST ['lab'])){
  $signs = trim($_POST['signs']);
  $notes = trim($_POST['notes']);
  $visit_no = trim($_POST['visit_no']);
  $reg_no = trim($_POST['reg_no']);
  $seen = trim($_POST['seen_by']);
  $attendd = 2;

  if (!$signs || !$notes){
    $_SESSION["message"] = "All the fields are required.";
    redirect_to('view_patients.php?visit_no='.($_POST['visit_no']));
  }elseif (!$seen || !$reg_no || !$visit_no){
      $_SESSION["message"] = "An important field Is missing It seems the system doesent recognize you Check with the Admin.";
      redirect_to('view_patients.php?visit_no='.$visit_no);
  }else{
   $sql = "INSERT INTO treatment ( visit_no, reg_no, signs, notes, seen_by ) VALUES ('{$visit_no}', '{$reg_no}', '{$signs}', '{$notes}', '{$seen}' )" ;

      $stmt = $DB->prepare($sql);

      $stmt->execute();
      $result = $stmt->rowCount();

    $sqliiii = "UPDATE visit SET attended=2 WHERE visit_no='{$visit_no}'";

      $stmttttt = $DB->prepare($sqliiii);

      $stmttttt->execute();
      $result = $stmttttt->rowCount();
        $_SESSION["message"] = "Details Added succesfully, Please recomend a test.";
      
      }
	redirect_to('labtest.php?visit_no='.($_POST['visit_no']));
}

 if (isset($_POST['psb'])){

  $prescribe = ($_POST['prescribe']);
  $reg_no = ($_POST['reg_no']);
  $visit_no = ($_POST['visit_no']);
  $pscr = trim($_POST['prescribed_by']);
  $att = 1;

   if (!$prescribe) {
     $_SESSION["message"] = "This field Cant be blank.";
      redirect_to('prescribe.php?visit_no='.$visit_no);
   }elseif (!$pscr){
      $_SESSION["message"] = "An important field Is missing It seems the system doesent recognize you Check with the Admin.";
      redirect_to('prescribe.php?visit_no='.$visit_no);
  }else{
 
      $sql = "UPDATE treatment SET prescription='{$prescribe}', prescribed_by='{$pscr}' "
            . "WHERE visit_no='{$visit_no}'";

      $stmt = $DB->prepare($sql);

      $stmt->execute();
      $result = $stmt->rowCount();

      $sqliii = "UPDATE visit SET attended=2 WHERE visit_no = '{$visit_no}'";

      $stmtttt = $DB->prepare($sqliii);

      $stmtttt->execute();
      $result = $stmtttt->rowCount();
     
        $_SESSION["message"] = "Prescription Added succesfully..";
     
      }
	redirect_to('index.php');
}

 if (isset($_POST ['submit_test'])){

  $test1 = ($_POST['test1']);
  $test2 = ($_POST['test2']);
  $test3 = ($_POST['test3']);
  $reg_no = ($_POST['reg_no']);
  $visit_no = ($_POST['visit_no']);
  $submit =  ($_POST['submited_by']);
  $error = FALSE;

  if ($test1 & !$test2 & !$test3){
    $test= '<ol><li>' . $test1 .  '</li></ol>'; 
  }elseif( $test1 & $test2 & !$test3 ){
      $test= '<ol><li>'. $test1 .  '</li><li>' . $test2 . '</li></ol>';  
  }elseif( $test1 & $test2 & $test3){
      $test= '<ol><li>' . $test1 .  '</li><li>' . $test2 . '</li><li>' . $test3 . '</li></ol>'; 
  }elseif( $test1 & !$test2 & $test3){
      $test= '<ol><li>' . $test1 .  '</li><li>' . $test3 . '</li></ol>'; 
  }elseif( !$test1 & $test2 & $test3){
      $test= '<ol><li>' . $test2 .  '</li><li>' . $test3 . '</li></ol>'; 
  }elseif (!$test1 & $test2 & !$test3){
    $test= '<ol><li>' . $test2 .  '</li></ol>'; 
  }elseif (!$test1 & !$test2 & $test3){
    $test= '<ol><li>' . $test3 .  '</li></ol>'; 
  }
if(!$test){
  $error= true;
}
if (!$error){
   $sql = "INSERT INTO laboratory_test ( visit_no, reg_no, test, submited_by ) VALUES ('{$visit_no}', '{$reg_no}', '{$test}', '{$submit}' )" ;

try {
      $stmt = $DB->prepare($sql);

      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        // $_SESSION["errorType"] = "success";
        $_SESSION["message"] = "Submitted Successfully.";
      } else {
        // $_SESSION["errorType"] = "danger";
        $_SESSION["message"] = "Failed To submit.";
      }
    } catch (Exception $ex) {
      $_SESSION["message"] = $ex->getMessage();
    }
  }
	redirect_to('index.php');
 }

?> 
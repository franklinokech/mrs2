<?php

require '../config.php';
require '../functions.php';


 if (isset($_POST ['wait'])){
  $visit_no = ($_POST['visit_no']);
  
  if ($visit_no==""){
     $_SESSION["message"] = "i didnt find an ID..";
      redirect_to('view_patients.php');
  }else{
  $att = 1;

   
 
      $sql = "UPDATE laboratory_test SET attended='{$att}' "
            . "WHERE visit_no='{$visit_no}'";

      $stmt = $DB->prepare($sql);

      $stmt->execute();
      $result = $stmt->rowCount();
    
        $_SESSION["message"] = "WAiting for result";
      
      }
	redirect_to('index.php');
}


  if (isset($_POST ['submit'])){

  $visit_no = ($_POST['visit_no']);
  $attended = ($_POST['attended']);
  $result1 = ($_POST['result1']);
  $result2 = ($_POST['result2']);
  $result3 = ($_POST['result3']);
  $conduct = ($_POST['conducted_by']);
  $attd = 2;
  $error = FALSE;

  if ($result1 & !$result2 & !$result3){
    $result = '<ol><li>' . $result1 .  '</li></ol>'; 
  }elseif( $result1 & $result2 & !$result3 ){
      $result = '<ol><li>'. $result1 .  '</li><li>' . $result2 . '</li></ol>';  
  }elseif( $result1 & $result2 & $result3){
      $result = '<ol><li>' . $result1 .  '</li><li>' . $result2 . '</li><li>' . $result3 . '</li></ol>'; 
  }elseif( $result1 & !$result2 & $result3){
      $result = '<ol><li>' . $result1 .  '</li><li>' . $result3 . '</li></ol>'; 
  }elseif( !$result1 & $result2 & $result3){
      $result = '<ol><li>' . $result2 .  '</li><li>' . $result3 . '</li></ol>'; 
  }elseif (!$result1 & $result2 & !$result3){
    $result= '<ol><li>' . $result2 .  '</li></ol>'; 
  }elseif (!$result1 & !$result2 & $result3){
    $result= '<ol><li>' . $result3 .  '</li></ol>'; 
  }
if(!$result){
  $error= true;
}
if (!$error){
      $sql = "UPDATE laboratory_test SET result='{$result}', conducted_by='{$conduct}', attended='{$attd}' "
            . "WHERE visit_no='{$visit_no}'";

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
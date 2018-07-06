<?php 
  require '../config.php';
  require '../functions.php';

  if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
  }else{
    // echo "Mode Not found";
    $_SESSION["errorType"] = "danger";
     $_SESSION["errorMsg"] = "Mode Not found.";
     redirect_to('staf.php');
  }

  if(isset($_GET['username'])){
    $username = $_GET['username'];
  }else{
    $_SESSION["errorType"] = "danger";
     $_SESSION["errorMsg"] = "username Not found.";
     redirect_to('staf.php');
  }


  if ($mode='delete'){

  	$sql = "DELETE FROM staff WHERE username ='{$username}'";

     $stmt = $DB->prepare($sql);

      $stmt->execute();
      $result = $stmt->rowCount();
      
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Staff Deleted successfully.";

  redirect_to("staf.php");

  }




?>
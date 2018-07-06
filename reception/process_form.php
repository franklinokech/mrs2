<?php

require '../config.php';
require '../functions.php';

if (isset($_POST ['submit'])){
  $first_name = trim($_POST['first_name']);
  $last_name = trim($_POST['last_name']);
  $reg_no = trim($_POST['reg_no']);
  $email = trim($_POST['email']);
  $contact = trim($_POST['contact']);
  $d_o_b = trim($_POST['d_o_b']);
  $course = trim($_POST['course']);
  $fuculty = trim($_POST['fuculty']);
  $health_info = trim($_POST['health_info']);
  $address = trim($_POST['address']);
  $filename = "";
  $error = FALSE;

  if (is_uploaded_file($_FILES["profile_image"]["tmp_name"])) {
    $filename = time() . '_' . $_FILES["profile_image"]["name"];
    $filepath = '../profile_image/' . $filename;
    if (!move_uploaded_file($_FILES["profile_image"]["tmp_name"], $filepath)) {
      $error = TRUE;
    }
  }
    // pre($_POST);
  if (!$error) {
    $sql = "INSERT INTO student_patient ( first_name, last_name, reg_no, email, contact, d_o_b, course, fuculty, health_info, profile_image, address  ) VALUES "
            . "( '{$first_name}', '{$last_name}', '{$reg_no}', '{$email}', '{$contact}', '{$d_o_b}', '{$course}', '{$fuculty}', '{$health_info}', '{$filename}', '{$address}')";

     try {
      $stmt = $DB->prepare($sql);

      
      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        // $_SESSION["errorType"] = "success";
        $_SESSION["message"] = "Contact added successfully.";
      } else {
        // $_SESSION["errorType"] = "danger";
        $_SESSION["message"] = "Failed to add contact.";
      }
    } catch (Exception $ex) {
      $_SESSION["message"] = $ex->getMessage();
    }
  }
  redirect_to('reception.php');

}

// patient staff


if (isset($_POST ['okey'])){
  $first_name = trim($_POST['first_name']);
  $last_name = trim($_POST['last_name']);
  $reg_no = trim($_POST['reg_no']);
  $its_email = trim($_POST['its_email']);
  $email = trim($_POST['email']);
  $d_o_b = trim($_POST['d_o_b']);
  $contact = trim($_POST['contact']);
  $address = trim($_POST['address']);
  $fuculty = trim($_POST['fuculty']);
  $position = trim($_POST['position']);
  $emp_date = trim($_POST['emp_date']);
  $status = trim($_POST['status']);
  $health_info = trim($_POST['health_info']);
  $filename = "";
  $error = FALSE;

    if (is_uploaded_file($_FILES["profile_image"]["tmp_name"])) {
    $filename = time() . '_' . $_FILES["profile_image"]["name"];
    $filepath = '../profile_image/' . $filename;
    if (!move_uploaded_file($_FILES["profile_image"]["tmp_name"], $filepath)) {
      $error = TRUE;
    }
  }

    // pre($_POST);
  if (!$error) {
    $sql = "INSERT INTO staff_patient ( first_name, last_name, reg_no, its_email, email, d_o_b, contact, profile_image, fuculty, position, health_info, address, status  ) VALUES "
            . "('{$first_name}', '{$last_name}', '{$reg_no}', '{$its_email}', '{$email}', '{$d_o_b}', '{$contact}', '{$filename}', '{$fuculty}', '{$position}', '{$health_info}', '{$address}', '{$status}')";

     try {
      $stmt = $DB->prepare($sql);

      
      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        // $_SESSION["errorType"] = "success";
        $_SESSION["message"] = "Contact added successfully.";
      } else {
        // $_SESSION["errorType"] = "danger";
        $_SESSION["message"] = "Failed to add contact.";
      }
    } catch (Exception $ex) {
      $_SESSION["message"] = $ex->getMessage();
    }
  }
  if($status=='single') {
    redirect_to('reception.php');
   }elseif($status=='married'){
    redirect_to('staff_kin.php?reg_no='.$reg_no);
   } 
}


if (isset($_POST ['kin'])){
  $first_name = trim($_POST['first_name']);
  $last_name = trim($_POST['last_name']);
  $reg_no = trim($_POST['reg_no']);
  $d_o_b = trim($_POST['d_o_b']);
  $contact = trim($_POST['contact']);
  $rship = trim($_POST['rship']);
  $new = trim($_POST['new']);
  $sex = trim($_POST['sex']);
  $health_info = trim($_POST['health_info']);
  $filename = "";
  $error = FALSE;

    if (is_uploaded_file($_FILES["profile_image"]["tmp_name"])) {
    $filename = time() . '_' . $_FILES["profile_image"]["name"];
    $filepath = '../profile_image/' . $filename;
    if (!move_uploaded_file($_FILES["profile_image"]["tmp_name"], $filepath)) {
      $error = TRUE;
    }
  }
    pre($_POST);
  if (!$error) {
    $sql = "INSERT INTO staff_kin (first_name, last_name, reg_no, sex, d_o_b, contact, relationship, profile_image) VALUES "
            ."('{$first_name}', '{$last_name}', '{$reg_no}', '{$sex}', '{$d_o_b}', '{$contact}', '{$rship}', '{$filename}')";

     try {
      $stmt = $DB->prepare($sql);

      
      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        // $_SESSION["errorType"] = "success";
        $_SESSION["message"] = "Details added successfully.";
      } else {
        // $_SESSION["errorType"] = "danger";
        $_SESSION["message"] = "Failed to add Details.";
      }
    } catch (Exception $ex) {
      $_SESSION["message"] = $ex->getMessage();
    }
  }
  if($new=='add') {
    redirect_to('staff_kin.php?reg_no='.$reg_no); 
   }elseif($new==''){
    redirect_to('reception.php');
   } 
}

if(isset($_POST['kin_visit'])){
    $reg_no = trim($_POST['reg_no']);
    $reception = trim($_POST['created_by']);

  // pre($_POST);
      $sql = "INSERT INTO visit ( reg_no, created_by) VALUES ('{$reg_no}', '{$reception}')" ;
     try {
      $stmt = $DB->prepare($sql);

      
      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        // $_SESSION["errorType"] = "success";
        $_SESSION["message"] = "Visit created successfully.";
      } else {
        // $_SESSION["errorType"] = "danger";
        $_SESSION["message"] = "Failed to create visit.";
      }
    } catch (Exception $ex) {
      $_SESSION["message"] = $ex->getMessage();
    }
    redirect_to('reception.php');
  }  
?> 
<?php
session_start();
require '../config.php';
require '../functions.php';


// $mode = $_REQUEST["mode"];

if(isset($_POST['edit'])){

  $d_o_b = trim($_POST['d_o_b']);
 
  $email = trim($_POST['email_id']);
  $contact = trim($_POST['contact_no']);
  $address = trim($_POST['address']);
  $course = trim($_POST['course']);
  $reg_no = trim($_POST['reg_no']);
  $filename = "";
  $error = FALSE;

   // pre($_POST);
if (is_uploaded_file($_FILES["profile_image"]["tmp_name"])) {
    $filename = time() . '_' . $_FILES["profile_image"]["name"];
    $filepath = '../profile_image/' . $filename;
    if (!move_uploaded_file($_FILES["profile_image"]["tmp_name"], $filepath)) {
      $error = TRUE;
    }
  }
 if ($filename==""){
  $filename= $_POST['old_pic'];
 } 
if (!$error){ 
    $sql = "UPDATE student_patient SET d_o_b='{$d_o_b}', address='{$address}', contact='{$contact}', course='{$course}', email='{$email}', profile_image= '{$filename}' WHERE reg_no ='{$reg_no}'";
try {
      $stmt = $DB->prepare($sql);
      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Contact updated Staff.";
      } else {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Failed to Update.";
      }
    } catch (Exception $ex) {
      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
    }
  }
  redirect_to("student.php");
}


if (isset($_POST ['submit'])){
  $sname = trim($_POST['sname']);
  $lname = trim($_POST['lname']);
  $username = trim($_POST['username']);
  $level = trim($_POST['level']);
  $filename = "";
  $error = FALSE;

  if (is_uploaded_file($_FILES["profile_image"]["tmp_name"])) {
    $filename = time() . '_' . $_FILES["profile_image"]["name"];
    $filepath = '../profile_image/staff/' . $filename;
    if (!move_uploaded_file($_FILES["profile_image"]["tmp_name"], $filepath)) {
      $error = TRUE;
    }
 // }
if (!$error) {
   $sql = "INSERT INTO staff ( first_name, last_name, username, level, profile_image ) VALUES ('{$sname}', '{$lname}', '{$username}', '{$level}', '{$filename}')" ;
try {
      $stmt = $DB->prepare($sql);
      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Staff added Success .";
      } else {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Failed to add Staff.";
      }
    } catch (Exception $ex) {
      $_SESSION["message"] = $ex->getMessage();
    }
  }
  } else {
    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = "failed to upload image.";
  }  
	redirect_to('staf.php');
}

if (isset($_POST ['update'])){
      $pass1 = md5($_POST['password1']);
      $pass2 = md5($_POST['password2']);
      $id = $_POST['id'];
      $email = $_POST['email'];
      $tel =(int) $_POST['tel'];
      $sex = $_POST['SEX'];
      $dob = $_POST['dob'];
      $address = $_POST['address'];
      $username = $_POST['username'];

     $sql = "UPDATE staff SET password='{$pass1}', id_no='{$id}', email='{$email}', tel='{$tel}', sex='{$sex}', dob='{$dob}', address='{$address}'  WHERE username ='{$username}' ";
try {
      $stmt = $DB->prepare($sql);
      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["message"] = "Updated successfully Please Log in again.";
      } else {
        $_SESSION["message"] = "Failed to update.";
      }
    } catch (Exception $ex) {
      $_SESSION["message"] = $ex->getMessage();
    }

    if ($_SESSION['username'] == $username){
          redirect_to('staf.php');
      }else{
      $_SESSION["message"] = "Updated successfully Please Log in again.";  
      session_destroy();
      redirect_to('../login.php');
      };  
      
}

if (isset($_POST ['activate'])){
  $username = trim($_POST['username']);
  $activate =1;
  if (!$username){
    $_SESSION['message'] = "An important field Is Missing";
    redirect_to('staffdetails.php?username='.$username);
  }else{
   $sql = "UPDATE staff set status='{$activate}' WHERE username='{$username}' ";

      $stmt = $DB->prepare($sql);

      $stmt->execute();
      $result = $stmt->rowCount();

        $_SESSION["message"] = "Account Activated.";
    }
  redirect_to('staffdetails.php?username='.$username);
}

if (isset($_POST ['deactivate'])){
  $username = trim($_POST['username']);
  $deactivate =0;
  if (!$username){
    $_SESSION['message'] = "An important field Is Missing";
    redirect_to('staffdetails.php?username='.$username);
  }else{
   $sql = "UPDATE staff set status='{$deactivate}' WHERE username='{$username}' ";

      $stmt = $DB->prepare($sql);

      $stmt->execute();
      $result = $stmt->rowCount();

        $_SESSION["message"] = "Account Deactivated.";
    }
  redirect_to('staffdetails.php?username='.$username);
}

if (isset($_POST ['kin_add'])){
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
    redirect_to('staff_kin_add.php?reg_no='.$reg_no); 
   }elseif($new==''){
    redirect_to('view_pattient_staff.php?reg_no='.$reg_no);
   } 
}

if (isset($_POST ['update_details'])){
  $reg_no = trim($_POST['reg_no']);
  $its_email = trim($_POST['its_email']);
  $email = trim($_POST['email']);
  $d_o_b = trim($_POST['d_o_b']);
  $contact = trim($_POST['contact']);
  $address = trim($_POST['address']);
  $position = trim($_POST['position']);
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
    $sql = "UPDATE  staff_patient SET its_email='{$its_email}', email='{$email}', d_o_b='{$d_o_b}', contact='{$contact}', profile_image='{$filename}', position='{$position}', health_info='{$health_info}', address='{$address}', status='{$status}' WHERE reg_no = '{$reg_no}'";
     try {
      $stmt = $DB->prepare($sql);

      
      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Updated successfully.";
      } else {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Failed to add update.";
      }
    } catch (Exception $ex) {
      $_SESSION["errorMsg"] = $ex->getMessage();
    }
  }
  if($status=='single' ) {
    redirect_to('staff_patient.php');
   }elseif($status=='married'){
    redirect_to('staff_kin_add.php?reg_no='.$reg_no);
   } 
}
?>
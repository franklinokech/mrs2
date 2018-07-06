<?php

require '../config.php';
require '../functions.php';

if (isset($_POST ['exit'])){
  $attended_by = trim($_POST['attended_by']);
  $visit_no = trim($_POST['visit_no']);

if (!$attended_by || !$visit_no){
    $_SESSION["message"] = "Some data cannot be captured. Confirm with the admin please";
    redirect_to('view_patients.php?visit_no='.$visit_no);
  }else{
    $sql = "UPDATE treatment SET attended=3, druged_by='{$attended_by}'"
            . "WHERE visit_no='{$visit_no}'";

      $stmt = $DB->prepare($sql);

      $stmt->execute();
      $result = $stmt->rowCount();

      $sqll = "UPDATE visit SET attended=3 "
            . "WHERE visit_no='{$visit_no}'";

      $stmtt = $DB->prepare($sqll);

      $stmtt->execute();
      $resultt = $stmtt->rowCount();

        $_SESSION["message"] = "Exit succesful.";

   }
  redirect_to('index.php');
}

if (isset($_POST["insert"])) {

    $drug = $_POST["lyf"];
    $chem = trim($_POST["chem"]);
    $status = trim($_POST["status"]);
    $quantity =  trim($_POST["quantity"]);

    pre($_POST);

    if ($drug == "") {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Drug Field must be field.";
    } else {

        $sql = "INSERT INTO `" . drugs . "` ( `drug` , `status`, `chem`, `weight` ) VALUES ( '{$drug}', '{$status}', '{$chem}', '{$quantity}' )";

       try {
        $stmt = $DB->prepare($sql);
        // $stmt->bindValue(":em", $email_id);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Inserted Succesfully!!.";
        } else if ($stmt->rowCount() == 0) {
            $_SESSION["errorType"] = "info";
            $_SESSION["errorMsg"] = "No changes affected";
        } else {
            $_SESSION["errorType"] = "danger";
            $_SESSION["errorMsg"] = "Failed.";
        }
    } catch (Exception $ex) {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = $ex->getMessage();
    }

    }
    redirect_to('drugs.php');
}

if (isset($_POST["update"])) {
  $s_no = $_POST["s_no"];
    $drug = $_POST["lyf"];
    $chem = trim($_POST["chem"]);
    $status = trim($_POST["status"]);
    $quantity =  trim($_POST["quantity"]);

    pre($_POST);

    if ($drug == "") {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Drug Field must be field.";
    } else {

        $sql = "UPDATE drugs  SET  drug= '{$drug}',  status='{$status}', chem='{$chem}', weight='{$quantity}' WHERE s_no = '{$s_no}' ";

       try {
        $stmt = $DB->prepare($sql);
        // $stmt->bindValue(":em", $email_id);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Updated Succesfully!!.";
        } else if ($stmt->rowCount() == 0) {
            $_SESSION["errorType"] = "info";
            $_SESSION["errorMsg"] = "No changes affected";
        } else {
            $_SESSION["errorType"] = "danger";
            $_SESSION["errorMsg"] = "Failed.";
        }
    } catch (Exception $ex) {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = $ex->getMessage();
    }

    }
    redirect_to('drugs.php');
}
?>

  <?php
    require '../config.php';
  require '../functions.php';

  if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
  }else{
    // echo "Mode Not found";
    $_SESSION["errorType"] = "danger";
     $_SESSION["errorMsg"] = "Mode Not found.";
     redirect_to('student.php');
  }

  if(isset($_GET['reg_no'])){
    $reg_no = $_GET['reg_no'];
  }else{
    $_SESSION["errorType"] = "danger";
     $_SESSION["errorMsg"] = "Reg No Not found.";
     redirect_to('student.php');
  }

  if ($mode='delete'){
 
  	$sql = "DELETE FROM student_patient WHERE reg_no ='{$reg_no}'";
try {
      $stmt = $DB->prepare($sql);
      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Patient Deleted successfully.";
      } else {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Failed to Delete.";
      }
    } catch (Exception $ex) {
      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
    }

  redirect_to("student.php");

  }

?>
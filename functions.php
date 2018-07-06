<?php
	include_once('config.php');
	include_once('database_connection.php');

	$errors=array();
//PHP PROCESSING FUNCTIONS
	function redirect_to($new_location){
		header("Location: ".$new_location);
		exit;
	}

	function pre($block){
        if(gettype($block) == "array"){
            echo "<pre>";
            print_r($block);
            echo "</pre>";
        }else{
            echo "<pre>".$block."</pre>";
        }
    }

	function print_null($value){
			if(is_null($value)){
					echo("");
				}else{
						echo $value;
					}
		}

	function check_login(){
			if(!isset($_SESSION['user_id'])){
					redirect_to('login.php');
				}
		}
// PHP DATABASE OPERATIONS
	function mysql_prep($string){
		global $connection;

		$escaped_string=mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}

	function confirm_query($result_set){
		global $connection;

		if(!$result_set){
				 die("Database Query failed".mysqli_error($connection));
			}
		}

// allready in use
function db_prepare_input($string) {
    return trim(addslashes($string));
}

	//USER CRUD OPERATIONS


function checkEmail($str)
{
	return preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $str);
}

	//USER CRUD OPERATIONS
	function login($username ,$password){
		global $connection;
		global $errors;

		$query = "SELECT * FROM staff WHERE username='{$username}' ";
		$staff = mysqli_fetch_assoc(mysqli_query($connection, $query));
		// pre($staff);
		if($staff){
			//check password
				if($staff['password']=='maseno'){
						redirect_to('admin/staffdedails.php?username='.$staff['username']);
					}elseif($staff['status']=='0'){
						$errors['creds'] = "Your Account Is Inactive. Please contact the system Admin";
					}elseif($staff['password']==md5($password)){
						$_SESSION['fname'] = $staff['first_name'];
						$_SESSION['lname'] = $staff['last_name'];
						$_SESSION['username'] =  $staff['username'];
						$_SESSION['level'] = $staff['level'];
						$_SESSION['email'] = $staff['email'];
						$_SESSION['username'] = $staff['username'];
						$_SESSION['last_login'] = time();


								try {
								   $sql = "UPDATE staff SET active = 'YES' WHERE username = '{$_SESSION['username']}' ";

 											$patient_set = mysqli_query($connection, $sql);
 											confirm_query($patient_set);

											// restricting page access
										if($staff['level'] == '0'){
											redirect_to('reception/reception.php');
										}
										elseif($staff['level'] == '1'){
											redirect_to('nurse/index.php');
										}
										elseif ($staff['level'] == '2'){
											redirect_to('doctor/index.php');
										}
										elseif ($staff['level'] == '4'){
											redirect_to('lab/index.php');
										}
										elseif ($staff['level'] == '3'){
											redirect_to('pharmacy/index.php');
										}
										elseif($staff['level'] == '5'){
											redirect_to('Admin/index.php');
										}

								} catch (Exception $ex) {
								  echo $ex->getMessage();
								}


			}else{
				$errors['creds'] = "Username/password does not match";
			}

		}else{
			//No staff found with those details
			$errors['exist'] = "No staff found";
		}
		$_SESSION['errors'] = $errors;

	}

	function redirect_session($level){

		if($level == '0'){
			redirect_to('reception/reception.php');
		}
		elseif($level == '1'){
			redirect_to('nurse/index.php');
		}
		elseif ($level == '2'){
			redirect_to('doctor/index.php');
		}
		elseif ($level == '4'){
			redirect_to('lab/index.php');
		}
		elseif ($level == '3'){
			redirect_to('pharmacy/index.php');
		}
		elseif($level == '5'){
			redirect_to('Admin/index.php');
		}
	}



	function errors(){

		if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])){
			$errors = $_SESSION['errors'];

			$output = "<div id='errors' class='alert alert-danger alert-dismissible'>";
			$output .= "You have the following errors: <br>";
			$output .= "<ul>";
			foreach ($errors as $error) {
				$output .= "<li>".$error."</li>";
			}
			$output .= "</ul>";
			$output .= "</div>";

			$_SESSION['errors'] = null;

			return $output;
		}

	}

	function messages(){
		if (isset($_SESSION['message']) && !empty($_SESSION['message'])){
			$message = $_SESSION['message'];
			$_SESSION['message'] = null;

			$output = '<div class="alert alert-warning">';
			$output .= $message;
			$output .= '</div>';

			return $output;
		}
	}

	function msgs(){
		if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])){
			$msg = $_SESSION['msg'];
			$_SESSION['message'] = null;

			// $output = '<h5 class="alert-danger centered">';
			$output = $msg;
			// $output .= '</h5>';

			return $output;
		}
	}


function errorMessage($str) {
    return '<div class="alert alert-danger">' . $str . '</div>';
}

function successMessage($str) {
    return '<div class="alert alert-primary">' . $str . '</div>';
}



	function logout(){
  global $connection;
		session_destroy();

		try {
			 $sql = "UPDATE staff SET active = 'NO' WHERE username = '{$_SESSION['username']}' ";
			 $patient_set = mysqli_query($connection, $sql);
			 confirm_query($patient_set);

		} catch (Exception $ex) {
			echo $ex->getMessage();
		}

		redirect_to('login.php');
	}

function inactive($last){

	if ((time() - $last) > 180000) {
    redirect("../lock_screen.php");
    exit;
  }

}


//FINDING DOCTORS ONLY IF TEMP AND AGE IS FILLED
	function find_patient($reg_no){
		global $connection;
		$query = "SELECT reg_no, first_name, last_name, profile_image, fuculty, course, health_info, d_o_b, contact, address, email FROM student_patient WHERE reg_no ='{$reg_no}'  union ALL ";
		$query .= "SELECT reg_no, first_name, last_name, profile_image, fuculty, position, health_info, d_o_b, contact, address, email FROM staff_patient WHERE reg_no ='{$reg_no}' ";

		$patient_set = mysqli_query($connection, $query);
		confirm_query($patient_set);

		// pre(mysqli_fetch_array($patient_set));
		return $patient_set;
	}

	function find_patient_staff($reg_no){
		global $connection;
		$query = "SELECT * FROM staff_patient ";
		$query .= " WHERE reg_no ='{$reg_no}' ";

		$visit_set = mysqli_query($connection, $query);
		confirm_query($visit_set);

		// pre(mysqli_fetch_array($patient_set));
		return $visit_set;
	}


	function find_nurs($visit_no){
		global $connection;
		$query = "SELECT * FROM visit ";
		$query .= " WHERE visit_no ='{$visit_no}' ";

		$visit_set = mysqli_query($connection, $query);
		confirm_query($visit_set);

		// pre(mysqli_fetch_array($patient_set));
		return $visit_set;
	}
	//not used was meant for counting
	function find_visit_no($reg_no){
		global $connection;
		$query = "SELECT count(*) FROM visit ";
		$query .= " WHERE reg_no ='{$reg_no}' ";

		$visit_set = mysqli_query($connection, $query);
		confirm_query($visit_set);

		// pre(mysqli_fetch_array($patient_set));
		return $visit_set;

}


	function find_lab($visit_id){

		global $connection;

		$query = "SELECT * FROM visits WHERE visit_id={$visit_id} ";

		$lab_set = mysqli_query($connection, $query);
		confirm_query($lab_set);

		return $lab_set;

	}

	function find_laboratory_result($visit_no){

		global $connection;

		$query = "SELECT * FROM laboratory_test ";
		$query .= "  WHERE visit_no='{$visit_no}' ";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function issue_medication($visit_no){

		global $connection;

		$query = "SELECT * FROM treatment ";
		$query .= "  WHERE visit_no='{$visit_no}' ";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}
	//end of finding laboratory test

	function drug($s_no){

		global $connection;

		$query = "SELECT * FROM drugs WHERE `s_no` =  '{$s_no}' ";


		$drug = mysqli_query($connection, $query);
		confirm_query($drug);

		return $drug;
	}

///FUNCTIONS FOR QUERRYING AT END USER TABLES

//USED AT NURSES
	function find_nurse($page=0, $limit=0){
		$offset = (int) $page * 15;
		global $connection;
		$query = " SELECT * FROM visit WHERE attended=0 ORDER BY visit_no DESC  ";

		if($limit>0){
			$query.= "LIMIT 15 OFFSET {$offset}";
		}

		$nurse = mysqli_query($connection, $query);
		confirm_query($nurse);

		return $nurse;
	}
//USED AT DOCTORS
	function find_doctors($page=0, $limit=0){
			$offset = (int) $page * 15;
		global $connection;

		$query = "SELECT * FROM visit WHERE attended=1 ORDER BY visit_no DESC ";

		if($limit>0){
			$query.= "LIMIT 15 OFFSET {$offset}";
	}

		$visit_set = mysqli_query($connection, $query);
		confirm_query($visit_set);

		return $visit_set;

	}

//USED AT DOCTORS LAB RESULTS
	function find_laboratory_test($page=0, $limit=0){
			$offset = (int) $page * 15;
		global $connection;
			$var =1;
		$query = "SELECT * FROM laboratory_test ORDER BY visit_no DESC ";

		if($limit>0){
			$query.= "LIMIT 15 OFFSET {$offset}";
	}

		$lab_set = mysqli_query($connection, $query);
		confirm_query($lab_set);

		return $lab_set;

	}

//USED AT LABORATORY QUERRY
	function find_laboratory_que($page=0, $limit=0){
			$offset = (int) $page * 15;
		global $connection;
			// $var = array('1', '2');
		$query = "SELECT * FROM laboratory_test WHERE attended=0 or attended=1 ORDER BY visit_no DESC ";

		if($limit>0){
			$query.= "LIMIT 15 OFFSET {$offset}";
	}

		$lab_set = mysqli_query($connection, $query);
		confirm_query($lab_set);

		return $lab_set;

	}
//USED AT PHARMACY
	function find_prescriptions($page=0, $limit=0){
			$offset = (int) $page * 15;
		global $connection;

		$query = "SELECT * FROM treatment WHERE prescription is NOT NULL and attended=0  ORDER BY visit_no DESC ";

		if($limit>0){
			$query.= "LIMIT 15 OFFSET {$offset}";
	}

		$p_set = mysqli_query($connection, $query);
		confirm_query($p_set);

		return $p_set;

	}

//USED AT TO GENERATE REPORTS
		function find_cleared_patients($page=0, $limit=0){
			$offset = (int) $page * 15;
		global $connection;

		$query = "SELECT * FROM visit WHERE attended=2 ORDER BY visit_no DESC ";

		if($limit>0){
			$query.= "LIMIT 15 OFFSET {$offset}";
	}

		$p_set = mysqli_query($connection, $query);
		confirm_query($p_set);

		return $p_set;

	}

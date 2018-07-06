<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname = "localhost";
$database = "hosy2";
$username = "root";
$password = "";
$connection= mysqli_connect($hostname, $username, $password, $database);
//Testing connection

if (mysqli_connect_errno()){

	die('connection failed' . mysqli_connect_error() . '(' . mysqli_connect_errno() . ')');
}

?>

<?php

session_start();
include"../service/check_login.php";

	$id_user = $_SESSION['id_user'];
	
include'../service/mysql_config.php';
$conn = mysql_connect($host, $username, $password) or die(mysql_error());
mysql_select_db($database, $conn);

$email = md5($_GET['emailOld']);

	$sql = "SELECT $id_user FROM user WHERE email='$email'";
    $result = mysql_fetch_row(mysql_query($sql));
		
	if($result[0] == $id_user){
		if(filter_var($_GET["email1"], FILTER_VALIDATE_EMAIL) && strlen($_GET["email1"]) > 5){
			$insert_email = mysql_real_escape_string( md5($_GET["email1"]) );
			$sql2 = "UPDATE user SET email='$insert_email' WHERE id_user='$id_user'";
			$result = mysql_query($sql2, $conn) or die(mysql_error());
			header("location: ../settings.php?er=1");
		} else 
			header("location: ../settings.php?er=2");
	} else 
		header("location: ../settings.php?er=2");
		
	
	
	
?>
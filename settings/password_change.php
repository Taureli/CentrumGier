<?php

session_start();
include"../service/check_login.php";

	$id_user = $_SESSION['id_user'];
	
include'../service/mysql_config.php';
$conn = mysql_connect($host, $username, $password) or die(mysql_error());
mysql_select_db($database, $conn);

$password = md5($_GET['passOld']);

	$sql = "SELECT $id_user FROM user WHERE password='$password'";
    $result = mysql_fetch_row(mysql_query($sql));
		
	if($result[0] == $id_user){
		if(strlen($_GET["pass1"]) > 7){
			$insert_password = mysql_real_escape_string( md5($_GET["pass1"]) );
			$sql2 = "UPDATE user SET password='$insert_password' WHERE id_user='$id_user'";
			$result = mysql_query($sql2, $conn) or die(mysql_error());
			header("location: ../settings.php?er=1");
		} else 
			header("location: ../settings.php?er=3");
	} else 
		header("location: ../settings.php?er=3");
		
	
	
	
?>
<?php

session_start();
include"../service/check_login.php";

	$id_user = $_SESSION['id_user'];
	
include'../service/mysql_config.php';
$conn = mysql_connect($host, $username, $password) or die(mysql_error());
mysql_select_db($database, $conn);

$email = md5($_GET['email']);
$password = md5($_GET['password']);

	$sql = "SELECT $id_user FROM user WHERE password='$password' AND email='$email'";
    $result = mysql_fetch_row(mysql_query($sql));
		
	if($result[0] == $id_user){
	
		$sql2 = "DELETE FROM user WHERE id_user='$id_user'";
		$result = mysql_query($sql2, $conn) or die(mysql_error());
		$sql3 = "DELETE FROM pack WHERE id_user='$id_user'";
		$result = mysql_query($sql3, $conn) or die(mysql_error());
		session_destroy();
		header("location: ../index.php");
			
	} else 
		header("location: ../settings.php?er=4");
		
	
	
	
?>
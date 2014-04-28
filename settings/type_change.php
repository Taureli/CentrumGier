<?php

session_start();
include"../service/check_login.php";

	$id_user = $_SESSION['id_user'];
	
include'../service/mysql_config.php';
$conn = mysql_connect($host, $username, $password) or die(mysql_error());
mysql_select_db($database, $conn);

	$sql = "SELECT hide_user FROM user WHERE id_user='$id_user'";
    $result = mysql_fetch_row(mysql_query($sql));
		
	if($result[0] == '0')
		$sql2 = "UPDATE user SET hide_user='1' WHERE id_user='$id_user'";
	else
		$sql2 = "UPDATE user SET hide_user='0' WHERE id_user='$id_user'";
		
	$result = mysql_query($sql2, $conn) or die(mysql_error());
	header("location: ../settings.php?er=1");
	
?>
<?php

session_start();
include"../service/check_login.php";

	$id = $_GET['id'];
	
include'../service/mysql_config.php';
$conn = mysql_connect($host, $username, $password) or die(mysql_error());
mysql_select_db($database, $conn);

	$sql = "SELECT hidden FROM pack WHERE id_pack='$id'";
    $result = mysql_fetch_row(mysql_query($sql));
		
	if($result[0] == '0')
		$sql2 = "UPDATE pack SET hidden='1' WHERE id_pack='$id'";
	else
		$sql2 = "UPDATE pack SET hidden='0' WHERE id_pack='$id'";
		
	$result = mysql_query($sql2, $conn) or die(mysql_error());
	header("location: ../edit.php?id=$id");
	
?>
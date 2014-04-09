<?php
session_start();
include"../service/check_login.php";
include'../service/mysql_config.php';

    $conn = mysql_connect($host, $username, $password) or die(mysql_error());
    mysql_select_db($database, $conn);
	
	$id = $_SESSION['id_user'];

	if($_GET['profession']){
		$prof=$_GET['profession'];
		$sql = "UPDATE user SET profession=$prof WHERE id_user=$id";
		$result = mysql_query($sql, $conn) or die(mysql_error());
	}
	
?>
<?php
session_start();
include"../service/check_login.php";
include'../service/mysql_config.php';

    $conn = mysql_connect($host, $username, $password) or die(mysql_error());
    mysql_select_db($database, $conn);
	
	$id = $_SESSION['id_user'];
	
	if($_GET['name'] != NULL && strlen($_GET["name"]) > 2){
		$name = mysql_real_escape_string($_GET['name']);
		$sql = "UPDATE user SET name='$name' WHERE id_user='$id'";
		$result = mysql_query($sql, $conn) or die(mysql_error());
	}
	
	if($_GET['surname'] != NULL && strlen($_GET["surname"]) > 2){
		$surname = mysql_real_escape_string($_GET['surname']);
		$sql = "UPDATE user SET surname='$surname' WHERE id_user='$id'";
		$result = mysql_query($sql, $conn) or die(mysql_error());
	}

	if($_GET['profession'] != NULL){
		$prof = mysql_real_escape_string($_GET['profession']);
		$sql = "UPDATE user SET profession='$prof' WHERE id_user='$id'";
		$result = mysql_query($sql, $conn) or die(mysql_error());
	}
	
	if($_GET['info'] != NULL){
		$info = mysql_real_escape_string($_GET['info']);
		$sql = "UPDATE user SET info='$info' WHERE id_user='$id'";
		$result = mysql_query($sql, $conn) or die(mysql_error());
	}
	
	exit(header("location: ../settings.php?er=1"));
	
?>
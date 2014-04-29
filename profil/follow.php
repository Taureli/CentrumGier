<?php

session_start();
include"../service/check_login.php";

$id_user = $_SESSION['id_user'];
$id = $_GET['id'];
	
include'../service/mysql_config.php';
$conn = mysql_connect($host, $username, $password) or die(mysql_error());
mysql_select_db($database, $conn);

	$sql = "INSERT INTO watch VALUES ($id_user, $id)";
    $result = mysql_query($sql, $conn) or die(mysql_error());
	
	header("location: ../profil.php?id=$id");
	
?>
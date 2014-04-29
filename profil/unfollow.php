<?php

session_start();
include"../service/check_login.php";

$id_user = $_SESSION['id_user'];
$id = $_GET['id'];
	
include'../service/mysql_config.php';
$conn = mysql_connect($host, $username, $password) or die(mysql_error());
mysql_select_db($database, $conn);

	$sql = "DELETE FROM watch WHERE kto='$id_user' AND kogo='$id'";
    $result = mysql_query($sql, $conn) or die(mysql_error());
	
	header("location: ../profil.php?id=$id");
	
?>
<?php

session_start();
include"../service/check_login.php";

include'../service/mysql_config.php';
$conn = mysql_connect($host, $username, $password) or die(mysql_error());
mysql_select_db($database, $conn);

$id = $_GET['id'];
$nowa = $_GET['star'];

$sql = "SELECT ratingSum FROM pack WHERE id_pack='$id'";
$result = mysql_fetch_row(mysql_query($sql));
$ratingSum = $result[0];

$sql2 = "SELECT ratingAmount FROM pack WHERE id_pack='$id'";
$result = mysql_fetch_row(mysql_query($sql2));
$ratingAmount = $result[0];

$ratingSum += $nowa;
$ratingAmount++;
$rating = $ratingSum / $ratingAmount;

$sql3 = "UPDATE pack SET rating='$rating', ratingAmount='$ratingAmount', ratingSum='$ratingSum' WHERE id_pack='$id'";
$result = mysql_query($sql3, $conn) or die(mysql_error());


header("location: ../pack.php?id=$id");

?>
<?php
session_start();
include"../service/check_login.php";
include'../service/mysql_config.php';

    $conn = mysql_connect($host, $username, $password) or die(mysql_error());
    mysql_select_db($database, $conn);
	
	$id = $_GET['p_id'];
	
	if($_GET['name'] != NULL){
		$name = mysql_real_escape_string($_GET['name']);
		$sql = "UPDATE pack SET name='$name' WHERE id_pack='$id'";
		$result = mysql_query($sql, $conn) or die(mysql_error());
	}
	
	if($_GET['subject'] != NULL){
		$subject = mysql_real_escape_string($_GET['subject']);
		$sql = "UPDATE pack SET subject='$subject' WHERE id_pack='$id'";
		$result = mysql_query($sql, $conn) or die(mysql_error());
	}

	if($_GET['info'] != NULL){

		$sql = "SELECT descr FROM pack WHERE id_pack='$id'";
		$result = mysql_fetch_row(mysql_query($sql));
		$filename = '../packs/' . $result[0];

		unlink($filename);

		$content = $_GET["info"];

		//echo "open";
	    $handle = fopen($filename, 'x+');
	    //echo " write";
	    fwrite($handle, $content);
	    //echo " close";
	    fclose($handle);

	}
	
	exit(header("location: ../edit.php?id=$id"));
?>
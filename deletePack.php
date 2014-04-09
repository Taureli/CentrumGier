<?php

session_start();
include "service/check_login.php";

require('service/mysql_config.php');

        $conn = mysql_connect($host, $username, $password) or die(mysql_error());
        mysql_select_db($database, $conn);
		
		$id = $_GET['id'];

        $sql = "SELECT id_user, file, descr FROM pack WHERE id_pack='$id'";
        $result = mysql_query($sql, $conn) or die(mysql_error());
        while ($row2 = mysql_fetch_array($result)) {
            $checkID = $row2['id_user'];
			$file = $row2['file'];
			$descr = $row2['descr'];
        }
		
		if($checkID !=  $_SESSION['id_user']){
			//echo 'Brak dostêpu!';
			header("Location: index.php?er=10");
		} else {
		
			$directory = 'packs/';
			
			unlink($directory.$file);
			unlink($directory.$descr);
			$sql = "DELETE FROM pack WHERE id_pack='$id'";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			header("Location: index.php?er=11");
		}
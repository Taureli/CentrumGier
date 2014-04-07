<?php

session_start();
include"../service/check_login.php";

include'../service/mysql_config.php';
if ($_GET["game"] && $_GET["name"] && $_GET["subject"] && $_GET["descr"] && $_GET["numb"]) {
    $conn = mysql_connect($host, $username, $password) or die(mysql_error());
    mysql_select_db($database, $conn);

    $insert_name = mysql_real_escape_string($_GET["name"]);
    $file_name = preg_replace('/\s+/', '_', $insert_name);  //USUWAM SPACJE
    $author = $_SESSION['id_user'];
    $game = $_GET["game"];
    $subject = $_GET["subject"];

    //AKTUALNA DATA
    $cur_date = date('YmdHis');

    $filename = '../packs/descr/' . $file_name . $cur_date . '.txt';
    $content = $_GET["descr"];

    //echo "open";
    $handle = fopen($filename, 'x+');
    //echo " write";
    fwrite($handle, $content);
    //echo " close";
    fclose($handle);


//    if ($handle = fopen($filename, 'a')) {
//        if (is_writable($filename)) {
//            if (fwrite($handle, $content) === FALSE) {
//                echo "Cannot write to file $filename";
//                exit;
//            }
//            echo "The file $filename was created and written successfully!";
//            fclose($handle);
//        } else {
//            echo "The file $filename, could not written to!";
//            exit;
//        }
//    } else {
//        echo "The file $filename, could not be created!";
//        exit;
//    }

    $desc_file = 'descr/' . $file_name . $cur_date . '.txt';

//INSERT
    $sql = "insert into pack (id_user,name,game,subject,descr)values('$author','$insert_name','$game','$subject','$desc_file')";
    $result = mysql_query($sql, $conn) or die(mysql_error());
    $pack_id = mysql_insert_id();
    header("location: ../kreator.php?game=race&p_id=" . $pack_id . "&numb=" . $_GET['numb']."&name=".$insert_name);
} else
    header("location: ../kreator.php?game=race&er=1");  //Puste pola
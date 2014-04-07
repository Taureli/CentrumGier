<?php

session_start();
include"../service/check_login.php";

include'../service/mysql_config.php';
$conn = mysql_connect($host, $username, $password) or die(mysql_error());
mysql_select_db($database, $conn);

$insert_name = mysql_real_escape_string($_GET["name"]);
$file_name = preg_replace('/\s+/', '_', $insert_name);  //USUWAM SPACJE
$cur_date = date('YmdHis');

$filename1 = $file_name . $cur_date . '.txt'; //DO WSTAWIENIA DO BAZY
$filename = '../packs/' . $filename1;
$handle = fopen($filename, 'x+');

$numb = $_GET['numb'];

$content = $numb . "\r\n";
fwrite($handle, $content);

for ($i = 1; $i <= $numb; $i++) {

    $content = $_GET['pytanie' . $i . ''] . "\r\n";
    fwrite($handle, $content);

    if (isset($_GET['checka' . $i . '']))
        $content = "1\r\n";
    else
        $content = "0\r\n";
    fwrite($handle, $content);
}

fclose($handle);

//INSERT
$p_id = $_GET['p_id'];
$sql = "UPDATE pack SET file='$filename1',hidden=0,make_date='$cur_date' WHERE id_pack='$p_id'";
$result = mysql_query($sql, $conn) or die(mysql_error());
header("location: ../index.php?er=1");

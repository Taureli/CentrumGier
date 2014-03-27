<?php

session_start();
include"../service/check_login.php";

include'../service/mysql_config.php';
$conn = mysql_connect($host, $username, $password) or die(mysql_error());
mysql_select_db($database, $conn);

$insert_name = mysql_real_escape_string($_GET["name"]);
$file_name = preg_replace('/\s+/', '_', $insert_name);  //USUWAM SPACJE
$cur_date = date('YmdHis');

$filename1 = $file_name . $cur_date . '.xml'; //DO WSTAWIENIA DO BAZY
$filename = '../packs/' . $filename1;
$handle = fopen($filename, 'x+');

$content = '<?xml version="1.0" encoding="utf-8" ?><lista><dziedzina nazwa="';
fwrite($handle, $content);
fwrite($handle, $insert_name);
$content = '">';
fwrite($handle, $content);

$numb = $_GET['numb'];
for ($i = 1; $i <= $numb; $i++) {

    $content = '<pytanie><tresc>' . $_GET['pytanie' . $i . ''] . '</tresc><poprawna>';
    fwrite($handle, $content);

    if (isset($_GET['checka' . $i . '']))
        $content = 'a</poprawna><a>';
    elseif (isset($_GET['checkb' . $i . '']))
        $content = 'b</poprawna><a>';
    elseif (isset($_GET['checkc' . $i . '']))
        $content = 'c</poprawna><a>';
    elseif (isset($_GET['checkd' . $i . '']))
        $content = 'd</poprawna><a>';
    fwrite($handle, $content);

    $content = $_GET['odpa' . $i . ''] . '</a><b>' . $_GET['odpb' . $i . ''] . '</b><c>' . $_GET['odpc' . $i . ''] . '</c><d>' . $_GET['odpd' . $i . ''] . '</d></pytanie>';
    fwrite($handle, $content);
}

$content = '</dziedzina></lista>';
fwrite($handle, $content);

fclose($handle);

//INSERT
$p_id = $_GET['p_id'];
$sql = "UPDATE pack SET file='$filename1',hidden=0,make_date='$cur_date' WHERE id_pack='$p_id'";
$result = mysql_query($sql, $conn) or die(mysql_error());
header("location: ../index.php?er=1");

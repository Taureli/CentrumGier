<?php

session_start();
include"service/check_login.php";

include"service/mysql_config.php";
$conn = mysql_connect($host, $username, $password) or die(mysql_error());
mysql_select_db($database, $conn);

$id = $_GET['id'];
$id_user = $_SESSION['id_user'];

$sql = "SELECT id_user, file FROM pack WHERE id_pack='$id'";
$result = mysql_fetch_row(mysql_query($sql));

//JESLI ZALOGOWANY != AUTOR, ZWIEKSZ LICZBE POBRAN
if($id_user != $result[0]){
    mysql_query("UPDATE pack SET downloads=downloads+1 WHERE id_pack='$id'");
}

$filePath = "packs/" . $result[1];

//ZMUSZAM DO POBRANIA PLIKU (WCZESNIEJ TYLKO OTWIERAL W PRZEGLADARCE)
header('Content-type: application/force-download');
header('Content-Disposition: attachment; filename=' . $result[1] . '');

$content = fread(fopen($filePath, 'r'),  filesize($filePath));

echo $content;
exit();
//-------------------------------------------------------------------

//header("location: pack.php?id=".$id."");

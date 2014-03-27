<?php

include 'mysql_config.php';

mysql_connect("$host", "$username", "$password") or die("Nie można połączyć z bazą");
mysql_select_db("$database") or die("Nie można wybrać bazy");

$email = md5($_POST['email']);
$haslo = md5($_POST['haslo']);
//$haslo = stripslashes($haslo); //zabezpieczenia
//$email = stripslashes($email);
//$email = mysql_real_escape_string($email);
//$haslo = mysql_real_escape_string($haslo);

$sql = "SELECT * FROM user WHERE email='$email' and password='$haslo'";
$result = mysql_query($sql);

$sprawdz = mysql_num_rows($result); //Ilosc zwroconych danych

if ($sprawdz == 1) {

    $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $database . ';port=' . $port . '', $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id_user, warn, name, surname FROM user WHERE email='$email'");
    foreach ($stmt as $row) {

        //sprawdzam czy konto jest zablokowane
        if ($row['warn'] != NULL && $row['warn'] != 0) {
            exit(header("Location: ../index.php?er=9"));
        } else {

            session_start();

            $id = $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['surname'] = $row['surname'];
            
            $cur_date = date('Y-m-d H:i:s');
            $last_log = $pdo->query("UPDATE user SET last_login='$cur_date' WHERE id_user='$id'");
            $last_log->closeCursor();
            
        }
    }
    $stmt->closeCursor();

    $_SESSION['email'] = $email;

    header("Location: ../index.php");
} else {
    //echo 'Logowanie nieudane. Sprawdź pisownię nicku oraz hasła.';
    header("Location: ../index.php?er=1");
}
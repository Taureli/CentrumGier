<?php

include'mysql_config.php';
if ($_GET["email"] && $_GET["password"] && $_GET["name"] && $_GET["surname"]) {
    $conn = mysql_connect($host, $username, $password) or die(mysql_error());
    mysql_select_db($database, $conn);

    //SPRAWDZANIE POPRAWNOSCI DANYCH
    if (!filter_var($_GET["email"], FILTER_VALIDATE_EMAIL)) {   //czy email
        exit(header("location: ../index.php?er=5"));
    }elseif(strlen($_GET["email"]) < 6){            //długość maila
        exit(header("location: ../index.php?er=5"));
    }
    
    if(strlen($_GET["password"]) < 8){  //hasło powinno mieć min. 8 znaków
        exit(header("location: ../index.php?er=6"));
    }
    
    if(strlen($_GET["name"]) < 3){  //długość imienia
        exit(header("location: ../index.php?er=7"));
    }
    
    if(strlen($_GET["surname"]) < 3){  //długość nazwiska
        exit(header("location: ../index.php?er=8"));
    }
    
    $insert_email = mysql_real_escape_string( md5($_GET["email"]) );
    $insert_password = mysql_real_escape_string( md5($_GET["password"]) );
    $insert_name = mysql_real_escape_string( $_GET["name"] );
    $insert_surname = mysql_real_escape_string( $_GET["surname"] );

    //SPRAWDZANIE W BAZIE
//    $email = md5($_GET["email"]);
//    $password = md5($_GET["password"]);

    //sprawdzam czy juz jest taki email
    //$email = $_GET['email'];
    $sql = "SELECT * FROM user WHERE email='$insert_email'";
    $result = mysql_query($sql, $conn) or die(mysql_error());

    $sprawdz = mysql_num_rows($result); //Ilosc zwroconych danych

    if ($sprawdz > 0) {
        header("location: ../index.php?er=4");
    } else {
        $sql = "insert into user (email,password,name,surname)values('$insert_email','$insert_password','$insert_name','$insert_surname')";
        $result = mysql_query($sql, $conn) or die(mysql_error());
        header("location: ../index.php?er=2");
    }
} else
    header("location: ../index.php?er=3");  //Puste pola
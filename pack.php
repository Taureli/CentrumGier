<?php
session_start();
include"service/check_login.php";

if (!isset($_GET['id']))
    header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Test kreatora">
        <meta name="author" content="Jakub Karolczak">
        <link rel="shortcut icon" href="res/favicon.ico">

        

        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

        <!-- NAVBAR -->
        <?php include 'service/navbar.php'; ?>

        <!-- CONTENT -->
        <div class="container">

            <div class="row row-offcanvas row-offcanvas-right">
                <?php
                require('service/mysql_config.php');
                require('pack/pack_service.php');
                
                $id = $_GET['id'];

                mysql_connect("$host", "$username", "$password") or die("Nie można połączyć z bazą");
                mysql_select_db("$database") or die("Nie można wybrać bazy");

                $baza = new Baza($dbms, $host, $database, $port, $username, $password);

                //NAGLOWEK
                $baza->header($id);
                
                //OPIS
                echo '<div class="col-8 col-sm-8 col-lg-8">'
                   . '<h3>Opis zestawu: </h3>'
                   . '<div class="well well-lg">';
                $baza->description($id);
                echo '</div></div>';
                
                echo '<div class="col-md-3 col-md-offset-1"><br><br><br>';
                
                //DOWNLOAD BUTTON
                echo "<a href=download.php?id=$id class='btn btn-lg btn-success'>Pobierz zestaw &nbsp;<span class='glyphicon glyphicon-download'></span></a>";
                
                //INFO
                echo '<br><br>';
                $baza->info($id);
                
                echo '</div>'
                
                ?>
            </div>

            <!-- FOOTER -->
            <?php include"footer.php"; ?>

    </body>
</div>
</html>

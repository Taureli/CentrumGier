<?php
session_start();
include"service/check_login.php";
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

        <title>Pomoc</title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

        <!-- NAVBAR -->
        <?php include 'service/navbar.php'; ?>

        <!-- CONTENT -->
        <div class="container">

        <br><br>

            <div class="row row-offcanvas row-offcanvas-right col-md-12">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-success">
                      <div class="panel-body">
                        Kontakt z autorami:
                      </div>
                      <div class="panel-footer"><a href="mailto:jakkar992@gmail.com">E-mail</a></div>
                    </div>
                </div>
            </div><!--/row-->

            <br><br>
            <!-- FOOTER -->
            <?php include"footer.php"; ?>

    </body>
    </div>
</html>
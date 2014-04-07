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

        <title>Kreator zestawów</title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

        <!-- NAVBAR -->
        <?php include 'service/navbar.php'; ?>

        <div class="container">

            <div class="row row-offcanvas row-offcanvas-right">

                <div class="row">
                    <div class="col-6 col-sm-6 col-lg-6 col-md-offset-3">

                        <?php
                        if (!isset($_GET['game'])) {
                            echo"<div class='col-md-offset-3'>"
                            . "<h2>Wybierz rodzaj gry:</h2><br>"
                            . "</div>"
                            . "<div class='well' style='max-width: 450px; margin: 0 auto 10px;'>"
                            . "<a href='kreator.php?game=quiz' type='button' class='btn btn-primary btn-lg btn-block'>Quiz</a>"
                            . "<a href='kreator.php?game=race' type='button' class='btn btn-primary btn-lg btn-block'>Wyścigi</a>"
                            . "</div>";
                        } else {
                            switch ($_GET['game']) {
                                case 'quiz':
                                    if (!isset($_GET['p_id'])) {
                                        include "kreator/quiz_form.php";
                                        break;
                                    } else {
                                        include "kreator/quiz_form2.php";
                                        break;
                                    }
                                case 'memo':
                                    include "kreator/memo_form.php";
                                    break;
								case 'race':
                                    if (!isset($_GET['p_id'])) {
                                        include "kreator/race_form.php";
                                        break;
                                    } else {
                                        include "kreator/race_form2.php";
                                        break;
                                    }
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <?php include"footer.php"; ?>

    </body>
</html>

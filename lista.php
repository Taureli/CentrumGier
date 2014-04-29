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

        <title>Lista zestawów</title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>

    <body>
        <!-- NAVBAR -->
        <?php include 'service/navbar.php'; ?>

        <div class="container">

            <div class="row row-offcanvas row-offcanvas-right">

                <h3>Spis zestawów:</h3>
                <br>

                <div class="row">
                    <div class="col-md-10">
                        <?php
                        require('service/mysql_config.php');
                        require('lista/list.php');
                        $baza = new Baza($dbms, $host, $database, $port, $username, $password);
                        
						$id = $_SESSION['id_user'];
						
						if (isset($_GET['me'])) {
							$baza->pack_my_list($id);
						} else if(isset($_GET['watch']))
							$baza->pack_watch_list($id);
						else
							$baza->pack_all_list();
                        
                        ?>

                        <!--                        PAGINATOR-->
<!--                        <div class="row">
                            <div class="col-md-offset-4">
                                <ul class="pagination">
                                    <li class="disabled"><a href="#">&laquo;</a></li>
                                    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>-->

                    </div>
                </div>


            </div><!--/row-->
    </body>

    <?php include'footer.php'; ?>
</div>

</html>
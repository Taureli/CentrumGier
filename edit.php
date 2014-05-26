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

        <title>Edycja zestawu</title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>

    <body>
        <!-- NAVBAR -->
        <?php include 'service/navbar.php'; ?>
        
        <div class="container">

            <div class="row row-offcanvas row-offcanvas-right">
                <div class="row">
                    <div class="col-6 col-sm-6 col-lg-6 col-md-offset-3">
                        <br>
                    
                        <?php
                        require('service/mysql_config.php');
                        require('edit/display.php');
                        
                        $conn = mysql_connect($host, $username, $password) or die(mysql_error());
                        mysql_select_db($database, $conn);
                        $id = $_GET['id'];

                        $sql = "SELECT name, subject FROM pack WHERE id_pack='$id'";
                        $result = mysql_fetch_row(mysql_query($sql));
                        
                        $baza = new Baza($dbms, $host, $database, $port, $username, $password);
                        ?>
                        
                        <h2>Edycja zestawu</h2>
                        
                        <div class="btn-group">
                            <a href="edit/type_change.php?id=<?php echo $id ?>" role="button" class='btn btn-md btn-warning' ><?php echo $baza->typ($id) ?></a>
                        </div>
                        
                        <br><br>

                        <form id='settings' method="GET" action="edit/settings_service.php" class='form-horizontal'>
                            <fieldset>

                                <input class="hidden" type="text" name="p_id" id="P_id" value="<?php echo $id ?>">

                                <h4>Nazwa:</h4>

                                <input type="text" class="form-control" name="name" id="Name" placeholder='<?php echo $result[0]; ?>'>

                                <br>
                                
                                <h4>Kategoria:</h4>

                                <input type="text" class="form-control" name="subject" id="Subject" placeholder='<?php echo $result[1]; ?>'>

                                <br>

                                <h4>Opis:</h4>
                                <textarea class="form-control" rows="3" name="info" id="info" placeholder='<?php echo $baza->opis($id) ?>'></textarea>

                                <br><br>
                                <input class='btn btn-lg btn-success' value='Zatwierdź zmiany' type='submit'>

                            </fieldset>
                        </form><!--form-->
                    </div>
                </div>
            </div>
            
            <?php include'footer.php'; ?>
            
        </div>
        
    </body>
</div>
</html>
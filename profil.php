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

        <title>Profil</title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>

    <body>
        <!-- NAVBAR -->
        <?php include 'service/navbar.php'; ?>
		
		<div class="container">

            <div class="row row-offcanvas row-offcanvas-right">
			    <br>
			
			    <?php
				
				if (!isset($_GET['id'])) {
					header("Location: profil.php?id=" . $_SESSION['id_user']);
				}
				
                require('service/mysql_config.php');
                require('profil/profil_service.php');
                
                $id = $_GET['id'];

                mysql_connect("$host", "$username", "$password") or die("Nie można połączyć z bazą");
                mysql_select_db("$database") or die("Nie można wybrać bazy");

                $baza = new Baza($dbms, $host, $database, $port, $username, $password);
				
				echo'
				<div class="jumbotron" style="background-color: #BAE0FF;">';
					$baza->info($id);
				echo '</div>';
				
				echo '<div class="row">
				        <div class="col-8 col-sm-8 col-lg-8">
							<div class="panel panel-primary">
								<div class="panel-heading">Zestawy użytkownika:</div>';
									$baza->pack_list();
								echo '</div>
							</div>
							<div class="col-4 col-sm-4 col-lg-4">
								<div class="panel panel-info">
									<div class="panel-heading">Najczęściej pobierane:</div>';
										$baza->pack_downl();
									echo '</div>
								<div class="panel panel-info">
									<div class="panel-heading">Najlepiej oceniane:</div>';
										$baza->pack_top();
									echo '</div>
								</div>
						</div><!--/row-->';
				?>
			
			</div>
			
			<?php include'footer.php'; ?>
			
		</div>
		
	</body>
</div>

</html>
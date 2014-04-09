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

        <title>Ustawienia</title>

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
						
						$conn = mysql_connect($host, $username, $password) or die(mysql_error());
						mysql_select_db($database, $conn);
						$id_user = $_SESSION['id_user'];

						$sql = "SELECT name, surname, profession, info FROM user WHERE id_user='$id_user'";
						$result = mysql_fetch_row(mysql_query($sql));
						?>
						
						<h2>Ustawienia konta</h2>

						<form id='settings' method="GET" action="settings/settings_service.php" class='form-horizontal'>
							<fieldset>

								<h4>Imię:</h4>

								<input type="text" class="form-control" name="name" id="Name" placeholder='<?php echo $result[0]; ?>'>

								<br>
								
								<h4>Nazwisko:</h4>

								<input type="text" class="form-control" name="surname" id="surname" placeholder='<?php echo $result[1]; ?>'>

								<br>
								
								<h4>Hasło:</h4>

								<input type="text" class="form-control" name="password" id="password" placeholder="********">

								<br>
								
								<h4>Zawód:</h4>

								<input type="text" class="form-control" name="profession" id="profession" placeholder='<?php echo $result[2]; ?>'>

								<br>

								<h4>Krótka informacja o sobie:</h4>
								<textarea class="form-control" rows="3" name="info" id="info" placeholder='<?php echo $result[3]; ?>'></textarea>

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
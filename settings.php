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
						require('settings/type_password.php');
						
						$conn = mysql_connect($host, $username, $password) or die(mysql_error());
						mysql_select_db($database, $conn);
						$id_user = $_SESSION['id_user'];

						$sql = "SELECT name, surname, profession, info FROM user WHERE id_user='$id_user'";
						$result = mysql_fetch_row(mysql_query($sql));
						
						$baza = new Baza($dbms, $host, $database, $port, $username, $password);
						
						if (isset($_GET['er'])) {

							switch ($_GET['er']) {
								case 1:
									echo '
										<div class="alert alert-success alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>Zapisano zmiany!</strong>
										</div>
										';
									break;
								case 2:
									echo '
										<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>Podano błędny adres email!</strong>
										</div>
										';
									break;
								case 3:
									echo '
										<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>Podano błędne hasło!</strong>
										</div>
										';
									break;
								case 4:
									echo '
										<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>Podano błędne dane!</strong>
										</div>
										';
									break;
							}
						}
						?>
						
						<h2>Ustawienia konta</h2>
						
						<div class="btn-group">
							<button type="button" class='btn btn-md btn-primary' data-toggle="modal" data-target="#emailForm">Zmień email</button>
							<button type="button" class='btn btn-md btn-primary' data-toggle="modal" data-target="#passwordForm">Zmień hasło</button>
							<a href="settings/type_change.php" role="button" class='btn btn-md btn-warning' ><?php echo $baza->typ($id_user) ?></a>
							<button type="button" class='btn btn-md btn-danger' data-toggle="modal" data-target="#usunForm">Usuń konto</button>
						</div>
						
						<br><br>

						<form id='settings' method="GET" action="settings/settings_service.php" class='form-horizontal'>
							<fieldset>

								<h4>Imię:</h4>

								<input type="text" class="form-control" name="name" id="Name" placeholder='<?php echo $result[0]; ?>'>

								<br>
								
								<h4>Nazwisko:</h4>

								<input type="text" class="form-control" name="surname" id="surname" placeholder='<?php echo $result[1]; ?>'>

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

<div class="modal fade" id="emailForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="col-md-offset-1"><h3 class="modal-title" id="myModalLabel">Zmiana adresu email</h3></div>
            </div>
            <div class="modal-body">

                <form id='register' method="GET" action="settings/email_change.php" class='form-horizontal'>
                    <fieldset>
                        <div class="col-sm-10 col-md-offset-1">
                            <h5>Stary adres email:</h5>
                                <input type='text' name="emailOld" id="emailOld" placeholder='Stary email' class='form-control' maxlength="50">
                            <h5>Nowy adres email:</h5>
                                <input type='text' name="email1" id="email1" placeholder='Nowy email' class='form-control' maxlength="50">
                            <br>
							<div class="col-md"><h5>UWAGA! ADRES EMAIL JEST RÓWNIEŻ LOGINEM DO SERWISU!</h5></div>
                            <br>
							<input class='btn btn-success' value='Zmień email' type='submit'>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="passwordForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="col-md-offset-1"><h3 class="modal-title" id="myModalLabel">Zmiana hasła</h3></div>
            </div>
            <div class="modal-body">

                <form id='register' method="GET" action="settings/password_change.php" class='form-horizontal'>
                    <fieldset>
                        <div class="col-sm-10 col-md-offset-1">
                            <h5>Stare hasło:</h5>
                                <input type='password' name="passOld" id="passOld" placeholder='Stare hasło' class='form-control' maxlength="50">
                            <h5>Nowe hasło:</h5>
                                <input type='password' name="pass1" id="pass1" placeholder='Nowe hasło' class='form-control' maxlength="50">
                            <br>
							<div class="col-md"><h6>Hasło musi składać się z przynajmniej 8 znaków</h6></div>
                            <br>
							<input class='btn btn-success' value='Zmień hasło' type='submit'>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="usunForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="col-md-offset-1"><h3 class="modal-title" id="myModalLabel">Usunięcie konta</h3></div>
            </div>
            <div class="modal-body">

                <form id='register' method="GET" action="settings/account_delete.php" class='form-horizontal'>
                    <fieldset>
                        <div class="col-sm-10 col-md-offset-1">
                            <h5>Twój email:</h5>
                                <input type='text' name="email" id="email" placeholder='Email' class='form-control' maxlength="50">
                            <h5>Twoje hasło:</h5>
                                <input type='password' name="password" id="password" placeholder='Hasło' class='form-control' maxlength="50">
                            <br>
							<div class="col-md"><h5>UWAGA! USUNIĘCIE KONTA JEST NIEODWRACALNE ORAZ SPOWODUJE USUNIĘCIE WSZYSTKICH TWOICH ZESTAWÓW!</h5></div>
                            <br>
							<input class='btn btn-danger' value='Usuń konto' type='submit'>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</html>
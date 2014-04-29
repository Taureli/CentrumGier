<br><br>
<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">
	
	<?php
	if (isset($_GET['er'])) {

            switch ($_GET['er']) {
                case 10:
                    echo '
                        <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Błąd!</strong> Brak dostępu!
                        </div>
                        ';
                    break;
				case 11:
                    echo '
                        <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Zestaw został usunięty!</strong>
                        </div>
                        ';
                    break;
				case 12:
                    echo '
                        <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Sukces!</strong> Stworzono nowy zestaw pytań!
                        </div>
                        ';
                    break;
			}
	}
	?>


        <div class="jumbotron" style="background-color: #BAE0FF;">
            <h2><?php echo $_SESSION['name'].' '.$_SESSION['surname']; ?></h2>
            <p>
            <div class="btn-group">
                <a href="kreator.php" role="button" class="btn btn-primary">
                    <span class="glyphicon glyphicon-pencil"></span>
                    <br>Stwórz
                </a>
                <a href="lista.php" role="button" class="btn btn-primary">
                    <span class="glyphicon glyphicon-list"></span>
                    <br>Zestawy 
                </a>
                <a href="userList.php" role="button" class="btn btn-primary">
                    <span class="glyphicon glyphicon-user"></span>
                    <br>Użytkownicy
                </a>
                <a href="userList.php?watch=t" role="button" class="btn btn-primary">
                    <span class="glyphicon glyphicon-eye-open"></span>
                    <br>Obserwowani
                </a>
                <a href="settings.php" role="button" class="btn btn-primary">
                    <span class="glyphicon glyphicon-cog"></span>
                    <br>Ustawienia
                </a>
            </div>
            </p>
        </div>

        <?php
		$id = $_SESSION['id_user'];
        require('service/mysql_config.php');
        require('main/pack_list.php');
        $baza = new Baza($dbms, $host, $database, $port, $username, $password);

        echo '<div class="row">
            <div class="col-2 col-sm-2 col-lg-2">
                <div class="panel panel-info">
                    <div class="panel-heading">Twoje statystyki:</div>';
        $baza->stats();
		echo '</div>
			<div class="panel panel-info">
                    <div class="panel-heading">Aktywność obserwowanych:</div>';
		$baza->watch($id);
        echo '</div>
            </div>
            <div class="col-7 col-sm-7 col-lg-7">
                <div class="panel panel-primary">
                    <div class="panel-heading">Twoje zestawy:</div>';
        $baza->pack_list();
        echo '</div>
            </div>
                <div class="col-3 col-sm-3 col-lg-3">
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
    </div><!--/row-->

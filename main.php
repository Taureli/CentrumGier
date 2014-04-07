<br><br>
<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">


        <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
        </p>
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
                    <br>Przeglądaj 
                </a>
                <a href="userList.php" role="button" class="btn btn-primary">
                    <span class="glyphicon glyphicon-user"></span>
                    <br>Użytkownicy
                </a>
                <a href="profil.php" role="button" class="btn btn-primary">
                    <span class="glyphicon glyphicon-eye-open"></span>
                    <br>Obserwowani
                </a>
                <a href="profil.php" role="button" class="btn btn-primary">
                    <span class="glyphicon glyphicon-cog"></span>
                    <br>Ustawienia
                </a>
            </div>
            </p>
        </div>

        <?php
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

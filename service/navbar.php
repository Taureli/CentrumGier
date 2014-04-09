<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Centrum Gier</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Stwórz zestaw <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a>Wybierz grę:</ap></li>
                        <li class="divider"/>
                        <li><a href="kreator.php?game=quiz">Quiz</a></li>
                        <li><a href="kreator.php?game=race">Wyścigi</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Zestawy <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="lista.php?me=true">Twoje zestawy</a></li>
                        <li><a href="kreator.php">Zestawy obserwowanych</a></li>
                        <li><a href="lista.php">Wszystkie zestawy</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Użytkownicy <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="kreator.php">Obserwowani</a></li>
                        <li><a href="userList.php">Wszyscy użytkownicy</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php
                        echo $_SESSION['name'].' '.$_SESSION['surname'];
                        ?>
                        <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php">Panel główny</a></li>
                        <li><a href="profil.php">Twój profil</a></li>
                        <li><a href="settings.php">Ustawienia</a></li>
                        <li><a href="service/logout.php">Wyloguj</a></li>
                    </ul>
                </li>
                <li><a href="pomoc.php">Pomoc
                        <span class="glyphicon glyphicon-question-sign"></span>
                    </a></li>
            </ul>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</div><!-- /.navbar -->
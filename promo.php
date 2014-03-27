<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">

        <?php
        if (isset($_GET['er'])) {

            switch ($_GET['er']) {
                case 1:
                    echo '
                        <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Błąd!</strong> Niepoprawny login lub hasło, spróbuj zalogować się ponownie.
                        </div>
                        ';
                    break;
                case 2:
                    echo '
                        <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Rejestracja przebiegła poprawnie!</strong> Teraz możesz się zalogować używając podanego adresu email i hasła.
                        </div>
                        ';
                    break;
                case 3:
                    echo '
                        <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Błąd rejestracji!</strong> Upewnij się, czy wszystkie wymagane pola są wypełnione i spróbuj ponownie.
                        </div>
                        ';
                    break;
                case 4:
                    echo '
                        <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Błąd rejestracji!</strong> Już istnieje użytkownik z podanym adresem email.
                        </div>
                        ';
                    break;
                case 5:
                    echo '
                        <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Błąd rejestracji!</strong> Proszę podać prawdziwy adres email.
                        </div>
                        ';
                    break;
                case 6:
                    echo '
                        <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Błąd rejestracji!</strong> Hasło powinno składać się przynajmniej z 8 znaków.
                        </div>
                        ';
                    break;
                case 7:
                    echo '
                        <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Błąd rejestracji!</strong> Imię powinno składać się przynajmniej z 3 znaków.
                        </div>
                        ';
                    break;
                case 8:
                    echo '
                        <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Błąd rejestracji!</strong> Nazwisko powinno składać się przynajmniej z 3 znaków.
                        </div>
                        ';
                    break;
                case 9:
                    echo '
                        <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>UWAGA!</strong> Twoje konto zostało zablokowane i nie można się na nie zalogować!
                        </div>
                        ';
                    break;
            }
        }
        ?>

        <h1>Witaj w centrum gier!</h1>
        <p>Kreator zadań to niesamowite narzędzie służące do tworzenia w prosty i przyjemny sposób własnych zestawów pytań i odpowiedzi kompatybilnych z naszym oprogramowaniem.
            <br>Stwórz swoje konto i odkryj nowe sposoby nauczania!</p>
        <p><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#registerForm">Zarejestruj się! &raquo;</button></p>
        <?php include'service/registerForm.php'; ?>
    </div>
</div>

<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="res/index1.png" alt="">
                <div class="caption">
                    <h3>Twórz własne zestawy pytań!</h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="res/index2.png" alt="">
                <div class="caption">
                    <h3>Przeglądaj co zrobili inni!</h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="res/index3.png" alt="">
                <div class="caption">
                    <h3>Pobieraj gotowe zestawy!</h3>
                </div>
            </div>
        </div>

    </div>

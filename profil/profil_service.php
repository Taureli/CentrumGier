<?php

class Baza {

    function __construct($dbms, $host, $database, $port, $username, $password) {
        try {
            $this->pdo = new PDO($dbms . ':host=' . $host . ';dbname=' . $database . ';port=' .
                    $port, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone:<br> ' . $e->getMessage();
        }
    }

	function info($id_user) {

        $sql = "SELECT * FROM user WHERE id_user='$id_user'";
        $result = mysql_query($sql);
		
		$id = $_SESSION['id_user'];
		$sql2 = "SELECT kogo FROM watch WHERE kto='$id' AND kogo='$id_user'";
		$watch = mysql_fetch_row(mysql_query($sql2));

        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            echo '<h2>' . $row['name'] . ' ' . $row['surname'];
			if($id_user == $_SESSION['id_user']){
				echo '</a></h2>';
			} else if($watch[0] != NULL) {
				echo '
				<a href="profil/unfollow.php?id=' . $id_user . '" role="button" class="btn btn-xs btn-primary">
				<span class="glyphicon glyphicon-eye-close"></span> Nie obserwuj
                </a></h2>';
			} else {
				echo '
				<a href="profil/follow.php?id=' . $id_user . '" role="button" class="btn btn-xs btn-primary">
				<span class="glyphicon glyphicon-eye-open"></span> Obserwuj
                </a></h2>';
			}
			echo '<h4>' . $row['profession'] . '</h4>';
			echo '<h5>' . $row['info'] . '</h5>';
        }
    }
	
	    function pack_list() {

        $id_user = $_GET['id'];
        $stmt = $this->pdo->query("SELECT * FROM pack WHERE id_user='$id_user' && hidden=false");

            echo'<table class="table table-striped">
                        <tr>
                            <th>Nazwa</th>
                            <th>Gra</th>
                            <th>Przedmiot</th>
                            <th>Opcje</th>
                        </tr>';

            foreach ($stmt as $row) {
                $link = 'packs/' . $row['file'];
                $id = $row['id_pack'];
                echo '<tr>' .
                "<td>" . $row['name'] . "</td>" .
                '<td>' . $row['game'] . '</td>' .
                '<td>' . $row['subject'] . '</td>' .
                '<td>'
                . '<div class="btn-group">'.
                    "<a class='btn btn-xs btn-primary' href=pack.php?id=$id title='Zobacz szczegóły'><i class='glyphicon glyphicon-list'></i></a>".
                    '<a class="btn btn-xs btn-primary" href="download.php?id=' . $row['id_pack'] . '" title="Pobierz"><i class="glyphicon glyphicon-download"></i></a>
                </div>
                </td>' .
                '</tr>';
            }
            $stmt->closeCursor();

            echo' </table>';
            //echo '<br><div class="well well-sm"><h5>Nic nie znaleziono! Przejdź do kreatora i stwórz swój pierwszy zestaw pytań!</h5></div>';
		}
		
	function pack_downl() {
        $id_user = $_GET['id'];
        $stmt = $this->pdo->query("SELECT id_pack, name, game, subject, file FROM pack WHERE id_user='$id_user' && hidden=false ORDER BY downloads DESC LIMIT 0, 3");
        echo ' <table class="table">
                        <tr>
                            <th>Nazwa</th>
                            <th>Przedmiot</th>
                            <th>Gra</th>
                        </tr>';
        foreach ($stmt as $row) {
            $id = $row['id_pack'];
            echo '<tr>' .
            "<td><a href=pack.php?id=$id>" . $row['name'] . '</a></td>' .
            '<td>' . $row['subject'] . '</td>' .
            '<td>' . $row['game'] . '</td>' .
            '<td></td>' .
            '</tr>';
        }
        echo '</table>';
    }

    function pack_top() {
        $id_user = $_GET['id'];
        $stmt = $this->pdo->query("SELECT id_pack, name, game, subject, file FROM pack WHERE id_user='$id_user' && hidden=false ORDER BY rating DESC LIMIT 0, 3");
        echo '<table class="table">
                        <tr>
                            <th>Nazwa</th>
                            <th>Przedmiot</th>
                            <th>Gra</th>
                        </tr>';
        foreach ($stmt as $row) {
            $id = $row['id_pack'];
            echo '<tr>' .
            "<td><a href=pack.php?id=$id>" . $row['name'] . '</a></td>' .
            '<td>' . $row['subject'] . '</td>' .
            '<td>' . $row['game'] . '</td>' .
            '<td></td>' .
            '</tr>';
        }
        echo '</table>';
    }
	
}
?>
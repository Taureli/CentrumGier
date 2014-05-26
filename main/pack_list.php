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

    function pack_list() {

        $id_user = $_SESSION["id_user"];
        $stmt = $this->pdo->query("SELECT * FROM pack WHERE id_user='$id_user'");

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
                     <a class="btn btn-xs btn-primary" href="edit.php?id=' . $row['id_pack'] . '" title="Edytuj"><i class="glyphicon glyphicon-edit"></i></a>
                     <a class="btn btn-xs btn-danger" href="deletePack.php?id=' . $row['id_pack'] . '" title="Usuń"><i class="glyphicon glyphicon-remove"></i></a>
                </div>
                </td>' .
                '</tr>';
            }
            $stmt->closeCursor();

            echo' </table>';
            //echo '<br><div class="well well-sm"><h5>Nic nie znaleziono! Przejdź do kreatora i stwórz swój pierwszy zestaw pytań!</h5></div>';
    }

    function stats() {
        echo '<table class="table table-condensed table-striped">
                        <tr>
                            <td>Dodane zestawy: <span class="badge">';

        $id_user = $_SESSION["id_user"];

        $num_stmt = $this->pdo->query("SELECT count(name) FROM pack WHERE id_user='$id_user'");
        $num_packs = $num_stmt->fetch(PDO::FETCH_NUM);
        echo $num_packs[0];

        echo '</span></td>
                        </tr>
                        <tr>
                            <td>Ilość pobrań: <span class="badge">';

        if ($num_packs[0] != 0) {
            $down_stmt = $this->pdo->query("SELECT SUM(downloads) FROM pack WHERE id_user='$id_user'");
            $down_packs = $down_stmt->fetch(PDO::FETCH_NUM);
            echo $down_packs[0];
        } else {
            echo '0';
        }

        echo'</span></td>
                        </tr>
                        <tr>
                            <td>Średnia ocena: <span class="badge">';

        if ($num_packs[0] != 0) {
            $avg_stmt = $this->pdo->query("SELECT ROUND(AVG(rating),1) FROM pack WHERE id_user='$id_user' AND rating>0");
            $avg_packs = $avg_stmt->fetch(PDO::FETCH_NUM);
            echo $avg_packs[0];
        } else {
            echo '0';
        }

        echo '</span></td>
                        </tr>
                        <tr>
                            <td>Najwyższa ocena: <span class="badge">';

        if ($num_packs[0] != 0) {
            $top_stmt = $this->pdo->query("SELECT MAX(rating) FROM pack WHERE id_user='$id_user'");
            $top_packs = $top_stmt->fetch(PDO::FETCH_NUM);
            echo $top_packs[0];
        } else {
            echo '0';
        }

        echo '</span></td>
                        </tr>
                    </table>';
    }

    function pack_downl() {
        $id_user = $_SESSION["id_user"];
        $stmt = $this->pdo->query("SELECT id_pack, name, game, subject, file FROM pack WHERE id_user='$id_user' ORDER BY downloads DESC LIMIT 0, 3");
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
        $id_user = $_SESSION["id_user"];
        $stmt = $this->pdo->query("SELECT id_pack, name, game, subject, file FROM pack WHERE id_user='$id_user' ORDER BY rating DESC LIMIT 0, 3");
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
	
	function watch($idd) {
		include 'service/mysql_config.php';
		$conn = mysql_connect($host, $username, $password) or die(mysql_error());
		mysql_select_db($database, $conn);

        $id_user = $_SESSION["id_user"];
        $stmt = $this->pdo->query("SELECT id_pack, id_user, name FROM pack WHERE id_user IN (SELECT kogo FROM watch WHERE kto='$idd') ORDER BY make_date DESC LIMIT 0, 3");
        echo ' <table class="table table-condensed table-striped">';
        foreach ($stmt as $row) {
            $id = $row['id_pack'];
			$id_user = $row['id_user'];
			
			$sql = "SELECT name, surname FROM user WHERE id_user='$id_user'";
			$result = mysql_fetch_row(mysql_query($sql));
			
            echo '<tr>' .
			"<td><a href=profil.php?id=$id_user><span class='glyphicon glyphicon-user'> </span></a> " . $result[0] . " " . $result[1] . ":</td>" .
			'</tr><tr>' .
            "<td><a href=pack.php?id=$id>" . $row['name'] . '</a></td>' .
            '</tr>';
        }
        echo '</table>';
    }

}

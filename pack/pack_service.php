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

    function list_user($id_user) {

        include'service/mysql_config.php';
        $conn = mysql_connect($host, $username, $password) or die(mysql_error());
        mysql_select_db($database, $conn);

        $sql = "SELECT name, surname FROM user WHERE id_user='$id_user'";
        $result = mysql_query($sql, $conn) or die(mysql_error());
        while ($row2 = mysql_fetch_array($result)) {
            return $row2['name'] . ' ' . $row2['surname'];
        }
    }

    function header($id_pack) {

        $sql = "SELECT * FROM pack WHERE id_pack='$id_pack'";
        $result = mysql_query($sql);

        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            echo '<title>' . $row['name'] . '</title>
                  <div class="page-header">
                  <h1>' . $row['name'] . ' <small> ' . $this->list_user($row['id_user']) . '</small> </h1>
                  </div>';
        }
    }

    function description($id_pack) {

        $sql = "SELECT descr FROM pack WHERE id_pack='$id_pack'";
        $result = mysql_fetch_row(mysql_query($sql));

        $filePath = "packs/" . $result[0];

        $fh = fopen($filePath, 'r');
        while ($line = fgets($fh)) {
            echo $line;
        }
        fclose($fh);
    }

    function info($id_pack) {

        $sql = "SELECT id_user, game, subject, rating, downloads, hidden FROM pack WHERE id_pack='$id_pack'";
        $result = mysql_fetch_row(mysql_query($sql));

        echo '<ul class="list-group">
                <li class="list-group-item">
                    <span class="badge">' . $this->list_user($result[0]) . '
                    <a href="profil.php?id=' . $result[0] . '"> <span class="glyphicon glyphicon-user"> </span> </a>    
                    </span>
                    Autor:
                </li>
                <li class="list-group-item">
                <span class="badge">';
        $pom = 0;
        while ($pom < $result[3]) {
            echo '<span class="glyphicon glyphicon-star"></span>';
            $pom++;
        }
        while ($pom < 5) {
            echo '<span class="glyphicon glyphicon-star-empty"></span>';
            $pom++;
        }
        echo '</span>
                    Ocena:
                </li>
                <li class="list-group-item">
                    <span class="badge">' . $result[4] . '</span>
                    Ilość pobrań:
                </li>
                <li class="list-group-item">
                    <span class="badge">' . $result[2] . '</span>
                    Kategoria:
                </li>
                <li class="list-group-item">
                    <span class="badge">' . $result[1] . '</span>
                    Rodzaj gry:
                </li>';

        if ($result[5] == true) {
            echo '<li class="list-group-item">
                          ZESTAW UKRYTY
                          </li>';
        }
        echo '</ul>';
    }

}

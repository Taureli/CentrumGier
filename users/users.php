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

    function getPacks($id_user) {

        include'service/mysql_config.php';
        $conn = mysql_connect($host, $username, $password) or die(mysql_error());
        mysql_select_db($database, $conn);

       // $sql = "SELECT count(id_pack) FROM pack WHERE id_user='$id_user'";
       // $result = mysql_query($sql, $conn) or die(mysql_error());
        
        $sql = $this->pdo->query("SELECT count(id_pack) FROM pack WHERE id_user='$id_user' && hidden=false");
        $result = $sql->fetch(PDO::FETCH_NUM);
        
        return $result[0];
    }

    function user_all_list() {

        include 'service/mysql_config.php';
        $rec_limit = 10;

        $conn = mysql_connect($host, $username, $password);
        if (!$conn) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db($database);
        /* Get total number of records */
        $sql = "SELECT count(id_user) FROM user ";
        $retval = mysql_query($sql, $conn);
        if (!$retval) {
            die('Could not get data: ' . mysql_error());
        }
        $row = mysql_fetch_array($retval, MYSQL_NUM);
        $rec_count = $row[0];

        if (isset($_GET{'page'})) {
            $prev = $_GET{'page'} - 1;
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page;
        } else {
            $prev = 0;
            $page = 0;
            $offset = 0;
        }
        $left_rec = $rec_count - ($page * $rec_limit);

        $sql = "SELECT * FROM user WHERE hide_user=false ORDER BY name ASC LIMIT $offset, $rec_limit";

        $retval = mysql_query($sql, $conn);
        if (!$retval) {
            die('Could not get data: ' . mysql_error());
        }
        echo '<table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Imię</th>
                                    <th>Nazwisko</th>
                                    <th>Data rejestracji</th>
                                    <th>Ilość zestawów</th>
                                    <th></th>
                                </tr>
                            </thead>';
        while ($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
            $id = $row['id_user'];
            echo'<tr>' .
            '<td>' . $row['name'] . '</td>' .
            '<td>' . $row['surname'] . '</td>' .
            '<td>' . $row['dor'] . '</td>' .
            '<td>' . $this->getPacks($row['id_user']) . '</td>' .
            '<td>
                                    <div class="btn-group">
                                        <a class="btn btn-primary" href="profil.php?id=' . $row['id_user'] . '" title="Profil autora"><i class="glyphicon glyphicon-user"></i></a>
                                    </div>
                                </td>
                            </tr>';
        }
        echo '</table>';

        echo ' <div class="row">
               <div class="col-md-offset-4">
               <ul class="pagination">';
        
         $first = -1;
        if ($page > 0) {           
            echo "<li><a href=\"?page=$first\">&laquo;</a></li>";
            echo "<li><a href=\"?page=$prev\">&lsaquo;</a></li>";
            echo "<li><a href=\"?page=$page\">&rsaquo;</a></li>";
        } else if ($page == 0) {
            echo "<li class='disabled'><a href=\"?page=$first\">&laquo;</a></li>";
            echo "<li class='disabled'><a href=\"?page=$prev\">&lsaquo;</a></li>";
            echo "<li><a href=\"?page=$page\">&rsaquo;</a></li>";
        } else if ($left_rec < $rec_limit) {
            $last = $page - 2;
            echo "<li><a href=\"?page=$prev\">&lsaquo;</a></li>";
            echo "<a href=\"?page=$last\">Last 10 Records</a>";
        }
        echo '</ul></div></div>';
        mysql_close($conn);
    }
	
	function user_watch_list($idd) {

        include 'service/mysql_config.php';
        $rec_limit = 10;

        $conn = mysql_connect($host, $username, $password);
        if (!$conn) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db($database);
        /* Get total number of records */
        $sql = "SELECT count(id_user) FROM user WHERE id_user IN (SELECT kogo FROM watch WHERE kto='$idd')";
        $retval = mysql_query($sql, $conn);
        if (!$retval) {
            die('Could not get data: ' . mysql_error());
        }
        $row = mysql_fetch_array($retval, MYSQL_NUM);
        $rec_count = $row[0];

        if (isset($_GET{'page'})) {
            $prev = $_GET{'page'} - 1;
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page;
        } else {
            $prev = 0;
            $page = 0;
            $offset = 0;
        }
        $left_rec = $rec_count - ($page * $rec_limit);

        $sql = "SELECT * FROM user WHERE hide_user=false AND id_user IN (SELECT kogo FROM watch WHERE kto='$idd') ORDER BY name ASC LIMIT $offset, $rec_limit";

        $retval = mysql_query($sql, $conn);
        if (!$retval) {
            die('Could not get data: ' . mysql_error());
        }
        echo '<table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Imię</th>
                                    <th>Nazwisko</th>
                                    <th>Data rejestracji</th>
                                    <th>Ilość zestawów</th>
                                    <th></th>
                                </tr>
                            </thead>';
        while ($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
            $id = $row['id_user'];
            echo'<tr>' .
            '<td>' . $row['name'] . '</td>' .
            '<td>' . $row['surname'] . '</td>' .
            '<td>' . $row['dor'] . '</td>' .
            '<td>' . $this->getPacks($row['id_user']) . '</td>' .
            '<td>
                                    <div class="btn-group">
                                        <a class="btn btn-primary" href="profil.php?id=' . $row['id_user'] . '" title="Profil autora"><i class="glyphicon glyphicon-user"></i></a>
                                    </div>
                                </td>
                            </tr>';
        }
        echo '</table>';

        echo ' <div class="row">
               <div class="col-md-offset-4">
               <ul class="pagination">';
        
         $first = -1;
        if ($page > 0) {           
            echo "<li><a href=\"?page=$first\">&laquo;</a></li>";
            echo "<li><a href=\"?page=$prev\">&lsaquo;</a></li>";
            echo "<li><a href=\"?page=$page\">&rsaquo;</a></li>";
        } else if ($page == 0) {
            echo "<li class='disabled'><a href=\"?page=$first\">&laquo;</a></li>";
            echo "<li class='disabled'><a href=\"?page=$prev\">&lsaquo;</a></li>";
            echo "<li><a href=\"?page=$page\">&rsaquo;</a></li>";
        } else if ($left_rec < $rec_limit) {
            $last = $page - 2;
            echo "<li><a href=\"?page=$prev\">&lsaquo;</a></li>";
            echo "<a href=\"?page=$last\">Last 10 Records</a>";
        }
        echo '</ul></div></div>';
        mysql_close($conn);
    }

}

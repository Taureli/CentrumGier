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
	
	function typ($id_user) {

        $sql = "SELECT hide_user FROM user WHERE id_user='$id_user'";
        $result = mysql_fetch_row(mysql_query($sql));
		
		if($result[0] == '0')
			echo 'Ukryj konto';
		else
			echo 'Upublicznij konto';
    }
	
}
	
?>
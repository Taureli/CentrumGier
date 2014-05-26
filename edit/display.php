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
	
	function typ($id) {

        $sql = "SELECT hidden FROM pack WHERE id_pack='$id'";
        $result = mysql_fetch_row(mysql_query($sql));
		
		if($result[0] == '0')
			echo 'Ukryj zestaw';
		else
			echo 'Upublicznij zestaw';
    }

    function opis($id_pack) {

        $sql = "SELECT descr FROM pack WHERE id_pack='$id_pack'";
        $result = mysql_fetch_row(mysql_query($sql));

        $filePath = "packs/" . $result[0];

        $fh = fopen($filePath, 'r');
        while ($line = fgets($fh)) {
            echo $line;
        }
        fclose($fh);
    }
	
}
	
?>
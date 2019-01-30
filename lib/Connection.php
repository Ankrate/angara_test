<?php
ini_set('max_execution_time', 600);

class Connection {
    
    
    public function db() {

        try {
            $dsn = 'mysql:dbname=' . ANG_DBNAME . ';host=' . ANG_HOST;
            $pdo = new PDO($dsn, ANG_DBUSER, ANG_DBPASS, [PDO::MYSQL_ATTR_LOCAL_INFILE => true]);
            $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo -> exec("set names utf8");

        } catch(PDOException $e) {
            echo $e -> getMessage();
        }
        return $pdo;
    }

    

   

}
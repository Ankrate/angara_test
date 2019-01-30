<?php
class AdvigatelConnection {
    

    protected function db() {

        try {
            $dsn = 'mysql:dbname=' . ADVIG_DBNAME . ';host=' . ANG_HOST;
            $pdo = new PDO($dsn, ANG_DBUSER, ANG_DBPASS);
            $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo -> exec("set names utf8");

        } catch(PDOException $e) {
            echo $e -> getMessage();
        }
        return $pdo;
    }

    protected function p($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }//Конец функции

   

}

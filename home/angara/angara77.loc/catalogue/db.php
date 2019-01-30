<?php

$host = 'localhost';
$dbname = 'u66745_porter';
$user = 'root';
$pass = 'manhee33338';
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec("set names utf8");
}
catch(PDOException $e) {
    echo $e->getMessage();
}

<?php
// Параметры соединения с базой данных
//define('DB_SERVER', 'localhost');       // IP адрес сервера БД или если локальный ПК localhost
//define('DB_USERNAME', 'root');         // Имя пользователя
//define('DB_PASSWORD', 'manhee33338'); // Пароль пользователя
//define('DB_DATABASE', 'u66745_porter');        // Имя базы данных

// Параметры соединения с базой данных
 define('DB_SERVER', 'u66745.mysql.masterhost.ru');       // IP адрес сервера БД или если локальный ПК localhost
 define('DB_USERNAME', 'u66745');         // Имя пользователя
 define('DB_PASSWORD', 'PigU6n4_.G'); // Пароль пользователя
 define('DB_DATABASE', 'u66745_porter');        // Имя базы данных

$db = mysqli_connect (DB_SERVER,DB_USERNAME,DB_PASSWORD);
//$db = mysqli_connect ("localhost","root","manhee33338","u66745_porter");

mysqli_query($db,"SET NAMES 'utf8'");
?>

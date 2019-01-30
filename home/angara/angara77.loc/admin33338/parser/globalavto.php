<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=globalavto.xls");
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');

include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/Parser.php');

function __autoload($class_name) {
    include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/' . $class_name . '.php');
}
$url = 'http://www.dvsavto.ru/catalog/';
$table = 'parse_globalavto';
$obj = new Parser;

//$obj->truncate($table);
//$obj->get_global($url,1,5);
$data = $obj->get_zaptop($table);
//p($data);


echo '<table style="border: 1px solid black;">';

    

foreach($data as $d){
    echo '<tr>';
        foreach($d as $td){
            echo '<td>' . $td . '</td>';
        }
    echo '</tr>';
    
}

echo '</table>';

 

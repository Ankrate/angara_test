<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=zaptop.xls");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');

include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/Parser.php');

function __autoload($class_name) {
    include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/' . $class_name . '.php');
}
$url = 'http://www.zaptop.ru/brand/hyundai';
$table = 'parse_zaptop';
$obj = new Parser;
foreach($url as $u){
    
}
$obj->truncate('parse_zaptop');
$obj->findlinks($url, 253);
$obj->findlinks('http://www.zaptop.ru/brand/kia', 73);
$obj->findlinks('http://www.zaptop.ru/brand/ssangyong', 23);
$obj->findlinks('http://www.zaptop.ru/brand/chevrolet', 5);
  
$data = $obj->get_zaptop('parse_zaptop');


echo '<table>';

    

foreach($data as $d){
    echo '<tr>';
        foreach($d as $td){
            echo '<td>' . $td . '</td>';
        }
    echo '</tr>';
    
}

echo '</table>';

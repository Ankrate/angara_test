<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=zapkia.xls");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');

include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/Parser.php');

function __autoload($class_name) {
    include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/' . $class_name . '.php');
}
$url = 'http://zapkia.ru/gr1__v.html';
$url2 = 'http://zapkia.ru/gr8__v.html';
$table = 'parse_zapkia';
$obj = new Parser;
$obj->truncate('parse_zapkia');
$obj->parse_zapkia($url,5);
$obj->parse_zapkia($url2,5);

/*$url = array('http://zapkia.ru/gr1__v.html','http://zapkia.ru/gr8__v.html');
$url2 = 'http://zapkia.ru/gr8__v.html';
$table = 'parse_zapkia';
$obj = new Parser;
$obj->truncate('parse_zapkia');
$data = $obj->ex_zap($url);
//$obj->parse_zapkia($url2,5);
//p($data);
 * 
 */
$data = $obj->get_zaptop('parse_zapkia');


echo '<table>';

    

foreach($data as $d){
    echo '<tr>';
        foreach($d as $td){
            echo '<td>' . $td . '</td>';
        }
    echo '</tr>';
    
}

echo '</table>';
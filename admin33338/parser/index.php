<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');

include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/Parser.php');

function __autoload($class_name) {
    include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/' . $class_name . '.php');
}
echo 'fuck you';
/*$url = 'http://www.zaptop.ru/brand/hyundai';
$table = 'parse_zaptop';
$obj = new Parser;
$obj->truncate('parse_zaptop');
$obj->findlinks($url, 253);
$obj->findlinks('http://www.zaptop.ru/brand/kia', 73);
$obj->findlinks('http://www.zaptop.ru/brand/ssangyong', 23);
$obj->findlinks('http://www.zaptop.ru/brand/chevrolet', 5);
 * 
 
$url = 'http://zapkia.ru/gr1__v.html';
$url2 = 'http://zapkia.ru/gr8__v.html';
$table = 'parse_zapkia';
$obj = new Parser;
$obj->truncate('parse_zapkia');
$obj->parse_zapkia($url,5);
$obj->parse_zapkia($url2,5);
*/
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once __DIR__ . '/../../init.php';
//require_once ('func.php');
include_once __DIR__ . '/../lib/MyDb.php';
include_once __DIR__ . '/../lib/Weges.php';
// Запускаем по крону раз в день вечером
$obj = new Weges;
$date = date('d');
$obj->truncate('admin_mng_calls_dayly');
$j = $obj->getAllRecords();
 foreach($j as $value){
  $test = $obj -> insertCalls($value['insert_date']);
}

$date2 = date('Y-m-d', strtotime('today - 30 days'));
echo $date2;
$test = $obj -> callsInserterLast($date2);

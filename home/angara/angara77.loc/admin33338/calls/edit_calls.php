<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if(!isset($_SESSION['name'])) {
    if($_SESSION['user'] != 'Olesya' OR $_SESSION['user'] != 'admin'){
        header('location: /admin33338/');
    }
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');

include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/CallsClass.php');

$obj = new CallsClass;



//p($_POST);


$calls = $obj->ajaxData($_POST['date']);
if($calls){
echo json_encode($calls);
}else{
    echo json_encode('0');
}
//$obj->do_job($_POST);
   // echo 'Данные сохранены!';


//echo $result;
//echo 'Fuck you!';

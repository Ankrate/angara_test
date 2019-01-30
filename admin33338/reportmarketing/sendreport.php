<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if(!isset($_SESSION['name']) OR $_SESSION['type'] != 'admin') {
    if($_SESSION['type'] != 'editor' OR $_SESSION['type'] != 'marketolog'){
        //header('location: /admin33338/');
    }
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
//function __autoload($class_name) {
//    include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/' . $class_name . '.php');
//}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/Report.php');
//p($_GET);
$obj = new Report;
$obj->manager = $_SESSION['user'];
$obj->subject = 'Менеджер: ' . $obj->manager . ' Отчет за ' . date('Y-m-d');
$obj->to = 'angara99@gmail.com';
$obj->from = 'angara@angara77.ru';
//Получаем данные о продажах менеджера
//$manager_perfom = $obj->get_manager_perfom();
/*
if($manager_perfom == FALSE){
    $manager_perfom = array(0=>array('val_manager'=>$obj->manager,'val_cost'=>'Нет данных за сегодня','val_profit'=>'Нет данных за сегодня','val_rent'=>'Нет данных за сегодня')); 
}
 * 
 */
//p($manager_perfom);
//Формирую массив для отправки на емаил
$data_array = $_GET['score'];
include 'report_letter.php';
//Отправляю сообщение на мыло
$obj->message = $message;

//p($data_array);

//Вставляю в таблицу Mysql
if($obj->insert_mkt('adm_mkt_rpt_daily',$_GET, $_SESSION['user_id'], $_SESSION['user'] )){
        
    //header ('Location: /admin33338/manager.php');
    $message = 'Отчет без ошибок? Отправить?';
    echo "<SCRIPT type='text/javascript'> //not showing me this
        confirm('$message');
        window.location.replace(\"/admin33338/editors.php\");
    </SCRIPT>";
}else{
    $message = 'Отчет сегодня уже отправлен!';
    echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('$message');
        window.location.replace(\"/admin33338/editors.php\");
    </SCRIPT>";
}

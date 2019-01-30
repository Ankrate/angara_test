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
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/interviews/InterviewClass.php');


//p($_POST);
$obj=new InterviewClass;
$obj -> table = 'admin_interview_tasks';
if(isset($_POST)){
if($obj->task_insert($_POST)){
header('Location: /admin33338/interviews/edit_task_noajax.php?form_id='.$_POST['task_id']);
}
}


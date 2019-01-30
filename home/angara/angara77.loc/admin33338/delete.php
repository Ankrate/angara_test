<?php
ob_start();
include_once ('lock.php');
error_reporting(E_ALL); 
ini_set("display_errors", 1);
include_once($_SERVER['DOCUMENT_ROOT'] ."/lib/core.php");
if(isset($_GET['id']) AND isset($_GET['table'])) {
    $page = $_GET['page'];
    delete_from_table($_GET['table'],$_GET['id']);
    header("Location: {$page}?carid=" . $_GET['carid']);
}

<?php 
error_reporting(E_ALL); 
ini_set("display_errors", 1); 
$tpl = file_get_contents('tpl/main.tpl.php');
echo $tpl;
include('lib/func.php');
		if (isset($_GET['cat'])) {$cat = $_GET['cat'];}
		$object = new Catalog;
		$object->select_angara($pdo,$cat);
		$tpl_bottom = file_get_contents('tpl/main.tpl.php');
echo $tpl_bottom;
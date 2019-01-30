<?php $tpl_script = file_get_contents('tpl/script.tpl.php'); ?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	
	<title>Каталог Ангара Портер</title>
	<meta name="keywords" content="Каталог Хендай портер" />
	<meta name="description" content="Каталог хендай портер" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	</head>
<body>
<?php
//$tpl = file_get_contents('tpl/main.tpl.php');
//$tpl_script = file_get_contents('tpl/script.tpl.php');
//echo $tpl;
//echo $tpl_script;
include_once 'lib/func.php';
if (isset($_GET['id'])) {$id = $_GET['id'];}
$id=567;
$object = new Catalog();
$object->supercat ($pdo,$id);
$tpl_bottom = file_get_contents('tpl/main.tpl.php');
echo $tpl_bottom;

?>


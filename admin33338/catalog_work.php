<?php
include_once ('lock.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
$db = db_old();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Портер Хендай Ангара</title>

<link href="styles/admin.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="../favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
<script src="/admin33338/cat.angarasolaris.com/js/jquery.min.js"></script>
		<script src="/admin33338/cat.angarasolaris.com/js/jquery.validate.js"></script>
		<script src="/admin33338/cat.angarasolaris.com/js/jquery-ui.min.js"></script>
		<script src="/admin33338/cat.angarasolaris.com/js/jquery.imagemapster.js"></script>
		<script src="/admin33338/lib/script_lib.js"></script>
</head>

<body>
	<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header2.php');?>
		<div class="admin_header"><a href="index.php"><span>ANGARA Co.LTD., from 2001 year.</span></a></div>
	
			<div class="square">
				<div class='domoy'><a href="/admin33338/">В админку</a></div>
				<div class='domoy'><a href="../">На сайт</a></div>
				<?php //include ("blocks/lefttd.php");?>
				<form>
					<input type="text" />
					<input type="submit" />
				</form>
			</div>
			<div class="side_bar">Content</div>
	


  







</body>
</html>
<?

/* Освобождение памяти, занятой результатом запроса */ 
mysql_free_result($resultr); 
/* Закрытие соединения */ 
mysql_close($db);
?>

<?php
$tpl = file_get_contents('tpl/main.tpl.php');
echo $tpl;
include('lib/func.php');
$object = new Catalog();
$object->first_query($pdo);
$tpl_bottom = file_get_contents('tpl/main.tpl.php');
echo $tpl_bottom;

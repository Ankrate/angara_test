<?php 

function ins_special()
	{

//$db = mysql_connect("localhost","root","manhee33338");
//mysql_select_db("u66745_istana",$db);
	require_once ("remote_db.php");
	$spec="Y";
	$res = mysql_query("SELECT * FROM jos_vm_product",$db2);
	$last = mysql_num_rows($res);
	$id = rand(5,$last);

$sql = "UPDATE `u66745_istana`.`jos_vm_product` SET `product_special` = '$spec' WHERE `jos_vm_product`.`product_id` = '$id' LIMIT 1;";
	$insert = mysql_query($sql,$db2) or die("HYI V ROT!");
	
	}


ins_special();

?>	
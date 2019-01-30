<?php 
error_reporting(E_ALL); 
ini_set("display_errors", 1);
function select_angara()
{
$db1 = mysql_connect ("u66745.mysql.masterhost.ru","u66745","con9entiotai");
mysql_select_db ("u66745_istana",$db1);
$sql_truncate = "TRUNCATE TABLE `jos_vm_product`";
$msl = mysql_query( $sql_truncate);

$db_selected = mysql_select_db('u66745_porter', $db1);
mysql_query("SET NAMES 'utf8'");

$sql = "SELECT * FROM angara WHERE name LIKE '%porter%'";
$result = mysql_query ($sql) or die ("Hyi v nos!");

while ($array = mysql_fetch_array($result))
	{
	$array[3] = strtolower($array[3]);
	//print_r($array);
	
	$pic_small = "resized/tn_$array[3].jpg";
	$pic_big   = "$array[3].jpg";
	
	$date = time();
	
	mysql_select_db("u66745_istana", $db1);	
	
	
		
	$insert = mysql_query( "INSERT INTO `jos_vm_product` VALUES(
	'',
	'1',
	'0',
	'$array[3]',
	'$array[1]',
	'$array[1]',
	'$pic_small',
	'$pic_big',
	'Y',
	'2',
	'kg',
	'50',
	'20',
	'10',
	'cm',
	'',
	'2',
	'$date',
	'24h.gif',
	'N',
	'',
	'',
	'$date',
	'$date',
	'$array[1]',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'$array[4]')");
// If all rigt

if ($insert){
	//print "All right_nah_bla<br />";
	}
else die("Oops_insert");	
	
   //print_r($array);
//	print "<br />";
	
}
	
//End of insert vm_product
mysql_close($db1);
	}

select_angara();

?>

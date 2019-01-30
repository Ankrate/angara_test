<?php
//$sitename = "angara77.com";
//$sitename = "porter";
if ($_SERVER['DOCUMENT_ROOT'] == "")
   $_SERVER['DOCUMENT_ROOT'] = "/home/u66745/angara77.com/www";

require_once ($_SERVER['DOCUMENT_ROOT']."/include/bd.php");  
require_once ('Excel/reader.php');

$data = new Spreadsheet_Excel_Reader();  
//$data->setOutputEncoding('CP1251');
$data->setOutputEncoding('UTF-8');
$data->read($_SERVER['DOCUMENT_ROOT'].'/admin33338/PhpExcelReader/prices/angara.xls');
//$data->read($_SERVER['DOCUMENT_ROOT'].'/admin33338/PhpExcelReader/prices/angara2.xls');

$clear = mysql_query("TRUNCATE TABLE `angara`");

for ($i = 12; $i <= $data->sheets[0]['numRows']; $i++) {
$array=($data->sheets[0][cells][$i]);
	
$array[2] = trim($array[2]);
//insert data in table `angara`
$sql = "INSERT INTO `angara` (`id`, `name`,`nal`, `cat`, `price`,`description`,`1c_id`) VALUES ('','$array[2]','$array[3]','$array[4]','$array[7]','$array[5]','$array[6]')";
$result2 = mysql_query ($sql);
//print_r($array);
}


?>

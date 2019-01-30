<?php
require_once "/home/u66745/angara77.com/www/blocks/bd.php";
require_once ('Excel/reader.php');

$data1 = new Spreadsheet_Excel_Reader();  
$data1->setOutputEncoding('CP1251');
//$data1->setOutputEncoding('UTF-8');
$data1->read('/home/u66745/angara77.com/www/admin/PhpExcelReader/prices/kar.xls');

$clear = mysql_query("TRUNCATE TABLE `kare`");
$sql = "ALTER TABLE `kare` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
mysql_query($sql);
//mysql_query ("SET NAMES UTF-8");

for ($i = 10; $i <= $data1->sheets[0]['numRows']; $i++) {
$array=($data1->sheets[0][cells][$i]);
//insert data in table `kare`
$array[2] = strtolower(str_replace("-","",$array[2]));

$sql = "INSERT INTO `kare` (`id`, `name`, `cat`, `price`,`brand`) VALUES ('','$array[3]','$array[2]','$array[6]','$array[1]')";
$result2 = mysql_query ($sql,$db);
//print_r($array);
}


?>
<?php
require_once "/home/u66745/angara77.com/www/blocks/bd.php";
require_once ('Excel/reader.php');



$data2 = new Spreadsheet_Excel_Reader();  
$data2->setOutputEncoding('CP1251');
//$data2->setOutputEncoding('UTF-8');
$data2->read('/home/u66745/angara77.com/www/admin/PhpExcelReader/prices/oz.xls');

$clear = mysql_query("TRUNCATE TABLE `ozernaya`");
//$sql = "ALTER TABLE `kare` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
//mysql_query($sql);
//mysql_query ("SET NAMES UTF-8");

for ($i = 10; $i <= $data2->sheets[0]['numRows']; $i++) {
$array=($data2->sheets[0][cells][$i]);
//insert data in table `kare`
$sql = "INSERT INTO `ozernaya` (`id`, `name`, `cat`, `price`,`brand`) VALUES ('','$array[5]','$array[2]','$array[7]','$array[6]')";
$result2 = mysql_query ($sql,$db);
//print_r($array);
}


?>
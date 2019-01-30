<?php
 
require_once "/home/u66745/angara77.com/www/blocks/bd.php";
require_once ('Excel/reader.php');

$data3 = new Spreadsheet_Excel_Reader();  
$data3->setOutputEncoding('CP1251');
//$data3->setOutputEncoding('UTF-8');
$data3->read('/home/u66745/angara77.com/www/admin/PhpExcelReader/prices/bel.xls');

$clear = mysql_query("TRUNCATE TABLE `vostok`");
//$sql = "ALTER TABLE `kare` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
//mysql_query($sql);
//mysql_query ("SET NAMES UTF-8");

for ($i = 2; $i <= $data3->sheets[0]['numRows']; $i++) {
$array=($data3->sheets[0][cells][$i]);
//insert data in table `kare`
$array[8] = preg_replace("/\,/","\.",$array[8]);
$sql = "INSERT INTO `vostok` (`id`, `name`,`brand`, `cat`, `price`) VALUES ('','$array[3]','$array[6]','$array[1]','$array[8]')";
$result2 = mysql_query ($sql,$db);
//print_r($array);
}


?>
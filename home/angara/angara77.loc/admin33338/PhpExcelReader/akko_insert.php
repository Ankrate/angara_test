<?php
require_once "/home/u66745/angara77.com/www/blocks/bd.php";
require_once ('Excel/reader.php');



$data2 = new Spreadsheet_Excel_Reader();  
$data2->setOutputEncoding('CP1251');
//$data2->setOutputEncoding('UTF-8');
$data2->read('/home/u66745/angara77.com/www/admin/PhpExcelReader/prices/akko.xls');

$clear = mysql_query("TRUNCATE TABLE `akko`");
//$sql = "ALTER TABLE `kare` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
//mysql_query($sql);
//mysql_query ("SET NAMES UTF-8");

for ($i = 3; $i <= $data2->sheets[0]['numRows']; $i++) {
$array=($data2->sheets[0][cells][$i]);
//insert data in table `akko`
$array[1] = preg_replace("/В/i","b",$array[1]);
$sql = "INSERT INTO `akko` (`id`, `name`, `cat`, `price_big_opt`,`price_small_opt`) VALUES ('','$array[2]','$array[1]','$array[4]','$array[5]')";
$result2 = mysql_query ($sql,$db);
//print_r($array);
}


?>
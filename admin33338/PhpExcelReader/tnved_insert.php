<?php
//$sitename = "angara77.com";
//$sitename = "porter";
require_once "/home/u66745/angara77.com/www/admin/blocks/bd.php";  
require_once ('Excel/reader.php');

$data = new Spreadsheet_Excel_Reader();  
$data->setOutputEncoding('CP1251');
//$data->setOutputEncoding('UTF-8');
$data->read('/home/u66745/angara77.com/www/admin/PhpExcelReader/prices/weight1.xls');

//$clear = mysql_query("TRUNCATE TABLE `ang_name_code`");

for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
$array=($data->sheets[0][cells][$i]);
//insert data in table 
$array[3] = str_replace("-","",$array[3]);
$sql = "INSERT IGNORE INTO `ang_name_code` ( `name_rus`,`name_eng`, `cat_number`,`tnved_number`, `weight_net`,`weight_gross`) VALUES ('$array[3]','$array[2]','$array[1]','n/a','$array[4]','$array[5]')";
$result2 = mysql_query ($sql,$db);
//print_r($array);
}
$info=mysql_info($db);
echo $info ;
?>
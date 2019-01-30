<?php
//$sitename = "angara77.com";
//$sitename = "porter";
require_once "../../include/bd.php";  
require_once ('Excel/reader.php');

$data = new Spreadsheet_Excel_Reader();  
$data->setOutputEncoding('UTF-8');
//$data->setOutputEncoding('UTF-8');
$data->read('prices/tmp1.xls');

//$clear = mysql_query("TRUNCATE TABLE `ang_name_code`");

for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
$array=($data->sheets[0][cells][$i]);
//insert data in table 
$array[2] = substr($array[2], 0, 10);
$array[2] = str_replace("-", "", $array[2]);
//UPDATE persondata SET age=age*2, age=age+1;
$sql = "REPLACE INTO `ang_name_code_weight` (`id`,`name_eng`, `name_rus`, `cat_number`, `weight_net`,`weight_gross`) VALUES ('', '$array[3]', '$array[7]','$array[2]','$array[8]','$array[8]')";
$result2 = mysql_query ($sql,$db);
print_r($array);
}


?>
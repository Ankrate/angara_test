<?php
//$sitename = "angara77.com";
//$sitename = "porter";
require_once "/home/u66745/angara77.com/www/blocks/bd.php";  
require_once ('Excel/reader.php');

$data = new Spreadsheet_Excel_Reader();  
$data->setOutputEncoding('CP1251');
//$data->setOutputEncoding('UTF-8');
$data->read('/home/u66745/angara77.com/www/admin/PhpExcelReader/prices/angara.xls');

$clear = mysql_query("TRUNCATE TABLE `angara`");

for ($i = 12; $i <= $data->sheets[0]['numRows']; $i++) {
$array=($data->sheets[0][cells][$i]);
//insert data in table `angara`
$sql = "INSERT INTO `angara` (`id`, `name`,`nal`, `cat`, `price`,`set`) VALUES ('','$array[2]','$array[3]','$array[4]','$array[5]','$array[6]')";
$result2 = mysql_query ($sql,$db);
print_r($array);
}


?>

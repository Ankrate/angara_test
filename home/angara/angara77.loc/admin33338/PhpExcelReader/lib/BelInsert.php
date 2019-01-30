<?php 

require_once ('Excel/reader.php');

function BelInsert() {

	$data_b = new Spreadsheet_Excel_Reader();  
	$data_b->setOutputEncoding('CP1251');
//	$data_b->setOutputEncoding('UTF-8');
	$data_b->read('prices/bel.xls');


		require_once getenv("DOCUMENT_ROOT")."/porter/blocks/bd.php";
		 $clear = mysql_query("TRUNCATE TABLE `vostok`");

	for ($i = 2; $i <= $data_b->sheets[0]['numRows']; $i++) {
	$array=($data_b->sheets[0][cells][$i]);
	//insert data in table `kare`
	$sql = "INSERT INTO `vostok` (`id`, `name`, `cat`, `price`) VALUES ('','$array[3]','$array[1]','$array[4]')";
	$result = mysql_query ($sql,$db);
	print_r($array);

			}

}
?>
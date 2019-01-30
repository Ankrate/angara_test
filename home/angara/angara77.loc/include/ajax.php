<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/catalogue/db.php') ;
if (isset($_GET['name']) === true && empty ($_GET['name']) === false){
	
	require ($_SERVER['DOCUMENT_ROOT'].'/include/bd.php');
	
	$query = mysql_query("
	SELECT `h4`.`id`
	FROM   `h4`
	WHERE  `h4`.`id` = '".mysql_real_escape_string(trim($_GET['name']))."'
	");
	
	$ajid = (mysql_num_rows($query) !== 0) ? mysql_result($query,0,'id') : 'Name not found';
	
	//echo $ajid;
	$query4 = "SELECT * FROM `h5` WHERE `id_h4` LIKE '$ajid' ";
	
	
	
	foreach ($result1 = $pdo->query($query4) as $line4) {
								
										
							//print $line4['2']."<br />"; //Вывод на печать каталожных номеров
							$line4[2] = substr($line4[2], 0, 7);
							
								$query_a = "SELECT * FROM `angara` WHERE `cat` LIKE '%$line4[2]%' ";
								//$line2 = array();
									foreach ($result = $pdo->query($query_a) as $line_a) {
										$count = $result->rowCount();
										$link = "<a href='/porter-$line_a[3]-$line_a[6]/'>";
										echo "<div class='table_last'>";
										echo "<div class='row_last'>";
										echo "<div class='col_last c50_last'>".$link.$line_a[1]."</div><div class='col_last c25_last'>".$line_a['price']." руб";
										echo "</div></div>";
										echo "</a></div>";
								}
									
	}
							if (!isset($line_a[0])) echo "<div class='col_last row_last '>Деталь на заказ телефон для связи 8(495)646-99-53</div>";
							//var_dump( isset($line_a[0]));
}

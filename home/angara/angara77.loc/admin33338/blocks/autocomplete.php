<?php

include_once ('../../include/bd.php');


if (isset($_GET['term'])){ $term = $_GET['term'];}
	
	 $query = "SELECT * FROM `angara` WHERE `name` LIKE '%$term%' AND name LIKE '%PORTER%' ORDER BY name LIMIT 30"; 

							$result = mysql_query($query) or die("Запрос ошибочный");
							
							while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
								
								//print "\t<tr>\n";
								//for ($i=1;$i<=5;$i++) { print "\t\t<td ><div class='tab_class'>$line[$i]</div></td>\n"; 
								//	}			
							//print "\t</tr>\n"; 
								
								//var_dump ($line);
								
								$returnArr[] = array ('value' => $line[0], 'label' => $line[1]);
									}			

mysql_close($db);

echo json_encode($returnArr);
//var_dump ($return_arr);
	


?> 
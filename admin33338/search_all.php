<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
<div class="admin_header"><a href="index.php"><span>ANGARA Co.LTD., from 2001 year.</span></a></div>
	
			<div class="square">
				<div class='domoy'><a href="/admin33338/">В админку</a></div>
				<div class='domoy'><a href="../">На сайт</a></div>
				<?php include ("blocks/lefttd.php");?>
			</div>
			<div class="side_bar">
<?php
			
			
			include_once ("../lib/translit.php");
			include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
$db = db_old();
			if (isset($_GET[search])) {$search = $_GET[search];}
			if (empty($search) or strlen($search)<2) { $search = "282004B160";}
			
			$indicator = substr($search,0,2);	
					
			
		if (is_numeric($indicator))
			{
				
							
							$search = trim($search);
							$search = str_ireplace ("-","",$search);
							$good = str_replace (" ","",$good);			
							$patterns[0] = "/в/"; 
							$patterns[1] = "/а/";
							$patterns[2] = "/В/";
							$patterns[3] = "/А/";
							$patterns[4] = "/С/";
							$patterns[5] = "/C/";
							$patterns[6] = "/с/";
							
							$replacements[0] = "b"; 
							$replacements[1] = "a";	
							$replacements[2] = "b";
							$replacements[3] = "a";
							$replacements[4] = "c";
							$replacements[5] = "c";
							$replacements[6] = "c";							
									
							$search = preg_replace($patterns, $replacements, $search);
							
							$search = strtolower($search);							
							$search = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $search);				
							$good = trim(preg_replace("/\s(\S)\s/", " ", ereg_replace(" +", "  "," $search ")));			
							$good = ereg_replace(" +", " ", $good);
		
							//var_dump ($good);
							//Выполнение SQL запроса
							$query = "SELECT * FROM `angara` WHERE `ang_name` LIKE '%$good%'  ORDER BY `price`"; 

							$result = mysql_query($query) or die("Запрос ошибочный");
							//Печать результатов в HTML
							print "<table class='tab'>\n";
							print "<tr><th>Название</th><th>На складе</th><th>Каталог</th><th>Цена рублей</th></tr>";

							while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
								$cat_numb=$line['3'];	
								//transliteracia url
								$url =  (str2url($line['1']));							
														
								print "\t<tr>\n";
								for ($i=1;$i<=4;$i++) { print "\t\t<td >$line[$i]</td>\n"; 
									}			
							print "\t</tr>\n"; 
									}
		
							$num_rows = mysql_num_rows($result);			
							if ($num_rows==0) { 
								print "\t<tr>\n";
								print "<tr><td>Наверное Вы допустили ошибку в слове, просто наберите несколько начальных букв слова. Например Вместо <i> Поршни</i> наберите <i>Порш</i>.</td><td></td><td></td><td></td><td></td></tr>";			 
							print "\t</tr>\n"; 
								}
							print "</table>\n";
							
			}
			
			else
				{
							//var_dump ($search);
							$search = trim($search);							
							$search = strtolower($search);							
							$search = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $search);				
							$good = trim(preg_replace("/\s(\S)\s/", " ", ereg_replace(" +", "  "," $search ")));			
							$good = ereg_replace(" +", " ", $good);
							$good = $search;
							//var_dump ($good);
							
							$good_one = explode(" ",$good);
							//$good_one = array_map('trim',$good_one);
							
							
							//Выполнение SQL запроса
							$query = "SELECT * FROM `angara` WHERE MATCH (ang_name) AGAINST ('+$good_one[0]* +$good_one[1]* -PORTER*' IN BOOLEAN MODE)  "; 
//$query = "SELECT * FROM `angara` WHERE name LIKE '%$good_one[0]%' AND name LIKE  '%PORTER%'";

							$result = mysql_query($query) or die("Запрос ошибочный");
							//Печать результатов в HTML
							print "<table class='tab'>\n";
							print "<tr><th>Название</th><th>На складе</th><th>Каталог</th><th>Цена рублей</th></tr>";

							while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
								$cat_numb=$line['3'];	
								
								//transliteracia
								
								//$url =  (str2url($line['1']));								
															
								
														
								print "\t<tr>\n";
								for ($i=1;$i<=4;$i++) { print "\t\t<td >$line[$i]</td>\n"; 
									}			
							print "\t</tr>\n"; 
									}
		
							$num_rows = mysql_num_rows($result);			
							if ($num_rows==0) { 
								print "\t<tr>\n";
								print "<tr><td>Наверное Вы допустили ошибку в слове, просто наберите несколько начальных букв слова. Например Вместо <i> Поршни</i> наберите <i>Порш</i>.</td><td></td><td></td><td></td></tr>";			 
							print "\t</tr>\n"; 
								}
							print "</table>\n";			
							
			
			
			
		}// Скобка от проверки длины и пустоты	
			
			
			?>
</div>





</body>
</html>
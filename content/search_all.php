<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>Портер Хендай</title>
<meta name="keywords" content="<?php echo "Автозапчасти Hyundai ". $_COOKIE[mod_tit]; ?>" />
<meta name="description" content="<?php echo "Запасные части Hyundai ". $_COOKIE[mod_tit]; ?>" />

<link href="style_hyundai.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
</head>


<body>
<table width="100%">
  <tr><td><?php include ('blocks/header.php');?></td></tr>
  <tr><td><table>
    <tr valign="top"><td valign="top" class="left"><?php include ("blocks/lefttd.php");?></td>
		<td >	
<?php
			
			
			include_once ("lib/translit.php");
			include_once ("include/bd.php");
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
							$query = "SELECT * FROM `angara` WHERE `name` LIKE '%$good%'  ORDER BY `price`"; 

							$result = mysql_query($query) or die("Запрос ошибочный");
							//Печать результатов в HTML
							print "<table class='tab'>\n";
							print "<tr><th>Название</th><th>На складе</th><th>Каталог</th><th>Цена рублей</th><th>Ед.изм.</th></tr>";

							while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
								$cat_numb=$line['3'];	
								//transliteracia url
								$url =  (str2url($line['1']));							
														
								print "\t<tr>\n";
								for ($i=1;$i<=5;$i++) { print "\t\t<td ><a href='cat_number.php?cat_number=$cat_numb&name=$url'>$line[$i]</a></td>\n"; 
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
							$query = "SELECT * FROM `angara` WHERE MATCH (name) AGAINST ('+$good_one[0]* +$good_one[1]* +$good_one[2]*' IN BOOLEAN MODE)  "; 

							$result = mysql_query($query) or die("Запрос ошибочный");
							//Печать результатов в HTML
							print "<table class='tab'>\n";
							print "<tr><th>Название</th><th>На складе</th><th>Каталог</th><th>Цена рублей</th><th>Ед.изм.</th></tr>";

							while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
								$cat_numb=$line['3'];	
								
								//transliteracia
								
								$url =  (str2url($line['1']));								
															
								
														
								print "\t<tr>\n";
								for ($i=1;$i<=5;$i++) { print "\t\t<td ><a href='cat_number.php?cat_number=$cat_numb&name=$url'>$line[$i]</a></td>\n"; 
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
							
			
			
			
		}// Скобка от проверки длины и пустоты	
			
			
			?>
			</td><td  valign="top" class="right"> <?php include ("blocks/righttd.php"); ?></td>
				</tr>
		
    			</table> </td></tr>    
  
<?php include ("blocks/footer.php"); ?>

  
</table>





<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-4786389-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>
</body>
</html>
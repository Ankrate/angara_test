<?php
if (isset($_GET[search])) {$search = $_GET[search];}
$good_one = explode(" ",$search);
//print_r($search);

include_once("include/bd.php");
$query_1 = "(SELECT * FROM `angara` WHERE MATCH (name) AGAINST ('+$good_one[0]* +$good_one[1]* +$good_one[2]*' IN BOOLEAN MODE) ) LIMIT 1   ";
$result_name = mysql_query($query_1) or die("Запрос ошибочный");

$row_name = mysql_fetch_array($result_name);
		//var_dump($row_name);
		//print_r($row_name);
		$title = "Компания Ангара:  ".$row_name[1];
		$keywords = $row_name[1];
		$description = $row_name[5];




?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta charset="utf-8" />
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!--[if !IE]><!--> <html class="ie">             <!--<![endif]-->
	<title><?php echo $title; ?></title>
	<meta name="keywords" content="<?php echo $keywords; ?>" />
	<meta name="description" content="<?php echo $description; ?>" />
	<link href="css/style.css" rel="stylesheet">
	<link href="css/styleone.css"  rel="stylesheet"/>
	<link href="css/styletwo.css"  rel="stylesheet"/>
	<link href="nav/css/style.css"  rel="stylesheet"/>
	
	<script src="js/jquery.js"></script>
	<script src="js/myscripts.js"></script>
	<script src="/callme/js/callme.js"></script>
	<script type="text/javascript" src="/buyme/js/buyme.js"></script>
</head>

<body>

<div class="wrapper">

	<header class="header">
		<?php include_once ('include/header.php'); ?>
	</header><!-- .header-->
		
	<div class="middle">
			<div id="_hiddenAdds" class="underheader_all">
				<div class="underheader_left">
					<div id="underheader_left_top">
						<?php include("include/special.php");?>
					</div>
					<div id="underheader_left_bottom">
						<?php include ("timer/index.html"); ?>
					</div>
				</div>
				<div class="underheader_right">
					<?php include("include/special2.php");?>
				</div>
			</div>
			<div class="container">
				<div class="content">
					
	<?php
			require_once ('lib/car_translit.php');
			include_once ("lib/translit.php");
			
			if (isset($_GET[search])) {$search = $_GET[search];}
			if (empty($search) or strlen($search)<2) { $search = "282004B160";}
			
			$indicator = substr($search,0,2);	
					
			
		if (is_numeric($indicator))
			{
				
							
							$search = trim($search);
							$search = str_ireplace ("-","",$search);
							
							$good = str_replace (" ","",$good);			
							
							
														
									
							
							
							$search = strtolower($search);
							$search = car2translit($search);							
							$search = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $search);	
							
							//var_dump($search);			
							$good = trim(preg_replace("/\s(\S)\s/", " ", ereg_replace(" +", "  "," $search ")));			
							$good = ereg_replace(" +", " ", $good);
							$good_one = explode(" ",$good);
							
							//Here we are replasing first varriable in array
							
							$good_one[0] = cat2translit($good_one[0]); //Function from library lib
							//print_r ($good_one);
							//Выполнение SQL запроса
							$query = "SELECT * FROM `angara` WHERE MATCH (name) AGAINST ('+$good_one[0]* +$good_one[1]* +$good_one[2]*' IN BOOLEAN MODE)    ORDER BY `price`"; 
							
							
							//WHERE MATCH (name) AGAINST ('+$good_one[0]* +$good_one[1]* +$good_one[2]*' IN BOOLEAN MODE)
							
							

							$result = mysql_query($query) or die("Запрос ошибочный");
							//Печать результатов в HTML
							print "<div class='table_div'>";
							print "<div class='row'><div class='col c25'>Название</div><div class='col c25'>На складе</div><div class='col c25'>Цена руб.</div><div class='col c25'>Купить</div></div>";

							while ($line = mysql_fetch_array($result)) {
								$cat_numb=$line['3'];	
								//transliteracia url
								$url =  (str2url($line['1']));
								
								$id = $line['id'];
								
								
								 
								if ($line["nal"] <= 3 and $line["nal"] != 0){
								$est = "Мало";
								} 
								elseif ($line['nal'] == 0 ) {
									$est = "На заказ";
								} 
								else {
								$est = "Есть";
								} 
?>								
								
 				<div class="row b1c-good">
	            	<div class="col c50 b1c-name"><a href="cat_number.php?cat_number=<?php echo ($cat_numb); ?>&name=<?php echo($url); ?>"><? echo($line["name"]) ; ?></a></div><div class="col c25"><?php echo ($est); ?></div><div class="col c25 b1c-price"><? echo($line["price"]) ; ?></div><div class="col c25"><input type="button" class="b1c" value="Купи за 1 клик"></div>
	            
	        	</div>

<?php   								
							
									} //while
		
							$num_rows = mysql_num_rows($result);			
							if ($num_rows==0) { 
								//print "\t<tr>\n";
								print "<tr><td>Запчасти нет на складе или Вы допустили ошибку в слове, просто наберите несколько начальных букв слова. Например Вместо <i> Поршни</i> наберите <i>Порш</i>.</td><td></td><td></td><td></td><td></td></tr>";			 
							
								} 
							
							print "</div>"; 
							
			}
			
			else 								//Second part of else
				{
							//var_dump ($search);
							$search = trim($search);							
							$search = strtolower($search);	
							
							
							$search = car2translit($search);
													
							$search = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $search);				
							$good = trim(preg_replace("/\s(\S)\s/", " ", ereg_replace(" +", "  "," $search ")));			
							$good = ereg_replace(" +", " ", $good);
							$good = $search;
							//var_dump ($good);
							
							$good_one = explode(" ",$good);
							//$good_one = array_map('trim',$good_one);
							
							
							//Выполнение SQL запроса
							$query = "SELECT * FROM `angara` WHERE MATCH (name) AGAINST ('+$good_one[0]* +$good_one[1]* ' IN BOOLEAN MODE)  "; 

							$result = mysql_query($query) or die("Запрос ошибочный");
							//Печать результатов в HTML
		print "<h3>Чтобы увидеть фотографию, кликните по названию запчасти!</h3>";
							print "<div class='table_div'>";
							print "<div class='row'><div class='col c25'>Название</div><div class='col c25'>На складе</div><div class='col c25'>Позиция</div><div class='col c25'>Цена руб.</div><div class='col c25'>Купить</div></div>";

							while ($line = mysql_fetch_array($result)) {
								$cat_numb=$line['3'];
								$title = $line[2];	
								
								//transliteracia
								
								$url =  (str2url($line['1']));								
								$id = $line['id'];
								//echo "<tr>"; 
								
								if ($line["nal"] <= 3 and $line["nal"] != 0){
								$est = "Мало";
								} 
								elseif ($line['nal'] == 0 ) {
									$est = "На заказ";
								} 
								else {
								$est = "Есть";
								} 
								
								
								
								

								
?>
								
								
								

	       <div class="row b1c-good"> 
	            <div class="col c50 b1c-name"><a href="cat_number.php?cat_number=<?php echo ($cat_numb); ?>&name=<?php echo($url); ?>"><? echo($line["name"]) ; ?> </a> </div><div class="col c25"><?php echo ($est); ?></div><div class="col c25 b1c-price"><? echo($line['set']) ; ?></div><div class="col c25 b1c-price"><? echo($line["price"]) ; ?></div><div class="col c25"><input type="button" class="b1c" value="Купи за 1 клик"></div>
	         
	       </div>
	 
	    
<?php	
								

								
									} //while
									
									
		
							$num_rows = mysql_num_rows($result);			
							if ($num_rows==0) {
								
								 
								//include_once ('admin33338/obrabotchik/ak.php');		
								//print "<tr><td>Запчасти нет на складе или Вы допустили ошибку в слове, просто наберите несколько начальных букв слова. Например Вместо <i> Поршни</i> наберите <i>Порш</i>.</td><td></td><td></td><td></td><td></td></tr>";			 
					
							
								}
									
				print "</div>"; 			
			
			
			
		}// Скобка от проверки длины и пустоты	
			
			
?>
					
				</div><!-- .content -->
			</div><!-- .container-->

		<aside class="left-sidebar">
			<?php include("include/lefttd.php");?>
		</aside><!-- .left-sidebar -->

		<aside class="right-sidebar">
			<?php include("include/righttd.php");?>
		</aside><!-- .right-sidebar -->

	</div><!-- .middle-->

</div><!-- .wrapper -->


<footer class="footer">
	<?php include ('include/footer.php'); ?>
</footer><!-- .footer -->

</body>
</html>
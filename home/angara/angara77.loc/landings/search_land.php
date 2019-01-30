<?php				
			include_once('../lib/car_translit.php');
			include_once('../lib/translit.php');
			include ('../include/bd.php');
			include ("../lib/file_parser_land.php");
			if (isset($_GET[search])) {$search = $_GET[search];}
			if (empty($search) or strlen($search)<2) { $search = "282004B160";}		
		$search = "радиатор охлаж портер";
							$search = trim($search);							
							$search = strtolower($search);	
							//var_dump ($search);
							
							$search = car2translit($search);
													
							$search = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $search);				
							$good = trim(preg_replace("/\s(\S)\s/", " ", ereg_replace(" +", "  "," $search ")));			
							$good = ereg_replace(" +", " ", $good);
							$good = $search;
							//var_dump ($good);
							
							$good_one = explode(" ",$good);
							//$good_one = array_map('trim',$good_one);
							//print_r( $good_one);
							
							//Выполнение SQL запроса
							$query = "SELECT * FROM `angara` WHERE MATCH (name) AGAINST ('+$good_one[0]* +$good_one[1]* +$good_one[2]*' IN BOOLEAN MODE) ORDER BY price "; 

							$result = mysql_query($query) or die("Запрос ошибочный");
							
							//Печать результатов в HTML
?>
							<div class="container" id="land_left">
			<div class="content">
<?		
							print "<div class='table_div'>";
							print "<div class='row'><div class='col c25'>Название</div><div class='col c25'>На складе</div><div class='col c25'>Изобр.</div><div class='col c25'>Цена руб.</div><div class='col c25'>Купить</div></div>";

							while ($line = mysql_fetch_array($result)) {
								//print_r($line);
								$cat_number[]=$line['cat'];
								$name = $line ['name'];
								$dir= "../img/tmb/";
								//echo $dir;
								$id=substr($line[cat], 0, 8);
								$pattern = strtolower($dir.$id.'*'.'jpg');
								$land_filename =  glob($pattern);
								//$random_land = rand(0,2);
								$land_img =  "<img src='".$land_filename[0]."'  />";
								//var_dump($land_img);
									
								
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
								
								
								

	       <div class="row b1c-good "> 
	            <div class="col land_c50 b1c-name"><a href="cat_number.php?cat_number=<?php echo ($cat_numb); ?>&name=<?php echo($url); ?>"><? echo($line["name"]) ; ?> </a> </div><div class="col c25"><?php echo ($est); ?></div><div class="col c25"><?php echo ($land_img); ?></div><div class="col c25 b1c-price"><? echo($line["price"]) ; ?></div><div class="col c25"><input type="button" class="b1c" value="Купи за 1 клик"></div>
	         
	       </div>
	 
	    
<?php	
								

								
									} //while
		
							$num_rows = mysql_num_rows($result);			
							if ($num_rows==0) { 
		
								print "<tr><td>Запчасти нет на складе или Вы допустили ошибку в слове, просто наберите несколько начальных букв слова. Например Вместо <i> Поршни</i> наберите <i>Порш</i>.</td><td></td><td></td><td></td><td></td></tr>";			 
					
							
								}
									
				print "</div>";
?>				 
</div><!-- .content -->
		</div><!-- .container-->		
		<div class="container">
			<div class="content"><!--second content-->
				<div class="print_image_land">
<? 
			//print_r($cat_number);
			print_image($cat_number[0]);
?>				</div>					
			</div><!-- .content -->
		</div><!-- .container-->		

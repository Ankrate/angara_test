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
			
			
		
		
							//var_dump ($good);
							//Выполнение SQL запроса
							$query = "SELECT * FROM `angara` WHERE `id`=$search"; 

							$result = mysql_query($query) or die("Запрос ошибочный");
							//Печать результатов в HTML
							print "<table class='tab'>\n";
							print "<tr><th>Название</th><th>На складе</th><th>Каталог</th><th>Цена рублей</th></tr>";

							while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
								$cat_numb=$line['3'];	
												
														
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
							
			
			
			
			?>
</div>





</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if !IE]><html class="ie"><![endif]-->
	<title>Ангара-запчасти для Hyundai Прайс-лист Портер</title>
	<meta name="keywords" content="запчасти на Портер" />
    <meta name="description" content="Компания ООО Ангара предлагает запчасти для Портер, в том числе Портер 2. Отправляем в регионы за наш счет. Гарантия на все запчасти. Остерегайтесь подделок!" />
    </head>
<body>
<div class="wrapper">
    <header class="header">
        <?php include_once ("include/header.php"); ?>
    </header><!-- .header-->
		
	<div class="middle">
			
			<div class="container">
				<div class="content">
					<div class="middle_div">
		<?php 
		//error_reporting(E_ALL); 
       // ini_set("display_errors", 1);
			include("blocks/bd.php");
			include_once ("lib/translit.php");
			print "<h2 class='zagolovok'>";
			print "Прайс лист запчастей Портер";
			print "</h2>";
			print "<a href='/print.php' >Версия для печати</a>";
			//price making
			if (isset($_GET['model'])) {$model = $_GET['model'];}
						$model = stripslashes($model);
						$model = htmlspecialchars($model);
                        //echo $model;
			$query = "SELECT * FROM `angara` WHERE MATCH (ang_name) AGAINST ('+$model' IN BOOLEAN MODE)  "; 

							$result = mysql_query($query) or die("Запрос ошибочный");
							//Печать результатов в HTML
		print "<h3>Чтобы увидеть фото, кликните по названию запчасти!</h3>";
							print "<div class='table_div'>";
							print "<div class='row'><div class='col c25'>Название</div><div class='col c25'>На складе</div><div class='col c25'>Цена руб.</div><div class='col c25'>Купить</div></div>";

							while ($line = mysql_fetch_array($result)) {
								$cat_numb=$line['3'];	
								
								//transliteracia
								
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
	            	<div class="col c50 b1c-name"><a href="porter-<?= $cat_numb ?>-<?= $id ?>/"><?= $line["ang_name"] ?></a></div><div class="col c25"><?= $est ?></div><div class="col c25 b1c-price"><?= $line["price"] ?></div><div class="col c25"><input type="button" class="b1c" value="Купи за 1 клик"></div>
	            
	        	</div>
								
<?php								
									}

				$num_rows = mysql_num_rows($result);			
							if ($num_rows==0) { 
								//print "\t<tr>\n";
								print "<tr><td>Запчасти нет на складе или Вы допустили ошибку в слове, просто наберите несколько начальных букв слова. Например Вместо <i> Поршни</i> наберите <i>Порш</i>.</td><td></td><td></td><td></td><td></td></tr>";			 
							
								} 
							
							print "</div>"; 
							
						
								


			
?>
					</div>
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
<link href="/css/styletwo.css"  rel="stylesheet"/>
	<link href="/nav/css/style.css"  rel="stylesheet"/>
	<script src="/js/jquery.js"></script>
	<script src="/js/myscripts.js"></script>
	<script src="/callme/js/callme.js"></script>
	<script src="/buyme/js/buyme.js" type="text/javascript" ></script>
</body>
</html>
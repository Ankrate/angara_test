<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title></title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="css/style.css" rel="stylesheet">
	<link href="../css/styletwo.css" rel="stylesheet">
	
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jcarousellite_1.0.1.min.js"></script>
	<script type="text/javascript" src="../js/myscripts.js"></script>
</head>

<body>

<div class="wrapper">


	<header class="header">
		<div class="header_all">
				
					<div class="header_first" id="logo1"> <!-- Logo1 -->
						<h1><a href="/" ><strong>Запчасти</strong> для Хундай Портер<br />HD65/HD72/HD78</h1></a><h2><strong>На складе сейчас!</strong><br /> Компания АНГАРА</h2>
						
					</div>
					<div class="header_first" id="logo2"><!-- Logo2 -->
						<div class="customer_count"><?php
										$day = 01;
										$month = 01;
										$year = 2007;
										$age= ((int)((mktime (0,0,0,$month,$day,$year) - time(void))/86400) * -1 );
										$cust_count = $age*21;
										print ("<p>$cust_count</p><h6>Довольных клиентов с 2007 года!</h6>");
									?>
						</div>
					</div>
					<div class="header_first" id="logo3"> <!-- Logo3 -->
						<h1><a href="/" class="callme_viewform"><div class="ya-phone">8-<?=TELEPHONE1?></div></a></h1>
						<!--<h3>Звонок по России бесплатный!</h3>-->
						<button id="btn"  class="callme_viewform">Закажи обратный звонок сейчас!</button>
						<h3><div class="ya-phone">8(495)646-99-53</div></h3>
						<!-- <h3><div class="ya-phone">8(916)853-31-33</div></h3> -->
					</div>
					</div> <!--header all-->
	</header><!-- .header-->
	<header class="header">
				<div class = "my_carusel">
					<div class="anyClass">
   			 		<ul>
   			 			<?php
   			 			include_once('../include/bd.php');
   			 			$imagesDir = '../img/tmb/';
								for ($i = 1; $i <= 6; $i++) {
								$images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
								$randomImage = $images[array_rand($images)]; // See comments
								echo "<li><img src='$randomImage' alt='' width='165' height ='125' ></li>";
								}
   			 			 ?>
					</div>
				</div>
	</header><!-- .header-->
	<header class="header land_warranty">
		
		
			<div class="header_region" id="header_money">
				<div>
					<img src="../img/MoneyBackGraySmall.png" />
					<h2>Гарантия возврата денег!</h2>
					<p>Если деталь не подойдет или не понадобиться, мы гарантируем возврат. </p>
				</div>				
			</div>
			<div class="header_region" id="header_delivery">
				<div>
					<img src="../img/hyundai_porter2_small.png" />
					<h2>Находитесь не в Москве?</h2>
					<p>Доставка в Ваш город <span>БЕСПЛАТНО!</span><br />при заказе от 5 тыс руб</p>
				</div>
			</div>
				       
			
		
		
	</header><!-- .header-->
	

	<div class="middle">

		
			<? include('search_land.php'); ?>
				
			
		
		

	</div><!-- .middle-->
	

</div><!-- .wrapper -->

<footer class="footer">
	<strong>Footer:</strong> Mus elit Morbi mus enim lacus at quis Nam eget morbi. Et semper urna urna non at cursus dolor vestibulum neque enim. Tellus interdum at laoreet laoreet lacinia lacinia sed Quisque justo quis. Hendrerit scelerisque lorem elit orci tempor tincidunt enim Phasellus dignissim tincidunt. Nunc vel et Sed nisl Vestibulum odio montes Aliquam volutpat pellentesque. Ut pede sagittis et quis nunc gravida porttitor ligula.
</footer><!-- .footer -->

</body>
</html>
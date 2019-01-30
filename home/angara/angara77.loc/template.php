<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta charset="utf-8" />
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!--[if !IE]><!--> <html class="ie">             <!--<![endif]-->
	<title>Ангара-запчасти для Hyundai</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="css/style.css" rel="stylesheet">
	<link href="css/styleone.css"  rel="stylesheet"/>
	<link href="css/styletwo.css"  rel="stylesheet"/>
	<link href="nav/css/style.css"  rel="stylesheet"/>
	
	<script src="js/jquery.js"></script>
	<script src="js/myscripts.js"></script>
	<script src="/callme/js/callme.js"></script>
	
	<script src="arcticmodal/jquery.arcticmodal.min.js"></script>
	<link rel="stylesheet" href="arcticmodal/jquery.arcticmodal.css">
	<link rel="stylesheet" href="arcticmodal/themes/simple.css">
</head>

<body>

<div class="wrapper">

	<header class="header">
		<?php include_once ('include/header.php'); ?>
	</header><!-- .header-->
		
	<div class="middle">
			<div id="hiddenAdds" class="underheader_all">
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
					
					
					<!-- arcticModal -->

<div style="display: none;">  
  <div class="box-modal" id="boxUserFirstInfo">  
      <div class="box-modal_close arcticmodal-close">закрыть</div>  
      <b>Здравствуй, милый человек!</b><br>  
      <br>  
      Надеюсь тебе понравится на нашем сайте!  
        У нас много интересной информации и очень отзывчивое комьюнити.  
        Добро пожаловать :)  
    </div>  
</div>  
<script>
(function($) {
$(function() {

	// Проверим, есть ли запись в куках о посещении посетителя
	// Если запись есть - ничего не делаем
	if (!$.cookie('was')) {

		// Покажем всплывающее окно
		$('#boxUserFirstInfo').arcticmodal({
			closeOnOverlayClick: false,
			closeOnEsc: true
		});

	}

	// Запомним в куках, что посетитель к нам уже заходил
	$.cookie('was', true, {
		expires: 365,
		path: '/'
	});

})
})(jQuery)
</script>
					
					
					
					
					
					
					
					
					<a href="http://hyundaiporter.ru"><div id="porter"></div></a>
				<h3>ХУНДАЙ ПОРТЕР
				ХУНДАЙ ПОРТЕР 2
				HYUNDAI PORTER I и II
				Кликните по картинке ниже и перейдите в нужный Вам раздел. Или кликните <a href="price_hyundai_porter.php">ВЕСЬ ПРАЙС ЛИСТ ЗАПЧАСТЕЙ ПОРТЕР I и II</a></h3>
				
		
				<?php		 
					$resultidx = mysql_query ("SELECT * FROM min_page_image LIMIT 0, 6",$db);
					$myrowidx = mysql_fetch_array ($resultidx) or die ();
		
						do
							{ 
								printf ("<div class='content_category'><a href='middle_image.php?middle=%s&model=1'><img src='%s' alt='%s' /><br /><div class='p_middle'>%s</div></a></div>",$myrowidx["shrt"],$myrowidx["link"],$myrowidx["img_name"],$myrowidx["img_name"]);


							}

						while ($myrowidx = mysql_fetch_array($resultidx));		
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
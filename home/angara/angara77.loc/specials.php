<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta charset="utf-8" />
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!--[if !IE]><!--> <html class="ie">             <!--<![endif]-->
	<title>Специальные предложения и распродажи запчастей Портер!</title>
	<meta name="keywords" content="Акции запчастей Портер" />
	<meta name="description" content="Ангара спец. предложения." />
	<link href="/css/style.css" rel="stylesheet">
	<link href="/css/styleone.css"  rel="stylesheet"/>
	<link href="/css/styletwo.css"  rel="stylesheet"/>
	<link href="/nav/css/style.css"  rel="stylesheet"/>
	
	<script src="/js/jquery.js"></script>
	<script src="/js/myscripts.js"></script>
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
			
			<div class="container">
				<div class="content">
					<div class="middle_div">
					<h3>Наши акции!</h3>
					<div class="empty_spec">Ознакомтесь со спецпредложением.</div>
	      						<div id="_hiddenAdds" class="underheader_all">
									<div class="underheader_left">
										<div id="underheader_left_top">
	      									<?php
	      									$tpl = file_get_contents('include/special.php');
											echo $tpl;
											?>
										</div>
	      							</div>
	      						</div>
					<?php
					//$back = "<br /><div id='back'><a href='javascript:history.back(1)'>назад</a></div>";
					//print ($back);
						if (isset ($_GET['id'])) {$id=$_GET['id'];}
						if (!isset ($id)) {$id = 1;}
						$result = mysql_query ("SELECT * FROM ang_specials ORDER BY date_start DESC",$db);
						
						if (!$result)
						{
						echo "<p>Выбрать данные невозможно</p><br><strong>Код ошибки:</strong>";
						exit (mysql_error());
						}
						
						
						while ($myrow = mysql_fetch_array($result)) {
						//$new_view = $myrow["view"] +1;
						//$update = mysql_query ("UPDATE ang_specials SET view='$new_view' WHERE id='$id'",$db);
						if ($myrow[7] !== NULL ) {
							
						
						print ("<div class='lefttd specials'>");
						$link = "/img/specials/".$myrow[link];
						print "<img src='$link' />";		
						printf ("<h1>%s</h1><h2>%s</h2><p> Дата начала: %s</p><p> Дата окончания: %s</p>",$myrow["name"],$myrow["text"],$myrow["date_start"],$myrow["date_end"]);
						print "<a href='http://angara77.com'>Запчасти для Хундай Портер</a><br />"; 
						print ("</div>");
							}
						}
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

</body>
</html>
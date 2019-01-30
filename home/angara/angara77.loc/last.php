<?php
//error_reporting(E_ALL); 
//ini_set("display_errors", 1);
require_once ($_SERVER['DOCUMENT_ROOT'].'/catalogue/lib/func.php') ;
if (isset($_GET['id'])) {$id = $_GET['id'];}
$meta = new Catalog;
$row = $meta->meta_last($pdo,$id);
$row_area = $row[0];
//var_dump($row[0]);
//$tpl = file_get_contents('include/tpl/header.tpl.php');
//$tpl = str_replace("{row}", $row[0],$tpl);
//echo $tpl;

//$tpl_script = file_get_contents('include/tpl/scripts.tpl.php');
//echo $tpl_script;

//$tpl2 = file_get_contents('include/tpl/left_scripts.tpl.php');
	//echo $tpl2; 

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta charset="utf-8" />
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!--[if !IE]><html class="ie"><![endif]-->
	<title>Каталог запчастей Портер, подкатегория - <?= $row[0] ?></title>
	<meta name="keywords" content="<?= $row[0] ?> на Портер" />
	<meta name="description" content="Каталог запчастей для Портер, подкатегоря <?= $row[0] ?>" />
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
						<div class="img_last_scr">
							
						
							<?php
							require_once ($_SERVER['DOCUMENT_ROOT'].'/catalogue/lib/func.php') ;
						
								$object = new Catalog;
								$object->forth_query($pdo,$id);
								?>
						</div>		
					
						<div class="img_last_side ">
							
								<div id="name_data" class=" floating"><!--Here is output from ajax-->
							</div>
						</div>		
					</div>
				</div><!-- .content -->
			</div><!-- .container-->

		<aside class="left-sidebar">
			<?php include("include/lefttd.php");?>
		</aside><!-- .left-sidebar -->

		<aside class="right-sidebar">
			<?php //include("include/righttd.php");?>
		</aside><!-- .right-sidebar -->

	</div><!-- .middle-->

</div><!-- .wrapper -->


<footer class="footer">
	<?php include ('include/footer.php'); ?>
</footer><!-- .footer -->
<link href="/css/styletwo.css"  rel="stylesheet"/>
<link href="/nav/css/style.css"  rel="stylesheet"/>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="/include/styles/jquery-ui.css">
<script src="/js/jquery.js"></script>
<script src="/js/myscripts.js"></script>
<script src="/callme/js/callme.js"></script>
<script type="text/javascript" src="/catalogue/js/jquery.imagemapster.js"></script>
<script type="text/javascript" src="/catalogue/js/jquery.imagemapster.min.js"></script>
<script type="text/javascript" src="/catalogue/js/script.js"></script>
<script src="/include/javascript/jquery-ui.js"></script>
<script src="/include/javascript/autocomplete.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
	$('area').hover(function(event) {
	var name = event.target.id;
	//alert (name);
			$.get('/include/ajax.php' , {name: name}, function(data){
				$('#name_data').html(data);
			});
	});
	$(function(){
 $(window).scroll(function() { 
  var top = $(document).scrollTop();
  if (top > 200) $('.floating').addClass('fixed'); //200 - это значение высоты прокрутки страницы для добавления класс
  else $('.floating').removeClass('fixed');
 });
});
	
	
});


</script>
</body>
</html>
<?php
//error_reporting(E_ALL); 
//ini_set("display_errors", 1);
include ($_SERVER['DOCUMENT_ROOT'].'/catalogue/lib/func.php') ;
//if (isset($_GET['id'])) {$id = $_GET['id'];}
if (isset($_GET['cat'])) {$cat = $_GET['cat'];}
$meta = new metaSelect;
$row = $meta->before_last_title($pdo,$cat);

//var_dump($row);
		$pattern = "(\w+)";
		$title = preg_split($pattern, $row[1]);
		$title1 = $title[0]." для Hyundai Porter в наличии на складе ООО Ангара";

?>	
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta charset="utf-8" />
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!--[if !IE]><html class="ie"><![endif]-->
	<title><?= $title1 ?></title>
	<meta name="keywords" content="<?= $title[0] ?> на Портер" />
	<meta name="description" content="Каталог запчастей для Портер, подкатегоря  <?= $title[0] ?>" />
	
	
  <link rel="stylesheet" href="/js/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="/js/jquery.fancybox.pack.js?v=2.1.5"></script>
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
<?php 
		
		
				

				print "<div class='table'>";
				print "<div class='row'><div class='col c25'>Название</div><div class='col c25'>На складе</div><div class='col c25'>Цена руб.</div><div class='col c25'>Купить</div></div>";


		$text = "Для заказа этой автозапчасти кликните по ссылке Заказать, Вы так-же можете написать письмо или связатся любым удобным для Вас способом.";
		//include('catalogue/lib/func.php');
		
		$object = new Catalog;
		$cat_number = $object->select_angara($pdo,$cat);
		
		
		$cat_number[0] = trim(strtolower($cat_number[0]));
		if ($cat_number[0] == NULL or !isset($cat_number[0])){$cat_number[0] = "123456";
		// header ('Location: /page/');
		}
		//var_dump($cat_number);
		print "</div>";
		
		require_once ("lib/file_parser.php");
		print "<div class='parts_image'>";			
		print_image($cat_number);
		print "</div>";
	
?>
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
	<link rel="stylesheet" href="/include/styles/jquery-ui.css">	
	<script src="/js/jquery.js"></script>
	<script src="/js/myscripts.js"></script>
	<script src="/callme/js/callme.js"></script>
	<script src="/buyme/js/buyme.js" type="text/javascript" ></script>
	
	<script src="/include/javascript/jquery-ui.js"></script>
	<script type="text/javascript" src="/include/javascript/autocomplete.js"></script>
	<script type="text/javascript" src="/js/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>
</body>
</html>

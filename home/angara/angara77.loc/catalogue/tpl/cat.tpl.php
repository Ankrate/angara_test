<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	

<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta charset="utf-8" />
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!--[if !IE]><!--> <html class="ie">             <!--<![endif]-->
	<title><?php echo $title; ?></title>
	<meta name="keywords" content="<?php echo $keywords; ?>" />
	<meta name="description" content="<?php echo $description; ?>" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<link href="style.css" rel="stylesheet" type="text/css">
	
	</head>



<body>

		<?php select_angara($db, $cat);?>


</body>
</html>
<!DOCTYPE html>
<html>
	<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Ангара Запчасти</title>
		<link rel="stylesheet" href="themes/angara.min.css" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile.structure-1.3.1.min.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
	</head>
	<body>
		<div data-role="page" data-theme="a">
			<div data-role="header" data-position="inline">
				<h1>Запчасти Портер</h1>
			</div>

										
			
				<div data-role="content" data-theme="a">
				
				
			<h4>Наберите название запчасти в поле ниже например <i>головка</i></h4>
					
					<!--second form -->
					<form method="POST" action="search_porter.php" >
						<input type="search" name="search_porter" placeholder="Поиск в прайсе Портер" /></br></br>
					</form>
					
					<a href="tel:+74956469953" data-role="button" data-icon="star">Позвонить</a>	
					<a href="nav1.php" data-role="button" data-icon="star">Показать карту</a>
					
					<a data-ajax="false" href="nav.php" data-role="button" data-icon="star">Как доехать</a>	</br></br>
					
					<form method="POST" action="search_all2.php" >
   					<input type="search" name="search_all" placeholder="Поиск по всему прайсу" />   					 		
					</form>	 
					
							
				
					<div data-role="footer" data-position="fixed"> 
	<h4>ANGARA77.COM</h4> 
</div> 
					</div>
		</div>
	</body>
</html>
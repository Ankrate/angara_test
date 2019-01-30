<!DOCTYPE html>
<html>
<head>
<title>Jquery UI autocomplete</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="/styles/jquery-ui.css">
  
<script type="text/javascript" src="/catalogue/js/jquery.min.js"></script>
<script type="text/javascript" src="/catalogue/js/jquery.imagemapster.js"></script>
<script type="text/javascript" src="/catalogue/js/jquery.imagemapster.min.js"></script>
<script type="text/javascript" src="/catalogue/js/script.js"></script>
  
</head>
<body>
<div id="wrapper">
<label for="capitals">Capitals</label>
<!--<form action="#" method="get" name="post_cat">
<input id="capitals" placeholder="Поиск в Hyundai"name="search" type="text" size="60" maxlength="30" value=""/>
<input id="submit_clic_" name="submit_search" type="submit" value="&#1055;&#1086;&#1080;&#1089;&#1082;" />
</form>-->
<a id="submit_clic" href="#" onclick="name" >Some clik</a>
</div>
<div id="name_data">
	
</div>


<?php
		
					$id = '2868';
					
						require_once ($_SERVER['DOCUMENT_ROOT'].'/catalogue/lib/func.php') ;
						
						$object = new Catalog;
						$object->forth_query($pdo,$id);
								
					?>




<script type="text/javascript">
	$(document).ready(function() {
	$('area').click(function(event) {
	var name = event.target.id;
	//alert (name);
			$.get('ajax.php' , {name: name}, function(data){
				$('#name_data').html(data);
			});
	});
});
</script>



</body>
</html>
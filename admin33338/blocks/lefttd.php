<html>
<head>	
<link rel="stylesheet" href="blocks/styles/jquery-ui.css">
<script src="blocks/javascript/jquery-1.9.1.js"></script>
<script src="blocks/javascript/jquery-ui.js"></script>
<script type="text/javascript" src="blocks/javascript/autocomplete.js"></script>
	

</head>

<body>
	
	
	
  
  <script>$(function () {
    $('.select_form').focus(function () { // select text on focus
        $(this).select();
    });
    $('.select_form').mouseup(function (e) { // fix for chrome and safari
        e.preventDefault();
    });
    $('input.target2').select(function () {
        $('.log').append(' Handler for .select() called. ');
    });
});

  </script>




		<form class="form-inline" action="search1.php" method="get" name="post_cat" >
		<input id="porter" class="select_form" placeholder="Поиск в Hyundai Porter only" name="search1" type="text"   value="<?php echo @$_GET['search'];?>"/>
		<input type="hidden" name="search" id="my_id" value=""/>
		
		<input  name="submit_search" type="submit" value="PORTER" />
		</form>
		

		<form class="search" action="search1.php" method="get" name="post_cat" >
		<input id="all" class="select_form" placeholder="Поиск во всём прайсе"name="search" type="text"   value="<?php echo @$_GET['search'];?>"/>
		<input type="hidden" name="search" id="my_id2" value=""/>
		<input  name="submit_search" type="submit" value="ALL" />
		</form>
		<form class="search" action="search_tnved.php" method="get" name="post_cat" >
		<input  class="select_form" placeholder="Поиск веса и номера ТНВЭД" name="cat_number" type="text"   value="<?php echo @$_GET['search'];?>"/>
		
		
		<input  name="submit_search" type="submit" value="tnved" />
		</form>
		
		
		






</html>







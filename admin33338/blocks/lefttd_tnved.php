<head>
<SCRIPT language="JavaScript">
function select(){
       var oTextBox = document.getElementById('cat_number');
       oTextBox.focus();
       oTextBox.select();
}


</SCRIPT>

<link href="../style_porter.css" rel="stylesheet" type="text/css" />
</head>
<body>
<td width="190px" valign="top" class="left">

<div class="lefttd"><a href="index.php">MAIN</a></div>
<div class="lefttd"><a href="../../index.php" target="_blank">Do not know</a></div>
<div class="lefttd">Search by cat number:</div>
<form class="search" action="search_tnved.php" method="post" name="post_cat">
<input name="cat_number" type="text" size="17" maxlength="15" value="<?php echo $_POST['cat_number'];?>" onfocus="this.select()" /><br><br>
<input name="submit_search" type="submit" value="&#1055;&#1086;&#1080;&#1089;&#1082;" /></form>

<!--<div class="lefttd">Search bu name:</div>
<form class="search" action="search_tnved.php" method="post" name="post_search">
<input name="search" type="text" size="17" maxlength="60"  value="<?php echo $_POST['search'];?>" onfocus="this.select()" /><br /><br />
<input name="submit_search" type="submit" value="&#1055;&#1086;&#1080;&#1089;&#1082;" /></form>-->


</div>




 
</td>
</body>
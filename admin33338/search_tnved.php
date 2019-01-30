<?php
include_once ('lock.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
$db = db_old();
?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
	
		<div class="admin_header"><a href="index.php"><span>ANGARA Co.LTD., from 2001 year.</span></a></div>
	
			<div class="square">
				<div class='domoy'><a href="/admin33338/">В админку</a></div>
				<div class='domoy'><a href="../">На сайт</a></div>
				<?php include ("blocks/lefttd.php");?>
				<ul>
				<li><a href="editor.php">Статьи</a></li>
				</ul>
			</div>
			<div class="side_bar">
<?php
		$back = "<br /><div id='back'><a href='javascript:history.back(1)'>Back</a></div>";
		print ($back);
		
		if  (isset($_GET['cat_number'])) {
		$cat_number = str_replace("-","",$_GET['cat_number']);
		$cat_number = trim($cat_number);
		
		$query = "SELECT * FROM `ang_name_code_weight` WHERE `cat_number` LIKE '%$cat_number%' OR `name_rus` LIKE '%$cat_number%'"; 
		$result = mysql_query($query) or die("Fuck you!"); 
		print "<table class='tab'>\n";
		print "<tr><th>Наименование</th><th>Каталог</th><th >Вес нетто</th><th >Вес брутто</th></tr>";

		while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
		print "\t<tr>\n";
		for ($i=2;$i<7;$i++) { print "\t\t<td class='p_cat_number'>$line[$i]</td>\n"; } 

		//print "<td class='p_cat_number'>A</td>";
		print "\t</tr>\n";
	}	
		print "</table>\n";
		mysql_free_result($result);
		mysql_close($db);


	}
		else {
			die();
	}	
?>

</div>
        



</body>
</html>

	<?php
	 function SelectSpec()
	{
		
	
		include_once ('include/bd.php');
		$query_spec = "SELECT *  FROM ang_specials  WHERE date_end >= NOW()";
		$result_spec = mysql_query($query_spec) or die("Запрос ошибочный");
		while ($myrow_spec = mysql_fetch_array($result_spec)) {
			print "<ul>";
			print "<li>";
			print "<a href='specials.php'>";
			print " ".$myrow_spec['name']."</a>";
			print "<li>";
			print "</ul>";
		}
	}
	?>
	

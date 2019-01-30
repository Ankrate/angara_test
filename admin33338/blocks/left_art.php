<?php	
include_once ('lock.php');
include("../include/bd.php");

			print "<h6><a href='new_art.php'> Добавить новую</a></h6>";
			
			$result = mysql_query ("SELECT * FROM data  ORDER BY date DESC LIMIT 20");
			if (!$result)
			{
			echo "<p>Выбрать данные невозможно</p><br><strong>Код ошибки:</strong>";
			exit (mysql_error());
			}
			print "<h4 class='post_h3'>Выбрать статью для редактирования</h4>";
			print("<div class='articles_mini'>");
			print "<ol>";
			if (mysql_num_rows ($result)>0)
			{
			$myrow = mysql_fetch_array($result);
			do {
			print "<div class='articles_list'><li><a href=editor.php?row=$myrow[id]>";
			print ($myrow['title']."<br />");
			print "</a></li></div>";
			}
			
			while ($myrow = mysql_fetch_array($result));
			}
			
			else 
			{
			echo "<p>Sorry have not rows in the table</p>";
			exit ();
			
			}
			print "</ol>";
			print("</div>");
?>
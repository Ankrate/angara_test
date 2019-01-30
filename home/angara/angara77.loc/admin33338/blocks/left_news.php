<script type="text/javascript">
	function confirm_delete() {
		return confirm ('Удалить?');
		
	}
	
</script>


<?php	
include_once ('lock.php');
include("../include/bd.php");



			print "<h6><a href='new_spec.php'> Добавить новую акцию</a></h6>";
			
			$result = mysql_query ("SELECT * FROM ang_news  ORDER BY date DESC LIMIT 20");
			if (!$result)
			{
			echo "<p>Выбрать данные невозможно</p><br><strong>Код ошибки:</strong>";
			exit (mysql_error());
			}
			print "<h4 class='post_h3'>Выбрать акцию для редактирования</h4>";
			print("<div class='articles_mini'>");
			print "<ol>";
			if (mysql_num_rows ($result)>0)
			{
			$myrow = mysql_fetch_array($result);
			print "<div id='table_spec'>";
			do {
			
			
			print "<div class='table_row_spec'>";
			print "<div class='table_sell_spec'>";
			print '<div id="del_spec1" class="articles_list"><li><a href=editor_news.php?row='.$myrow[id].'>';
			
			print ($myrow['title']."<br />");
			print "</a></li></div>";
			print "</div>";
			print '<div id="del_spec2" class="table_sell_spec"><a  href=delete_news.php?delete_spec='.$myrow[id].' onclick="confirm_delete()">x Delete</a></div>';
			print "</div>";
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
			print "</div>";
		
?>
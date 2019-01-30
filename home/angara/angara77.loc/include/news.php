<div class="lefttd wrap-reviews">
<?php	

include("../include/bd.php");



			
			$query_news = "SELECT * FROM ang_news  ORDER BY date DESC LIMIT 20";
			$result_news = mysql_query ($query_news);
			
			for ($i=0;  $myrow = mysql_fetch_array($result_news); $i++ )
			{
			$news[$i]['title'] = $myrow['title'];
			$news[$i]['text'] = $myrow['text'];
			
			}
?>


<?php foreach ($news as $new): ?>
    <h1><?=$new['title']?></h1>
    <p><?=$new['text']?></p>
<?php endforeach; ?>


</div>
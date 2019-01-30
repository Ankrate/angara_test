<?php
include_once ('lock.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');

$db = db_old();
if (isset($_GET['row'])) {
	$get_id =  $_GET['row'];
}
else $get_id = 1;
?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
		<div class="admin_header"><a href="/admin33338/"><span>ANGARA Co.LTD., from 2001 year.</span></a></div>
	
			<div class="square">
				<div class='domoy'><a href="/admin33338/">В админку</a></div>
				<div class='domoy'><a href="../">На сайт</a></div>
				<?php include ("blocks/left_news.php");?>
				
			</div>
			
			<?php 
			
			if (isset($_POST['editor1'])) {
				
				
				
				$editor_data = $_POST['editor1'];
				$update = "UPDATE ang_news SET text = '$editor_data' WHERE id='$get_id'";
				$result = mysql_query($update);
				
		}
			
	
			?>
	<div class="side_bar">
		<div id="my_editor">	
		<form method="post">
            <textarea  class="text_area" name="editor1" id="editor1" rows="10" cols="80">
            	
            	<?php 
            	
            	$result = mysql_query ("SELECT `text` FROM `ang_news` WHERE `id`= {$get_id}") or die("Запрос ошибочный");
				$text = mysql_fetch_array($result);
				print( $text[0]);
            	?>
            </textarea>
            
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
                //config.height = '500px';
                
            </script>
        </form>
			</div>		
			</div>
	


  







</body>
</html>
<?

/* Освобождение памяти, занятой результатом запроса */ 
mysql_free_result($resultr); 
/* Закрытие соединения */ 
mysql_close($db);
?>


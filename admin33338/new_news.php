<?php
include_once ('lock.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
$db = db_old();

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
			//print_r ($_POST);
			
			if (isset($_POST['editor1'] , $_POST['title'])){
				
				$title = $_POST['title'];
				$editor_data = $_POST['editor1'];
				
				$update = "INSERT INTO ang_news SET 
				text = '$editor_data',
				title ='$title',			
				date   =  now()				
				 ";
				$result = mysql_query($update);
				if ($result) echo "Сохранено!";
				else echo "Ошибка сохранения!";
		}
		
			else echo "Вы ввели не все поля";
			
			?>
	<div class="side_bar">
		<div id="my_editor">	
		<form method="post">
			<p><input type="text" name="title" /> Название </p>
			
			<h5>Текст Статьи</h5>
            <textarea  class="text_area" name="editor1" id="editor1" rows="10" cols="80">
            	
            	Some Content
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




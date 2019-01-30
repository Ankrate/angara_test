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
				<?php include ("blocks/left_art.php");?>
				
			</div>
			
			<?php 
			//print_r ($_POST);
			
			if (isset($_POST['editor1'] , $_POST['title'], $_POST['author'], $_POST['mini_img'])){
				
				$title = $_POST['title'];
				$author = $_POST['author'];
				$meta_k = $_POST['meta_k'];
				$meta_d = $_POST['meta_d'];
                $mini_img = $_POST['mini_img'];
				$editor_data = $_POST['editor1'];
				$update = "INSERT INTO data SET 
				text = '$editor_data',
				title ='$title',
				author = '$author',
				date   =  now(),
				meta_k =  '$meta_k',
				meta_d =  '$meta_d',
				mini_img =  '$mini_img'
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
			<p>Название статьи<input class="form-control field2" type="text" name="title" placeholder="Название статьи" > </p>
			<p>Автор статьи<input class="form-control field2" type="text" name="author" placeholder="Автор"  > </p>
			<p>Ключевые фразы<input class="form-control field2" type="text" name="meta_k" placeholder="Ключевые фразы" > </p>
			<p>Метатег описание<input class="form-control field2" type="text" name="meta_d" placeholder="Метатег описание" > </p>
			<p>Каринка<input class="form-control field2" type="text" name="mini_img" placeholder="Картинка" > </p>
			
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




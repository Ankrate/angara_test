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
				<?php include ("blocks/left_spec.php");?>
				
			</div>
			
			<?php 
			//print_r ($_POST);
			function goback(){
			header('Location: editor_spec.php');
			exit;
			}
			
			if (isset($_POST['editor1'] , $_POST['name'],  $_POST['date_end'])){
				
				//print_r($_POST);
				
				$name = $_POST['name'];
				$date_stert = $_POST['date_start'];
				$date_end = $_POST['date_end'];
				$link = $_POST['link'];
				$text = $_POST['editor1'];
				
				$update = "INSERT INTO ang_specials SET 
				name = '$name',
				text ='$text',				
				date_start   =  now(),
				date_end =  '$date_end'				
				 ";
				$result = mysql_query($update);
				if ($result) { echo "Сохранено!";
								goback();
				
				
				}
				else echo "Ошибка сохранения!";
		}
		
			else echo "Вы ввели не все поля";
			
			?>
	<div class="side_bar">
		<div id="my_editor">	
		<form method="post">
			<p><input type="text" name="name" /> Название акции</p>
			<p><input type="date" name="date_end" /> Дата окончания</p>
			
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




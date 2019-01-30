<? include_once ("lock.php"); ?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
<table width="690" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="main_border">
<!--Подключаем шапку сайта-->
<? include("insert/blocks/header.php");   ?> 
  <tr>
    <td><table width="690" border="0" cellspacing="0" cellpadding="0">
      <tr>
<!--Подключаем левый блок сайта-->
<? include ("insert/blocks/lefttd.php");  ?>      
        <td valign="top">
       <p class="left2"><?php

	   
	   //Удаляем старый прайс-лист
	   $oldfilename = $_FILES["filename"]["name"];
	   $old_file = "/home/u66745/angara77.com/www/admin/prices/".$oldfilename;
	   if(unlink($old_file)) {
	   print "Старый прайс удален!\n";}
	   else {print "Невозможно удалить файл";}
	   
	   
	   //Загружаем новый прайс на сервер
   if($_FILES["filename"]["size"] > 1024*3*1024)
   {
     echo ("Размер файла превышает три мегабайта");
     exit;
   }
   if(copy($_FILES["filename"]["tmp_name"],
     "/home/u66745/angara77.com/www/admin/prices/".$_FILES["filename"]["name"]))
   {
     echo("Файл успешно загружен <br>");
     echo("Характеристики файла: <br>");
     echo("Имя файла: ");
     echo($_FILES["filename"]["name"]);
     echo("<br>Размер файла: ");
     echo($_FILES["filename"]["size"]);
     echo("<br>Каталог для загрузки: ");
     echo($_FILES["filename"]["tmp_name"]);
     echo("<br>Тип файла: ");
     echo($_FILES["filename"]["type"]);
   } else {
      echo("Ошибка загрузки файла");
   }
?>
<p class="left2"><a href="index.php">Вернуться в админку</a></p>
</body>
</html></p> 
        </td>
      </tr>
    </table></td>
  </tr>
<!--Подключаем нижний графический элемент-->  
<?  include ("blocks/footer.php");        ?>  
</table>
</body>
</html>

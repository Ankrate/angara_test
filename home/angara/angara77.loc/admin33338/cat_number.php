<?php 
require_once ("../blocks/bd.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Подбор запчастей Hyundai</title>
<meta name="keywords" content="Подбор запчастей на Hyndai" />
<meta name="description" content="Запчасти для Hyndai" />

<link href="../style_hyundai.css" rel="stylesheet" type="text/css" />
<link rel="favicon" href="../favicon.ico" type="image/x-icon">
<link rel="shortcut favicon" href="../favicon.ico" type="image/x-icon" />
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <?php include ('blocks/header.php');?>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr><?php include ("blocks/lefttd.php");  ?>
        <td valign="top" ><?php
$back = "<br /><div id='back'><a href='javascript:history.back(1)'>назад</a></div>";
print ($back); 

if (isset($_GET[cat_number])) {$cat_number = $_GET[cat_number];}
if (isset($_POST[cat_number])) {$cat_number = $_POST[cat_number];}
// Get check $cat_number

if (empty($cat_number) or strlen($cat_number)<4)
{ exit("<h3>Вы не ввели запрос или он менее 4 символов</h3>");}
else {

$cat_number = htmlspecialchars($cat_number);
$cat_number = trim($cat_number);
$cat_number = strtolower($cat_number);
$cat_number = substr($cat_number,0,15);
$cat_number = str_replace ("-","",$cat_number);

/*$query_a = "SELECT * FROM `angara` WHERE `name` LIKE CONVERT(_utf8 '%$cat_number%' USING cp1251) COLLATE cp1251_general_ci";*/

$query_a = "SELECT * FROM `angara` WHERE `cat` LIKE '%$cat_number%' ORDER BY `name`";



/*if (!$result_a)
{
echo "<p>Выбрать данные невозможно</p><br><strong>Код ошибки:</strong>";
exit (mysql_error());
}*/


//print ($cat_number);



$text = "Здравствуйте!!!";

print (" <table class='tab' ><tr><th  class='p_cat_number2'>Название</th><th class='p_cat_number3'>COD</th><th class='p_cat_number'>C</th><th class='p_cat_number3'>Цена рублей</th><th class='p_cat_number3'>Наличие</th><th class='p_cat_number3'>ед.изм</th></tr>");

$result_a =mysql_query ("$query_a",$db); /*Делаем запрос на Angara*/


$myrow_a = mysql_fetch_array($result_a);
do {
$cat = $myrow_a["cat"];
$name = $myrow_a["name"];
$price = $myrow_a["price"];
$sklad = "A";
$id = $myrow_a["id"];
$nal = $myrow_a["nal"];
$set = $myrow_a['set'];


printf ("<tr><td class='p_cat_number2'>%s</td><td class='p_cat_number3'>%s</td><td class='p_cat_number'>%s</td><td class='p_cat_number3'>%s</td><td class='p_cat_number'>%s</td><td class='p_cat_number'>%s</td></tr>",$name,$cat,$sklad,$price,$nal,$set);}

while ($myrow_a = mysql_fetch_array($result_a));


require_once ("obrabotchik/search_from_image_ozernaya.php");

require_once ("obrabotchik/search_from_image_vostok.php");
/*Заканчиваем проверять Восток начинаем проверять следующих*/

require_once ("obrabotchik/search_from_image_kare.php");
/*Заканчиваем проверять kare начинаем проверять следующих*/

//require_once ("obrabotchik/search_from_image_akko.php");

print "</table>";
/*if (mysql_num_rows ($result)==0)
{
print "<p class='sorry'>К сожалению этой детали временно нет на складе<img class='sorry_smail' src='../img/main_page_img/203.gif' width='78' height='78' /></p>";
}*/



}// Скобка проверки empty or >4 char
?>
</td><td><td></td></td>                
      </tr>   
    </table>     
  </tr></td>         

  
</table>

</body>
</html>

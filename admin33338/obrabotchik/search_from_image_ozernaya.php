<?php 
require_once ("lock.php");
/*До сюда*/
$query = "SELECT * FROM `ozernaya` WHERE `cat` LIKE '%$cat_number%' ORDER BY `name`";
$result = mysql_query ("$query",$db); /*Делаем запрос на озерную*/
if (!$result)
{
echo "<p>Выбрать данные невозможно</p><br><strong>Код ошибки:</strong>";
exit (mysql_error());
}

if (mysql_num_rows ($result)>0)
{

$myrow = mysql_fetch_array($result);
do {
$ozer_price = $myrow["price"];
//$ozer_price = $ozer_price + $ozer_price * 0.5;/*Присваиваем переменной цену озерной плюс 50%*/

$cat = $myrow["cat"];
$name = $myrow["name"];
$price = $ozer_price;
$sklad = "O";
$id = $myrow["id"];
$nal = "МНОГО";
$set = "шт";

printf ("<tr><td class='p_cat_number2'>%s</td><td class='p_cat_number3'>%s</td><td class='p_cat_number'>%s</td><td class='p_cat_number3'>%s</td><td class='p_cat_number3'>%s</td><td class='p_cat_number3'>%s</td></tr>",$myrow["name"],$cat,$sklad,$ozer_price,$nal,$set);}
while ($myrow = mysql_fetch_array($result));

}
//echo "</table>";
?>
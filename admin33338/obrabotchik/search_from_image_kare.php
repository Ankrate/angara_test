<?php 

$query = "SELECT * FROM `kare` WHERE `cat` LIKE '%$cat_number%' ORDER BY `name`";
$result = mysql_query ("$query",$db); /*Делаем запрос на kare*/
if (!$result)
{
echo "<p>Выбрать данные невозможно</p><br><strong>Код ошибки:</strong>";
exit (mysql_error());
}

if (mysql_num_rows ($result)>0)
{

$myrow_k = mysql_fetch_array($result);
do {
$kare_price = $myrow["price"];
//$kare_price = $kare_price*1.7;/*Присваиваем переменной цену каре плюс 70%*/

$cat = $myrow["cat"];
$name = $myrow["name"]." ".$myrow["brand"];
$price = $kare_price;
$sklad = "Kar";
$id = $myrow["id"];
$nal = "МНОГО";
$set = "шт";

printf ("<tr><td class='p_cat_number2'>%s</td><td class='p_cat_number3'>%s</td><td class='p_cat_number'>%s</td><td class='p_cat_number3'>%s</td><td class='p_cat_number3'>%s</td><td class='p_cat_number3'>%s</td></tr>",$name,$cat,$sklad,$price,$nal,$set);}

while ($myrow = mysql_fetch_array($result));

}
//echo "</table>";
?>
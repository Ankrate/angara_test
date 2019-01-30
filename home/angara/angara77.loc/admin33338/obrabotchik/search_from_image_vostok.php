<?php 

$query = "SELECT * FROM `vostok` WHERE `cat` LIKE '%$cat_number%' ORDER BY `name`";
$result = mysql_query ("$query",$db);

if (!$result)
	{
echo "<p>Выбрать данные невозможно</p><br><strong>Код ошибки:</strong>";
exit (mysql_error());
	}

if (mysql_num_rows ($result)>0)
{

$myrow = mysql_fetch_array($result);
do{
$vost_price = $myrow["price"];
//$vost_price = $vost_price + $vost_price * 0.5;/*Увеличиваем цену Востока*/


$cat = $myrow["cat"];
$name = $myrow["name"];
$price = $vost_price;
$sklad = "V";
$nal = "МНОГО";
$set = "шт";

printf ("<tr><td class='p_cat_number2'>%s</td><td class='p_cat_number3'>%s</td><td class='p_cat_number'>%s</td><td class='p_cat_number3'>%s</td><td class='p_cat_number3'>%s</td><td class='p_cat_number3'>%s</td></tr>",$name,$cat,$sklad,$price,$nal,$set);}

while ($myrow = mysql_fetch_array($result));

}
?>
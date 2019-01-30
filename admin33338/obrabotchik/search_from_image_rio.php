<?php 

$query_r = "SELECT * FROM `rio` WHERE `cat` LIKE '%$cat_number%' LIMIT 0, 30";
$result_r = mysql_query ("$query_r",$db);

if (!$result)
	{
echo "<p>Выбрать данные невозможно</p><br><strong>Код ошибки:</strong>";
exit (mysql_error());
	}

if (mysql_num_rows ($result_r)>0)
{

$myrow_r = mysql_fetch_array($result_r);
do{
$rio_price = $myrow_r["price"];
$rio_price = $rio_price + $rio_price * 0.1;/*Увеличиваем цену Rio*/



$cat = $myrow_r["cat"];
$name = $myrow_r["name"];
$price = $rio_price;
$sklad = "R";

printf ("<table class='tab'><tr><td class='p_cat_number2'>%s</td><td class='p_cat_number3'>%s</td><td class='p_cat_number'>%s</td><td class='p_cat_number3'>%s</td></tr></table>",$name,$cat,$sklad,$price);}

while ($myrow_r = mysql_fetch_array($result_r));
}
?>
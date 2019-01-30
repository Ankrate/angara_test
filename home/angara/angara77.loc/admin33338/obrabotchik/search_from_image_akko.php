<?php 

$query = "SELECT * FROM `akko` WHERE `cat` LIKE '%$cat_number%' ORDER BY `name`";
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

$cat = $myrow["cat"];
$name = $myrow["name"];
$sklad = "AK";
$nal = "МНОГО";
$set = "шт";
$price_big_opt = $myrow["price_big_opt"];
$price_small_opt = $myrow["price_small_opt"];

printf ("<tr><td class='p_cat_number2'>%s</td><td class='p_cat_number3'>%s</td><td class='p_cat_number'>%s</td><td class='p_cat_number3'>%s</td><td class='p_cat_number3'>%s</td><td class='p_cat_number3'>%s</td></tr>",$name,$cat,$sklad,$price_big_opt,$price_small_opt,$set);}

while ($myrow = mysql_fetch_array($result));

}
?>
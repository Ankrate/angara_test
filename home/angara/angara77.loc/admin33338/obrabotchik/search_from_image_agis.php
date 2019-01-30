<?php 
$result = mysql_query ("SELECT * FROM agis WHERE cat='$cat_number'",$db);
if (!$result)
	{
echo "<p>Выбрать данные невозможно</p><br><strong>Код ошибки:</strong>";
exit (mysql_error());
	}

if (mysql_num_rows ($result)>0)
{
$myrow = mysql_fetch_array($result);

$rio_price = $myrow["price"];
$rio_price = $rio_price + $rio_price * 0.5;/*Увеличиваем цену agis*/


printf ("<div class='price'><p class='obrashenie'>%s</p></div><table class='tab' align='center'><tr><th  class='p_cat_number2'>Название</th><th class='p_cat_number'>Цена рублей</th><th class='p_cat_number'>Заказ</th></tr><tr><td class='p_cat_number'>%s</td><td class='p_cat_number'>%s</td><td class='p_cat_number'><a href='order.php'>Заказать</a></td></tr></table>",$text,$myrow["name"],$rio_price);
print "<br />AG";


}
?>
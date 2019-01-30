<?php include ("blocks/bd.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Прайс-лист запчасти Ssang Yong ISTANA</title>
<meta name="keywords" content="Запчасти Ssang Yong ISTANA" />
<meta name="description" content="Запчасти Ssang Yong ISTANA" />

<link href="style_porter.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"
</head>


<body>
<table width="790" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <?php include ('blocks/header.php');?>
  <tr>
    <td><table width="100%" border="0px" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <?php include ("blocks/lefttd.php");?>
        <td valign="top" >
        
        <div class="printer"><a href="print_all_price_istana.php"><img src="http://angara77.com/img/printer.png" /><br/> Версия для<br />печати</a></div>
		
<?php

$back = "<br /><div id='back'><a href='javascript:history.back(1)'>назад</a></div>";
echo ($back);

$result = mysql_query ("SELECT * FROM angara",$db);
if (!$result)
{
echo "<p>Выбрать данные невозможно</p><br><strong>Код ошибки:</strong>";
exit (mysql_error());
}
print "<h3 class='post_h3'>Прайс-лист запчастей автомобиля Истана<br />Компании ООО \"Ангара\".Телефон <div>(495)646-99-53</div>.</h3>";
if (mysql_num_rows ($result)>0)
{
$myrow = mysql_fetch_array($result);
do {

$small_img = "<div class='small_foto'></div>";
printf ("<table class='tab_price'><tr><td class='td'><div class='p_cat_number'><a href='cat_number.php?cat_number=%s'>%s</a></div></td><td class='td_price'><td class='p_cat_number'>%s рублей</td></td></tr></table>",$myrow["cat"],$myrow["name"],$myrow["price"],$myrow["nal"]);
}

while ($myrow = mysql_fetch_array($result));
}

else 
{
echo "<p>Sorry have not rows in the table</p>";
exit ();

}
 ?>        
        
        </td>                 
      </tr>   
    </table>     
  </tr></td>         
<?php include ("blocks/footer.php"); ?>
  
</table>
</body>
</html>

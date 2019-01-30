<?php require_once ("lock.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Ангара - лучшая компания в мире!</title>
<link href="../style_hyundai.css" rel="stylesheet" type="text/css" />
<link rel="favicon" href="../favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
</head>
<body>
<table width="100%"  align="center" cellpadding="0" cellspacing="0" >
  <?php include ('blocks/header.php');?>
  <tr>
    <td><table width="100%" border="0px" cellpadding="0" cellspacing="0">
      <tr>
        <?php include ("blocks/lefttd.php");?>
        <td valign="top" >
		
<?php

function price() { $text = "C Добрым Утром любимая Олеся! Улыбнитесь новому дню!";
		print "<h1 id='olesya'>";
		print $text;
		print "</h1>";
		require_once ("blocks/istana_bd.php");
		$query = "SELECT * FROM `angara` ORDER BY `name`"; 

$result = mysql_query($query) or die("Запрос ошибочный"); 

/* Печать результатов в HTML */ 

print "<div class='search'>Склад \"АНГАРА-Истана\"</div>";

print "<table class='tab'>\n";
 
print "<tr><th  class='p_cat_number2'>Название</th><th class='p_cat_number'>Наличие</th><th class='p_cat_number'>Код</th><th class='p_cat_number'>Цена рублей</th></tr>";

while ($line = mysql_fetch_array($result, MYSQL_NUM)) { 

 

print "\t<tr>\n"; 

for ($i=1;$i<=4;$i++) { print "\t\t<td class='p_cat_number'>$line[$i]</td>\n"; } 

//print "<td class='p_cat_number'>A</td>";
print "\t</tr>\n";
}
print ("</table>");

}//end function price

price();
		
		
		?></td><td><?php include ("blocks/righttd.php"); ?></td>                 
      </tr>   
    </table>     
  </tr></td>         
<?php /* include ("../blocks/footer.php");*/  ?>
  
</table>
</body>
</html>

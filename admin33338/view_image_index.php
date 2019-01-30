<?php require_once ("lock.php");

include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
$db = db_old();
if (isset($_GET[mod])) {$mod = $_GET[mod];}
$result12 = mysql_query ("SELECT * FROM model WHERE id='$mod'",$db);
$myrow12 = mysql_fetch_array($result12);
$mod_tit = $myrow12["model_name"];

setcookie("mod_tit",$mod_tit,time()+3600);

?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
  <?php include ('blocks/header.php');?>
  <tr>
    <td><table width="100%" border="0px" cellpadding="0" cellspacing="0">
      <tr>
        <?php include ("blocks/lefttd.php");?>
        <td valign="top" >
<?php
$back = "<br /><div id='back'><a href='javascript:history.back(1)'>назад</a></div>";
print ($back);

if (isset($_GET[mod])) {$mod = $_GET[mod];}
$mod = stripslashes($mod);
$mod = htmlspecialchars($mod);

if (empty($mod)) {exit("Sorry put paranetres");}

$result2 = mysql_query("SELECT * FROM model WHERE id='$mod'",$db);
$myrow2 = mysql_fetch_array($result2);/*Первый запрос к базе, выборка из таблицы моделей*/

$result = mysql_query ("SELECT * FROM main_table",$db);
if (!$result)
{
echo "<p>Выбрать данные невозможно</p><br><strong>Код ошибки:</strong>";
exit (mysql_error());
}

if (mysql_num_rows ($result)>0)
{
$myrow = mysql_fetch_array($result);

$link  = "<img src='../img/porter_img/porter_graphical_index_1997_2001_eur.jpg' alt='porter parts' usemap='#Map' />";
printf ( "<h3 class='model'>Вы находитесь в категории %s</h3><br>
		<div class='float_middle2'>%s</div><br><br>
",$myrow2["model_name"],$link);
$mod_tit = $myrow2["model_name"];

$test = $myrow2['id'];


printf ("<map name='Map' id='Map'>
  <area shape='rect' coords='3,5,170,155' href='middle_image.php?middle=engine&model=%s' alt='двигатель' />
<area shape='rect' coords='177,7,344,155' href='middle_image.php?middle=mission&model=%s' alt='трансмиссия' />
<area shape='rect' coords='349,7,517,153' href='middle_image.php?middle=chassis&model=%s' alt='шасси' />
<area shape='rect' coords='5,165,174,313' href='middle_image.php?middle=body&model=%s' alt='кузов' />
<area shape='rect' coords='177,166,346,313' href='middle_image.php?middle=trim&model=%s' alt='салон' />
<area shape='rect' coords='352,165,518,316' href='middle_image.php?middle=electrical&model=%s' alt='электрика' />
</map>",$myrow2["id"],$myrow2["id"],$myrow2["id"],$myrow2["id"],$myrow2["id"],$myrow2["id"]);
}

else 
{
echo "<p>Sorry have not rows in the table</p>";
exit ();
}


?></td><td><?php include ("blocks/righttd.php"); ?></td>                 
      </tr>   
    </table>     
  </tr></td>         

  
</table>


</body>
</html>

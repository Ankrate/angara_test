<?php 
require_once ("lock.php");
require_once("../blocks/bd.php");
$result = mysql_query ("SELECT * FROM main_table",$db);
/*if (!$result)
{
echo "<p>Выбрать данные невозможно</p><br><strong>Код ошибки:</strong>";
exit (mysql_error());
}

if (mysql_num_rows ($result)>0)
{
$myrow = mysql_fetch_array($result);

}

else 
{
echo "<p>Sorry have not rows in the table</p>";
exit ();
}
*/

?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <?php include ('blocks/header.php');?>
  <tr>
    <td><table width="100%" border="0px" cellpadding="0" cellspacing="0">
      <tr>
        <?php include ("blocks/lefttd.php");?>
        <td valign="top" >
<?php
$back = "<br /><div id='back'><a href='javascript:history.back(1)'>назад</a></div>";
print ($back);
		 if (isset($_GET[model])) {$model = $_GET[model];}
		 if (isset($_GET[middle])) {$middle = $_GET[middle];}
		 if (empty($model) or empty($middle)) {exit("Sorry put parametres");}
		 
		 
		 
		 $model_show = mysql_query ("SELECT model_name FROM model WHERE id='$model'",$db);
		 $model_row = mysql_fetch_array($model_show);
		
 	 	 $mod_show = $model_row['model_name'];		 
	
		 print "<div class='naz'>Пожалуйста выберите категорию</div><br />";
		 
		 echo ("<h3 class='model'>Вы находитесь в категории $_COOKIE[mod_tit]</h3>");
			 
		 
		 
		 $model = stripslashes($model);
		$model = htmlspecialchars($model);
		$middle = stripslashes($middle);
		$middle = htmlspecialchars($middle);
		 
		 
		 $result_midd = mysql_query ("SELECT * FROM gafic_idx_middle WHERE model='$model' && groop='$middle'",$db);
if (!$result_midd)
{
echo "<p>Выбрать данные невозможно</p><br><strong>Код ошибки:</strong>";
exit (mysql_error());
}

if (mysql_num_rows ($result)>0)
{
$myrow_midd = mysql_fetch_array($result_midd);


do
{  
printf ("<div id='background' class='float_middle'><a href=last.php?id=%s ><img src='../%s'/><br /><div class='p_middle'>%s</div></a></div>",$myrow_midd["id"],$myrow_midd["link"],$myrow_midd["title"]);
}
while ($myrow_midd = mysql_fetch_array($result_midd));

}


else 
{
echo "<p><strong>Возможно эту запчасть еще не успели занести в базу,<br />пожалуйста позвоните менеджеру по телефону 646-99-53<br />Вам обязательно помогут!</strong></p>";
exit ();
}
?></td><td><?php include ("blocks/righttd.php"); ?></td>                 
      </tr>   
    </table>     
  </tr></td>         

  
</table>

</body>
</html>

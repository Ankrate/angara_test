<?php
include("blocks/bd.php");

$result = mysql_query ("SELECT * FROM  foto_album",$db);
		
if (!$result)
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


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Ангара Фото</title>
<meta name="keywords" content="<?php echo "Автозапчасти Hyundai ". $_COOKIE[mod_tit]; ?>" />
<meta name="description" content="<?php echo "Автозапчасти Hyundai ". $_COOKIE[mod_tit]; ?>" />

<link href="style_hyundai.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
</head>


<body>
<table  width="100%">
  <tr><td><?php include ('blocks/header.php');?></td></tr>
  <tr><td><table>
    <tr valign="top"><td width="17%" valign="top" class="left"><?php include ("blocks/lefttd.php");?></td>
		<td >
<?php
$back = "<br /><div id='back'><a href='javascript:history.back(1)'>назад</a></div>";
print ($back);

		print "<h5 id='main_text'>";
		print  "Для просмотра галереи кликните по картинке";
		print "</h5>";

printf ("<div class='float_middle'>");		 
print ("<a href='img/fotokorea1/index.html'><img src='img/fotokorea1/thumbs/tn_DSC01045.jpg' />Фотографии в Корее</a>");
printf ("</div>");		
		do
{ 
printf ("<div class='float_middle'><a  href='rest_viev.php?id=%s'><img src='%s' alt='%s' /><br /><div
 class='p_middle'>%s</div></a></div>",$myrow["id"],$myrow["thumb_link"],$myrow["name"],$myrow["text"]);
}
while ($myrow = mysql_fetch_array($result));


		
		
		?>
		</td><td width="170px" valign="top" class="right"> <?php include ("blocks/righttd.php"); ?></td>
				</tr>
		
    </table> </td></tr>    
  
<?php include ("blocks/footer.php"); ?>

  
</table>





<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-4786389-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>
</body>
</html>

<?php
 

include("blocks/bd.php");


$result = mysql_query ("SELECT * FROM main_table",$db);
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
<title>Запчасти для автомобилей Hyundai ООО Ангара</title>
<meta name="keywords" content="<?php echo "Автозапчасти Hyundai, Хундай,Хюндай,Хёндэ ". $_COOKIE[mod_tit]; ?>" />
<meta name="description" content="<?php echo "Запасные части для Hyundai". $_COOKIE[mod_tit]; ?>" />

<link href="style_hyundai.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
</head>


<!-- <div class="rezim"><img src="img/banners/rezim_raboyi.png" /></div> -->


<body>
<table  width="100%">
  <tr><td><?php include ('blocks/header.php');?></td></tr>
  <tr><td><table>
    <tr valign="top"><td width="17%" valign="top" class="left"><?php include ("blocks/lefttd.php");?></td>
		<td width="100%">	
		
<?php
		print "<h4 id='main_text'>";
		
		print "Сертификат дилера Хендай Портер";
	
		print "</h4>";
?>

<img src="img/sert/sert-sample.jpg"  hspace="5" vspace="5" alt="certificat" align="middle" />



</td><td><?php include ("blocks/righttd.php"); ?></td>                 
      </tr>   
    </table>     
  </tr></td>         
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

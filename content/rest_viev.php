<?php
include("blocks/bd.php");
if (isset($_GET[id])) {$id = $_GET[id];}

$result = mysql_query ("SELECT * FROM  foto_album WHERE id='$id'",$db);
		
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
<title><?php echo $myrow["name"]; ?></title>
<meta name="keywords" content="<?php echo "Автозапчасти Hyundai ". $_COOKIE[mod_tit]; ?>" />
<meta name="description" content="<?php echo "Автозапчасти Hyundai ". $_COOKIE[mod_tit]; ?>" />

<link href="style_hyundai.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
</head>


<body>
 <tr><td><?php include ('blocks/header.php');?></td></tr>
  <tr><td><table>
    <tr valign="top"><td width="17%" valign="top" class="left"><?php include ("blocks/lefttd.php");?></td>
		<td >	
<?php
$back = "<br /><div id='back'><a href='rest.php'>назад</a></div>";
print ($back);




		print "<h5 id='main_text'>";
		print $myrow['text'];
		print "</h5>";
		 
if ($id == 1)	 {	include ("img/foto_cars/hed_4/index.htm");}
elseif ($id == 2) {	include ("img/foto_cars/exhib/index.htm");}
elseif ($id == 3) {	include ("img/foto_cars/hcd10/index1.htm");}
elseif ($id == 4) {	include ("img/foto_cars/motorshow2007/index.htm");}

		
		
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

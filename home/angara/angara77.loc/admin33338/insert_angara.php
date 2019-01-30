<? include_once ("lock.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Прайс-лист Ангара</title>

<link href="../style_porter.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="690" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="main_border">
<!--Подключаем шапку сайта-->
<? include("blocks/header.php");   ?> 
  <tr>
    <td><table width="690" border="0" cellspacing="0" cellpadding="0">
      <tr>
<!--Подключаем левый блок сайта-->
<? include_once ("blocks/lefttd.php");  ?>      
        <td valign="top">
       <p class="welcom_to_admin"><?php  

include_once ("blocks/bd.php");

$clear = mysql_query("TRUNCATE TABLE `angara`");

//$testfile="/var/www/porter/admin/prices/angara.csv";
$testfile = "/home/u66745/angara77.com/www/admin/prices/angara.csv";

$acces_log = fopen ($testfile,"r");
while (!feof($acces_log)) {$line = fgets($acces_log);
$new_cat = str_replace ("\"","",$line);
$new_cat = str_replace ("-","",$new_cat);
$array = explode(";",$new_cat);

print_r ($array);



$sql = "INSERT INTO `angara` (`id`, `name`, `cat`, `price`) VALUES ('', '$array[1]','$array[2]','$array[3]')";
$result2 = mysql_query ($sql);

}
fclose($acces_log);
include ("blocks/return.php");


?></p> 
        </td>
      </tr>
    </table></td>
  </tr>
<!--Подключаем нижний графический элемент-->  
<?  include ("blocks/footer.php");        ?>  
</table>
</body>
</html>

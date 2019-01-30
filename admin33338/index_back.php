<?php require_once ("lock.php");
require_once ("../blocks/bd.php");
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
$text = "C Добрым Утром любимая Олеся! Улыбнитесь новому дню!";
		print "<h1 id='olesya'>";
		print $text;
		print "</h1>";
?>		 
		<img class="family" src="img/family.jpg" width="550" height="413" />	
</td><td><?php require_once("blocks/righttd.php"); ?></td>                 
      </tr>   
    </table>     
  </tr></td>         
</table>

</body>
</html>

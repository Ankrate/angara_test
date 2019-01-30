<?php require_once ("lock.php"); 
require_once("../blocks/bd.php");

?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <?php include ('blocks/header.php');?>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <?php include ("blocks/lefttd.php"); ?></td>
        <td valign="top" >
<?php
$back = "<br /><div id='back'><a href='javascript:history.back(1)'>назад</a></div>";
print ($back); 
		if (isset($_GET[id])) {$id = $_GET[id];}
		$id = stripslashes($id);
		$id = htmlspecialchars($id);
		if (empty($id)) {exit("Sorry you shold come here with parameters");}
		
		if (isset($_GET[model_title])) {$model_title = $_GET[model_title];}
		

		
		
	$last = mysql_query ("SELECT * FROM gafic_idx_middle WHERE id='$id'",$db);
	$myrowlast = mysql_fetch_array($last);
		$map = "Map1";
		$naz = $myrowlast["title"];
		
		$model_title = $GLOBALS['mod_show'];
		print $model_title;
		
		echo ("<h3 class='model'>Вы находитесь в категории $_COOKIE[mod_tit]</h3>");
				
		print "<p class='naz'>$naz</p>";
		printf ("<div class='last_img' align='center'><img src='../%s' usemap='#%s' alt='%s'/></div>",$myrowlast["big_img_link"],$myrowlast["map_name"],$myrowlast["title"]);
		
	print ($myrowlast["big_img_map"]);
		
		
		
		?></td><td><?php include ("blocks/righttd.php"); ?></td>                 
      </tr>   
    </table>     
  </tr></td>         

  
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

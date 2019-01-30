<?php
function print_image($cat_number)
{
	
global $name;	
	
$dir= "../img/foto_parts/";
//echo $dir;
$id=substr($cat_number, 0, 7);
$pattern = strtolower($dir.$id.'*'.'jpg');
//foreach 
$filename =  glob($pattern);
	
	$link_big=str_replace ('tmb','foto_parts',$filename);
	
	//echo $filename;
	//echo"</br>";
	//echo $link_big;
        
   		
   		echo "<a href='shw_big.php?filename=$link_big&imgname=$name'><img src='$filename[0]' title='$name' alt='$name' /></a>";
   		
    } 

?>



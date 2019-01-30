<?php
function print_image($cat_number)
{
	
global $name;
$name = $cat_number[1];	
	
$dir= "img/tmb/";
//echo $dir;
$id=substr($cat_number[0], 0, 7);
$pattern = strtolower($dir.$id.'*'.'jpg');
foreach (glob($pattern) as $filename) {
	
	$link_big=str_replace ('tmb','foto_parts',$filename);
	
	
	$link = pathinfo($filename);
	$link_big = $link['filename']; 
	//echo $filename;
	//echo"</br>";
	
	$big_image = str_replace ('tmb','foto_parts',$filename);
	//var_dump($big_image);
        
   		
   		echo "<a href='/$big_image' class='fancybox' rel='group'><img src='/$filename' title='$name' alt='$name' /></a>";
   		
    }

} 

?>



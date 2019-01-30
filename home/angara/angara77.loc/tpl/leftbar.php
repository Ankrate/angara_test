
<?php

$dataset = left_side_car();
//$dataset1 = left_bar_sub();
 //p_a($dataset);
$url = explode('/',$_SERVER['REQUEST_URI']);
//p_a($url);
if(!isset ($url[2]))
{
    $url[2] = '';
}
?>


<ul class="nav nav-pills nav-stacked ang-nav-pills" >
	<?php foreach($dataset as $left) { ?>
	<li  role="presentation" class="<?php echo ($left['id'] == $url[2]) && ($url[1] == 'product') ? 'ang-active' : '';?> btn-primary">
		<a class="menu" href="<?=ANG_HTTP?>/product/<?=$left['id'] ?>/ "><span class="glyphicon glyphicon-play ang-play" aria-hidden="true"></span> <?=$left['ang_category']?></a>
	</li>
	
	<?php } ?>
</ul>

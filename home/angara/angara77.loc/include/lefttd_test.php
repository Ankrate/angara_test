
 
      <?php

$data1 = left_side_cat();
//$dataset1 = left_bar_sub();
 //p_a($dataset);
$uri = explode('-',  $_SERVER['REQUEST_URI']);
//p_a($url);
if(!isset ($url[2]))
{
    $url[2] = '';
}
?>





<div class="col-md-3">
                <div class="panel panel-default" id="sidebar">
                <div class="panel-heading kruglec" style="background-color:#888;color:#fff;">Категории</div> 
                
          
              <div  id="responsive-menu">
<ul  class="nav nav-pills nav-stacked ang-nav-pills kruglec" >
   <?php foreach ($data as $left) { ?>
    <li  role="presentation" class="<?php echo ($left['id'] == $url[2]) && ($url[1] == 'product') ? 'ang-active' : '';?> btn-primary">
        <a class="menu" href="/zapchasti-<?=$left['engname']?>/<?=$left['id']?>/"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <?=$left['title']?></a>
    </li>
    
    <?php } ?>
</ul>
</div>
               
                  
                     
                           
              
             </div>
              </div>
              <!--/panel-->
              
            
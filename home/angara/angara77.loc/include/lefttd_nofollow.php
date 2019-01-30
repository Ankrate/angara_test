<?php

$data1 = left_side_cat();
//p($data);
$uri = explode('-',  $_SERVER['REQUEST_URI']);
//p($uri);

?>
<div class="col-md-3">
                <div class="panel panel-default" id="sidebar">
                <div class="panel-heading" style="background-color:#888;color:#fff;">Категории</div> 
                <div class="panel-body panel-body-ang">
                <ul class="nav nav-stacked nav-pills">
               
                <div class="accordion" id="accordion2">
                    <?php foreach ($data as $left) { ?>
                    <div class="accordion-group">
                        <div class="accordion-heading btn-primary">
                            <a class="accordion-toggle" href="/zapchasti-<?=$left['engname']?>/<?=$left['id']?>/" rel="nofollow">
                                
                             &nbsp;<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>&nbsp;&nbsp;<?=$left['title']?>
                            </a>
                        </div>
                        
                        <div id="collapse<?=$left['id']?>" class="accordion-body collapse <?php if(isset($uri[1])  AND $uri[1] == $left['id']) {echo 'in';}
                            
                                    elseif (isset($urc[1])  AND $urc[1] == $left['id']) {
                                    	echo 'in';
                                    } 
                            ?>">
                        </div>
                    </div>
                    <?php }?>
                </div><!--/acc-->
                </div><!--/panel body-->
              </div><!--/panel-->
            </div>







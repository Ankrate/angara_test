<?php

$data1 = left_side_cat();
//p($data);
$uri = explode('-',  $_SERVER['REQUEST_URI']);
//p($data);
//p($_SESSION);
?>

<div class="col-md-3">
                <div class="panel panel-default">
                <div class="left-category">Категории</div>
<!--/panel body-->
<div class="panel-body panel-body-ang">
                <ul class="nav nav-stacked nav-pills">

                <div class="accordion" id="accordion2">
                    <?php foreach ($data as $left) { ?>
                    <div class="accordion-group">

                            <a class="accordion-toggle" href="/zapchasti-<?=$left['engname']?>/<?=$left['id']?>/">
                             <div class="accordion-heading btn-primary <?php if($_SESSION['carname'] == $left['id']){echo 'left_car_color';}?>">
                             &nbsp;<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbsp;&nbsp;<?=$left['title']?>
                        </div>
                        </a>

                        <div id="collapse<?=$left['id']?>" class="accordion-body collapse <?php if(isset($uri[1])  AND $uri[1] == $left['id']) {echo 'in';}

                                    elseif (isset($urc[1])  AND $urc[1] == $left['id']) {
                                    	echo 'in';
                                    }
                            ?>">
                        </div>
                    </div>
                    <?php }?>
                </div><!--/acc-->
                </ul>
                </div>
                
              </div>
              <!--/panel-->

            </div>

<?php
if (isset($_GET['car'])) {$car = htmlspecialchars($_GET['car']);}
include $_SERVER['DOCUMENT_ROOT'] . '/catalogue/lib/func.php';
    if (isset($_GET['id'])) {$id = htmlspecialchars($_GET['id']);}
    require_once  $_SERVER['DOCUMENT_ROOT'] . '/include/header1.php';
    $app = new App();
    $class = $app->choice_cat();
    $object = new $class();
    $car = $object->get_car_name($car);
    $object->prefix = $car[0]['prefix'];
    $data_catalogue = $object->third_query($id);
    $title = $object->get_first_title($id);
  
    
//p($title);

?>
    <title>Каталог категория <?=$title[0][0]?> на Хендай <?=$car[0]['title']?>  97% запчастей на складе готовы к отправке!</title>
    <meta name="description" content="Каталог категория <?=$title[0][0]?> на Хундай <?=$car[0]['title']?>. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?> ">
    <meta name="keywords" content="запчасти для Хундай Портер1, запчасти для Портер2, запчасти для HD78, запчасти для HD72 запчасти для Starex">
    
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header2.php';?>
            <!-- Header -->
            <?php //include 'include/header3.php';?>
            <!-- /Header -->
            <!-- Begin Body -->
<div class="container">
    <div class="no-gutter row">
            <!-- left side column -->
            <div class="hidden-xs hidden-sm">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/lefttd.php';?>
            </div>
            <!--/end left column-->
            <!-- right content column-->
            <div class="col-md-9" id="content">
                <div class="panel">
                <div class="panel-heading" style="background-color:#111;color:#fff;"><?=$title[0][0]?> на Хундай <?=$car[0]['title']?></div>   
                <div class="panel-body">
                  <div class="row">
                  <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                 <a href="<?=ANG_HTTP?>/" itemprop="url"><span itemprop="title">Главная</span></a>
                            </li>
                            <li   itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a href="/porter1/<?=$car[0]['id']?>/"  itemprop="url" ><span itemprop="title">Каталог <?=$car[0]['title']?></span></a>
                             </li>                 
                            <li  class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a  itemprop="url" ></a><span itemprop="title"><?=$title[0][0]?> <?=$car[0]['title']?></span>
                             </li>
                             
                        </ul>
                    <h1><strong><?=$title[0][0]?></strong> на Хендай <?=$car[0]['title']?></h1>
                    
                  </div>
                </div>
                <hr>
                <div class="row">
                    <?php foreach ($data_catalogue as $sub) { ?>
                        
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="well">
                    <a href="/schema/<?=$sub['0']?>/<?=$car[0]['id']?>/"><img src="/catalogue/<?=$object->prefix?><?=$sub[4]?>" class="img-responsive" alt="<?=$sub[2]?> на <?=$car[0]['title']?>" title="<?=$sub[2]?> на <?=$car[0]['title']?>"></a>
                    </div>
                    <div class="cat-h5">
                    <h5><?=$sub[2]?></h5>
                    </div>
                    </div>
                    <?php } ?>
                </div>
                  </div><!--/panel-body-->
                </div><!--/panel-->
                <!--/end right column-->
        </div> 
    </div>
</div><!-- Ends body -->
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footerjq.php';?>
 
   
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer3.php';?>

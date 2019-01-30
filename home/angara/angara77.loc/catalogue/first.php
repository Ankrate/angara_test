<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

if (isset($_GET['car'])) {$car = htmlspecialchars($_GET['car']);}
include $_SERVER['DOCUMENT_ROOT'] . '/catalogue/lib/func.php';
    if (isset($_GET['id'])) {$id = htmlspecialchars($_GET['id']);}
    require_once  $_SERVER['DOCUMENT_ROOT'] . '/include/header1.php';
    $app = new App();
    $class = $app->choice_cat();
    $object = new $class();
    //p($class);
    $car = $object->get_car_name($car);
    $object->prefix = $car[0]['prefix'];

    $data_catalogue = $object->forth_query($id);
    $title2 = $object->get_second_title($id);
    $title = $object->get_first_title($title2[0][1]);
    //p($data_catalogue);
//p($data_catalogue);
?>
    <title>Каталог <?=@$title2[0][0]?> на Хендай <?=@$car[0]['title']?>.  97% запчастей на складе готовы к отправке! <?=@$title2[0][1]?></title>
    <meta name="description" content="Каталог <?=@$title2[0][0]?> на Хендай <?=@$car[0]['title']?>. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?> ">
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
                <div class="panel-heading" style="background-color:#111;color:#fff;">Каталог на <?=$car[0]['title']?></div>
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
                            <li  itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a href="/catalog/<?=$title2[0][1]?>/<?=$car[0]['id']?>/" itemprop="url" ><span itemprop="title"><?=$title[0][0]?> <?=$car[0]['title']?></span></a>
                             </li>
                             <li  class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a  itemprop="url" ></a><span itemprop="title"><?=$title2[0][0]?> <?=$car[0]['title']?></span>
                             </li>
                        </ul>
                    <h1><strong><?=$title2[0][0]?></strong> на <?=$car[0]['title']?></h1>

                  </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="well">
                    <p  class="thumbnail ang-name" data-toggle="tooltip" data-placement="top" data-original-title="Кликни по синему номеру на картинке">
                    <img id="A" usemap="#map" src="/catalogue/<?=$object->prefix?><?=$data_catalogue[0]['img']?>" class="img-responsive" alt="<?=$title2[0][0]?> на Хендай <?=$car[0]['title']?>" title="<?=$title2[0][0]?> на Хендай <?=$car[0]['title']?>"></p>


                    <?php  //print_r($data);?>
                            <map name="map"  id="map">
                              <?php
                                //p($_GET);
                              if($_GET['car'] >= 1 AND $_GET['car'] <= 5 ): ?>
                                <?php
                                    $i = 0;
                                 foreach($data_catalogue as $line):?>
                                    <?php
                                        $i++;
                                      //if($line['1c_id'] == null){
                                      //continue;
                                      //}
                                      $selected_shape="rect";
                                      $coord=$line['coords'];
                                    ?>
                                    <area id="<?=$i?>" class="blue"  shape="<?=$selected_shape?>" coords="<?=$coord?>"
                                    <?php if($line['1c_id'] != null):
                                        //p($line['1c_id']."<br>");?>
                                    href ="http://<?=$_SERVER['HTTP_HOST']?>/porter-<?=$line['cat']?>-<?=$line['1c_id']?>/";
                                    <?php endif ?>
                                     alt="<?=trim($line['title']) ?>" >

                            <?php endforeach ?>
                          <?php else:?>
                            <?php foreach($data_catalogue as $line):?>


                                <?php

                                  $selected_shape="rect";
                                  $coord=$line['coords'];
                                ?>



                        <?php endforeach ?>
                        <?php endif ?>


                            </map>

                        </div>

                    </div>
                    <div id="name_data" class=" floating"><!--Here is output from ajax-->
                      <table class="table table_cat_data" >
                      <?php foreach ($data_catalogue as $key1 => $spisok_tovara):?>
                            <tr><td class""><?=$spisok_tovara['numer']?></td><td><?=$spisok_tovara['title']?></td></tr>
                      <?php endforeach ?>
                    </table>
                    </div>
                    </div>

                </div>
                  </div><!--/panel-body-->
                </div><!--/panel-->
                <!--/end right column-->
        </div>

    </div>
</div><!-- Ends body -->
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footerjq.php';?>
 <script type="text/javascript" src="/catalogue/js/jquery.imagemapster.min.js"></script>
<script type="text/javascript" src="/catalogue/js/script.js"></script>


 <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer3.php';?>

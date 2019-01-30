<?php
ob_start();
include 'include/header1.php';
error_reporting(E_ALL); 
ini_set("display_errors", 1);
if (isset($_GET['car'])) {$car = htmlspecialchars($_GET['car']);}
if (isset($_GET['s2'])) {$s2 = htmlspecialchars($_GET['s2']);}
if (isset($_GET['s3'])) {$s3 = htmlspecialchars($_GET['s3']);}
//$subcat = left_side_subcat($s2);
$car = get_car_name(1);
//p($car);
//$bread = get_sub_name($s2);
$data1 = left_side_cat(1); //'SELECT * FROM ang_categories ORDER BY ang_sort';

$label = array('label-default','label-primary','label-success','label-info');



?>
    <title>Купить запчасти для Хундай Портер 1 автозапчасти Hyundai Porter 1 в Москве дешево</title>
    <meta name="description" content="Запчасти для Хундай Портер1 интернет магазин в Москве. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?> ">
    <meta name="keywords" content="запчасти для Хундай Портер1, запчасти для Портер2, запчасти для HD78, запчасти для HD72 запчасти для Starex">
    <meta name="robots" content="noindex, nofollow">
<?php include 'include/header2.php';?>
            <!-- Header -->
            <?php //include 'include/header3.php';?>
            <!-- /Header -->
            <!-- Begin Body -->
<div class="container">
    <div class="no-gutter row">
            <!-- left side column -->
            <div class="hidden-xs hidden-sm">
                <?php include 'include/lefttd.php';?>
            </div>
            
            <!--/end left column-->
            <!--mid column-->
            <!-- right content column-->
            <div class="col-md-10" id="content">
                <div class="panel">
                <div class="panel-heading" style="background-color:#111;color:#fff;">Запчасти на <?=$car[0]['title']?></div>   
                <div class="panel-body">
                  <div class="row">
                  <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                 <a href="<?=ANG_HTTP?>/" itemprop="url"><span itemprop="title">Главная</span></a>
                            </li>                   
                            <li  class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a  itemprop="url" ></a><span itemprop="title">Запчасти Портер 1</span>
                             </li>
                        </ul>
                    <h1>Запчасти на Хендай Портер 1</h1>
                    <div class="car-name-mar">
                        <div class="media">
                                              <div class="media-left media-middle">
                                                <a href="porter11/1/">
                                                  <img class="media-object image-responsive"  alt="Каталог для Хендай Портер" title="Каталог для Хендай Портер" src="/img/new/articles/1-tmp.jpg" >
                                                </a>
                                              </div>
                                              <div class="media-body">
                                                  <a href="porter1/1/">
                                                <h4 class="media-heading media-heading1">Каталог для Портер 1</h4></a>
                                                 </div>
                                            </div>
                                    <?php foreach ($data1 as $cat) { ?>
                                        <hr>
                                        <div class="media">
                                              <div class="media-left media-middle">
                                                <a href="/category-1-<?=$cat['id']?>-<?=rus2translit($cat['ang_category'])?>-<?=rus2translit($car[0]['title'])?>/">
                                                  <img class="media-object image-responsive"  alt="<?=$cat['ang_category']?>" title="<?=$cat['ang_category']?>" src="/img/new/articles/1-tmp.jpg" data-holder-rendered="true" >
                                                </a>
                                              </div>
                                              <div class="media-body media-body1">
                                                  <a href="/category-1-<?=$cat['id']?>-<?=rus2translit($cat['ang_category'])?>-<?=rus2translit($car[0]['title'])?>/">
                                                <h4 class="media-heading media-heading1 "><?=$cat['ang_category']?></h4></a>
                                                <?php
                                        
                                        $sub22 = left_side_subcat($cat['id']);
                                         foreach($sub22 as $sub33){
                                             if (check_subcat_emptiness($sub33['id'], 'porter') == 0){
                                                 continue;
                                             }
                                                $k = array_rand($label);
                                                $v = $label[$k];
                                                     ?>
                                             <a href="/subcat-1-<?=$sub33['id']?>-<?=$sub33['parent']?>-<?=rus2translit($sub33['ang_subcat'])?>-<?=rus2translit($car[0]['title'])?>/">
                                             <span class="label <?=$v?>"><?=$sub33['ang_subcat']?></span></a>
                                         <?php }?>
                                              </div>
                                            </div>
                                    <?php }?>
                                    </div>
                                </div>
                               </div>
                  </div><!--/panel-body-->
                </div><!--/panel-->
                <!--/end right column-->
        </div> 
    </div>
</div><!-- Ends body -->
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footer.php';?>
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footerjq.php';?>
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footer3.php';?>
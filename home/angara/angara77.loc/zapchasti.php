<?php
ob_start();
session_start();

include 'include/header1.php';
//error_reporting(E_ALL); 
//ini_set("display_errors", 1);
if (isset($_GET['carname'])) {$carname = htmlspecialchars($_GET['carname']);}
if (isset($_GET['car'])) {$car = htmlspecialchars($_GET['car']);}
$_SESSION['carname'] = $car;

//$subcat = left_side_subcat($s2);
$carrus = get_car_name($car);
$meta = get_main_model_text($car);
//p ($text);
//$bread = get_sub_name($s2);
$data1 = left_side_cat($car); //'SELECT * FROM ang_categories ORDER BY ang_sort';

$label = array('label-default','label-primary','label-success','label-info');



?>


                <?php if(isset($meta[0]['title'])) {?>
                    <title><?=$meta[0]['title']?></title>
                    <?php } else { ?>        
                    <title>Купить запчасти для <?=$carrus[0]['fullname']?> в Москве дешево</title>
                    <?php } ?>
    
                <?php if(isset($meta[0]['desc'])) {?>
                    <meta name="description" content="<?=$meta[0]['desc']?>">
                    <?php } else { ?>        
                    <meta name="description" content="Запчасти для <?=$carrus[0]['fullname']?> интернет магазин в Москве. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?> ">
                    <?php } ?>
                    <?php if(isset($meta[0]['keywords'])) {?>
                    <meta name="keywords" content="<?=$meta[0]['keywords']?>">
                <?php } else { ?>
                    <meta name="keywords" content="Запчасти <?=$carrus[0]['fullname']?>">
                <?php } ?>
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
            <div class="col-md-9" id="content">
                <div class="panel">
                   
                <div class="panel-body">
                  <div class="row">
                  <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                 <a href="<?=ANG_HTTP?>/" itemprop="url"><span itemprop="title">Главная</span></a>
                            </li>                   
                            <li  class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a  itemprop="url" ></a><span itemprop="title">Запчасти <?=$carrus[0]['fullname']?></span>
                             </li>
                        </ul>
                        <?php if(isset($meta[0]['h1'])) {?>
                            <h1><?=$meta[0]['h1']?></h1>
                            <?php } else { ?>        
                            <h1>Запчасти на <?=$carrus[0]['title']?></h1>
                          <?php } ?>
                    <div class="car-name-mar">
                        <div class="row">
                                    <?php foreach ($data1 as $cat) { ?>
                                                 <div class="col-sm-6 col-md-4">
                                                    <div class="thumbnail car-height">
                                                        <a href="/category-<?=$car?>-<?=$cat['id']?>-<?=rus2translit($cat['ang_category'])?>-<?=$carrus[0]['engname']?>/">
                                                            
                                                            <?php if(file_exists(ANG_ROOT . '/img/categories/' . $carrus[0]['engname'] . $cat['id'] . '.jpg')):?>
                                                                <img alt="<?=$cat['ang_category']?> на <?=$carrus[0]['fullname']?>" title="<?=$cat['ang_category']?> на <?=$carrus[0]['fullname']?>" src="/img/categories/<?=$carrus[0]['engname']?><?=$cat['id']?>.jpg">
                                                            <?php else: ?>
                                                             <img alt="<?=$cat['ang_category']?> на <?=$carrus[0]['fullname']?>" title="<?=$cat['ang_category']?> на <?=$carrus[0]['fullname']?>" src="/img/categories/<?=$cat['id']?>.jpg">
                                                             <?php endif;?>   
                                                      </a>
                                                      <div class="caption">
                                                        <h3><?=$cat['ang_category']?></h3>
                                                         <?php
                                                        $sub22 = left_side_subcat($cat['id']);
                                                        
                                         foreach($sub22 as $sub33){
                                             //echo $carrus[0]['engname'];
                                             if (check_subcat_emptiness($sub33['id'],$carrus[0]['engname']) == 0){
                                                 continue;
                                             }
                                                $k = array_rand($label);
                                                $v = $label[$k];
                                                     ?>
                                             <a href="/subcat-<?=$car?>-<?=$sub33['id']?>-<?=$sub33['parent']?>-<?=rus2translit($sub33['ang_subcat'])?>-<?=$carrus[0]['engname']?>/">
                                             <span class="label <?=$v?>"><?=$sub33['ang_subcat']?></span></a>
                                         <?php }?>
                                                      </div>
                                               </div>
                                           </div>
                                    <?php }?>
                                     </div>
                                    </div>
                        <div class="row hidden-xs hidden-sm">
                            <div class="col-md-12 car-name-mar">
                            <?=@$meta[0]['text']?>
                            </div>
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
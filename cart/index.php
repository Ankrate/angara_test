<?php
session_start();
//error_reporting(E_ALL); 
//ini_set("display_errors", 1);
include ($_SERVER['DOCUMENT_ROOT'].'/include/header1.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/lib/core.php') ;
if (isset($_GET['cat_number'])) {$cat_number = htmlspecialchars($_GET['cat_number']);}
if (isset($_GET['id'])) {$id = htmlspecialchars($_GET['id']);}
if (isset($_SESSION['carname'])) {$carname = $_SESSION['carname'];}else{
    $carname = 1;
}
$cat_number = '8611043001';
$goods = get_goods(2156);
 
   
$subcats = get_subcat_name($goods[0]['parent']);
$cats = get_sub_name($subcats[0]['parent']);
$cars = get_car_name($carname);
$data5 = get_cheap_goods($cat_number, $goods[0]['price']);
//p($goods);
//p($subcats);
//p($cars);
//p($_SESSION['carname']);
$urc[1] = $carname;
$similar = get_similar_goods($cars[0]['engname'],$goods[0]['ang_name']);
//p($similar);

$url = $_SERVER['REQUEST_URI'];

$u = ('/porter-' . good_cat($goods[0]['cat']) . '-' . $goods[0]['1c_id']  . '/');
//echo $u;
//echo '<br>';
//echo $url;
if($url != $u){
    // die("<script>location.href = '/404.php'</script>");
} 
?>
    <title>Купить <?=good_name($goods[0]['ang_name'])?> для <?=$cars[0]['fullname']?> ✰  интернет магазин в Москве ✈ <?=$goods[0]['cat']?> ✈ <?=$goods[0]['1c_id']?> </title>
    <meta name="description" content="<?=good_name($goods[0]['ang_name'])?> для <?=$cars[0]['fullname']?> ✈ <?=$goods[0]['cat']?> ✰ <?=$goods[0]['1c_id']?>. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?> ">
    <meta name="keywords" content="<?=($goods[0]['ang_name'])?>, на <?=$cars[0]['fullname']?>">
<?php include ($_SERVER['DOCUMENT_ROOT'].'/include/header2.php');?>
            <!-- Header -->
            <?php //include 'include/header3.php';?>
            <!-- /Header -->
            <!-- Begin Body -->
            
<div class="container">
    <div class="no-gutter row">
        
            <!-- left side column -->
            <?php include ($_SERVER['DOCUMENT_ROOT'].'/include/lefttd.php');?>
            <!--/end left column-->
               
            <!--mid column-->
            
            <!-- right content column-->
            <div class="col-md-10" id="content">
                
                <div class="panel">
                <div class="panel-heading" style="background-color:#111;color:#fff;">Запчасти на <?=@$cars[0]['title']?></div>   
                <div class="panel-body">
                  <div class="row">
                  <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                 <a href="<?=ANG_HTTP?>/" itemprop="url"><span itemprop="title">Главная</span></a>
                            </li>
                            <li  itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a href="<?=ANG_HTTP?>/zapchasti-<?=$cars[0]['engname']?>/<?=$cars[0]['id']?>/" itemprop="url" ><span itemprop="title">Запчасти <?=$cars[0]['fullname']?></span></a>
                             </li>
                            <li   itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a href="/category-<?=@$cars[0]['id']?>-<?=@$cats[0]['id']?>-<?=rus2translit(@$cats[0]['ang_category'].' '.@$cars[0]['engname'])?>/" itemprop="url" ><span itemprop="title"><?=$cats[0]['ang_category']?> <?=$cars[0]['fullname']?></span></a>
                             </li>                  
                            <li  itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a href="/subcat-<?=@$cars[0]['id']?>-<?=@$subcats[0]['id']?>-<?=@$cats[0]['id']?>-<?=rus2translit(@$subcats[0]['ang_subcat'].' '.@$cars[0]['engname'])?>/" itemprop="url" ><span itemprop="title"><?=@$subcats[0]['ang_subcat']?> <?=@$cars[0]['fullname']?></span></a>
                             </li>
                             <li  class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a  itemprop="url" ></a><span itemprop="title"><?=cut_bread_name(@$goods[0]['ang_name'])?></span>
                             </li>
                        </ul>
                </div>
                <div itemscope itemtype="http://schema.org/Product">
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-12 ">
                            <a class="label label-primary l-p" href="javascript:history.back(1)"> &lt;&lt; назад</a>
                                <div itemprop="name"><h1 id="ang-prod-h1" class="text-center  b1c-name"><?=good_name(@$goods[0]['ang_name'])?> на <?=$cars[0]['fullname']?> ✰ <?=@$goods[0]['cat']?></h1></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 ">
                            <div class="well im-well">
                            <img itemprop="image"  id="ang-prod-img" class="img-responsive img-thumbnail" src="/img/timthumb.php?src=/img/parts/<?=get_image($goods[0]['1c_id']) ?>&w=410" alt="<?=@$goods[0]['ang_name'] ?>" title="<?=@$goods[0]['ang_name'] ?>">
                            </div>
                        </div>
                        
                        <div class="col-sm-6 prod-price-padd">
                            <div class="alert alert-success ang-alert" role="alert"><strong>Гарантия:</strong> Если запчасть не понадобилась или не подошла, мы вернем деньги!</div>
                            <div class="row row-color">
                            <div class="col-xs-4" itemprop="brand" itemscope itemtype="http://schema.org/Organization">
                                 <small><span itemprop="name">Ангара запчасти </span></small>
                            </div>
                            <div class="col-xs-8" itemprop="manufacturer" itemscope itemtype="http://schema.org/Organization">
                                <small><span class="proizvoditel">Производитель: <span itemprop="name">Ю. Корея</span></span></small>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <h2 class="main-h2" >Каталожный номер: <?=@$goods[0]['cat']?></h2>
                                </div>
                            </div>
                            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">    
                               <span itemprop="price" class="text-justify ang-prod-price b1c-price"><?=@$goods[0]['price'] ?> руб</span>
                               <link itemprop="itemCondition" href="http://schema.org/NewCondition" />
                               <small class="small-new" >Новый</small>
                               </div>
                               <button type="button" class="btn btn-success ang-byu-oneclick b1c">Заказать консультацию</button>
                               <a href="<?=ANG_HTTP ?>/contacts/" class="btn btn-success ang-byu-oneclick ">Посмотреть контакты</a>
                               <li><a class="add-to-cart" href="#" data-name="<?=@$goods[0]['ang_name'] ?>" data-price="<?=@$goods[0]['price'] ?>" data-id="<?=@$goods[0]['1c_id'] ?>">В корзину</a></li>
                               <?php if($data5) {?>
                           <div class="cheap-good">
                               <h5 class="red-mon"><i class="fa fa-money"></i> &nbsp &nbsp Внимание! Есть бюджетные аналоги</h5>
                               <hr>
                               <?php foreach($data5 as $ch) {?>
                                <?php  preg_match('/^([\w\d\]+[\s]+)/ui', $ch['ang_name'], $match); ?>
                            <a href="<?=ANG_HTTP ?>/porter-<?=$ch['cat'] ?>-<?=$ch['1c_id']?>/"><p><?=cut_bread_name($ch['ang_name'])?>&nbsp<?=$cars[0]['title']?>&nbsp <b class="pull-right red-mon"><?=$ch['price'] ?> руб</b></p></a>
                            <hr>
                            <?php } ?>
                           </div>
                        <?php } ?>
                        </div>
                    </div>
                  <div class="row">
                     <div class="col-sm-12">
                          
                        <div class="ang-dostavka">
                           
                            <div class="well">
                                <h3>Информация о доставке:</h3>
                                <ul>
                                    <li>Если запчасть нужна срочно, приезжайте с 8 утра до 19 вечера по будням. С 10 утра до 17 вечера по выходным. Все, кто приезжает сам, получают подарки.</li>
                                    <li>Доставка по Москве, при покупке на сумму от 5000 рублей - бесплатно.</li>
                                    <li>Если сумма заказа меньше 5000 рублей, доставка 500 рублей.</li>
                                    <li>Клиентам из регионов, доставка примерно 500 рублей.<a href="/delivery/"> Подробнее здесь...</a></li>
                                    
                                </ul>
                                
                            </div>
                        </div>
                    <div class="caption-full">
                        <h4>Описание товара</h4><p>
                        <?php if($goods[0]['description']) : ?>
                        <span itemprop="description"><?=$goods[0]['description'] ?></span>
                        <?php endif ?>
                    </div>
                    <div class="ratings">
                        <p class="pull-right">Есть отзывы</p>
                        <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span itemprop="ratingValue">4.0 stars</span>
                            <span itemprop="reviewCount">3</span> отзыва
                        </div>
                        </div>
                    </div>
                    </div>
                            <div class="row caption-full">
                                <div class="col-md-12 text-center">
                                <h4>Похожие товары</h4>
                                </div>
                                <?php foreach($similar as $sim):?>
                                    <?php if($sim['1c_id'] == $goods[0]['1c_id'])
                                    continue;
                                    ?>
                              <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                  <a href="/porter-<?=str_replace('-','',good_cat($sim['cat']))?>-<?=$sim['1c_id']?>/">
                                  <img class="img-rounded" src="/img/timthumb.php?src=/img/parts/<?=get_image($sim['1c_id']) ?>&w=200" alt="<?=good_name($sim['ang_name'])?>">
                                  <div class="caption">
                                    <h5><?=($sim['ang_name'])?></h5>
                                    <h5><?=$sim['price']?> рублей</h5>
                                  </div>
                                  </a>
                                </div>
                              </div>
                              <?php endforeach?>
                    </div>
                   <!--  Start tests -->
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div>
                                <ul class="list-unstyled">
                                    <li><a class="add-to-cart" href="#" data-name="Apple" data-price="22">Apple $22</a></li>
                                    <li><a class="add-to-cart" href="#" data-name="Turbo" data-price="32">Turbo $32</a></li>
                                    <li><a class="add-to-cart" href="#" data-name="Boolshit" data-price="22">Boolshit $2</a></li>
                                    <li><a class="add-to-cart" href="#" data-name="Banana" data-price="1.2">Apple $1.2</a></li>
                                </ul>
                                <button id="clear-cart">Clear Cart</button>
                            </div>
                            <div >
                                <ul class="show-cart unstyled">
                                    <!-- empty -->
                                </ul>
                                <div>You have: <span class="count-cart"></span> item in your cart.</div>
                                <div >Total cart:$ <span class="total-cart"></span></div>
                            </div>
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
<?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footer_small.php';?>
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footerjq.php';?>
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footer3.php';?>
 
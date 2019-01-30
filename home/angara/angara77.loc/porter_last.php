<?php
session_start();

//error_reporting(E_ALL);
//ini_set("display_errors", 1);
include 'include/header1.php';
require_once ($_SERVER['DOCUMENT_ROOT'].'/lib/core.php') ;

if (isset($_GET['cat_number'])) {$cat_number = htmlspecialchars($_GET['cat_number']);}
if (isset($_GET['id'])) {$id = htmlspecialchars($_GET['id']);}
$goods = get_goods($id);
$_SESSION['last_catalog_article']=$goods[0]['cat'];

//p( $goods);


            if($tmp = get_car_name_angara($goods[0]['car'])){
            $carname = $tmp[0]['id'];
            }else{
                @$carname = $_SESSION['carname'];
            }


$subcats = get_subcat_name($goods[0]['parent']);
//p($subcats);
@$cats = get_sub_name($subcats[0]['parent']);
$cars = get_car_name($carname);
$data5 = get_cheap_goods($cat_number, $goods[0]['price']);

$urc[1] = $carname;
$similar = get_similar_goods($cars[0]['engname'],$goods[0]['ang_name']);

//Here we are cheking is there an item in table angara if no redirect to 404
if(!check_angara('angara',$id, $cat_number)){
    http_response_code(404);
    header('Location: /404.php');
    die("<script>location.href = '/404.php'</script>");
}
$similar_spare = get_spare($goods[0]['ang_name'], 5);
//p($similar_spare);
//get_image($id);
?>
    <title>Купить <?=good_name($goods[0]['ang_name'])?> для <?=$cars[0]['fullname']?> ✰  интернет магазин в Москве ✈ <?=$goods[0]['cat']?> ✈ <?=$goods[0]['1c_id']?> </title>
    <meta name="description" content="<?=good_name($goods[0]['ang_name'])?> для <?=$cars[0]['fullname']?> ✈ <?=$goods[0]['cat']?> ✰ <?=$goods[0]['1c_id']?>. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?>">
    <meta name="keywords" content="<?=($goods[0]['ang_name'])?>, на <?=$cars[0]['fullname']?>">
    <meta property="og:title" content="Купить <?=good_name($goods[0]['ang_name'])?> для <?=$cars[0]['fullname']?>" />
    <meta property="og:description" content="<?=good_name($goods[0]['ang_name'])?> для <?=$cars[0]['fullname']?>. ☎ <?=TELEPHONE1?>" />
    <meta property="og:url" content="http://angara77.com" />
    <meta property="og:image" content="/img/timthumb.php?src=/img/parts/<?=get_image($goods[0]['1c_id']) ?>&w=410" />
    <link rel="shortcut icon" href="http://angara77.com/favicon.ico" type="image/x-icon" />
<?php include 'include/header2.php';?>
            <!-- Header -->
            <?php //include 'include/header3.php';?>
            <!-- /Header -->
            <!-- Begin Body -->

<div class="container">
    <div class="row">
            <!-- left side column -->
            <div class="hidden-xs hidden-sm">
                <?php include 'include/lefttd.php';?>
            </div>
            <!--/end left column-->

            <!--mid column-->

            <!-- right content column-->
            <div class="col-md-9">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <?php if($carname != FALSE):?>
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
                                            <a  itemprop="url" href="<?=ANG_HTTP?>/porter-<?=@$goods[0]['cat']?>-<?=@$goods[0]['1c_id']?>/" ></a><span itemprop="title"><?=cut_bread_name(@$goods[0]['ang_name'])?></span>
                                        </li>
                                    </ul>
                                </div>
                                    <?php endif ?>
                     <div itemscope itemtype="http://schema.org/Product">
                        <div class="row">
                            <div class="col-md-6 col-xs-6 col-sm-6 ">
                                <a class="label label-primary l-p  hidden-xs hidden-sm" href="javascript:history.back(1)"> &lt;&lt; назад</a>
                               </div>
                               <div class="col-md-6 col-xs-6 col-sm-6 text-right">

                                <span>Артикул: <?=@$goods[0]['1c_id']?> </span>
                                </div>


                            <div class="col-xs-12 col-sm-12 ">
                                    <div itemprop="name"><h1 id="ang-prod-h1" class="text-center  b1c-name"><?=@preg_name($goods[0]['ang_name'])?></h1></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 ">
                                <div class="im-well">
                                    <a href="/img/parts/<?=@get_image($goods[0]['1c_id'])?>"  data-fancybox>
                                    <img itemprop="image"  id="ang-prod-img" class="img-responsive img-thumbnail" src="/img/timthumb.php?src=/img/parts/<?=@get_image($goods[0]['1c_id']) ?>&w=410" alt="<?=@$goods[0]['ang_name'] ?>" title="<?=@$goods[0]['ang_name'] ?>">
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-6 prod-price-padd">
                            <noindex>
                                <div class="alert alert-success ang-alert" role="alert"><strong>Гарантия:</strong> Если запчасть не понадобилась или не подошла, мы вернем деньги!</div>
                            </noindex>

                            <div class="row">
                                <div class="col-xs-12">
                                    <h2 class="main-h2 text-center" >Каталожный номер: <a href="/partnumber-<?=@$goods[0]['cat']?>/"> <?=@$goods[0]['cat']?></a></h2>
                                    <?php if($cars[0]['id']==1 OR $cars[0]['id']==2 OR $cars[0]['id']==5){
                                    	 $catalog_page=get_catalog_page($goods[0]['cat'],$cars[0]['id']);?>
                                    	 <?php if(isset($catalog_page[0]['id'])){

                                    	 	?>
                                    	 	<?php if($cars[0]['id']==1){
                                    	 		$car_catalogue=1;
                                    	 	}elseif($cars[0]['id']==2){
                                    	 		$car_catalogue=3;
                                    	 	}elseif($cars[0]['id']==5){
                                    	 		$car_catalogue=2;
                                    	 	}else{}?>
										 <p style="text-align:center;color:#337AB7;font-size:16px;"><i class="fa fa-book"></i> <a style="color:#337AB7" href="/schema/<?=$catalog_page[0]['id']?>/<?=$car_catalogue?>">Посмотреть на схеме</a></p>
										 <?php }else{}?>
                                    	<?php }else{

                                    	}
                                    ?>




                                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                    <?php if($goods[0]['price'] == 0 ){?>
                                    <span itemprop="price" class="text-justify ang-prod-price-zerro b1c-price">Уточняйте цену у менеджера</span>
                                    <?php }else{?>
                                    <span itemprop="price" class="text-justify ang-prod-price b1c-price text-center"><?=@$goods[0]['price'] ?></span><span class="ang-prod-price">руб</span>
                                    <?php }?>
                                    <meta itemprop="priceCurrency" content="RUB" />
                                    <link itemprop="itemCondition" href="http://schema.org/NewCondition" />
                                    <div class="spacer"></div>
                               </div>
                               </div>
                                    <div class="col-md-12 col-xs-12 col-sm-12 text-center">
                               <button type="button" class="btn btn-success ang-byu-oneclick b1c"><span><i class="fa fa-mouse-pointer"></i></span> Купить в 1 клик</button>

                               <button type="button" class="btn btn-info ang-byu-oneclick  add-to-cart" data-name="<?=@$goods[0]['ang_name'] ?>" data-price="<?=@$goods[0]['price'] ?>" data-id="<?=@$goods[0]['1c_id'] ?>"><span><i class="fa fa-shopping-cart"></i></span> &nbspВ корзину</button>
                                    </div>
                               </div>
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
                           <noindex>
                            <div class="well">
                                <h3>Информация о доставке:</h3>
                                <ul>
                                    <li>Если запчасть нужна срочно, приезжайте с <?=WORK_FROM_DAYS?> утра до <?=WORK_TO_DAYS?> вечера по будням. С <?=WORK_FROM_WEEKENDS?> утра до <?=WORK_TO_WEEKENDS?> вечера по выходным. Все, кто приезжает сам, получают подарки.</li>
                                    <li>Доставка по Москве, при покупке на сумму от <?=DOSTAVKA?> рублей - бесплатно.</li>
                                    <li>Если сумма заказа меньше <?=DOSTAVKA?> рублей, доставка <?=DOSTAVKA_COST?> рублей.</li>
                                    <li>Клиентам из регионов, доставка примерно 500 рублей.<a href="/delivery/" rel="nofollow"> Подробнее здесь...</a></li>

                                </ul>
                              </noindex>
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
                                <div class="col-xs-6 col-sm-6 col-md-3">
                                    <div class="thumbnail related-max-height">
                                        <a href="/porter-<?=str_replace('-','',good_cat($sim['cat']))?>-<?=$sim['1c_id']?>/">
                                            <img class="img-rounded" src="/img/timthumb.php?src=/img/parts/<?=@get_image($sim['1c_id']) ?>&w=200" alt="<?=good_name($sim['ang_name'])?>">
                                    <div class="caption subcat-h5">
                                        <h5><?=($sim['ang_name'])?></h5>
                                        <h6>
                                        <?php if($sim['price'] == 0 ){?>
                                    <strong>Уточняйте цену у менеджера</strong>
                                    <?php }else{?>
                                    <strong><?=$sim['price']?></strong> рублей
                                    <?php }?>
                                    </h6>
                                    </div>
                                        </a>
                                    </div>
                                </div>
                                    <?php endforeach?>
                            </div>
                        </div><!-- shema org -->
                    </div>
                </div><!--/panel-body-->
            </div><!--/panel-->
        </div> <!--/end right column-->
    </div>
</div><!--container-->
<?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footer_small.php';?>
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footerjq.php';?>
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footer3.php';?>
 <link rel="stylesheet" type="text/css" href="/fancybox-master/dist/jquery.fancybox.min.css">
 <script src="/fancybox-master/dist/jquery.fancybox.min.js"></script>

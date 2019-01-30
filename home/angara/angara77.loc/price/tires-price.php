<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


?>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/header1.php';
require __DIR__ . '/../lib/functions_filter_shini.php';
?>
    <title>Информация о  Андрее долбонахе компании Ангара. 97% запчастей на складе готовы к отправке!</title>
    <meta name="Доставка запчастей на HD78. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1 ?> ">
    <meta name="keywords" content="Запчасти Хендай">
<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/include/header2.php';
	?>

            <!-- Header -->
            <?php //include 'include/header3.php'; ?>
            <!-- /Header -->
            <!-- Begin Body -->
<div class="container">
    <div class="no-gutter row">
            <!-- left side column -->
            <div class="hidden-xs hidden-sm">
            <?php
				include $_SERVER['DOCUMENT_ROOT'] . '/include/lefttd.php';
			?>
            </div>
            <!--/end left column-->
            <!-- right content column-->
            <div class="col-md-9" id="content">
                <div class="panel">
                <div class="panel-heading" style="background-color:#111;color:#fff;">О компании</div>   
                <div class="panel-body">
                  <div class="row">
                  <div class="col-md-12">
                        <!--Карточка товара-->             
              		
              		
 <!--KARTOCHKA TOVARA-->
		
		
		<?php 
        $data = getKartochkaTiresModel($_GET['id']);
		/*p($data);	*/		
        ?>
		
		
		
  </div>
  
  
  				<div class="row">
                            <div class="col-xs-12 col-sm-12 ">
                                <a class="label label-primary l-p  hidden-xs hidden-sm" href="javascript:history.back(1)"> &lt;&lt; назад</a>
                                    <div itemprop="name"><h1 id="ang-prod-h1" class="text-center  b1c-name"><?=$data[0]['brand'] . ' ' . $data[0]['model']?></h1></div>
                            </div>
				</div>
  
  <!--TITLE-->
  
  <div class="row">
                            <div class="col-sm-6 ">
                                <div>
                                    <img src="<?=$data[0]['images_url']?>">
                                </div>
                            </div>
                            <div class="col-sm-6 prod-price-padd">
                            <noindex>
                                <div class="alert alert-success ang-alert" role="alert"><strong>Акция:</strong>Напиши отзыв и получи скидку 200р на шины!</div>
                            </noindex>
                            <div class="row">
                                <div class="col-xs-12">
                                    <ul>
                                    	<li>Сезон: <strong><?=$data[0]['season']?></strong></li>
                                    	<li>Шипы: <strong><?=$data[0]['thorns']?></strong></li>
                                    	<li>Бренд: <strong><?=$data[0]['brand']?></strong></li>
                                    	<li>Модель: <strong><?=$data[0]['model']?></strong></li>
                                    	<li>Ширина: <strong><?=$data[0]['width']?></strong></li>
                                    	<li>Диаметр: <strong><?=$data[0]['diameter']?></strong></li>
                                    	<li>Профиль: <strong><?=$data[0]['profile']?></strong></li>
                                    	<li>Индекс нагрузки: <strong><?=$data[0]['index_loading']?></strong></li>
                                    	<li>Индекс скорости: <strong><?=$data[0]['index_speed']?></strong></li>
                                    
                                    
                                    
                                    
                                    </ul>
                                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">    
                                    <span itemprop="price" class="text-justify ang-prod-price b1c-price text-center"><?=$data[0]['price']?></span><span class="ang-prod-price">руб</span>
                                    <meta itemprop="priceCurrency" content="RUB" />
                                    <link itemprop="itemCondition" href="http://schema.org/NewCondition" />
                                    
                               </div>
                               </div>
                                    <div class="col-md-12 col-xs-12 col-sm-12 text-center">
                               <button type="button" class="btn btn-success ang-byu-oneclick b1c"><span><i class="fa fa-mouse-pointer"></i></span> Купить в 1 клик</button>
                               <!-- <a href="http://angara77.dnobaka.ru/contacts/" class="btn btn-success ang-byu-oneclick ">Посмотреть контакты</a> -->
                               <button type="button" class="btn btn-info ang-byu-oneclick  add-to-cart" data-name="<?=$data[0]['title']?>" data-price="<?=$data[0]['price']?>" data-id="<?=$data[0]['id']?>"><span><i class="fa fa-shopping-cart"></i></span> &nbspВ корзину</button>
                                    </div>
                               </div>
                                                       </div>
                    </div>
  
  
  <div class="flex">
  <div class="item1">
  </div>
  <div class="item2">
  </div>
  <div class="item3">
  </div>
</div>
 

					  
<!--КОНЕЦ ВЫВОДА ФИЛЬТРА-->
			</div>
                    
                  </div>
                </div>
                  </div><!--/panel-body-->
                </div><!--/panel-->
                <!--/end right column-->
        </div> 
    </div>
</div><!-- Ends body -->
<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php';
?>
 <?php
	include $_SERVER['DOCUMENT_ROOT'] . '/include/footerjq.php';
?>
 <script type="text/javascript" src="/catalogue/js/jquery.imagemapster.min.js"></script>
<script type="text/javascript" src="/catalogue/js/script.js"></script>

 <script type="text/javascript" src="/js/magnify.js"></script>
   
 <?php
	include $_SERVER['DOCUMENT_ROOT'] . '/include/footer3.php';
?>
<link rel='stylesheet' href='/css/andrey.css'>


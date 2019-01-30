<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


?>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/header1.php';
require __DIR__ . '/../lib/functions_filter_shini.php';
?>

			
      <?php $data = getKartochkaTiresParametr($_GET['id']);?> 
    <title>Купить шины <?=$data[0]['brand'] . ' ' . $data[0]['model'] . ' ' . $data[0]['size']?></title>
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
                
                <div class="panel-body">
                  <div class="row">
                  <div class="col-md-12">
                        <!--Карточка товара-->             
              		
              		
 <!--KARTOCHKA TOVARA-->
		<?php $data = getKartochkaTiresParametr($_GET['id']);?> 
		
		<?php if(isset($_GET['action']) AND $_GET['action']=='showall'):?>
  		<?php $data3 = getSameTiresMore($data[0]);?>
  		<?php else:?>
  		<?php $data3 = getSameTires($data[0]);?>
  		<?php endif?>
		<!--<?php p($data[0]);?>-->
		
		
		
		
  </div>
  
  
  				<div class="row">
                            <div class="col-xs-12 col-sm-12 ">
                                <a class="label label-primary l-p  hidden-xs hidden-sm" href="javascript:history.back(1)"> &lt;&lt; назад</a>
                                    <div itemprop="name"><h1 id="ang-prod-h1" class="text-center  b1c-name"><?=$data[0]['brand'] . ' ' . $data[0]['model'] . ' ' . $data[0]['size']?></h1></div>
                            </div>
				</div>
  
  <!--TITLE-->
  
  <div class="row">
                            <div class="col-sm-6 ">
                                <div>
                                    <img src="/img/tires/<?=$data[0]['images']?>">
                                </div>
                                <div class="col-md-10">
			                                <img src="/<?=$data[0]['brand_img']?>" class="tires-brand-icon">
			                               <?php if($data[0]['season']=='Лето'):?>
			                    				<?='<img src="/img/tires_icons/leto4.png" class="tires-season-icon">'?>
				                    			<?php elseif($data[0]['season']=='Зима'):?>
				                    			<?='<img src="/img/tires_icons/zima.png" class="tires-season-icon">'?>
				                    			<?php elseif($data[0]['season']=='Всесезонная'):?>
				                    			<?='<img src="/img/tires_icons/zimaleto4.png" class="tires-season-icon">'?>
				                    			<?php else:?>
				                    			<?='<p class="tires-season-icon"></p>'?>
				                    		<?php endif?>
				                    		<?php if($data[0]['thorns']=='шипованная'):?>
			                    				<?='<img src="/img/tires_icons/thorns.png" class="tires-season-icon">'?>
				                    			<?php else:?>
				                    			<?=''?>
				                    		<?php endif?>
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
                                    	<li>Модель: <strong><a href="/price/tires-price-model.php?id=<?=$data[0]['model_id']?>"><?=$data[0]['model']?></a></strong></li>
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
                               <a href="http://angara77.dnobaka.ru/contacts/" class="btn btn-success ang-byu-oneclick "><span></span>Перейти в контакты</a>
                               <button type="button" class="btn btn-info ang-byu-oneclick  add-to-cart" data-name="<?=$data[0]['title']?>" data-price="<?=$data[0]['price']?>" data-id="<?=$data[0]['id']?>"><span><i class="fa fa-shopping-cart"></i></span> &nbspВ корзину</button>
                                    </div>
                               </div>
                                                       </div>
                    </div>
  <div class="row">
  	<div class="col-md-12"> 
  		
				
  	<h3> Шины похожие на <?=$data[0]['brand'] . ' ' . $data[0]['model'] . ' ' . $data[0]['size']?>:</h3>
  	</div>
  	
  	
						<div class="row">
  	<?php foreach($data3 as $k=>$v):?>
  	<div class="col-md-4"> 
                    	<div class="row tires-face-tovar">
	                    	
                    		<div class="tires-flex">
                    			
                    			
                    				<a href="/price/tires-price-parametr.php?id=<?=$v['id']?>">
                    				<img src="/img/tires/<?=$v['images']?>" class="img-responsive tires-image-price-parametr">
                    				</a>
								
								
							</div>
							<img src="/<?=$v['brand_img']?>" class="tires-brand-icon">
                    			<?php if($v['season']=='Лето'):?>
                    				<?='<img src="/img/tires_icons/leto4.png" class="tires-season-icon">'?>
	                    			<?php elseif($v['season']=='Зима'):?>
	                    			<?='<img src="/img/tires_icons/zima.png" class="tires-season-icon">'?>
	                    			<?php elseif($v['season']=='Всесезонная'):?>
	                    			<?='<img src="/img/tires_icons/zimaleto4.png" class="tires-season-icon">'?>
	                    			<?php else:?>
	                    			<?='<p class="tires-season-icon"></p>'?>
	                    		<?php endif?>
	                    		<?php if($v['thorns']=='шипованная'):?>
                    				<?='<img src="/img/tires_icons/thorns.png" class="tires-season-icon">'?>
	                    			<?php else:?>
	                    			<?=''?>
	                    		<?php endif?>
	                    <div class="col-md-12">
							<div class="tires-text-min">
								<div class="tires-text-atributs">
								
                    				
                    			
								<p class="tires-model-text-min">Модель: <a class="tires-model-name" href="/price/tires-price-model.php?id=<?=$v['model_id']?>"><?=$v['model'] ?></a></p>
								
								</div>
								
								
							</div>	
						<div class="row">
							
								
								
							<div class="col-md-12">
								<p></p>
							<?=$v['width'] . "/" . $v['profile'] . " R" . $v['diameter'] . " - " . $v['index_loading'] . $v['index_speed']?>
							</div>
							<div class="col-md-8">
							</div>	
							<div class="col-md-4">
								<p></p>
								<p class="tires-price-parametr"><?=$v['price'] . "₽"?></p>
							</div>	
							
								
							
						</div>
								
						
						</div>
						</div>
                    	
						</div>
						<?php endforeach?>
  </div>
  
  <div style="text-align: right;">
  <button><a href="/price/tires-price-parametr.php?id=<?=$_GET['id']?><?php if(isset($_GET['action']) AND $_GET['action']=='showall'):?><?='">'?><?php else:?>&action=showall">Посмотреть все<?php endif?></a></button>
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


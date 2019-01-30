<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


?>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/header1.php';
require __DIR__ . '/../lib/functions_filter_shini.php';
?>
<?php $data = getKartochkaTiresModel($_GET['id']);?>
    <title>Купить шины <?=$data[0]['brand'] . ' ' . $data[0]['model']?></title>
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
		
		
		<?php $data = getKartochkaTiresModel($_GET['id']);?>
		<?php $data2=getPriceModelParametr($data[0]['id']);?>
		
		
  </div>
  
  
  				<div class="row">
                            <div class="col-xs-12 col-sm-12 ">
                                <a class="label label-primary l-p  hidden-xs hidden-sm" href="javascript:history.back(1)"> &lt;&lt; назад</a>
                                    
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
                            	<h1 id="ang-prod-h1" class="text-center  b1c-name"><?=$data[0]['brand'] . ' ' . $data[0]['model']?></h1>
                           		
                            	<div class="row">
                                	<div>
                                		<p>Производитель: <?=$data[0]['brand']?></p>
                                		<p>Модель: <?=$data[0]['model']?></p>
                                		<p>Страна: <?=$data[0]['country']?></p>
                                		<p>RunFlat: <?php if(!empty($data[0]['Run Flat'])):?>
                                			<?='Да'?>
                                			<?php else:?>
                                				<?='Нет'?>
                                				<?php endif?>
                                		</p>
                                		
                                		<p>Сезонность: <?=$data[0]['season']?></p>
                                		<?php if($data[0]['season']=='Зима'):?>
                                			<?='Тип шины: ' . $data[0]['thorns']?>
                                			<?php endif?>
                                		</p>
                                		
                                	</div>
                               		<div class="col-xs-12">
                                	
                                    
                                	<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">    
                                  
                                    	<meta itemprop="priceCurrency" content="RUB" />
                                    	<link itemprop="itemCondition" href="http://schema.org/NewCondition" />
                                    
                               		</div>
                               		</div>
                                    <div class="col-md-12 col-xs-12 col-sm-12 text-center">
                               			<button type="button" class="btn btn-success ang-byu-oneclick b1c"><span><i class="fa fa-mouse-pointer"></i></span>Заказть звонок</button>
                               			<a href="/contacts/" class="btn btn-success ang-byu-oneclick "><span></span>Посмотреть контакты</a>
                              
                                    </div>
                               </div>
							</div>
                    </div>
                    
  
  <div class="row tires-model-spisok">
  	<div class="col-md-12">
  	<div class="col-md-12">	
  	<h3>Размеры и цены:</h3>
  	</div>
  	<div class="row">
  		<div class="col-md-12">
  		<div class="col-md-3 tires-div-spisok">
  			
  			Модель
  		</div>
  		<div class="col-md-1 tires-div-spisok">
  			
  			Диаметр
  		</div>	
  		<div class="col-md-2 tires-div-spisok">
  			
  			Ширина
  		</div>
  		<div class="col-md-1 tires-div-spisok">
  			
  			Профиль
  		</div>
  		
  		<div class="col-md-3 tires-div-spisok">
  			
  			Индекс нагрузки/скорости
  		</div>
  		
  		<div class="col-md-2 tires-div-spisok">
  		Цена
  		</div>
  		</div>
  	</div>
  	<?php foreach($data2 as $k=>$v): ?>
  	<a href="/price/tires-price-parametr.php?id=<?=$v['id']?>">
  	<div class="row tires-parametr-spisok">
  		<div class="col-md-3">
  			<?=$v['model']?>
  		</div>
  		<div class="col-md-1">
  			R<?=$v['diameter']?>
  		</div>
  		<div class="col-md-2">
  			<?=$v['width'] . "mm"?>
  		</div>
  		<div class="col-md-1">
  			<?=$v['profile']?>
  		</div>
  		
  		
  		<div class="col-md-3">
  			<?=$v['index_loading']?><?=$v['index_speed']?>
  		</div>
  		<div class="col-md-2 tires-price-parametr">
  			<?=$v['price']?> ₽
  		</div>
  	
  		
  	</div>
  	</a>
  	<?php endforeach?>		
  </div>
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


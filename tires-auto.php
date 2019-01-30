<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//include 'config.php';

?>

<?php
    require_once  $_SERVER['DOCUMENT_ROOT'] . '/include/header1.php';
	require __DIR__ . '/lib/functions_filter_shini.php';
	
?>
<!--получение значений-->				
					
					
					<?php $marka1=getMarka();?>
					<?php $model1=getModel();?>


    <title> 
    	<?php if(empty($_GET)):?>
    		<?='Подбор шин по марке, модели автомобиля'?>
    		<?php else:?>
    			<?="Шины для " . ($_GET['marka'] . " " . $_GET['model'])?>
    	<?php endif?>
	</title>
    <meta name="Доставка запчастей на HD78. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?> ">
    <meta name="keywords" content="Запчасти Хендай">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header2.php';
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  
 
  
  
  
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
                <div class="panel-body">
  			
  				<div class="row tires-panel-filter">
                	
                       
  
                        

					
					

 
<div class="col-md-12">
<div class="row"> 
	<a href="/tires-truck/">
		<div class="col-md-4 col-sm-4 col-xs-4 tires-text-center tires-hover">
		
			<img src="/img/tires_icons/truck.png" class="tires-top-nav">
		<text class="tirex-text-top-nav">Грузовые шины</text>
	</div>
	</a>
	<a href="/tires-all/">
		<div class="col-md-4 col-sm-4 col-xs-4 tires-text-center tires-hover">
		
		
			<img src="/img/tires_icons/light.png" class="tires-top-nav">
		<text class="tirex-text-top-nav">Легковые шины</text>
	</div>
	</a>
	<a href="/tires-auto/">
		<div class="col-md-4 col-sm-4 col-xs-4 tires-text-center tires-hover" style="background-color: #2C3E50;padding-bottom:5px;color: white;">
		
		
			<img src="/img/tires_icons/primen.png" class="tires-top-nav">
		<text class="tirex-text-top-nav">Подбор по авто</text>
	</div>
	</a>
	


</div>
<hr>
</div>



   
    





		
				
					
				
<!--фильтр по авто -->
			
				
								
								<form action="" method="get">
									<div class="col-md-12">
									<div class="row filter-panel-top">
									<div class="col-md-3">
							
														
											<label for="exampleFormControlSelect1">Выберите марку</label>
											
											<select class="form-control tires-form-control" id="exampleFormControlSelect1" name="marka">
												<?php if(!empty($_GET['marka'])):?>
												<option value='<?=$_GET['marka']?>'><?=$_GET['marka']?></option>
												<?php else:?>
												
												<?php endif?>
												<?php foreach($marka1 as $vald): ?>
												<?php if(empty($vald['marka'])){
																			continue;
																			}?>
												<option><?=$vald['marka']?></option>
												<?php endforeach ?>
											</select>
											
									</div>
									
									
									<div class="col-md-3">
							
														
											<label for="exampleFormControlSelect1">Выберите модель</label>
											
											<select class="form-control tires-form-control" id="exampleFormControlSelect1" name="model">
												<?php if(!empty($_GET['model'])):?>
												<option value='<?=$_GET['model']?>'><?=$_GET['model']?></option>
												
												<?php else:?>
												
												<?php endif?>
												<?php foreach($model1 as $vald): ?>
												<?php if(empty($vald['model'])){
																			continue;
																			}?>
												<option><?=$vald['model']?></option>
												<?php endforeach ?>
											</select>
											
									</div>
									</div>
							<div class="tires_buuton_filtr">	
									<button style="background-color: #2C3E50;" type="submit" class="btn btn-primary tires-btn" name="action2" value="get_filter2">применить</button>
								</div>
								</div>
								</form>
								
							
			
    
			
<!--конец фильтра по авто-->				
				
				

		

</div><!--конец фильтров-->  

					
					
<h1> 
    	<?php if(empty($_GET)):?>
    		<?='Подбор шин по марке и модели автомобиля'?>
    		<?php else:?>
    			<?="Шины для " . ($_GET['marka'] . " " . $_GET['model'])?>
    	<?php endif?>
</h1>
<hr>
				
					
					
					
					
					
					
					<!--                                 ВЫВОД  с $GET                                          -->
					
				<?php if(@$_GET['action2']=='get_filter2'):
						$data1 = getTiresPrimen($_GET);?>
	<div class="row tires-margin0 car-description-cont"><p class="tires-car-description-title"><?php if(!empty($_GET)):?>
	<img src="/img/<?=$data1[0]['car_image']?>" class="car-image-primenimost">Размер резины для <?=$_GET['marka']?> <?=$_GET['model']?>:</p>
			<p><?php if(!empty($data1[0])):?>
			<p><?="ширина: " . $data1[0]['width']?></p>
			<p><?="профиль: " . $data1[0]['profile']?></p>
			<p><?="диаметр: " . $data1[0]['diameter']?></p>
			<p><?="рекомендуемый индекс нагрузки от " . $data1[0]['index_loading_min']?></p>
			
			<?php else:?>
			<?=''?>
			
			<?php endif?>
			</p></div>
			
	<?php else:?>
	<p>'Выберите марку и модель'</p>
	<?php endif?>	
				
							<?php if(!empty ($data1)):?>
							
<div class="row">
	
	
		
				<?php
				
				foreach($data1 as $key1=>$value1):
				
				?>
				
					<?php $data2 = getPrimenModelParametr($value1['id'],$_GET);?>
				
				
				
				
				
                    
                    
                       <div class="col-md-4  col-sm-6"> 
                    	<div class="row tires-face-tovar">
	                    <a href="/price/tires-price-model.php?id=<?=$value1['id']?>">	
                    		<div class="tires-flex ">
                    			
                    			
                    				
                    				<img src="/img/tires/<?=$value1['images']?>" class="img-responsive tires-image-center">
                    				
								
								
							</div></a>
							<img src="/<?=$value1['brand_img']?>" class="tires-brand-icon ">
                    			<?php if($value1['season']=='Лето'):?>
                    				<?='<img src="/img/tires_icons/leto4.png" class="tires-season-icon">'?>
	                    			<?php elseif($value1['season']=='Зима'):?>
	                    			<?='<img src="/img/tires_icons/zima.png" class="tires-season-icon">'?>
	                    			<?php elseif($value1['season']=='Всесезонная'):?>
	                    			<?='<img src="/img/tires_icons/zimaleto4.png" class="tires-season-icon">'?>
	                    			<?php else:?>
	                    			<?='<p class="tires-season-icon"></p>'?>
	                    		<?php endif?>
	                    		<?php if($value1['thorns']=='шипованная'):?>
                    				<?='<img src="/img/tires_icons/thorns.png" class="tires-season-icon">'?>
	                    			<?php else:?>
	                    			<?=''?>
	                    		<?php endif?>	
	                    <div class="col-md-12">
	                    	<div>
								<div class="tires-text-atributs">
								
                    				
                    			
								<a class="tires-model-name" href="/price/tires-price-model.php?id=<?=$value1['id']?>"><p class="tires-model-text-min ">Модель: <?=$value1['model'] ?></p></a>
								
								</div>
								
								
							</div>		
						<div class="row">
							<div>
								<div class="col-md-12">
								<p class="tires-margin0">Список типоразмеров:</p>
								</div>
								<form action="/price/tires-price-parametr.php?id=<?$value2['id']?>" method="get">
									<select class="form-control tires-form-control" id="get-data2" name="id">
										
										
										
										<?php foreach($data2 as $key2=>$value2):?>
										<option value="<?=$value2['id']?>"><?=$value2['width'] . "/" . $value2['profile'] . " R" . $value2['diameter'] . " - " . $value2['index_loading'] . $value2['index_speed'] . " ₽ " . $value2['price'] . "руб"?></option></a>
										<?php endforeach ?>
									</select>
									<button type="submit" class="btn btn-primary tires-btn name="parametr"">перейти</button>	
								</form>
								
							</div>
						</div>
								
						
						</div>
						</div>
						</div>
						
						
						
					

				<?php endforeach ?>
				
			
			</div>
			<?php else:?>
				<h3>К сожалению таких шин у нас сейчас нет=(</h2>
					Если Вам кажется что это ошибка, то нажмите <a href="сюда" class="tires-link">сюда</a> мы Вам будем очень благодарны!
			<?php endif?> 
																		<!--ВЫВОД без $GET-->
			<?php elseif(empty($_GET)):
				$data=getTiresMain()?>
				
			<div class="row">
		
				<?php
				
				foreach($data as $key1=>$value1):
				
				?>
				
					<?php $data2 = getParametrMain($value1['id']);?>
				
				
				
				
				
                    
                    
                       <div class="col-md-4  col-sm-6"> 
                    	<div class="row tires-face-tovar">
	                    	<a href="/price/tires-price-model.php?id=<?=$value1['id']?>">
                    		<div class="tires-flex ">
                    			
                    			
                    				
                    				<img src="/img/tires/<?=$value1['images']?>" class="img-responsive tires-image-center">
                    				
								
								
							</div>
							</a>	
	                    <img src="/<?=$value1['brand_img']?>" class="tires-brand-icon ">
                    			<?php if($value1['season']=='Лето'):?>
                    				<?='<img src="/img/tires_icons/leto4.png" class="tires-season-icon">'?>
	                    			<?php elseif($value1['season']=='Зима'):?>
	                    			<?='<img src="/img/tires_icons/zima.png" class="tires-season-icon">'?>
	                    			<?php elseif($value1['season']=='Всесезонная'):?>
	                    			<?='<img src="/img/tires_icons/zimaleto4.png" class="tires-season-icon">'?>
	                    			<?php else:?>
	                    			<?='<img src="" class="tires-season-icon">'?>
	                    		<?php endif?>	
	                    <div class="col-md-12">
	                    	
							<div>
								<div class="tires-text-atributs">
								
                    				
                    			
								<a class="tires-model-name" href="/price/tires-price-model.php?id=<?=$value1['id']?>"><p class="tires-model-text-min ">Модель: <?=$value1['model'] ?></p></a>
								
								</div>
								
								
							</div>		
						<div class="row">
							<div>
								<div class="col-md-12">
															
								<p class="tires-margin0">Список типоразмеров:</p>
								</div>
								<form action="/price/tires-price-parametr.php?id=<?$value2['id']?>" method="get">
									<select class="form-control tires-form-control" id="get-data2" name="id">
										
										
										
										<?php foreach($data2 as $key2=>$value2):?>
											
										<option value="<?=$value2['id']?>"><?=$value2['width'] . "/" . $value2['profile'] . " R" . $value2['diameter'] . " - " . $value2['index_loading'] . $value2['index_speed'] . " ₽ " . $value2['price'] . "руб"?></option>
										<?php endforeach ?>
									</select>
									<button type="submit" class="btn btn-primary tires-btn name="parametr"">перейти</button>	
								</form>
								
							</div>
						</div>
								
						
						</div>
						</div>
						</div>
						
						
						
					

				<?php endforeach ?>
				
			
			</div>
				
				<?php endif?>
			
			
			
			
			
                
                  </div><!--/panel-body-->
                 
			</div><!--/panel-->
        </div><!--/end right column-->
    </div>
</div><!-- Ends body -->
<?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footer.php';?>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footerjq.php';?>
 <link rel='stylesheet' href='/css/andrey.css'>
 <script type="text/javascript" src="/catalogue/js/jquery.imagemapster.min.js"></script>
<script type="text/javascript" src="/catalogue/js/script.js"></script>

 <script type="text/javascript" src="/js/magnify.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer3.php';?>

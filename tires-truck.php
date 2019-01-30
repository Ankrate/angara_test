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
					<?php $diameter1=getDiameterTruckAjax();?>
					<?php $width1=getWidthTruckAjax();?>
					
   
					<?php $profile1=getProfileTruckAjax();?>
					<?php $index_loading1=getIndex_loadingTruckAjax();?>
					<?php 
						foreach ($index_loading1 as $key => $value) {
						$tt[]=$value['value'];
					}?>
					<?php $season1=getSeasonTruckAjax();?>
					<?php $chamber1=getChamberTruckAjax();?>
					<?php $axis1=getAxisTruck();?>
					
					


    <title>Купить грузовые шины 
    	<?php if(empty($_GET)):?>
    		<?='подбор шин по размеру'?>
    		<?php else:?>
    			<?=($_GET['width'] . "/" . $_GET['profile'])?>
    			<?php if(!empty($_GET['diameter'])):?>
    				<?=" R" . $_GET['diameter']?>
    				<?php else:?>
    					<?=''?>
    					<?php endif?>
	    			<?php if($_GET['chamber']=='TL'):?>
	    				<?="Бескамерные"?>
	    				<?php elseif($_GET['chamber']=="TT"):?>
	    					<?="Камерные"?>
	    					<?php else: ?>
	    						<?=''?>
	    					<?php endif?>
	    					<?php endif?>
	    					</title>
    <meta name="Доставка запчастей на HD78. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?> ">
    <meta name="keywords" content="Запчасти Хендай">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header2.php';
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  
 
  
  
  
           
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
		<div class="col-md-4 col-sm-4 col-xs-4 tires-text-center tires-hover" style="background-color: #2C3E50;padding-bottom:5px;color: white;">
		
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
		<div class="col-md-4 col-sm-4 col-xs-4 tires-text-center tires-hover">
		
		
			<img src="/img/tires_icons/primen.png" class="tires-top-nav">
		<text class="tirex-text-top-nav">Подбор по авто</text>
	</div>
	</a>
	


</div>
<hr>
</div>








  

    





<!--начало фильтра по размеру-->					
					
    					
  
					<form action="" method="get">
						<div class="col-md-12">
						<div class="row"> 
<!--ширина-->						
							<div class="col-md-2">
								<label for="exampleFormControlSelect1">Ширина</label>
								<p></p>
								<select class="form-control tires-form-control" id="exampleFormControlSelect1" name="width">
									
									<?php if(!empty($_GET['width'])):?>
									<?php $widthspec=getWidthSpec($_GET['width']);?>
									
									<option value='<?=$_GET['width']?>'><?=$_GET['width'] . "(" . $widthspec[0]['width_spec'] . ")"?></option>
									<option value=''></option>
									<?php else:?>
									<option value=''></option>
									<?php endif?>
									<?php foreach($width1 as $vald): ?>
									<?php if(empty($vald['width'])){
																continue;
																}?>
									<option value="<?=$vald['width']?>"><?=$vald['width'] . "(" . $vald['width_spec'] . ")"?></option>
									<?php endforeach ?>
								</select>
								
							</div>
	
	
<!--профиль-->	
							<div class="col-md-2">
								<label for="exampleFormControlSelect1">Профиль</label>
								<p></p>
								<select class="form-control tires-form-control" id="exampleFormControlSelect1" name="profile">
									<?php if(!empty($_GET['profile'])):?>
									<option value='<?=$_GET['profile']?>'><?=$_GET['profile']?></option>
									<option value=''></option>
									<?php else:?>
									<option value=''></option>
									<?php endif?>
									
									<?php foreach($profile1 as $vald): ?>
									<?php if(empty($vald['profile'])){
																continue;
																}?>
									<option><?=$vald['profile']?></option>
									<?php endforeach ?>
								</select>
							</div>



<!--диаметр-->
							<div class="col-md-2">					
								<label for="exampleFormControlSelect1">Диаметр</label>
								<p></p>
								<select class="form-control tires-form-control" id="exampleFormControlSelect1" name="diameter">
									<?php if(!empty($_GET['diameter'])):?>
									<option value='<?=$_GET['diameter']?>'><?=$_GET['diameter']?></option>
									<option value=''></option>
									<?php else:?>
									<option value=''></option>
									<?php endif?>
									
									<?php foreach($diameter1 as $vald): ?>
									<?php if(empty($vald['diameter'])){
																continue;
																}?>
									<option><?=$vald['diameter']?></option>
									<?php endforeach ?>
								</select>
							</div>	
								



<!--камерность-->							
							<div class="col-md-2">
								
								<label for="exampleFormControlSelect1">Камерность</label>
								<p></p>
								<select class="form-control tires-form-control" id="exampleFormControlSelect1" name="chamber">
									<?php if(!empty($_GET['chamber'])):?>
									<option value='<?=$_GET['chamber']?>'>
										<?php if($_GET['chamber']=='TT'):?>
												<?='Камерная'?>
											<?php elseif($_GET['chamber']=='TL'):?>
												<?='Бескамерная'?>
											<?php else:?>
												<?=''?>
											<?php endif?></option>
										</option>
									<option value=''></option>
									<?php else:?>
									<option value=''></option>
									
									<?php endif?>
									<option value='TT'>Камерная</option>
									<option value='TL'>Бескамерная</option>
								
								</select>
								
							</div>
<!--индекс нагрузки-->					
							<div class="col-md-4">
								<p>
								  <label for="amount">Индекс нагрузки</label>
								  <input type="text" name="index_loading" id="amount" readonly class="tires-index-loading">
								</p>
								 
								<div id="slider-range"></div>
							
							
							</div>
							
							
							
						</div>
						
						
					<div class="tires_buuton_filtr">	
<!--кнопка-->	 	<button style="background-color: #2C3E50;" type="submit" class="btn btn-primary tires-btn" name="action1" value="get_filter">применить</button>
					</div>
					</div>
					</form>
					
  
  
					
				
				
 <!--конец формы по размеру-->   			
				
					
				
	




</div>	
			
<h1>Грузовые шины 
    	<?php if(empty($_GET)):?>
    		<?=''?>
    	<?php else:?>
    		<?=($_GET['width'] . "/" . $_GET['profile'])?>
    		<?php if(!empty($_GET['diameter'])):?>
    			<?=" R" . $_GET['diameter']?>
    		<?php else:?>
    			<?=''?>
    		<?php endif?>
	    	<?php if($_GET['chamber']=='TL'):?>
	    		<?="Бескамерные"?>
	    	<?php elseif($_GET['chamber']=="TT"):?>
	    		<?="Камерные"?>
	    	<?php else: ?>
	    		<?=''?>
	    	<?php endif?>
	    	<?="(" . $_GET['index_loading'] . ")"?>
	    <?php endif?>
</h1>
<hr>
					
					<!--                                 ВЫВОД                                            -->
					
				<?php if(@$_GET['action1']=='get_filter'):
						$data1 = shinifiltrTruck($_GET);
					
				?>
                			
                			
					
							<?php if(!empty ($data1)):?>
							
<div class="row">
		
				<?php
				
				foreach($data1 as $key1=>$value1):
				
				?>
				
					<?php $data2 = getModelParametrTruck($value1['id'],$_GET);?>
				
				
				
				
				
                    
                    
                       <div class="col-md-4 col-sm-6"> 
                    	<div class="row tires-face-tovar">
	                    	<a href="/price/tires-price-model-truck.php?id=<?=$value1['id']?>">
                    		<div class="tires-flex ">
                    			
                    			
                    				
                    				<img src="/img/tires/<?=$value1['images']?>" class="img-responsive tires-image-center">
                    				
								
								
							</div>
							</a>
							<img src="/<?=$value1['brand_img']?>" class="tires-brand-icon ">
                    			<?php if($value1['m+s']=='1'):?>
			                    				<?='<img src="/img/tires_icons/m+s.png" class="tires-season-icon">'?>
				                    			<?php else:?>
				                    			<?='<p class="tires-season-icon"></p>'?>
				                    		<?php endif?>
	                    <div class="col-md-12">
							<div>
								<div class="tires-text-atributs">
								
                    				
                    			
								<a class="tires-model-name" href="/price/tires-price-model-truck.php?id=<?=$value1['id']?>"><p class="tires-model-text-min ">Модель: <?=$value1['model'] ?></p></a>
								
								</div>
								
								
							</div>	
						<div class="row">
							<div>
								<div class="col-md-12">
								<p class="tires-margin0">Список типоразмеров:</p>
								</div>	
								<form action="/price/tires-price-parametr-truck.php?id=<?$value2['id']?>" method="get">
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
			<?php else:?>
				<h2>Нет товаров</h2>
			<?php endif?>
			<?php else:
				$data=getTiresMainTruck()?>
				
				<!--
				<div class="row">
									
											<?php
											
											foreach($data as $key1=>$value1):
											
											?>
											<div class="col-md-3  col-sm-6">
												<div class="row tires-face-tovar">
													<a href="/price/tires-truck?brand=<?=$value1['brand']?>"><img src="/<?=$value1['brand_img']?>" class="tires-brand-icon"></a>
												</div>
											</div>
											<?php endforeach?>
								</div>-->
				
							
			
			<div class="row">
					
							<?php
							
							foreach($data as $key1=>$value1):
							
							?>
							<?php $data2 = getParametrMainTruck($value1['id']);?>
							
								<div class="col-md-4  col-sm-6"> 
									<div class="row tires-face-tovar">
										<a href="/price/tires-price-model-truck.php?id=<?=$value1['id']?>">
										<div class="tires-flex ">
																																														   <img src="/img/tires/<?=$value1['images']?>" class="img-responsive tires-image-center">
																																												   </div>
										</a>
										<img src="/<?=$value1['brand_img']?>" class="tires-brand-icon ">
											<?php if($value1['m+s']=='1'):?>
															<?='<img src="/img/tires_icons/m+s.png" class="tires-season-icon">'?>
															<?php else:?>
															<?='<p class="tires-season-icon"></p>'?>
														<?php endif?>
									<div class="col-md-12">
										<div>
											<div class="tires-text-atributs">
																																													   <a class="tires-model-name" href="/price/tires-price-model-truck.php?id=<?=$value1['id']?>"><p class="tires-model-text-min ">Модель: <?=$value1['model'] ?></p></a>
											
											</div>
											
											
										</div>	
									<div class="row">
										<div>
											<div class="col-md-12">
											<p class="tires-margin0">Список типоразмеров:</p>
											</div>
											<form action="/price/tires-price-parametr-truck.php?id=<?$value2['id']?>" method="get">
												<select class="form-control tires-form-control" id="get-data2" name="id">
													
													
													
													<?php foreach($data2 as $key2=>$value2):?>
														
													<option value="<?=$value2['id']?>"><?=$value2['width'] . "/" . $value2['profile'] . " R" . $value2['diameter'] . " - " . $value2['index_loading'] . $value2['index_speed'] . " ₽ " . $value2['price'] . "руб"?></option>
													<?php endforeach ?>
												</select>
												<button type="submit" class="btn btn-primary tires-btn">перейти</button>	
											</form>
											
										</div>
									</div>
											
									
									</div>
									</div>
									</div>
									
									
									
								
			
							<?php endforeach ?>
							
						
						</div>
			
				
				<?php endif?>
			
			
			
			<!--вывод функции по авто-->
			
			
                
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
 
 <script>
									 	$( function() {
									   	$( "#slider-range" ).slider({
									      range: true,
									      min: <?=min($tt)?>, 
									      max: <?=max($tt)?>,
									      values: [ 
									      <?php if(!empty($_GET['index_loading'])):?>
									      <?php $index_loading_save = explode(' - ',$_GET['index_loading']);?>
									      <?=$index_loading_save[0]?>
									      <?php else:?>
									      <?=min($tt)?>
									      <?php endif?>,
									      
									      <?php if(empty($_GET['index_loading'])):?>
									      <?=max($tt)?>
									      <?php else:?>
									      <?=$index_loading_save[1]?>
									      <?php endif?>],
									      slide: function( event, ui ) {
									        $( "#amount" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
									      }
									    });
									    $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) +
									      " - " + $( "#slider-range" ).slider( "values", 1 ) );
									 	} );
									 	
								  	</script>

 

<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer3.php';?>

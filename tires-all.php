<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//include 'config.php';

?>

<?php
    require_once  $_SERVER['DOCUMENT_ROOT'] . '/include/header1.php';
	require __DIR__ . '/lib/functions_filter_shini.php';
	/*
	p($_GET[]);
		*/
?>
<!--получение значений-->				
					<?php $diameter1=getDiameterAjax();?>
					<?php $width1=getWidthAjax();?>
					
   
					<?php $profile1=getProfileAjax();?>
					<?php $index_loading1=getIndex_loadingAjax();?>
					<?php 
						foreach ($index_loading1 as $key => $value) {
						$tt[]=$value['index_loading'];
					}?>
					<?php $season1=getSeasonAjax();?>
					<?php $thorns1=getThornsAjax();?>
					

    <title>Купить шины 
    	<?php if(empty($_GET)):?>
    		<?=', подбор шин по размеру'?>
    		<?php else:?>
    			<?=($_GET['width'] . "/" . $_GET['profile'])?>
    			<?php if(!empty($_GET['diameter'])):?>
    				<?=" R" . $_GET['diameter']?>
    			<?php else:?>
    				<?=''?>
    			<?php endif?>
    			<?php if($_GET['season']=='a.thorns="шипованная" AND a.season="Зима"'):?>
					<?='Зимние шипованные'?>
				<?php elseif($_GET['season']=='a.thorns="не шипованная" AND a.season="Зима"'):?>
					<?='Зимние не шипованные'?>
				<?php elseif($_GET['season']=='a.season="Лето"'):?>
					<?='Летние'?>
				<?php elseif($_GET['season']=='a.season="Всесезонная"'):?>
					<?='Всесезонные'?>
				<?php else:?>		
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
		<div class="col-md-4 col-sm-4 col-xs-4 tires-text-center tires-hover" style="background-color:#2C3E50;padding-bottom:5px;color: white;">
		
		
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
						<div class="row filter-panel-top"> 
<!--ширина-->						
							<div class="col-md-2">
								<label for="exampleFormControlSelect1">Ширина</label>
								
								<select class="form-control tires-form-control" id="exampleFormControlSelect1" name="width">
									<?php if(!empty($_GET['width'])):?>
									<option value='<?=$_GET['width']?>'><?=$_GET['width']?></option>
									<option value=''></option>
									<?php else:?>
									<option value=''></option>
									<?php endif?>
									<?php foreach($width1 as $vald): ?>
									<?php if(empty($vald['width'])){
																continue;
																}?>
									<option><?=$vald['width']?></option>
									<?php endforeach ?>
								</select>
								
								
							</div>
	
	
<!--профиль-->	
							<div class="col-md-2">
								
								<label for="exampleFormControlSelect1">Профиль</label>
							
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
								



<!--сезон и шипы-->							
							<div class="col-md-2">
								
								<label for="exampleFormControlSelect1">Сезон</label>
								
								<select class="form-control tires-form-control" id="exampleFormControlSelect1" name="season">
									<?php if(!empty($_GET['season'])):?>
									<option value='<?=$_GET['season']?>'><?php if($_GET['season']=='a.thorns="шипованная" AND a.season="Зима"'):?>
											<?='Зима шипованная'?>
										<?php elseif($_GET['season']=='a.thorns="не шипованная" AND a.season="Зима"'):?>
											<?='Зима не шипованная'?>
										<?php elseif($_GET['season']=='a.season="Лето"'):?>
											<?='Лето'?>
										<?php elseif($_GET['season']=='a.season="Всесезонная"'):?>
											<?='Всесезонные'?>
										<?php else:?>		
											<?=''?>
										<?php endif?></option>
									<?php else:?>
									<option value=''></option>
									<?php endif?>
									
									<option value='a.thorns="шипованная" AND a.season="Зима"'>Зима шипованная</option>
									<option value='a.thorns="не шипованная" AND a.season="Зима"'>Зима не шипованная</option>
									<option value='a.season="Лето"'>Лето</option>
									<option value='a.season="Всесезонная"'>Всесезонные</option>
								
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
<!--кнопка-->	 	<button style="background-color: #2C3E50;" type="submit" class="btn btn-primary tires-btn" name="action1" value="get_filter"  >применить</button>
					</div>
					</div>
					</form>
					
  
  
					
				
				
 <!--конец формы по размеру-->   			
		

</div><!--конец фильтров-->  

					
					
				
					
					
					
					
					
					
					
					<!--                                 ВЫВОД  с $GET                                          -->
					
					
	<h1>Шины 
    	<?php if(empty($_GET)):?>
    		<?='подбор по размеру'?>
    		<?php else:?>
    			<?=($_GET['width'] . "/" . $_GET['profile'])?>
    			<?php if(!empty($_GET['diameter'])):?>
    				<?=" R" . $_GET['diameter']?>
    			<?php else:?>
    				<?=''?>
    			<?php endif?>
    			<?php if($_GET['season']=='a.thorns="шипованная" AND a.season="Зима"'):?>
					<?='Зимние шипованные'?>
				<?php elseif($_GET['season']=='a.thorns="не шипованная" AND a.season="Зима"'):?>
					<?='Зимние не шипованные'?>
				<?php elseif($_GET['season']=='a.season="Лето"'):?>
					<?='Летние'?>
				<?php elseif($_GET['season']=='a.season="Всесезонная"'):?>
					<?='Всесезонные'?>
				<?php else:?>		
					<?=''?>
				<?php endif?>
				<?="(" . $_GET['index_loading'] . ")"?>
		<?php endif?>
	</h1>
					<hr>
				<?php if(@$_GET['action1']=='get_filter'):
						$data1 = shinifiltr($_GET);
					
				?>
                			
                		
					
							<?php if(!empty ($data1)):?>
							
<div class="row">
			
				<?php
				
				foreach($data1 as $key1=>$value1):
				
				?>
				
					<?php $data2 = getModelParametr($value1['id'],$_GET);?>
				
				
				
				
				
                    
                    
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
								<p class="tires-margin0"><b>Выберите размер:</b></p>
								</div>
								<form action="/price/tires-price-parametr.php?id=<?$value2['id']?>" method="get">
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
			<?php else:?>
				<h3>К сожалению таких шин у нас сейчас нет=(</h2>
					Если Вам кажется что это ошибка, то нажмите <a href="сюда" class="tires-link ">сюда</a> будем очень Вам благодарны!
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

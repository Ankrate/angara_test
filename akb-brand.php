<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//$data = getModel($_GET['model']);
?>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/header1.php';
require __DIR__ . '/lib/functions_filter_akb.php';
?>


  
  
    <title>Аккумуляторы для автомобиля по брендам! Подберем на любой автомобиль!</title>
    <meta name="Акб для любого автомобиля.Доставка по Москве и другим регионам. ☎ <?=TELEPHONE1 ?> ">
    <meta name="keywords" content="Аккумуляторы автомобильные">
    
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/header2.php';

	?>
	
 
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
                        <!--FILTER AKUMULATOR-->             
              		<?php $emkost1 = getEmkostBrandAKB($_GET['real_brand']); ?>
              		<?php
						foreach ($emkost1 as $key => $value) {
							$minmax1[] = $value['emkost'];
						}
					?>
   					
	   					<?php $polarity1 = getPolarityAKB(); ?>
						
						<?php $real_brand1 = getReal_brandAKB(); ?>
	              		
              
            
              				
					<form action="" method="get">
						<div class"">
								
								
							 	
								
							 	
							 	
							 	
							 	
							 	
							 	
							
							
						<div class="row">
						
						<!--ФИЛЬТРЫ-->
						
						
						
						
						
						
						
						
						<div class="row">
							
												                	
				                				
				                				<div class="col-md-6">
				                				<label>Емкость</label></br>
				                					<select class="form-control akb-form-control-1" id="exampleFormControlSelect1" name="emkost">
												<!--OPTION SAVE-->
														<?php if(!empty($_GET['emkost'])):?>
														<option value='<?=$_GET['emkost'] ?>'><?=$_GET['emkost'] ?></option>
														<?php else:?>
															
														<option></option>
														<?php endif ?>
												<!--OPTION SAVE end-->
														<?php foreach ($emkost1 as $valb):?>
														<?php
														if (empty($valb['emkost'])) {
															continue;
														}
															?>
														<option><?=$valb['emkost'] ?></option>
														
														<?php endforeach ?>
														</select>
												</div>
												
												<div class="col-md-6">
												<label><input type="radio" checked='checked' name="real_brand" value="<?=$_GET['real_brand']?>"><?=$_GET['real_brand']?></label>
												</div>
												  </div>
																							
												
												<!--
												<select class="form-control akb-form-control-1" id="exampleFormControlSelect1" name="real_brand">
																									<option><?=$_GET['real_brand']?></option>
																								</select>-->
												
												
						
						
								  		
						
				
							
								
									<button type="submit" class="btn btn-primary akb-btn1 akb-btn-group-sm" name="action1" value="get_filter1">
										применить
									</button>		
								
								<hr/>
							
						
					
					
					</form>
					                
                    
                       		
			
			
			</div>
				
<!--ВЫВОД ФИЛЬТРА-->

					   <?php if(@$_GET['action1']=='get_filter1'):
						$data = filtrakum1($_GET);
					?>
                			
                			
					
							<?php if(!empty ($data)):?>
							
<div class="row">
		
				<?php
				
				foreach($data as $key=>$value):
				?>
				                   
                    
                       <a href="/price/akum-price.php?id=<?=$value['id'] ?>">
                       
                       <div class="col-md-4 col-xs-12"> 
                    	<div class="row akb-face-tovar">
                    	<div class="akb-flex">
                    		<div class="col-md-12">
                    			<img src="/img/AKB/<?=$value['photo'] ?>" class="akb-foto-min1">
							</div>
				</hr>
	                    </div>
	                    <div class="col-md-12">
						<div class="row akb-text-min">
							<div class="row akb-text-atributs1">
							<text><?=$value['title'] ?></text>
							</div>
							
						
						</div>
						<div class="col-md-6 akb-text-atributs">
							<ul class="akb-ul-padding-left">
								<li title="Емкость"class="akb-list-emkost13"><?=$value['emkost'] ?></li>
								<li title="Ток"class="akb-list-current13"><?=$value['current'] ?></li>
								<li title="Полярность"class="akb-list-polarity13"><?=$value['polarity'] ?></li>							
								<li title="Размер"class="akb-list-size13"><?=$value['size'] ?></li>
							</ul>

						</div>
						<div class="col-md-6">
							<h4 align="right" class="akb-cena"><?=$value['price'] ?> р.</h4>	
						</div>

						
						</div>
						<div class="col-md-12 col-xs-12 col-sm-12 text-center">
                              <!-- <button type="button" class="btn btn-success ang-byu-oneclick b1c akb-btn-21"><span><i class="fa fa-mouse-pointer"></i></span> Купить в 1 клик</button>-->
                               <!-- <a href="http://angara77.dnobaka.ru/contacts/" class="btn btn-success ang-byu-oneclick ">Посмотреть контакты</a> -->
                               <button type="button" align="right" class="btn btn-info ang-byu-oneclick  add-to-cart akb-btn-21" data-name="<?=$data[0]['title'] ?>" data-price="<?=$data[0]['price'] ?>" data-id="<?=$data[0]['id'] ?>"><span><i class="fa fa-shopping-cart"></i></span> &nbspВ корзину</button>
                        </div>
						</div>
						</a>
						</div>
						
						
						
					

				
				<?php endforeach ?>
	
			
			
			
			
			
			</div>
			</div>
			<?php else: ?>
				<h2>Нет товаров</h2>
			<?php endif ?>
			<?php else: ?>
				<h2>Выберите фильтр</h2>
			<?php endif ?>
<!--Конец контейнера-->
								
							
										
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
<link rel='stylesheet' href='/css/vasya.css'>
<!-- <script type="text/javascript" src="/catalogue/js/jquery.imagemapster.min.js"></script>
<script type="text/javascript" src="/catalogue/js/script.js"></script>

 <script type="text/javascript" src="/js/magnify.js"></script> -->
 
   
 <?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/footer3.php';
?>
                                            


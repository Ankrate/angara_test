<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//$data = getModel($_GET['model']);
?>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/header1.php';
require __DIR__ . '/lib/functions_filter_akb.php';
?>


  
  
    <title>Аккумуляторы для автомобиля с доставкой! Подберем на любой автомобиль!</title>
    <meta name="Акб для любого автомобиля.Доставка по Москве и другим регионам. ☎ <?=TELEPHONE1 ?> ">
    <meta name="keywords" content="Аккумуляторы автомобильные">
    
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/header2.php';

	?>
	<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  <link rel="stylesheet" href="/resources/demos/style.css">
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

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
                <div class="panel-heading" style="background-color:#111;color:#fff;">Фильтр аккумуляторов</div>   
                <div class="panel-body">
                  <div class="row">
                  <div class="col-md-12">
                        <!--FILTER AKUMULATOR-->             
              		<?php $emkost1 = getEmkostAKB(); ?>
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
							
									<div class="col-md-4">
												<!--<img src="/img/emkost30.jpg" />-->	<label>Емкость</label></br>							
												<select class="form-control akb-form-control-1" name="emkost">
													<?php if(!empty($_GET['emkost'])):?>
													<option><?=$_GET['emkost']?></option>
														<?php else: ?>
															<?php endif ?>
													
							                		<option>40-55</option>	
							                		<option>55-65</option>
							                		<option>65-80</option>
							                		<option>80-90</option>		 
							                		<option>90-100</option>		 
							                	
										</select>
							               </div>
							               <div class="col-md-4">
							               	<label>Полярность</label></br>
							                <select class="form-control akb-form-control-1" name="polarity">
													<?php if(!empty($_GET['polarity'])):?>
													<option><?=$_GET['polarity']?></option>
														<?php else: ?>
															<?php endif ?>
													
							                		<option value="">Любая</option>	
							                		<option>Прямая</option>
							                		<option>Обратная</option>
							                		<option>Универсальная</option>		 
							                				 
							                	
										</select>
									</div>
					
										
								
									
										<div class="col-md-4">
							               	<label>Ток</label></br>
							                <select class="form-control akb-form-control-1" name="current">
													<?php if(!empty($_GET['current'])):?>
													<option><?=$_GET['current']?></option>
														<?php else: ?>
															<?php endif ?>
													
							                		<option value="">Любая</option>	
							                		<option>0-500</option>
							                		<option>500-1000</option>
							                		<option>1000-1500</option>		 
							                				 
							                	
										</select>
									</div>		
				             
				                	
				                				
				                				
												  </div>
																							
												
						
						
						
						
						
						
						
						
						
						
						
						
						
								
													
								  		
								  		
								  		
						
				
							
								
									<button type="submit" class="btn btn-primary akb-btn1 akb-btn-group-sm" name="action1" value="get_filter">
										применить
									</button>		
								
								<hr/>
							
						
					
					
					</form>
					                
        				
				
<!--ВЫВОД ФИЛЬТРА-->

					   <?php if(@$_GET['action1']=='get_filter'):
						$data = filtrakum($_GET);
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
				<div class="row akb-show-brand-click">            
        					 <div class="col-md-12 col-xs-12">
        					 <div class="panel-heading akb-show-brand-click" style="background-color:#111;color:#fff;">Аккумуляторы по брендам     скрыть</div>   
			            	</div>
			            </div> 
			            
			            <div class="akb-show-brand-slide">
			            <div class="akb-flex-brand ">
							
			                <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;">
			                <a href="/akb-brand.php/?real_brand=AFA">
			                <img src="/img/AKB/afa.jpg">
			                <text style="font-size:20px;">AFA</text>     
			                </a>
			                </div>
			                
			               
							<div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;">
				               	<a href="/akb-brand.php/?real_brand=AKBmax">
			                    <img src="/img/AKB/akbmax.jpg">
			                    <text style="font-size:20px;">AKBmax</text>
			               </a>
			               </div>
			      
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Аком">
			                    <img src="/img/AKB/akom.jpg">
			                    <text style="font-size:20px;">Аком</text>
			                    </a>
			               </div>
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=AlphaLine">
			                    <img src="/img/AKB/alfaline.jpg">
			                    <text style="font-size:20px;">AlpaLine</text>
			                    </a>
			               </div>
			               
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Autopart">
			               <img src="/img/AKB/autopart.jpg"> 
			               <text style="font-size:20px;">Autopart</text>
			                    </a>    
			               </div>
			              
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Автофан">
			                    <img src="/img/AKB/avtofun.jpg">
			                    <text style="font-size:20px;">Автофан</text>
			                    </a>
			               </div> 
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Autous">
			                    <img src="/img/AKB/avtous.jpg">
			                    <text style="font-size:20px;">Autous</text>
			                    </a>
			               </div>       		
						</div>
						<div class="akb-flex-brand">
							   
			               
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=BANNER">
			                    <img src="/img/AKB/banner.jpg">
			                    <text style="font-size:20px;">BANNER</text>
			                    </a>
			               </div>
			               
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Bosch">
			               <img src="/img/AKB/bosh.jpg">
			               <text style="font-size:20px;">Bosch</text>
			                    </a>     
			               </div>
			                       	
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=DEKA">
			                    <img src="/img/AKB/deka.jpg">
			                    <text style="font-size:20px;">DEKA</text>
			                    </a>
			               </div>
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Delkor">
			                    <img src="/img/AKB/delkor.jpg">
			                    <text style="font-size:20px;">Delkor</text>
			                    </a>
			               </div>
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Ecostart">
			                    <img src="/img/AKB/ecostart.jpg">
			                    <text style="font-size:20px;">Ecostart</text>
			                    </a>
			               </div> 
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Exide">
			               <img src="/img/AKB/exide.jpg"> 
			               <text style="font-size:20px;">Exide</text>
			                    </a>    
			               </div>
			               
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=forse">
			                    <img src="/img/AKB/forse.jpg">
			                    <text style="font-size:20px;">Forse</text>
			                    </a>
			               </div>       		
						</div>
						
						<div class="akb-flex-brand">
			               
			               
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Hankook">
			                    <img src="/img/AKB/hankook.jpg">
			                    <text style="font-size:20px;">Hankook</text>
			                    </a>
			               </div>
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Inci Aku">
			                    <img src="/img/AKB/inciaku.jpg">
			                    <text style="font-size:20px;">Inci Aku</text>
			                    </a>
			               </div>
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=JOKER">
			               <img src="/img/AKB/joker.jpg">
			               <text style="font-size:20px;">JOKER</text>
			                    </a>     
			               </div>
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Курский">
			                    <img src="/img/AKB/kyrski.jpg">
			                    <text style="font-size:20px;">Курский</text>
			                    </a>
			               </div>
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=MOLL">
			                    <img src="/img/AKB/mall.jpg">
			                    <text style="font-size:20px;">MOLL</text>
			                    </a>
			               </div>
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Mutlu Aku">
			                    <img src="/img/AKB/multu.jpg">
			                    <text style="font-size:20px;">Mutlu</text>
			                    </a>
			               </div>
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Mushtang">
			               <img src="/img/AKB/mustang.jpg">
			               <text style="font-size:20px;">Mushtang</text>
			                    </a>     
			               </div>
			                       		
						</div>
						<div class="akb-flex-brand">
			        
			               
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Optima">
			                    <img src="/img/AKB/optima.jpg">
			                    <text style="font-size:20px;">Optima</text>
			                    </a>
			               </div>
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=RED">
			                    <img src="/img/AKB/red.jpg">
			                    <text style="font-size:20px;">RED</text>
			                    </a>
			               </div>
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=SilverStar">
			                    <img src="/img/AKB/silverstar.jpg">
			                    <text style="font-size:20px;">SilverStar</text>
			                    </a>
			               </div>
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Solite">
			               <img src="/img/AKB/solite.jpg">     
			                    <text style="font-size:20px;">Solite</text>
			                    </a>
			               </div>
			               
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=STORM">
			                    <img src="/img/AKB/storm.jpg">
			                    <text style="font-size:20px;">STORM</text>
			                    </a>
			               </div>
			               
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=TAB">
			                    <img src="/img/AKB/tab.jpg">
			                    <text style="font-size:20px;">TAB</text>
			                    </a>
			               </div>
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Topla">
			                    <img src="/img/AKB/toopla.jpg">
			                    <text style="font-size:20px;">Topla</text>
			                    </a>
			               </div>               		
						</div>
						
						<div class="akb-flex-brand">
			               
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Тюмень">
			               <img src="/img/AKB/tumen.jpg">  
			                    <text style="font-size:20px;">Тюмень</text>
			                    </a>   
			               </div>
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Vaiper">
			                    <img src="/img/AKB/vaiper.jpg">
			                    <text style="font-size:20px;">Vaiper</text>
			                    </a>
			               </div>
			               
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Varta">
			                    <img src="/img/AKB/varta.jpg">
			                    <text style="font-size:20px;">Varta</text>
			                    </a>
			               </div>
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Volt">
			                    <img src="/img/AKB/volt.jpg">
			                    <text style="font-size:20px;">Volt</text>
			                    </a>
			               </div>
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=X-treme">
			               <img src="/img/AKB/xtreme.jpg">  
			                    <text style="font-size:20px;">X-treme</text>
			                    </a>   
			               </div>
			               
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=Yuasa">
			                    <img src="/img/AKB/yasa.jpg">
			                    <text style="font-size:20px;">Yuasa</text>
			                    </a>
			               </div>
			               
			               <div class="col-md-2 col-xs-2 akb-brandy-kart" style="text-align:center;" "akb-brandy-kart">
			               	<a href="/akb-brand.php/?real_brand=ЗВЕРЬ">
			                    <img src="/img/AKB/zver.jpg">
			                    <text style="font-size:20px;">ЗВЕРЬ</text>
			                    </a>
			               </div>
			                       		
						</div>
						</div>
						
						
			
			</div>
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
                                            
<!--
<script>
                                            $(document).ready(function() {
                                                $('.block').on('click', 'akb-show-brand-click', function() {
                                                    $(this).toggleClass('red').siblings('akb-show-brand-slide').slideToggle(0);
                                                });
                                            });
                                            </script>-->
<script>
    $(".akb-show-brand-click").click(function () {
      $(this).siblings(".akb-show-brand-slide").slideToggle("fast");
    });
</script>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/header1.php';
require __DIR__ . '/../lib/functions_filter_akb.php';

?>
  
    <meta name="Доставка аккумуляяторов в Москве. Акб для любого автомобиля<?=TELEPHONE1 ?> ">
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
			$data = getKartochka($_GET['id']);
			
        ?>
		
		<title>Аккумулятор <?=$data[0]['title']?> в Москве! Акб <?=$data[0]['real_brand']?> с доставкой! + Гарантия</title>
		
  </div>
  
  
  				<div class="row">
                            <div class="col-xs-12 col-sm-12 ">
                                <a class="label label-primary l-p  hidden-xs hidden-sm" href="javascript:history.back(1)"> &lt;&lt; назад</a>
                                    <div itemprop="name"><h1 id="ang-prod-h1" class="text-center  b1c-name"><?=$data[0]['title'] ?></h1></div>
                            </div>
				</div>
  
  <!--TITLE-->
  
  <div class="row">
                            <div class="col-sm-6 ">
                                <div class="im-well">
                                    <img src="/img/AKB/<?=$data[0]['photo'] ?>">
                                </div>
                            </div>
                            <div class="col-sm-6 prod-price-padd">
                            <noindex>
                                <div class="alert alert-success ang-alert" role="alert"><strong>Акция:</strong>Напиши отзыв и получи скидку 200р на аккумулятор!</div>
                            </noindex>
                            <div class="row">
                                <div class="col-xs-12">
                                    <ul>
                                   	
                                    	<li class="akb-list-emkost">Емкость: <em><?=$data[0]['emkost'] ?> Ампер/час</em></li>
                                    	
                          
                          
                                    	<li class="akb-list-current">Ток: <em><?=$data[0]['current'] ?> A </em></li>
                          
                          
                                    	
                                    	<li class="akb-list-brand">Бренд: <em><?=$data[0]['real_brand'] ?></em></li>
                           
                          
                          
                                    	<li class="akb-list-polarity">Полярность: <em><?=$data[0]['polarity'] ?></em></li>
                          
                                                    
                          
                                    	<li class="akb-list-input">Клеммы: <em><?=$data[0]['type_of_current_output'] ?></em></li>
                          
                                                                         
                                    	
                                    	<li class="akb-list-size">Размер: <em><?=$data[0]['size'] ?></em></li>
                          
                          
                                    	
                                    	<li class="akb-list-weight">Вес: <em><?=$data[0]['weight'] ?> кг.</em></li>
                          
                                                             
                          
                                    	<li class="akb-list-country">Страна: <em><?=$data[0]['country'] ?></em></li>
                                    
                                    
                                    
                                    </ul>
                                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">    
                                    <span itemprop="price" class="text-justify ang-prod-price b1c-price text-center akb-cena-manager"><small>Цену уточняйте у менеджера!</small></span><span class="ang-prod-price"></span>
                                    <meta itemprop="priceCurrency" content="RUB" />
                                    <link itemprop="itemCondition" href="http://schema.org/NewCondition" />
                                    
                               </div>
                               </div>
                                    <div class="col-md-12 col-xs-12 col-sm-12 text-center akb-pad1">
                               <button type="button" class="btn btn-success ang-byu-oneclick b1c"><span><i class="fa fa-mouse-pointer"></i></span> Купить в 1 клик</button>
                               <!-- <a href="http://angara77.dnobaka.ru/contacts/" class="btn btn-success ang-byu-oneclick ">Посмотреть контакты</a> -->
                               <button type="button" class="btn btn-info ang-byu-oneclick  add-to-cart" data-name="<?=$data[0]['title'] ?>" data-price="<?=$data[0]['price'] ?>" data-id="<?=$data[0]['id'] ?>"><span><i class="fa fa-shopping-cart"></i></span> &nbspВ корзину</button>
                                    </div>
                               </div>
                               
                               
                               
                                                       </div>
   </div> <!--OPISANIE+VSAKOE-DRUGOE-->
						<div class="row">
                               	
                                  
						
							
								
									<div class="row">
										<div class="col-md-12">
											<div class="ang-dostavka">
												<noindex>
													<div class="well">
														<h3>Информация о доставке:</h3>
														<ul>

															<li>
																Доставка по Москве, при покупке на сумму от 8000 рублей - бесплатно.
															</li>
															<li>
																Если сумма заказа меньше 8000 рублей, доставка 500 рублей.
															</li>
															<li>
																Клиентам из регионов, доставка примерно 500 рублей.<a href="/delivery/" rel="nofollow"> Подробнее здесь...</a>
															</li>
														</ul>
													</div>
												</noindex>
											</div>
										</div>
										<!-- под доставкой-->
										<div><h2>Похожие аккумуляторы:</h2></div>
											
											<?php $data2 = getPohBrand($data[0]['emkost']);
											?>
											
											
												<!--
												<?php p($data2);
																								?>-->
												
			<div class="row">
		
				<?php
				
				foreach($data2 as $key2=>$value2):
				?>
				                   
                    
                       <a href="/price/akum-price.php?id=<?=$value2['id'] ?>">
                       
                       <div class="col-md-4 col-xs-12"> 
                    	<div class="row akb-face-tovar">
                    	<div class="akb-flex">
                    		<div class="col-md-12">
                    			<img src="/img/AKB/<?=$value2['photo'] ?>" class="akb-foto-min1">
							</div>
				
	                    </div>
	                    <div class="col-md-12">
						<div class="row akb-text-min">
							<div class="row akb-text-atributs1">
							<text><?=$value2['title'] ?></text>
							</div>
							
							
						</div>
						<div class="col-md-6 akb-text-atributs">
							<ul class="akb-ul-padding-left">
								<li title="Емкость"class="akb-list-emkost13"><?=$value2['emkost'] ?></li>
								<li title="Ток"class="akb-list-current13"><?=$value2['current'] ?></li>
								<li title="Полярность"class="akb-list-polarity13"><?=$value2['polarity'] ?></li>							
								<li title="Размер"class="akb-list-size13"><?=$value2['size'] ?></li>
							</ul>
							
						</div>
						<div class="col-md-6">
							<h4 align="right" class="akb-cena"><?=$value2['price'] ?> р.</h4>	
						</div>
						
						</div>
						<div class="col-md-12 col-xs-12 col-sm-12 text-center">
                               <button type="button" class="btn btn-success ang-byu-oneclick b1c akb-btn-21"><span><i class="fa fa-mouse-pointer"></i></span> Купить в 1 клик</button>
                               <!-- <a href="http://angara77.dnobaka.ru/contacts/" class="btn btn-success ang-byu-oneclick ">Посмотреть контакты</a> -->
                               <button type="button" class="btn btn-info ang-byu-oneclick  add-to-cart akb-btn-21" data-name="<?=$data[0]['title'] ?>" data-price="<?=$data[0]['price'] ?>" data-id="<?=$data[0]['id'] ?>"><span><i class="fa fa-shopping-cart"></i></span> &nbspВ корзину</button>
                                    </div>
						</div>
						
						</div>
						</a>
					

				
				<?php endforeach ?>
	
			
			
			
			
			
			</div>
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
											
									</div>
									

								
							

							
							</div>
							</div>
						
						</div>
						<!------------------------------------------->
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
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php';
?>
 <?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/footerjq.php';
?>

 <script type="text/javascript" src="/catalogue/js/jquery.imagemapster.min.js"></script>
<script type="text/javascript" src="/catalogue/js/script.js"></script>

 <script type="text/javascript" src="/js/magnify.js"></script>
   <link rel='stylesheet' href='/css/vasya.css'>
 <?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/footer3.php';
?>



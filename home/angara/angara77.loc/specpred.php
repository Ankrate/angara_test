<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//$data = getModel($_GET['model']);
?>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/header1.php';
require __DIR__ . '/lib/functions_filter_akb.php';
?>


  
  
    <title>Аккумуляторы для автомобиля с гарантией! Подберем на любой автомобиль!</title>
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
                <div class="panel-heading" style="background-color:#111;color:#fff;">Спецпредложения</div>   
                <div class="panel-body">
                  <div class="row">
                  <div class="col-md-12">
<!--Спецпредложения-->

<h2>Предложение для Автосервисов</h2>
                   <div class="akb-flex1"><img src="/img/avtoservis.jpg" alt="Запчасти для коммерческого транспорта в России" title="Запчасти для коммерческого транспорта в России">
                   <img src="/img/avtopark.jpg" alt="Запчасти для коммерческого транспорта в России" title="Запчасти для коммерческого транспорта в России">
                   </div>
                   <hr>
                   <div class="row contacts-delivery">
                   <div class="col-md-12">
                   <div class="col-md-12">
                   
                   	<p>Наша компания предлагает автосервисам партнерство по запчастям на коммерческие автомобили</p>
                   <h3>Для Вас:</h3>
                   <div>
                   <div class="row">
                   	
                   	<div class="akb-flex1">
                   	<div>скидка до 10% на автозапчасти Хендай Портер, Форд Транзит, Фиат Дукато, Пежо Боксер, Ситроен Джампер.</li></p>
					</div>
                	
                   	<div>
                    специальное предложение на покупку расходников (масел, фильтров, колодок)
                    </div>
					 </div>  
					<div class="row">
						<div class="akb-flex1">
						
					<p>
                  	бесплатную доставку по Москве и в пределах 15км от МКАД;
                  	</p>
                  	                
                    <p>
                    большое наличие запчастей по Портеру, HD 72, HD78, Дукато
                    </p>
                   
                  	<p>
                    актуальный, полный прайс лист каждый день.
                    </p>	
                    </div>
                     </div>   
                       </div>          
                    </div>
                    
					</div>
				

					   
                			
					

							

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
<link rel='stylesheet' href='/css/vasya.css'>
<!-- <script type="text/javascript" src="/catalogue/js/jquery.imagemapster.min.js"></script>
<script type="text/javascript" src="/catalogue/js/script.js"></script>

 <script type="text/javascript" src="/js/magnify.js"></script> -->
 
   
 <?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/footer3.php';
?>
                                            <script>
												$(function() {
													$("#slider-range").slider({
														range : true,
														min : 0,
														max : 300,
														values : [0, 300],
														slide : function(event, ui) {
															$("#amount").val(ui.values[0] + " - " + ui.values[1]);
															console.log(ui.values[0] + " - " + ui.values[1]);
														}
													});
													$("#amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));
												});
                                            </script>


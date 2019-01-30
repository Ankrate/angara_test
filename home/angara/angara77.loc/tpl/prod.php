<div class="thumbnail b1c-good ang-prod-img">
    <div class="lable lable-primary">
        <a class="label label-primary" href="javascript:history.back(1)"> << назад</a>
    </div>
		
                	<div class="row">
                		<div class="col-xs-12 col-sm-12 ">
                			<h1 id="ang-prod-h1" class="text-center ang-prod-price"><?=trim($data[0][0][1])?></h1>
                			</div>
                			</div>
                	<div class="row">
                	   
                	<div class="col-sm-6 ">
				
                    <img  id="ang-prod-img" class="img-responsive img-thumbnail " src="/public/img/parts/<?=get_image($data[0][0][6])?>" alt="<?=trim($data[0][0][1])?>">
                    </div>
                    <div class="col-sm-6">

                    	<h2 class="text-justify ang-prod-price b1c-price"><?=$data[0][0][4]?> руб</h2>
                    	<button type="button" class="btn btn-success ang-byu-oneclick b1c">Купи в один клик</button>
                    	<a href="<?=ANG_HTTP?>/contacts/" class="btn btn-success ang-byu-oneclick ">Посмотреть контакты</a>
                   	
                    </div>
                  </div>
                  <div class="row">
                  	 <div class="col-sm-12">
                  	 	<div class=" ang-dostavka">
                  	 		<div class="well">
                  	 			<h3>Информация о доставке:</h3>
                  	 			<p>Доставка возможна в день заказа.
                  	 			Для уточнения времени доставки позвоните нашему менеджеру.
                  	 			Доставка курьером 300 рублей.
                  	 			Доставка на автомобиле 500 рублей.</p>
                  	 		</div>
                    	</div>
                    <div class="caption-full">
                       
                        <h4>Описание товара</h4><p> категория <a  href="<?=ANG_HTTP?>/solarisparts/<?=$data[0][0][7]?>/">Запчасти - <?=trim($data2[0][1])?> Хендай Солярис</a></p> 
                        <p><?=$data[0][0][5]?></p>
                    </div>
                    
                    <div class="ratings">
                        <p class="pull-right">Есть отзывы</p>
                        <p>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            4.0 stars
                        </p>
                    	</div>
                    </div>
                    </div>
                   
                </div>

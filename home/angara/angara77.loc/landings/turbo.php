<?php

$angara = 'http://angara77.com';

$land_name = array('first' => 'Турбина',
					'second' => ' ПОРТЕР 2, Портер 1'	
					);

$video = array(	'name' => 'Турбина ANG',
				'price' =>'15700 p.',
				'video' =>'ZRhdorJtZvM',
				'cat'  => '22210042701',
				'mod' => 'ПОРТЕР 2 PORTER2'
				);

$img1 = array(	'name' => 'Турбина',
				'price' => '15700',
				'link' => 'turbo/002.jpg',
				'cat'  => '22210042701'
				
				 );

$img2 = array(	'name' => 'Турбина Garret',
				'price' => '18890',
				'link' => 'turbo/002.jpg',
				'cat'  => '22210042701'
				
				 );
$img3 = array(	'name' => 'Турбина оригинал',
				'price' => '25490',
				'link' => 'turbo/003.jpg',
				'cat'  => '22210042701'
				
				 );				 
$img4 = array(	'name' => 'Ремкомплект турбины',
				'price' => '4990',
				'link' => 'turbo/004.jpg',
				'cat'  => '28255TURBOKIT'
				
				 );

$title = 'Турбина на Портер';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?=$title?></title>
		<link rel="stylesheet" href="/landings/css/style.css" type="text/css">
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="/landings/js/modal.js"></script>
	</head>
	<body>
		<div class="wrap">
			<div class="header">		
				<div class="top">
					<div class="block">
						<a href="#" class="logo"></a>
						<h1>Быстрая доставка запчастей<br />по России и странам СНГ</h1>
						<div class="phone">
							<span class="tel" class="ya-phone">8-495-646-99-53</span>
							<a href="#dialog" name="modal"> закажи звонок</a>						
						</div>
					</div>
				</div>
			</div><!--/header-->
			<div class="main">
			<div class="top-car">
				<div class="block">
					<h2><span><?=$land_name['first']?> </span><?=$land_name['second']?></h2>
					<div class="form">
						<form action='' method='post'>
							<input type="hidden" name="request" value="1"/>
							<h3> Оставь заявку и получи<span>подарок к заказу</span></h3>
							<input type="text" placeholder="Имя*" name='f_name' required="required"/>
							<input type="text" placeholder="E-mail*" name='f_mail' required="required"/>
							<input type="text" placeholder="Телефон*" name='f_phone' required="required"/>
							<button>отправить заявку</button>
							<span class="b-text">Ваши данные не будут переданы 3-м лицам</span>
						</form>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="you-searched">
					<div class="block" id="video">
						<h2 class="black">Вы искали</h2>
						<div class="description">
							<h3><?=$video['name']?></h3>
							<span><?=$video['cat']?> <br /><?=$video['mod']?></span>
						</div>
							<iframe width="560" height="315" src="//www.youtube.com/embed/<?=$video['video']?>" frameborder="0" allowfullscreen></iframe>
						<!--<img src="images/1.png" />-->
						<div class="buy">
							<span class="cost"><?=$video['price']?></span>
							<a href="#dialog" name="modal">купить в 1 клик</a>
						</div>
					</div>
				</div>
				<div class="other-option">
					<div class="block">
						<h2 class="white">другие варианты</h2>
						<div class="item">
							<h3><?=$img1['name']?></h3>
							<!--<span class="model"><?=$img1['cat']?> <br />PORTER ПОРТЕР</span>-->
							<img src="images/<?=$img1['link']?>" width="150px"/>
							<span class="cost"><?=$img1['price']?>p.</span>
							<a href="#dialog" name="modal">купить в 1 клик</a>
						</div>
						<div class="item">
							<h3><?=$img2['name']?></h3>
							<!--<span class="model"><?=$img2['cat']?> <br />PORTER ПОРТЕР</span>-->
							<img src="images/<?=$img2['link']?>" width="150px"/>
							<span class="cost"><?=$img2['price']?>p.</span>
							<a href="#dialog" name="modal">купить в 1 клик</a>
						</div>
						<div class="item">
							<h3><?=$img3['name']?></h3>
							<!--<span class="model"><?=$img3['cat']?> <br />PORTER ПОРТЕР</span>-->
							<img src="images/<?=$img3['link']?>" width="150px"/>
							<span class="cost"><?=$img3['price']?></span>
							<a href="#dialog" name="modal">купить в 1 клик</a>
						</div>
						<div class="item">
							<h3><?=$img4['name']?></h3>
							<!--<span class="model"><?=$img4['cat']?> <br />PORTER ПОРТЕР</span>-->
							<img src="images/<?=$img4['link']?>" width="150px"/>
							<span class="cost"><?=$img4['price']?>p.</span>
							<a href="#dialog" name="modal">купить в 1 клик</a>
						</div>
					</div>
				</div>
				<div class="advantages">
					<div class="block">
						<h2 class="black">наши приемущества</h2>
						<div class="item ico1">
							<span>5 минут от заявки <br />до звонка</span>
						</div>
						<div class="item ico2">
							<span>99% <br />в наличии</span>
						</div>
						<div class="item ico3">
							<span>100% Гарантия <br />возврата </span>
						</div>
						<div class="item ico4">
							<span>100% Гарантия <br />качества</span>
						</div>
						<div class="item ico5">
							<span>24/7<br />Работаем </span>
						</div>
					</div>
				</div>
				<div class="order">
					<div class="block">
						<h2 class="white">Как сделать заказ </h2>
						<div class="order-block">
							<span class="text1">Звонок<br />заявка</span>
							<span class="text2"> Оформление <br />документов</span>
							<span class="text3"> Доставка <br />заказа</span>
						</div>
					</div>
				</div>
				<!--<div class="reviews">
					<div class="block">
						<h2 class="black mb">отзывы клиентов</h2>
						<div class="rew-line">
							<div class="item">
								<div class="top">
									<img src="images/reviews/002.jpg" />
									<span class="name">Михаил<br />Медведев</span>
								</div>
								<p>«… в Вашем магазине всегда рады клиентам, приятные и отзывчивые сотрудники. Все в лучшем виде!»</p>
							</div>
							<div class="item">
								<div class="top">
									<img src="images/reviews/003.jpg" />
									<span class="name">Михаил<br />Добродеев</span>
								</div>
								<p>«Нормальная фирма, все есть, близко от дома, хорошие сотрудники»</p>
							</div>
						</div>
						<div class="rew-line">
							<div class="item">
								<div class="top">
									<img src="images/reviews/001.jpg" />
									<span class="name">Владимир,<br />Адмаев</span>
								</div>
								<p>«Хорошие цены, все в наличии. Коллектив хороший»</p>
							</div>
							<div class="item">
								<div class="top">
									<img src="images/reviews/004.jpg" />
									<span class="name">Водитель<br />ООО "Патриот"</span>
								</div>
								<p>Цены хорошие и все, что надо, есть в наличии. Чего еще желать??))</p>
							</div>
						</div>
					</div>
				</div>-->
				<?php
				$tpl = file_get_contents('revievs.php');
				echo $tpl;
				?>
				<div class="question">
					<div class="block">
						<span class="girl"></span>
						<div class="question-text">
							<span>Остались<br /> вопросы?</span>
							<a href="#dialog" name="modal">задайте их менеджеру</a>
						</div>
					</div>
				</div>
				
			</div>
			</div><!--/main-->
			<div class="footer">
				<div class="block">
					<a href="#" class="logo"></a>
					<p><a class="footer_link" href="<?=$angara?>">ООО «Ангара»</a>. Юр. адрес: 125466, г. Москва, ул. Соловьиная-Роща, д.8 к2 <br />
ОГРН 5077746795418  ИНН 7733607590 КПП 773301001 <br />
Расч./счет 40702810170030424301 ОАО «Промсвязьбанк» г. Москва<br />
к/с 30101810400000000555 БИК 044525555</p>
						<div class="phone">
							<span class="tel" class="ya-phone">8-(495)646-99-53</span>
							<a href="#dialog" name="modal"> закажи звонок</a>						
						</div>
				</div>
			</div><!--/footer-->
		</div><!--/wrap-->
<div id="boxes">

<div id="dialog" class="window">
<div class="form">
						<form action='porter2-tire.php' method='post'>
							<input type="hidden" name="request" value="1"/>
							<h3> Оставь заявку и получи<span>подарок к заказу</span></h3>
							<input type="text" placeholder="Имя*" name='f_name' required="required"/>
							<input type="text" placeholder="E-mail*" name='f_mail' required="required"/>
							<input type="text" placeholder="Телефон*" name='f_phone' required="required"/>
							<button>отправить заявку</button>
							<span class="b-text">Ваши данные не будут переданы 3-м лицам</span>
						</form>
					</div>

</div>
  


<!-- Mask to cover the whole screen -->
  <div id="mask"></div>
</div>		

<?php
    	if(isset ($_POST['request'])) {
		$f_name = @ trim ($_POST['f_name']);
		$f_mail = @ trim ($_POST['f_mail']);
        $f_phone = @ trim ($_POST['f_phone']);	
	    mail ("angara99@gmail.com",
	    "Заявка",
	    "ФИО: $f_name\nE-mail: $f_mail\nТелефон: $f_phone\n", "Content-type: text/plain; charset=\"utf-8\"");
         unset($_POST);
        echo ('<script>jQuery(document).ready(function(){PopUpShowOk()});</script>');
        } 
?>		
	</body>
</html>
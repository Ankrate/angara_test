<div class="special_include lefttd region_div">
	
	<div class="lefttd special_include region_div">
		<div id="customer_count"><?php
										$day = 01;
										$month = 01;
										$year = 2007;
										$age= ((int)((mktime (0,0,0,$month,$day,$year) - time("void"))/86400) * -1 );
										$cust_count = $age*21;
										print ($cust_count ." <span> - Довольных клиентов с 2007 года!</span>");
									?>
		</div>
	</div >
	<div class="lefttd special_include region_div">
		<ul>
			<li><a href="/price/porter">Прайс-лист Портер 1</a></li>
			<li><a href="/price/porter2">Прайс-лист Портер 2</a></li>
			<li><a href="/delivery.php" >Отправка в регионы</a></li>
			<li><a href="#" class="callme_viewform">Заказать звонок</a></li>
		</ul>
	</div>
	
	
	
</div>
<div class="special_include lefttd">
	
	<h4>Видео о нашей компании</h4>
			
	<iframe width="230" height="200" src="//www.youtube.com/embed/SKicZXce8yE"   allowfullscreen></iframe>
</div>
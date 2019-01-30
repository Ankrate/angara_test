
<?php //ob_start();
//p($_SESSION);
if(isset($_GET['search']))
{
    $v = $_GET['search'];
}
else {$v = '';
}
$data = left_side_car();

$label = array('label-default','label-primary','label-success','label-info','label-danger','label-warning');
?>

 <!-- Bootstrap -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
     <!-- <link href="/css/styles.css" rel="stylesheet">
     <link href="/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
     <link rel="stylesheet" href="/include/styles/jquery-ui.css"> -->
    <!-- <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-4786389-1', 'angara77.com');
      ga('send', 'pageview');
    </script>
  </head>
<body>
    <div id="ang-header-top" class="hidden-xs hidden-sm">
        <div id="top-link-block" class="hidden">
             <a href="#top" class="ang-top-button" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
                <i class="glyphicon glyphicon-chevron-up"></i> Наверх
             </a>
        </div><!-- /top-link-block -->
    </div>
        <div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6" style="vertical-align: bottom">
                <div class="zapchasty1"><a href="/">Ангара<span class="zapchasty2"> Запчасти</span></a></div>
                <a href="/contacts"><p><strong>Работаем Без выходных, ежедневно с <?=WORK_FROM_DAYS?> до <?=WORK_TO_DAYS?></strong></p></a>

            </div>

           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 header-telephone-numbers">
               <div class="number5 telephone-head text-right" style="padding-left: 0px">
               <div class=""style="padding-left: 0px;padding-right: 0px"><a href="tel:<?=TELEPHONE_FREE_LINK?>"><?=TELEPHONE_FREE?></a></div>
               </div>
               <div class="number5 telephone-head text-right" style="padding-left: 0px">
              <div class=""style="padding-left: 0px;padding-right: 0px"><a href="tel:<?=TELEPHONE_LINK?>"><?=TELEPHONE1?></a> </div>
               </div>
           </div>

        </div>
    </div>

</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown button
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div>
    <!-- <div class="bs-component" style="color:black;">
              <nav class="navbar navbar-expand-lg navbar-light" style="padding:0px;background-color:#2c3e50">

                <div class="container-fluid">
                  <div class="navbar-brand" style="margin:0">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Ангара запчасти</a>
                  </div>
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">

                      <li class="dropdown active hidden-lg hidden-md">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >Категории<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li style="padding-right: 0,5%"><?php include $_SERVER['DOCUMENT_ROOT'] .'/include/lefttd.php';?></li>



                        </ul>
                      </li>
                      <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"  style="padding-left:10px" >Каталоги<span class="caret"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="/porter1/1/" >Портер1</a></li>
                          <li class="divider"></li>
                          <li><a class="dropdown-item" href="/porter1/2/" >Портер2</a></li>
                          <li class="divider"></li>
                          <li><a class="dropdown-item" href="/porter1/3/" >HD</a></li>
			                       <li class="divider"></li>
                          <li><a class="dropdown-item" href="/porter1/5/" >Старекс</a></li>
			                       <li class="divider"></li>
			                     <li><a class="dropdown-item" href="/porter1/8/" >Санта Фе</a></li>
			                        <li class="divider"></li>
                          <li><a class="dropdown-item" href="/porter1/6/" >Соренто</a></li>
			                       <li class="divider"></li>
                          <li><a class="dropdown-item" href="/porter1/7/" >Соната</a></li>
			                       <li class="divider"></li>
                          <li><a class="dropdown-item" href="/porter1/9/" >Спортейдж</a></li>
			                       <li class="divider"></li>
                          <li><a class="dropdown-item" href="/porter1/10/" >Сид</a></li>
			                       <li class="divider"></li>
                          <li><a class="dropdown-item" href="/porter1/11/" >Оптима</a></li>

                        </ul>
                      </li>
                      <li><a href="/articles/">Статьи</a></li>
                      <li class="dropdown">
                        <a href="/about/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">О Компании <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="/about/">О компании</a></li>
                          <li class="divider"></li>
                          <li><a href="/articles/">Статьи</a></li>
                          <li class="divider"></li>
                          <li><a href="/vacancy/">Вакансии</a></li>
                          <li class="divider"></li>
                          <li><a href="/vacancy/jobs/one/">Вакансия менеджер по продажам</a></li>
                          <li class="divider"></li>
                          <li><a href="/policy.php/">Политика конфиденциальности</a></li>

                        </ul>
                      </li>
                      <li><a href="/delivery/">Доставка</a></li>
                      <li><a href="/contacts/">Контакты</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                          <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>Корзина </span> <span class="glyphicon glyphicon-shopping-cart"></span> <span class="count-cart"></span><span class="caret"></span></a>
                          <ul class="dropdown-menu dropdown-cart" role="menu">
                              <table class="table cart table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Запчасть </th>
                                        <th>Цена </th>
                                        <th>Кол-во</th>
                                        <th>Добавить </th>
                                        <th class="amount">Всего </th>
                                    </tr>
                                </thead>
                                <tbody class="show-cart">
                                </tbody>
                                    </table>
                                      <li class="divider"></li>
                                      <li><div class="total-head text-center">Запчастей на сумму: <span class="total-cart"></span> рублей</div></li>
                                      <li class="divider"></li>
                                      <div class="text-right cart-head-button">
                                        <a class="btn btn-group btn-primary btn-sm clear-cart" >Очистить корзину</a>
                                        <a href="/order/" class="btn btn-group btn-primary btn-sm" >Перейти к корзине</a>
                                    </div>
                          </ul>
                        </li>
                      </ul>
                  </div>
                </div>

              </nav>
            </div> -->

                                                 <!--Добавленный поиск-->
            <div class="container">
            	 <!--Расписание работы в праздники-->
               <!-- <style media="screen">
                 .banner_top{

                    /* background: -moz-radial-gradient(bottom, ellipse cover, rgba(201,201,201,0.65) 0%, rgba(199,199,199,0.65) 1%, rgba(76,76,76,0) 62%, rgba(0,0,0,0) 100%);
                    background: -webkit-radial-gradient(bottom, ellipse cover, rgba(201,201,201,0.65) 0%,rgba(199,199,199,0.65) 1%,rgba(76,76,76,0) 62%,rgba(0,0,0,0) 100%);
                    background: radial-gradient(ellipse at bottom, rgba(201,201,201,0.65) 0%,rgba(199,199,199,0.65) 1%,rgba(76,76,76,0) 62%,rgba(0,0,0,0) 100%);
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6c9c9c9', endColorstr='#00000000',GradientType=1 );  */
                    display: flex;
                    width: 100%;
                    justify-content: center;
                    align-items: center;
                 }
                 .title_banner{
                   color:#30b017;
                   font-size: 20px;
                 }
                 .text_banner{
                   color:#6b6b6b;
                   line-height: 120%;
                   font-size: 15px;
                 }
                 .banner_content{
                   max-height: 200px;

                 }
                 @media screen and (max-device-width: 767px){
                   .title_banner{
                     color:#30b017;
                     font-size: 16px;
                   }
                   .text_banner{
                     color:#6b6b6b;
                     line-height: 120%;
                     font-size: 14px;
                   }
                   .banner_content{
                     max-height: 200px;

                   }
                 }
               </style>
				     <div class="banner_top">
              <div class="banner_content">
                <img src="/img/banners/elka.png" align="left" style="height:100%;margin-right:5px">
                <b class="title_banner">Мы работаем в новогодние праздники!</b>
                <ul style="list-style-type:none">
                  <li class="text_banner">31 декабря - с 9:00 до 17:00</li>
                  <li class="text_banner">c 3 по 6 и 8 января - с 9:00 до 17:00</li>
                  <li class="text_banner">1,2 и 7 января - выходные дни</li>
                </ul>
              </div>
            </div> -->

             <div class="row">
            <div class="col-md-12" id="search_heder">
                 <form class="well search-form" role="search" action="/search-parts/" method="get" name="post_cat">
					<div class="input-group input-group-sm">
						<input name="search" type="text" class="form-control input-lg" id="porter" placeholder="Поиск по номеру, названию запчасти..." value="<?=$v?>">
						<input type="hidden" name="search1" id="my_id" value=""/>
						<?php if(!isset($_SESSION['carname'])){ $_SESSION['carname'] = '';}?>
                        <input type="hidden" name="car" id="car" value="<?=@$_SESSION['carname']?>"/>
						<span class="input-group-btn">
							<button name="submit_search" type="submit" class="btn btn-primary input-lg" value="zapchasti">
								ПОИСК
							</button> </span>
					</div>

					<div style="display:flex;align-items:center">

			        <?php
			        $sr_car=left_side_car();
					if($sr_car<100){
						$sr_car_lo=mb_strtolower($sr_car);
					}else{
						$sr_car_lo="porter";
					}

					if(isset($_SESSION['carname'])){

					$car_id=$_SESSION['carname'];

					}else{
						$car_id=1;
					}
			        ?>
			        <div class="search-form-select2">Искать только для </div><select class="search-form-select" id="checkbox_model" name="cmn">

			        <?php foreach($sr_car as $key => $value){
			        	if($value['id']==$car_id){
			        		$activesrmodel="selected";

			        	}else{
			        		$activesrmodel='';
			        	}
			        	$sr_car_lo=$value['id'];?>

			        <option for="checkbox_model" value="<?=$sr_car_lo?>" <?=$activesrmodel?>><?=$value['title']?></option>
			        <?php }?>
			        </select>
    					</div>


				</form>


            </div>
</div>
           </div>
            <div class="container">
                  <div class="row hidden-xs hidden-sm">
                      <div class="col-md-12 car-pages">
                          <?php

                          foreach ($data as $left) {
                              $k = array_rand($label);
                              $v = $label[$k];
                              ?>
                            <a href="/zapchasti-<?=$left['engname']?>/<?=$left['id']?>/" ><span class="label <?=$v?>"><?=$left['fullname']?></span></a>
                        <?php }?>
                  </div>
                </div>
              </div>

<?php //ob_start();
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
    <div class="bs-component">
              <nav class="navbar navbar-default">
                <div class="container-fluid">
                  <div class="navbar-header">
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
                      <!-- <li ><a href="#">Link <span class="sr-only">(current)</span></a></li> -->
                      <li class="dropdown active">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" rel="nofollow">Каталоги<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="/porter1/1/" rel="nofollow">Портер1</a></li>
                          <li class="divider"></li>
                          <li><a href="/porter1/2/" rel="nofollow">Портер2</a></li>
                          <li class="divider"></li>
                          <li><a href="/porter1/3/" rel="nofollow">HD</a></li>
                          <!-- <li class="divider"></li>
                          <li><a href="/porter1/5/">Starex</a></li> -->
                        </ul>
                      </li>
                      <li><a href="/articles/">Статьи</a></li>
                      <li class="dropdown">
                        <a href="/about/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">О Компании <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="/about/">О компании</a></li>
                          <li class="divider"></li>
                          <li><a href="/articles/">Статьи</a></li>
                          <!-- <li class="divider"></li>
                          <li><a href="#">Документы</a></li> -->
                          <!-- <li class="divider"></li>
                          <li><a href="/stock/">Подарки</a></li> -->
                          
                        </ul>
                      </li>
                      <li><a href="/delivery/">Доставка</a></li>
                      <li><a href="/contacts/">Контакты</a></li>
                    </ul>
                    <div id="search_heder">
                    <form class="navbar-form navbar-right search-form" role="search" action="/search-parts/" method="get" name="post_cat">
                      <div class="form-group">
                        <input type="text" id="porter" class="form-control" placeholder="Поиск по номеру или названию" name="search" value="<?=$v?>">
                        <input type="hidden" name="search1" id="my_id" value=""/>
                        <input type="hidden" name="search2" id="car" value="2"/>
                      </div>
                      <button type="submit" class="btn btn-default" name="submit_search" value="zapchasti">Найти</button>
                    </form>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                          <a href="#" rel="nofollow" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-shopping-cart"></span> <span class="count-cart"></span><span class="caret"></span></a>
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
                                        <a class="btn btn-group btn-primary btn-sm clear-cart" rel="nofollow">Очистить корзину</a>
                                        <a href="/order/" class="btn btn-group btn-primary btn-sm" rel="nofollow">Перейти к корзине</a>
                                    </div>
                              
                          </ul>
                        </li>
                      </ul>
                  </div>
                </div>
              </nav>
            </div>
            <div class="container">
                  <div class="row hidden-xs hidden-sm">
                      <div class="col-md-12 car-pages">
                          <?php
                          
                          foreach ($data as $left) { 
                              $k = array_rand($label);
                              $v = $label[$k];
                              ?>
                            <a href="/zapchasti-<?=$left['engname']?>/<?=$left['id']?>/" rel="nofollow"><span class="label <?=$v?>"><?=$left['fullname']?></span></a>
                        <?php }?>
                  </div>
                </div>
              </div>
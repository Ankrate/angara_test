
 <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin33338/styles/admin.css" rel="stylesheet" type="text/css" />
    <!-- <link href="/css/styles.css" rel="stylesheet"> -->
    <link href="/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <!-- <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
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
                    <a class="navbar-brand" href="/admin33338/val_advigatel.php">Ангара админка</a>
                  </div>
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <!-- <li ><a href="#">Link <span class="sr-only">(current)</span></a></li> -->
                      
                      <!-- <li><a href="#">Статьи</a></li> -->
                      
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Финансы<span class="caret"></span></a>
                        
                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                          
                          <li>
                            <a tabindex="-1" href="/admin33338/insert/expences_insert.php?action=exp_edit&com_id=3" class="red"><span class="red">Редактирование Расходов</span></a>
                            
                          </li>
                          <li class="divider"></li>
                          <li>
                            <a tabindex="-1" href="/admin33338/insert/finance_insert.php?action=budget_edit&com_id=3"><span class="blue">Редактирование Бюджетa</span></a>                         
                          </li>
                        </ul>
                        
                        
                        
                        
                        
                        
                        <!-- <ul class="dropdown-menu" role="menu">
                            <?php foreach($comes as $comy):?>
                            <li><a href="/admin33338/insert/finance_insert.php?action=budget_edit&com_id=<?=$comy['id']?>"><?=$comy['name']?></a></li>
                            <li class="divider"></li>
                            <?php endforeach ?>
                            
                            
                          
                        </ul> -->
                      </li>
                      
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Внутренние документы <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/admin33338/constitution/">Конституция</a></li>
                            
                            
                            <!--<li class="divider"></li>
                            <li><a href="/admin33338/editor_spec.php">Акции</a></li>
                            <li class="divider"></li>
                            <li><a href="cat.angarasolaris.com/">Работа с каталогом</a></li>
                            <li class="divider"></li>
                            <li><a href="/admin33338/elfinder/elfinder.html">Работа с картинками</a></li> 
                            <li class="divider"></li>
                            <li><a href="/admin33338/insert/">Вставить прайс</a></li> -->
                          
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Отчеты<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <!-- <li><a href="/admin33338/report/executiveReport.php">Отчет руководителя</a></li> -->
                            
                        </ul>
                      </li>
                     <li><a style="color:#18bc9c;" href="#"><?=@$_SESSION['name']?></a></li>
                     <li><a style="color:#18bc9c;" href="/admin33338/logout.php">Exit</a></li>
                        
                    
                    </ul>
                    <!-- <div id="search_heder" class="hidden-md hidden-sm hidden-xs">
                    <form class="navbar-form navbar-right search-form" role="search" action="/search-parts/" method="get" name="post_cat">
                      <div class="form-group">
                        <input type="text" id="porter" class="form-control" placeholder="Поиск по номеру или названию" name="search" value="">
                        <input type="hidden" name="search1" id="my_id" value=""/>
                        <input type="hidden" name="search2" id="car" value="2"/>
                      </div>
                      <button type="submit" class="btn btn-default" name="submit_search" value="zapchasti">Найти</button>
                    </form>
                    </div> -->
                  </div>
                </div>
              </nav>
            </div>
            
<script src="/admin33338/js/jquery-1.12.0.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/scripts.js"></script>
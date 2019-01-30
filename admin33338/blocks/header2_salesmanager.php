<?php //ob_start();

?>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin33338/styles/admin.css" rel="stylesheet" type="text/css" />
    <!-- <link href="/css/styles.css" rel="stylesheet"> -->
    <link href="/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    
    
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
                    <a class="navbar-brand" href="/admin33338/">Ангара админка</a>
                  </div>
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <!-- <li ><a href="#">Link <span class="sr-only">(current)</span></a></li> -->
                     <!--  <li class="dropdown active">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin tools <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="cat.angarasolaris.com/">Работа с каталогом</a></li>
                          <li class="divider"></li>
                          <li><a href="/admin33338/linkbuilding/">Перелинковать</a></li>
                         <li class="divider"></li>
                          <li><a href="#">HD</a></li>
                          <li class="divider"></li>
                          <li><a href="/porter1/5/">Starex</a></li>
                        </ul>
                      </li> -->
                      <!-- <li><a href="#">Статьи</a></li> 
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Работа с контентом <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/admin33338/editsub.php">Текст подкатегорий</a></li>
                            <li class="divider"></li>
                            <li><a href="/admin33338/editmain.php">Текст главных страниц</a></li>
                            <li class="divider"></li>
                            <li><a href="/admin33338/editor.php">Статьи</a></li>
                            <li class="divider"></li>
                            <li><a href="/admin33338/elfinder/elfinder.html">Работа с картинками</a></li>
                            <li class="divider"></li>
                            <li><a href="/admin33338/imglist/">Картинки которых нет</a></li>
                            <li class="divider"></li>
                            <li><a href="/admin33338/editor_spec.php">Акции</a></li>
                            <li class="divider"></li>
                            <!-- <li><a href="cat.angarasolaris.com/">Работа с каталогом</a></li>
                            <li class="divider"></li> 
                            <li><a href="/admin33338/elfinder/elfinder.html">Работа с картинками</a></li>
                            <!-- <li class="divider"></li> -->
                            <!-- <li><a href="/admin33338/insert/">Вставить прайс</a></li> 
                          
                        </ul>
                      </li>-->
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Инструменты <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            
                            <?php if($_SESSION['user'] == 'Kirill' ):?>
                            <li class="divider"></li>
                            <li><a href="/admin33338/parser/zaptopexcel.php">Получить прайс Заптоп</a></li>
                            <li class="divider"></li>
                            <li><a href="/admin33338/parser/globalavto.php">Получить прайс ГлобалАвто</a></li>
                            <li class="divider"></li>
                            <li><a href="/admin33338/parser/zapkiaexcel.php">Получить прайс Запкиа</a></li>
                            <?php endif?>
                            <?php if(@$_SESSION['role'] == 'saleshead'):?>
                             <li><a style="" href="/admin33338/newuser/">Сотрудники</a></li>
                             <?php endif?>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Отчеты <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/admin33338/report/">Ежедневный отчет</a></li>
                            <li class="divider">
                            <?php if(@$_SESSION['role'] == 'saleshead'):?>
                             <li><a style="" href="/admin33338/report/executiveReport.php">Отчет руководителя</a></li>
                             <?php endif?>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Инструкции и документы <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <!-- <li><a href="/admin33338/constitution/">Конституция</a></li> -->
                            <li class="divider"></li>
                            <li><a href="/admin33338/metodics.php">Методы продаж</a></li>
                            
                            
                        </ul>
                      </li>
                     
                     
                     <?php if(@$_SESSION['type'] == 'admin'):?>
                     <li><a style="" href="/admin33338/editors.php">Отчет по контенту</a></li>
                     <?php endif?>
                         
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
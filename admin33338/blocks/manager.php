</head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                  
                    
                  
          <div class="collapse navbar-collapse" id="navbarToggler">
           <a class="navbar-brand" href="/admin33338/">Ангара админка</a>
                    <ul class="nav navbar-nav mr-auto mt-2 mt-lg-0">
                      <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Отчеты<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item"href="/admin33338/calls/">Отчет по звонкам</a></li>
                        </ul>
                      </li>
                     <li><a class="nav-link" style="color:#18bc9c;" href="#"><?=@$_SESSION['name']?></a></li>
                     <li><a class="nav-link" style="color:#18bc9c;" href="/admin33338/logout.php">Exit</a></li>
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
              </nav>
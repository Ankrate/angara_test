<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/FinanceInsert.php');
$head = new FinanceInsert;
    $comes = $head->companies();
    $prev_month = date("Y-m-d", strtotime('-1 month', strtotime(date('Y-m-d'))));
?>
</head>
<body>

              <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>



          <div class="collapse navbar-collapse" id="navbarToggler">
           <a class="navbar-brand" href="/admin33338/">Ангара админка</a>
                    <ul class="nav navbar-nav mr-auto mt-2 mt-lg-0">
                      <!-- <li ><a href="#">Link <span class="sr-only">(current)</span></a></li> -->
                      <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin tools <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a class="dropdown-item" href="cat.angarasolaris.com/">Работа с каталогом</a></li>
                          <li class="dropdown-divider"></li>
                          <li><a class="dropdown-item"href="/admin33338/linkbuilding/">Перелинковать</a></li>
                           <li class="dropdown-divider"></li>
                          <li><a class="dropdown-item"href="/admin33338/newuser/user.php?action=addnewplan">Планы продаж</a></li>
                          <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/linksplan/insert.php">Вставить план ссылок в базу</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/parser/zapkiaexcel.php" target="_blank">Получить прайс запкиа</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/parser/zaptopexcel.php" target="_blank">Получить прайс заптоп</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/parser/globalavto.php" target="_blank">Получить прайс ГлобалАвто</a></li>
                        </ul>
                      </li>
                      <!-- <li><a href="#">Статьи</a></li> -->
                      <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Работа с контентом <span class="caret"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item"href="/admin33338/editsub.php">Текст подкатегорий</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/editmain.php">Текст главных страниц</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/editor.php">Статьи</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/elfinder/elfinder.html">Работа с картинками</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/imglist/">Картинки которых нет</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/editor_spec.php">Акции</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/elfinder/elfinder.html">Работа с картинками</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/linksplan/">Построение ссылочного</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/newuser/user.php?action=copyinsert&start_date=<?=$prev_month?>">Make a motiv copy</a></li>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Финансы<span class="caret"></span></a>

                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                          <!-- <li><a href="#">Some action</a></li>
                          <li><a href="#">Some other action</a></li>
                          <li class="dropdown-divider"></li>-->
                          <li class="dropdown-submenu">
                            <a class="dropdown-item"tabindex="-1" href="#" class="red"><span class="red">Редактирование Расходов</span></a>
                            <ul class="dropdown-menu">
                              <!-- <li><a tabindex="-1" href="#">Second level</a></li> -->
                              <!-- <li class="dropdown-submenu">
                                <a href="#">Even More..</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">3rd level</a></li>
                                    <li><a href="#">3rd level</a></li>
                                </ul>
                              </li> -->
                              <?php foreach($comes as $comy2):?>
                                <li><a class="dropdown-item"href="/admin33338/insert/expences_insert.php?action=exp_edit&com_id=<?=$comy2['id']?>"><?=$comy2['name']?></a></li>

                                <?php endforeach ?>

                            </ul>
                          </li>
                          <li class="dropdown-divider"></li>
                          <li class="dropdown-submenu">
                            <a class="dropdown-item"tabindex="-1" href="#"><span class="blue">Редактирование Бюджетa</span></a>
                            <ul class="dropdown-menu">

                              <?php foreach($comes as $comy):?>
                                <li><a class="dropdown-item"href="/admin33338/insert/finance_insert.php?action=budget_edit&com_id=<?=$comy['id']?>"><?=$comy['name']?></a></li>

                                <?php endforeach ?>
                              <li class="dropdown-submenu">
                                <a class="dropdown-item"href="#">Even More..</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"href="#">3rd level</a></li>
                                    <li><a class="dropdown-item"href="#">3rd level</a></li>
                                </ul>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Сотрудники <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item"href="/admin33338/newuser/salary_insert.php">Выдача зарплаты</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/motivation.php">Зарплата за прошлые периоды</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/newuser/">Работающие сотрудники</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/newuser/all_personell.php">Уволенные сотрудники</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/personal/" target="_blank">Показатели сотрудников</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/newuser/motivation_print.php">Печать мотивации</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/calls/calls_insert.php">Работа со звонками</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/calls/calls_insert_detaled.php">Работа со звонками2</a></li>
                        </ul>
                      </li>
                       <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Соискатели <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item"href="/admin33338/interviews/index.php">Интерфейс Рекрутера</a></li>


                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Внутренние документы <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item"href="/admin33338/constitution/">Конституция</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/constitution/public_speaking.php">Публичные выступления</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/metodics.php">Методы продаж</a></li>
                            <li class="dropdown-divider"></li>

                            <li><a class="dropdown-item"href="/admin33338/insertpage.php">Работа с базой</a></li>
                            <li class="dropdown-divider"></li>
                            <?php if(@$_SESSION['type'] == 'admin'):?>
                             <li><a class="dropdown-item"style="" href="/admin33338/editors.php">Отчет по контенту</a></li>
                             <li class="dropdown-divider"></li>
                             <li><a class="dropdown-item"style="" href="/admin33338/constitution/pray.php">Pray</a></li>
                             <?php endif?>
                             <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/report/executiveReport.php">Отчет руководителя</a></li>

                            <!--<li class="dropdown-divider"></li>
                            <li><a href="cat.angarasolaris.com/">Работа с каталогом</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a href="/admin33338/elfinder/elfinder.html">Работа с картинками</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a href="/admin33338/insert/">Вставить прайс</a></li> -->

                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Отчеты<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item"href="/admin33338/report/executiveReport.php">Отчет руководителя</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/linksplan/">Построение ссылочного</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/linksplan/linkbuilding_report.php">Отчет по ссылочному</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/report/expenses.php">Расходы за месяц</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item"href="/admin33338/calls/calls_report_by_date.php">Отчет по звонкам по месяцам</a></li>
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

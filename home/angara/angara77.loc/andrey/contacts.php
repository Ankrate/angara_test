<?php
    require_once  $_SERVER['DOCUMENT_ROOT'] . '/include/header1.php';
?>
    <title>Контакты компании Ангара. 97% запчастей на складе готовы к отправке!</title>
    <meta name="description" content="Доставка запчастей на HD78. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?> ">
    <meta name="keywords" content="Запчасти Хендай">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header2.php';?>
            <!-- Header -->
            <?php //include 'include/header3.php';?>
            <!-- /Header -->
            <!-- Begin Body -->
<div class="container">
    <div class="no-gutter row">
            <!-- left side column -->
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/lefttd.php';?>
            <!--/end left column-->
            <!-- right content column-->
            <div class="col-md-9" id="content">
                <div class="panel">
                
                <div class="panel-body">
                  <div class="row">
                  <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                 <a href="<?=ANG_HTTP?>/" itemprop="url"><span itemprop="title">Главная</span></a>
                            </li>
                             
                             <li  class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a  itemprop="url" ></a><span itemprop="title">О компании</span>
                             </li>
                        </ul>
                        <div class="page-text">
                            
                    <div class="vcard panel panel-primary">
                <div class="panel-heading">
                    <h1 class="category panel-title">Контакты компании</h1>
                    <span class="fn org"><strong>OOO "Ангара"</strong></span>
                </div>
                <div class="panel-body cont">
                    <a href="/about/"><h2>Прочитайте о нашей компании здесь</h2></a>
                    <h3>Позвоните</h3>
                    
                    <p>
                        <strong><a href="tel:<?=TELEPHONE_FREE_LINK?>"><?=TELEPHONE_FREE?></a></strong> Ответим на любые вопросы!<br>
                        <strong>или <a href="tel:<?=TELEPHONE_LINK?>"><?=TELEPHONE1?></a></strong>
                        <strong>или <a href="tel:+74956469953"> <?=TELEPHONE_OLD?></a></strong>
                    </p>
                    
                    <!-- <p>
                        <
                    </p> -->
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                    <p>
                        Вы можете купить запчасти по адресу:
                    </p>
                    <address class="adr">
                        <span class="locality">г. Москва</span>

                        <br>
                        <span class="street-address">Соловьиная Роща д.8 корпус 2 офис 9</span>

                        <br>
                        <span class="tel"><abbr title="Phone">tel: </abbr><?=TELEPHONE1?></span>
                    </address>
                    
                   
                        Оставляя на сайте данные, Вы соглашаетесь с <a class="policy" href="../policy.php/">Политикой конфиденциальности</a>
                    
                    <address>
                        <strong>Ответим на любые Ваши вопросы по Email</strong>
                        <br>
                        <a href="mailto:angara77@gmail.com">angara77@gmail.com</a>
                        <div>
                            Мы работаем <span class="workhours">ежедневно <?=WORK_FROM_DAYS?> до <?=WORK_TO_DAYS?></span><br />
                            Суббота и Воскресенье <span class="workhours"> с <?=WORK_FROM_WEEKENDS?> до <?=WORK_TO_WEEKENDS?></span>
                            <span class="url"> <span class="value-title" title="http://angara77.com"> </span> </span>
                        </div>
                        
                    </address>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="embed-responsive embed-responsive-16by9">
                             <iframe width="560" height="315" src="https://www.youtube.com/embed/5NGl374TySQ" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                    </div>
                </div>
            </div> 
            
           <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Наш адрес: ул. Соловьиная Роща д.8 к.2 офис 9 на карте Гугл</h3>
                </div>
                <div class="panel-body">
                    <div id="map-canvas"></div>
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
<?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footer.php';?>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footerjq.php';?>


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7dVZLu07pvlk6hOO5tvU8pGaUqwbyxG8"></script>
<script type="text/javascript" src="/js/googlemap.js"></script>
   
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer3.php';?>



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
            <div class="hidden-xs hidden-sm">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/lefttd.php';?>
            </div>
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
                                  <a  itemprop="url" ></a><span itemprop="title">Контакты</span>
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
                        <p>или звоните на мобильный<strong> <a href="tel:<?=TELEPHONE_MB_LINK?>"> <?=TELEPHONE_MB?></a></strong></p>
                    </p>
                    
                    <!-- <p>
                        <
                    </p> -->
                    
                    <div class="row">
                    	<hr>
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
                        </br>
                            <p>График работы:</p>
                            <span class="workhours">Понедельник - Пятница  c <?=WORK_FROM_DAYS?> до <?=WORK_TO_DAYS?></span><br />
                            Суббота <span class="workhours"> с <?=WORK_FROM_DAYS?> до <?=WORK_TO_WEEKENDS?></span><br />
                            Воскресенье <span class="workhours"> с <?=WORK_FROM_WEEKENDS?> до <?=WORK_TO_WEEKENDS?></span>
                            <span class="url"> <span class="value-title" title="http://angara77.com"> </span> </span>
                        </div>
                        
                    </address>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="embed-responsive embed-responsive-16by9">
                             <a href="/about/"><img width="100%" height="100%"  src="/img/company/command-photo2.jpg" title="Наша команда"></a>
                             
                        </div>
                        <p>Наша команда</p>
                    </div>
                    </div>
                </div>
            </div> 
            
           <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Наш адрес: ул. Соловьиная Роща д.8 к.2 офис 9 на карте Гугл</h3>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d940.6870088332372!2d37.40267952214013!3d55.89140407547924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b5389430b4de03%3A0x9bc8057d70bedbb5!2z0JDQvdCz0LDRgNCwINCX0LDQv9GH0LDRgdGC0Lg!5e0!3m2!1sru!2sru!4v1517403237916" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                <!--
                <div class="panel-body">
                                    <div id="map-canvas"></div>
                                </div>-->
                
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


<!--<script type="text/javascript" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d940.6870088332372!2d37.40267952214013!3d55.89140407547924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b5389430b4de03%3A0x9bc8057d70bedbb5!2z0JDQvdCz0LDRgNCwINCX0LDQv9GH0LDRgdGC0Lg!5e0!3m2!1sru!2sru!4v1517403328159"></script>-->
<script type="text/javascript" src="/js/googlemap.js"></script>
   
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer3.php';?>



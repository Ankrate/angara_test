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
                        <ul class="breadcrumb" style="margin-bottom: 0;">
                            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                 <a href="<?=ANG_HTTP?>/" itemprop="url"><span itemprop="title">Главная</span></a>
                            </li>

                             <li  class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a  itemprop="url" ></a><span itemprop="title">Контакты компании OOO "Ангара"</span>
                             </li>
                        </ul>
                        <div class="page-text">

                    <div class="vcard panel panel-primary">
                	<div class="panel-body cont">

                    <h3>Позвоните - ответим на любые вопросы!</h3>
                    <hr>
                    <p>
                        <p><strong><a href="tel:<?=TELEPHONE_FREE_LINK?>"><?=TELEPHONE_FREE?></a></strong> - Бесплатный звонок из любой точки России</p>

                        <p><strong><a href="tel:<?=TELEPHONE_LINK?>"><?=TELEPHONE1?></a></strong> - Москва и Московская область<br>
                        <strong><a href="tel:+74956469953"> <?=TELEPHONE_OLD?></a></strong></p>
                        <hr>
                        <p><strong> <a href="tel:<?=TELEPHONE_MB_LINK?>"> <?=TELEPHONE_MB?></a></strong> - Если не можете дозвонится со своего оператора связи.</p>

                        <p>
                        	Или
                         <button type="button" class="btn btn-success ang-byu-oneclick b1c" style="padding:2px 10px;"><span><i class="fa fa-mouse-pointer"></i></span>Закажите обратный звонок</button>

                        </p>


                    </p>


                    <div class="row" >
                    	<hr>
                        <div class="col-md-6 col-xs-12" >

                          <div >

                            <br>
                            <p>
                                Вы можете заказать  <a class="policy" href="/delivery"> бесплатную доставку</a>
                            </p>
                            <p>
                                Или купить запчасти по адресу:
                            </p>
                    <address class="adr" style="padding-left: 20px;padding-right: 20px;">
                      <b>
                        <span class="locality">г. Москва</span>
                        <br>
                        <span class="street-address">Соловьиная Роща д.8 корпус 2 офис 9</span>
                      </b>
                    </address>

                  </div>

                    </div>


                    <div class="col-md-6 col-xs-12">

                        <div class="">
                             <img width="100%"  src="/img/company/company-angara2.jpg" title="Наша команда">
                             <br>
                            <a href="/about/"><h2 style="margin-top: 0;">Прочитайте о нашей компании здесь . . .</h2></a>
                        </div>

                    </div>


                  </div>
                  <div class="row">
                    <address>


                      <hr>
                        <strong>Так-же ответим на любые Ваши вопросы по Email</strong>
                        <br>
                        <a href="mailto:angara77@gmail.com">angara77@gmail.com</a>
                        <div>
                        </br>
                            <p>График работы:</p>
                            <span class="workhours">Без выходных, ежедневно  c <?=WORK_FROM_DAYS?> до <?=WORK_TO_DAYS?></span><br />

                            <span class="url"> <span class="value-title" title="http://angara77.com"> </span> </span>
                        </div>

                    </address>
                      Оставляя на сайте данные, Вы соглашаетесь с <a class="policy" href="../policy.php/">Политикой конфиденциальности</a>


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

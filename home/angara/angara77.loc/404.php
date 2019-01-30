<?php
header("HTTP/1.0 404 Not Found");
include 'include/header1.php';
//error_reporting(E_ALL); 
//ini_set("display_errors", 1);
?>
    <title>404 страница. 97% запчастей на складе готовы к отправке!</title>
    <meta name="description" content="Страница не найдена. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?> ">
    <meta name="keywords" content="404">
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
                <div class="panel-heading" style="background-color:#111;color:#fff;">Статьи</div>   
                <div class="panel-body">
                  <div class="row">
                  <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                 <a href="<?=ANG_HTTP?>/" itemprop="url"><span itemprop="title">Главная</span></a>
                            </li>
                            
                             <li class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                 <a itemprop="url"></a><span itemprop="title">Страница не найдена</span>
                            </li>
                        </ul>
                    
                    
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="error-template">
                            <h1> Oops!</h1>
                            <h2> 404 Страница не найдена!</h2>
                            <div class="error-details">
                                
                            </div>
                            <div class="error-actions">
                                <a href="javascript:history.back(1)" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span> Назад </a>
                                <a href="<?=ANG_HTTP?>/" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span> На главную </a><a href="<?=ANG_HTTP?>/contacts/" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-envelope"></span> Контакты </a>
                            </div>
                            <br />
                            <img src="/img/new/articles/1.jpg"  alt="404 page"/>
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
 <script type="text/javascript" src="/catalogue/js/jquery.imagemapster.min.js"></script>
<script type="text/javascript" src="/catalogue/js/script.js"></script>

   
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer3.php';?>



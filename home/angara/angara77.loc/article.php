<?php

    require_once  $_SERVER['DOCUMENT_ROOT'] . '/include/header1.php';
    if (isset($_GET['id'])) {$id = htmlspecialchars($_GET['id']);}
    $obj = new Content();
    $articles = $obj -> get_art($id);


   //p($articles);
?>
    <title><?=$articles[0]['title']?>. 97% запчастей на складе готовы к отправке!</title>
    <meta name="description" content="<?=$articles[0]['meta_d']?> Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?> ">
    <meta name="keywords" content="<?=$articles[0]['meta_k']?>">
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
            <div class="col-md-9 col-sm-12 col-xs-12" id="content">
                <div class="panel">
                <div class="panel-heading" style="background-color:#111;color:#fff;">Статьи</div>
                <div class="panel-body">
                  <div class="row">
                  <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                 <a href="<?=ANG_HTTP?>/" itemprop="url"><span itemprop="title">Главная</span></a>
                            </li>
                             <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a href="/articles/" itemprop="url" ><span itemprop="title">Статьи</span></a>
                             </li>
                             <li  class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a  itemprop="url" ></a><span itemprop="title"><?=$articles[0]['title']?></span>
                             </li>
                        </ul>
                    <h1 class="media-heading"><?=$articles[0]['title']?></h1>

                  </div>
                  </div>

                       <div class=" col-md-12 media art-img">

                      <img class="img-responsive" src="/img/new/articles/<?=$articles[0]['mini_img']?>" alt="<?=$articles[0]['title']?>" title="<?=$articles[0]['title']?>">

                    <div class="col-md-12 col-sm-12 col-xs-12 media-bod">

                      <?=$articles[0]['text']?>
                      <span class="badge"><?=$articles[0]['view']?></span><span class="pull-right"><small><i class="glyphicon glyphicon-alert"></i> Статьи можно тырить только ссылаясь на наш сайт!</small></span>
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

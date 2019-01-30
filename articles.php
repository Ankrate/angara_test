<?php
    require_once  $_SERVER['DOCUMENT_ROOT'] . '/include/header1.php';
    $obj = new Content();
    $articles1 = $obj -> get_art_list('4');
    $articles2 = $obj -> get_art_list(2);
    $articles3 = $obj -> get_art_list(3);
    $all = $obj->get_art_list(100);
    $label = array('label-default','label-primary','label-success','label-info','label-danger','label-warning');
   //p($articles);
?>
    <title>Каталог статей по запчастям на Портер и HD. 97% запчастей на складе готовы к отправке!</title>
    <meta name="description" content="Каталог статей по ремонту и эксплуатации Портер 1 Портер 2 HD 65/72/78/120. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?> ">
    <meta name="keywords" content="запчасти для Хундай Портер1, запчасти для Портер2, запчасти для HD78, запчасти для HD72 запчасти для Starex">
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
                <div class="panel-heading" style="background-color:#111;color:#fff;">Статьи</div>   
                <div class="panel-body">
                  <div class="row">
                  <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                 <a href="<?=ANG_HTTP?>/" itemprop="url"><span itemprop="title">Главная</span></a>
                            </li>
                             <li  class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a  itemprop="url" ></a><span itemprop="title">Статьи</span>
                             </li>
                        </ul>
                    <h1><strong>Статьи, полезные материалы, советы по ремонту.</strong></h1>
                    <ul class="list-inline">
                        <?php foreach($all as $a):?>
                        <?php $k = array_rand($label);
                              $v = $label[$k];?>
                      <li><a href="/article/<?=$a['id']?>/"><span class="label <?=$v?>"><?=$a['title']?></span></a></li>
                      <?php endforeach ?>
                    </ul>
                    
                  </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <?php foreach ($articles1 as $value1) {?>
                       <div class="media">
                    <a class="pull-left" href="/article/<?=$value1['id']?>/">
                      <img width="150" "media-object img-responsive" src="/img/new/articles/<?=$value1['mini_img']?>" alt="<?=$value1['title']?>" title="<?=$value1['title']?>">
                    </a>
                    <div class="media-body">
                      <h5 class="media-heading"><a href="/article/<?=$value1['id']?>/" target="ext" class="pull-right"><i class="glyphicon glyphicon-share"></i></a> <a href="/article/<?=$value1['id']?>/"><strong><?=$value1['title']?></strong></a></h5>
                      <small><?=$obj->cutoff($value1['text'],'100')?></small><br>
                      <span class="badge"><?=$value1['view']?></span>
                    </div>
                  </div>
                  <?php }?>
                  
                   
                    </div>
                  <div class="col-md-8 col-sm-6 col-xs-12"> 
                   <div class="col-md-8">
                    
                      <?php foreach ($articles2 as $value2) {?>
                       
                        <a href="/article/<?=$value2['id']?>/"><img class="img-responsive" src="/img/new/articles/<?=$value2['mini_img']?>" alt="<?=$value2['title']?>" title="<?=$value2['title']?>">
                    <h2><?=$value2['title']?></h2>
                   <?=$obj->cutoff($value2['text'],'400')?>
                    <br><br>
                    <button class="btn btn-default art-butt">Далее...</button></a>
                    <br>
                    <?php }?>
                  </div> 
                  <div class="col col-sm-4">
                     
                     <?php foreach ($articles3 as $value3) {?> 
                    <a href="/article/<?=$value3['id']?>/"><img src="/img/new/articles/<?=$value3['mini_img']?>" class="img-responsive" alt="<?=$value3['title']?>" title="<?=$value3['title']?>">
                    <!-- <div class="text-muted"><small>John Pierce</small></div> -->
                    <h4><?=$value3['title']?></h4>
                    <p><small>
                    <?=$obj->cutoff($value3['text'],'200')?>
                    </small>
                    </p></a>
                    <?php }?>
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



<?php
include 'include/header1.php';
//require_once $_SERVER['DOCUMENT_ROOT'] .'/catalogue/lib/CatCar1.php';

//error_reporting(E_ALL); 
//ini_set("display_errors", 1);
session_start();
$obj = new Content();
$main_prod = $obj->get_main_prod('12');
$object_cat = new CatCar1();
$object_cat->prefix = 'hd';
$object_cat->model = 2;
$data_catalogue = $object_cat->second_query('2');
$arts = $obj->get_art_list('6');
$artsm = $obj->get_art_list('4');
$main_first = $obj->get_main_first('1');
//p($arts);
$car_main = left_side_cat();
$data_description = left_side_car();
//p($data_description);


?>
    <title>Купить запчасти для грузовиков, микроавтобусов и коммерческого транспорта ✰ 97% запчастей на складе </title>
    <meta name="description" content="Запчасти на гузовики, микроавтобусы, коммерческий транспорт и спецтехнику.  ☎ <?=TELEPHONE1?> ">
    <meta name="keywords" content="Запчасти на <?php foreach($data_description as $dd) {echo $dd['fullname']; echo ' '; }?>">
    <meta property="og:title" content="Запчасти для Коммерческого транспорта" />
    <meta property="og:description" content="Купить запчасти для коммерческого транспорта в Москве недорого!" />
    <meta property="og:url" content="http://angara77.com" />
    <meta property="og:image" content="http://angara77.com/img/category/13.jpg" />
    <link rel="shortcut icon" href="http://angara77.com/favicon.ico" type="image/x-icon" />
         
           <?php include 'include/header2.php';?>
            <!-- Header -->
                                                              <!--третий хедер>
            <!-- /Header -->
            <!-- Begin Body -->
           
<div class="container">
	
    <div class="no-gutter row">
            <!-- left side column -->
        <div class="hidden-xs hidden-sm" >
            <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/lefttd.php';?>                                                    <!--тут притягивается левое меню-->
        </div>
            <!--/end left column-->
              <div class="container">
                 <div class="row">
                    <div class="col-md-9 col-lg-9 id=content">
                        <div class="panel">
                            <div>
                                <h1>Запчасти для грузовиков, микроавтобусов и коммерческого транспорта</h1>
                            </div> 
                        </div>
                <div class="row ">
                            <?php// p($data);?>
                            <?php foreach ($data as $line3) {  ?>
                            <?php //p($line3);?>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <div class="thumbnail car-height2">   
                            <a href="/zapchasti-<?=$line3['engname']?>/<?=$line3['id']?>/"><img src="/img/timthumb.php?src=/img/cars/<?=$line3['id']?>.jpg&w=193" class="img-responsive" alt="<?=$line3['title']?>" title="<?=$line3['fullname']?>"></a>
                    
                            <div class="m-price"><?=$line3['fullname']?></div>
                            <!-- here will be category of parts-->
                            <?php
                            foreach($car_main as $category_show){
                            //p($category_show);
                            $k = array_rand($label);
                            $v = $label[$k];
                        ?>
                            <a href="/category-<?=$line3['id']?>-<?=$category_show['id']?>-<?=rus2translit($category_show['ang_category'])?>-<?=$line3['engname']?>/"><span class="label <?=$v?>"><?=$category_show['ang_category']?></span></a>
                        <?php };?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="hidden-xs hidden-sm">   
                    <hr>
                    <hr>
                        <div class="panel">
                            <div class="panel=heading kruglec" style="background:#2C3E50;color:#ffffff;">
                                <h2>&nbspПопулярные товары</h2>
                        </div>
                        </div>
                <div class="row">
                                          <?php foreach ($main_prod as $line) {  ?>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                       
                        <a href="/porter-<?=$line['cat']?>-<?=$line['1c_id']?>/"><img src="/img/timthumb.php?src=/img/parts/<?=get_image($line['1c_id'])?>&w=193" class="img-responsive m-img" alt="<?=$line['ang_name']?>" title="<?=$line['ang_name']?>"></a>
                    
                        <div class="m-price"><?=$line['price']?> рублей</div>
                        <p class="p-main">
                            <?=$obj->cutoff($line['ang_name'],24)?>
                        </p>
                    </div>
                        <?php } ?>
                </div>
                    <div class="panel">
                        <div class="panel=heading kruglec" style="background:#2C3E50;color:#ffffff;">
                                <h2>&nbspСтатьи</h2>
                        </div>
                    </div>
                        <div class="row">
                                    <?php foreach ($arts as $a) {  ?>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="well well-art">
                                            <a href="/article/<?=$a['id']?>/">
                                                <img height="300" src="/img/timthumb.php?src=/img/new/articles/<?=$a['mini_img']?>&w=300" class="img-responsive" alt="<?=$a['title']?>" title="<?=$a['title']?>">
                                                <h3 class="m-art-botth"><?=$a['title']?></h3>
                                                <p>
                                                <?=$obj->cutoff($a['text'],300)?>
                                                </p>
                                                <div class="m-art-bott"><span class="badge pull-right"><?=$a['view']?></span></div>
                                            </a>
                                        </div>
                                    </div>
                            <?php } ?>
                        </div>
                     </div>
                 </div>
            </div> 
        </div>
    </div>
</div><!-- Ends body -->
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footer.php';?>
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footerjq.php';?>
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footer3.php';?>
 <script type="text/javascript" src="//vk.com/js/api/openapi.js?116"></script>
<script type="text/javascript">
                        VK.Widgets.Group("vk_groups", {mode: 0, width: "265", height: "400", color1: 'FFFFFF', color2: '#2C3E50', color3: '#555'}, 95132156);
</script>
<!--This part of code must be enabled in off days and enabled in working days-->
<!-- Modal starts -->
        <!--                 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Режим работы в праздничные дни</h4>
                              </div>
                              <div class="modal-body">
                                <h3><b>Работаем</b> в праздничные дни 6, 7, 8 марта с 10 утра до 17 вечера</h3>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Все понятно, закрыть окно</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                              </div>
                            </div>
                          </div>
                        </div>
                                 Modal ends
                        
                        <script type="text/javascript" src="/js/cookie.js"></script>
                        <script>
                            if (!Cookies.get('popup')) {
                                setTimeout(function() {
                                    $('#myModal').modal();
                                }, 600);
                            }
                            $('#myModal').on('shown.bs.modal', function () {
                                // bootstrap modal callback function
                                // set cookie
                                Cookies.set('popup', 'valid', { expires: 1, path: "/" }); // need to set the path to fix a FF bug
                            })
                        </script> -->

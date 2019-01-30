<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/header1.php';
include $_SERVER['DOCUMENT_ROOT'] . '/catalogue/lib/App.php';
	if (isset($_GET['id'])) {$id = htmlspecialchars($_GET['id']);}
	$app = new App();
    //loading Class by name
    $class = $app->choice_cat($id);
    $object = new $class();
    $car = $object->get_car_name($id);
    $object->prefix = $car[0]['prefix'];
    $object->model = $car[0]['model'];
    $data_catalogue = $object->second_query($id);
    $text = $object->get_main_text($id);
		session_start();
		$_SESSION['catalogue_car'] = $_GET['id'];
		//p($car);
?>
    <title>Каталог на Хендай <?=$car[0]['title']?>  97% запчастей на складе готовы к отправке!</title>
    <meta name="description" content="Каталог на Хундай <?=$car[0]['title']?>. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?> ">
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
                <div class="panel-heading" style="background-color:#111;color:#fff;">Каталог на Хундай <?=$car[0]['title']?></div>
                <div class="panel-body">
                  <div class="row">
                  <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                 <a href="<?=ANG_HTTP?>/" itemprop="url"><span itemprop="title">Главная</span></a>
                            </li>
                            <!-- <li   itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a href="/category-<?=$a?>-<?=$a3?>-<?=rus2translit($bread[0]['ang_category'].' '.$car[0]['title'])?>/"  itemprop="url" ><span itemprop="title"><?=$bread[0]['ang_category']?> <?=$car[0]['title']?></span></a>
                             </li>  -->
                            <li  class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a  itemprop="url" ></a><span itemprop="title">Каталог <?=$car[0]['title']?></span>
                             </li>

                        </ul>
                    <h1><strong>Каталог</strong> на <?=$car[0]['title']?></h1>

                  </div>
                </div>
                <hr>
                <div class="row">
                    <?php foreach ($data_catalogue as $sub) { ?>

                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="well">
                    <a href="/catalog/<?=$sub['0']?>/<?=$car[0]['id']?>/"><img src="/catalogue/<?=$object->prefix?><?=$sub[3]?>" class="img-responsive" alt="<?=$sub[1]?> на <?=$car[0]['title']?>" title="<?=$sub[1]?> на <?=$car[0]['title']?>"></a>
                    </div>
                    <div class="cat-h5">
                    <h5><?=$sub[1]?></h5>
                    </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?=$text[0]['text']?>
                    </div>
                </div>
                  </div><!--/panel-body-->
                </div><!--/panel-->
                <!--/end right column-->
        </div>
    </div>
</div><!-- Ends body -->
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footerjq.php';?>


 <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer3.php';?>

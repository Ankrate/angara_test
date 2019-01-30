<?php
ob_start();
session_start();
include 'include/header1.php';
//error_reporting(E_ALL); 
//ini_set("display_errors", 1);
if (isset($_GET['s'])) {$s = htmlspecialchars($_GET['s']);}
if (isset($_GET['s2'])) {$s2 = htmlspecialchars($_GET['s2']);}
if (isset($_GET['s3'])) {$s3 = htmlspecialchars($_GET['s3']);}
$subcat = left_side_subcat($s2);
$car = get_car_name($s);
$_SESSION['carname'] = $car[0]['id'];
//p($car);
//echo $car[0]['title'];
$bread = get_sub_name($s2);
//p($subcat);
$url = $_SERVER['REQUEST_URI'];

$u = ('/category-' . $s . '-' . $bread[0]['id'] . '-' . rus2translit($bread[0]['ang_category']) . '-' . $car[0]['engname'] . '/');
//echo $url . '<br>';
//echo $u;
if($url != $u){
    // die("<script>location.href = '/404.php'</script>");
} 

foreach($subcat as $check){
    
   
    $dch = check_subcat_emptiness($check['id'], $car[0]['engname']);
    //p($dch);
   $check['ch'] = ($dch);
    //p($check);
    $subcat1[] = $check;
}

//p($subcat1);
$text = get_content_category($s, $bread[0]['id']);
//p($text);

?>
    <title><?=($bread[0]['ang_category'])?> для <?=$car[0]['fullname']?>  купить в Москве недорого, интернет магазин</title>
    <meta name="description" content="<?=($bread[0]['ang_category'])?> для Хундай Портер1 Портер2 HD78 HD72. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?> ">
    <meta name="keywords" content="запчасти для Хундай Портер1, запчасти для Портер2, запчасти для HD78, запчасти для HD72 запчасти для Starex">
<?php include 'include/header2.php';?>
            <!-- Header -->
            <?php //include 'include/header3.php';?>
            <!-- /Header -->
            <!-- Begin Body -->
<div class="container">
    <div class="no-gutter row">
            <!-- left side column -->
            <div class="hidden-xs hidden-sm">
            <?php include 'include/lefttd.php';?>
            </div>
            <!--/end left column-->
            <!--mid column-->
            <!-- right content column-->
            <div class="col-md-9">
                <div class="panel">
                   
                <div class="panel-body">
                  <div class="row">
                  <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                 <a href="<?=ANG_HTTP?>/" itemprop="url"><span itemprop="title">Главная</span></a>
                            </li>
                            <li  itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a href="<?=ANG_HTTP?>/zapchasti-<?=$car[0]['engname']?>/<?=$car[0]['id']?>/" itemprop="url" ><span itemprop="title">Запчасти <?=$car[0]['fullname']?></span></a>
                             </li>                   
                            <li  class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a  itemprop="url" ></a><span itemprop="title"><?=($bread[0]['ang_category'])?> <?=$car[0]['fullname']?></span>
                             </li>
                             
                        </ul>
                    <h1><?=($bread[0]['ang_category'])?> на <?=$car[0]['fullname']?></h1>
                    <!-- 2013 was marked as the year of Responsive Web Design (RWD). The Web is filled with big brands, galleries and magical examples that media queries demonstrate the glory of responsive design.
                    <br><br>
                    <button class="btn btn-default">Далее . . .</button> -->
                  </div>
                </div>
                <hr>
                <div class="row">
                    <?php foreach ($subcat1 as $sub) {
                        if($sub['ch'] == 0){
                            continue;
                        }
                        
                         ?>
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="well">
                    <a href="/subcat-<?=$s?>-<?=$sub['id']?>-<?=$s2?>-<?=rus2translit($sub['ang_subcat']. ' ' .$car[0]['engname'] )?>/">
                        <!-- <img src="/img/timthumb.php?src=/img/category/<?=$sub['id'].'.jpg'?>&w=170" class="img-responsive" alt="<?=$sub['ang_subcat']?> <?=$car[0]['title']?>" title="<?=$sub['ang_subcat']?> <?=$car[0]['title']?>" /> -->
                        
                        
                        <?php if(file_exists(ANG_ROOT . '/img/category/' . strtolower($car[0]['engname']) . $sub['id'] . '.jpg')):?>
                                                                <img alt="<?=$sub['ang_subcat']?> на <?=$car[0]['fullname']?>" title="<?=$sub['ang_subcat']?> на <?=$car[0]['fullname']?>" src="/img/timthumb.php?src=/img/category/<?=strtolower($car[0]['engname'])?><?=$sub['id']?>.jpg&w=170">
                                                            <?php else: ?>
                                                             <img alt="<?=$sub['ang_subcat']?> на <?=$car[0]['fullname']?>" title="<?=$sub['ang_subcat']?> на <?=$car[0]['fullname']?>" src="/img/timthumb.php?src=/img/category/<?=$sub['id']?>.jpg&w=170">
                                                             <?php endif;?> 
                        
                        
                        
                        
                    </a>
                    </div>
                    <h5><?=$sub['ang_subcat']?></h5>
                    </div>
                    <?php } ?>
                </div>
                  <hr>
                  <div class="row">
                  <div class="col-md-12">
                      <?=$text[0]['description']?>
                  </div>
                </div>
                  </div><!--/panel-body-->
                </div><!--/panel-->
                <!--/end right column-->
        </div> 
    </div>
</div><!-- Ends body -->
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footer.php';?>
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footerjq.php';?>
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footer3.php';?>
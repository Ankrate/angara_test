<?php
session_start();
error_reporting(E_ALL); 
ini_set("display_errors", 1);
include 'include/header1.php';
if (isset($_GET['a'])) {$a = htmlspecialchars($_GET['a']);}
if (isset($_GET['a2'])) {$a2 = htmlspecialchars($_GET['a2']);}
if (isset($_GET['a3'])) {$a3 = htmlspecialchars($_GET['a3']);}
if (isset($_GET['a4'])) {$a4 = htmlspecialchars($_GET['a4']);}
$cat_name = get_subcat_name($a3);

$car = get_car_name($a);
//p($car);

$carrus = $car;
if($car[0]['title'] == 'Старекс'){
    $car[0]['title'] ='Starex';
}
$bread = get_sub_name($a3);
$subcategory = get_angara_subcat($a2,$car[0]['engname']);
$sn = get_subcat_name($a2);
//$subcat_weigth = get_subcat_weight(35);
//p($subcat_weigt);
//p($subcategory);
$_SESSION['carname'] = $car[0]['id'];

$obje = new Content();
$desc = $obje->get_descr($a2,$a);
$url = $_SERVER['REQUEST_URI'];
$u = ('/subcat-' . $a . '-' . $sn[0]['id'] . '-' . $bread[0]['id'] . '-' . rus2translit($sn[0]['ang_subcat']) . '-' . $car[0]['engname'] . '/');

//echo $u;
//echo '<br>';
//echo $url;
if($url != $u){
     //die("<script>location.href = '/404.php'</script>");
}
 
?>
    <?php if(isset($desc[0]['title']) and $desc[0]['title'] != NULL) {?>
                    <title><?=$desc[0]['title']?></title>
                    <?php } else { ?>        
                    <title>Купить <?=($sn[0]['ang_subcat'])?> для <?=$carrus[0]['fullname']?> в Москве недорого</title>
                    <?php } ?>
    
    <?php if(isset($desc[0]['meta_d'])) {?>
                    <meta name="description" content="<?=$desc[0]['meta_d']?>">
                    <?php } else { ?>        
                    <meta name="description" content="<?=($sn[0]['ang_subcat'])?> для <?=$carrus[0]['fullname']?>. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?> ">
                    <?php } ?>
                    <?php if(isset($desc[0]['meta_d'])) {?>
                    <meta name="keywords" content="<?=$desc[0]['meta_k']?>">
        <?php } else { ?>
                    <meta name="keywords" content="<?=($sn[0]['ang_subcat'])?> для <?=$carrus[0]['fullname']?>">
         <?php } ?>
         
            
            <meta property="og:title" content="<?=$desc[0]['title']?>" />
            <meta property="og:description" content="<?=($sn[0]['ang_subcat'])?> для <?=$carrus[0]['fullname']?>. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?>" />
            <meta property="og:url" content="http://angara77.com" />
            <meta property="og:image" content="/img/timthumb.php?src=/img/parts/<?=get_image($subcat[0]['1c_id'])?>&w=370" />
            <link rel="shortcut icon" href="http://angara77.com/favicon.ico" type="image/x-icon" />
            <link href="/css/styles.css" rel="stylesheet">
         
         
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
                                  <a href="<?=ANG_HTTP?>/zapchasti-<?=$car[0]['engname']?>/<?=$car[0]['id']?>/" itemprop="url" ><span itemprop="title">Запчасти <?=$carrus[0]['fullname']?></span></a>
                             </li>
                            <li   itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a href="/category-<?=$a?>-<?=$a3?>-<?=rus2translit($bread[0]['ang_category'].' '.$carrus[0]['engname'])?>/"  itemprop="url" ><span itemprop="title"><?=$bread[0]['ang_category']?> <?=$carrus[0]['title']?></span></a>
                             </li>                  
                            <li  class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a  itemprop="url" ></a><span itemprop="title"><?=$sn[0]['ang_subcat']?> <?=$carrus[0]['fullname']?></span>
                             </li>
                        </ul>
                    <div class="row">    
                         <?php if(isset($desc[0]['h1']) && $desc[0]['h1'] != NULL ) {?>
                    <h1 class="h1-margin"><?=$desc[0]['h1']?></h1>
                    <?php } else { ?>        
                    <h1 class="h1-margin"><?=$sn[0]['ang_subcat']?> на <?=$carrus[0]['title']?></h1>
                    <?php } ?> 
                   
                     <?php if(isset($desc[0]['description'])){?>
                         <?php if($desc[0]['img']):?>
                             
                             <img width="200" class="img-responsive art-img" src="/img/timthumb.php?src=/img/new/articles/<?=$desc[0]['img']?>&w=300" alt="<?=$desc[0]['h1']?>" title="<?=$desc[0]['h1']?>" />
                         <?php endif ?>
                    <noindex><p class="car-name-mar"><?=$obje->cutoff($desc[0]['description'],700)?></p></noindex>
                    <br>
                    <noindex><a href="#more" >  <button class="btn btn-default">Читать статью . . .</button></a></noindex>
                    <?php }?>
                  </div>
                </div>
                </div>
                 <div class="row padding-10">
                 	
                 
                 	 
                <?php foreach($subcategory as $sub_name2=>$subcat2):?>
                    <?php $short_full_name2 = explode('-', $sub_name2);?>
                    <?php if(empty($subcat2)){
                        continue;
                    }
                    
                        $hash = array_rand($obje->colors);
                        $h = $obje->colors[$hash];
                        //p($h);
                    ?>
               <a href='#<?=$sub_name2?>' class='hashtag'> <span><span style="font-weight: bold; color:<?=$h?>">#<?=$short_full_name2[0]?></span>&nbsp&nbsp&nbsp&nbsp </span></a>
                
                <?php endforeach ?>
                
                
                </div>
                <br>
                </div>
                
                <?php foreach($subcategory as $sub_name=>$subcat):?>
                    <?php
                    
                    $short_full_name=explode('-', $sub_name);?>
                    <?php if(empty($subcat)){
                        continue;
                    };?>
                    
                   
                    <span id="<?=$sub_name?>" class="sub-sub-text"><?=mb_ucfirst($short_full_name[0],'UTF-8') ?></span>
                     <hr id='subcat-row'>
                    <!-- <div class="spacer-10"></div> -->
                <div class="row">
                    
                       
                        <?php foreach ($subcat as $sub) {
                        
                        //p($sub);
                         ?>
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="subcat-well">
                    <a href="/porter-<?=good_cat($sub['cat'])?>-<?=$sub['1c_id']?>/"><img src="/img/timthumb.php?src=/img/parts/<?=get_image($sub['1c_id'])?>&w=220" class="img-responsive" alt="<?=cut_part_title($sub['ang_name'])?>" title="<?=cut_part_title($sub['ang_name'])?>" /></a>
                    </div>
                    <div class="subcat-h5" id="small-sub">
                    <h5><?=cut_part_title($sub['ang_name'])?></h5>
                    <?php if($sub['price'] ==0){?>
                    <h6><strong>Уточняйте цену у менеджера</strong></h6>
                    <?php }else{ ?>
                        <h6><strong><?=$sub['price']?></strong> рублей</h6>
                        <?php }?>
                    
                    </div>
                    </div>
                     
                    <?php } ?>
                   
                    
                </div>
                
                <?php endforeach?>
                  <hr>
                  <div class="row">
                  <div id="more" class="col-md-12">
                    <!-- <?php if(isset($desc[0]['title'])) {?>
                    <h2><strong><?=$desc[0]['title']?></strong> на Хендай <?=$car[0]['title']?></h2>
                    <?php } else { ?>        
                    <h2><strong><?=$sn[0]['ang_subcat']?></strong> на Хендай <?=$car[0]['title']?></h2>
                    <?php } ?> -->
                    <?php if(isset($desc[0]['description'])){?>
                    <?=$desc[0]['description']?>
                    <?php }?>
                    
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
 <script>
 
 </script>
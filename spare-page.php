<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1);
//session_start();
include 'include/header1.php';
if (isset($_GET['search'])) {$search = htmlspecialchars($_GET['search']);}
if (isset($_GET['search1'])) {$search1 = htmlspecialchars($_GET['search1']);}
if (isset($_GET['query'])) {$query = htmlspecialchars($_GET['query']);}
//$ip = $_SERVER['REMOTE_ADDR'];




//p($query);
$data7 = get_spare($query,5);
//p($data7);
$data_search = get_spare_angara($query);
$cat_search=get_subcat_spare_angara($query);
$car_spare_search=get_spare_car_angara($query);
//p($cat_search);
//p($_SESSION);
/*
if (!empty($search1)) {
    $ac = get_ac($search1);
    insert_search_ac($ac[0][1],$ip);
    header ('Location: /porter'."-".good_cat($ac[0][0]) ."-".$search1."/");
} else {
	$data_search = get_search($search, $ip);
    insert_search_ac($search,$ip);
    }
 * 
 */
//p($data_search);
$rand = explode(' ', $query);
$len = strlen($query);
$end = end($rand);
$end = str_replace('/','',$end);
$end = preg_replace('/[0-9]/', '', $end);
//echo $end;
$carname = get_car_name_angara2($end);
if(empty($carname)){
	$carname = get_car_name_angara2("porter");
}else{;

}
$carid = $carname[0]['id'];
$carname = $carid;
//p($carname);
if(isset($carid)){
$cars = get_car_name($carid);
}else{
$cars = get_car_name(1);
}
//p($cars);

?>
    <title>Купить <?=$data7[0]['search_q']?> недорого в Москве с Гарантией Качества # <?=$data7[0]['id'].$len.' '. $rand[0].' '.$end?>.</title>
    <meta name="description" content="Продажа <?=$data7[0]['search_q']?> Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1?> Номер <?=$data7[0]['id'].$len.' '.$rand[0].' '.$end?> ">
    <meta name="keywords" content="<?=$data7[0]['search_q']?>">
    
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
            <!-- right content column-->
            <div class="col-md-9" id="content">
                <div class="panel">
                <div class="panel-heading" style="background-color:#111;color:#fff;">Поиск запчасти</div>   
                <div class="panel-body">
                  <div class="row">
                  <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                 <a href="<?=ANG_HTTP?>/" itemprop="url"><span itemprop="title">Главная</span></a>
                            </li>
                            <li class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                 <a href="<?=ANG_HTTP?>/" itemprop="url"></a><span itemprop="title"><?=$data7[0]['search_q']?></span>
                            </li>
                             
                        </ul>
                    <h1>Купить <?=$data7[0]['search_q']?> дешево в интернет магазине. Только сертифицированные запчасти! #<?=$data7[0]['id'].$len.' '. $rand[0].' '.$end?></h1>
                    <div class="spacer"></div>
                        <?php if(!$data_search): ?>
                            <h4>Нет результатов</h4>
                        <?php endif?>
                    
                  </div>
                </div>
                <div class="row">
                	<div class="col-md-12"><h3>Категории:</h3>
                		<hr>
                	</div>
                	<?php foreach($car_spare_search as $key => $car){?>
                		<div class="row" style="margin:0;"> 
                			<p><?=$car['fullname']?></p>
                	<?php foreach ($cat_search as $sub) {
                        if(isset($sub['ang_subcat'])){
						
                        ?>
                       	
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="well">
                    <a class="subcat-bottom" href="/subcat-<?=$car['id']?>-<?=$sub['id']?>-<?=$sub['parent']?>-<?=rus2translit($sub['ang_subcat'])?>-<?=$car['engname']?>/"> <?=$sub['ang_subcat']?> на <?=$car['fullname']?>
                        <?php if(file_exists(ANG_ROOT . '/img/category/' . strtolower($car['engname']) . $sub['id'] . '.jpg')):?>
                                                                <img alt="<?=$sub['ang_subcat']?> на <?=$car['fullname']?>" title="<?=$sub['ang_subcat']?> на <?=$car['fullname']?>" src="/img/timthumb.php?src=/img/category/<?=strtolower($car['engname'])?><?=$sub['id']?>.jpg&w=170">
                                                            <?php else: ?>
                                                             <img alt="<?=$sub['ang_subcat']?> на <?=$car['fullname']?>" title="<?=$sub['ang_subcat']?> на <?=$car['fullname']?>" src="/img/timthumb.php?src=/img/category/<?=$sub['id']?>.jpg&w=170">
                                                             <?php endif;?> 
                        
                        
                        
                        
                    </a>
                    </div>
                    
                    </div>
                    <?php } ?>
                    <?php } ?>
                    </div>
                    <?php } ?>
                </div>
                
                <div class="row">
                	<div class="col-md-12"><h3>Запчасти:</h3>
                		<hr>
                	</div>
                	 
                	
                	  
                	
                    
                
                
                
                
                
                
                
                    <?php foreach ($data_search as $sub) { ?>
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="well">
                    <a href="/porter-<?=good_cat($sub['cat'])?>-<?=$sub['1c_id']?>/"><img src="/img/parts/<?=@get_image($sub['1c_id'])?>" class="img-responsive"></a>
                    
                    </div>
                    <div class="subcat-h5">
                    <h5><?=cut_part_title($sub['ang_name'])?></h5>
                    <h6><strong><?=$sub['price']?></strong> рублей</h6>
                    </div>
                    </div>
                    <?php } ?>
                </div>
                 <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                         <h3>Пожожие запросы</h3>
                    <?php foreach ($data7 as $q7) { ?>
                    
                      <?php $myurl = mb_strtolower($q7['search_q']);
                      $myurl = trim($myurl);
                      ?>
                       
                    <a class="spare-link" href="/spare-page.php?query=<?=white_replacer($myurl)?>/" ><?=trim($q7['search_q'])?></a><br>
                    
                    
                    <?php } ?>
                  </div>
                </div>
                
                <?php if($carid){ ?>
                <div class="row caption-full">
                        <div class="col-md-12 text-center">
                                <h4>Каталог на <?=$cars[0]['engname']?></h4>
                        </div>
                        <ul>
                        <?php $category = get_category_bottom();
                        //p($category);
                        if(isset($carname)){
                        foreach($category as $catt): ?>
                        
                        <li class="cat-bottom"><a href="/category-<?=$carname?>-<?=$catt['id']?>-<?=rus2translit($catt['ang_category'])?>-<?=$cars[0]['engname']?>/"><!-- <img alt="<?=$catt['ang_category']?> на <?=$cars[0]['fullname']?>" title="<?=$catt['ang_category']?> на <?=$cars[0]['fullname']?>" src="/img/categories/<?=$cars[0]['engname']?><?=$catt['id']?>.jpg"> --><?=$catt['ang_category']?></a></li>
                            <?php
                            $subcategory = get_subcategory_bottom($catt['id']);
                             foreach($subcategory as $subcatt):?>
                             <?php if (check_subcat_emptiness($subcatt['id'],$cars[0]['engname']) == 0){
                                                 continue;
                                             }?>
                                <a class="subcat-bottom" href="/subcat-<?=$carname?>-<?=$subcatt['id']?>-<?=$subcatt['parent']?>-<?=rus2translit($subcatt['ang_subcat'])?>-<?=$cars[0]['engname']?>/"><?=$subcatt['ang_subcat']?></a>
                            <?php endforeach ?>
                            
                        <?php endforeach ?>
                        <?php } ?>
                        
                        
                     </ul>    
                    </div>
                    <?php };?> 
               
                 
                  
                  
                  </div><!--/panel-body-->
                </div><!--/panel-->
                <!--/end right column-->
        </div> 
    </div>
</div><!-- Ends body -->
<?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footer.php';?>
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footerjq.php';?>
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footer3.php';?>
<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

session_start();
$_SESSION['carname']=$_GET['cmn'];
include 'include/header1.php';

if (isset($_GET['search'])) {$search = trim(strtoupper(htmlspecialchars($_GET['search'])));
}
if (isset($_GET['search1'])) {$search1 = strtoupper(htmlspecialchars($_GET['search1']));
}
if (isset($_GET['search2'])) {$search2 = strtoupper(htmlspecialchars($_GET['search2']));
}
$ip = $_SERVER['REMOTE_ADDR'];

$search=str_replace(".","",$search);
$search=str_replace("/","",$search);
$search=str_replace("-","",$search);
//p($search);
$check = preg_match("#^(\d+)#u", $search);
//echo $check;
//p($_SESSION);

// начинаю поиск , проверяю номер ли это, если номер, то делаю прямой запрос поиска по двум полям cat, ang_name
//если не номер то делаем поиск по базе LIKE

if($check == 1){
        $data_search_new = get_search2_all($search, $ip);
        insert_search_ac($search, $ip);
}else{

            $mo = phpMorphytest($search);
           // p($mo);
            $i = 0;
                foreach ($mo as $keym=> $valuem) {

                //p($valuem[0]);
                    $i++;
                    if($valuem[0] == 'НА' || $valuem[0] == 'ДЛЯ' || $valuem[0] == 'И' || $valuem[0] == ''){
                        $i = $i-1;
                        continue;
                        }
                $sa[] = $valuem[0];
                }
        //echo $i;
        if($i == 0){
                        $sa[] = NULL;
        }
        //p($sa);

        @$carname = get_car_name($_GET['cmn'])[0]['engname'];






        if(search_cars_in_query($sa) == FALSE){
            //echo 'false<br>';
        }

    //Если есть сесиия с машиной, то ищем в машине
        if(!isset($_SESSION['carname']) OR search_cars_in_query($sa) == TRUE){

             //echo 'Im in not car';
            //p($carname);
             if($i>7){
                 $sa = array_slice($sa,0,6);
                 $data_search_new = get_search_three($sa[0], $sa[1], $sa[2],  $carname);
                    insert_search_ac($search, $ip);

                }
             switch($i){
                    case 0;
                    $data_search_new = NULL;
                    break;
                    case 1:
                    $data_search_new = get_search_one_nocar($sa[0]);
                    insert_search_ac($search, $ip);
                        break;
                    case 2:
                    $data_search_new = get_search_two_nocar($sa[0], $sa[1]);
                    insert_search_ac($search, $ip);
                    break;
                    case 3:
                    $data_search_new = get_search_three_nocar($sa[0], $sa[1], $sa[2]);
                    insert_search_ac($search, $ip);
                    break;
                    case 4:
                    $data_search_new = get_search_four_nocar($sa[0], $sa[1], $sa[2], $sa[3]);
                    insert_search_ac($search, $ip);
                    break;
                    case 5:
                    $data_search_new = get_search_five_nocar($sa[0], $sa[1], $sa[2], $sa[3], $sa[4]);
                    insert_search_ac($search, $ip);
                    break;
                    case 6:
                    $data_search_new = get_search_six_nocar($sa[0], $sa[1], $sa[2], $sa[3], $sa[4], $sa[5]);
                    insert_search_ac($search, $ip);
                    break;
                    case 7:
                    $data_search_new = get_search_seven_nocar($sa[0], $sa[1], $sa[2], $sa[3], $sa[4], $sa[5], $sa[6]);
                    insert_search_ac($search, $ip);
                    break;

                } // end of switc case



        }else{ // if there is no car session
        //echo 'Im in car';
        if($i>7){

            $sa = array_slice($sa,0,7);
            $data_search_new = get_search_three_nocar($sa[0], $sa[1], $sa[2]);
            insert_search_ac($search, $ip);

                }
                switch($i){
                    case 0:
                    $data_search_new = NULL;
                    break;
                    case 1:
                      //echo($sa[0]);
                    $data_search_new = get_search_one($sa[0], $carname);
                    insert_search_ac($search, $ip);
                        break;
                    case 2:
                    $data_search_new = get_search_two($sa[0], $sa[1], $carname);
                    insert_search_ac($search, $ip);
                    break;
                    case 3:
                    $data_search_new = get_search_three($sa[0], $sa[1], $sa[2],  $carname);
                    insert_search_ac($search, $ip);
                    break;
                    case 4:
                    $data_search_new = get_search_four($sa[0], $sa[1], $sa[2], $sa[3],  $carname);
                    insert_search_ac($search, $ip);
                    break;
                    case 5:
                    $data_search_new = get_search_five($sa[0], $sa[1], $sa[2], $sa[3], $sa[4],  $carname);
                    insert_search_ac($search, $ip);
                    break;
                    case 6:
                    $data_search_new = get_search_six($sa[0], $sa[1], $sa[2], $sa[3], $sa[4], $sa[5],  $carname);
                    insert_search_ac($search, $ip);
                    break;
                    case 7:
                    $data_search_new = get_search_seven($sa[0], $sa[1], $sa[2], $sa[3], $sa[4], $sa[5], $sa[6],  $carname);
                    insert_search_ac($search, $ip);
                    break;
                } // end of switc case

                } //end of esle no session
} // end of not numeric search


?>
    <title>Поискзапчас тей. 97% запчастей на складе готовы к отправке!</title>
    <meta name="description" content="Поиск №1 по продаже запчастей для Хундай Портер1 Портер2 HD78 HD72. Всегда 97% запчастей в наличии на складе. ☎ <?=TELEPHONE1 ?> ">
    <meta name="keywords" content="запчасти для Хундай Портер1, запчасти для Портер2, запчасти для HD78, запчасти для HD72 запчасти для Starex">
    <meta name="robots" content="noindex">
<?php
        include 'include/header2.php';
    ?>
            <!-- Header -->
            <?php //include 'include/header3.php'; ?>
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
                                 <a href="<?=ANG_HTTP ?>/" itemprop="url"><span itemprop="title">Главная</span></a>
                            </li>
                            <li class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                 <a href="<?=ANG_HTTP ?>/" itemprop="url"></a><span itemprop="title">Поиск</span>
                            </li>

                        </ul>
                    <h1><strong>Результаты поиска</strong></h1>
                        <?php if(!$data_search_new || $data_search_new == NULL): ?>
                            <h4>Нет результатов</h4>

                    <?php endif ?>
                  </div>
                </div>

                <div class="row">
                    <?php if(isset( $data_search_new) || $data_search_new != NULL): ?>

                    <?php foreach ($data_search_new as $sub) { ?>
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="well min-height-search">
                    <a href="/porter-<?=good_cat($sub['cat']) ?>-<?=$sub['1c_id'] ?>/"><img src="/img/parts/<?=get_image($sub['1c_id']) ?>" class="img-responsive"></a>
                    </div>
                    <div class="subcat-h5">
                    <h5><?=cut_part_title($sub['ang_name']) ?></h5>
                    <?php if($sub['price'] == 0):?>
                        <h6><strong>Уточняйте цену у менеджера</strong></h6>
                        <?php else :?>
                        <h6><strong><?=$sub['price'] ?></strong> рублей</h6>
                        <?php endif ;?>

                    </div>
                    </div>
                    <?php } ?>
                </div>
                 <?php endif ;?>


                  </div><!--/panel-body-->
                </div><!--/panel-->
                <!--/end right column-->
        </div>
    </div>
</div><!-- Ends body -->
<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php';
?>
 <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/include/footerjq.php';
?>
 <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/include/footer3.php';
?>

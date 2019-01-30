<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//echo $_SESSION['type'];
if(!isset($_SESSION['name']) ) {
    header('location: /admin33338/');
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
require_once( dirname( __FILE__ ) . '/../lib/AdvigatelConnection.php' );
require_once( dirname( __FILE__ ) . '/../lib/Allegro.php' );
//p($_GET);
@$sort = $_GET['sort'];
$zloty = 15.37;
$obj = new Allegro;
$obj->eng_part = 'silnik ';
$obj->eng_model = 'AEX';
//$obj->eng_year = '3.0';
$result = $obj -> get_eng_model();

//p($result);

foreach($result as $key1=>$value1){
    $pr[$key1] = $value1['price'];
    
}
//p($pr);

@array_multisort($pr, SORT_NUMERIC, $result);
//p($result); 

  

?>

<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
    
    
    <!-- Pe chart revenue per manager -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <span>Найдено позиций:
            <?php
            
            echo count($result);
            ?>
            </span>
        </div>
        <div class="col-md-4">
            <span>Средняя цена: <?php
            $sum = 0;
            foreach($result as $val){
                $sum += $val['price'];
            }
            $avg = number_format(round($zloty * $sum / count($result)));
           //p($result);
            echo $avg;
            echo ' руб.';
          
            
             ?></span>
        </div>
        <div class="col-md-4">
            <span>Минимальная цена:
            <?php
            $min_arr = min($result);
            $min = number_format(round($min_arr['price'] * $zloty));
            echo $min;
            echo ' руб.';
            ?>
            </span>
        </div>
        
    </div>
    
    
    <div class="row"><!-- Big row -->
                <div class="col-md-12">
                <table class="table table-bordered adm-level">
                    <caption class="text-left">Angara77</caption>
                        <thead>
                            <tr>
                                <th>Двигатель</th>
                                <th><a href="?sort=price">Цена</a></th>
                                <th>Сыылка Алегро</th>
                                <th>Фото</th>
                                
                            </tr>
                        </thead>
                
                        <tbody>
                            <?php foreach($result as $k=>$val):?>
                               <?php $decode = json_decode($val['images']); ?> 
                            <tr class="<?php if(date('Y-m',strtotime($b_adv['date'])) == date('Y-m')){ echo 'val-green';}?>">
                                <td><?=$val['title']?></td>
                                <td><?=number_format(round($val['price'] * $zloty, 0))?> руб</td>
                                <td><a href="http://allegro.pl/show_item.php?item=<?=$val['id_offers']?>">Посмотреть на Аллегро</a></td>
                                <td>
                                    <div class="row">
                                    <?php foreach($decode as $img):?>
                            
                                <div class="col-md-2"><img class="img-responsive" src="<?=$img?>" height="70" width="70"  /></div>
                                
                                 <?php endforeach ?>
                                 </div>
                                 </td>
                            </tr>
                            <?php endforeach?>
                            
                        </tbody>
                    </table>
                    
        </div>
                
    </div> <!-- Big row end -->
</div>
</body>
</html>






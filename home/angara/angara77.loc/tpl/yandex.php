<?php
ini_set('max_execution_time', 300);
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
$base = dirname(dirname(__FILE__));
include_once ($base . '/config.php');
/*
define('ANG_HOST', 'u66745.mysql.masterhost.ru');
define('ANG_DBNAME', 'u66745_porter');
define('ANG_DBUSER', 'u66745');
define('ANG_DBPASS', 'con9entiotai');
define('ROOT_PATH', '/home/u66745/angara77.com/www/');

define('ANG_HOST', 'localhost');
define('ANG_DBNAME', 'u66745_porter');
define('ANG_DBUSER', 'root');
define('ANG_DBPASS', 'manhee33338');
 */
define('ROOT_PATH', '/home/u66745/angara77.com/www/');



function db() {

    try {
        $dsn = 'mysql:dbname=' . ANG_DBNAME . ';host=' . ANG_HOST;
        $pdo = new PDO($dsn, ANG_DBUSER, ANG_DBPASS);
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo -> exec("set names utf8");

    } catch(PDOException $e) {
        echo $e -> getMessage();
    }
    return $pdo;
}
function get_yandex_car() {
    $m = db();
    $q = 'SELECT * FROM ang_cars';
    $t = $m -> prepare($q);
    $t -> execute(array());
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}


function get_yandex() {
    $m = db();
    $car1="%porter%";
    $car2="%starex%";
    $car3="%ducato%";
    $car4="%hd%";
        $q = 'SELECT *
        FROM angara
        WHERE (ang_name LIKE "' . $car1 . '" OR nal>0)';
        //OR ang_name LIKE "' . $car2 . '"
   // $q = 'SELECT * FROM angara WHERE ang_name LIKE ?';

    $t = $m -> prepare($q);

    $t -> execute();
    //array('%' . $carname_for_yandex . '%')
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function get_yandex_subcategory() {
    $m = db();
    $q = 'SELECT * FROM ang_subcategories';
    $t = $m -> prepare($q);
    $t -> execute(array());
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}
function get_image($id) {
    $f = '';
    $dir = ROOT_PATH . "/img/parts/";
    $pattern = strtolower($dir . '*-' . $id . '\.{jpg,png,gif}');
    foreach (glob($pattern, GLOB_BRACE) as $filename) {
        $end = explode('/', $filename);
        $file = (end($end));
        //$f = $file;
    }
    if (isset($file)) {
        //echo $file;
        return $file;
    } else {
        //$file = 'default.png';
        return FALSE;
    }

}//Конец функции
function good_cat($cat){
    //echo $cat;
     $cat = preg_replace('/[^\w0-9]+/u', '', $cat);
     return $cat;
}



# Настройки MySQL

$products = get_yandex();
$subcat = get_yandex_subcategory();
# URL магазина
$site = "http://angara77.com/";

# Название магазина
$name = "Ангара";

# Описание магазина
$desc = "Запчасти для грузовиков и автобусов";

# Валюта
$curr = "RUR";
# Стоимость доставки
$cost = "290";
//$db = new mysqli($host, $user, $pass, $db);
//$db->set_charset('utf-8');
header('Content-type: application/xml');
header("Content-Type: text/xml; charset=utf-8");
$cdate = date("Y-m-d H:i",time());

$out = <<<HTML
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="{$cdate}">
<shop>
<name>{$name}</name>
<company>{$desc}</company>
<url>{$site}</url>

<currencies>
    <currency id="RUR" rate="1"/>
</currencies>
<categories>
HTML;

foreach($subcat as $sc){
    $out .= <<<HTML
<category id="{$sc['id']}">{$sc['ang_subcat']}</category>
HTML;
}
$out .= <<<HTML
</categories>
<offers>
HTML;
//$products = $db->query("SELECT * FROM angara")->fetch_assoc();
//p($products);
foreach($products as $val) {
    if((int) $val['price'] == 0 OR (int) $val['parent'] == 0) continue;
    //$name = htmlspecialchars(mb_strtolower($val['ang_name'], 'UTF-8'));
    $name = htmlspecialchars($val['ang_name']);
    if(preg_match('/уценка/ui',$name) OR preg_match('/кур/ui',$name)) continue;
    if(preg_match('/\sбу\s/ui',$name) OR preg_match('/\sБУ\s/ui',$name)) continue;
    if(preg_match('/\sб\/у\s/ui',$name) OR preg_match('/\sБ\/У\s/ui',$name)) continue;
    if (preg_match('/восстанов/ui', $name) OR preg_match('/востанов/ui', $name))
        continue;


    //$desc = htmlspecialchars($val['description']);
    $val['brand']= preg_replace("/[^ \w]+/", "", $val['brand']);
    $picture = get_image($val['1c_id']);
    if($picture == FALSE){
        continue;
    }
    $cat = good_cat($val['cat']);
    $out .= <<<HTML
    <offer id="$val[id]" available="true" bid="1" fee="100">
      <url>{$site}porter-{$cat}-{$val['1c_id']}/</url>
      <price>{$val[price]}</price>
      <currencyId>{$curr}</currencyId>
      <categoryId>{$val['parent']}</categoryId>
      <picture>http://angara77.com/img/parts/{$picture}</picture>
      <vendor>{$val['brand']}</vendor>
      <model>{$val['car']}</model>
      <vendorCode>{$val['cat']}</vendorCode>
      <name>{$name}</name>
      <local_delivery_cost>{$cost}</local_delivery_cost>
      <sales_notes>Минимальная сумма заказа - 100 рублей.</sales_notes>
      <description>{$name} от производителя {$val['brand']} для автомобиля {$val['car']} . На все запчасти есть сертификат соответсвия.</description>
    </offer>
HTML;
}

$out .= "</offers></shop></yml_catalog>";
if(file_put_contents(ROOT_PATH ."/public/yandex.xml", $out)){
//echo 'Good job!';
echo $out;
}

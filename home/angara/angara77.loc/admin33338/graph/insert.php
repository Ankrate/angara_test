<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1);
//include_once ('lock.php');

define('ANG_HOST', 'u66745.mysql.masterhost.ru');
define('ANG_DBNAME', 'u66745_porter');
define('ANG_DBUSER', 'u66745');
define('ANG_DBPASS', 'PigU6n4_.G');
define('ROOT_PATH', '/home/u66745/angara77.com/www/');

/*
define('ANG_HOST', 'localhost');
define('ANG_DBNAME', 'u66745_porter');
define('ANG_DBUSER', 'root');
define('ANG_DBPASS', 'manhee33338');
define('ROOT_PATH', '/home/manhee/sites/angara77.loc/');
 */


$count_car = count_items_car(); //count items in pricelist
$count_subcats = count_subcats();
$count_articles = count_articles();
$count_img = count_img();

foreach($count_car as $k => $a){
    $array = array($a);
    $arrays[$k] = $array;
}
foreach($count_subcats as $key=>$ar){
            
            array_push($arrays[$key] , $ar);
        }
foreach($count_articles as $kei=>$f){
            
            array_push($arrays[$kei] , $f);
        }
foreach($count_img as $kei1=>$f1){
            
            array_push($arrays[$kei1] , $f1);
        }

//p($arrays);
if(adm_insert_graph($arrays)) {
    echo 'Good job!';
}else{
echo 'Fuck you!';
}


function p($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}//Конец функции

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

//index adm functions
function all_cars() {
    $m = db();
    $q = "SELECT * FROM ang_cars";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function count_items_car(){
    $m = db();
    $cars = all_cars();
   // p($cars);
    foreach($cars as $car){
    $q = "SELECT id FROM angara WHERE ang_name LIKE '%" . $car['engname'] . "%'";
    $t = $m -> prepare($q);
    $t -> execute();
    $count[$car['id']] = $t ->rowCount();
     
    }
    return $count; 
}
function count_subcats(){
    $m = db();
    $cars = all_cars();
   // p($cars);
    foreach($cars as $car){
    $q = "SELECT id FROM content_description WHERE car LIKE '%" . $car['id'] . "%'";
    $t = $m -> prepare($q);
    $t -> execute();
    $count[$car['id']] = $t ->rowCount();
     
    }
    return $count; 
}
function count_articles(){
    $m = db();
    $cars = all_cars();
   // p($cars);
    foreach($cars as $car){
    $q = "SELECT id FROM data WHERE car LIKE '%" . $car['id'] . "%'";
    $t = $m -> prepare($q);
    $t -> execute();
    $count[$car['id']] = $t ->rowCount();
     
    }
    return $count; 
}
function percent($x,$def){
    $data = round($x * 100 / $def);
    return $data;
}

function count_img() {
    $cars = all_cars();
    //p($cars);
    $f = '';
    $dir = ROOT_PATH . "/img/parts/";
    foreach($cars as $key => $car){
        $c = f($car['engname']);
            $finarray[$car['id']] = $c;
    }
    return $finarray;
}

function f($car){
        $car = strtolower($car);
        $f = '';
        $dir = ROOT_PATH . "img/parts/";
        $pattern = strtolower($dir . '*' . $car . '-*\.{jpg,png,gif}');
            foreach (glob($pattern, GLOB_BRACE) as $filename) {
                $end = explode('/', $filename);
                $file = end($end);
                $array[] = $file;
                //p($file);
              }
            return (@count($array));
}

function adm_insert_graph($arrays){
    $m = db();
    
    $arr = array();
    foreach($arrays as $array){
    foreach($array as $id => $value){
      @$arr[$id] += $value;  
    }
    
}
    $che = check_date();
    if($che){
        $q = "UPDATE admin_chart SET  photos = :photos, subcats = :subcats, articles = :articles WHERE id = {$che}";
        $t = $m -> prepare($q);
        if($t -> execute(array(':photos' => $arr[3], ':subcats' => $arr[1], ':articles' => $arr[2]))){
            //echo 'update';
            return TRUE;
        }
        
    }else{
    $date = date('Y-m-d');
    echo $date;
        $q = 'INSERT INTO admin_chart (chart_date, photos, subcats, articles) VALUES (:date, :photos, :subcats, :articles)';
        $t = $m -> prepare($q);
        if($t -> execute(array(':date' => $date, ':photos' => $arr[3], ':subcats' => $arr[1], ':articles' => $arr[2]))){
          //echo 'insert';  
        }
    return TRUE;
    }
}
function check_date(){
    $m = db();
    $date = date('Y-m-d');
    $q = "SELECT id, chart_date FROM admin_chart WHERE chart_date = '{$date}'";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    $c = $t ->rowCount();
    //echo $c;
    if($c > 0){
        return $data[0]['id'];
    }else{
        return FALSE;
    }
}

<?php
if ($_SERVER['DOCUMENT_ROOT'] == "")
   $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__);
include_once($_SERVER['DOCUMENT_ROOT'] ."/config.php");





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

function include_headers($_SESSION){
    if($_SESSION['type'] == 'admin' OR $_SESSION['user'] == 'Olesya'){
        
        include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header2.php');
        }elseif($_SESSION['type'] == 'marketolog'){
            include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header2_editor.php');
        }elseif($_SESSION['type'] == 'manager'){
            include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header2_salesmanager.php');
        }elseif($_SESSION['type'] == 'advigatel_head'){
            include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header2_advigatel.php');
        }
}

function get_image($id) {
    $f = '';
    $dir = ANG_ROOT . "public/img/parts/";
    $pattern = strtolower($dir . '*-' . $id . '\.{jpg,png,gif}');
    //foreach (glob($pattern, GLOB_BRACE) as $filename) {
    //    $end = explode('/', $filename);
    //    $file[] = (end($end));
    //}
    
    $file2 = glob($pattern,GLOB_BRACE);
    if(!$file2){
        $pattern = strtolower($dir . '*-0' . $id . '\.{jpg,png,gif}');
        $file2 = glob($pattern,GLOB_BRACE);
    }elseif(!$file2){    
        $pattern = strtolower($dir . '*-00' . $id . '\.{jpg,png,gif}');
        $file2 = glob($pattern,GLOB_BRACE);
    }
    
    usort($file2, "filetime_callback");
    foreach($file2 as $ft){
        $file3[] = array('time' =>filemtime($ft), 'file'=>end(explode('/', $ft)));
    }
    //p($file3);
    if (isset($file3)) {
        //p($file);
        return $file3[0]['file'];
    }
    else {
        $file = 'default.png';
        return $file;
    }

}//Конец функции


/*
 * Getting names of cars for category_search.php and breadcrumbs
 */
function get_car_name($id) {
    $m = db();
    $q = 'SELECT * FROM ang_cars WHERE id = ?';
    $t = $m -> prepare($q);
    $t -> execute(array($id));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}
// Функции для Яндекс Маркета


/*
 * Getting subcat name of cars for category_search.php and breadcrumbs
 */
function get_sub_name($id) {
    $m = db();
    $q = 'SELECT * FROM ang_categories WHERE id = ? ORDER BY ang_sort';
    $t = $m -> prepare($q);
    $t -> execute(array($id));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

/*
 * Getting subcat name of cars for category_search.php and breadcrumbs
 */
function get_subcat_name($id) {
    $m = db();
    $q = 'SELECT * FROM ang_subcategories WHERE id = ? ORDER BY ang_sort';
    $t = $m -> prepare($q);
    $t -> execute(array($id));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

/*
 * Getting parts from angara
 */


/*
 * admin functions
 * 
 */
 function delete_from_table($table, $id){
     $m = db();
    $q = "DELETE FROM `content_description` WHERE `id` = ? ";
    $t = $m -> prepare($q);
    $t -> execute(array($id));
    echo "Good job";
    return TRUE;
 }
 
 function adm_sub_all($id) {
    $m = db();
    $q = "SELECT * FROM content_description WHERE id= ? ";
    $t = $m -> prepare($q);
    $t -> execute(array($id));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}
 
 
 
function adm_sub($id) {
    $m = db();
    $q = "SELECT * FROM content_description WHERE `car`= ? ORDER BY id";
    $t = $m -> prepare($q);
    $t -> execute(array($id));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
       return $data; 
    
}
function all_cars() {
    $m = db();
    $q = "SELECT * FROM ang_cars";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function adm_sub_update($arr) {
    $m = db();    
    //p($arr);
    if($arr['id'] != NULL) {
    $q = "UPDATE content_description SET title = :title, meta_d = :meta_d, meta_k = :meta_k, description = :description, img = :img, cat_id = :cat_id, car = :car, h1 = :h1 WHERE id= :id";
    $t = $m -> prepare($q);

    $t -> execute(array(':title' => $arr['title'], ':meta_d' => $arr['meta_d'], ':meta_k' => $arr['meta_k'], ':description' => $arr['description'], ':img' => $arr['img'], ':cat_id' => $arr['cat_id'],  ':car' =>$arr['carid'] , ':h1' =>$arr['h1'], ':id' => $arr['id']));
          $d = 'Inserted';
        return $d;
    } else {
      $q = "INSERT INTO content_description (
                          
                         title,
                         meta_d,
                         meta_k,
                         description,
                         h1,
                         img,
                         cat_id,
                         car
                          ) VALUES (
                         :title,
                         :meta_d,
                         :meta_k,
                         :description,
                         :h1,
                         :img,
                         :cat_id,
                         :car                 
                          )";
        $t = $m -> prepare($q);
        $t -> execute(array(':title' => $arr['title'], ':meta_d' => $arr['meta_d'], ':meta_k' => $arr['meta_k'], ':description' => $arr['description'], ':img' => $arr['img'], ':cat_id' => $arr['cat_id'], ':car' => $arr['carid'], ':h1' =>$arr['h1']));
     
    }
}


function adm_data_update($arr) {
    $m = db();    
    //p($arr);
    if($arr['id'] != NULL) {
    $q = "UPDATE data SET title = :title, meta_d = :meta_d, meta_k = :meta_k, text = :description, mini_img = :img, car = :car WHERE id= :id";
    $t = $m -> prepare($q);

    if($t -> execute(array(':title' => $arr['title'], ':meta_d' => $arr['meta_d'], ':meta_k' => $arr['meta_k'], ':description' => $arr['description'], ':img' => $arr['img'], ':id' => $arr['id'], ':car' =>$arr['car'])));
          $d = 'Inserted';
        return $d;
    } else {
      $q = "INSERT INTO content_description (
                          
                         title,
                         meta_d,
                         meta_k,
                         text,
                         mini_img,
                         car
                          ) VALUES (
                         :title,
                         :meta_d,
                         :meta_k,
                         :description,
                         :img,
                         :car               
                          )";
        $t = $m -> prepare($q);
        $t -> execute(array(':title' => $arr['title'], ':meta_d' => $arr['meta_d'], ':meta_k' => $arr['meta_k'], ':description' => $arr['description'], ':img' => $arr['img'], ':car' =>$arr['car']));
     
    }
}


function count_art($table){
    $m = db();
    $q = "SELECT id FROM {$table}";
    $t = $m -> prepare($q);
    $t -> execute();
    return $t ->rowCount();
}

function count_items_car(){
    $m = db();
    $cars = all_cars();
    foreach($cars as $car){
    $q = "SELECT id,name FROM angara WHERE  ang_name LIKE {$car}";
    $t = $m -> prepare($q);
    $t -> execute();
    $count[] = $t ->rowCount();
    }
    return $count; 
}

function title_art($table){
    $m = db();
    $q = "SELECT a.title, a.car, b.id, b.fullname FROM
    {$table} as a
    LEFT JOIN ang_cars as b
    ON a.car = b.id
    ORDER BY car";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
    
}




function check_subcat_emptiness($id,$car) {
    //echo $car . '<br>';
    $m = db();
    $q = "SELECT COUNT(*) FROM `angara` WHERE  `parent` = :parent AND `ang_name` REGEXP  :car";
    $t = $m -> prepare($q);
    $t -> bindValue(":parent",$id, PDO::PARAM_INT);
    $t -> bindValue(":car",'[[:<:]]'.$car.'[0-9]{0,3}[[:>:]]',PDO::PARAM_STR);
    $t -> execute();
    $data = $t -> fetchColumn();
    //echo $data . '<br>';
    return $data;
}


 
 
 


function adm_main_update($arr) {
    $m = db();    
    //p($arr);
    if($arr['id'] != NULL) {
    $q = "UPDATE content_main SET title = :title, descr = :descr, h1 = :h1, car_id = :car_id, img = :img, text = :text WHERE id= :id";
    $t = $m -> prepare($q);

    if($t -> execute(array(':title' => $arr['title'], ':descr' => $arr['descr'], ':h1' => $arr['h1'], ':car_id' => $arr['car_id'], ':img' => $arr['img'], ':text' => $arr['text'],  ':id' =>$arr['id'])));
          $d = 'Inserted';
        return $d;
    } else {
      //$q = "INSERT INTO content_main (car_id, title, desc, h1, img, text) VALUES (:car_id,:title,:desc,:h1,:img,:text)";
      $q = 'INSERT INTO content_main (car_id, title, descr, h1, img, text) VALUES (:car_id, :title, :descr, :h1, :img, :text)';
        $t = $m -> prepare($q);
        $t -> execute(array(':car_id' => $arr['car_id'],':title' => $arr['title'], ':descr' => $arr['descr'], ':h1' => $arr['h1'],  ':img' => $arr['img'], ':text' => $arr['text']));
         
    }
}

if(!function_exists('mb_ucfirst')) {
    function mb_ucfirst($str, $enc = 'utf-8') { 
            return mb_strtoupper(mb_substr($str, 0, 1, $enc), $enc).mb_substr($str, 1, mb_strlen($str, $enc), $enc); 
    }
}

function issetor(&$var, $default = false) {
    return isset($var) ? $var : $default;
}

<?php
if ($_SERVER['DOCUMENT_ROOT'] == "")
    $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__);
include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/phpmorphy-0.3.7/src/common.php");

//php morfy initialisation
function phpMorphytest($search_string = '') {
    // Укажите путь к каталогу со словарями
    $dir = $_SERVER['DOCUMENT_ROOT'] . "/phpmorphy-0.3.7/dicts";
    //echo $dir;

    // Укажите, для какого языка будем использовать словарь.
    // Язык указывается как ISO3166 код страны и ISO639 код языка,
    // разделенные символом подчеркивания (ru_RU, uk_UA, en_EN, de_DE и т.п.)

    $lang = 'ru_RU';

    // Укажите опции
    // Список поддерживаемых опций см. ниже
    $opts = array(
    // PHPMORPHY_STORAGE_FILE - использовать файл
    // PHPMORPHY_STORAGE_SHM - загружать словать в общую память(нужно расширение shmop)
    // PHPMORPHY_STORAGE_MEM - загружать словать в общую память при каждой инициализации phpmorphy
    'storage' => PHPMORPHY_STORAGE_MEM, 'predict_by_suffix' => true, 'predict_by_db' => true, 'graminfo_as_text' => true, );

    // создаем экземпляр класса phpMorphy
    // обратите внимание: все функции phpMorphy являются throwable т.е.
    // могут возбуждать исключения типа phpMorphy_Exception (конструктор тоже)
    try {
        $morphy = new phpMorphy($dir, $lang, $opts);
    } catch(phpMorphy_Exception $e) {
        die('Error occured while creating phpMorphy instance: ' . $e -> getMessage());
    }

    //here starts morphy tests

    //$dict_bundle = new phpMorphy_FilesBundle($dir, 'rus');
    //creating new class
    //$morphy = new phpMorphy($dict_bundle, $opts);

    //$search_string = array('ПРИМЕРНАЯ', 'СТРОКА', 'ПОИСКА');
    $search_string = mb_strtoupper($search_string, 'UTF-8');
    $search_string = explode(' ', $search_string);
    //p($search_string);
    // Получить нормализованные слова
    //$s = $morphy -> getBaseForm($search_string);
    // Получить все словоформы
    //$s = $morphy -> getAllForms($search_string);
    // Получить корни слов
    $s = $morphy -> getPseudoRoot($search_string);
    //$s = $morphy->findWord($search_string);

    //p($s);
    return $s;
}

/*
 * Starts search functions
 */
function get_search_one($search1, $car) {
    $m = db();
    $q = 'SELECT * FROM `angara` WHERE ang_name LIKE ? AND ang_name LIKE ? LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $search1 . '%', '%' . $car . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_search_two($search1, $search2, $car) {
    $m = db();
    $q = 'SELECT * FROM `angara` WHERE ang_name LIKE ? AND ang_name LIKE ? AND ang_name LIKE ? LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $search1 . '%', '%' . $search2 . '%', '%' . $car . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_search_three($search1, $search2, $search3, $car) {
    $m = db();
    $q = 'SELECT * FROM `angara` WHERE ang_name LIKE ? AND ang_name LIKE ? AND ang_name LIKE ? AND ang_name LIKE ? LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $search1 . '%', '%' . $search2 . '%', '%' . $search3 . '%', '%' . $car . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_search_four($search1, $search2, $search3, $search4, $car) {
    $m = db();
    $q = 'SELECT * FROM `angara` WHERE ang_name LIKE ? AND ang_name LIKE ? AND ang_name LIKE ?  AND ang_name LIKE ? AND ang_name LIKE ? LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $search1 . '%', '%' . $search2 . '%', '%' . $search3 . '%', '%' . $search4 . '%', '%' . $car . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_search_five($search1, $search2, $search3, $search4, $search5, $car) {
    $m = db();
    $q = 'SELECT * FROM `angara` WHERE ang_name LIKE ? AND ang_name LIKE ? AND ang_name LIKE ?  AND ang_name LIKE ?  AND ang_name LIKE ? AND ang_name LIKE ? LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $search1 . '%', '%' . $search2 . '%', '%' . $search3 . '%', '%' . $search4 . '%', '%' . $search5 . '%', '%' . $car . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_search_six($search1, $search2, $search3, $search4, $search5, $search6, $car) {
    $m = db();
    $q = 'SELECT * FROM `angara` WHERE ang_name LIKE ? AND ang_name LIKE ? AND ang_name LIKE ?  AND ang_name LIKE ?  AND ang_name LIKE ?  AND ang_name LIKE ? AND ang_name LIKE ? LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $search1 . '%', '%' . $search2 . '%', '%' . $search3 . '%', '%' . $search4 . '%', '%' . $search5 . '%', '%' . $search6 . '%', '%' . $car . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_search_seven($search1, $search2, $search3, $search4, $search5, $search6, $search7, $car) {
    $m = db();
    $q = 'SELECT * FROM `angara` WHERE ang_name LIKE ? AND ang_name LIKE ? AND ang_name LIKE ?  AND ang_name LIKE ?  AND ang_name LIKE ?  AND ang_name LIKE ?  AND ang_name LIKE ? AND ang_name LIKE ? LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $search1 . '%', '%' . $search2 . '%', '%' . $search3 . '%', '%' . $search4 . '%', '%' . $search5 . '%', '%' . $search6 . '%', '%' . $search7 . '%', '%' . $car . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

// search nocar

function get_search_one_nocar($search1) {
    $m = db();
    $q = 'SELECT * FROM `angara` WHERE ang_name LIKE ? LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $search1 . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_search_two_nocar($search1, $search2) {
    $m = db();
    $q = 'SELECT * FROM `angara` WHERE ang_name LIKE ? AND ang_name LIKE ? LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $search1 . '%', '%' . $search2 . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_search_three_nocar($search1, $search2, $search3) {
    $m = db();
    $q = 'SELECT * FROM `angara` WHERE ang_name LIKE ? AND ang_name LIKE ? AND ang_name LIKE ? LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $search1 . '%', '%' . $search2 . '%', '%' . $search3 . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_search_four_nocar($search1, $search2, $search3, $search4) {
    $m = db();
    $q = 'SELECT * FROM `angara` WHERE ang_name LIKE ? AND ang_name LIKE ? AND ang_name LIKE ?  AND ang_name LIKE ? LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $search1 . '%', '%' . $search2 . '%', '%' . $search3 . '%', '%' . $search4 . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_search_five_nocar($search1, $search2, $search3, $search4, $search5) {
    $m = db();
    $q = 'SELECT * FROM `angara` WHERE ang_name LIKE ? AND ang_name LIKE ? AND ang_name LIKE ?  AND ang_name LIKE ?  AND ang_name LIKE ? LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $search1 . '%', '%' . $search2 . '%', '%' . $search3 . '%', '%' . $search4 . '%', '%' . $search5 . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_search_six_nocar($search1, $search2, $search3, $search4, $search5, $search6) {
    $m = db();
    $q = 'SELECT * FROM `angara` WHERE ang_name LIKE ? AND ang_name LIKE ? AND ang_name LIKE ? AND ang_name LIKE ?  AND ang_name LIKE ?  AND ang_name LIKE ? LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $search1 . '%', '%' . $search2 . '%', '%' . $search3 . '%', '%' . $search4 . '%', '%' . $search5 . '%', '%' . $search6 . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_search_seven_nocar($search1, $search2, $search3, $search4, $search5, $search6, $search7) {
    $m = db();
    echo '%' . $search1 . '%', '%' . $search2 . '%', '%' . $search3 . '%', '%' . $search4 . '%', '%' . $search5 . '%', '%' . $search6 . '%', '%' . $search7 . '%';
    $q = 'SELECT * FROM `angara` WHERE ang_name LIKE ? AND ang_name LIKE ? AND ang_name LIKE ?  AND ang_name LIKE ?  AND ang_name LIKE ?  AND ang_name LIKE ?  AND ang_name LIKE ? LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $search1 . '%', '%' . $search2 . '%', '%' . $search3 . '%', '%' . $search4 . '%', '%' . $search5 . '%', '%' . $search6 . '%', '%' . $search7 . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

// Ищем в базе есть ли совпадения со строкой поиска

function check_if_car_in_search($search) {
    $m = db();
    $q = 'SELECT id FROM ang_cars WHERE name_root = ?';
    $t = $m -> prepare($q);
    $t -> execute(array($search));
    return $t -> rowCount();
}

//вторая функция
function search_cars_in_query($sa) {
    foreach ($sa as $n) {
        $search_sa = check_if_car_in_search($n);
        if ($search_sa != 0) {
            //echo "Совпадение найдено";
            return true;
        }
    }

}

//test function for search
function get_search2($search, $ip = 0, $car) {
    //$search = explode(' ', $search);
    $carname = get_car_name($car);

    $m = db();
    //$q = 'SELECT * FROM `angara` WHERE MATCH (ang_name, cat) AGAINST (? IN NATURAL LANGUAGE MODE) OR ang_name LIKE ? AND car LIKE ? LIMIT 30';
    $q = 'SELECT * FROM `angara` WHERE MATCH (ang_name, cat) AGAINST (? IN NATURAL LANGUAGE MODE) AND car LIKE ? LIMIT 30';
    $t = $m -> prepare($q);
    //$t -> execute(array($search,'%'.$search.'%', $carname[0]['engname']));
    $t -> execute(array($search, $carname[0]['engname']));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_search2_no_session($search, $ip = 0) {
    //$search = explode(' ', $search);
    $carname = get_car_name($car = 'porter');

    $m = db();
    $q = 'SELECT * FROM `angara` WHERE MATCH (ang_name, cat) AGAINST (? IN NATURAL LANGUAGE MODE) LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array($search));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_search2_all($search, $ip = 0) {
    //$search = explode(' ', $search);
    $m = db();
    $q = 'SELECT * FROM `angara` WHERE ang_name  LIKE ? OR cat LIKE ?  LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $search . '%', '%' . $search . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_search2_grm($search, $ip = 0, $car) {
    $carname = get_car_name($car);

    $m = db();
    $q = 'SELECT * FROM `angara` WHERE ang_name  LIKE ? AND car LIKE ?  LIMIT 30';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $search . '%', $carname[0]['engname']));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function insert_search($search, $ip) {
    $m = db();
    $search_q = implode(' ', $search);
    $i = 'INSERT into search_query (search_q, query_ip) VALUES (:search_q, :query_ip)';
    $in = $m -> prepare($i);
    $in -> execute(array(':search_q' => $search_q, ':query_ip' => $ip));
}

function insert_search_ac($ac, $ip) {
    $m = db();
    $i = 'INSERT into search_query (search_q, query_ip) VALUES (:search_q, :query_ip)';
    $in = $m -> prepare($i);
    $in -> execute(array(':search_q' => $ac, ':query_ip' => $ip));
}

//ends search functions

function p($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}//Конец функции

function good_cat($cat) {
    //echo $cat;
    $cat = preg_replace('/[^\w0-9]+/u', '', $cat);
    return $cat;
}

function rus2translit($string) {

    //$string = preg_replace('~[^-a-z0-9_]+~u', '-', $string);

    $converter = array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch', 'Ь' => '\-', 'Ы' => 'Y', 'Ъ' => '\-', 'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya', ' ' => '-');

    return strtr($string, $converter);

}

function str2url($str) {

    // переводим в транслит

    $str = rus2translit($str);

    // в нижний регистр

    $str = strtolower($str);

    // заменям все ненужное нам на "-"

    $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);

    // удаляем начальные и конечные '-'

    $str = trim($str, "-");

    return $str;

}

//$str = 'Все будет хорошо!';
//echo (str2url($str));

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

/*
 * Left sidebar funct
 */
function get_main_model_text($id) {
    $m = db();
    $q = 'SELECT * FROM content_main WHERE car_id = ?';
    $t = $m -> prepare($q);
    $t -> execute(array($id));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function left_side_car() {
    $m = db();
    $q = 'SELECT * FROM ang_cars WHERE enabled = 1 ORDER BY sort';
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function adm_left_side_car($carid) {
    $m = db();
    $q = 'SELECT * FROM content_description WHERE car = ? ';
    $t = $m -> prepare($q);
    $t -> execute(array($carid));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function left_side_cat() {
    $m = db();
    $q = 'SELECT * FROM ang_categories ORDER BY ang_sort';
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function left_side_subcat($id) {
    $m = db();
    $q = 'SELECT * FROM ang_subcategories WHERE parent = ? ORDER BY ang_sort';
    $t = $m -> prepare($q);
    $t -> execute(array($id));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

/*
 * Getting images

 function get_image($id) {
 $f = '';
 $dir = ANG_ROOT . "img/parts/";
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
 $file = 'default.png';
 return $file;
 }

 }//Конец функции
 */
function filetime_callback($a, $b) {
    if (filemtime($a) === filemtime($b))
        return 0;
    return filemtime($a) > filemtime($b) ? -1 : 1;
}

function get_image($id) {
    $f = '';
    $dir = ANG_ROOT . "img/parts/";
    $pattern = strtolower($dir . '*-' . $id . '\.{jpg,png,gif}');
    $file2 = glob($pattern, GLOB_BRACE);
    usort($file2, "filetime_callback");
    foreach ($file2 as $ft) {
        $temp = explode('/', $ft);
        $file_ext = end($temp);
        $file3[] = array('time' => filemtime($ft), 'file' => $file_ext);
    }
    if (isset($file3)) {
        //p($file);
        return $file3[0]['file'];
    } else {
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

function get_car_name_rus($car) {
    $m = db();
    $q = 'SELECT * FROM ang_cars WHERE engname LIKE ?';
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $car . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data[0];
}

// Функции для Яндекс Маркета

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
    $q = 'SELECT * FROM angara';
    $t = $m -> prepare($q);
    $t -> execute(array());
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

function get_yandex_subcategory2() {
    $m = db();
    $q = 'SELECT * FROM ang_subcategories ORDER BY ang_subcat';
    $t = $m -> prepare($q);
    $t -> execute(array());
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

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
 * Getting parts from angara Recovery function
 */
/*
 function get_angara_subcat($id, $car) {
 $m = db();
 $q = 'SELECT * FROM angara WHERE parent = :parent AND ang_name REGEXP :car ORDER BY ang_sort DESC';
 $t = $m -> prepare($q);
 //$t -> execute(array($id, '%' . $car . '%'));
 //echo $car;
 $t -> bindValue(":parent", $id, PDO::PARAM_INT);
 $t -> bindValue(":car", '[[:<:]]' . $car . '[0-9]{0,3}[[:>:]]', PDO::PARAM_STR);
 $t -> execute();
 $data = $t -> fetchAll(PDO::FETCH_ASSOC);
 return $data;
 }
 */

function get_subcat_weight($category_id) {
    $m = db();
    $q = 'SELECT * FROM category_weight WHERE category_id = :category_id ORDER BY weight';
    $t = $m -> prepare($q);
    //$t -> execute(array($id, '%' . $car . '%'));
    //echo $car;
    $t -> bindValue(":category_id", $category_id, PDO::PARAM_INT);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //p($data);
    return $data;
}

function get_angara_subcat($parent, $car) {
    $m = db();
    $weights = get_subcat_weight($parent);
    //$parent = 35;
    if($car=="Porter"){
    $car3=$car;
    $car="PORTER ";
    $car2="ПОРТЕР ";

  }elseif($car=="Porter2"){
    $car3=$car;
    $car="PORTER2";
    $car2="ПОРТЕР2";
  }else{
    $car3=$car;
    $car2=$car;
  }
  //описание мускуль запроса: выбрать всё где ( имя содержит `англ.машину` или `рус.машину` или мащина содержит `англ.машину` ) и родитель равен категории
    foreach ($weights as $weight) {
        //p($weight['full_name']);

      $q = 'SELECT * FROM `angara` WHERE `parent` = :parent and (ang_name LIKE :car OR ang_name LIKE :car2 OR car LIKE :car3 OR car LIKE "%РАЗНОЕ%") AND ang_name LIKE :part_name ORDER BY price';
        $t = $m -> prepare($q);
        //$t -> execute(array($id, '%' . $car . '%'));
        //echo $car;
        //$t -> bindValue(":parent", $parent, PDO::PARAM_INT);
        // $t -> bindValue(":car", '[[:<:]]' . $car . '[0-9]{0,3}[[:>:]]', PDO::PARAM_STR);
        //$t -> bindValue(":part_name", $weight['part_name'].'%', PDO::PARAM_STR);
        $t -> execute(array(':parent' => $parent, ':car' => '%' . $car . '%', ':car2' => '%' . $car2 . '%',':car3' => '' . $car3 . '', ':part_name' => $weight['part_name'] . '%'));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $big[$weight['full_name'] . '-' . $weight['id']] = $data;
        //p($big);
    }


    $q2 = 'SELECT * FROM `angara` WHERE `parent` = :parent and (ang_name LIKE :car OR ang_name LIKE :car2 OR car LIKE :car3 OR car LIKE "%РАЗНОЕ%") AND  substring_index(ang_name, " ", 1)  NOT IN (SELECT part_name FROM category_weight WHERE category_id = :parent ) ORDER BY price DESC';

    $t = $m -> prepare($q2);

    $t -> execute(array(':parent' => $parent, ':car' => '%' . $car . '%', ':car2' => '%' . $car2 . '%',':car3' => '' . $car3 . ''));
    //p($t);
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    $big['разное'] = $data;
    //p($data);

    // p($big);
    return $big;
}

/*
 *
 * Capilazing fifst letter russian
 *
 */
function mb_ucfirst($string, $encoding) {
    $strlen = mb_strlen($string, $encoding);
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $then = mb_substr($string, 1, $strlen - 1, $encoding);
    return mb_strtoupper($firstChar, $encoding) . $then;
}

/*
 * Меняем слэш на  пробелы в названии перед транслитом
 */

function cut_part_title($str) {
    $str = preg_replace('#\/#u', ' ', $str);

    return $str;
}

/*
 * Getting goods from angara for kartochka tovara
 */

function get_goods($id) {
    $m = db();
    $q = 'SELECT * FROM angara WHERE 1c_id = ? ';
    $t = $m -> prepare($q);
    $t -> execute(array($id));
    if ($data = $t -> fetchAll(PDO::FETCH_ASSOC)) {
        return $data;
    } else {
        return FALSE;
    }

}


function get_all_angara_by_number($number) {
    $m = db();
    $q = 'SELECT * FROM angara WHERE cat = ? ORDER BY price DESC';
    $t = $m -> prepare($q);
    $t -> execute(array($number));
    if ($data = $t -> fetchAll(PDO::FETCH_ASSOC)) {
        return $data;
    } else {
        return FALSE;
    }

}


/*
 *Getting car name from ang_car trough angara field car
 */
function get_car_name_angara($car) {
    $m = db();
    $q = "SELECT id FROM ang_cars WHERE `engname` LIKE ? AND `enabled` = 1";
    $t = $m -> prepare($q);
    $t -> execute(array($car));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function get_car_name_angara2($car) {
    $m = db();
    $q = "SELECT id FROM ang_cars WHERE `engname` LIKE ? OR `title` LIKE ?  AND `enabled` = 1";
    $t = $m -> prepare($q);
    $t -> execute(array($car . '%', $car . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

/*
 * Cutting goods name for breadcrumbs
 */
function cut_bread_name($str) {
    $str = preg_replace('#[^\d\w\s]#ui', ' ', $str);
    $pattern = '#^\w+\s+\w+\s+\w+#ui';
    preg_match($pattern, $str, $matches);
    //p($matces);
    return $matches[0];

}

function preg_name($str) {
    $str = preg_replace('#[^\d\w\s]#ui', ' ', $str);
    return $str;
}

function get_cheap_goods($cat_number, $price) {
    $cat = substr($cat_number, 0, 7);
    $m = db();
    $q = 'SELECT ang_name, price, 1c_id, cat  FROM angara WHERE cat LIKE ? AND price < ?';
    $t = $m -> prepare($q);
    $t -> execute(array($cat . '%', $price));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;

}

/*
 * Get goods by 1c_id from angara for autocomplete
 */
function get_ac($id) {
    $m = db();
    $q = 'SELECT cat,ang_name FROM `angara` WHERE `1c_id`= ?';
    $t = $m -> prepare($q);
    $t -> execute(array($id));
    $data = $t -> fetchAll(PDO::FETCH_NUM);
    return $data;
}

/*
 * admin functions
 *
 */
function delete_from_table($table, $id) {
    $m = db();
    $q = "DELETE FROM {$table} WHERE `id` = ? ";
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

function adm_data_all($id) {
    $m = db();
    $q = "SELECT * FROM data WHERE id= ? ";
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

function adm_data($id) {
    $m = db();
    $q = "SELECT * FROM data WHERE `car`= ? ORDER BY id";
    $t = $m -> prepare($q);
    $t -> execute(array($id));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;

}

function adm_car($id) {
    $m = db();
    $q = "SELECT * FROM ang_cars WHERE `id`= ?";
    $t = $m -> prepare($q);
    $t -> execute(array($id));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function adm_sub_update($arr) {
    $m = db();
    //p($arr);
    if ($arr['id'] != NULL) {
        $q = "UPDATE content_description SET title = :title, meta_d = :meta_d, meta_k = :meta_k, description = :description, img = :img, cat_id = :cat_id, car = :car, h1 = :h1 WHERE id= :id";
        $t = $m -> prepare($q);

        $t -> execute(array(':title' => $arr['title'], ':meta_d' => $arr['meta_d'], ':meta_k' => $arr['meta_k'], ':description' => $arr['description'], ':img' => $arr['img'], ':cat_id' => $arr['cat_id'], ':car' => $arr['carid'], ':h1' => $arr['h1'], ':id' => $arr['id']));
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
        $t -> execute(array(':title' => $arr['title'], ':meta_d' => $arr['meta_d'], ':meta_k' => $arr['meta_k'], ':description' => $arr['description'], ':img' => $arr['img'], ':cat_id' => $arr['cat_id'], ':car' => $arr['carid'], ':h1' => $arr['h1']));

    }
}

//Update each column in table data

function adm_sub_update_each($field, $value, $id) {
    $m = db();
    //p($arr);

    $q = "UPDATE content_description SET " . $field . " =:each  WHERE id= :id";
    $t = $m -> prepare($q);

    $t -> execute(array(':each' => $value, ':id' => $id));
    $d = 'Inserted';
    return $d;

}

function get_autocomplete($id) {
    $m = db();
    $q = "SELECT * FROM `angara` WHERE `ang_name` LIKE ? AND car LIKE 'porter%'   ORDER BY ang_name LIMIT 40";
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $id . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function adm_data_update($arr) {
    $m = db();
    p($arr);
    if ($arr['id'] != NULL) {
        $q = "UPDATE data SET title = :title, meta_d = :meta_d, meta_k = :meta_k, text = :description, mini_img = :img, car = :car, h1 = :h1 WHERE id= :id";
        $t = $m -> prepare($q);

        if ($t -> execute(array(':title' => $arr['title'], ':meta_d' => $arr['meta_d'], ':meta_k' => $arr['meta_k'], ':description' => $arr['description'], ':img' => $arr['img'], ':id' => $arr['id'], ':car' => $arr['car'], ':h1' => $arr['h1'])))
            ;
        $d = 'Inserted';
        return $d;
    } else {
        $q = "INSERT INTO data (
                         title,
                         meta_d,
                         meta_k,
                         text,
                         mini_img,
                         car,
                         h1
                          ) VALUES (
                         :title,
                         :meta_d,
                         :meta_k,
                         :description,
                         :img,
                         :car,
                         :h1
                          )";
        $t = $m -> prepare($q);
        $t -> execute(array(':title' => $arr['title'], ':meta_d' => $arr['meta_d'], ':meta_k' => $arr['meta_k'], ':description' => $arr['description'], ':img' => $arr['img'], ':car' => $arr['car'], ':h1' => $arr['h1']));

    }
}

function adm_art($id) {
    $m = db();
    $q = "SELECT * FROM data WHERE `id`= ?";
    $t = $m -> prepare($q);
    $t -> execute(array($id));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function count_art($table) {
    $m = db();
    $q = "SELECT id FROM {$table}";
    $t = $m -> prepare($q);
    $t -> execute();
    return $t -> rowCount();

}

function title_art($table) {
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

function title_art2($table) {
    $m = db();
    $q = "SELECT a.title, a.car, a.cat_id, b.id, b.fullname FROM
    {$table} as a
    LEFT JOIN ang_cars as b
    ON a.car = b.id
    ORDER BY car";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;

}

function good_name($str) {
    $cars = left_side_car();
    $pattern = '#';
    foreach ($cars as $car) {
        $pattern .= $car['title'];
        $pattern .= '|';
    }
    $pattern = $pattern . '#ui';
    $string = preg_replace('#[^А-я\s]+#ui', ' ', $str);
    $string = preg_replace($pattern, '', $string);

    //preg_match_all('#hd\d+|портер\d|портер#uim', $string, $car);
    $name = preg_replace('#\s+#uim', ' ', $string);

    //@$name = $match[0] . ' на ' . $li;
    //echo $name;
    return $name;
}

/*
 * similar goods
 */
function get_similar_goods($car, $name) {

    preg_match('#^(\w+).+#iu', $name, $search);
    $m = db();
    $q = "SELECT ang_name,cat,price,1c_id FROM `angara` WHERE `ang_name` LIKE ? AND `ang_name` LIKE ?  ORDER BY ang_name LIMIT 4";
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $car . '%', '%' . $search[1] . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //p($data);
    return $data;
}

function check_subcat_emptiness($id, $car) {
    //echo $car . '<br>';
    $m = db();
    $q = "SELECT COUNT(*) FROM `angara` WHERE  `parent` = :parent AND `ang_name` REGEXP  :car";
    $t = $m -> prepare($q);
    $t -> bindValue(":parent", $id, PDO::PARAM_INT);
    $t -> bindValue(":car", '[[:<:]]' . $car . '[0-9]{0,3}[[:>:]]', PDO::PARAM_STR);
    $t -> execute();
    $data = $t -> fetchColumn();
    //echo $data . '<br>';
    return $data;
}

//Admin for main text

function adm_main_all() {
    $m = db();
    $q = "SELECT c.*,a.title
    FROM content_main as c
    INNER JOIN ang_cars as a
    ON c.car_id = a.id ";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function adm_main($id) {
    $m = db();
    $q = "SELECT * FROM content_main WHERE `car_id`= ?";
    $t = $m -> prepare($q);
    $t -> execute(array($id));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function adm_main_update($arr) {
    $m = db();
    //p($arr);
    if ($arr['id'] != NULL) {
        $q = "UPDATE content_main SET title = :title, descr = :descr, h1 = :h1, car_id = :car_id, img = :img, text = :text WHERE id= :id";
        $t = $m -> prepare($q);

        if ($t -> execute(array(':title' => $arr['title'], ':descr' => $arr['descr'], ':h1' => $arr['h1'], ':car_id' => $arr['car_id'], ':img' => $arr['img'], ':text' => $arr['text'], ':id' => $arr['id'])))
            ;
        $d = 'Inserted';
        return $d;
    } else {
        //$q = "INSERT INTO content_main (car_id, title, desc, h1, img, text) VALUES (:car_id,:title,:desc,:h1,:img,:text)";
        $q = 'INSERT INTO content_main (car_id, title, descr, h1, img, text) VALUES (:car_id, :title, :descr, :h1, :img, :text)';
        $t = $m -> prepare($q);
        $t -> execute(array(':car_id' => $arr['car_id'], ':title' => $arr['title'], ':descr' => $arr['descr'], ':h1' => $arr['h1'], ':img' => $arr['img'], ':text' => $arr['text']));

    }
}

if (!function_exists('mb_ucfirst')) {
    function mb_ucfirst($str, $enc = 'utf-8') {
        return mb_strtoupper(mb_substr($str, 0, 1, $enc), $enc) . mb_substr($str, 1, mb_strlen($str, $enc), $enc);
    }

}
//index adm functions
function all_cars() {
    $m = db();
    $q = "SELECT * FROM ang_cars WHERE enabled = 1";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function count_items_car() {
    $m = db();
    $cars = all_cars();
    // p($cars);
    foreach ($cars as $car) {
        $q = "SELECT id FROM angara WHERE ang_name LIKE '%" . $car['engname'] . "%'";
        $t = $m -> prepare($q);
        $t -> execute();
        $count[$car['id']] = $t -> rowCount();

    }
    return $count;
}

function count_subcats() {
    $m = db();
    $cars = all_cars();
    //p($cars);
    foreach ($cars as $car) {
        $q = "SELECT id FROM content_description WHERE car  = " . $car['id'];
        $t = $m -> prepare($q);
        $t -> execute();
        $count[$car['id']] = $t -> rowCount();
    }
    return $count;
}

function count_articles() {
    $m = db();
    $cars = all_cars();
    // p($cars);
    foreach ($cars as $car) {
        $q = "SELECT id FROM data WHERE car = " . $car['id'];
        $t = $m -> prepare($q);
        $t -> execute();
        $count[$car['id']] = $t -> rowCount();

    }
    return $count;
}

function percent($x, $def) {
    $data = round($x * 100 / $def);
    return $data;
}

function count_img() {
    $cars = all_cars();
    //p($cars);
    $f = '';
    $dir = ANG_ROOT . "img/parts/";
    foreach ($cars as $key => $car) {
        $c = f($car['engname']);
        $finarray[$car['id']] = $c;
    }
    return $finarray;
}

function f($car) {
    $car = strtolower($car);
    $f = '';
    $dir = ANG_ROOT . "img/parts/";
    $pattern = strtolower($dir . '*' . $car . '-*\.{jpg,png,gif}');
    foreach (glob($pattern, GLOB_BRACE) as $filename) {
        $end = explode('/', $filename);
        $file = end($end);
        $array[] = $file;
        //p($file);
    }
    return (@count($array));
}

//retrive data for graph

function adm_graph_data() {
    $m = db();
    $q = "SELECT * FROM admin_chart ORDER BY chart_date DESC LIMIT 30";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return array_reverse($data);
}

function check_angara($table, $id, $cat) {
    $m = db();
    $q = "SELECT cat FROM {$table} WHERE 1c_id = {$id}";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    $count = $t -> rowCount();
    $new_cat = good_cat($data[0]['cat']);
    if ($count != 0 AND $cat == $new_cat) {
        return TRUE;
    } else {
        return FALSE;
    }

}

/*
 *
 * Compapny perfomance functions
 */
function manager_perfomance($field) {
    $m = db();
    $q = 'SELECT val_manager,SUM(' . $field . ') as summa FROM `admin_val`  GROUP BY `val_manager`';
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //p($data);
    return $data;
}

function val_get_manager($manager) {
    $m = db();
    $q = "SELECT * FROM admin_val WHERE val_manager = '{$manager}' AND ( val_date between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //p($data);
    return $data;

}

function val_get_total() {
    $m = db();
    $q = "SELECT * FROM admin_val WHERE ( val_date between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;

}

function count_days() {
    $first_day = strtotime(date('Y-m-00'));
    $today = strtotime(date('Y-m-d'));
    $time_diff = abs($today - $first_day);
    $days = intval($time_diff / 86400);
    return $days;
}

function get_all_val_data() {
    $count = count_days();
    $total = val_get_total();
    $it = 0;
    $data_array = array();
    $tot_rev = 0;
    $tot_profit = 0;
    $tot_rent = 0;
    foreach ($total as $tot) {
        $it++;
        $tot_rev += $tot['val_cost'];
        $tot_profit += $tot['val_profit'];
        $tot_rent += $tot['val_rent'];
    }
    $tot_averege_rev = round($tot_rev / $count);
    $tot_averege_profit = round($tot_profit / $count);
    @$tot_averege_rent = round($tot_rent / $it, 2);
    $data_array[] = array('total_revenue' => $tot_rev, 'total_profit' => $tot_profit, 'total_rent' => $tot_rent, 'av_revenue' => $tot_averege_rev, 'av_profit' => $tot_averege_profit, 'av_rent' => $tot_averege_rent);
    //p($data_array);
    return $data_array;
}

/*
 * getting data by manager
 */

function get_data_by_manager($manager) {

    if ($data = val_get_manager($manager)) {
        $i = 0;
    } else {
        $i = 1;
    }
    //p($data);
    $count = count_days();
    $revenue = 0;
    $profit = 0;
    $rent = 0;

    $array = array();
    foreach ($data as $key => $value) {
        ++$i;
        $revenue += $value['val_cost'];
        $profit += $value['val_profit'];
        $rent += $value['val_rent'];
    }
    $rent = round($rent / $i, 2);
    $array[] = array('mng_revenue' => $revenue, 'mng_profit' => $profit, 'mng_rent' => $rent);
    // p($array);
    return $array;
}

/*
 * getting data by date
 */
function val_get_total_daily() {
    $m = db();
    $q = "SELECT    DATE(`val_date`) as DATE, SUM(`val_profit`) daily_profit, SUM(`val_cost`) daily_revenue, AVG( `val_rent`) daily_rent
            FROM      admin_val
            WHERE ( val_date between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )
            GROUP BY  DATE(`val_date`)";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;

}

function val_get_total_monthly() {
    $m = db();
    //$q = "SELECT * FROM admin_val_month where YEAR(val_date) = YEAR(NOW()) and MONTH(val_date) < MONTH(NOW()) ORDER BY val_date";
    $q = "SELECT * FROM admin_val_month WHERE val_date != (SELECT MAX(val_date) FROM admin_val_month) ORDER BY val_date";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;

}

function val_get_today() {
    $m = db();
    $q = "SELECT SUM(val_cost) as cost, SUM(val_profit) as profit, ROUND(AVG(val_rent),2) as rent FROM admin_val where val_date = CURDATE()";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;

}

function ware_get_today() {
    $m = db();
    $q = "SELECT * FROM admin_warehouse WHERE ware_date = DATE(NOW())";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //var_dump($data);
    if ($data == null) {
        $q = "SELECT * FROM admin_warehouse WHERE ware_date = SUBDATE(CURDATE(),1)";
        $t = $m -> prepare($q);
        $t -> execute();
        return $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    }
    return $data;

}

function get_ware_all() {
    $m = db();
    $q = "SELECT * FROM admin_warehouse WHERE ware_date > DATE_SUB(now(), INTERVAL 3 MONTH)";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;

}

function compare_class($com1, $com2) {
    if ($com1 < $com2) {
        echo 'badge-warning';
    } else {
        echo 'badge-success';
    }
}

function compare_class_red($com1, $com2) {
    if ($com1 < $com2) {
        echo 'badge-danger';
    } else {
        echo 'badge-success';
    }
}

function authorization($user, $pass) {
    $m = db();
    $q = "SELECT * FROM userlist WHERE user = ? AND pass = ? AND enabled = '1'";
    $t = $m -> prepare($q);
    $t -> execute(array($user, $pass));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //p($data);
    return $data;
}

function get_cars_value() {
    $m = db();
    $q = "SELECT car as car ,SUM(cost) as cost, SUM(profit) as profit, ROUND(AVG(rent),2) as rent FROM admin_val_cars WHERE date > DATE_SUB(now(), INTERVAL 1 MONTH) group by car ORDER BY cost DESC";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function get_adm_check_total() {
    $m = db();
    $q = "SELECT manager as manager ,AVG(avcheck) as avcheck FROM admin_check group by manager ORDER BY manager";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function average($array) {
    $i = 0;
    $aver = 0;
    foreach ($array as $arr) {
        $i++;
        $aver += $arr['avcheck'];
    }
    $avr = $aver / $i;
    return $avr;
}

//Функция расчета коэффициэнта зарплаты в зависимости от выручки
function make_wage_rate($val) {

    if ($val <= 850000) {
        $rate = 0.04;
    } elseif ($val >= 900000 && $val < 950000) {
        $rate = 0.05;
    } elseif ($val >= 950000 && $val < 1000000) {
        $rate = 0.08;
    } elseif ($val >= 1000000 && $val < 1100000) {
        $rate = 0.09;
    } elseif ($val >= 1100000 && $val < 1150000) {
        $rate = 0.10;
    } elseif ($val >= 1150000 && $val < 1500000) {
        $rate = 0.11;
    } elseif ($val >= 1500000) {
        $rate = 0.13;
    }

    return $rate;
}

//Функция прогноза валовой прибыли за текущий месяц
function revenue_forecast($val) {
    $days = count_days();
    if ($days == 0) {
        $days = 1;
    }
    $day = date("t");
    //echo $val . '<br>';
    //echo $day. '<br>';
    //Среднюю выручку на день делим на число прошедщих дней, 0.51 коэфф понижения выручки на выходные 9 в среднем выходный в месяц
    $forecast = $val / $days * ($day - 9) + $val / $days * 0.51 * 9;
    //echo $forecast . '<br>';
    return $forecast;

}

//Рассчитываем зарплату каждого менеджера Внешняя функция
function return_wage_personal($val, $persent, $user_id) {
    $revenue_forecast = revenue_forecast($val);
    $rate = make_wage_rate($revenue_forecast);
    $bonus = get_adm_bonus($user_id, $rate);
    $forecast = round($revenue_forecast * $rate * $persent + $bonus, 0);
    return $forecast;
}

//Here we are getting bonuses from bonus table
function get_adm_bonus($user_id, $rate) {
    $m = db();
    $q = "SELECT * FROM adm_bonus WHERE manager = ? ";
    $t = $m -> prepare($q);
    $t -> execute(array($user_id));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //p( $data);
    $sum = 0;
    foreach ($data as $d) {
        if ($rate <= 0.08 AND $d['breakeven_point'] == 0) {
            continue;
        } else {
            $sum += $d['bonus_value'];
        }
    }
    //echo $sum . '<br>';
    return $sum;
}

function get_search_terms($query) {
    $m = db();
    $q = "SELECT * FROM search_query_page WHERE search_q LIKE ? ";
    $t = $m -> prepare($q);
    $t -> execute(array('%' . $query . '%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
    //p( $data);

}

function get_spare($search, $limit) {

    $m = db();
    $q = 'SELECT * FROM `search_query_page` WHERE MATCH (search_q) AGAINST (?) LIMIT ' . $limit;
    $t = $m -> prepare($q);
    $t -> execute(array($search));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}
//car="porter" AND
function get_spare_angara($search) {
		$car=left_side_car();
		$a='';
		foreach($car as $key => $value){
			if(mb_stripos($search,$value['title']) OR mb_stripos($search,$value['engname'])){
			$a .="ang_name LIKE '%" . $value['engname'] . "%' OR ang_name LIKE '%" . $value['title'] . "%' OR ";
			}else{

			}
		}
    	$res="(" . rtrim($a," OR ") . ")";
		if($res=='()'){
			$andcar=' (ang_name LIKE "%porter%" OR ang_name LIKE "%портер%") AND ';
		}else{
			$andcar=$res . " AND ";
		}
		//p($res);

	$words2 = str_ireplace("-", " ", $search);
     $words3 = str_ireplace("/", " ", $words2);
     $words4 = str_ireplace("+", " ", $words3);
     $words1 = rtrim($words4," ");
     $words = explode(" ", $words1);


	//p($words);
	$worddds=' ';
	foreach($words as $key => $val){
		$v1 = rtrim($val,'ого ая ый ых ое ые яя ие юю ую их а и я е ь ик на');
		if($v1==''){

		}else{
		$worddds .='"+' . $v1 . '*" ';
		}
	}
	$res2='"+' . rtrim($words[0],'ого ая ый ых ое ые яя ие юю ую их а и я е ь ик на') . '*"' . rtrim($worddds);
	//p($res2);
    $m = db();

    $q = 'SELECT * FROM `angara` WHERE ' . $andcar . ' MATCH (ang_name, cat) AGAINST (' . $res2 . ' IN BOOLEAN MODE) limit 20';
    $t = $m -> prepare($q);
    //p($t);
    $t -> execute();

    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_subcat_spare_angara($search) {


	$words2 = str_ireplace("-", " ", $search);
     $words3 = str_ireplace("/", " ", $words2);
     $words4 = str_ireplace("+", " ", $words3);
	 $words5 = str_ireplace(")", " ", $words4);
	 $words6 = str_ireplace("(", " ", $words5);
     $words1 = rtrim($words6," ");
     $words = explode(" ", $words1);


	//p($words);
	$worddds=' ';
	foreach($words as $key => $val){
		$v1 = rtrim($val,'ого ая ый ых ое ые яя ие юю ую их а и я е ь ик на');
		if($v1==''){

		}else{
		$worddds .='"' . $v1 . '*" ';
		}
	}
	$res2=rtrim($worddds);
	//p($res2);
    $m = db();

    $q = 'SELECT * FROM `ang_subcategories` WHERE MATCH (ang_subcat) AGAINST (' . $res2 . ' IN BOOLEAN MODE) limit 4';
    $t = $m -> prepare($q);
    //p($t);
    $t -> execute();

    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_spare_car_angara($search) {
		$car=left_side_car();

		$a='';
		foreach($car as $key => $value){
			if(mb_stripos($search,$value['title']) OR mb_stripos($search,$value['engname'])){
			$a .='engname LIKE "' . $value['engname'] . '" OR ';
			}else{

			}
		}
    	$res=rtrim($a,' OR ');
		if($res==''){
			$andcar='engname LIKE "porter"';
		}else{
			$andcar=$res;
		}



    $m = db();

    $q = 'SELECT * FROM ang_cars WHERE (' . $andcar . ') AND enabled = 1 ORDER BY sort';
    $t = $m -> prepare($q);
    //p($t);
    $t -> execute();

    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function get_spare_angara2($search) {
    //$search = explode(' ', $search);

    $m = db();

    $q = 'SELECT * FROM `angara` WHERE car="porter" AND MATCH (ang_name, cat) AGAINST (? IN NATURAL LANGUAGE MODE) limit 20';
    $t = $m -> prepare($q);
    $t -> execute(array($search));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    //insert_search($search,$ip);
    return $data;
}

function white_replacer($str) {
    $string = preg_replace('/\s+/u', ' ', $str);
    return $string;
}

function get_category_bottom() {
    $m = db();
    $q = "SELECT * FROM ang_categories";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;

}

function get_subcategory_bottom($parent) {
    $m = db();
    $q = "SELECT * FROM ang_subcategories WHERE parent = ? ";
    $t = $m -> prepare($q);
    $t -> execute(array($parent));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function get_content_category($car, $cat_id) {
    $m = db();
    $q = "SELECT * FROM content_category WHERE car = ? AND cat_id = ? ";
    $t = $m -> prepare($q);
    $t -> execute(array($car, $cat_id));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function get_catalog_page($article,$car){
	$m = db();
	if($car==1){
		$prefix="p1_";
		$q = "SELECT a.id_h3 as id
    FROM " . $prefix . "h4 a
    JOIN " . $prefix . "h5 b ON b.id_h4=a.id
    WHERE b.numer='" . $article ."' ";
	}elseif($car==5){
		$prefix="p2_";
		$q = "SELECT a.id_h3 as id
    FROM " . $prefix . "h4 a
    JOIN " . $prefix . "h5 b ON b.id_h4=a.id
    WHERE a.id_h3>624 AND b.numer='" . $article ."' ";
	}elseif($car==2){
		$prefix="hd_";
		$q = "SELECT a.id_h3 as id
    FROM " . $prefix . "h4 a
    JOIN " . $prefix . "h5 b ON b.id_h4=a.id
    WHERE a.id_h3>128 AND a.id_h3<257 AND b.numer='" . $article ."' ";
	}else{
		$prefix='';
		$q = "SELECT a.id_h3 as id
    FROM " . $prefix . "h4 a
    JOIN " . $prefix . "h5 b ON b.id_h4=a.id
    WHERE b.numer='" . $article ."' ";
	}


    $t = $m -> prepare($q);
    //p($t);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

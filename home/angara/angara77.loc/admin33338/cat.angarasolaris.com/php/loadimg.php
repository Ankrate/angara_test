<?php

set_time_limit(0);
ini_set('max_execution_time',0);
ini_set('memory_limit', '128M');
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors',1);
//ini_set('display_startup_errors',1);
/**
 * Сохраняет картинку $image_url,
 * в тот же каталог что и исходная,
 * с указаного домена
 * save_image('/images/cutups_hyundai/RRUSPSBR/GI_32327.png','http://hyundai.epcdata.ru');
 * @param string $image_url = '/images/cutups_hyundai/RRUSPSBR/GI_32327.png'
 * @param string $getHome = 'http://hyundai.epcdata.ru'
 */
function save_image($image_url, $Home='http://hyundai.epcdata.ru') {
     $get_url = $Home.$image_url;
    // имя из url до картинки
    $filename = basename($image_url);
    $imgDir = '.'.dirname($image_url);
    //echo $imgDir;
    // путь + имя где сохранить тот же каталог что и на сайте
    $destination_url = '..'.$image_url;

//file_exists($destination_url)
    // Сохраняем картинку усли ее нет
    if (file_exists($destination_url)){
        //echo "есть картинка";
        //unlink($destination_url);
    }else{
//echo "нет картинки";
      //  sleep(1);
    $YUghYu = curl_init($get_url);
    //curl_setopt($YUghYu, CURLOPT_PROXY, "176.108.108.212:8080");
    curl_setopt($YUghYu, CURLOPT_HEADER, 0);
    curl_setopt($YUghYu, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($YUghYu, CURLOPT_BINARYTRANSFER, 1);
    curl_setopt($YUghYu, CURLOPT_REFERER, 'http://google.ru');
    curl_setopt($YUghYu, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($YUghYu, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0" .
            "; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR" .
            " 3.0.04506.30)");
    $img = curl_exec($YUghYu);
    curl_close($YUghYu);
    unset($YUghYu);

if(!file_exists($imgDir)){mkdir($imgDir, 0777, true);}
   $f = fopen($destination_url, 'x');
   fwrite($f, $img);
   fclose($f);

}
    // Возвращаем новый путь:
    return $destination_url;
}


if(isset($_POST['load_img']) and $_POST['load_img']==true){
	save_image($_POST['img']);

}



//echo load_site_html('http://hlominka.ru');
echo save_image('/images/cutups_hyundai/KEURPHR0/4141711.png');
//save_image('/images/home.gif','http://hyundai.epcdata.ru');

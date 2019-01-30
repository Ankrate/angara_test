<?php
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
require __DIR__ . '/../../../config.php';
//include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");
//include dirname(__FILE__) . '/../Classes/PHPExcel/IOFactory.php';
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

$data = select_porter();

function select_porter(){
    $m = db();
    $q = 'SELECT ang_name, nal, cat, price FROM angara WHERE ang_name LIKE ?';
    $t = $m -> prepare($q);
    $t -> execute(array('%porter%'));
    //$n = array(0=>array('ang_name'=>'Наименование', 'nal'=>'наличие', 'cat'=>'Номер', 'price'=>'Цена'));
    $data = $t->fetchAll(PDO::FETCH_ASSOC);
    
    return $data;
}

$objPHPExcel = new PHPExcel();

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objPHPExcel->getActiveSheet()->fromArray($data, NULL, 'A1');
$objWriter->save(__DIR__ . '/../../insert/price/angara.xls');

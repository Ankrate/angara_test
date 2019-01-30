<?php
//include "lock.php";

set_time_limit(0);
ini_set('max_execution_time',0);
ini_set('memory_limit', '128M');
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);


include(__DIR__.'/config.php');
include(__DIR__.'/class/class.bd.php');
// Соединение с базой данных
DataBase::Connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
/*
echo "тут";
print_r($_POST);

exit;

	function to_focus_work_array($arr)
{
  return array($arr['id'], $arr['WorkHrs']);
}
*/
//echo"String fuck";
//var_dump( $_POST);

$result = array();
//получить информацию

if(isset($_POST['info'])) {//and $_POST['info']==true)
	//print_r($_POST['info']);

	$name = $_POST['info'];
	//$name = 2867;

	$res = BD_h5::h3_check($name);
	//print_r($res);


$result = $res;


}

//обновимть запись h5
if(isset($_POST['update']) and $_POST['update']==true){

//для h4
$id_h4 = $_POST['id_h4'];
$keyd = $_POST['keyd'];
$title = $_POST['title'];
$title2 = $_POST['title2'];
//для h5
$id_h5 = $_POST['id'];
$numer_h5 = $_POST['numer'];
$count_h5 = $_POST['count'];
$period_h5 = $_POST['period'];
$description_h5 = $_POST['description'];


	$result[0] = $_POST;//BD_h5::update_h5($numer_h5,$description_h5,$count_h5,$period_h5);
	$result[1] = BD_h5::update_h5($id_h5,$numer_h5,$description_h5,$count_h5,$period_h5,$description_h5);
	$result[2] = BD_h5::update_h4($id_h4,$keyd,$title,$title2);
}

//создать запись
if(isset($_POST['add']) and $_POST['add']==true){

	$id_h3_h4 = (int)$_POST['id_h3_h4'];
	$img_h4 = strClear($_POST['img_h4']);
	$keyd_h4 = strClear($_POST['keyd_h4']);
	$coords_h4 = strClear($_POST['coords_h4']);
	$title_h4 = strClear($_POST['title_h4']);
	$title2_h4 = strClear($_POST['title2_h4']);

	$numer_h5 = strClear($_POST['numer_h5']);
	$description_h5 = strClear($_POST['description_h5']);
	$count_h5 = strClear($_POST['count_h5']);
	$period_h5 = strClear($_POST['period_h5']);

	$result = BD_h5::add_h5($id_h3_h4,$img_h4,$keyd_h4,$coords_h4,$title_h4,$title2_h4,$numer_h5,$description_h5,$count_h5,$period_h5);
}

//добавить в h5 полe
if(isset($_POST['addh5']) and $_POST['addh5']==true){
	$id_h4 = (int)$_POST['id_h4'];
	$result[] = BD_h5::add_h5inset($id_h4);
}
//удалить из h5 поля
if(isset($_POST['delh5']) and $_POST['delh5']==true){
	$id_h5 = (int)$_POST['id_h5'];
	$result[] = BD_h5::del_h5($id_h5);
}

//запись что проверенна
if(isset($_POST['save_cheak']) and (int)$_POST['save_cheak']>0){
	$result = BD_h5::save_check((int)$_POST['save_cheak']);
}


function strClear($str){
	$str = trim($str);

return $str;
}

function EmtyExit($str){
if(empty($str))exit();

}





//$result=BD_h5::h3_check();
//$result = BD_h5::add_h5($id_h3_h4,$img_h4,$keyd_h4,$coords_h4,$title_h4,$title2_h4,$numer_h5,$description_h5,$count_h5,$period_h5);
//$result = BD_h5::add_h5(999999,99999,99999,999999,999999,999999,9999999,999999,999999,999999);

// Закрываем соединение с базой данных
DataBase::Close();


print_r (json_encode($result));

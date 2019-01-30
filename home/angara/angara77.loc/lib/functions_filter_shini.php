<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

/*include __DIR__ . '/../config.php';*/
require __DIR__ . '/Connection.php';






function brandchoose($brandchoose){
$db = new Connection;
$m = $db -> db();
if(!empty($brandchoose['id'])){
		$data = getBrandchoose($brandchoose['id']);
		//p($data1);
	}
return $data;
}

function getBrandchoose($id){
	$db = new Connection;
	$m = $db -> db();
	
	$q = "SELECT b.name as model_name, b.id as model_id, a.name as brand_name, c.* FROM `tires_brand` AS a JOIN `tires_models` AS b ON a.id = b.brand_id JOIN `tires_all_` AS c ON b.id = c.model_id WHERE";
	$a='';
	foreach($id as $k=>$v){
		$a .= ' a.id=' . $v . ' OR ';
	}
	$res=$q . rtrim($a, ' OR ');
	
	$b = $m -> prepare($res);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
}
function getBrandID(){
$db = new Connection;	
	$m = $db -> db();
	$q = "SELECT * FROM `tires_brand` ORDER BY `name`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}

function shinifiltr($shinifiltr){
$db = new Connection;
$m = $db -> db();
$index_loading_between = explode(' - ',$shinifiltr['index_loading']);

if(!empty($shinifiltr['width']) AND !empty($shinifiltr['diameter']) AND !empty($shinifiltr['profile']) AND !empty($shinifiltr['index_loading']) AND !empty($shinifiltr['season'])){
		$data = getDiameterWidthProfileIndex_loadingSeason($shinifiltr['diameter'], $shinifiltr['width'], $shinifiltr['profile'], $index_loading_between, $shinifiltr['season']);
		//p($data1);
	}elseif(!empty($shinifiltr['width']) AND !empty($shinifiltr['diameter']) AND !empty($shinifiltr['profile']) AND !empty($shinifiltr['index_loading']) AND empty($shinifiltr['season'])){
		$data = getDiameterWidthProfileIndex_loading($shinifiltr['diameter'], $shinifiltr['width'], $shinifiltr['profile'], $index_loading_between);
		//p($data1);
	}elseif(empty($shinifiltr['profile']) AND !empty($shinifiltr['diameter']) AND !empty($shinifiltr['width']) AND !empty($shinifiltr['index_loading']) AND !empty($shinifiltr['season'])){
		$data = getDiameterWidthIndex_loadingSeason($shinifiltr['diameter'], $shinifiltr['width'], $index_loading_between, $shinifiltr['season']);
		//p($data1);
	}elseif(empty($shinifiltr['profile']) AND !empty($shinifiltr['diameter']) AND !empty($shinifiltr['width']) AND !empty($shinifiltr['index_loading']) AND empty($shinifiltr['season'])){
		$data = getDiameterWidthIndex_loading($shinifiltr['diameter'], $shinifiltr['width'], $index_loading_between);
		//p($data1);
	}elseif(empty($shinifiltr['width']) AND !empty($shinifiltr['diameter']) AND !empty($shinifiltr['profile']) AND !empty($shinifiltr['index_loading']) AND !empty($shinifiltr['season'])){
		$data = getDiameterProfileIndex_loadingSeason($shinifiltr['diameter'], $shinifiltr['profile'], $index_loading_between, $shinifiltr['season']);
		//p($data1);
	}elseif(empty($shinifiltr['width']) AND !empty($shinifiltr['diameter']) AND !empty($shinifiltr['profile']) AND !empty($shinifiltr['index_loading']) AND empty($shinifiltr['season'])){
		$data = getDiameterProfileIndex_loading($shinifiltr['diameter'], $shinifiltr['profile'], $index_loading_between);
		//p($data1);
	}elseif(empty($shinifiltr['diameter']) AND !empty($shinifiltr['width']) AND !empty($shinifiltr['profile']) AND !empty($shinifiltr['index_loading']) AND !empty($shinifiltr['season'])){
		$data = getProfileWidthIndex_loadingSeason($shinifiltr['profile'], $shinifiltr['width'], $index_loading_between, $shinifiltr['season']);
		//p($data1);
	}elseif(empty($shinifiltr['diameter']) AND !empty($shinifiltr['width']) AND !empty($shinifiltr['profile']) AND !empty($shinifiltr['index_loading']) AND empty($shinifiltr['season'])){
		$data = getProfileWidthIndex_loading($shinifiltr['profile'], $shinifiltr['width'], $index_loading_between);
		//p($data1);
	}elseif(empty($shinifiltr['width']) AND empty($shinifiltr['diameter']) AND !empty($shinifiltr['profile']) AND !empty($shinifiltr['index_loading']) AND !empty($shinifiltr['season'])){
		$data = getProfileIndex_loadingSeason($shinifiltr['profile'], $index_loading_between, $shinifiltr['season']);
		//p($data1);
	}elseif(empty($shinifiltr['width']) AND empty($shinifiltr['diameter']) AND !empty($shinifiltr['profile']) AND !empty($shinifiltr['index_loading']) AND empty($shinifiltr['season'])){
		$data = getProfileIndex_loading($shinifiltr['profile'], $index_loading_between);
		//p($data1);
	}elseif(empty($shinifiltr['profile']) AND empty($shinifiltr['width']) AND !empty($shinifiltr['diameter']) AND !empty($shinifiltr['index_loading']) AND !empty($shinifiltr['season'])){
		$data = getDiameterIndex_loadingSeason($shinifiltr['diameter'], $index_loading_between, $shinifiltr['season']);
		//p($data1);
	}elseif(empty($shinifiltr['profile']) AND empty($shinifiltr['width']) AND !empty($shinifiltr['diameter']) AND !empty($shinifiltr['index_loading']) AND empty($shinifiltr['season'])){
		$data = getDiameterIndex_loading($shinifiltr['diameter'], $index_loading_between);
		//p($data1);
	}elseif(empty($shinifiltr['profile']) AND !empty($shinifiltr['width']) AND empty($shinifiltr['diameter']) AND !empty($shinifiltr['index_loading']) AND !empty($shinifiltr['season'])){
		$data = getWidthIndex_loadingSeason($shinifiltr['width'], $index_loading_between, $shinifiltr['season']);
		//p($data1);
	}elseif(empty($shinifiltr['profile']) AND !empty($shinifiltr['width']) AND empty($shinifiltr['diameter']) AND !empty($shinifiltr['index_loading']) AND empty($shinifiltr['season'])){
		$data = getWidthIndex_loading($shinifiltr['width'], $index_loading_between);
		//p($data1);
	}elseif(empty($shinifiltr['profile']) AND empty($shinifiltr['diameter']) AND empty($shinifiltr['width']) AND !empty($shinifiltr['index_loading']) AND !empty($shinifiltr['season'])){
		$data = getIndex_loadingSeason($index_loading_between, $shinifiltr['season']);
		//p($data1);
	}elseif(empty($shinifiltr['profile']) AND empty($shinifiltr['diameter']) AND empty($shinifiltr['width']) AND !empty($shinifiltr['index_loading']) AND empty($shinifiltr['season'])){
		$data = getIndex_loading($index_loading_between);
		//p($data1);
	}else{
		$data=FALSE;
	}

return $data;
}

function filtroil($filtroil){
	$db = new Connection;
	$m = $db -> db();
	if(!empty($filtroil['toughness']) AND !empty($filtroil['amount']) AND !empty($filtroil['brand'])){
		$data = getToughnessAmountBrand($filtroil['toughness'], $filtroil['amount'], $filtroil['brand'], $filtroil['type_of_oil'], $filtroil['application_area']);
		//p($data2);
	}elseif(empty($filtroil['brand']) AND !empty($filtroil['amount']) AND !empty($filtroil['toughness'])){
		$data = getAmountToughness($filtroil['amount'], $filtroil['toughness'], $filtroil['type_of_oil'], $filtroil['application_area']);
		//p($data2);
	}elseif(empty($filtroil['toughness']) AND !empty($filtroil['amount']) AND !empty($filtroil['brand'])){
		$data = getAmountBrand($filtroil['amount'], $filtroil['brand'], $filtroil['type_of_oil'], $filtroil['application_area']);
		//p($data2);
	}elseif(empty($filtroil['amount']) AND !empty($filtroil['toughness']) AND !empty($filtroil['brand'])){
		$data = getBrandToughness($filtroil['brand'], $filtroil['toughness'], $filtroil['type_of_oil'], $filtroil['application_area']);
		//p($data2);
			}elseif(empty($filtroil['toughness']) AND empty($filtroil['amount']) AND !empty($filtroil['brand'])){
				$data = getBrand($filtroil['brand'], $filtroil['type_of_oil'], $filtroil['application_area']);
				//p($data2);
			}elseif(empty($filtroil['brand']) AND empty($filtroil['toughness']) AND !empty($filtroil['amount'])){
				$data = getAmount($filtroil['amount'], $filtroil['type_of_oil'], $filtroil['application_area']);
				//p($data2);
			}elseif(empty($filtroil['brand']) AND empty($filtroil['amount']) AND !empty($filtroil['toughness'])){
				$data = getToughness($filtroil['toughness'], $filtroil['type_of_oil'], $filtroil['application_area']);
				//p($data2);
			}elseif(empty($filtroil['brand']) AND empty($filtroil['amount']) AND empty($filtroil['toughness'])){
				$data = getType_of_oilApplication_area($filtroil['application_area'], $filtroil['type_of_oil']);
				//p($data2);
			}
return $data;
}
function getDiameterWidthProfileIndex_loadingSeason($diameter, $width, $profile, $index_loading_between, $season) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_all` AS a JOIN `tires_width` AS b ON a.width=b.value JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading=d.value JOIN `tires_brand` AS e ON c.brand_id=e.id JOIN `tires_diameter` AS f ON a.diameter=f.value JOIN `tires_profile` AS g ON a.profile=g.value WHERE ";
	$res=$q . ' a.width=' . '"' . $width . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	
	$res3='' . ' a.profile=' . '"' . $profile . '"';
	
	$res4='' . $season;
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' AND ' . $res4 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getDiameterWidthProfileIndex_loading($diameter, $width, $profile, $index_loading_between) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_all` AS a JOIN `tires_width` AS b ON a.width_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id JOIN `tires_diameter` AS f ON a.diameter_id=f.id JOIN `tires_profile` AS g ON a.profile_id=g.id WHERE ";
	$res=$q . ' b.value=' . '"' . $width . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	
	$res3='' . ' g.value=' . '"' . $profile . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}

function getDiameterWidthIndex_loadingSeason($diameter, $width, $index_loading_between, $season){
	$db = new Connection;
	$m = $db -> db();
	
	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_all` AS a JOIN `tires_width` AS b ON a.width_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id JOIN `tires_diameter` AS f ON a.diameter_id=f.id WHERE ";
	$res=$q . ' b.value=' . '"' . $width . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	$res3='' .  $season;
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
	
function getDiameterWidthIndex_loading($diameter, $width, $index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	
	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_all` AS a JOIN `tires_width` AS b ON a.width_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id JOIN `tires_diameter` AS f ON a.diameter_id=f.id WHERE ";
	$res=$q . ' b.value=' . '"' . $width . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}

function getDiameterProfileIndex_loadingSeason($diameter, $profile, $index_loading_between, $season) {
	$db = new Connection;
	$m = $db -> db();


	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_all` AS a JOIN `tires_profile` AS b ON a.profile_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id JOIN `tires_diameter` AS f ON a.diameter_id=f.id WHERE ";
	$res=$q . ' b.value=' . '"' . $profile . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	$res3='' .  $season;
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 .  ' AND ' . $res3 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}	
function getDiameterProfileIndex_loading($diameter, $profile, $index_loading_between) {
	$db = new Connection;
	$m = $db -> db();


	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_all` AS a JOIN `tires_profile` AS b ON a.profile_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id JOIN `tires_diameter` AS f ON a.diameter_id=f.id WHERE ";
	$res=$q . ' b.value=' . '"' . $profile . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}

function getProfileWidthIndex_loadingSeason($profile, $width, $index_loading_between, $season) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_all` AS a JOIN `tires_profile` AS b ON a.profile_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id JOIN `tires_width` AS f ON a.width_id=f.id WHERE ";
	$res=$q . ' b.value=' . '"' . $profile . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' f.value=' . '"' . $width . '"';
	$res3='' .  $season;
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 .  ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getProfileWidthIndex_loading($profile, $width, $index_loading_between) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_all` AS a JOIN `tires_profile` AS b ON a.profile_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id JOIN `tires_width` AS f ON a.width_id=f.id WHERE ";
	$res=$q . ' b.value=' . '"' . $profile . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' f.value=' . '"' . $width . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
	
	
	
function getProfileIndex_loadingSeason($profile, $index_loading_between, $season) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_all` AS a JOIN `tires_profile` AS b ON a.profile_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id WHERE ";
	$res=$q . ' b.value=' . '"' . $profile . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	$res2='' .  $season;
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getProfileIndex_loading($profile, $index_loading_between) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_all` AS a JOIN `tires_profile` AS b ON a.profile_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id WHERE ";
	$res=$q . ' b.value=' . '"' . $profile . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
	
function getDiameterIndex_loadingSeason($diameter, $index_loading_between, $season) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_all` AS a JOIN `tires_diameter` AS b ON a.diameter_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id WHERE";
	$res=$q . ' a.diameter=' . '"' . $diameter . '"';
	
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	$res2='' .  $season;
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
	
	
	
function getDiameterIndex_loading($diameter, $index_loading_between) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_all` AS a JOIN `tires_diameter` AS b ON a.diameter_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id WHERE";
	$res=$q . ' a.diameter=' . '"' . $diameter . '"';
	
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
	
	
	
	
	
	
	
/* 																МОЯ ПЕРВАЯ АФИГЕННАЯ ФУНКЦИЯ																*/
function getWidthIndex_loadingSeason($width, $index_loading_between, $season) {
	$db = new Connection;
	$m = $db -> db();
	
	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_all` AS a JOIN `tires_width` AS b ON a.width_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id WHERE ";
	$res=$q . ' b.value=' . '"' . $width . '"';
	
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	$res2='' .  $season;
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getWidthIndex_loading($width, $index_loading_between) {
	$db = new Connection;
	$m = $db -> db();
	
	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_all` AS a JOIN `tires_width` AS b ON a.width_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id WHERE ";
	$res=$q . ' b.value=' . '"' . $width . '"';
	
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getIndex_loadingSeason($index_loading_between, $season) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_all` AS a JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id WHERE" . ' (';
	$a1='d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1=$q . rtrim($a1, ' AND ') . ' )';
	$res2='' .  $season;
	
	$b = $m -> prepare($res1 . ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getIndex_loading($index_loading_between) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_all` AS a JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id WHERE" . ' (';
	$a1='d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1=$q . rtrim($a1, ' AND ') . ' )';
	
	$b = $m -> prepare($res1 . 'AND diameter>0 AND width>0 AND profile>0 ORDER BY a.diameter LIMIT 50');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
	


	









function getToughnessAmountBrand($toughness, $amount, $brand, $type_of_oil, $application_area) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT * FROM `oil_parser_motor_oil` WHERE toughness = :toughness AND amount = :amount AND brand = :brand AND application_area = :application_area AND type_of_oil = :type_of_oil";
	$b = $m -> prepare($q);
	$b -> execute(array(":toughness" => $toughness, ":amount" => $amount, ":brand" => $brand, ":application_area" => $application_area, ":type_of_oil" => $type_of_oil));
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getAmountToughness($amount, $toughness, $type_of_oil, $application_area) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT * FROM `oil_parser_motor_oil` WHERE amount = :amount AND toughness = :toughness AND type_of_oil = :type_of_oil AND application_area = :application_area";
	$b = $m -> prepare($q);
	$b -> execute(array(":amount" => $amount, ":toughness" => $toughness, ":type_of_oil" => $type_of_oil, ":application_area" => $application_area));
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
} 
function getAmountBrand($amount, $brand, $type_of_oil, $application_area) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT * FROM `oil_parser_motor_oil` WHERE amount = :amount AND brand = :brand AND type_of_oil = :type_of_oil AND application_area = :application_area";
	$b = $m -> prepare($q);
	$b -> execute(array(":amount" => $amount, ":brand" => $brand, ":type_of_oil" => $type_of_oil, ":application_area" => $application_area));
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
} 
function getBrandToughness($brand, $toughness, $type_of_oil, $application_area) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT * FROM `oil_parser_motor_oil` WHERE brand = :brand AND toughness = :toughness AND type_of_oil = :type_of_oil AND application_area = :application_area";
	$b = $m -> prepare($q);
	$b -> execute(array(":brand" => $brand, ":toughness" => $toughness, ":type_of_oil" => $type_of_oil, ":application_area" => $application_area));
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
} 
function getAmount($amount, $type_of_oil, $application_area) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT * FROM `oil_parser_motor_oil` WHERE amount = :amount AND type_of_oil = :type_of_oil AND application_area = :application_area";
	$b = $m -> prepare($q);
	$b -> execute(array(":amount" => $amount, ":type_of_oil" => $type_of_oil, ":application_area" => $application_area));
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	echo $amount . '<br>';
	echo $type_of_oil . '<br>';
	echo $application_area . '<br>';
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
} 
   
function getBrand($brand, $type_of_oil, $application_area) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT * FROM `oil_parser_motor_oil` WHERE brand = :brand AND type_of_oil = :type_of_oil AND application_area = :application_area";
	$b = $m -> prepare($q);
	$b -> execute(array(":brand" => $brand, ":type_of_oil" => $type_of_oil, ":application_area" => $application_area));
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
} 
function getToughness($toughness, $type_of_oil, $application_area) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT * FROM `oil_parser_motor_oil` WHERE toughness = :toughness AND type_of_oil = :type_of_oil AND application_area = :application_area";
	$b = $m -> prepare($q);
	$b -> execute(array(":toughness" => $toughness, ":type_of_oil" => $type_of_oil, ":application_area" => $application_area));
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
}

function getType_of_oilApplication_area($application_area, $type_of_oil) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT * FROM `oil_parser_motor_oil` WHERE type_of_oil = :type_of_oil AND application_area = :application_area";
	$b = $m -> prepare($q);
	$b -> execute(array(":type_of_oil" => $type_of_oil, ":application_area" => $application_area));
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
} 
function getDiameterAjax() {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT `diameter` FROM `tires_all` ORDER BY `diameter`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
}
function getWidthAjax() {
	$db = new Connection;
	$m = $db -> db();
	
	$q = "SELECT DISTINCT `width` FROM `tires_all` ORDER BY `width`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}  
function getProfileAjax() {
	$db = new Connection;
	$m = $db -> db();
	
	$q = "SELECT DISTINCT `profile` FROM `tires_all` ORDER BY `profile`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}
function getIndex_loadingAjax() {
	$db = new Connection;	
	$m = $db -> db();
	$q = "SELECT DISTINCT `index_loading` FROM `tires_all` WHERE index_loading!='' ORDER BY `index_loading`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}
function getSeasonAjax(){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT `value` FROM `tires_season` ORDER BY `value`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}
function getThornsAjax(){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT `value` FROM `tires_thorns` ORDER BY `value`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}
function getToughnessAjax() {
	$db = new Connection;	
	$m = $db -> db();
	$q = "SELECT DISTINCT `toughness` FROM `oil_parser_motor_oil` ORDER BY `toughness`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}
function getAmountAjax() {
	$db = new Connection;	
	$m = $db -> db();
	$q = "SELECT DISTINCT `amount` FROM `oil_parser_motor_oil` ORDER BY `amount`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}
function getBrandAjax() {
	$db = new Connection;	
	$m = $db -> db();
	$q = "SELECT DISTINCT `brand` FROM `oil_parser_motor_oil` ORDER BY `brand`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}
function getApplication_areaAjax() {
	$db = new Connection;	
	$m = $db -> db();
	$q = "SELECT DISTINCT `application_area` FROM `oil_parser_motor_oil` ORDER BY `application_area`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}
function getType_of_oilAjax() {
	$db = new Connection;	
	$m = $db -> db();
	$q = "SELECT DISTINCT `type_of_oil` FROM `oil_parser_motor_oil` ORDER BY `type_of_oil`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}

function getKartochkaTiresModel($id) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT a.*,c.brand,c.model,c.axis_type,c.chamber,b.country,b.country_id, b.image AS brand_img FROM `tires_models` AS a JOIN `tires_brand` AS b ON a.brand_id=b.id JOIN `tires_all` AS c ON a.id=c.model_id JOIN `tires_countries` AS g ON g.id=b.country_id WHERE a.id = :id";
	$b = $m -> prepare($q); 
	$b -> execute(array(":id" => $id));
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
}
function getKartochkaTiresParametr($id){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.*,c.image as brand_img FROM `tires_all` AS a JOIN `tires_brand` AS c ON c.id=a.brand_id WHERE a.id = :id";
	$b = $m -> prepare($q); 
	$b -> execute(array(":id" => $id));
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
	
}
function getKartochkaTiresParametrTruck($id){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.*,c.image as brand_img FROM `tires_truck` AS a JOIN `tires_brand` AS c ON c.id=a.brand_id WHERE a.id = :id";
	$b = $m -> prepare($q); 
	$b -> execute(array(":id" => $id));
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
	
}
function getPriceModelParametr($id){
$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_all` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . ' b.id=' . '"' . $id . '"';
	
	$b = $m -> prepare($res . ' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getPriceModelParametrTruck($id){
$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_truck` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . ' b.id=' . '"' . $id . '"';
	
	$b = $m -> prepare($res . ' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getSameTires($data){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT a.*,e.image as brand_img FROM `tires_all` AS a JOIN `tires_brand` AS e ON e.id=a.brand_id WHERE ";

	$res=$q . ' a.diameter=' . '"' . $data['diameter'] . '"' . ' AND' . ' a.width=' . '"' . $data['width'] . '"' . ' AND' . ' a.profile=' . '"' . $data['profile'] . '"';
	$res1='' . ' a.season=' . '"' . $data['season'] . '"';
	$res2='' . ' a.price BETWEEN ' . '"' . ($data['price']-1300) . '"' . ' AND ' . '"' . ($data['price']+5000) . '"';
	if(!empty($data['index_loading'])){
	$res3='' . ' AND a.index_loading_id BETWEEN ' . '"' . ($data['index_loading_id']-10) . '"' . ' AND ' . '"' . ($data['index_loading_id']+10) . '"';
	}else{
		$res3='""';
	}
	$res4='' . ' a.index_speed_id BETWEEN ' . '"' . ($data['index_speed_id']-5) . '"' . ' AND ' . '"' . ($data['index_speed_id']+50) . '"';
	$res5='' . ' a.id!= ' . '"' . $data['id'] . '"';
	
	$b = $m -> prepare($res . ' AND' . $res1 . ' AND' . $res2 . $res3 . ' AND' . $res4 . ' AND' . $res5 . ' ORDER BY price LIMIT 3');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getSameTiresMore($data){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT a.*,e.image as brand_img FROM `tires_all` AS a JOIN `tires_brand` AS e ON e.id=a.brand_id WHERE ";

	$res=$q . ' a.diameter=' . '"' . $data['diameter'] . '"' . ' AND' . ' a.width=' . '"' . $data['width'] . '"' . ' AND' . ' a.profile=' . '"' . $data['profile'] . '"';
	$res1='' . ' a.season=' . '"' . $data['season'] . '"';
	
	if(!empty($data['index_loading'])){
	$res3='' . ' a.index_loading_id BETWEEN ' . '"' . ($data['index_loading_id']-10) . '"' . ' AND ' . '"' . ($data['index_loading_id']+100) . '"';
	}else{
		$res3='""';
	}
	$res4='' . ' a.index_speed_id BETWEEN ' . '"' . ($data['index_speed_id']-5) . '"' . ' AND ' . '"' . ($data['index_speed_id']+500) . '"';
	$res5='' . ' a.id!= ' . '"' . $data['id'] . '"';
	
	$b = $m -> prepare($res . ' AND' . $res1 . ' AND' . $res3 . ' AND' . $res4 . ' AND' . $res5 . ' ORDER BY price DESC');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getSameTiresTruck($data){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT a.*,e.image as brand_img FROM `tires_truck` AS a JOIN `tires_brand` AS e ON e.id=a.brand_id WHERE ";

	$res=$q . ' a.diameter=' . '"' . $data['diameter'] . '"' . ' AND' . ' a.width=' . '"' . $data['width'] . '"' . ' AND' . ' a.profile=' . '"' . $data['profile'] . '"';
	$res1='' . ' a.season=' . '"' . $data['season'] . '"';
	$res2='' . ' a.price BETWEEN ' . '"' . ($data['price']-1300) . '"' . ' AND ' . '"' . ($data['price']+5000) . '"';
	if(!empty($data['index_loading'])){
	$res3='' . ' AND a.index_loading_id BETWEEN ' . '"' . ($data['index_loading_id']-10) . '"' . ' AND ' . '"' . ($data['index_loading_id']+10) . '"';
	}else{
		$res3='""';
	}
	$res4='' . ' a.index_speed_id BETWEEN ' . '"' . ($data['index_speed_id']-5) . '"' . ' AND ' . '"' . ($data['index_speed_id']+50) . '"';
	$res5='' . ' a.id!= ' . '"' . $data['id'] . '"';
	
	$b = $m -> prepare($res . ' AND' . $res1 . ' AND' . $res2 . $res3 . ' AND' . $res4 . ' AND' . $res5 . ' ORDER BY price LIMIT 3');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getSameTiresMoreTruck($data){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT a.*,e.image as brand_img FROM `tires_truck` AS a JOIN `tires_brand` AS e ON e.id=a.brand_id WHERE ";

	$res=$q . ' a.diameter=' . '"' . $data['diameter'] . '"' . ' AND' . ' a.width=' . '"' . $data['width'] . '"' . ' AND' . ' a.profile=' . '"' . $data['profile'] . '"';
	$res1='' . ' a.season=' . '"' . $data['season'] . '"';
	
	if(!empty($data['index_loading'])){
	$res3='' . ' a.index_loading_id BETWEEN ' . '"' . ($data['index_loading_id']-10) . '"' . ' AND ' . '"' . ($data['index_loading_id']+100) . '"';
	}else{
		$res3='""';
	}
	$res4='' . ' a.index_speed_id BETWEEN ' . '"' . ($data['index_speed_id']-5) . '"' . ' AND ' . '"' . ($data['index_speed_id']+500) . '"';
	$res5='' . ' a.id!= ' . '"' . $data['id'] . '"';
	
	$b = $m -> prepare($res . ' AND' . $res1 . ' AND' . $res3 . ' AND' . $res4 . ' AND' . $res5 . ' ORDER BY price DESC');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getModelParametr($id,$modelparametr){
	$db = new Connection;
$m = $db -> db();
$index_loading_between = explode(' - ',$modelparametr['index_loading']);
if(!empty($modelparametr['width']) AND !empty($modelparametr['diameter']) AND !empty($modelparametr['profile']) AND !empty($modelparametr['index_loading'])){
		$data = getParametrDiameterWidthProfileIndex_loading($id,$modelparametr['diameter'], $modelparametr['width'], $modelparametr['profile'], $index_loading_between);
		//p($data1);
	}elseif(empty($modelparametr['profile']) AND !empty($modelparametr['diameter']) AND !empty($modelparametr['width']) AND !empty($modelparametr['index_loading'])){
		$data = getParametrDiameterWidthIndex_loading($id,$modelparametr['diameter'], $modelparametr['width'], $index_loading_between);
		//p($data1);
	}elseif(empty($modelparametr['width']) AND !empty($modelparametr['diameter']) AND !empty($modelparametr['profile']) AND !empty($modelparametr['index_loading'])){
		$data = getParametrDiameterProfileIndex_loading($id,$modelparametr['diameter'], $modelparametr['profile'], $index_loading_between);
		//p($data1);
	}elseif(empty($modelparametr['diameter']) AND !empty($modelparametr['width']) AND !empty($modelparametr['profile']) AND !empty($modelparametr['index_loading'])){
		$data = getParametrProfileWidthIndex_loading($id, $modelparametr['width'],$modelparametr['profile'], $index_loading_between);
		//p($data1);
	}elseif(empty($modelparametr['width']) AND empty($modelparametr['diameter']) AND !empty($modelparametr['profile']) AND !empty($modelparametr['index_loading'])){
		$data = getParametrProfileIndex_loading($id,$modelparametr['profile'], $index_loading_between);
		//p($data1);
	}elseif(empty($modelparametr['profile']) AND empty($modelparametr['width']) AND !empty($modelparametr['diameter']) AND !empty($modelparametr['index_loading'])){
		$data = getParametrDiameterIndex_loading($id,$modelparametr['diameter'], $index_loading_between);
		//p($data1);
	}elseif(empty($modelparametr['profile']) AND !empty($modelparametr['width']) AND empty($modelparametr['diameter']) AND !empty($modelparametr['index_loading'])){
		$data = getParametrWidthIndex_loading($id,$modelparametr['width'], $index_loading_between);
		//p($data1);
	}elseif(empty($modelparametr['profile']) AND empty($modelparametr['diameter']) AND empty($modelparametr['width']) AND !empty($modelparametr['index_loading'])){
		$data = getParametrIndex_loading($id,$index_loading_between);
		//p($data1);
	}else{
		$data=FALSE;
	}

return $data;
}
										
									
function getParametrDiameterWidthProfileIndex_loading($id,$diameter,$width,$profile,$index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_all` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . ' b.id=' . '"' . $id . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	
	$res3='' . ' a.profile=' . '"' . $profile . '"';
	$res4='' . ' a.width=' . '"' . $width . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' AND ' . $res4 .' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}


function getParametrDiameterWidthIndex_loading($id,$diameter,$width,$index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_all` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . ' b.id=' . '"' . $id . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	
	$res4='' . ' a.width=' . '"' . $width . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res4 . ' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getParametrDiameterProfileIndex_loading($id,$diameter,$profile,$index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_all` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . ' b.id=' . '"' . $id . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	
	$res3='' . ' a.profile=' . '"' . $profile . '"';
	
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}

function getParametrProfileWidthIndex_loading($id,$width,$profile,$index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_all` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . 'b.id=' . '"' . $id . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	
	
	$res3='' . 'a.profile=' . '"' . $profile . '"';
	$res4='' . 'a.width=' . '"' . $width . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res3 . ' AND ' . $res4 . ' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}

function getParametrProfileIndex_loading($id,$profile,$index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_all` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . 'b.id=' . '"' . $id . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	
	
	$res3='' . 'a.profile=' . '"' . $profile . '"';
	
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res3 . ' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getParametrDiameterIndex_loading($id,$diameter,$index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_all` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . 'b.id=' . '"' . $id . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	$res3='' . ' a.diameter=' . '"' . $diameter . '"';
	
	
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res3 . ' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getParametrWidthIndex_loading($id,$width,$index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_all` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . ' b.id=' . '"' . $id . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res4='' . ' a.width=' . '"' . $width . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res4 . ' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}

function getParametrIndex_loading($id,$index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_all` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . 'b.id=' . '"' . $id . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	
	$b = $m -> prepare($res . ' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getModelParametrTruck($id,$modelparametr){
	$db = new Connection;
$m = $db -> db();
$index_loading_between = explode(' - ',$modelparametr['index_loading']);
if(!empty($modelparametr['width']) AND !empty($modelparametr['diameter']) AND !empty($modelparametr['profile']) AND !empty($modelparametr['index_loading'])){
		$data = getParametrDiameterWidthProfileIndex_loadingTruck($id,$modelparametr['diameter'], $modelparametr['width'], $modelparametr['profile'], $index_loading_between);
		//p($data1);
	}elseif(empty($modelparametr['profile']) AND !empty($modelparametr['diameter']) AND !empty($modelparametr['width']) AND !empty($modelparametr['index_loading'])){
		$data = getParametrDiameterWidthIndex_loadingTruck($id,$modelparametr['diameter'], $modelparametr['width'], $index_loading_between);
		//p($data1);
	}elseif(empty($modelparametr['width']) AND !empty($modelparametr['diameter']) AND !empty($modelparametr['profile']) AND !empty($modelparametr['index_loading'])){
		$data = getParametrDiameterProfileIndex_loadingTruck($id,$modelparametr['diameter'], $modelparametr['profile'], $index_loading_between);
		//p($data1);
	}elseif(empty($modelparametr['diameter']) AND !empty($modelparametr['width']) AND !empty($modelparametr['profile']) AND !empty($modelparametr['index_loading'])){
		$data = getParametrProfileWidthIndex_loadingTruck($id, $modelparametr['width'],$modelparametr['profile'], $index_loading_between);
		//p($data1);
	}elseif(empty($modelparametr['width']) AND empty($modelparametr['diameter']) AND !empty($modelparametr['profile']) AND !empty($modelparametr['index_loading'])){
		$data = getParametrProfileIndex_loadingTruck($id,$modelparametr['profile'], $index_loading_between);
		//p($data1);
	}elseif(empty($modelparametr['profile']) AND empty($modelparametr['width']) AND !empty($modelparametr['diameter']) AND !empty($modelparametr['index_loading'])){
		$data = getParametrDiameterIndex_loadingTruck($id,$modelparametr['diameter'], $index_loading_between);
		//p($data1);
	}elseif(empty($modelparametr['profile']) AND !empty($modelparametr['width']) AND empty($modelparametr['diameter']) AND !empty($modelparametr['index_loading'])){
		$data = getParametrWidthIndex_loadingTruck($id,$modelparametr['width'], $index_loading_between);
		//p($data1);
	}elseif(empty($modelparametr['profile']) AND empty($modelparametr['diameter']) AND empty($modelparametr['width']) AND !empty($modelparametr['index_loading'])){
		$data = getParametrIndex_loadingTruck($id,$index_loading_between);
		//p($data1);
	}else{
		$data=FALSE;
	}

return $data;
}
										
									
function getParametrDiameterWidthProfileIndex_loadingTruck($id,$diameter,$width,$profile,$index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_truck` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . ' b.id=' . '"' . $id . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	
	$res3='' . ' a.profile=' . '"' . $profile . '"';
	$res4='' . ' a.width=' . '"' . $width . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' AND ' . $res4 .' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}


function getParametrDiameterWidthIndex_loadingTruck($id,$diameter,$width,$index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_truck` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . ' b.id=' . '"' . $id . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	
	$res4='' . ' a.width=' . '"' . $width . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res4 . ' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getParametrDiameterProfileIndex_loadingTruck($id,$diameter,$profile,$index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_truck` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . ' b.id=' . '"' . $id . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	
	$res3='' . ' a.profile=' . '"' . $profile . '"';
	
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}

function getParametrProfileWidthIndex_loadingTruck($id,$width,$profile,$index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_truck` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . 'b.id=' . '"' . $id . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	
	
	$res3='' . 'a.profile=' . '"' . $profile . '"';
	$res4='' . 'a.width=' . '"' . $width . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res3 . ' AND ' . $res4 . ' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}

function getParametrProfileIndex_loadingTruck($id,$profile,$index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_truck` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . 'b.id=' . '"' . $id . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	
	
	$res3='' . 'a.profile=' . '"' . $profile . '"';
	
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res3 . ' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getParametrDiameterIndex_loadingTruck($id,$diameter,$index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_truck` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . 'b.id=' . '"' . $id . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	$res3='' . ' a.diameter=' . '"' . $diameter . '"';
	
	
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res3 . ' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getParametrWidthIndex_loadingTruck($id,$width,$index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_truck` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . ' b.id=' . '"' . $id . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res4='' . ' a.width=' . '"' . $width . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res4 . ' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}

function getParametrIndex_loadingTruck($id,$index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT a.* FROM `tires_truck` AS a JOIN `tires_models` AS b ON b.id=a.model_id WHERE ";

	$res=$q . 'b.id=' . '"' . $id . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	
	$b = $m -> prepare($res . ' ORDER BY a.diameter, a.width, a.profile, a.index_loading');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getTiresPrimen($tiresprimen){
$db = new Connection;
$m = $db -> db();


if(!empty($tiresprimen['marka']) AND !empty($tiresprimen['model'])){
		$data = getTiresMarkaModel($tiresprimen['marka'], $tiresprimen['model']);
		//p($data1);
	}elseif(empty($tiresprimen['marka']) AND !empty($tiresprimen['model'])){
		$data = getTiresModel($tiresprimen['model']);
		//p($data1);
	}elseif(!empty($tiresprimen['marka']) AND empty($tiresprimen['model'])){
		$data = getTiresMarka($tiresprimen['model']);
		//p($data1);
	}else{
		$data=FALSE;
	}

return $data;
}
function getTiresMarkaModel($marka, $model) {
	$db = new Connection;
	$m = $db -> db();
	$q="SELECT DISTINCT c.*,b.diameter,b.width,b.profile,a.brand,b.index_loading_min,b.index_loading_max,b.car_image,a.model,e.image as brand_img FROM `tires_all` AS a JOIN `tires_shiny_primen` AS b ON b.diameter=a.diameter AND b.width=a.width AND b.profile=a.profile JOIN `tires_models` AS c ON c.id=a.model_id JOIN `tires_brand` AS e ON e.id=c.brand_id WHERE ";
	$res1=$q . 'b.model=' . '"' . $model . '"';
	$res2='' . 'b.marka=' . '"' . $marka . '"';
	
	$b = $m -> prepare($res1 . ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getTiresModel($model) {
	$db = new Connection;
	$m = $db -> db();
	$q="SELECT c.*,b.diameter,b.width,b.profile,a.brand,b.index_loading_min,b.index_loading_max,b.car_image,a.brand,a.model,e.image as brand_img FROM `tires_all` AS a JOIN `tires_shiny_primen` AS b ON b.diameter=a.diameter AND b.width=a.width AND b.profile=a.profile JOIN `tires_models` AS c ON c.id=a.model_id JOIN `tires_brand` AS e ON e.id=c.brand_id WHERE ";
	$res1=$q . 'b.model=' . '"' . $model . '"';
	
	
	$b = $m -> prepare($res1 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getTiresMarka($marka) {
	$db = new Connection;
	$m = $db -> db();
	$q="SELECT c.*,b.diameter,b.width,b.profile,a.brand,b.index_loading_min,b.index_loading_max,b.car_image,a.brand,a.model,e.image as brand_img FROM `tires_all` AS a JOIN `tires_shiny_primen` AS b ON b.diameter=a.diameter AND b.width=a.width AND b.profile=a.profile JOIN `tires_models` AS c ON c.id=a.model_id JOIN `tires_brand` AS e ON e.id=c.brand_id WHERE ";
	
	$res2=$q . 'b.marka=' . '"' . $marka . '"';
	
	$b = $m -> prepare($res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getMarka(){
	$db = new Connection;	
	$m = $db -> db();
	$q = "SELECT DISTINCT `marka` FROM `tires_shiny_primen`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}
function getModel(){
	$db = new Connection;	
	$m = $db -> db();
	$q = "SELECT DISTINCT `model` FROM `tires_shiny_primen`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}
function getPrimenModelParametr($id,$modelparametr){
	$db = new Connection;
$m = $db -> db();

if(!empty($modelparametr['marka']) AND !empty($modelparametr['model'])){
		$data = getParametrTiresMarkaModel($id,$modelparametr['marka'], $modelparametr['model']);
		//p($data1);
	}elseif(empty($modelparametr['marka']) AND !empty($modelparametr['model'])){
		$data = getParametrTiresModel($id,$modelparametr['model']);
		//p($data1);
	}elseif(!empty($modelparametr['marka']) AND empty($modelparametr['model'])){
		$data = getParametrTiresMarka($id,$modelparametr['marka']);
		//p($data1);
	}else{
		$data=FALSE;
	}

return $data;
}
function getParametrTiresMarkaModel($id, $marka, $model) {
	$db = new Connection;
	$m = $db -> db();
	$q="SELECT a.* FROM `tires_all` AS a JOIN `tires_shiny_primen` AS b ON b.diameter=a.diameter AND b.width=a.width AND b.profile=a.profile JOIN `tires_models` AS c ON c.id=a.model_id WHERE ";
	$res='' . 'c.id=' . '"' . $id . '"';
	$res1='' . 'b.model=' . '"' . $model . '"';
	$res2='' . 'b.marka=' . '"' . $marka . '"';
	
	$b = $m -> prepare($q . $res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY a.diameter, a.width, a.profile');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getParametrTiresModel($id, $model) {
	$db = new Connection;
	$m = $db -> db();
	$q="SELECT a.* FROM `tires_all` AS a JOIN `tires_shiny_primen` AS b ON b.diameter=a.diameter AND b.width=a.width AND b.profile=a.profile JOIN `tires_models` AS c ON c.id=a.model_id WHERE ";
	$res='' . 'c.id=' . '"' . $id . '"';
	$res1='' . 'b.model=' . '"' . $model . '"';

	$b = $m -> prepare($q . $res . ' AND ' . $res1 . ' ORDER BY a.diameter, a.width, a.profile');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getParametrTiresMarka($id, $marka) {
	$db = new Connection;
	$m = $db -> db();
	$q="SELECT a.* FROM `tires_all` AS a JOIN `tires_shiny_primen` AS b ON b.diameter=a.diameter AND b.width=a.width AND b.profile=a.profile JOIN `tires_models` AS c ON c.id=a.model_id WHERE ";
	$res='' . 'c.id=' . '"' . $id . '"';
	$res2='' . 'b.marka=' . '"' . $marka . '"';
	
	$b = $m -> prepare($q . $res . ' AND ' . $res2 . ' ORDER BY a.diameter, a.width, a.profile');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function getTiresMain() {
	$db = new Connection;
	$m = $db -> db();
	$q="SELECT DISTINCT c.*, a.brand, a.model,e.image as brand_img FROM `tires_all` AS a JOIN `tires_models` AS c ON c.id=a.model_id JOIN `tires_brand` AS e ON e.id=c.brand_id WHERE a.diameter=14 ";
	$b = $m -> prepare($q . 'ORDER BY c.brand_id LIMIT 50');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function getParametrMain($id) {
	$db = new Connection;
	$m = $db -> db();
	$q="SELECT a.* FROM `tires_all` AS a JOIN `tires_models` AS c ON c.id=a.model_id WHERE ";
	$res='' . 'c.id=' . '"' . $id . '"';
	
	$b = $m -> prepare($q . $res . ' ORDER BY a.diameter, a.width, a.profile');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getParametrMainTruck($id) {
	$db = new Connection;
	$m = $db -> db();
	$q="SELECT a.* FROM `tires_truck` AS a JOIN `tires_models` AS c ON c.id=a.model_id WHERE ";
	$res='' . 'c.id=' . '"' . $id . '"';
	
	$b = $m -> prepare($q . $res . ' ORDER BY a.diameter, a.width, a.profile');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}












/*грузовые шины*/














function shinifiltrTruck($shinifiltr){
$db = new Connection;
$m = $db -> db();
$index_loading_between = explode(' - ',$shinifiltr['index_loading']);

if(!empty($shinifiltr['width']) AND !empty($shinifiltr['diameter']) AND !empty($shinifiltr['profile']) AND !empty($shinifiltr['index_loading']) AND !empty($shinifiltr['chamber'])){
		$data = getDiameterWidthProfileIndex_loadingChamberTruck($shinifiltr['diameter'], $shinifiltr['width'], $shinifiltr['profile'], $index_loading_between, $shinifiltr['chamber']);
		//p($data1);
	}elseif(!empty($shinifiltr['width']) AND !empty($shinifiltr['diameter']) AND !empty($shinifiltr['profile']) AND !empty($shinifiltr['index_loading']) AND empty($shinifiltr['chamber'])){
		$data = getDiameterWidthProfileIndex_loadingTruck($shinifiltr['diameter'], $shinifiltr['width'], $shinifiltr['profile'], $index_loading_between);
		//p($data1);
	}elseif(empty($shinifiltr['profile']) AND !empty($shinifiltr['diameter']) AND !empty($shinifiltr['width']) AND !empty($shinifiltr['index_loading']) AND !empty($shinifiltr['chamber'])){
		$data = getDiameterWidthIndex_loadingChamberTruck($shinifiltr['diameter'], $shinifiltr['width'], $index_loading_between, $shinifiltr['chamber']);
		//p($data1);
	}elseif(empty($shinifiltr['profile']) AND !empty($shinifiltr['diameter']) AND !empty($shinifiltr['width']) AND !empty($shinifiltr['index_loading']) AND empty($shinifiltr['chamber'])){
		$data = getDiameterWidthIndex_loadingTruck($shinifiltr['diameter'], $shinifiltr['width'], $index_loading_between);
		//p($data1);
	}elseif(empty($shinifiltr['width']) AND !empty($shinifiltr['diameter']) AND !empty($shinifiltr['profile']) AND !empty($shinifiltr['index_loading']) AND !empty($shinifiltr['chamber'])){
		$data = getDiameterProfileIndex_loadingChamberTruck($shinifiltr['diameter'], $shinifiltr['profile'], $index_loading_between, $shinifiltr['chamber']);
		//p($data1);
	}elseif(empty($shinifiltr['width']) AND !empty($shinifiltr['diameter']) AND !empty($shinifiltr['profile']) AND !empty($shinifiltr['index_loading']) AND empty($shinifiltr['chamber'])){
		$data = getDiameterProfileIndex_loadingTruck($shinifiltr['diameter'], $shinifiltr['profile'], $index_loading_between);
		//p($data1);
	}elseif(empty($shinifiltr['diameter']) AND !empty($shinifiltr['width']) AND !empty($shinifiltr['profile']) AND !empty($shinifiltr['index_loading']) AND !empty($shinifiltr['chamber'])){
		$data = getProfileWidthIndex_loadingChamberTruck($shinifiltr['profile'], $shinifiltr['width'], $index_loading_between, $shinifiltr['chamber']);
		//p($data1);
	}elseif(empty($shinifiltr['diameter']) AND !empty($shinifiltr['width']) AND !empty($shinifiltr['profile']) AND !empty($shinifiltr['index_loading']) AND empty($shinifiltr['chamber'])){
		$data = getProfileWidthIndex_loadingTruck($shinifiltr['profile'], $shinifiltr['width'], $index_loading_between);
		//p($data1);
	}elseif(empty($shinifiltr['width']) AND empty($shinifiltr['diameter']) AND !empty($shinifiltr['profile']) AND !empty($shinifiltr['index_loading']) AND !empty($shinifiltr['chamber'])){
		$data = getProfileIndex_loadingChamberTruck($shinifiltr['profile'], $index_loading_between, $shinifiltr['chamber']);
		//p($data1);
	}elseif(empty($shinifiltr['width']) AND empty($shinifiltr['diameter']) AND !empty($shinifiltr['profile']) AND !empty($shinifiltr['index_loading']) AND empty($shinifiltr['chamber'])){
		$data = getProfileIndex_loadingTruck($shinifiltr['profile'], $index_loading_between);
		//p($data1);
	}elseif(empty($shinifiltr['profile']) AND empty($shinifiltr['width']) AND !empty($shinifiltr['diameter']) AND !empty($shinifiltr['index_loading']) AND !empty($shinifiltr['chamber'])){
		$data = getDiameterIndex_loadingChamberTruck($shinifiltr['diameter'], $index_loading_between, $shinifiltr['chamber']);
		//p($data1);
	}elseif(empty($shinifiltr['profile']) AND empty($shinifiltr['width']) AND !empty($shinifiltr['diameter']) AND !empty($shinifiltr['index_loading']) AND empty($shinifiltr['chamber'])){
		$data = getDiameterIndex_loadingTruck($shinifiltr['diameter'], $index_loading_between);
		//p($data1);
	}elseif(empty($shinifiltr['profile']) AND !empty($shinifiltr['width']) AND empty($shinifiltr['diameter']) AND !empty($shinifiltr['index_loading']) AND !empty($shinifiltr['chamber'])){
		$data = getWidthIndex_loadingChamberTruck($shinifiltr['width'], $index_loading_between, $shinifiltr['chamber']);
		//p($data1);
	}elseif(empty($shinifiltr['profile']) AND !empty($shinifiltr['width']) AND empty($shinifiltr['diameter']) AND !empty($shinifiltr['index_loading']) AND empty($shinifiltr['chamber'])){
		$data = getWidthIndex_loadingTruck($shinifiltr['width'], $index_loading_between);
		//p($data1);
	}elseif(empty($shinifiltr['profile']) AND empty($shinifiltr['diameter']) AND empty($shinifiltr['width']) AND !empty($shinifiltr['index_loading']) AND !empty($shinifiltr['chamber'])){
		$data = getIndex_loadingChamberTruck($index_loading_between, $shinifiltr['chamber']);
		//p($data1);
	}elseif(empty($shinifiltr['profile']) AND empty($shinifiltr['diameter']) AND empty($shinifiltr['width']) AND !empty($shinifiltr['index_loading']) AND empty($shinifiltr['chamber'])){
		$data = getIndex_loadingTruck($index_loading_between);
		//p($data1);
	}else{
		$data=FALSE;
	}

return $data;
}

function getDiameterWidthProfileIndex_loadingChamberTruck($diameter, $width, $profile, $index_loading_between, $chamber) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_truck` AS a JOIN `tires_width` AS b ON a.width=b.value JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading=d.value JOIN `tires_brand` AS e ON c.brand_id=e.id JOIN `tires_diameter` AS f ON a.diameter=f.value JOIN `tires_profile` AS g ON a.profile=g.value WHERE ";
	$res=$q . ' a.width=' . '"' . $width . '"';
	
	$a1='(a.index_loading BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	
	$res3='' . ' a.profile=' . '"' . $profile . '"';
	
	$res4='' . ' a.chamber=' . '"' . $chamber . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' AND ' . $res4 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getDiameterWidthProfileIndex_loadingTruck($diameter, $width, $profile, $index_loading_between) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_truck` AS a JOIN `tires_width` AS b ON a.width_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id JOIN `tires_diameter` AS f ON a.diameter_id=f.id JOIN `tires_profile` AS g ON a.profile_id=g.id WHERE ";
	$res=$q . ' b.value=' . '"' . $width . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	
	$res3='' . ' g.value=' . '"' . $profile . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}

function getDiameterWidthIndex_loadingChamberTruck($diameter, $width, $index_loading_between, $chamber){
	$db = new Connection;
	$m = $db -> db();
	
	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_truck` AS a JOIN `tires_width` AS b ON a.width_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id JOIN `tires_diameter` AS f ON a.diameter_id=f.id WHERE ";
	$res=$q . ' b.value=' . '"' . $width . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	$res3='' .  ' a.chamber=' . '"' . $chamber . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
	
function getDiameterWidthIndex_loadingTruck($diameter, $width, $index_loading_between){
	$db = new Connection;
	$m = $db -> db();
	
	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_truck` AS a JOIN `tires_width` AS b ON a.width_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id JOIN `tires_diameter` AS f ON a.diameter_id=f.id WHERE ";
	$res=$q . ' b.value=' . '"' . $width . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}

function getDiameterProfileIndex_loadingChamberTruck($diameter, $profile, $index_loading_between, $chamber) {
	$db = new Connection;
	$m = $db -> db();


	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_truck` AS a JOIN `tires_profile` AS b ON a.profile_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id JOIN `tires_diameter` AS f ON a.diameter_id=f.id WHERE ";
	$res=$q . ' b.value=' . '"' . $profile . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	$res3='' .  ' a.chamber=' . '"' . $chamber . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 .  ' AND ' . $res3 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}	
function getDiameterProfileIndex_loadingTruck($diameter, $profile, $index_loading_between) {
	$db = new Connection;
	$m = $db -> db();


	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_truck` AS a JOIN `tires_profile` AS b ON a.profile_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id JOIN `tires_diameter` AS f ON a.diameter_id=f.id WHERE ";
	$res=$q . ' b.value=' . '"' . $profile . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' a.diameter=' . '"' . $diameter . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}

function getProfileWidthIndex_loadingChamberTruck($profile, $width, $index_loading_between, $chamber) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_truck` AS a JOIN `tires_profile` AS b ON a.profile_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id JOIN `tires_width` AS f ON a.width_id=f.id WHERE ";
	$res=$q . ' b.value=' . '"' . $profile . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' f.value=' . '"' . $width . '"';
	$res3='' .  ' a.chamber=' . '"' . $chamber . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 .  ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getProfileWidthIndex_loadingTruck($profile, $width, $index_loading_between) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_truck` AS a JOIN `tires_profile` AS b ON a.profile_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id JOIN `tires_width` AS f ON a.width_id=f.id WHERE ";
	$res=$q . ' b.value=' . '"' . $profile . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$res2='' . ' f.value=' . '"' . $width . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
	
	
	
function getProfileIndex_loadingChamberTruck($profile, $index_loading_between, $chamber) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_truck` AS a JOIN `tires_profile` AS b ON a.profile_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id WHERE ";
	$res=$q . ' b.value=' . '"' . $profile . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	$res2='' .  ' a.chamber=' . '"' . $chamber . '"';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getProfileIndex_loadingTruck($profile, $index_loading_between) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_truck` AS a JOIN `tires_profile` AS b ON a.profile_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id WHERE ";
	$res=$q . ' b.value=' . '"' . $profile . '"';
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
	
function getDiameterIndex_loadingChamberTruck($diameter, $index_loading_between, $chamber) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_truck` AS a JOIN `tires_diameter` AS b ON a.diameter_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id WHERE";
	$res=$q . ' a.diameter=' . '"' . $diameter . '"';
	
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	$res2='' .  ' a.chamber=' . '"' . $chamber . '"';
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
	
	
	
function getDiameterIndex_loadingTruck($diameter, $index_loading_between) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_truck` AS a JOIN `tires_diameter` AS b ON a.diameter_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id WHERE";
	$res=$q . ' a.diameter=' . '"' . $diameter . '"';
	
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' ORDER BY c.brand_id LIMIT 50');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
	
	
	
	
	
	
	
/* 																МОЯ ПЕРВАЯ АФИГЕННАЯ ФУНКЦИЯ																*/
function getWidthIndex_loadingChamberTruck($width, $index_loading_between, $chamber) {
	$db = new Connection;
	$m = $db -> db();
	
	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_truck` AS a JOIN `tires_width` AS b ON a.width_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id WHERE ";
	$res=$q . ' b.value=' . '"' . $width . '"';
	
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	$res2='' .  ' a.chamber=' . '"' . $chamber . '"';
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getWidthIndex_loadingTruck($width, $index_loading_between) {
	$db = new Connection;
	$m = $db -> db();
	
	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_truck` AS a JOIN `tires_width` AS b ON a.width_id=b.id JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id WHERE ";
	$res=$q . ' b.value=' . '"' . $width . '"';
	
	
	$a1='(d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	
	$b = $m -> prepare($res . ' AND ' . $res1 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getIndex_loadingChamberTruck($index_loading_between, $chamber) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_truck` AS a JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id WHERE" . ' (';
	$a1='d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1=$q . rtrim($a1, ' AND ') . ' )';
	$res2='' . ' a.chamber=' . '"' . $chamber . '"';
	
	$b = $m -> prepare($res1 . ' AND ' . $res2 . ' ORDER BY c.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getIndex_loadingTruck($index_loading_between) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT c.*,a.brand,a.model,e.image AS brand_img FROM `tires_truck` AS a JOIN `tires_models` AS c ON a.model_id=c.id JOIN `tires_index_loading` AS d ON a.index_loading_id=d.id JOIN `tires_brand` AS e ON c.brand_id=e.id WHERE" . ' (';
	$a1='d.value BETWEEN ';
	foreach($index_loading_between as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1=$q . rtrim($a1, ' AND ') . ' )';
	
	$b = $m -> prepare($res1 . 'AND diameter>0 AND width>0 AND profile>0 ORDER BY a.diameter LIMIT 50');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}






/*   получение значений    */







function getDiameterTruckAjax() {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT `diameter` FROM `tires_truck` ORDER BY `diameter`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
}
function getWidthTruckAjax() {
	$db = new Connection;
	$m = $db -> db();
	
	$q = "SELECT DISTINCT `width`,`width_spec` FROM `tires_truck` ORDER BY `width`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}  
function getProfileTruckAjax() {
	$db = new Connection;
	$m = $db -> db();
	
	$q = "SELECT DISTINCT `profile` FROM `tires_truck` ORDER BY `profile`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}
function getIndex_loadingTruckAjax() {
	$db = new Connection;	
	$m = $db -> db();
	$q = "SELECT DISTINCT b.value FROM `tires_truck` AS a JOIN `tires_index_loading` AS b ON a.index_loading_id=b.id WHERE a.index_loading!='' ORDER BY b.value";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}
function getSeasonTruckAjax(){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT `typeof_use` FROM `tires_truck` ORDER BY `typeof_use`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}
function getChamberTruckAjax(){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT `chamber` FROM `tires_truck` ORDER BY `chamber`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}
function getAxisTruck(){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT `axis_type` FROM `tires_truck` ORDER BY `axis_type`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}
function getTiresMainTruck() {
	$db = new Connection;
	$m = $db -> db();
	$q="SELECT DISTINCT c.*, a.brand, a.model,e.image as brand_img FROM `tires_truck` AS a JOIN `tires_models` AS c ON c.id=a.model_id JOIN `tires_brand` AS e ON e.id=c.brand_id WHERE a.profile=80 AND a.images!='' ";
	$b = $m -> prepare($q . 'ORDER BY c.brand_id LIMIT 50');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getTiresMainBrandTruck() {
	$db = new Connection;
	$m = $db -> db();
	$q="SELECT DISTINCT a.brand,e.image as brand_img FROM `tires_truck` AS a JOIN `tires_brand` AS e ON e.id=a.brand_id WHERE e.image!='' ";
	$b = $m -> prepare($q . 'ORDER BY a.brand_id');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
}
function getWidthSpec($width){
	$db = new Connection;
	$m = $db -> db();
	
	$q = "SELECT DISTINCT `width_spec` FROM `tires_truck` WHERE `width`=" . '"' . $width . '"';
	
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}	







<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


require __DIR__ . '/Connection.php';


/* ФУНКЦИИ ФИЛЬТРА АККУМУЛЯТОРЫ*/
function filtrakum1($filtrakum1){
	$db = new Connection;
	$m = $db -> db();
	$emkostbetween = explode('-', $filtrakum['emkost']);
	$currentvybor = explode('-', $filtrakum['current']);
	
	if(!empty($filtrakum1['emkost']) AND !empty($filtrakum1['polarity']) AND !empty($filtrakum1['country']) AND !empty($filtrakum1['current'])){
		$data = getEmkostPolarityCountryCurrent($emkostbetween, $filtrakum1['polarity'], $filtrakum1['country'], $currentvybor);
		//p($data);
		
	}elseif(!empty($filtrakum1['emkost']) AND !empty($filtrakum1['country']) AND !empty($filtrakum1['current']) AND empty($filtrakum1['polarity'])){
		$data = getEmkostcountryCurrent($emkostbetween, $filtrakum1['country'], $currentvybor);
		//p($data);
		
	}elseif(!empty($filtrakum1['emkost']) AND !empty($filtrakum1['polarity']) AND !empty($filtrakum1['current']) AND empty($filtrakum1['country'])){
		$data = getEmkostPolarityCurrent($emkostbetween, $filtrakum1['polarity'], $currentvybor);
		//p($data);
		
	}elseif(!empty($filtrakum1['emkost']) AND !empty($filtrakum1['current']) AND empty($filtrakum1['country']) AND empty($filtrakum1['polarity'])){
		$data = getEmkostCurrent($emkostbetween, $currentvybor);
		//p($data);
	}elseif(!empty($filtrakum1['emkost']) AND !empty($filtrakum1['polarity']) AND !empty($filtrakum1['country']) AND empty($filtrakum1['current'])){
		$data = getEmkostPolaritycountry($emkostbetween, $filtrakum1['polarity'], $filtrakum1['country']);
		//p($data);
	}elseif(!empty($filtrakum1['emkost']) AND !empty($filtrakum1['country']) AND empty($filtrakum1['current']) AND empty($filtrakum1['polarity'])){
		$data = getEmkostCountry($emkostbetween, $filtrakum1['country']);
		//p($data);	
	}elseif(!empty($filtrakum1['emkost']) AND !empty($filtrakum1['polarity']) AND empty($filtrakum1['current']) AND empty($filtrakum1['country'])){
		$data = getEmkostPolarity($emkostbetween, $filtrakum1['polarity']);
		//p($data);	
	}elseif(!empty($filtrakum1['emkost']) AND empty($filtrakum1['polarity']) AND empty($filtrakum1['current']) AND empty($filtrakum['country'])){
		$data = getEmkost1($emkostbetween);
		//p($data);		
	
		
	}
	
	
	else{
				$data=FALSE;
	}
					
	return $data;
	}	

	
function getEmkostPolarityCountryCurrent($emkostbetween, $polarity, $country, $currentvybor) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT * FROM `Akumulators_akbmag` WHERE" . ' (';
	$a='emkost BETWEEN ';
	foreach($emkostbetween as $k=>$v){
		$a .=$v . ' AND ';
	}
	$res=$q . rtrim($a, ' AND ') . ' )';
	$res1='' . 'polarity=' . '"' . $polarity . '"';
	$res2='' . 'country=' . '"' . $country . '"';
	$a3='(current BETWEEN ';
	foreach($currentvybor as $k3=>$v3){
		$a3 .=$v3 . ' AND ';
	}
	$res3='' . rtrim($a3, ' AND ') . ' )';
	//echo $res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY `country`,`polarity`,`emkost`,`current`';
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY `country`,`polarity`,`emkost`,`current`');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}

function getEmkostCountryCurrent($emkostbetween, $country, $currentvybor) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT * FROM `Akumulators_akbmag` WHERE" . ' (';
	$a='emkost BETWEEN ';
	foreach($emkostbetween as $k=>$v){
		$a .=$v . ' AND ';
	}
	$res=$q . rtrim($a, ' AND ') . ' )';
	$res1='' . 'country=' . '"' . $country . '"';
	$a2='(current BETWEEN ';
	foreach($currentvybor as $k2=>$v2){
		$a2 .=$v2 . ' AND ';
	}
	$res2='' . rtrim($a2, ' AND ') . ' )';
	//echo $res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY `country`,`emkost`,`current`';
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY `country`,`emkost`,`current`');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getEmkostPolarityCurrent($emkostbetween, $polarity, $currentvybor) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT * FROM `Akumulators_akbmag` WHERE" . ' (';
	$a='emkost BETWEEN ';
	foreach($emkostbetween as $k=>$v){
		$a .=$v . ' AND ';
	}
	$res=$q . rtrim($a, ' AND ') . ' )';
	$res1='' . 'polarity=' . '"' . $polarity . '"';
	$a2='(current BETWEEN ';
	foreach($currentvybor as $k2=>$v2){
		$a2 .=$v2 . ' AND ';
	}
	$res2='' . rtrim($a2, ' AND ') . ' )';
	//echo $res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY `country`,`emkost`,`current`';
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY `country`,`emkost`,`current`');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getEmkostCurrent($emkostbetween, $currentvybor) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT * FROM `Akumulators_akbmag` WHERE" . ' (';
	$a='emkost BETWEEN ';
	foreach($emkostbetween as $k=>$v){
		$a .=$v . ' AND ';
	}
	$res=$q . rtrim($a, ' AND ') . ' )';
	$a1='(current BETWEEN ';
	foreach($currentvybor as $k1=>$v1){
		$a1 .=$v1 . ' AND ';
	}
	$res1='' . rtrim($a1, ' AND ') . ' )';
	//echo $res . ' AND ' . $res1 . ' ORDER BY `country`,`emkost`,`current`';
	$b = $m -> prepare($res . ' AND ' . $res1 . ' ORDER BY `country`,`emkost`,`current`');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}

function getEmkostPolarityCountry($emkostbetween, $polarity, $country) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT * FROM `Akumulators_akbmag` WHERE" . ' (';
	$a='emkost BETWEEN ';
	foreach($emkostbetween as $k=>$v){
		$a .=$v . ' AND ';
	}
	$res=$q . rtrim($a, ' AND ') . ' )';
	$res1='' . 'polarity=' . '"' . $polarity . '"';
	$res2='' . 'country=' . '"' . $country . '"';
		//echo $res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY `country`,`polarity`,`emkost`,`current`';
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY `country`,`polarity`,`emkost`,`current`');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getEmkostCountry($emkostbetween, $country) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT * FROM `Akumulators_akbmag` WHERE" . ' (';
	$a='emkost BETWEEN ';
	foreach($emkostbetween as $k=>$v){
		$a .=$v . ' AND ';
	}
	$res=$q . rtrim($a, ' AND ') . ' )';
	$res1='' . 'country=' . '"' . $country . '"';
	//echo $res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY `country`,`polarity`,`emkost`,`current`';
	$b = $m -> prepare($res . ' AND ' . $res1 . ' ORDER BY `country`,`polarity`,`emkost`,`current`');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}
function getEmkostPolarity($emkostbetween, $polarity) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT * FROM `Akumulators_akbmag` WHERE" . ' (';
	$a='emkost BETWEEN ';
	foreach($emkostbetween as $k=>$v){
		$a .=$v . ' AND ';
	}
	$res=$q . rtrim($a, ' AND ') . ' )';
	$res1='' . 'polarity=' . '"' . $polarity . '"';
	//echo $res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY `country`,`polarity`,`emkost`,`current`';
	$b = $m -> prepare($res . ' AND ' . $res1 . ' ORDER BY `country`,`polarity`,`emkost`,`current`');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}








function getEmkostBrand() {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT `emkost` FROM `Akumulators_akbmag` where brand= " . $value['brand'] . " ORDER by `emkost`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
}


















function getEmkost1($emkostbetween) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT * FROM `Akumulators_akbmag` WHERE" . ' (';
	$a='emkost BETWEEN ';
	foreach($emkostbetween as $k=>$v){
		$a .=$v . ' AND ';
	}
	$res=$q . rtrim($a, ' AND ') . ' )';
	//echo $res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY `country`,`polarity`,`emkost`,`current`';
	$b = $m -> prepare($res . ' ORDER BY `country`,`polarity`,`emkost`,`current`');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}







function getEmkostAKB() {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT `emkost` FROM `Akumulators_akbmag` ORDER by `emkost`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
}
function getCurrentAKB() {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT `current` FROM `Akumulators_akbmag` ORDER by `current`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
}

function getCountryAKB() {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT `brand` FROM `Akumulators_akbmag` ORDER by `country`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
}	
function getPolarityAKB() {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT `polarity` FROM `Akumulators_akbmag` ORDER by `polarity`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;	
}


function getKartochka($id) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT * FROM `Akumulators_akbmag` WHERE id = :id";
	$b = $m -> prepare($q); 
	$b -> execute(array(":id" => $id));
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
}

function getPohCountry($emkost) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT * FROM `Akumulators_akbmag` WHERE emkost = :emkost LIMIT 50";
	$b = $m -> prepare($q); 
	$b -> execute(array(":emkost" => $emkost));
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
}


/*
$object = new Connection;
$d = getModel("transit");
//$object->p($d);

foreach ($d as $key => $value) {
	//$object -> p($value);
	$wdp = getData($value['width'], $value['diameter'],$value['profile']);
	echo $value['country'] . " -- " . $value['model'] . " -- " . $value['engine'] . " -- " . $value['year'] . "<br>";
	//$object -> p($wdp);
	

foreach($wdp as $k=>$v){
echo '<img src="' . $v['images_url'] .' ">';
}
}
*/
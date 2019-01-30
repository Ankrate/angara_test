<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


require __DIR__ . '/Connection.php';


/* ФУНКЦИИ ФИЛЬТРА АККУМУЛЯТОРЫ*/
function filtrakum($filtrakum){
	$db = new Connection;
	$m = $db -> db();
	$emkostbetween = explode('-', $filtrakum['emkost']);
	$currentvybor = explode('-', $filtrakum['current']);
	
	if(!empty($filtrakum['emkost']) AND !empty($filtrakum['polarity']) AND !empty($filtrakum['real_brand']) AND !empty($filtrakum['current'])){
		$data = getEmkostPolarityReal_brandCurrent($emkostbetween, $filtrakum['polarity'], $filtrakum['real_brand'], $currentvybor);
		//p($data);
		
	}elseif(!empty($filtrakum['emkost']) AND !empty($filtrakum['real_brand']) AND !empty($filtrakum['current']) AND empty($filtrakum['polarity'])){
		$data = getEmkostReal_brandCurrent($emkostbetween, $filtrakum['real_brand'], $currentvybor);
		//p($data);
		
	}elseif(!empty($filtrakum['emkost']) AND !empty($filtrakum['polarity']) AND !empty($filtrakum['current']) AND empty($filtrakum['real_brand'])){
		$data = getEmkostPolarityCurrent($emkostbetween, $filtrakum['polarity'], $currentvybor);
		//p($data);
		
	}elseif(!empty($filtrakum['emkost']) AND !empty($filtrakum['current']) AND empty($filtrakum['real_brand']) AND empty($filtrakum['polarity'])){
		$data = getEmkostCurrent($emkostbetween, $currentvybor);
		//p($data);
	}elseif(!empty($filtrakum['emkost']) AND !empty($filtrakum['polarity']) AND !empty($filtrakum['real_brand']) AND empty($filtrakum['current'])){
		$data = getEmkostPolarityReal_brand($emkostbetween, $filtrakum['polarity'], $filtrakum['real_brand']);
		//p($data);
	}elseif(!empty($filtrakum['emkost']) AND !empty($filtrakum['real_brand']) AND empty($filtrakum['current']) AND empty($filtrakum['polarity'])){
		$data = getEmkostReal_brand($emkostbetween, $filtrakum['real_brand']);
		//p($data);	
	}elseif(!empty($filtrakum['emkost']) AND !empty($filtrakum['polarity']) AND empty($filtrakum['current']) AND empty($filtrakum['real_brand'])){
		$data = getEmkostPolarity($emkostbetween, $filtrakum['polarity']);
		//p($data);	
	}elseif(!empty($filtrakum['emkost']) AND empty($filtrakum['polarity']) AND empty($filtrakum['current']) AND empty($filtrakum['real_brand'])){
		$data = getEmkost1($emkostbetween);
		//p($data);		
	
		
	}
	
	
	else{
				$data=FALSE;
	}
					
	return $data;
	}

	
function filtrakum1($filtrakum1){
	$db = new Connection;
	$m = $db -> db();	
	if(!empty($filtrakum1['emkost']) AND !empty($filtrakum1['real_brand'])){
		$data = getEmkostReal_brand1($filtrakum1['emkost'], $filtrakum1['real_brand']);
		//p($data);
	}	
	else{
				$data=FALSE;
	}				
	return $data;
	}	

	

function getEmkostReal_brand1($emkost, $real_brand){
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT * FROM `Akumulators_akbmag` WHERE ";
	$res1='' . 'real_brand=' . '"' . $real_brand . '"';
	$res2='' . 'emkost=' . '"' . $emkost . '"';
	$b = $m -> prepare($q . $res1  . " AND " . $res2 . " ORDER by `emkost`");
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
}
	

	
/*
function getEmkostPolarityReal_brandCurrent($emkostbetween, $polarity, $real_brand, $currentvybor) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT * FROM `Akumulators_akbmag` WHERE" . ' (';
	$a='emkost BETWEEN ';
	foreach($emkostbetween as $k=>$v){
		$a .=$v . ' AND ';
	}
	$res=$q . rtrim($a, ' AND ') . ' )';
	$res1='' . 'polarity=' . '"' . $polarity . '"';
	$res2='' . 'real_brand=' . '"' . $real_brand . '"';
	$a3='(current BETWEEN ';
	foreach($currentvybor as $k3=>$v3){
		$a3 .=$v3 . ' AND ';
	}
	$res3='' . rtrim($a3, ' AND ') . ' )';
	//echo $res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY `real_brand`,`polarity`,`emkost`,`current`';
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY `real_brand`,`polarity`,`emkost`,`current`');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}*/


/*
function getEmkostReal_brandCurrent($emkostbetween, $real_brand, $currentvybor) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT * FROM `Akumulators_akbmag` WHERE" . ' (';
	$a='emkost BETWEEN ';
	foreach($emkostbetween as $k=>$v){
		$a .=$v . ' AND ';
	}
	$res=$q . rtrim($a, ' AND ') . ' )';
	$res1='' . 'real_brand=' . '"' . $real_brand . '"';
	$a2='(current BETWEEN ';
	foreach($currentvybor as $k2=>$v2){
		$a2 .=$v2 . ' AND ';
	}
	$res2='' . rtrim($a2, ' AND ') . ' )';
	//echo $res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY `real_brand`,`emkost`,`current`';
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY `real_brand`,`emkost`,`current`');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}*/

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
	//echo $res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY `real_brand`,`emkost`,`current`';
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY `real_brand`,`emkost`,`current`');
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
	//echo $res . ' AND ' . $res1 . ' ORDER BY `real_brand`,`emkost`,`current`';
	$b = $m -> prepare($res . ' AND ' . $res1 . ' ORDER BY `real_brand`,`emkost`,`current`');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}

/*
function getEmkostPolarityReal_brand($emkostbetween, $polarity, $real_brand) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT * FROM `Akumulators_akbmag` WHERE" . ' (';
	$a='emkost BETWEEN ';
	foreach($emkostbetween as $k=>$v){
		$a .=$v . ' AND ';
	}
	$res=$q . rtrim($a, ' AND ') . ' )';
	$res1='' . 'polarity=' . '"' . $polarity . '"';
	$res2='' . 'real_brand=' . '"' . $real_brand . '"';
		//echo $res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY `real_brand`,`polarity`,`emkost`,`current`';
	$b = $m -> prepare($res . ' AND ' . $res1 . ' AND ' . $res2 . ' ORDER BY `real_brand`,`polarity`,`emkost`,`current`');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}*/

/*
function getEmkostReal_brand($emkostbetween, $real_brand) {
	$db = new Connection;
	$m = $db -> db();
	$q = "SELECT DISTINCT * FROM `Akumulators_akbmag` WHERE" . ' (';
	$a='emkost BETWEEN ';
	foreach($emkostbetween as $k=>$v){
		$a .=$v . ' AND ';
	}
	$res=$q . rtrim($a, ' AND ') . ' )';
	$res1='' . 'reaL_brand=' . '"' . $real_brand . '"';
	//echo $res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY `real_brand`,`polarity`,`emkost`,`current`';
	$b = $m -> prepare($res . ' AND ' . $res1 . ' ORDER BY `real_brand`,`polarity`,`emkost`,`current`');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}*/

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
	//echo $res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY `real_brand`,`polarity`,`emkost`,`current`';
	$b = $m -> prepare($res . ' AND ' . $res1 . ' ORDER BY `real_brand`,`polarity`,`emkost`,`current`');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
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
	//echo $res . ' AND ' . $res1 . ' AND ' . $res2 . ' AND ' . $res3 . ' ORDER BY `real_brand`,`polarity`,`emkost`,`current`';
	$b = $m -> prepare($res . ' ORDER BY `real_brand`,`polarity`,`emkost`,`current`');
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	return $data;
	}


function getEmkostBrandAKB($real_brand) {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT `emkost` FROM `Akumulators_akbmag` WHERE ";
	$res1='' . 'real_brand=' . '"' . $real_brand . '"';
	$b = $m -> prepare($q . $res1  . " ORDER by `emkost`");
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
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

/*
function getBrandAKB() {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT `brand` FROM `Akumulators_akbmag` ORDER by `brand`";
	$b = $m -> prepare($q);
	$b -> execute();
	$data = $b -> fetchAll(PDO::FETCH_ASSOC);
	//$db->p($data);
	//echo '<br> вывод первой функции' . $b -> rowCount() . '<br>';
	return $data;
}	*/

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

function getReal_brandAKB() {
	$db = new Connection;
	$m = $db -> db();

	$q = "SELECT DISTINCT `real_brand` FROM `Akumulators_akbmag` ORDER by `real_brand`";
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

function getPohBrand($emkost) {
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
	echo $value['brand'] . " -- " . $value['model'] . " -- " . $value['engine'] . " -- " . $value['year'] . "<br>";
	//$object -> p($wdp);
	

foreach($wdp as $k=>$v){
echo '<img src="' . $v['images_url'] .' ">';
}
}
*/
<?php
//	header('Content-Type: text/html; charset=UTF-8');
?>
<div id="callme">
	<input type="button" id="viewform" class="callme_viewform">
</div>
<div id="cme_form">
	<a id="cme_cls" href="/callme/index.html">&nbsp;</a>
<?php
if ($_GET["title"]) {
	$title = $_GET["title"];
} else {
	$title = "Заказать бесплатный звонок";
}

if ($_GET["button"]) {
	$button = $_GET["button"];
} else {
	$button = "Перезвоните мне";
}

echo "<h6>".$title."</h6>";

if(strlen($_GET["fields"]) === 0) {
	$f = "Имя,Телефон,-Комментарий";
} else {
	$f = $_GET["fields"];
}

$f = str_replace(", ", ",", $f);
$f = str_replace("'", "\"", $f);
$f = explode(",", $f);
for ($i=0; $i < count($f); $i++){
	if ($f[$i][0] == "-") {
		echo "<span>".substr($f[$i], 1)."</span>";
		echo "<span><textarea placeholder='".substr($f[$i], 1)."' class='cme_txt'></textarea></span>";
	} elseif ($f[$i][0] == "!") {
		$str = substr($f[$i], 1);
		$str = explode("!", $str);
		echo "<span>".$str[0]."</span>";
		echo"<select class='cme_select' name='".$str[0]."'>";
		for ($j=1; $j<count($str); $j++) {
			echo "<option value=".$str[$j].">".$str[$j]."</option>";
		}
		echo"</select>";
	} else {
		echo "<span>".$f[$i]."</span>";
		echo"<span><input placeholder='".$f[$i]."' class='cme_txt' type='text' maxlength='150'></span>";
	}
}

function echoTime($x) { // формат часов
	if ($x > 24) { 
		$rs = $x-24; // после полуночи
	} else { 
		$rs = $x;
	}
	if (strlen($rs)==1) { 
		$rs = "0".$rs; // до 10 утра, добавим ноль
	}
	return $rs;
}

// hr - текущее время
// time_end конец работы
// time_start начало работы

if ($_GET["calltime"] == 1) {
	if ( !$hr = $_GET["hr"] ) { 
		$hr = date("H"); // текущее время
	}

	if ( $_GET['time_start'] != '' ) {
		$time_start = $_GET['time_start'];
	} else {
		$time_start = 8; // если не указано начало дня
	}

	if ( $_GET['time_end'] != '' ) {
		$time_end = $_GET['time_end'];
	} else {
		$time_end = 24; // если не указан конец дня
	}

	$hr_msg = 'сегодня';

	if ( $hr > $time_end ) { // если день закончился
		$hr = $time_start;
		$hr_msg = 'завтра';
	}

	if ( $hr < $time_start ) { // если ещё не день
		$hr = $time_start;
	}

	echo "
	<span class='cme_ct'>
	<div>Время звонка</div>
	<div>".$hr_msg."</div>
	<div><select id='cme_ct_start'>
	<option>~</option>";

	for ( $i = $hr; $i <= $time_end; $i++ ) {
		echo '<option value="'.$i.'">'.echoTime($i).'</option>';
	}

	echo"</select></div>
	<div>до</div><div>
	<select id='cme_ct_finish'><option>~</option>";

	for ( $i = $hr+1; $i <= $time_end+1; $i++ ){
		echo '<option disabled value="'.$i.'">'.echoTime($i).'</option>';
	}

	echo "</select></div>
	<div>час.</div>
	</span>";
}
?>
	<span class="cme_btn_place">
		<input class="cme_btn" type="button" value="<?php echo $button; ?>">
	</span>
	<div id="callme_result"></div>
</div>
<div id="cme_back"></div>
<?php
// Buyme 1.3.0 2013 by Nazar Tokar
// dedushka.org * nazartokar.com * a@dedushka.org

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

//адрес почты для отправки уведомления
$to = "angara77@gmail.com, angara99@gmail.com"; //несколько ящиков могут перечисляться через запятую

$HTTP_HOST = parse_url('http://'.$_SERVER["HTTP_HOST"]); 
$HTTP_HOST = str_replace(array("http://","www."),"", $HTTP_HOST['host']);
$from = "noreply@".$HTTP_HOST; // отправитель

// данные для отправки смс

$id = "";
$key = "";
$sms_login = "";
$sms_pass = "";
$frm = "callme"; // добавьте новую подпись в смс-шлюзе и дождитесь апрува
$num = ""; // ваш номер в формате без + (f.e. 380501112233 или 79218886622)
$prv = "sms.ru"; // на выбор: sms.ru, infosmska.ru, bytehand.com, sms-sending.ru, smsaero.ru

function uc($s){
	$s = urlencode($s);
	return $s;
}

function gF($s){ // no shit
	$s = substr((htmlspecialchars($_GET[$s])), 0, 500);
	if (strlen($s)>1) return $s;
}

function echoResult($result, $class, $time, $message){ // выводим данные json
	echo '{ 
	"result": "'.$result.'", 
	"cls": "'.$class.'", 
	"time": "'.$time.'", 
	"message": "'.$message.'" }';
	exit();
}

function sendSMS($to, $msg){
	global $id;
	global $key;
	global $from;
	global $frm;
	global $num;
	global $prv;
	global $sms_login;
	global $sms_pass;
	
	$u['sms.ru'] = "sms.ru/sms/send?api_id=".uc($key)."&to=".uc($num)."&text=".uc($msg);
	$u['bytehand.com'] = "bytehand.com:3800/send?id=".uc($id)."&key=".uc($key)."&to=".uc($num)."&partner=callme&from=".uc($frm)."&text=".uc($msg);
	$u['sms-sending.ru'] = "lcab.sms-sending.ru/lcabApi/sendSms.php?login=".uc($sms_login)."&password=".uc($sms_pass)."&txt=".uc($msg)."&to=".uc($num);
	$u['infosmska.ru'] = "api.infosmska.ru/interfaces/SendMessages.ashx?login=".uc($sms_login)."&pwd=".uc($sms_pass)."&sender=SMS&phones=".uc($num)."&message=".uc($msg);
	$u['smsaero.ru'] = "gate.smsaero.ru/send/?user=".uc($sms_login)."&password=".md5(uc($sms_pass))."&to=".uc($num)."&text=".uc($msg)."&from=".uc($frm);
	
	$r = @file_get_contents("http://".$u[$prv]);
}

$l["sent"] = "Заказ уже был отправлен";
$l["err"] = "Пожалуйста, заполните все поля";
$l["ok"] = "Спасибо, заказ принят. Ждите звонка";
$l["title"] = "BuyMe: новый заказ";
$l["footer"] = "<p><a href='http://angara77.com'>Angara77</p>";

function addToMess($c, $o){
	$s = "<p><b>".$c."</b>:<br>".$o."</p>";
	return $s;
}

function getOptions($o){ // get fields
	$captions = $_GET["cs"];
	$options = $_GET["os"];
	$opts = '';
	$i = 0;	

	if ($o == 1) {
		foreach ($options as $value) {
			if ( strlen($value) > 1 ) {
				$opts .= addToMess($captions[$i], $value);
			}
			$i++;
		}
	} else {
		foreach ($options as $value) {
			if ( strlen($value) > 1 ) {
				$opts .= $captions[$i]."(".$value.") ";
			}
			$i++;
		}		
	}
	return $opts;
}
// translit by programmerz.ru
function translit($str){
	$tr = array("А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E","Ё"=>"E","Ж"=>"J","З"=>"Z","И"=>"I","Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"C","Ч"=>"CH","Ш"=>"SH","Щ"=>"SC","Ъ"=>"","Ы"=>"Y","Ь"=>"","Э"=>"E","Ю"=>"U","Я"=>"YA","а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"e","ж"=>"j","з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l","м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h","ц"=>"c","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y","ы"=>"y","ь"=>"","э"=>"e","ю"=>"u","я"=>"ya");
	return strtr($str,$tr);
}

// далее можно не трогать

$time = time(); // время отправки
$interval = $time - gF("time");
if ($interval < 1) { // если прошло менее (сек)
	echoResult('err', 'b1c-err', '', $l["sent"]);
} else {

$get_data = $_GET["cs"];

if (count($get_data) > 1){ // data to send
	$ip = $_SERVER['REMOTE_ADDR']; 
	$prd = gF("prd");

	$geo = @file_get_contents('http://freegeoip.net/json/'.$ip);
	$geo = @json_decode($geo, true);	

	$title = $l["title"];
	$mess = "<h3>Заказ на ".$prd."</h3><div style='background:#fffce8;border:1px solid #cecece;padding:10px 10px 0'>";

	$mess .= getOptions(1);

	$mess .= addToMess("IP",$ip);
	$mess .= addToMess("Откуда запрос",(($geo['city'])." (".($geo['country_name']).")" ));

	$mess .= "</div>".$l["footer"];
	
	$headers  = "Content-type: text/html; charset=utf-8 \r\n"; 
	$headers .= "From: BuyMe 1.3.0 <".$from.">\r\n"; 

$msg_sms = substr( translit($prd.",".(getOptions(0))), 0 ,160 );

@mail($to, $title, $mess, $headers);
	if ( ($id!="") || ($key!="") || ($sms_login!="") ) { 
		@sendSMS($num, $msg_sms); 
	}
	echoResult("ok", "b1c-ok", $time, $l["ok"]);
	} else {
		echoResult("err", "b1c-err", "", $l["err"]);
	}
}
?>
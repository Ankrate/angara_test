<?php // www.dedushka.org * nazartokar@gmail.com // 1.9.1
header("Content-Type: text/html; charset=utf-8"); //кодировка

//адрес почты для отправки уведомления
$to = "angara77@gmail.com, angara99@gmail.com"; //получатель

// не трогать
$HTTP_HOST = parse_url('http://'.$_SERVER["HTTP_HOST"]); 
$HTTP_HOST = str_replace(array("http://","www."),"",$HTTP_HOST['host']);
$from = "noreply@".$HTTP_HOST; // отправитель

// данные для отправки смс

$id = "";
$key = "";
$sms_login = "";
$sms_pass = "";
$frm = "callme"; // добавьте новую подпись в смс-шлюзе и дождитесь апрува
$num = ""; // ваш номер в формате без + (79218886622)
$prv = ""; // на выбор: sms.ru, infosmska.ru, bytehand.com, sms-sending.ru, smsaero.ru

function uc($s){
	$s = urlencode($s);
	return $s;
}

function gf($s){ // no shit
	$s = substr((htmlspecialchars($_GET[$s])), 0 , 500);
	if (strlen($s)>1) return $s;
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
	
	$r = file_get_contents("http://".$u[$prv]);	
}

function translit($str) {
	$tr = array("А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I","Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH","Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"","Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j","з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l","м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h","ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y","ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya");
	return strtr($str,$tr);
} 
// translit * ProgrammerZ.Ru

function addToMess($c, $o){
	global $mess;
	if(strlen($o)>2) {
		$mess = $mess.'<div style="margin:3px 0;background: #ffe1e0;border: 1px solid #cecece;padding:10px"><b>'.$c.':</b><br>'.$o.'</div>';
		//$mess = $mess."<b>".$c."</b>:<br>".$o."<br><br>";
	}
}

function jsAnswer($result, $cls, $time, $message){
	echo '{"result": "'.$result.'","cls": "'.$cls.'","time": "'.$time.'","message": "'.$message.'"}';
	exit();
}

function getOptions($o){ // get callme options
	$cs = $_GET["cs"];
	$os = $_GET["os"];
	$i = 0;	
	if ($o == 1) {

		$opts = '<div style="background:#fffce8;border:1px solid #cecece;padding:10px 10px 0">';

		foreach ($os as $value) {
			if( (strlen($value) != 0) && ($value != "0") ) {
				$opts .= "<b>".$cs[$i]."</b>:<br>".$value."<br><br>";
			}
			$i++;
		}
		$opts .= '</div>';
	} else {
		foreach ($os as $value) {
			if( (strlen($value) != 0) && ($value != "0") ) {
				$opts .= $cs[$i]."(".$value.") ";
			}
			$i++;
		}		
	}
	return $opts;
}

//jsAnswer("error", "c_error", "", gF('cs[0]'));

$time = time(); // время отправки
$interval = $time - (gF('ctime'));
if ($interval < 1) { // интервал отправки (сек)
	jsAnswer("error", "c_error", "", "Сообщение уже было отправлено.");
} else {
	//$get_data = gF('os');
	$get_data = $_GET["cs"];

	if (count($get_data) > 1){ // data to send
	$os = $_GET["os"];
	$cs = $_GET["cs"];
	$ip = $_SERVER['REMOTE_ADDR'];

//get city 

	$ip = $_SERVER['REMOTE_ADDR'];
	$geo = file_get_contents('http://freegeoip.net/json/'.$ip);
	$geo = json_decode($geo, true);

	$title = "CallMe: обратный звонок";
	$mess = "";

	$mess .= getOptions(1);

	addToMess("Откуда запрос",($geo['city']." / ".$geo['country_name']." / ".$ip));

	$mess = $mess."<hr><a href='http://dedushka.org/tag/callme/'>Следите</a> за обновлениями.<br>Спасибо за то, что пользуетесь CallMe.";
	
	$headers = "Content-type: text/html; charset=utf-8 \r\n"; 
	$headers.= "From: CallMe 1.9.1 <".$from.">\r\n"; 

	$msg_sms = translit("CallMe ".(getOptions(0)));
	$msg_sms = substr($msg_sms, 0, 160);

@mail($to, $title, $mess, $headers);	
	if ( ($id!="") || ($key!="") || ($sms_login!="") ) {
		@sendSMS($num, $msg_sms); 
	}
		jsAnswer("success", "c_success", "", "Спасибо, сообщение отправлено");
	} else {
		jsAnswer("error", "c_error", "", "Ошибка");
	}
}
?>
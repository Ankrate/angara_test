<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1);
include_once ('lock.php');
echo "It is works!";
# Настройки MySQL
$host 	= "localhost";
$user 	= "root";
$pass	= "manhee33338";
$db		= "u66745_porter";
echo "It is works!";
# URL магазина
$site = "http://www.shop.ru/";

# Название магазина
$name = "Магазин";

# Описание магазина
$desc = "Лучший магазин";

# Валюта
$curr = "RUR";

# Стоимость доставки
$cost = "300";

$db = new mysqli($host, $user, $pass, $db);
$db->set_charset('utf-8');

header('Content-type: application/xml');
header("Content-Type: text/xml; charset=utf-8");
$cdate = date("Y-m-d H:i",time());

$out = <<<HTML
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="$cdate">
<shop>
<name>$name</name>
<company>$desc</company>
<url>$site</url>
 
<currencies>
    <currency id="RUR" rate="1"/>
</currencies>
<categories>
<category id="1">Тестовая категория</category>
<category id="2" parentId="1">Дочерняя категория</category>
</categories>
<offers>
HTML;

$products = $db->query("SELECT * FROM angara")->fetch_all(MYSQLI_ASSOC);
foreach($products as $val) {
	if((int) $val['price'] == 0) continue;
	$name = htmlspecialchars($val['ang_name']);
	$desc = htmlspecialchars($val['description']);
	$out .= <<<HTML
    <offer id="$val[id]" available="true">
      <url>{$site}$val[id].html</url>
      <price>$val[price]</price>
      <currencyId>$curr</currencyId>
	  <categoryId>1</categoryId>
      <name>$name</name>
      <description>$desc</description>
	  <local_delivery_cost>$cost</local_delivery_cost>
    </offer>
HTML;
}

$out .= "</offers></shop></yml_catalog>";
echo $out;
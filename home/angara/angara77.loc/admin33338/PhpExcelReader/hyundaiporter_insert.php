<?php 
//error_reporting(E_ALL); 
//ini_set("display_errors", 1);

include ("hp_func.php");

select_angara();

include_once ("lib/remote_db.php");




//start insert to category
//РћС‡РёС‰Р°РµРј С‚Р°Р±Р»РёС†Сѓ jos_vm_product_category_xref
$sql_truncate_prod_cat = "TRUNCATE TABLE `jos_vm_product_category_xref`";
$msl_prod_cat = mysql_query($sql_truncate_prod_cat);
if ($msl_prod_cat){
//		print "All right jos_vm_product_category_xref is cleaned!";
		}
else die("Oops112");
$sql_truncate = "TRUNCATE TABLE `jos_vm_product_price`";
$msl = mysql_query($sql_truncate,$db2);
if ($msl){

//	print "All right jos_vm_product_price is cleaned!";
	}
else die("Oops12");
//РІС‹Р±РёСЂР°РµРј РґР°РЅРЅС‹Рµ РёР· С‚С‹Р±Р»РёС†С‹ РїСЂРѕРґСѓРєС‚С‹ 
$query_category = "SELECT product_id, product_sku, product_price FROM jos_vm_product";
$result = mysql_query ($query_category,$db2);
$myrow = mysql_fetch_array($result);
do {
//РЅР°Р·РЅР°С‡Р°РµРј РєР°С‚РµРіРѕСЂРёРё
if ( substr ($myrow["product_sku"],0,1)==2 or substr($myrow["product_sku"],0,1)==3) {$category_id = 1;}
elseif ( substr ($myrow["product_sku"],0,1)==4 ){$category_id = 2;}
elseif ( substr ($myrow["product_sku"],0,1)==5 ){$category_id = 4;}
elseif ( substr ($myrow["product_sku"],0,1)==6 ){$category_id = 5;}
elseif ( substr ($myrow["product_sku"],0,1)==7 or substr ($myrow["product_sku"],0,1)== 8 ){$category_id = 5;}
elseif ( substr ($myrow["product_sku"],0,1)==9) {$category_id = 6;}
else {$category_id = 3;}

//Р’СЃС‚Р°РІР»СЏРµРј РєР°С‚РµРіРѕСЂРёРё РІ С‚Р°Р±Р»РёС†Сѓ РєР°С‚РµРіРѕСЂРёР№
$insert_category = mysql_query("INSERT INTO jos_vm_product_category_xref VALUES ('$category_id','$myrow[product_id]','')",$db2);
if ($insert_category) {
			//print "Fse nishtyak!";			
			}
else {print "Oops2";}

$date = time();
//Insert into Price
$insert_price = mysql_query("INSERT INTO jos_vm_product_price VALUES (
	'',
	'$myrow[product_id]',
	'$myrow[product_price]',
	'RUB',
	'',
	'',
	'$date',
	'$date',
	'5',
	'',
	'',
	'')");
if ($insert_category) {

		//print "Vstavilos!";
			}
else {print "Hui v nos";}

//print $myrow['product_sku'];
//print "-".$category_id;
//print "---".$myrow[product_price];
//print ("<br />");
}
while ($myrow = mysql_fetch_array($result));

mysql_close($db2);
//End



?>

<?php
//ob_start();
error_reporting(E_ALL); 
ini_set("display_errors", 1);
include_once ('lock.php');
//print_r($_POST);
include_once($_SERVER['DOCUMENT_ROOT'] ."/lib/core.php");
//include_once($_SERVER['DOCUMENT_ROOT'] ."/adm33338/YandexMarket.php");



  $xml = new DomDocument("1.0","UTF-8");
  
  $container = $xml->createElement("yml_catalog");
  $container = $xml->appendChild($container);
  
  $sale = $xml->createElement("sale");
  $sale = $container->appendChild($sale);
  
  $item = $xml->createElement("item","Television");
  $item = $sale->appendChild($item);
  
  $price = $xml->createElement("price","100");
  $price = $sale->appendChild($price);
  
  $xml->FormatOutput = true;
  $string_value = $xml ->saveXML();
  $xml->save("prices/example.xml");
  



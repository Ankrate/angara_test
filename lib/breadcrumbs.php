<?php
//error_reporting(E_ALL); 
//ini_set("display_errors", 1);
include_once ("lib/bread_class.php");

/*** a new breadcrumbs object ***/
$bc = new breadcrumbs;

/*** set the pointer if you like ***/
$bc->setPointer('>');

/*** create the trail ***/
$bc->crumbs();

/*** output ***/
echo '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
echo $bread = $bc->breadcrumbs;
echo "</span>";
?>


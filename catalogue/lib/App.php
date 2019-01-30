<?php
class App {
    
    public function choice_cat(){
        require_once  $_SERVER['DOCUMENT_ROOT'] . '/catalogue/lib/CatCar1.php';
       return 'CatCar1';
    }
}
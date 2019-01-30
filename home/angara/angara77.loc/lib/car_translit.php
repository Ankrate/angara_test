<?php

function car2translit($string) {

    $converter = array(

        'акцент' => 'accent',   'елантра' => 'elantra',   'соната' => 'sonata',

        'гетс' => 'getz',   'гец' => 'getz',   'теракан' => 'terracan',

        'терракан' => 'terracan',   'солярис' => 'solaris',  'истана' => 'istana',

        'грейс' => 'grace',   'грэйс' => 'grace',   'сантафе' => 'santa',

        'санта фе' => 'santa',   'матрикс' => 'matrix',   'туссан' => 'tucson',
        'портер' => 'porter', 'портер2' => 'porter2', 'грм' => 'ремень', 'портер2' => 'porter 2',
        'портер 2' => 'porter 2', 'каунти' => 'county', 'нд' => 'hd', 'ujkjdrf' =>'головка', 'gjhnth' => 'porter',
        'htccjhf' => 'рессора',   'neh,byf' => 'турбина', 'hflbfnjh' => 'радиатор', 'rfeynb' => 'county',
        'шд' => 'hd', 'ашдэ' => 'hd', 'масленный' => 'масляный', 'маслянный' => 'масляный', 'топлевный' => 'топливный', 		'салейблок' => 'сайлентблок',  'dfreevysq' => 'вакуумный', 'wbkbylh' => 'цилиндр',
        'lbjlysq' => 'диодный' , 'vjcn' => 'мост', 'поворотник' => 'поворотов' , 'паворотник' => 'поворотов',
        'оптика' => 'фара', 'масленого' => 'масляного' , 'Калотки' => 'колодки', 'гинератор' => 'генератор',
        
       

    );

    return strtr($string, $converter);

}

//$string = 'акцент';
//echo (car2translit($string));

function cat2translit($string) {

    $converter = array(

        'а' => 'a',   'в' => 'b',   'А' => 'a',

        'В' => 'b',   'с' => 'c',   'С' => 'c',
       

    );

    return strtr($string, $converter);

}




?>
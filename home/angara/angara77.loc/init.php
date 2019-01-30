<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/lib/core.php';
/*
spl_autoload_register(function ($class) {
       
    require_once($_SERVER['DOCUMENT_ROOT'] .'/lib/' . $class . '.php');
    //require_once($_SERVER['DOCUMENT_ROOT'] . '/catalogue/lib/' . $class . '.php');
});

 */ 

//Define the paths to the directories holding class files
$paths = array(
'lib',
'catalogue/lib',
'admin33338/lib'
);
//Add the paths to the class directories to the include path.
set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $paths));
//Add the file extensions to the SPL.
spl_autoload_extensions(".php");
//Register the default autoloader implementation in the php engine.
spl_autoload_register();

 
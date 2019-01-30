<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if(!isset($_SESSION['name']) ) {
    if($_SESSION['role'] != 'marketinghead' OR $_SESSION['role'] != 'saleshead' OR $_SESSION['type'] != 'admin'){
        header('location: /admin33338/');
    }
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
//function __autoload($class_name) {


include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/linksplan/Class.MyInsert.php');




if(isset($_POST["submit"])) {
    
    $target_file = $_SERVER['DOCUMENT_ROOT'] . '/admin33338/linksplan/file.csv';
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
    
        $obj = new MyInsert;
        if($obj -> insert()){
        header('Location: /admin33338/'); 
        }  
    }
}




?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Загрузка плана ссылок</title>
        <!-- <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="styles/admin.css" rel="stylesheet" type="text/css" /> -->
        <link rel="icon" href="../favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
    
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
        <!-- Pe chart revenue per manager -->
        <div class="container-fluid">
            <div class="row"><!-- Big row -->
                <div class="col-md-12">
                <form  action="" method="post" enctype="multipart/form-data">
                    <span class="btn btn-default btn-file">
                     Select file<input type="file" name="file">
                     </span>
                    
                    <button class="btn btn-default btn-file" type="submit" value="Upload Image" name="submit">Upload</button>
                    
                </form>
            </div>
          </div><!-- Big row end -->
          </div>
    </body>
</html>
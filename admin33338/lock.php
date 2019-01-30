<?php
session_start();
if(!isset($_SESSION['name'])) {
    if($_SESSION['type'] != 'admin'){
        if($_SESSION['type'] != 'editor'){
    header('location: /admin33338/');
        }
    }
}



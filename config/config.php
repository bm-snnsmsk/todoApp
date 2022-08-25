<?php

const BASEDIR = 'C:\xampp\htdocs\apps\todoApp';
const URL = 'http://localhost/apps/todoApp/';
const DEV_MODE = true ; // hata ayıklama için
date_default_timezone_set('Europe/Istanbul') ;


try{
    $DBConnect = new PDO('mysql:host=localhost;dbname=todoapp', 'root','') ;
}catch(PDOException $e){
    echo $e->getMessage() ;
}

?>
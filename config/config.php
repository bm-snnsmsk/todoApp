<?php

const BASEDIR = 'C:\xampp\htdocs\apps\todoApp';
const URL = 'http://localhost/apps/todoApp/';
const DEV_MODE = true ; // hata ayıklama için


try{
    $DBConnect = new PDO('mysql:host=localhost;dbname=todoapp', 'root','') ;
}catch(PDOException $e){
    echo $e->getMessage() ;
}

?>
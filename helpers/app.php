<?php
function test_arr($arr){
    echo("<pre>");
    print_r($arr) ;
    echo("</pre>");
}
function route($index){
    global $config ;
    if(isset($config['route'][$index])){
        return $config['route'][$index] ;
    }else{
        return false ;
    } 
}
function view($viewName, $pageData = []){
    $data = $pageData ;
    if(file_exists(BASEDIR.'/View/'.$viewName.'.php')){
        require BASEDIR.'/View/'.$viewName.'.php' ;
    }else{
        return false ;
    }
}
function model($modelName, $pageData = [], $data_process = null){
    global $DBConnect ;
    if($data_process != null){
        $process = $data_process ;
    }
    $data = $pageData ;
    if(file_exists(BASEDIR.'/Model/'.$modelName.'.php')){
        $return = require BASEDIR.'/Model/'.$modelName.'.php' ;
        return $return ;
    }else{
        return false ;
    }
}
function assets($assetName){
    if(file_exists(BASEDIR.'/public/'.$assetName)){
        return URL.'public/'.$assetName ;
    }else{
        return false ;
    }
}
function lang($text){
    global $lang ;
    if(isset($lang[$text])){
        return $lang[$text] ;
    }else{
        return $text ;
    }
}
function set_session($index, $value){
   $_SESSION[$index] = $value ;
}
function get_session($index){
    if(isset($_SESSION[$index])){
     return  $_SESSION[$index] ;
    }else{
     return false ;
    }
}
function get_cookie($index){
     if(isset($_COOKIE[$index])){
      return  trim($_COOKIE[$index]) ;
     }else{
      return false ;
     }
}
function post($name){
    if(isset($_POST[$name])){
     return  htmlspecialchars(trim($_POST[$name])) ;
    }else{
     return false ;
    }
}
function get($name){
    if(isset($_GET[$name])){
     return  htmlspecialchars(trim($_GET[$name])) ;
    }else{
     return false ;
    }
}
function message($messageType, $message){    
    echo '<div class="alert alert-'.$messageType.'">'.$message.'</div>' ;
}
function redirect($link){
    header('Location:'.URL.$link) ;
}
function url($url){
    global $config ;
    return URL.$config['lang'].'/'.$url ;
}




?>
<?php

// TEST
// test($config) ;


if(route(0) == 'home' && !route(1)){
    $return = model('home',[], 'list') ; 
    // test($return) ;
    view('home/home',$return['data']) ;
}elseif(route(0) == 'home' && route(1) == 'calendar'){
    view('home/calender') ;
}


?>
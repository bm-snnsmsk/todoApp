<?php

// TEST
// test($config) ;


if(route(0) == 'home'){

    // DB
    view('home/home',[
        'isim'=>'Sinan',
        'soyisim'=>'Şimşek'
    ]) ;
}

?>
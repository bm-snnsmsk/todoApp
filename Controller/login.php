<?php

if(route(0) == 'login'){

    if(isset($_POST['submit'])){
        set_session('mesaj', 'Mesajınız başarılı bir şekilde kaydedilmişltir.') ;
        $eposta = post('eposta') ;
        $pass = post('sifre') ;

        echo "Email Adresiniz : ".$eposta."</br>Şifreniz : ".$pass ;
    }
    view('auth/login') ;
}

?>
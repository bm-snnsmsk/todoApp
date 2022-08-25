<?php
// login yapılmışken sayfadan geri ggidilirse home yönlenrilir
if(get_session('login') && get_session('login') == true){
    redirect('home') ;
}
if(route(0) == 'login')
{
    if(isset($_POST['submit'])){     
        $_SESSION['post'] = $_POST ;  
        $eposta = post('eposta') ;
        $pass = post('sifre') ;
        // test_arr($_SESSION) ; 
        // echo "Email Adresiniz : ".$eposta."</br>Şifreniz : ".$pass ;
        $return = model('auth/login',['email' => $eposta,'password' => $pass], 'login') ;
        // test_arr($return) ;
        // test_arr($_SESSION) ; 
        if($return['success']){
        /* bu mesaj görünmeyeceğinden bunun yazılmasının bir anlamı yok
            set_session('error', [
                'message'=> $return['message'] ?? '',
                'type' => $return['type'] ?? ''
            ]) ; */
            if(isset($return['redirect'])){
                redirect($return['redirect']) ;
            }
        }else{
            set_session('error', [
                'message'=> $return['message'] ?? '',
                'type' => $return['type'] ?? ''
            ]) ;
        }

    }
   
    view('auth/login') ;
}

?>
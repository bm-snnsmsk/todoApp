<?php
if(!get_session('login') || get_session('login') != true){
    redirect('login') ;  // login yoksa eğer http://localhost/apps/todoApp/login  'e git
}
if(route(0) == 'categories' && !route(1)){
  /*   if(isset($_POST['submit'])){     
        $_SESSION['post'] = $_POST ;  
        $eposta = post('eposta') ;
        $pass = post('sifre') ;
        // test($_SESSION) ; 
        // echo "Email Adresiniz : ".$eposta."</br>Şifreniz : ".$pass ;
        $return = model('auth/login',['email' => $eposta,'password' => $pass], 'login') ;
        // test($return) ;
        // test($_SESSION) ; 
        if($return['success']){
        /* bu mesaj görünmeyeceğinden bunun yazılmasının bir anlamı yok
            set_session('error', [
                'message'=> $return['message'] ?? '',
                'type' => $return['type'] ?? ''
            ]) ; */
          /*   if(isset($return['redirect'])){
                redirect($return['redirect']) ;
            } */
      /*   }else{
            set_session('error', [
                'message'=> $return['message'] ?? '',
                'type' => $return['type'] ?? ''
            ]) ;
        }
 */
  //  }
   // test("categories içerisi") ;
    view('categories/home') ;
}else if(route(0) == 'todo' && route(1)  == 'add'){
    $return = model('categories',[], 'list') ; 
    view('todo/add', $return['data']) ;
}else if(route(0) == 'todo' && route(1)  == 'list'){    
    // test("list içerisi") ;
    $return = model('todo',[], 'list') ; 
    view('todo/list', $return['data']) ;  // ilgili datalar ilgili sayfaya gönderilmiş olur
}else if(route(0) == 'todo' && route(1)  == 'edit' && is_numeric(route(2))){
    $return = model('todo',['editID' => route(2)], 'getEditedList') ; 
    view('todo/edit',$return['data']) ;
}

?>
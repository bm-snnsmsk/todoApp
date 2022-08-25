<?php
if(!get_session('login') || get_session('login') != true){
    redirect('login') ;
}
if(route(0) == 'categories' && !route(1)){
  /*   if(isset($_POST['submit'])){     
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
   // test_message("categories içerisi") ;
    view('categories/home') ;
}else if(route(0) == 'categories' && route(1)  == 'add'){
    if(isset($_POST['submit'])){     
        $_SESSION['post'] = $_POST ;  
        $title = post('title') ;
        $return = model('categories',['title' => $title], 'add') ; 
        if($return['success'] == true){
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
    view('categories/add') ;
}else if(route(0) == 'categories' && route(1)  == 'list'){    
    // test_message("list içerisi") ;
    $return = model('categories',[], 'list') ; 
    view('categories/list', $return['data']) ;  // ilgili datalar ilgili sayfaya gönderilmiş olur
}else if(route(0) == 'categories' && route(1)  == 'remove' && is_numeric(route(2))){    
    // test_message("categories/remove içerisi") ;
    $return = model('categories',['removedCategoriesID'=>route(2)], 'remove') ; 
    redirect('categories/list/?type='.$return['type'].'&message='.$return['message']) ; 
}else if(route(0) == 'categories' && route(1)  == 'edit' && is_numeric(route(2))){
       // test_message("categories/edit içerisi") ;
     if(isset($_POST['submit'])){     
        $_SESSION['post'] = $_POST ;  
       // test_arr($_POST) ;
        $title = post('title') ;
        $categoriesId = post('categoriesId') ;
        $return = model('categories',['title' => $title, 'categoriesId' => $categoriesId], 'edit') ; 
        if($return['success'] == true){
            set_session('error', [
                'message'=> $return['message'] ?? '',
                'type' => $return['type'] ?? ''
            ]) ;
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
        $return = model('categories',['updatedCategoriesID'=>route(2)], 'getEdit') ;
        // test_arr($return['data']);
         view('categories/edit',$return['data']) ;
}

?>
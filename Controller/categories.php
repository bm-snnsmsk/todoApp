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
    // test("list içerisi") ;
    $return = model('categories',[], 'list') ; 
    view('categories/list', $return['data']) ;  // ilgili datalar ilgili sayfaya gönderilmiş olur
}else if(route(0) == 'categories' && route(1)  == 'remove' && is_numeric(route(2))){    
    // test("categories/remove içerisi") ;
    $return = model('categories',['removedCategoriesID'=>route(2)], 'remove') ; 
    redirect('categories/list/?type='.$return['type'].'&message='.$return['message']) ; 
}else if(route(0) == 'categories' && route(1)  == 'edit' && is_numeric(route(2))){
       // test("categories/edit içerisi") ;
    if(isset($_POST['submit'])){     
        $_SESSION['post'] = $_POST ;  
        // test($_POST) ;
        $title = post('title') ;
        $categoriesId = post('categoriesId') ;
        $return = model('categories',['title' => $title, 'categoriesId' => $categoriesId], 'edit') ; 
        if($return['success'] == true){
            set_session('error', [
                'message'=> $return['message'] ?? '',
                'type' => $return['type'] ?? ''
            ]) ;
            if(isset($return['redirect'])){ // bu koşul gerekli mi ??? Çünkü model den gelen redirect yok !
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
    // test($return['data']);
    view('categories/edit',$return['data']) ;
}

?>
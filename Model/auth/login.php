<?php

 // test($process);
 // test($data);

 if($process == 'login'){
   if(!$data['email']){
      return ['success' => false, 'type' => 'warning', 'message' => 'Lütfen e-posta adresinizi giriniz !'] ;
   }
   if(!$data['password']){
      return ['success' => false, 'type' => 'warning', 'message' => 'Lütfen parolanızı giriniz !'] ;
   }
   $query = $DBConnect->prepare('SELECT *,CONCAT(usersName," ",usersSurname) AS fullname FROM users WHERE usersEmail = ? AND usersPassword = ?') ;
   $query->execute([$data['email'],md5($data['password'])]) ;
   if($query->rowCount()){
    $user = $query->fetch(PDO::FETCH_ASSOC) ;
    // test($users);
    set_session('usersID',$user['usersID']) ;
    set_session('usersName',$user['usersName']) ;
    set_session('usersSurname',$user['usersSurname']) ;
    set_session('password',$user['usersPassword']) ;
    set_session('fullname',$user['fullname']) ;
    set_session('usersEmail',$user['usersEmail']) ;
    set_session('login', true) ;
    return ['success' => true, 'message' => 'Giriş Başarılı', 'data' => $user, 'type' => 'success', 'redirect' => 'home'] ;
   }else{
    return ['success' => false, 'message' => 'Kullanıcı adı veya Şifreniz hatalı', 'type' => 'danger' ] ;
   }
    
} 



?>
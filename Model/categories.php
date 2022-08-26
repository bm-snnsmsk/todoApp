<?php

 // test($process);
 // test($data);

 if($process == 'add'){
   if(!$data['title']){
      return ['success' => false, 'type' => 'warning', 'message' => 'Lütfen kategoriniz için bir başlık giriniz !'] ;
   }
   $title = $data['title'] ;
   $query = $DBConnect->prepare('INSERT INTO categories SET categoriesTitle = ? , categoriesUserID = ?') ;
   $query->execute([$title,get_session('usersID')]) ;
   if($query->rowCount()){
    return ['success' => true, 'message' => 'Kategoriniz başarılı bir şekilde eklendi.', 'type' => 'success', 'redirect' => 'categories/list'] ;
   }else{
    return ['success' => false, 'message' => 'Kategori eklemede bir hata meydana geldi.', 'type' => 'danger' ] ;
   }
    
} 
if($process == 'list'){
   // test($data);
    $query = $DBConnect->prepare('SELECT * FROM categories WHERE categoriesUserID = ?') ;
    $query->execute([get_session('usersID')]) ; // sadece login yapan kişinin categorileri
   if($query->rowCount()){
    return ['success' => true, 'type' => 'success', 'data' => $query->fetchAll(PDO::FETCH_ASSOC)] ; // query sorgusu data olarak gönderiliyor
   }else{
      return ['success' => true, 'type' => 'success', 'data' =>[] ] ;
   }    
} 
if($process == 'remove'){
   // test($data);
    $categoriesID = $data['removedCategoriesID'] ;
    $query = $DBConnect->prepare('DELETE FROM categories WHERE categoriesUserID = ? && categoriesID = ? ') ;
    $query->execute([get_session('usersID'),$categoriesID]) ;
   if($query->rowCount()){
    return ['success' => true, 'type' => 'success', 'message'=> 'Silme işlemi başarılı'] ; 
   }else{
      return ['success' => false, 'type' => 'danger', 'message'=> 'Silme işlemi esnasında bir hata meydana geldi' ] ;
   }    
} 
if($process == 'edit'){
   // test($data);
   if(!$data['title']){
      return ['success' => false, 'type' => 'warning', 'message' => 'Lütfen kategoriniz için bir başlık giriniz !'] ;
   }   
   $title = $data['title'] ;
   $categoriesID = $data['categoriesId'] ;   
   $query = $DBConnect->prepare('UPDATE categories SET categoriesTitle = ? WHERE categoriesUserID = ? && categoriesID = ?') ;
   $islem = $query->execute([$title, get_session('usersID'),$categoriesID]) ;
  if($islem){
   return ['success' => true, 'type' => 'success', 'data' => $query->fetch(PDO::FETCH_ASSOC), 'message' => 'Günceleme başarılı'] ; 
  }else{
     return ['success' => false, 'type' => 'danger', 'message' => 'Günceleme hatalı'] ;
  }    
} 
if($process == 'getEdit'){
   // test($data);
   $categoriesID = $data['updatedCategoriesID'] ;
   $query = $DBConnect->prepare('SELECT * FROM categories WHERE categoriesUserID = ? && categoriesID = ?') ;
   $query->execute([get_session('usersID'),$categoriesID]) ;
   // test($query->fetch(PDO::FETCH_ASSOC));
  if($query->rowCount()){
   return ['success' => true, 'type' => 'success', 'data' => $query->fetch(PDO::FETCH_ASSOC)] ; 
  }else{
     return ['success' => true, 'type' => 'success'] ;
  }    
} 

?>
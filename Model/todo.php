<?php

 // test($process);
 // test($data);

if($process == 'list'){
   // test($data);
    $query = $DBConnect->prepare('SELECT * FROM todo AS t LEFT JOIN categories AS c on c.categoriesID = t.todoCategoryID  WHERE t.todoUserID = ? ORDER BY todoTitle ASC') ;
    $query->execute([get_session('usersID')]) ; // sadece login yapan kişinin categorileri
   if($query->rowCount()){
    return ['success' => true, 'type' => 'success', 'data' => $query->fetchAll(PDO::FETCH_ASSOC)] ; // query sorgusu data olarak gönderiliyor
   }else{
      return ['success' => true, 'type' => 'success', 'data' =>[] ] ;
   }    
}
if($process == 'getEditedList'){
   // test($data);
   $editID = $data['editID'] ;
   $userID = get_session('usersID') ;
   // test($userID) ;
   $query1 = $DBConnect->prepare("SELECT * FROM categories WHERE categoriesUserID = ? ") ;
   $query1->execute([$userID]) ;
   $query2 = $DBConnect->prepare('SELECT * FROM todo AS t LEFT JOIN categories AS c ON c.categoriesID = t.todoCategoryID WHERE t.todoUserID = ? && t.todoID = ?') ;
   $query2->execute([get_session('usersID'),$editID]) ;
   $q1 = $query1->fetchAll(PDO::FETCH_ASSOC) ;
   $q2 = $query2->fetch(PDO::FETCH_ASSOC) ;
  // test($q2);
  if($query2->rowCount()){
   return ['success' => true, 'type' => 'success', 'data' => array_merge($q2, ["categories" => $q1]) ] ; 
  }else{
     return ['success' => true, 'type' => 'success'] ;
  }    
} 

?>
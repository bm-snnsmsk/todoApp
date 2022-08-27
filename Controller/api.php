<?php

if(route(1) == 'addtodo'){
    $post = filter($_POST) ;
  
    if(!$post['title']){
        $status = "error" ;
        $title = 'Oops! Dikkat' ;
        $msg = "Lütfen bir başlık giriniz." ;
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
        die() ;
    }
    if(!$post['description']){
        $status = "error" ;
        $title = 'Oops! Dikkat' ;
        $msg = "Lütfen bir açıklama giriniz." ;
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
        die() ;
    }

    $sd = $post['start_date'] ?? date('Y-m-d') ;
    $st = $post['start_time'] ?? date('H:i:s') ;
    $fd = $post['finish_date'] ?? date('Y-m-d') ;
    $ft = $post['finish_time'] ?? date('H:i:s') ;

    $s_time = $sd." ".$st ;
    $f_time = $fd." ".$ft ;

 
    if($post['category_id']){
        $a = get_session('usersID') ;
        $b = $post['category_id'] ;
        $q = $DBConnect->prepare("SELECT * FROM categories WHERE categoriesUserID = ? && categoriesID = ?") ;
        $q->execute([$a, $b]) ;
        $c = $q->fetch(PDO::FETCH_ASSOC) ;
        if(!$c){
            $status = "error" ;
            $title = 'Oops! Dikkat' ;
            $msg = "Böyle bir kategori yok" ;
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
            die() ;
        } 
    }



    $query = $DBConnect->prepare('INSERT INTO `todo`(
        `todoUserID`, 
        `todoCategoryID`, 
        `todoTitle`, 
        `todoDescription`, 
        `todoColor`, 
        `todoEndDate`,
        `todoStartDate` ) VALUES (?, ?, ?, ?, ?, ?, ?)') ;
    $islem = $query->execute([
        get_session('usersID'), 
        $post['category_id'] ?? 0 ,
        $post['title'],
        $post['description'], 
        $post['color'] ?? 'renk yok', 
        $f_time,
        $s_time 
        ]) ;  
    if($islem){
        $status = "success" ;
        $title = 'İşlem başarılı' ;
        $msg = "Yapılcaklar listeye eklendi" ;
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg, 'redirect' => url('todo/list')]) ;
        die() ;
    }else{
        $status = "error" ;
        $title = 'Oops! Dikkat' ;
        $msg = "Beklenmedik bir hata" ;
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
        die() ;
    } 
}

?>
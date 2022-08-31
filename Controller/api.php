<?php

if(route(1) == 'addtodo'){
    $post = filter($_POST) ; // app.php post() ve get() fonksiyonları zaten filter() fonksiyonundan geçiriliyor
  
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
        `todoStartDate`,
        `todoStatus`,
        `todoProgress` ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)') ;
    $islem = $query->execute([
        get_session('usersID'), 
        $post['category_id'] ?? 0 ,
        $post['title'],
        $post['description'], 
        $post['color'] ?? 'renk yok',  
        $f_time,
        $s_time,
        $post['status'] ?? 'a',
        intval($post['range']) ?? 0        
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
}else if(route(1) == 'removetodo'){  
    $post = filter($_POST) ;  
    if(!$post['id']){
        $status = "error" ;
        $title = 'Oops! Dikkat' ;
        $msg = "ID bilgisi alınamadı" ;
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
        die() ;
    }else{
        $query = $DBConnect->prepare('DELETE FROM todo WHERE todoUserID = ? && todoID = ?') ;
        $islem = $query->execute([get_session('usersID'), $post['id'] ]) ;  
        if($islem){
            $status = "success" ;
            $title = 'Başarılı' ;
            $msg = "Veriniz silindi" ;
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg, 'id' => $post['id']]) ; 
            die() ;
        }else{
            $status = "error" ;
            $title = 'Oops! Dikkat' ;
            $msg = "Silme işlemi sırasında bir hata meydana geldi" ;
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
            die() ;
        }
    }
}else if(route(1) == 'edittodo'){
    $post = filter($_POST) ; // app.php post() ve get() fonksiyonları zaten filter() fonksiyonundan geçiriliyor
  
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
        $q = $DBConnect->prepare("SELECT * FROM categories WHERE categoriesUserID = ? && categoriesID = ? ") ;
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

    $query = $DBConnect->prepare('UPDATE todo SET
        todoCategoryID = ?, 
        todoTitle = ?,   
        todoDescription = ?,
        todoColor = ?, 
        todoStatus = ?,  
        todoEndDate = ?,  
        todoStartDate = ?,
        todoProgress = ?
        WHERE todoID = ? && todoUserID = ? ') ;
    $islem = $query->execute([ 
        $post['category_id'] ?? 0,
        $post['title'],
        $post['description'], 
        $post['color'] ?? 'renk yok',  
        $post['todostatus'],
        $f_time,
        $s_time,
        intval($post['range']) ?? 0,
        $post['todoID'],
        get_session('usersID')       
        ]) ; 
        
    if($islem){
        $status = "success" ;
        $title = 'İşlem başarılı' ;
        $msg = "Yapılacaklar güncellendi" ;
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


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
}else if(route(1) == 'calendar'){
     /*     echo json_encode([
        [
            'id'=>'aaa',
            'title'=>'deneme',
            'start'=>'2022-09-02',
            'end'=>'2022-09-09',
            'color'=>'#FF0000',
            'url'=>url('todo/edit/50')
        ]
     ]) ; */

    $start = get('start') ;
    $end = get('end') ;

    $sql = "SELECT 
    todoUserID AS id, 
    todoTitle AS title, 
    todoStartDate AS start, 
    todoEndDate AS end, 
    todoColor AS color, 
    CONCAT('/apps/todoApp/todo/edit/',todo.todoID) AS url 
    FROM todo WHERE todoUserID = ?" ;

    if($start && $end){
        $sql .= " && todoStartDate BETWEEN '$start' AND '$end' OR todoEndDate BETWEEN '$start' AND '$end'" ; // !!!
    }

    $query = $DBConnect->prepare($sql) ;
    $query->execute([get_session('usersID')]) ;
    $arr = $query->fetchAll(PDO::FETCH_ASSOC) ; 

    echo json_encode($arr) ;









}else if(route(1) == 'profile'){
    $post = filter($_POST) ;
    
    if(!$post['isim']){
        $status = "error" ;
        $title = 'Oops! Dikkat' ;
        $msg = "Lütfen isminizi giriniz" ;
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
        die() ;
    }
    if(!$post['soyisim']){
        $status = "error" ;
        $title = 'Oops! Dikkat' ;
        $msg = "Lütfen soyisminizi giriniz" ;
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
        die() ;
    }
    if(!$post['email']){
        $status = "error" ;
        $title = 'Oops! Dikkat' ;
        $msg = "Lütfen email adresinizi giriniz" ;
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
        die() ;
    }

    $query = $DBConnect->prepare('UPDATE users SET usersName = ?, usersSurname = ?, usersEmail = ? WHERE usersID = ? ') ;
    $islem = $query->execute([$post['isim'],$post['soyisim'],$post['email'], get_session('usersID')]) ;

   if($islem){
    set_session('usersName',$post['isim']) ;
    set_session('usersSurname',$post['soyisim']) ;
    set_session('usersEmail',$post['email']) ;
    set_session('fullname',$post['isim'].' '.$post['soyisim']) ;
    $status = "success" ;
    $title = 'İşlem başarılı' ;
    $msg = "Profil bilgileriniz güncellendi" ;
    echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg, 'redirect' => url('profile/home')]) ;
    die() ;
   }else{
    $status = "error" ;
    $title = 'Oops! Dikkat' ;
    $msg = "Profil bilgileriniz güncelleme esnasında bir hata meydana geldi" ;
    echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
    die() ;
   }

  
}else if(route(1) == 'change_password'){
  $post = filter($_POST) ;
    
    if(!$post['old_pw'] || (get_session('password') != md5($post['old_pw']))){
        $status = "error" ;
        $title = 'Oops! Dikkat' ;
        $msg = "Lütfen şifrenizi doğru giriniz" ;
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
        die() ;
    }

    $kucuk = preg_match('#[a-z]#',$post['pass']) ;
    $buyuk = preg_match('#[A-Z]#',$post['pass']) ;
    $sayi = preg_match('#[0-9]#',$post['pass']) ;

    if(!$kucuk){
        $status = "error" ;
        $title = 'Oops! Dikkat' ;
        $msg = "Şifreniz en az bir küçük harf içermek zorunda" ;
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
        die() ;
    }
    if(!$buyuk){
        $status = "error" ;
        $title = 'Oops! Dikkat' ;
        $msg = "Şifreniz en az bir büyük harf içermek zorunda" ;
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
        die() ;
    }
    if(!$sayi){
        $status = "error" ;
        $title = 'Oops! Dikkat' ;
        $msg = "Şifreniz en az bir rakam içermek zorunda" ;
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
        die() ;
    }


    if(strlen($post['pass']) < 6){
            $status = "error" ;
            $title = 'Oops! Dikkat' ;
            $msg = "Şifreniz en az 6 karakter olmak zorunda" ;
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
            die() ;
    }

    if(!$post['pass'] || !$post['pass2'] || $post['pass'] != $post['pass2']){
        $status = "error" ;
        $title = 'Oops! Dikkat' ;
        $msg = "Şifreleriniz eşleşmiyor" ;
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
        die() ;
    }else if(get_session('password') == md5($post['pass'])){
        $status = "error" ;
        $title = 'Oops! Dikkat' ;
        $msg = "Güncellemek istediğiniz şifreniz eski şifrenizle aynı olmamalı" ;
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
        die() ;
    }else{
        $query = $DBConnect->prepare('UPDATE users SET usersPassword = ? WHERE usersID = ? ') ;
        $islem = $query->execute([md5($post['pass']), get_session('usersID')]) ;

       if($islem){
        set_session('password',$post['pass']) ;
        $status = "success" ;
        $title = 'İşlem başarılı' ;
        $msg = "Şifreniz güncellendi" ;
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg, 'redirect' => url('profile/home')]) ;
        die() ;
       }else{
        $status = "error" ;
        $title = 'Oops! Dikkat' ;
        $msg = "Şifreniz güncelleme esnasında bir hata meydana geldi" ;
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]) ;
        die() ;
       }
    }
        
}

?>


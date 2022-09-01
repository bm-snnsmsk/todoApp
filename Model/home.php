<?php

 // test($process);
 // test($data);

if($process == 'list'){
   // test($data); 
   $query0 = $DBConnect->prepare('SELECT * FROM todo AS t
                                          LEFT JOIN categories AS c 
                                          ON c.categoriesID = t.todoCategoryID
                                          WHERE todoUserID = ? && todoStatus = ? ORDER BY todoStartDate ASC') ;
   $query0->execute([get_session('usersID'),'s']) ;
   $sql0 = $query0->fetchAll(PDO::FETCH_ASSOC) ;

    $query = $DBConnect->prepare('SELECT 
                                    todoStatus, 
                                    count(todoID) AS toplam, 
                                    (count(todoID) * 100 / (SELECT COUNT(todoID) FROM todo WHERE todoUserID = ?)) AS yuzde 
                                    FROM todo WHERE todoUserID = ? 
                                    GROUP BY todoStatus') ;
    $query->execute([get_session('usersID'), get_session('usersID')]) ; // sadece login yapan kişinin categorileri
    $sql1 = $query->fetchAll(PDO::FETCH_ASSOC) ;
   if($query->rowCount()){
    return ['success' => true, 'type' => 'success', 'data' => array_merge(['istatistik' => $sql1], ['surec' => $sql0])] ;
   }else{
      return ['success' => true, 'type' => 'success', 'data' =>[] ] ;
   }    
}

?>
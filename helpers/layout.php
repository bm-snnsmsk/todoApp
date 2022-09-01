<?php

function status($status){
    if($status == 'a'){
        return [
            'title' => 'Aktif',
            'color' => 'success',
            'ikon' => 'fas fa-check'
        ] ;
    }else if($status == 'p'){
        return [
            'title' => 'Pasif',
            'color' => 'danger',
            'ikon' => 'fas fa-trash'
        ] ;
    }else if($status == 's'){
        return [
            'title' => 'Süreçte',
            'color' => 'warning',
            'ikon' => 'fas fa-info'
        ] ;
    }
}


?>
<?php


function debug($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function redirect($http = false){
    if ($http){
        $redirect = $http;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("Location: $redirect");
    die();
    //exit;
}
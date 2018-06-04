<?php

/**
 * @param $array
 */
function debug($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


/**
 * @param bool $http
 */
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



function htmlSpecialCharsWrapper($str){
    return htmlspecialchars($str, ENT_QUOTES); //преобразования html тегов (экранирования)
}
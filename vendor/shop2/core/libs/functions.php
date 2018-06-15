<?php

/**
 * @param $array
 */
function debug($array, $die = false){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    if ($die){
        die();
    }
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


/**
 * @param $str
 * @return string
 */
function htmlSpecialCharsWrapper($str){
    return htmlspecialchars($str, ENT_QUOTES); //преобразования html тегов (экранирования)
}
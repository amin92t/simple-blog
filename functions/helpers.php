<?php

define("BASE_URL", "http://localhost/simple-blog ");


function redirect($url){

    header("Location: " . trim(BASE_URL, "/ ") . "/" . trim($url, "/ "));
    exit();

}


function asset($file){
    return trim(BASE_URL , "/ ") . "/" . trim($file, "/ ");
}

// echo asset("/assets/css/style.css");


function url($url){
    return trim(BASE_URL , "/ ") . "/" . trim($url,  "/ ");
}

// echo url("/panel");

function dd($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit();
}


?>
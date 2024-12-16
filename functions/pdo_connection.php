<?php


try {

    $pdooptions = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ);
    $dbconnection = new PDO("mysql:host=localhost;dbname=simple_blog","root", "", $pdooptions);
    return $dbconnection;

} catch (Exception $err) {

    echo "Error : " . $err -> getMessage();

}






?>
<?php

require_once "../../functions/helpers.php";
require_once "../../functions/pdo_connection.php";
require_once "../../auth/check-login.php";

// dd($dbconnection);


if(isset($_GET["id"]) && $_GET["id"] !== ""){

    global $dbconnection;
    $checkExsistPostQuery = "SELECT * FROM posts WHERE id = ?;";
    $stmt = $dbconnection->prepare($checkExsistPostQuery);
    $stmt->execute(params: [$_GET["id"]]);
    $post = $stmt->fetch();
    if($post == false){
        redirect(url: "/panel/post");
    }

    $basePath = dirname(dirname(__DIR__));
    if(file_exists($basePath . $post->image)){
        unlink($basePath . $post->image);
    }

    $query = "DELETE FROM posts WHERE id = ?";
    $stmt = $dbconnection->prepare($query);
    $stmt->execute([$_GET["id"]]);
    
}

redirect("/panel/post");

?>
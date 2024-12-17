<?php

require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once "../../auth/check-login.php";



global $dbconnection;

if(!isset($_GET["id"])){
    redirect("/panel/post");
}

if($_GET["id"] !== ""){

    $checkExsistPostQuery = "SELECT * FROM posts WHERE id = ?;";
    $stmt = $dbconnection->prepare($checkExsistPostQuery);
    $stmt->execute(params: [$_GET["id"]]);
    $post = $stmt->fetch();
    if($post == false){
        redirect(url: "/panel/post");
    }

    $status = $post->status == 0 ? 1 : 0 ;


    $queryUpdate = "UPDATE posts SET status = ? WHERE id = ?";
    $stmt = $dbconnection->prepare($queryUpdate);
    $stmt->execute([$status, $_GET["id"]]);


}
redirect(url: "/panel/post");



?>
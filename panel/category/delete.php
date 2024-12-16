<?php

require_once "../../functions/helpers.php";
require_once "../../functions/pdo_connection.php";
// dd($dbconnection);


if(isset($_GET["id"]) && $_GET["id"] !== ""){

    global $dbconnection;
    $query = "DELETE FROM categories WHERE id = ?";
    $stmt = $dbconnection->prepare($query);
    $stmt->execute([$_GET["id"]]);
    
}

redirect("/panel/category");

?>
<?php

require_once "functions/helpers.php";
require_once 'functions/pdo_connection.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP tutorial</title>
    <link rel="stylesheet" href="<?= asset('/assets/css/bootstrap.min.css'); ?> " media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('/assets/css/style.css'); ?>" media="all" type="text/css">
</head>
<body>
<section id="app">

<?php require_once "layouts/top-nav.php"; ?>


<?php

global $dbconnection;
         $query = "SELECT simple_blog.posts.* , simple_blog.categories.name AS category_name FROM posts LEFT JOIN categories ON posts.cat_id = categories.id WHERE posts.status = 1 AND posts.id = ? ;";
         $stmt = $dbconnection->prepare($query);
         $stmt->execute([$_GET["id"]]);
         $post = $stmt ->fetch();
         if($post !== false){
?>

    <section class="container my-5">
        <!-- Example row of columns -->
        <section class="row">
            <section class="col-md-12">
                <h1><?= $post->title; ?></h1>
                <h5 class="d-flex justify-content-between align-items-center">
                    <a href=""><?= $post->category_name; ?></a>
                    <span class="date-time"><?= $post->create_at; ?></span>
                </h5>
                <article class="bg-article p-3"><img class="float-right mb-2 ml-2" style="width: 18rem;" src="" alt=""><?= $post->body; ?></article>
            <?php } else { ?>
                    <section>post not found!</section>
             <?php } ?>
            </section>
        </section>
    </section>

</section>
<script src="<?= asset('/assets/js/jquery.min.js'); ?>"></script>
<script src="<?= asset('/assets/js/bootstrap.min.js'); ?>"></script>
</body>
</html>
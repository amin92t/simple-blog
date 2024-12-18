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

    <?php require_once "layouts/top-nav.php"?>

    <section class="container my-5">
        <!-- Example row of columns -->
        <section class="row">
                <?php
                        global $dbconnection;
                        $query = "SELECT simple_blog.posts.* , simple_blog.categories.name AS category_name FROM posts LEFT JOIN categories ON posts.cat_id = categories.id WHERE status = 1;";
                        $stmt = $dbconnection->prepare($query);
                        $stmt->execute();
                        $posts = $stmt ->fetchAll();
                        // dd($posts);
                        foreach($posts as $post){
                ?>
                <section class="col-md-4">
                    <section class="mb-2 overflow-hidden" style="max-height: 15rem;">
                    <img class="img-fluid" src="<?= asset($post->image); ?>" alt="">
                </section>
                    <h2 class="h5 text-truncate"><?= $post->title; ?></h2>
                    <p><?= substr($post->body, 0, 20) ; ?></p>
                    <p><a class="btn btn-primary" href="<?php echo url("post.php?id=" . $post->id); ?>" role="button">View details »</a></p>
                </section>
               <?php } ?>
        </section>
    </section>

</section>
<script src="<?= asset('/assets/js/jquery.min.js'); ?>"></script>
<script src="<?= asset('/assets/js/bootstrap.min.js'); ?>"></script>
</body>
</html>
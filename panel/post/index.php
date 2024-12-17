<?php
    require_once '../../functions/helpers.php';
    require_once '../../functions/pdo_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP panel</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" media="all" type="text/css">
</head>
<body>
<section id="app">

<?php require_once '../layouts/top-nav.php'; ?>

    <section class="container-fluid">
        <section class="row">
            <section class="col-md-2 p-0">
            <?php require_once '../layouts/sidebar.php'; ?>

            </section>
            <section class="col-md-10 pt-3">

                <section class="mb-2 d-flex justify-content-between align-items-center">
                    <h2 class="h4">Articles</h2>
                    <a href="<?= url('panel/post/create.php'); ?>" class="btn btn-sm btn-success">Create</a>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>image</th>
                            <th>title</th>
                            <th>category name</th>
                            <th>body</th>
                            <th>status</th>
                            <th>setting</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php

                                global $dbconnection;
                                $query = "SELECT simple_blog.posts.* , simple_blog.categories.name AS category_name FROM posts LEFT JOIN categories ON posts.cat_id = categories.id";
                                $stmt = $dbconnection->prepare($query);
                                $stmt->execute();
                                $posts = $stmt ->fetchAll();
                                // dd($posts);
                                foreach($posts as $post){

                                ?>

                            <tr>
                               
                                <td><?= $post->id;?></td>
                                <td>
                                    <img style="width: 90px;" src="<?= asset($post->image); ?>">
                                </td>
                                <td><?= $post->title;?></td>
                                <td><?= $post->category_name;?></td>
                                <td><?= substr($post->body, 0, 30) . "..."?></td>
                                <td>
                                   <?php if($post->status == 1){ ?>
                                    <span class="text-success">enable</span> 
                                    <?php } else{ ?>

                                    <span class="text-danger">disable</span>
                                    <?php } ?>

                            </td>
                                <td>
                                    <a href="<?= url('/panel/post/change-status.php?id=' . $post->id); ?>" class="btn btn-warning btn-sm">Change status</a>
                                    <a href="<?= url('/panel/post/edit.php?id=' . $post->id); ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                               
                            </tr>

                            <?php
                                    }
                                    ?>

                        </tbody>
                    </table>
                </section>


            </section>
        </section>
    </section>





</section>

<script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
<script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>
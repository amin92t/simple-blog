<?php
    require_once '../../functions/helpers.php';
    require_once '../../functions/pdo_connection.php';

    global $dbconnection;
    if(!isset($_GET["id"])){
        redirect("/panel/post");
    }

    $checkExsistPostQuery = "SELECT * FROM posts WHERE id = ?;";
    $stmt = $dbconnection->prepare($checkExsistPostQuery);
    $stmt->execute(params: [$_GET["id"]]);
    $post = $stmt->fetch();
    if($post == false){
        redirect("/panel/post");
    }

 
    if (isset($_POST["title"]) && isset($_POST["cat_id"]) && isset($_POST["body"]) && $_POST["title"] !== "" && $_POST["cat_id"] !== "" && $_POST["body"] !== "") {

        $query = "SELECT * FROM categories WHERE id = ?;";
        $stmt = $dbconnection -> prepare($query);
        $stmt->execute([$_POST["cat_id"]]);
        $category = $stmt -> fetch();
        if($category == false){
            redirect(url: "/panel/post");
        }

        if(isset($_FILES["image"]) && $_FILES["image"]["name"] != ""){
            
            $allowFormat =  ['jpg', 'png', 'jpeg'];
            $imageFormat = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            if(!in_array($imageFormat, $allowFormat)){
                redirect("/panel/post");
            }

            $basePath = dirname(dirname(__DIR__));
            if(file_exists($basePath . $post->image)){
                unlink($basePath . $post->image);
            }

            $image = "assets/img/posts/" . date(format: "Y_m_d_H_i_s") . '.' .$imageFormat;
            $imageUpload = move_uploaded_file($_FILES["image"]["tmp_name"], $bathPath . '/' . $image);

            if($imageUpload !== false){
                $query = "UPDATE posts SET title = ?, cat_id = ?, image = ?, body = ?, update_at = NOW() WHERE id = ? ;";
                $stmt = $dbconnection->prepare($query);
                $stmt->execute([$_POST["title"], $_POST["cat_id"], $image,  $_POST["body"], $_GET["id"]]);

            }
        
        }else{
            $query = "UPDATE posts SET title = ?, cat_id = ?, body = ?, update_at = NOW() WHERE id = ? ;";
            $stmt = $dbconnection->prepare($query);
            $stmt->execute([$_POST["title"], $_POST["cat_id"],  $_POST["body"], $_GET["id"]]);
        }

        redirect(url: "/panel/post");
        
    }


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

                    <form action="<?= url("/panel/post/edit.php?id=" . $_GET["id"]); ?>" method="post" enctype="multipart/form-data">
                        <section class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?= $post->title; ?>">
                        </section>
                        <section class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                            <img src="<?= asset($post->image); ?>"class="mt-2"width="200px;" height="100px" >
                        </section>
                        <section class="form-group">
                        <label for="cat_id">Category</label>
                        <?php
                            $query = "SELECT * FROM categories";
                            $stmt = $dbconnection -> prepare($query);
                            $stmt->execute();
                            $categories = $stmt -> fetchAll();

                                    ?>
                        <select class="form-control" name="cat_id" id="cat_id">
                            <?php foreach($categories as $category){ ?>
                            <option value="<?= $category->id; ?>" <?php if($category->id == $post->cat_id) echo "selected" ; ?>> <?= $category->name; ?> </option>
                           <?php } ?>
                        </select>
                    </section>
                        <section class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" name="body" id="body" rows="5"><?php echo $post->body; ?></textarea>
                        </section>
                        <section class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </section>
                    </form>

                </section>
            </section>
        </section>

    </section>

    <script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>
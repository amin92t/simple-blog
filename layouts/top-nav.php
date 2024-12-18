<?php
session_start();

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-blue ">

    <a class="navbar-brand " href=" ">PHP tutorial</a>
    <button class="navbar-toggler " type="button " data-toggle="collapse " data-target="#navbarSupportedContent " aria-controls="navbarSupportedContent " aria-expanded="false " aria-label="Toggle navigation ">
        <span class="navbar-toggler-icon "></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent ">
        <ul class="navbar-nav mr-auto ">
            <li class="nav-item active ">
                <a class="nav-link " href=" ">Home <span class="sr-only ">(current)</span></a>
            </li>

            <?php
                global $dbconnection;
                $query = "SELECT * FROM categories";
                $stmt = $dbconnection->prepare($query);
                $stmt->execute();
                $categories = $stmt-> fetchAll();
                foreach($categories as $category){

                ?>
            <li class="nav-item ">
                <a class="nav-link " href="<?php echo url("category.php?id=" . $category->id); ?> "><?= $category->name; ?></a>
            </li>
            <?php
                }?>

        </ul>
    </div>

    <section class="d-inline ">

        <?php if(!isset($_SESSION["user"])) { ?>
        <a class="text-decoration-none text-white px-2 " href="<?php echo url("auth/register.php"); ?> ">register</a>
        <a class="text-decoration-none text-white " href=" <?php echo url("auth/login.php"); ?>">login</a>
        <?php }else{ ?>
        <a class="text-decoration-none text-white px-2 " href="<?php echo url("/auth/logout.php"); ?> ">logout</a>
            <?php } ?>
    </section>
</nav>
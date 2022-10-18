<?php
session_start();

foreach (glob("classes/*.php") as $filename) {
    include_once $filename;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My store</title>
    <!-- <link rel="stylesheet" href="../css/bootstrap.css">-->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/bootstrap.js"></script>

</head>

<body>
    <div class="w-100" id="main">
        <div class="row">
            <header class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php include_once("pages/menu.php"); ?>
            </header>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php

            //     echo '<p class="m-5 fs-3">Welcome to our online store.</br>Explore the wide range of high-quality products <a href ="index.php?page=1">
            //    here...</a></p>';

                $pages = $_GET['page'];
                if ($pages == 1) {
                    include_once("pages/catalog.php");
                }
                if ($pages == 2) {
                    include_once("pages/admin.php");
                }
                if ($pages == 3) {
                    include_once("pages/registration.php");
                }
                if ($pages == 4) {
                    include_once("pages/cart.php");
                }
                if ($pages == 5) {
                    include_once("pages/login.php");
                }
                if ($pages == 6) {
                    include_once("pages/logout.php");
                }
                if ($pages == 7) {
                    include_once("pages/itemcard.php");
                }


                ?>
            </div>
        </div>
    </div>
</body>

</html>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>VectorCam-Shop</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/shop.css">
    </head>

    <body>
        <?php 
            require "php_includes/nav_bar.php";
            require "php_includes/db_handler.php";
            $db = new db_handler;
            $featured_product = $db->get_featured_products();
        ?>
        
        <h1>Products</h1>
        <div id = "store_products" class="mx-auto">
            <?php
                foreach($featured_product as $fp){
                    require "php_includes/featured_product_card.php";
                }
                require "php_includes/product_cards.php";
            ?>
        </div>
        
    </body>
</html>
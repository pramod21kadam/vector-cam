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
            require "nav_bar.php";
        ?>
        
        <h1>Products</h1>
        <div id = "store_products" class="mx-auto">
            <div id = "featured_product" class="card mb-3 rounded">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="static/images/products/p1.jpg" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h1 class="card-title">Vector Cam</h1>
                            <p class="card-text">Smart security camera on which you can trust.</p>
                            <button type="button" class="btn btn-lg btn-outline-success">Learn more</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                require "product_cards.php";
            ?>
        </div>
        
    </body>
</html>
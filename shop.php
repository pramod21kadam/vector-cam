<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Shop</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/main.css">
        <link rel="stylesheet" href="static/css/shop.css">
    </head>

    <body>
        <?php 
            require "php_includes/nav_bar.php";
            require "php_includes/db_handler.php";
            $db = new db_handler;
            $featured_product = $db->get_featured_products();
            $products = $db->get_products();
            $product_count = count($products);
        ?> 

        <main>
            <section class="featured-section">
                <h1>Products</h1>

                <?php
                    foreach($featured_product as $fp){
                        echo(
                            '<div class="featured-product">
                            <div class="product-image">
                                <img src="static/images/products/'.$fp["product_id"].'/'.$fp["product_id"].'.jpg" alt="">
                            </div>
                            <div class="product-details">
                                <h3>'.$fp["product_name"].'</h3>
                                <p>'.$fp["summary"].'</p>
                                <button id='.$fp["product_id"].' onclick="purchase(this)">Purchase</button>
                            </div>
                        </div>'                            
                        );
                    }
                ?>

            </section>
            
            <section class="accessories-section">
                <?php
                if($product_count>0){
                    echo('
                    <hr>
                    <h1>Accessories</h1>
                    ');
                }
                ?>
                
                
                <?php
                    $beg = 0;
                    if($product_count%2 != 0){
                        $fp = $products[0];
                        $beg = 1;
                        echo(
                            '<div class="featured-product">
                            <div class="product-image">
                                <img src="static/images/products/'.$fp["product_id"].'/'.$fp["product_id"].'.jpg" alt="">
                            </div>
                            <div class="product-details">
                                <h3>'.$fp["product_name"].'</h3>
                                <p>'.$fp["summary"].'</p>
                                <button id='.$fp["product_id"].' onclick="purchase(this)">Purchase</button>
                            </div>
                        </div>'                            
                        );
                    }
                    for($i = $beg; $i < $product_count; $i+=2){
                        $cp = $products[$i];
                        echo('
                            <div class="accessories-row">
                            <div class="accessories-product">
                                <div class="product-image">
                                    <img src="static/images/products/'.$cp["product_id"].'/'.$cp["product_id"].'.jpg" alt="">
                                </div>
                                <div class="product-details">
                                    <h3>'.$cp["product_name"].'</h3>
                                    <p>'.$cp["summary"].'</p>
                                    <button id='.$cp["product_id"].' onclick="purchase(this)">Purchase</button>
                                    </div>
                            </div>
                        ');
                        $cp = $products[$i+1];
                        echo('
                            <div class="accessories-product">
                                <div class="product-image">
                                    <img src="static/images/products/'.$cp["product_id"].'/'.$cp["product_id"].'.jpg" alt="">
                                </div>
                                <div class="product-details">
                                    <h3>'.$cp["product_name"].'</h3>
                                    <p>'.$cp["summary"].'</p>
                                    <button id='.$cp["product_id"].' onclick="purchase(this)">Purchase</button>
                                    </div>
                            </div>
                        </div>
                        ');
                    }
                ?> 
            </section>

        </main>

    </body>

    <script>
        function purchase(product){
            window.location.href = "http://127.0.0.1:8080/purchase.php?product_id="+product.id;
        }
    </script>

</html>
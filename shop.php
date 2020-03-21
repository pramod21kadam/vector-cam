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
            $products = $db->get_products();
        ?>
        
        <h1>Products</h1>
        <div id = "store_products" class="mx-auto">
            <?php
                foreach($featured_product as $fp){
                    require "php_includes/featured_product_card.php";
                }
                echo("<hr>");
                $len = count($products);
                if($len%3 == 0){
                    for($i = 0; $i <= $len-3 ; $i += 3){
                        echo('<div class="card-deck mx-auto">');
                        $cp = $products[$i];
                        require "php_includes/product_cards.php";
                        $cp = $products[$i+1];
                        require "php_includes/product_cards.php";
                        $cp = $products[$i+2];
                        require "php_includes/product_cards.php";
                        echo('</div>');
                    }
                }
                else if($len%2 == 0){
                    for($i = 0; $i <= $len-2 ; $i += 2){
                        echo('<div class="card-deck mx-auto">');
                        $cp = $products[$i];
                        require "php_includes/product_cards.php";
                        $cp = $products[$i+1];
                        require "php_includes/product_cards.php";
                        echo('</div>');
                    }
                }
                else{
                    $fp = $products[0];
                    require "php_includes/featured_product_card.php";
                    for($i = 1; $i <= $len-2 ; $i += 2){
                        echo('<div class="card-deck mx-auto">');
                        $cp = $products[$i];
                        require "php_includes/product_cards.php";
                        $cp = $products[$i+1];
                        require "php_includes/product_cards.php";
                        echo('</div>');
                    }
                }
            ?>
        </div>
    </body>

    <script>
        function learn_more(product){
            window.location.href = "http://127.0.0.1:8080/more_info.php?product_id="+product.id;
        }
    </script>


</html>
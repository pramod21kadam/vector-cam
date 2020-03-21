<?php
    session_start();
    require "php_includes/db_handler.php";
    $db = new db_handler;
    $product = $db->get_product_info($_GET["product_id"]);
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $product["product_name"]; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/shop.css">
    </head>

    <body>
        
    </body>
</html>
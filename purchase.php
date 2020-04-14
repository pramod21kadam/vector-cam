<?php
    session_start();
    require "php_includes/db_handler.php";
    $db = new db_handler;
    $product = $db->get_product_info($_GET["product_id"]);
    $img_dir =  scandir("static/images/products/".$_GET["product_id"]."/");
    $banner_images = array();
    
    foreach($img_dir as $image){
        if(strncasecmp($image , "banner" , 6) == 0){
            array_push($banner_images , $image);
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $product["product_name"]; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/main.css">
        <link rel="stylesheet" href="static/css/purchase.css">
    </head>

    <body>
        <?php require "php_includes/nav_bar.php";?>

        <main>
            <section id="banner">
                <?php
                    foreach($banner_images as $image){
                        echo('<img class="banner-image hidden"  src="static/images/products/'.$_GET["product_id"].'/'.$image.'" alt="...">');
                    }
                ?>
                <div class="banner-nav-btn" id="banner-nav-prev" onclick="banner_update(this)">
                    <p><</p>
                </div>
                <div class="banner-nav-btn" id="banner-nav-next" onclick="banner_update(this)">
                    <p>></p>
                </div>
                <div class="indicator">
                    <?php
                        for($i = 0; $i<count($banner_images); $i++){
                            echo('<div class="circle"></div>');
                        }
                    ?>
                </div>
            </section>

            <section id="product-details">
                <div class="description">
                    <p>
                        <?php 
                            readfile("static/descriptions/".$product["product_id"].".txt");
                        ?>
                    </p>
                    
                </div>

                <div class="purchase-section">
                    <button id="show-form-btn" onclick="toggle_form()">Proceed to payment</button>

                    <div class="hidden" id="purchase-form">
                        <!-- <form> -->
                            <input id="product_id" type="hidden" name="product_id" value="<?php echo $product["product_id"];?>">
                            <input id="quantity"   type="hidden" name="quantity" value=1>
                            <input id="price"      type="hidden" name="price" value=<?php echo $product["product_price"];?>>
                            <input id="address"    type="text"   name="address" placeholder="Address">
                        <!-- </form> -->
                        <button id="cancle-btn" onclick="toggle_form()">Cancle</button>
                        <button id="proceed-btn" onclick="place_order()">Proceed</button>
                    </div>
                    
                </div>

            </section>
        </main>
        <div class="toast hidden" id="success-toast"><p>Successful</p></div>
        <div class="toast hidden" id="fail-toast"><p>Failed</p></div>
    </body>

    <script src="static/js/purchase.js"></script>
</html>
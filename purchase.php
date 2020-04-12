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
                        <form action = "php_includes/place_order.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $product["product_id"];?>">
                            <input type="hidden" name="quantity" value=1>
                            <input type="hidden" name="price" value=<?php echo $product["product_price"];?>>
                            <input type="text"   name="address" placeholder="Address">
                        </form>
                        <button id="cancle-btn" onclick="toggle_form()">Cancle</button>
                        <button id="proceed-btn" onclick="place_order()">Proceed</button>
                    </div>
                    
                </div>

            </section>
        </main>
    </body>



    <script>
        var banner_images = document.querySelectorAll(".banner-image");
        var circles = document.querySelectorAll(".circle");
        var current_banner_image = 0;
        banner_images[0].classList.remove("hidden");
        circles[0].classList.add("circle-active");

        var purchase_form = document.querySelector("#purchase-form");
        var purchase_btn = document.querySelector("#show-form-btn");

        function banner_update(btn){
            banner_images[current_banner_image].classList.add("hidden");
            circles[current_banner_image].classList.remove("circle-active");
            if(btn.id == "banner-nav-next"){
                current_banner_image++;
                if(current_banner_image == banner_images.length){
                    current_banner_image = 0;
                }
            }
            else{
                current_banner_image--;
                if(current_banner_image == -1){
                    current_banner_image = banner_images.length-1;
                }
            }
            banner_images[current_banner_image].classList.remove("hidden");
            circles[current_banner_image].classList.add("circle-active");
        }

        function toggle_form(){
            purchase_btn.classList.toggle("hidden");
            purchase_form.classList.toggle("hidden");
        }

        function place_order(){
            var form = document.querySelector("#purchase-form form");
                form.submit();
            }
    </script>

</html>
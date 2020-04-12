<?php
    session_start();
    require "php_includes/db_handler.php";
    $db = new db_handler;
    $product = $db->get_product_info($_GET["product_id"]);

    $img_dir =  scandir("static/images/products/".$_GET["product_id"]."/");
    $banner_images = array();

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $product["product_name"]; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/main.css">
        <link rel="stylesheet" href="static/css/more_info.css">
    </head>

    <body>
    <?php require "php_includes/nav_bar.php";?>

    <div id="banner" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
                foreach($img_dir as $image){
                    if(strncasecmp($image , "banner" , 6) == 0){
                        echo '<li class="indicator"></li>';
                        array_push($banner_images , $image);
                    }
                }
            ?>
        </ol>

        <div class="carousel-inner">
            <?php 
                foreach($banner_images as $image){
                    echo '<div class="carousel-item">
                        <img src="static/images/products/'.$_GET["product_id"].'/'.$image.'" class="d-block w-100" alt="...">
                        </div>';
                    
                }
            ?>
        </div>
        <a class="carousel-control-prev" onclick="update_banner(true)" style="cursor:pointer;">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" onclick="update_banner(false)" style="cursor:pointer;">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <div class="row row-cols-2">
        <div class="col-sm-8" id="description">
            <?php 
                readfile("static/descriptions/".$product["product_id"].".txt");
            ?>
        </div>

        <div class="col-sm-4" id="purches_form_section">
            <button type="button" id="purches_btn" class="btn btn-lg btn-block btn-success" onclick="show_purches_form(true)">Purches</button>
            
            <div id="purches_form">
                <form action = "php_includes/place_order.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product["product_id"];?>">
                    <div class="form-group">
                        <input type="text" class="form-control" id="address" placeholder="Address" name="address" required>
                    </div>

                    <div class="row row-cols-3">
                        <div class="col mx-auto">
                            <button type="button" class="btn  btn-block btn-light" onclick="update_quantity(false)"><</button>
                        </div>
                        <div class="col mx-auto">
                            <input id="quantity" class="form-control" type="text" value="1" readonly name="quantity">
                        </div>
                        <div class="col mx-auto">
                            <button type="button" class="btn  btn-block btn-light" onclick="update_quantity(true)">></button>
                        </div>
                    </div>

                    <div class="row row-cols-2">
                        <div class="col">
                            <label for="price">Price &#8377;</label>
                        </div>
                        <div class="col">
                            <input id="price" class="form-control" type="text" value="<?php echo($product["product_price"]);?>" readonly name="price">
                        </div>
                    </div>

                    <div class="row row-cols-2">
                        <div class="col">
                            <button type="button" class="btn btn-lg btn-block btn-danger" onclick="show_purches_form()" >Close</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-lg btn-block btn-success">continue</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>



    <div id="toast">Please sign in your account.</div>
    
    </body>


    <script>
            var visible_img = 0;
            var images = document.getElementsByClassName("carousel-item");
            var indicators = document.getElementsByClassName("indicator");
                
            images[visible_img].className += " active";
            indicators[visible_img].className += " active";

            function update_banner(next){
                if(next){
                    if(--visible_img<0){
                        visible_img = images.length-1;
                    }
                }
                else{
                    if(++visible_img==images.length){
                        visible_img = 0;
                    }
                }
                for(let i = 0; i<images.length ; i++){
                    images[i].className = images[i].className.replace(" active", "");
                    indicators[i].className = indicators[i].className.replace(" active", "");

                }
                images[visible_img].className += " active";
                indicators[visible_img].className += " active";
            }


            <?php
                if($_SESSION["email"]){
                    echo('function show_purches_form(form_visibility){
                        if(form_visibility){
                            document.getElementById("purches_form").style.display = "block";
                            document.getElementById("purches_btn").style.display = "none";
                        }
                        else{
                            document.getElementById("purches_form").style.display = "none";
                            document.getElementById("purches_btn").style.display = "block";
                        }
                        
                    }');
                }
                else{
                    echo('function show_purches_form(form_visibility){
                        var x = document.getElementById("toast");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                    }');
                }
            ?>
            


            function update_quantity(inc){
                var quantity = document.getElementById("quantity");
                var price = document.getElementById("price");
                if(inc){
                    if(++quantity.value > <?php echo $product["product_avilability"]?>){
                        quantity.value = <?php echo $product["product_avilability"]?>;
                    }
                    else{
                        price.value = parseInt(price.value) + <?php echo($product["product_price"]);?>;
                    }
                }
                else{
                    if(--quantity.value == 0){
                        quantity.value = 1;
                    }
                    else{
                        price.value = parseInt(price.value) - <?php echo($product["product_price"]);?>;
                    }
                }
            }
            
        </script>
</html>
<?php
    session_start();
    require "php_includes/db_handler.php";
    $db = new db_handler;
    $product = $db->get_product_info($_GET["product_id"]);

    $banner_images =  scandir("static/images/products/p1/");
    $banner_images_count = count($banner_images)-2;

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $product["product_name"]; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/more_info.css">
    </head>

    <body>
    <?php require "php_includes/nav_bar.php";?>

    <div id="banner" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li class="indicator active"></li>
            <?php
                for($i=1 ; $i<$banner_images_count ; $i++){
                    echo '<li class="indicator"></li>';
                }
            ?>
        </ol>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="static/images/products/p1/banner_0.png" class="d-block w-100" alt="...">
            </div>
            <?php 
                for($i=1 ; $i<$banner_images_count ; $i++){
                    echo '<div class="carousel-item">
                                <img src="static/images/products/p1/banner_'.$i.'.png" class="d-block w-100" alt="...">
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
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" id="address" placeholder="Address">
                    </div>

                    <div class="row row-cols-3">
                        <div class="col mx-auto">
                            <button type="button" class="btn  btn-block btn-light"><</button>
                        </div>
                        <div class="col mx-auto">
                            <input class="form-control" type="text" placeholder="1" readonly>
                        </div>
                        <div class="col mx-auto">
                            <button type="button" class="btn  btn-block btn-light">></button>
                        </div>
                    </div>

                    <div class="row row-cols-2">
                        <div class="col">
                            <button type="button" class="btn btn-lg btn-block btn-danger" onclick="show_purches_form()" >Close</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-lg btn-block btn-success">Place order</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>




    
    </body>


    <script>
            var visible_img = 0;
            
            function update_banner(next){
                var images = document.getElementsByClassName("carousel-item");
                var indicators = document.getElementsByClassName("indicator");
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



            function show_purches_form(form_visibility){
                if(form_visibility){
                    document.getElementById("purches_form").style.display = "block";
                    document.getElementById("purches_btn").style.display = "none";
                }
                else{
                    document.getElementById("purches_form").style.display = "none";
                    document.getElementById("purches_btn").style.display = "block";
                }
                
            }
            
        </script>
</html>
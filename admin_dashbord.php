<?php
    session_start();
    if(!$_SESSION["admin"]){
        header("location:http://127.0.0.1:8080/index.php");
        die();
    }
    require "php_includes/db_handler.php";
    $db = new db_handler;
    $account = $db->get_admin_info($_SESSION["email"]);
    // $featured_products = $db->get_featured_products();
    // $products = $db->get_products();
    $products = array_merge( $db->get_featured_products() , $db->get_products());
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dashbord</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/main.css">
        <link rel="stylesheet" href="static/css/admin_dashbord.css">
    </head>

    <body>
        <?php
            require "php_includes/nav_bar.php";
        ?>

        <main>
            <div class="side-bar">
                <div class="side-bar-item active-side-bar-item" onclick="update_sidebar(0)"><p>Overview</p></div>
                <div class="side-bar-item" onclick="update_sidebar(1)"><p>Products</p></div>
                <div class="side-bar-item" onclick="update_sidebar(2)"><p>Orders</p></div>
            </div>

            <div id="top"></div>

            <div class="page-container" id="overview">
                <div class="overview-content">
                    <h1>Accounts</h1>
                    <p><?php echo $db->count_accounts();?></p>
                </div>
                <div class="overview-content">
                    <h1>Products</h1>
                    <p><?php echo $db->count_products();?></p>
                </div>
                <div class="overview-content">
                    <h1>Sale</h1>
                    <p><?php echo $db->sum_transactions();?> &#8377;</p>
                </div>
            </div>



            <div class="page-container hidden" id="products">
                <div class="products-content">
                    <h1>Products</h1>

                    <?php
                        foreach($products as $p){
                            echo('
                            <div class="product" id="'.$p["product_id"].'-card">
                                <div class="product-image">
                                    <img src="static/images/products/'.$p["product_id"].'/'.$p["product_id"].'.jpg" alt="">
                                </div>
                                <div class="product-details">
                                    <h3>'.$p["product_name"].'</h3>
                                    <p>'.$p["summary"].'</p>
                                    <button id="'.$p["product_id"].'" onclick="remove_product(this)">Remove</button>
                                </div>
                            </div>
                            ');
                        }
                        
                    ?>
                    <div class="fab-btn" id="add-product-btn">
                        <div class="fab-btn-content">
                            <a href="static/add_product.html">+</a>
                        </div>
                    </div>

                    <div class="fab-btn" id="back-to-top">
                        <div class="fab-btn-content">
                            <a href="#top">^</a>
                        </div>
                    </div>

                </div>
            </div>


            <div class="page-container hidden" id="orders">
                <p>Orders</p>
                <?php
                    $users = $db->get_ordes_email();
                    foreach($users as $user){
                        echo('
                        <div class="order-customer-row">
                            <p>'.$user["email"].'</p>
                        ');

                        $orders = $db->get_orders($user["email"]);
                        foreach($orders as $order){
                            $product = $db->get_product_info($order["product_id"]);
                            echo('
                            <div class="customer-order-row">
                                <div class="order-row-info">
                                    <p>
                                        <b>'.$product["product_id"].'</b> <br>
                                        '.$order["price"].' &#8377; <br>
                                        '.$order["placed_date"].'
                                    </p>
                                </div>
                                <div class="order-row-address">
                                    <p>
                                        '.$order["address"].'
                                    </p>
                                </div>
                            </div>  
                            ');
                        }

                        echo('
                        </div>
                        ');
                    }
                ?>
                <!-- <div class="order-customer-row">
                        <p>onkarkunjir8@gamil.com</p>
                        <div class="customer-order-row">
                            <div class="order-row-info">
                                <p>
                                    <b>Vector cam</b> <br>
                                    399 &#8377; <br>
                                    2020-03-11
                                </p>
                            </div>
                            <div class="order-row-address">
                                <p>
                                    this is address okay.
                                </p>
                            </div>
                        </div>                        
                </div> -->
                <div class="fab-btn" id="back-to-top">
                    <div class="fab-btn-content">
                        <a href="#top">^</a>
                    </div>
                </div>
                
            </div>
            

        </main>

        <div class="toast hidden" id="success-toast"><p>Successful</p></div>
        <div class="toast hidden" id="fail-toast"><p>Failed</p></div>

    </body>

    <script src="static/js/admin_dashbord.js"></script>
</html>


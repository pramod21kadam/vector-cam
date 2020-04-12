<?php
    session_start();
    if($_SESSION["admin"] or !isset($_SESSION["email"])){
        header("location:http://127.0.0.1:8080/index.php");
        die();
    }
    require "php_includes/db_handler.php";
    $db = new db_handler;
    $account = $db->get_account_info($_SESSION["email"]);
    $orders = $db->get_orders($_SESSION["email"]);
?>

<!doctype html>
<html>
    <head>
        <title>My Account</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/main.css">
        <link rel="stylesheet" href="static/css/my_account.css">
    </head>

    <body>
        <?php require "php_includes/nav_bar.php"; ?>
        
        <main>
            <section id="account-section">
                <?php
                    echo('
                        <h1>Welcome '.$account["first_name"].' '.$account["last_name"].'.</h1>
                        <p>'.$_SESSION["email"].'</p>
                    ');
                ?>
               
            </section>

            <section id="orders-section">
                <?php
                    if(!$orders){
                        echo('
                            <h1>You don\'t have any orders placed.</h1>
                        ');
                    }
                    foreach($orders as $order){
                        echo('
                            <div class="order">
                                <div class="order-image">
                                    <img src="static/images/products/'.$order["product_id"].'/'.$order["product_id"].'.jpg" alt="">
                                </div>
                                <div class="order-details">
                                    <h3>VectorCam</h3>

                                    <p> '.$order["address"].'
                                        <br>
                                        Placed on <b>'.$order["placed_date"].'</b>
                                        <br>
                                        <b>'.$order["price"].' &#8377;</b>
                                    </p>
                                    <button>Cancle</button>
                                </div>
                            </div>
                        ');
                    }
                ?>
               
            </section>
            <a id="back-to-top" href="#account-section"></a>
           
        </main>
        
    </body>
    
    
</html>
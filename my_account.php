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
        <div id="top"></div>
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
                        $product = $db->get_product_info($order["product_id"]);
                        echo('
                            <div class="order" id="card-'.$order["order_id"].'">
                                <div class="order-image">
                                    <img src="static/images/products/'.$order["product_id"].'/'.$order["product_id"].'.jpg" alt="">
                                </div>
                                <div class="order-details">
                                    <h3>'.$product["product_name"].'</h3>

                                    <p> '.$order["address"].'
                                        <br>
                                        Placed on <b>'.$order["placed_date"].'</b>
                                        <br>
                                        <b>'.$order["price"].' &#8377;</b>
                                    </p>
                                    <button id="'.$order["order_id"].'" onclick="cancle_order(this)">Cancle</button>
                                </div>
                            </div>
                        ');
                    }
                ?>
               
            </section>
            <div class="fab-btn" id="back-to-top">
                <div class="fab-btn-content">
                    <a href="#top">^</a>
                </div>
            </div>
           
        </main>
        <div class="toast hidden" id="success-toast"><p>Successful</p></div>
        <div class="toast hidden" id="fail-toast"><p>Failed</p></div>
        
    </body>

    <script>
        var sucess_toast = document.querySelector("#success-toast");
        var fail_toast = document.querySelector("#fail-toast");

        function cancle_order(oid){
            document.querySelector("#card-"+oid.id).classList.add("hidden");

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.responseText){
                        toast = sucess_toast;
                    }
                    else{
                        toast = fail_toast;                    
                    }
                    toast.classList.remove("hidden");
                    setTimeout(function(){ toast.classList.add("hidden"); }, 3000);
                }
            };
            xhttp.open("GET", "php_includes/cancle_order.php?order_id="+oid.id, true);
            xhttp.send(); 
        }
        
    </script>
    
    
</html>
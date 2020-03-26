<?php
    session_start();
    require "php_includes/db_handler.php";
    $db = new db_handler;
    $account = $db->get_account_info($_SESSION["mail_id"]);
    $orders = $db->get_orders($_SESSION["mail_id"]);
?>

<!doctype html>
<html>
    <head>
        <title>VectorCam-My Account</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/my_account.css">
    </head>

    <body>
        <?php require "php_includes/nav_bar.php"; ?>
        <div style="padding:2%;">
            <div class="row">
                <div class="col-sm" id="orders_section">
                    <h1>Orders</h1>
                    <?php
                        if(count($orders)){
                            foreach($orders as $order){
                                $product = $db->get_product_info($order["product_id"]);

                                echo '<div class="card mb-3 orders" >
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="static/images/products/'.$product["product_id"].'/'.$product["product_id"].'.jpg" class="card-img" alt="failed to load image.">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">'.$product["product_name"].'</h5>
                                                <p class="card-text">Quantity : '.$order["quantity"].'</p>
                                                <p class="card-text">Price : '.$order["price"].'</p>
                                                <p class="card-text">Address : '.$order["address"].'</p>
                                            </div>
                                        </div>
                                    </div>
                                    </div>';
                            }
                        }
                        else{
                            echo "you don't have any orders.";
                        }
                    ?>

                </div>


                <div class="col-sm" id="account_info">
                    <h1>Account Info</h1>
                    <form>
                        <div class="form-group row">
                            <div class="col-sm">
                                <input type="text" class="form-control" id="f_name" placeholder="First Name" value=<?php echo $account["first_name"]; ?>>
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="l_name" placeholder="Last Name" value=<?php echo $account["last_name"]; ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm">
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" value=<?php echo $account["email"]; ?> >
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm">
                                <input type="password" class="form-control" id="password" placeholder="password" value=<?php echo $account["password"]; ?> oninput="display_confirm()">
                            </div>
                        </div>

                        <div class="form-group row" id="confirm_block">
                            <div class="col-sm">
                                <input type="password" class="form-control" placeholder="confirm password">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>


            </div>
        
        </div>
    </body>

    <script>
        var confirm_block_visibility = false;

        function display_confirm(){
            var confirm_block = document.getElementById("confirm_block");
            if(!confirm_block_visibility){
                confirm_block.className += " show";
                confirm_block_visibility = true;
            }
            
            if(document.getElementById("password").value == <?php echo $account["password"]; ?>){
                confirm_block.className = confirm_block.className.replace(" show" , " hide");
                confirm_block_visibility = false;
                setTimeout(function(){ confirm_block.className = confirm_block.className.replace(" hide", ""); }, 500);
            }
        }
    </script>
</html>
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
        <title>VectorCam-My Account</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/main.css">
        <link rel="stylesheet" href="static/css/my_account.css">
    </head>

    <body>
        <?php require "php_includes/nav_bar.php"; ?>
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

            <div class="col-sm" id="account-info">
                <h1>Account info</h1>
                <form action="">
                    <div class="row">
                        <div class="col">
                            <div class="custom-form-input">
                                <input type="text" class="custom-input" id="f_name" name="f_name" autocomplete="off" value="<?php echo $account["first_name"]; ?>" required>
                                <label for="f_name" class="custom-input-lbl">
                                    <span class="custom-lbl-name">First name</span>
                                </label>
                            </div>
                        </div>
                        
                    
                        <div class="col">
                            <div class="custom-form-input">
                                <input type="text" class="custom-input" id="l_name" name="f_name" autocomplete="off" value="<?php echo $account["last_name"]; ?>" required>
                                <label for="l_name" class="custom-input-lbl">
                                    <span class="custom-lbl-name">Last name</span>
                                </label>
                            </div>
                        </div>
                        
                        
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="custom-form-input">
                                <input type="email" class="custom-input" id="email" name="email" autocomplete="off" value="<?php echo $account["email"]; ?>" required>
                                <label for="email" class="custom-input-lbl">
                                    <span class="custom-lbl-name">Email</span>
                                </label>
                            </div>
                        </div>
                        
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="col custom-form-input">
                                <input type="password" class="custom-input" id="password" name="password" autocomplete="off" value="<?php echo $account["password"]; ?>" required>
                                <label for="password" class="custom-input-lbl">
                                    <span class="custom-lbl-name">Email</span>
                                </label>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <!-- <div class="col-sm" id="account_info">
                <h1>Account Info</h1>
                <form>
                    <div class="form-group row">
                        <div class="col-sm">
                            <input type="text" class="form-control" id="f_name" placeholder="First Name" value=<?php echo $account["first_name"]; ?> oninput="display_update()">
                        </div>
                        <div class="col-sm">
                            <input type="text" class="form-control" id="l_name" placeholder="Last Name" value=<?php echo $account["last_name"]; ?> oninput="display_update()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm">
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" value=<?php echo $account["email"]; ?> oninput="display_update()">
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
                    <div class="row">
                        <div class="col">
                            <button id="update_btn" type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
                        </div>
                    </div>
                </form>
            </div> -->


        </div>
        
        
    </body>

    <script>
        var confirm_block_visibility = false;
        var update_visibility = false;

        function display_confirm(){
            display_update();
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

        function display_update(){
            var update_btn = document.getElementById("update_btn");
            if(!update_visibility){
                update_btn.className += " show";
                update_visibility = true;
            }
            if(document.getElementById("password").value == <?php echo '"'.$account["password"].'"'; ?> && 
            document.getElementById("f_name").value == <?php echo '"'.$account["first_name"].'"'; ?> &&
            document.getElementById("l_name").value == <?php echo '"'.$account["last_name"].'"'; ?> &&
            document.getElementById("email").value == <?php echo '"'.$account["email"].'"'; ?> 
            ){
                update_btn.className = update_btn.className.replace(" show" , " hide");
                update_visibility = false;
                setTimeout(function(){ update_btn.className = update_btn.className.replace(" hide", ""); }, 500);
            }

        }
    </script>
</html>
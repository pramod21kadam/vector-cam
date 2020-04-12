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
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/main.css">
        <link rel="stylesheet" href="static/css/my_account.css">
    </head>

    <body>
        <?php require "php_includes/nav_bar.php"; ?>
        
        <div class="row" id="page-content">
            <div class="col-sm" id="account-info">
                
                <div id=account-content>
                    <h3 id="user-name">Welcome <?php echo $account["first_name"]." ".$account["last_name"]; ?><h3>
                    <h5 id="user-email"><?php echo $account["email"];?></h5>
                    <button id="edit-btn" onclick="toggle_form()">Edit</button>
                </div>

                <div class="hidden" id="form-container">
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
                                            <span class="custom-lbl-name">Password</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                    </form>
                    <div id="form-buttons">
                            <button  onclick="toggle_form()">Cancle</button>
                            <button>Update</button>
                    </div>
                </div>

                
            </div>

            <div class="col-sm" id="orders-section">
                <h3>Orders</h3>
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

        </div>
        
        
    </body>
    
    <script src="static/js/my_account.js"></script>
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
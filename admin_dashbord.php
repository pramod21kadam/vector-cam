<?php
    session_start();
    if(!$_SESSION["admin"]){
        header("location:http://127.0.0.1:8080/index.php");
        die();
    }
    require "php_includes/db_handler.php";
    $db = new db_handler;
    $account = $db->get_admin_info($_SESSION["mail_id"]);
?>

<!doctype html>
<html>
    <head>
        <title>Dashbord</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/admin_dashbord.css">
    </head>

    <body>
        <?php
            require "php_includes/nav_bar.php";
        ?>   
        <div>
            <div class="row">
                <div class="col-3" id="action_menu" style="text-align:left;">
                    <div class="row action selected" onclick="update_page(0)">
                        <div class="col">
                            <p>Overview</p>
                        </div>
                    </div>

                    <div class="row action" onclick="update_page(1)">
                        <div class="col">
                            <p>Products</p>
                        </div>
                    </div>

                    <div class="row action" onclick="update_page(2)">
                        <div class="col">
                            <p>Orders</p>
                        </div>
                    </div>
                </div>

                <div class="col">

                    <div id="overview_block" class="block show">
                        <h1>overview_block</h1>
                    </div>

                    <div id="products_block" class="block hide">
                        <h1>products_block</h1>
                    </div>

                    <div id="orders_block" class="block hide">
                        <h1>orders_block</h1>
                    </div>
                </div>
            </div>
        </div>     
    </body>


    <script>
        function update_page(index){
            var actions = document.getElementsByClassName("action");
            var blocks = document.getElementsByClassName("block");
            for(let i = 0; i<blocks.length ; i++){
                blocks[i].className = blocks[i].className.replace(" show" , " hide");
                actions[i].className = actions[i].className.replace(" selected" , "");
            } 
            blocks[index].className = blocks[index].className.replace(" hide" , " show");
            actions[index].className += " selected";     
        }
    </script>
</html>
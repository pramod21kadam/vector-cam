<?php 
    session_start();
    require "db_handler.php";
    $db = new db_handler;
    if($db->place_order($_SESSION["email"],  $_POST["product_id"] ,$_POST["address"] , $_POST["quantity"] , $_POST["price"])){
        $_SESSION["order_success"] = true;
        header("location:http://127.0.0.1:8080/shop.php");
        die();
    }
    else{
        $_SESSION["order_success"] = false;
        header("location:http://127.0.0.1:8080/shop.php");
        die();
    }
    
?>
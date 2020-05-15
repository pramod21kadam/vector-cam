<?php 
    session_start();
    require "db_handler.php";
    $db = new db_handler;
    if($db->place_order($_SESSION["email"],  $_POST["product_id"] ,$_POST["address"] , $_POST["quantity"] , $_POST["price"])){
        echo true;
    }
    else{
        echo false;
    }
    
?>
<?php 
    session_start();
    require "db_handler.php";
    $db = new db_handler;
    if( $db->cancle_order($_GET["order_id"]) ){
        echo true;
    }
    else{
        echo false;
    }
    
?>
<?php 
    session_start();

    require "static/login.html";
    require "db_handler.php";

    $handler = new db_handler;
    
    $email_id = $_POST['mail_id'];
    $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];

    if($handler->sign_up($email_id , $password , $phone_number)){
        $_SESSION["logged_in"] = true;
    }
    else{
        $_SESSION["logged_in"] = false;
    }

?>
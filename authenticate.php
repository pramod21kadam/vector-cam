<?php 
    session_start();
    require "php_includes/db_handler.php";
    $db = new db_handler;
    $info;
    $admin;
    if($_POST["intent"] == "sign_up"){
        $info = $db->sign_up($_POST['f_name'] , $_POST['l_name'] , $_POST["mail_id"] , $_POST["password"]);
    }
    else{
        $info = $db->sign_in($_POST["mail_id"] , $_POST["password"]);
        if(!$info){
            $info = $db->admin_sign_in($_POST["mail_id"] , $_POST["password"]);
            $admin = $info;
        }
    }
    if($info){
        $_SESSION["mail_id"] = $_POST["mail_id"];
        if($admin){
            $_SESSION["admin"] = true;
            header("location:http://127.0.0.1:8080/admin_dashbord.php");
            die();
        }
        header("location:http://127.0.0.1:8080/index.php");
        die();
    }
    else{
        header("location:http://127.0.0.1:8080/static/login.html");
        die();
    }
?>
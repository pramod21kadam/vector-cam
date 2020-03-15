<?php 
    session_start();
    require "db_handler.php";
    $db = new db_handler;
    $info;
    if($_POST["intent"] == "sign_up"){
        $info = $db->sign_up($_POST['f_name'] , $_POST['l_name'] , $_POST["mail_id"] , $POST["password"]);
    }
    else{
        $info = $db->sign_in($_POST["mail_id"] , $POST["password"]);
    }
    if($info){
        $_SESSION["mail_id"] = $_POST["mail_id"];
        header("location:http://127.0.0.1:8080/index.php");
        die();
    }
    else{
        header("location:http://127.0.0.1:8080/static/login.html");
        die();
    }
?>
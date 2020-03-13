<?php
    session_start();
    include "static/index.html";
    if($_SESSION["mail_id"]){
        echo $_SESSION["mail_id"];
    }
?>
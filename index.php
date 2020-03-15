<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>VectorCam</title>
        <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
    </head>

    <body>
    <nav class="navbar sticky-top navbar-light bg-light">
        <a class="navbar-brand justify-content-start" href="#">VectorCam</a>

        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" href="static/shop.html">Shop</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="static/about.html">About</a>
            </li>
            <li class="nav-item">
                <?php 
                    if($_SESSION["mail_id"]){
                        echo('<a href="#" class="nav-link">My Account</a>');
                    }
                    else{
                        echo('<a href="static/login.html" class="nav-link">Login</a>');
                    }
                ?>
            </li>
        </ul>
    </nav>

    </body>

</html>

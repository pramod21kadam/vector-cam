<?php
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <title>VectorCam</title>
    </head>

    <body>
        <header>
            <ul>
                <li><a href="static/shop.html">Shop</a></li>
                <li><a href="static/about.html">About</a></li>
                <li>
                    <?php 
                        if($_SESSION["mail_id"]){
                            echo('<a href="#">My Account</a>');
                        }
                        else{
                            echo('<a href="static/login.html">Login</a>');
                        }
                    ?>
                </li>
            </ul>
        </header>

        
    </body>

</html>

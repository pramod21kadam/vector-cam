<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>VectorCam</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/index.css">
    </head>
    <body>
        <?php require"php_includes/nav_bar.php" ?>

        <div class="row index-banner">

            <div class="col index-banner-content mx-auto"> 
                <div id="index-banner-heading">
                    <h1>VectorCam</h1>
                    <h3>Take back your privacy.</h3>
                </div>
                <div id="index-banner-text">
                    <p>
                        VectorCam is an IOT based security camera system. 
                        Which is easy to setup and can be customized according to the users need.
                        Choose VectorCam to sequre your home and offices without worring about privacy issues.
                    </p>
                </div>

                <div class="index-banner-buttons">
                    <div class="row">
                        <div class="col">
                            <button type="button" id="shop-btn" class="banner-button" >Shop</button>
                        </div>
                        <div class="col">
                            <button type="button" id="learn-more-btn" class="banner-button" >Learn More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="index-learn-more">

            <div class="row">
                <div class="col">

                </div>
                <div class="col">

                </div>
            </div>

        </div>
    </body>

</html>

<?php
    session_start();
?>

<!DOCTYPE html>
<html>

    <head>
        <title>VectorCam</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/main.css">
        <link rel="stylesheet" href="static/css/index.css">
    </head>

    <body class="hidden" >
        <div class="index-banner">
            
            <div class="" id="index-nav">
                <?php require"php_includes/nav_bar.php" ?>
            </div>
           

            <div class="row">
                <div class="col index-banner-content mx-auto hidden"> 
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
                                <button type="button" id="learn-more-btn" class="banner-button" onclick="scroll_down()">Learn More</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>

        <div class="index-learn-more mx-auto">

            <div class="row" id="open-desc">
                <div class="col img-col-left">
                    <img class="lm-img" src="static/images/open.jpg" alt="">
                </div>

                <div class="col desc-col-right">
                    <h3>Secure</h3>
                    <p>
                        Secure your property with VectorCam without worring about privacy.
                        VectorCam source code is open source which means avilable to view and edit to everyone.
                        VectorCam is way more secure thanks to thousands of developers patching the security flaw.
                    </p>
                </div>
            </div>

            <div class="row" id="toolkit-desc">
                <div class="col desc-col-left">
                    <h3>Installation</h3>
                    <p>
                        VectorCam is very easy to install and configure.
                        All the necessary tools are included in toolbox provided.
                        Just follow the instructions and you are done. 
                        It is as easy as making sandwitch.
                    </p>
                </div>
                <div class="col img-col-right">
                    <img class="lm-img" src="static/images/toolkit.jpg" alt="">
                </div>
            </div>

            <div class="row" id="customizable-desc">
                <div class="col img-col-left">
                    <img class="lm-img" src="static/images/customize.jpg" alt="">
                </div>

                <div class="col desc-col-right">
                    <h3>Customizable</h3>
                    <p>
                        VectorCam is highly customizable. 
                        New features can added by writing modules in Python programming language.
                        You don't need to be black ninja to customize VectorCam, apply these verified pre-built modules as you wish.
                    </p>
                </div>
            </div>


        </div>
    </body>

    <script src="static/js/index.js"></script>

</html>

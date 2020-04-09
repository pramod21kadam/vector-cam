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
        <link rel="stylesheet" href="static/css/nav.css">

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

        <div class="index-learn-more">
            <div class="row">
                <div class="col">

                </div>
                <div class="col">

                </div>
            </div>

        </div>
    </body>



    <script>
        // function to wait till page lodes 
        ready();
        
        function ready(fn) {
            if (document.readyState != 'loading'){
                show_body();
            } 
            else {
                document.addEventListener('DOMContentLoaded', show_body);
            }
        }

        function show_body(){
            document.getElementsByTagName("body")[0].className = "";
            
            setTimeout(() => {  
            var banner_content = document.getElementsByClassName("index-banner-content")[0];
            banner_content.className = banner_content.className.replace(" hidden" , "");
                }, 500); 
        }

        function scroll_down(){
            document.querySelector('.index-learn-more').scrollIntoView({ 
                behavior: 'smooth' 
            });
        }

    </script>
</html>

<nav class="navbar sticky-top navbar-custom navbar-animate-slidein" id="nav-bar">
    <a class="navbar-brand justify-content-start" href="index.php">VectorCam</a>

    <ul class="nav justify-content-end">
        <li class="nav-item hvr-underline-from-center">
            <a class="nav-link active" href="shop.php">Shop</a>
        </li>
        <li class="nav-item hvr-underline-from-center">
            <a class="nav-link" href="about.php">About</a>
        </li>
        
        <?php 
            if($_SESSION["admin"]){
                echo('<li class="nav-item hvr-underline-from-center">
                        <a href="admin_dashbord.php" class="nav-link">Dashbord</a>
                    </li>');

                echo('<li class="nav-item hvr-underline-from-center">
                        <a href="php_includes/logout.php" class="nav-link">Log out</a>
                    </li>');
            }
            else if(isset($_SESSION["email"])){
                echo('<li class="nav-item hvr-underline-from-center">
                        <a href="my_account.php" class="nav-link">My Account</a>
                    </li>');
                
                echo('<li class="nav-item hvr-underline-from-center">
                        <a href="php_includes/logout.php" class="nav-link">Log out</a>
                    </li>');
            }
            else{
                echo('<li class="nav-item hvr-underline-from-center">
                        <a href="static/sign-in.html" class="nav-link">Login</a>
                    </li>');
            }
        ?>
        
    </ul>
</nav>
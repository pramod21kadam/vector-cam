<nav class="navbar sticky-top navbar-custom">
    <a class="navbar-brand justify-content-start" href="index.php">VectorCam</a>

    <ul class="nav justify-content-end">
        <li class="nav-item hvr-underline-from-center">
            <a class="nav-link active" href="shop.php">Shop</a>
        </li>
        <li class="nav-item hvr-underline-from-center">
            <a class="nav-link" href="static/about.html">About</a>
        </li>
        <li class="nav-item hvr-underline-from-center">
            <?php 
                if($_SESSION["admin"]){
                    echo('<a href="admin_dashbord.php" class="nav-link">Dashbord</a>');
                }
                else if(isset($_SESSION["mail_id"])){
                    echo('<a href="my_account.php" class="nav-link">My Account</a>');
                }
                else{
                    echo('<a href="static/login.html" class="nav-link">Login</a>');
                }
            ?>
        </li>
    </ul>
</nav>
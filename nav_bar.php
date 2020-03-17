<nav class="navbar sticky-top navbar-light bg-light">
    <a class="navbar-brand justify-content-start" href="index.php">VectorCam</a>

    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a class="nav-link active" href="shop.php">Shop</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="static/about.html">About</a>
        </li>
        <li class="nav-item">
            <?php 
                if(isset($_SESSION["mail_id"])){
                    echo('<a href="#" class="nav-link">My Account</a>');
                }
                else{
                    echo('<a href="static/login.html" class="nav-link">Login</a>');
                }
            ?>
        </li>
    </ul>
</nav>
    

<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/css/main.css">
    <link rel="stylesheet" href="static/css/about.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700;800&display=swap" rel="stylesheet">
    <title>About</title>
</head>

<body>
    <main>
        <section class="about-banner">
            <?php require 'php_includes/nav_bar.php';?>
            <div class="heading">
                <h1>VectorCam</h1>
                <p>
                    An organization which cares about you and your privacy.
                    <br>VectorCam was founded in 2019 in effort to deliver range of open source smart devices. 
                </p>
            </div>
            
            <a href="#details-section">
                <div class="scroll-down-mouse">
                    <div class="scroll-down-btn"></div>
                </div>
            </a>
            
        </section>
        <section id="details-section" class="details-section">
            <!-- <div class="details-row">
                <div class="details-row-item">
                    <img src="images/globe.jpg" alt="" srcset="">
                    <p>40K+ happy customers around globe.</p>
                </div>
                <div class="details-row-item">
                    <img src="images/team.jpg" alt="" srcset="">
                    <p>10K+ dedicated team members.</p>
                </div>
            </div> -->
            <!-- <div class="stripe">

            </div> -->
            
            <div class="founding-member-heading">
                <h1>Founding members</h1>
            </div>
            
            <div class="details-row">
                <div class="details-row-item">
                    <div class="img-container">
                        <a href="http://github.com/onkarkunjir">
                            <div class="img-cover">
                                <p>
                                    Full stack developer and machine learning engineer
                                    and <br> btw, I use Arch!
                                </p>
                            </div>
                            <img src="static/images/onkya.png" alt="" srcset="">
                        </a>
                    </div>
                    <p>Onkar Kunjir</p>
                </div>

                <div class="details-row-item">
                    <div class="img-container">
                        <a href="#">
                            <div class="img-cover">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                    <br>Cras a mi lobortis, venenatis felis nec, ultricies elit. 
                                </p>
                            </div>
                            <img src="static/images/pamya.png" alt="" srcset="">
                        </a>
                       
                    </div>
                    <p>Pramod Kadam</p>
                </div>
            </div>

            <div class="details-row">
                <div class="details-row-item">
                    <div class="img-container">
                        <a href="#">
                            <div class="img-cover">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                    <br>Cras a mi lobortis, venenatis felis nec, ultricies elit. 
                                </p>
                            </div>
                            <img src="static/images/patya.png" alt="" srcset="">
                        </a>
                    </div>
                    <p>Prathemash Sahane</p>
                </div>

                <div class="details-row-item">
                    <div class="img-container">
                        <a href="#">
                            <div class="img-cover">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                    <br>Cras a mi lobortis, venenatis felis nec, ultricies elit. 
                                </p>
                            </div>
                            <img src="static/images/yogesh.png" alt="" srcset="">
                        </a>
                    </div>
                    <p>Yogesh Satpute</p>
                </div>
            </div>


        </section>
    </main>    
</body>

</html>
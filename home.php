<?php

include_once "functions/functions.php";

?>

<!-- Header Template -->
<?= header_template('HOMEPAGE'); ?>

<!-- Navbar Section -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Student Portal System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about-us/about-us.html">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about-us/contact-us.html">Contact Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Logins
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="administrator/admin_login.php">Admin</a></li>
                        <li><a class="dropdown-item" href="lecturer/lecturer_login.php">Lecturer</a></li>
                        <li><a class="dropdown-item" href="student/student_login.php">Student</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Carousel -->
<div id="carouselIndicator" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselIndicator" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselIndicator" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselIndicator" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/image1.jpg" class="d-block w-100">
            <div class="carousel-caption d-none d-md-block">
                <h5>Student Management</h5>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vel voluptates nihil enim pariatur hic eum tenetur voluptatibus nam ut necessitatibus.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/image2.jpg" class="d-block w-100">
            <div class="carousel-caption d-none d-md-block">
                <h5>Lecturer Management</h5>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vel voluptates nihil enim pariatur hic eum tenetur voluptatibus nam ut necessitatibus.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/image3.jpg" class="d-block w-100">
            <div class="carousel-caption d-none d-md-block">
                <h5>See what's new</h5>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vel voluptates nihil enim pariatur hic eum tenetur voluptatibus nam ut necessitatibus.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicator" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicator" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Footer template -->
<?= footer_template(); ?>
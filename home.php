<?php

include_once "functions/functions.php";

?>

<!-- Header Template -->
<?= header_template('HOMEPAGE'); ?>

<body>
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
                    <p>
                        The school portal system provides :
                    </p>
                    <p>
                        A centralized platform for students' data and academic records, including enrolment details, class schedules, grades and attendance records. Through the school portal system, administrators can monitor and manage student performance, as well as communicate with students and faculty.
                    </p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/image2.jpg" class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Lecturer Management</h5>
                    <p>
                        The school portal system enables the lecturers as well as the school administration to:
                    </p>
                    <p>
                        1.Monitor grades and attendance tracking: The school portal system enables lecturers as well as administrators to track student grades and attendance, allowing them to identify students who may be struggling and provide necessary support.  <br>
                    </p>
                    <p>
                        2.Resource management: The school portal system enables administrators to manage academic resources such as textbooks, course materials, and other educational resources.

                    </p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/image3.jpg" class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h5>See what's new</h5>
                    <p>
                        The school portal system provides :
                    </p>
                    <p>
                        Communication tools: Such as this section page and emails, allowing administrators to communicate easily with students and faculty.
                    </p>
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

    <!-- Subsection 1 -->
    <div id="subsection1">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="subsection">
                        <h1>Academics</h1>
                        <p>
                            /"school name"/ is a premier private international university whose mission is to produce authentic leaders and upright members of the Society capable of contributing to sustainable Development to the rest of the world.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="subsection">
                        <h1>Students</h1>
                        <p>
                            Our mission is to promote excellence in research, teaching and community service by preparing morally upright and Outstanding leaders.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="subsection">
                        <h1>Admission Process</h1>
                        <p>
                            /"School name"/ accepts qualified applicants from all over the world.The application forms are available for download. Email admissions@schools.edu or Call 008909691000/111
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Subsection 2 -->
    <div id="subsection2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="subsection">
                        <img src="./images/image2.jpg" class="img-fluid" alt="">
                        <a href="./about-us/about-us.html">About Us</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="subsection">
                        <img src="./images/image1.jpg" class="img-fluid" height="500" alt="">
                        <a href="./about-us/contact-us.html">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer template -->
    <?= footer_template(); ?>

</body>
<?php

include_once "functions/functions.php";

$database_connection = db_connect();

?>

<!-- Header Template -->
<?= header_template('Homepage'); ?>

<!-- Login Links -->
<div class="container">
    <div class="login_link">
        <div class="row">
            <!-- Admin login link -->
            <div class="col-md-4">
                <a href="">Admin Login</a>
            </div>

            <!-- Lecturer login link -->
            <div class="col-md-4">
                <a href="">Lecturer Login</a>
            </div>

            <!-- Student login link -->
            <div class="col-md-4">
                <a href="">Student Login</a>
            </div>
        </div>
    </div>
</div>
<?php 
// Database Connection 
function db_connect(){
    $DATABASE_HOST = "localhost";
    $DATABASE_USER = "root";
    $DATABASE_PASSWORD = "";
    $DATABASE_NAME = "school_portal_system";

    try {
        return new PDO("mysql:host=" . $DATABASE_HOST . ";dbname=" . $DATABASE_NAME . ";charset=utf8", $DATABASE_USER, $DATABASE_PASSWORD);
    } catch (PDOException $exception){
        // Stop the script and generate an error incase there's a problem 
        exit("Connection to the database was unsuccessful" . $exception->getMessage());
    }
}

// Header Template
function header_template($page_title) 
{
    $element = "
        <!DOCTYPE html>
        <html lang=\"en\">
        <head>
        <title>$page_title</title>
        <meta charset=\"utf-8\">
        <meta name=\"viewport\" content=\"width=device-width\">
        <meta name=\"author\" content=\"Bryan Kiragu; Joshua obare; Samson Nyalik\">
        <link rel=\"stylesheet\" href=\"css/styles.css\">
        <link rel=\"stylesheet\" href=\"css/bootstrap.min.css\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"about-us/about-contact-us.css\">
        <script src=\"registration.js\" defer></script>
    ";
    
    echo $element;
}

// Footer Template
function footer_template(){
    $element = "
      <script src=\"https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js\" integrity=\"sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3\" crossorigin=\"anonymous\"></script>
<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js\" integrity=\"sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD\" crossorigin=\"anonymous\"></script>
    ";
    echo $element;
}

?>
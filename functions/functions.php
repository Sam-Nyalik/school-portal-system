<?php 
// Database Connection 
function db_connect(){
    $DATABASE_HOST = "localhost";
    $DATABASE_USER = "root";
    $DATABASE_PASSWORD = "";
    $DATABASE_NAME = "school_portal_system";

    try {
        $pdo = new PDO("mysql:host=" . $DATABASE_HOST . ";dbname=" . $DATABASE_NAME . ";charset=utf8", $DATABASE_USER, $DATABASE_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
         
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
        <link rel=\"stylesheet\" href=\"registration.css\">
        <link rel=\"stylesheet\" href=\"css/bootstrap.min.css\">
        <script src=\"registration.js\" defer></script>
    ";
    
    echo $element;
}

?>
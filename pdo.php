<?php
$dsn = "mysql:host=localhost;dbname=school_portal_system";
$user = "root";
$password = "";

try {
    $pdo = new PDO($dsn , $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully<br>";
} catch(PDOException $e) {
    echo "Connection attempt failed successfully <br>" .$e->getMessage();
}


?>



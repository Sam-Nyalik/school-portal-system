<?php
include_once("connection.php");

if (isset($_POST['email']) && isset($_POST['password'])) {
    try{
        $sql = "SELECT FROM users values where email = :email and password = :password";
        $stmt = $pso->prepare($sql);
        $stmt->execute(array(
            ':email' => $_POST['email'],
            ':password' => $_POST['password']
        ));
    } catch(Exception $e) {
        echo "Can't find value, try again";
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>
</head>
<body>
    <h1>Login Page</h1>
    <form method="post" class="login-form">
        <div class="login-form-item">
            <label for="">Email:</label>
            <input type="email" id="login-email">
        </div>
        <div class="login-form-item">
            <label for="">Password</label>
            <input type="text">
        </div>
        <button class="login-button">Log In</button>
    </form>
</body>
</html>
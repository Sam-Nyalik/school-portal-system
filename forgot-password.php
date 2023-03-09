<?php
include_once('pdo.php');

if (isset($_POST["email"]) && isset($_POST["password"])){
    try{
        $sql = "UPDATE users set password = :password where email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ":email" => $_POST['email'],
            ":password" => $_POST['password']
    ));

    header("Location: login.php");
    } catch (Exception $e) {
        echo "Can't find value, try again<br>" .$e->getMessage();
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
    <title>Forgot Password</title>
</head>
<body>
    <main class="forgot-password-main">
        <form action="forgotPassword.php" class="forgot-password-form" method ="post">
            <h1>Forgot Password</h1>
            <div class="forgot-password-form-item">
                <label for="new-password">Enter your email address</label>
                <input type="text" name="email" id="forgot-email">
            </div>
            <div class="forgot-password-form-item">
                <label for="new-password">Enter your new password</label>
                <input type="text" name="password" id="forgot-password">
            </div>
            <div class="forgot-password-form-item">
                <button type="submit" class="forgot-password-form-button">Submit</button>
            </div>
            
        </form>
    </main>
</body>
</html>

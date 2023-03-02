<?php
include_once("pdo.php");
$successfulLogin = true;
if (isset($_POST['email']) && isset($_POST['password'])) {    
    try{
        $sql = "SELECT * FROM users WHERE email = :email and password = :password";        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ":email" => $_POST['email'],
            ":password" => $_POST['password']
        ));
        $row = $stmt ->fetch(PDO::FETCH_ASSOC);

        if($row){
            echo "Welcome " .$row['first_name'];

            if($row["roleID"] === "1"){
                // render admin page
            } elseif($row["roleID"] === "2"){
                // render student page
            } else{
                // render lecturer page
            }

        } else {
            $successfulLogin = false;
             
        }

        
        
    } catch(Exception $e) {
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
    <script src="login.js" defer></script>
    <title>Login Page</title>
</head>
<body>
    <main class="login-main">
        <h1>Login Page</h1>
        <form method="post" class="login-form" action="login.php" novalidate>
            <span class="invalid-login">
                <?php
                $successfulLogin ? "" : "Invalid Login, please try again";                
                ?>
            </span>
            <div class="login-form-item">
                <label for="login-email">Email:</label>
                <input type="email" id="login-email" name="email" required>
                <span class="login-email-error error"></span>
            </div>
            <div class="login-form-item">
                <label for="login-password">Password</label>
                <input type="password" name="password" id="login-password" required>
                <span class="login-password-error error"></span>
            </div>
            <button class="login-button">Log In</button>
        </form>
    </main>
    
   
</body>
</html>
<?php
include_once("pdo.php");

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

            if($row["role"] === "1"){
                // render admin page
            } elseif($row["role"] === "2"){
                // render student page
            } else{
                // render lecturer page
            }

        } else {
            echo "Invalid username or password, try again";
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
    <title>Login Page</title>
</head>
<body>
    <h1>Login Page</h1>
    <form method="post" class="login-form" action="login.php">
        <div class="login-form-item">
            <label for="">Email:</label>
            <input type="email" id="login-email" name="email">
        </div>
        <div class="login-form-item">
            <label for="">Password</label>
            <input type="text" name="password">
        </div>
        <button class="login-button">Log In</button>
    </form>
   
</body>
</html>
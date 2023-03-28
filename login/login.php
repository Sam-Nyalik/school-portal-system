<?php
include_once("../pdo.php");
include_once "../functions/functions.php";

$successfulLogin = true;
$welcomeMessage = "";
$loginErrorMessage = "Invalid login, please try again";
$row = ["userID" => ""];

if (isset($_POST['email']) && isset($_POST['password'])) {    
    try{
        $sql = "SELECT * FROM users WHERE email = :email";        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ":email" => $_POST['email']
        ));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        

        if($row){
            $password_verification = password_verify($_POST['password'] , $row['password']);
            
            if($password_verification){
                $id = $row['userID'];
                $welcomeMessage = "Welcome " .$row['first_name'];
                if($row["roleID"] === "1"){
                
                    header("Location: ../admin-portal/admin-portal.php?id=$id");
                } elseif($row["roleID"] === "2"){
                                    
                    header("Location: ../student-portal/student-portal.php?id=$id");
                
                } elseif($row["roleID"] === "3"){                
                    header("Location: ../lecturer-portal/lecturer-portal.php?id=$id");
                }
            } else {
                $successfulLogin = false;
                $welcomeMessage = "";
            }
            

        } else {
            $successfulLogin = false;
            $welcomeMessage = "";
             
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
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="login.js" defer></script>
    <title>Login Page</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Student Portal System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../about-us/about-us.html">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../about-us/contact-us.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./login/login.php">
                            Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="login-main">
        <h1>Login Page</h1>
        <form method="post" class="login-form" action="login.php" novalidate>
            <span class="invalid-login error">
                <?php
                
                $successfulLogin ? print($welcomeMessage) : print($loginErrorMessage);
                                
                ?>
            </span>
            <div class="login-form-item">
                <label for="login-email">Email</label>
                <input type="email" id="login-email" name="email" required>
                <span class="login-email-error error"></span>
            </div>
            <div class="login-form-item">
                <label for="login-password">Password</label>
                <input type="password" name="password" id="login-password" required>
                <span class="login-password-error error"></span>
            </div>
            <div class="login-form-item">
                <button class="login-button">Log In</button>    
            </div>
            </form>
            <?php
            echo"<form class='forgot-password-form' action='forgotPassword.php' method='post'>";
            echo"    <input class='forgot-password-btn' type='submit' value='Forgot password?'/>
            </form>"

            ?>
            
            
        
    </main>
    
   
</body>
</html>
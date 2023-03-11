<?php
include_once("pdo.php");
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
        $password_verification = password_verify($_POST['password'] , $row['password']);

        if($row && $password_verification){
            $id = $row['userID'];
            $welcomeMessage = "Welcome " .$row['first_name'];
            if($row["roleID"] === "1"){
                // render admin page
            } elseif($row["roleID"] === "2"){
                // render student page
                
                header("Location: ../student-portal/student-portal.html?id=$id");
                /* try{
                    $sql = "SELECT * FROM STUDENTS WHERE USERID = :userID";
                    $stmt= $pdo->prepare($sql);
                    $stmt->execute(array(
                        ":userID" => $row['userID']
                    ));
                    $student_row = $stmt->fetch(PDO::FETCH_ASSOC);
                    header('Location: ../student-portal/student-portal.html');
                }catch(Exception $e){
                    echo "Can't find student, try again<br>" .$e->getMessage();
                } */
            } else{
                // render lecturer page
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
    <script src="login.js" defer></script>
    <title>Login Page</title>
</head>
<body>
    <main class="login-main">
        <h1>Login Page</h1>
        <form method="post" class="login-form" action="login.php" novalidate>
            <span class="invalid-login">
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
            //echo('<input type="hidden" value="'.$row['userID'].'" name="userID"/>');
            echo"    <input class='forgot-password-btn' type='submit' value='Forgot password?'/>
            </form>"

            ?>
            
            
        
    </main>
    
   
</body>
</html>
<?php

include_once("../pdo.php");

if(isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['lecID'])){
    try{
        $sql = "UPDATE USERS
                SET FIRST_NAME = :firstName, LAST_NAME = :lastName, EMAIL = :email, PHONE_NUMBER = :phone
                WHERE USERID = :userID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ":firstName" => $_POST['firstName'],
            ":lastName" => $_POST['lastName'],
            ":email" => $_POST['email'],
            ":userID" => $_POST['lecID'],
            ":phone" => $_POST['phone']
        ));

    }catch(Exception $e){

    }
}

if(isset($_POST['lecID'])){    
    
    try{
        $sql = "SELECT LECTURERS.* , USERS.*
                FROM USERS 
                INNER JOIN LECTURERS ON LECTURERS.USERID = USERS.USERID                
                WHERE USERS.USERID = :userID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ":userID" => $_POST['lecID']
        ));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
    }catch(Exception $e){

    }
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <title>Lecturer Portal</title>
    <link rel="stylesheet" type="text/css" href="lecturer-profile.css">
    <script src="lecturer-portal.js"></script>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body class="edit-profile-body">
<header>
    <h1>Edit Profile</h1>
    <nav>
        <ul>
            <li><a href=<?= "lecturer-portal.php?id=".$_POST['lecID']."" ?>>Dashboard</a></li>
        </ul>
    </nav>
</header>

<?php
// define variables and set to empty values
$nameErr = $emailErr = $phoneErr = $departmentErr = "";
$name = $email = $phone  =  $department ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "Phone is required";
    } else {
        $phone = test_input($_POST["phone"]);
        // check if the phone number contains only  numbers. )
        if (!preg_match("/^[0-9]/",$phone)) {

            $phoneErr = "Invalid phone format";
        }
    }
/*
    if (empty($_POST["department"])) {
        $departmentErr = "department is required";
    } else {
        $department = test_input($_POST["department"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$department)) {
            $departmentErr = "Only letters and white space allowed";
        }
    }*/


}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<br>
<section class='edit-profile-section'>
    <!-- <p><span class="error">* required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
    <label for="name-input">Name:</label>
    <input type="text" id="name-input" name="name" value="<?php echo $name;?>">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    <label for="email-input">Email:</label>
    <input type="email" id="email-input" name="email" value="<?php echo $email;?>">
    <span class="error">* <?php echo $emailErr;?></span>
    <br><br>
    <label for="phone-input">Phone:</label>
    <input type="tel" id="phone-input" name="phone" value="<?php echo $phone;?>">
    <span class="error">* <?php echo $phoneErr;?></span>
    <br><br>
    <label for="department-input">Department:</label>
    <input type="text" id="department-input" name="department" value="<?php echo $department;?> disabled">
    <span class="error">* <?php echo $departmentErr;?></span>
    <br><br>

    <button type="submit">Save Changes</button>
    </form> -->
    <form action='#' method='post' class="edit-form">
        <div class='edit-form-item'>
            <label for="name-input">First Name:</label>
            <input type="text" id="name-input" name="firstName" value=<?= $row['first_name'] ?>>
        </div>
        <div class='edit-form-item'>
        <label for="name-input">Last Name:</label>
        <input type="text" id="name-input" name="lastName" value=<?= $row['last_name'] ?>>
        </div>
        <div class='edit-form-item'>
        <label for="email-input">Email:</label>
        <input type="email" id="email-input" name="email" value=<?= $row['email'] ?>>
        </div>
        <div class='edit-form-item'>
        <label for="phone-input">Phone:</label>
        <input type="tel" id="phone-input" name="phone" value=<?= $row['phone_number'] ?>>
        </div>         
        <input type="hidden" value=<?= $_POST['lecID']?> name='lecID'>
        
        
        <button type="submit">Save Changes</button>
    </form>


</section>
<footer>
    <p>&copy; Lecturer Portal 2023</p>
</footer>
</body>
</html>
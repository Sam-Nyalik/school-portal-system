<?php
include_once("../pdo.php");



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
</head>
<body>
<header>
    <h1>Profile</h1>
    <nav>
        <ul>
            <li><a href="lecturer-portal.php">Dashboard</a></li>
        </ul>
    </nav>
</header>
<br>
<section>
    <form action='#' method='post'>
        <label for="name-input">First Name:</label>
        <input type="text" id="name-input" name="firstName" value=<?= $row['first_name'] ?>>
        <label for="name-input">Last Name:</label>
        <input type="text" id="name-input" name="lastName" value=<?= $row['last_name'] ?>>
        <label for="email-input">Email:</label>
        <input type="email" id="email-input" name="email" value=<?= $row['email'] ?>>
        <label for="phone-input">Phone:</label>
        <input type="tel" id="phone-input" name="phone" value=<?= $row['phone_number'] ?>>
        <label for="department-input">Department:</label>
        <input type="text" id="department-input" name="department" value="Computer Science">
        <label for="office-input">Office:</label>
        <input type="text" id="office-input" name="office" value="CS Building Room 123">
        <button type="submit">Save Changes</button>
    </form>
</section>
<footer>
    <p>&copy; Lecturer Portal 2023</p>
</footer>
</body>
</html>
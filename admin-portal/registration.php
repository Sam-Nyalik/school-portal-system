<?php
// Importing data  =from the functions page
require_once "../functions/functions.php";

// Database connection
$pdo = db_connect();

// Define variables and assign them empty values
$firstName = $lastName = $emailAddress = $phoneNumber = $password = $confirmPassword = $gender = $role = $dateOfBirth = $yearOfStudy = $course = $department = "";
$firstName_error = $lastName_error = $emailAddress_error = $phoneNumber_error = $password_error = $confirmPassword_error = $gender_error = $role_error = $dateOfBirth_error = $yearOfStudy_error = $course_error = $department_error = "";
$error_message = "";
// After client-side data validation and form submission, a check is made for whether relevant data exists in the $_POST array 
if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['emailAddress']) && isset($_POST['phoneNumber']) && isset($_POST['password']) && isset($_POST['confirmPassword']) && isset($_POST['gender']) && isset($_POST['role'])){

    // This try-catch block inserts data into the users table by default
    try {
    // Prepare an INSERT statement
    $admin_insert = "INSERT INTO users(first_name, last_name, email, phone_number, password, gender, roleID) VALUES(:firstName, :lastName, :emailAddress, :phoneNumber, :password, :gender, :roleId)";
    $stmt = $pdo->prepare($admin_insert);

    // The placeholders from the INSERT statement are replaced with actual values from the $_POST array before being executed
    $stmt->execute(array(
        ":firstName" => $_POST['firstName'],
        ":lastName" => $_POST['lastName'],
        ":emailAddress" => $_POST['emailAddress'],
        ":phoneNumber" => $_POST['phoneNumber'],
        ":password" => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ":gender" => $_POST['gender'],
        ":roleId" => $_POST['role']
    ));    
      // an error message will be echoed
    } catch (PDOException $pde){        
        if($pde->getCode() == 23000){
            $error_message = "Email already taken. Try a different email";
        } else {
            echo "Error<br>" .$pde->getMessage();
        }
        
    }
    $user_id = $pdo->lastInsertId();

    // This if block is executed if the student role is chosen
    if(isset($_POST['dob']) && isset($_POST['yearOfStudy']) && $_POST['course'] !== "" ){
        
        try{
            $student_insert = "INSERT INTO students(enrol_date, date_of_birth, year, userID, courseID) VALUES(CURRENT_TIMESTAMP(), :dob, :yearOfStudy, :userID, :courseID)";
            $stmt = $pdo->prepare($student_insert);            
            $stmt->execute(array(               
                ":dob" => $_POST['dob'],
                ":yearOfStudy" => $_POST['yearOfStudy'],
                ":userID" => $user_id,
                ":courseID" => $_POST['course']
            ));
            
        }catch(Exception $e){
            echo "Error<br>" .$e->getMessage();
        }
    }

    // This if block is executed if the lecturer role is chosen 
    if($_POST['department'] !== "") {
        try{
            $lecturer_insert = "INSERT INTO lecturers(userID , departmentID) values(:userID , :department)";
            $stmt = $pdo->prepare($lecturer_insert);
            $stmt->execute(array(
                ":userID" => $user_id,
                ":department" => $_POST['department']
            ));
        }catch(Exception $e){
            echo "Error<br>" .$e->getMessage();
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registration.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
  <link rel="stylesheet" type="text/css" href="../lecturer-portal/lecturer-portal.css">
  <link rel="stylesheet" type="text/css" href="admin-portal.css">
    <script src="registration.js" defer></script>
    <title>Registration Page</title>
</head>

<body>
<header>
    <h1>School Admin Dashboard</h1>
  </header>
  <nav>
    <ul>
      <li><a href="admin-portal.php">Dashboard</a></li>
      <li><a href="admin-portal.php#admin-student-section">Students</a></li>
      <li><a href="admin-portal.php#admin-lecturers-section">Lecturers</a></li>
      <li><a href="#">Registration Form</a></li>
      <li><a href="#">Logout</a></li>
    </ul>
  </nav>
    <div class="container">
        <h2>User Registration</h2>
        <form class="registration-form" id="registration-form" method="post" action="#" novalidate>
            <div class="registration-form-item">
                <label for="firstName" class="registration-form-label">First Name:</label>
                <input type="text" id="firstName" name="firstName" required>
                <span class="errors text-danger" id="firstNameError"><?= $firstName_error; ?></span>
            </div>

            <div class="registration-form-item">
                <label for="lastName" class="registration-form-label">Last Name:</label>
                <input type="text" id="lastName" name="lastName" required>
                <span class="errors text-danger" id="lastNameError"><?= $lastName_error; ?></span>
            </div>

            <div class="registration-form-item">
                <label for="emailAddress" class="registration-form-label">Email:</label>
                <input type="email" id="emailAddress" name="emailAddress" required>
                <span class=" error" id="emailAddressError"></span>
            </div>

            <div class="registration-form-item">
                <label for="phoneNumber" class="registration-form-label">Phone Number:</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" required>
                <span class="errors text-danger" id= "phoneNumberError"><?= $phoneNumber_error; ?></span>
            </div>

            <div class="registration-form-item">
                <label for="password" class="registration-form-label">Password:</label>
                <input type="password" id="password" name="password" required>
                <span class="errors text-danger" id = "passwordError"><?= $password_error; ?></span>
            </div>

            <div class="registration-form-item">
                <label for="confirmpassword" class="registration-form-label">Confirm Password:</label>
                <input type="password" name="confirmPassword" id="confirmPassword" required>
                <span class="errors text-danger" id="confirmPasswordError"><?= $confirmPassword_error; ?></span>
            </div>

            <div class="registration-form-item">
                <label for="gender" class="registration-form-label" name="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="" disabled>--Select--</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <span class="errors text-danger" id ="genderError"><?= $gender_error; ?></span>
            </div>

            <div class="registration-form-item">
                <label for="role" class="registration-form-label" name="role">Role:</label>
                <select name="role" id="role">
                    <option value="" disabled>--Select--</option>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM ROLES");
                    while($row = $stmt->fetch((PDO::FETCH_ASSOC))){
                        echo('<option value="'.$row['roleID'].'">'.ucfirst($row['role_name']).'</option>');
                    }                    
                    ?>                    
                </select>
            </div>

            <div class="registration-form-item hide studentsInputs">
                <label for="dob" class="registration-form-label" >Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>
                <span class="errors text-danger" id="dobError"><?= $dateOfBirth_error; ?></span>
            </div>

            <div class="registration-form-item hide studentsInputs">
                <label for="yearOfStudy" class="registration-form-label">Year of study</label>
                <input type="number" max="3" min="1" id="yearOfStudy" name="yearOfStudy" required>
                <span class="errors text-danger" id="yearOfStudyError"><?= $yearOfStudy_error; ?></span>
            </div>

            <div class="registration-form-item hide studentsInputs">
                <label for="course" class="registration-form-label">Course</label>
                <select name="course" id="course" required>
                    <option value="">--Select--</option>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM COURSE");
                    while($row = $stmt->fetch((PDO::FETCH_ASSOC))){
                        echo('<option value="'.$row['courseID'].'">'.$row['course_name'].'</option>');
                    }                    
                    ?>  
                    
                </select>
                <span class="errors text-danger" id= "courseError"><?= $course_error; ?></span>
            </div>

            <div class="registration-form-item hide lecturerInput">
                <label for="department" class="registration-form-label">Department</label>
                <select name="department" id="department" required>
                    <option value="" >--Select--</option>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM DEPARTMENT");
                    while($row = $stmt->fetch((PDO::FETCH_ASSOC))){
                        echo('<option value="'.$row['departmentID'].'">'.($row['department_name']).'</option>');
                    }                    
                    ?>
                </select>
                <span class="errors text-danger" id="departmentError"><?=$department_error; ?></span>
            </div>
            
            <div class="registration-form-item">
                <button type="submit" class="registration-form-btn">Submit</button>
            </div>
            <div>
                <?php echo($error_message); ?>
            </div>

        </form>
        
    </div>

</body>

</html>
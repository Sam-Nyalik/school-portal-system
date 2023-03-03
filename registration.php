<?php
// Importing data  =from the functions page
require_once "functions/functions.php";

// Database connection
$pdo = db_connect();

// Define variables and assign them empty values
$firstName = $lastName = $emailAddress = $phoneNumber = $password = $confirmPassword = $gender = $role = $dateOfBirth = $yearOfStudy = $course = $department = "";
$firstName_error = $lastName_error = $emailAddress_error = $phoneNumber_error = $password_error = $confirmPassword_error = $gender_error = $role_error = $dateOfBirth_error = $yearOfStudy_error = $course_error = $department_error = "";
/*
// ADMIN REGISTRATION
// Process form data when the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['role'] == 'admin') {
    // there might be a way to use a loop for this
    /*
    // Validate firstName
    if (empty(trim($_POST['firstName']))) {
        $firstName_error = "Field is required!";
    } else {
        $firstName = trim($_POST['firstName']);
    }

    // Validate lastName
    if (empty(trim($_POST['lastName']))) {
        $lastName_error = "Field si required!";
    } else {
        $lastName = trim($_POST['lastName']);
    }

    // Validate emailAddress
    if (empty(trim($_POST['emailAddress']))) {
        $emailAddress_error = "Field is required!";
    } else {
        $emailAddress = trim($_POST['emailAddress']);
    }

    // Validate phoneNumber
    if (empty(trim($_POST['phoneNumber']))) {
        $phoneNumber_error = "Field is required!";
    } else {
        $phoneNumber = trim($_POST['phoneNumber']);
    }

    // Validate Password
    if (empty(trim($_POST['password']))) {
        $password_error = "Field is required";
    } elseif (strlen(trim($_POST['password'])) < 8) {
        $password_error = "Passwords must contain more than 8 characters!";
    } else {
        $password = trim($_POST['password']);
    }

    // Validate confirmPassword
    if (empty(trim($_POST['confirmPassword']))) {
        $confirmPassword_error = "Field is required!";
    } else {
        $confirmPassword = trim($_POST['confirmPassword']);

        // Check if the passwords match
        if (empty($password_error) && ($password !== $confirmPassword)) {
            $confirmPassword_error = "Passwords do not match!";
        }
    }

    // Validate gender
    if (empty(trim($_POST['gender']))) {
        $gender_error = "Field is required!";
    } else {
        $gender = trim($_POST['gender']);
    } */

    // Check for errors before dealing with the database
    /*
    if (empty($firstName_error) && empty($lastName_error) && empty($emailAddress_error) && empty($phoneNumber_error) && empty($password_error) && empty($confirmPassword_error) && empty($gender_error)) {
        // Prepare an INSERT statement
        $admin_insert = "INSERT INTO users(first_name, last_name, email, phone_number, password, gender, roleID) VALUES(:firstName, :lastName, :emailAddress, :phoneNumber, :password, :gender, :roleId)";
        if ($stmt = $database_connection->prepare($admin_insert)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":firstName", $param_firstName, PDO::PARAM_STR);
            $stmt->bindParam(":lastName", $param_lastName, PDO::PARAM_STR);
            $stmt->bindParam(":emailAddress", $param_emailAddress, PDO::PARAM_STR);
            $stmt->bindParam(":phoneNumber", $param_phoneNumber, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":gender", $param_gender, PDO::PARAM_STR);
            $stmt->bindParam(":roleId", $param_roleId, PDO::PARAM_INT);

            // Set parameters
            $param_firstName = $firstName;
            $param_lastName = $lastName;
            $param_emailAddress = $emailAddress;
            $param_phoneNumber = $phoneNumber;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_gender = $gender;
            $param_roleId = 1;

            // Attemept to execute
            if($stmt->execute()){
                // Redirect admin to the login page
                header("location: admin_login.php");
            } else {
                echo("There was an error, please try again!");
            }
        }
    }
}
*/
if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['emailAddress']) && isset($_POST['phoneNumber']) && isset($_POST['password']) && isset($_POST['confirmPassword']) && isset($_POST['gender']) && isset($_POST['role'])){

    try {
    // Prepare an INSERT statement
    $admin_insert = "INSERT INTO users(first_name, last_name, email, phone_number, password, gender, roleID) VALUES(:firstName, :lastName, :emailAddress, :phoneNumber, :password, :gender, :roleId)";
    $stmt = $pdo->prepare($admin_insert);
    $stmt->execute(array(
        ":firstName" => $_POST['firstName'],
        ":lastName" => $_POST['lastName'],
        ":emailAddress" => $_POST['emailAddress'],
        ":phoneNumber" => $_POST['phoneNumber'],
        ":password" => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ":gender" => $_POST['gender'],
        ":roleId" => $_POST['role']
    ));
    
    
    } catch (Exception $e){
        echo "Error<br>" .$e->getMessage();
    }
    $user_id = $pdo->lastInsertId();

    if(isset($_POST['dob']) && isset($_POST['yearOfStudy']) && isset($_POST['course']) ){
        
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

    if(isset($_POST['department'])) {
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
/*
// STUDENT REGISTRATION
// Process form data when the form has been submitted
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['role'] == 'student'){
    // Validate firstName
    if (empty(trim($_POST['firstName']))) {
        $firstName_error = "Field is required!";
    } else {
        $firstName = trim($_POST['firstName']);
    }

    // Validate lastName
    if (empty(trim($_POST['lastName']))) {
        $lastName_error = "Field si required!";
    } else {
        $lastName = trim($_POST['lastName']);
    }

    // Validate emailAddress
    if (empty(trim($_POST['emailAddress']))) {
        $emailAddress_error = "Field is required!";
    } else {
        $emailAddress = trim($_POST['emailAddress']);
    }

    // Validate phoneNumber
    if (empty(trim($_POST['phoneNumber']))) {
        $phoneNumber_error = "Field is required!";
    } else {
        $phoneNumber = trim($_POST['phoneNumber']);
    }

    // Validate Password
    if (empty(trim($_POST['password']))) {
        $password_error = "Field is required";
    } elseif (strlen(trim($_POST['password'])) < 8) {
        $password_error = "Passwords must contain more than 8 characters!";
    } else {
        $password = trim($_POST['password']);
    }

    // Validate confirmPassword
    if (empty(trim($_POST['confirmPassword']))) {
        $confirmPassword_error = "Field is required!";
    } else {
        $confirmPassword = trim($_POST['confirmPassword']);

        // Check if the passwords match
        if (empty($password_error) && ($password !== $confirmPassword)) {
            $confirmPassword_error = "Passwords do not match!";
        }
    }

    // Validate gender
    if (empty(trim($_POST['gender']))) {
        $gender_error = "Field is required!";
    } else {
        $gender = trim($_POST['gender']);
    }

    // Validate D.O.B
    if(empty(trim($_POST['dob']))){
        $dateOfBirth_error = "Field is required!";
    } else {
        $dateOfBirth = trim($_POST['dob']);
    }

    // Validate Year of study
    if(empty(trim($_POST['yearOfStudy']))){
        $yearOfStudy_error = "Field is required!";
    } else {
        $yearOfStudy = trim($_POST['yearOfStudy']);
    }

    // Validate course
    if(empty(trim($_POST['course']))){
        $course_error = "Field is required!";
    } else {
        $course = trim($_POST['course']);
    }

    // Check for errors before dealing with the database
    if (empty($firstName_error) && empty($lastName_error) && empty($emailAddress_error) && empty($phoneNumber_error) && empty($password_error) && empty($confirmPassword_error) && empty($gender_error) && empty($dateOfBirth_error) && empty($yearOfStudy_error) && empty($course_error)) {
        // Prepare an INSERT statement
        $student_insert = "INSERT INTO users(first_name, last_name, email, phone_number, password, gender, roleID) VALUES(:firstName, :lastName, :emailAddress, :phoneNumber, :password, :gender, :roleId) INTO students(date_of_birth, year, userID, courseID) VALUES(:dob, :yearOfStudy, :userID, :courseID)";
        if ($stmt = $database_connection->prepare($student_insert)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":firstName", $param_firstName, PDO::PARAM_STR);
            $stmt->bindParam(":lastName", $param_lastName, PDO::PARAM_STR);
            $stmt->bindParam(":emailAddress", $param_emailAddress, PDO::PARAM_STR);
            $stmt->bindParam(":phoneNumber", $param_phoneNumber,
                PDO::PARAM_STR
            );
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":gender", $param_gender, PDO::PARAM_STR);
            $stmt->bindParam(":roleId", $param_roleId, PDO::PARAM_INT);
            $stmt->bindParam(":dob", $param_dob, PDO::PARAM_STR);
            $stmt->bindParam(":yearOfStudy", $param_yearOfStudy, PDO::PARAM_STR);
            $stmt->bindParam(":userID", $param_userID, PDO::PARAM_INT);
            $stmt->bindParam(":courseID", $param_courseID, PDO::PARAM_INT);

            // Set parameters
            $param_firstName = $firstName;
            $param_lastName = $lastName;
            $param_emailAddress = $emailAddress;
            $param_phoneNumber = $phoneNumber;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_gender = $gender;
            $param_roleId = 2;
            $param_dob = $dateOfBirth;
            $param_yearOfStudy = $yearOfStudy;
            $param_userID ="" ;
            $param_courseID = "";

            // Attemept to execute
            if ($stmt->execute()) {
                // Redirect student to the login page
                header("location: student_login.php");
            } else {
                echo ("There was an error, please try again!");
            }
        }
    }
}
*/
?>

<!-- Header Template -->
<?= header_template('USER REGISTRATION'); ?>

<body>
    <div class="container">
        <h1><u>User's registration</u></h1>
        <form class="registration-form" method="post" action="#">
            <div class="registration-form-item">
                <label for="firstName" class="registration-form-label">First Name:</label>
                <input type="text" id="firstName" name="firstName">
                <span class="errors text-danger"><?= $firstName_error; ?></span>
            </div>

            <div class="registration-form-item">
                <label for="lastName" class="registration-form-label">Last Name:</label>
                <input type="text" id="lastName" name="lastName">
                <span class="errors text-danger"><?= $lastName_error; ?></span>
            </div>

            <div class="registration-form-item">
                <label for="email" class="registration-form-label">Email:</label>
                <input type="email" id="email" name="emailAddress">
                <span class="errors text-danger"><?= $emailAddress_error; ?></span>
            </div>

            <div class="registration-form-item">
                <label for="phoneNumber" class="registration-form-label">Phone Number:</label>
                <input type="tel" id="phoneNumber" name="phoneNumber">
                <span class="errors text-danger"><?= $phoneNumber_error; ?></span>
            </div>

            <div class="registration-form-item">
                <label for="password" class="registration-form-label">Password:</label>
                <input type="password" id="password" name="password">
                <span class="errors text-danger"><?= $password_error; ?></span>
            </div>

            <div class="registration-form-item">
                <label for="confirmpassword" class="registration-form-label">Confirm Password:</label>
                <input type="password" name="confirmPassword" id="password">
                <span class="errors text-danger"><?= $confirmPassword_error; ?></span>
            </div>

            <div class="registration-form-item">
                <label for="gender" class="registration-form-label" name="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="" disabled>--Select--</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <span class="errors text-danger"><?= $gender_error; ?></span>
            </div>

            <div class="registration-form-item">
                <label for="role" class="registration-form-label" name="role">Role:</label>
                <select name="role" id="role">
                    <option value="" disabled>--Select--</option>
                    <option value=1>Admin</option>
                    <option value=2>Student</option>
                    <option value=3>Lecturer</option>
                </select>
            </div>

            <div class="registration-form-item hide studentsInputs">
                <label for="dob" class="registration-form-label" >Date of Birth:</label>
                <input type="date" id="dob" name="dob">
                <span class="errors text-danger"><?= $dateOfBirth_error; ?></span>
            </div>

            <div class="registration-form-item hide studentsInputs">
                <label for="year" class="registration-form-label">Year of study</label>
                <input type="number" max="3" min="1" id="year" name="yearOfStudy">
                <span class="errors text-danger"><?= $yearOfStudy_error; ?></span>
            </div>

            <div class="registration-form-item hide studentsInputs">
                <label for="course" class="registration-form-label">Course</label>
                <select name="course" id="course">
                    <option value="">--Select--</option>
                    <option value=7>BSc. in Computer Science</option>
                    <option value=10>BSc. in Mathematics</option>
                </select>
                <span class="errors text-danger"><?= $course_error; ?></span>
            </div>

            <div class="registration-form-item hide lecturerInput">
                <label for="department" class="registration-form-label">Department</label>
                <select name="department" id="department">
                    <option value="">--Select--</option>
                    <option value=2>Science</option>
                    <option value=3>Mathematics</option>
                </select>
                <span class="errors text-danger"><?=$department_error; ?></span>
            </div>
            
            <div class="registration-form-item">
                <button type="submit" class="registration-form-btn">Submit</button>
            </div>

        </form>
        <br>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Is Admin</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
            </tbody>
        </table>
    </div>

</body>

</html>
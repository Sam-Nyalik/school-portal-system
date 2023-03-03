<?php
// Importing data  =from the functions page
require_once "functions/functions.php";

// Database connection
$pdo = db_connect();

// Define variables and assign them empty values
$firstName = $lastName = $emailAddress = $phoneNumber = $password = $confirmPassword = $gender = $role = $dateOfBirth = $yearOfStudy = $course = $department = "";
$firstName_error = $lastName_error = $emailAddress_error = $phoneNumber_error = $password_error = $confirmPassword_error = $gender_error = $role_error = $dateOfBirth_error = $yearOfStudy_error = $course_error = $department_error = "";

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
    } catch (Exception $e){
        echo "Error<br>" .$e->getMessage();
    }
    $user_id = $pdo->lastInsertId();

    // This if block is executed if the student role is chosen
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

    // This if block is executed if the lecturer role is chosen 
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
                <input type="password" name="confirmPassword" id="confirmPassword">
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
                <input type="date" id="dob" name="dob">
                <span class="errors text-danger"><?= $dateOfBirth_error; ?></span>
            </div>

            <div class="registration-form-item hide studentsInputs">
                <label for="yearOfStudy" class="registration-form-label">Year of study</label>
                <input type="number" max="3" min="1" id="yearOfStudy" name="yearOfStudy">
                <span class="errors text-danger"><?= $yearOfStudy_error; ?></span>
            </div>

            <div class="registration-form-item hide studentsInputs">
                <label for="course" class="registration-form-label">Course</label>
                <select name="course" id="course">
                    <option value="">--Select--</option>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM COURSE");
                    while($row = $stmt->fetch((PDO::FETCH_ASSOC))){
                        echo('<option value="'.$row['courseID'].'">'.$row['course_name'].'</option>');
                    }                    
                    ?>  
                    
                </select>
                <span class="errors text-danger"><?= $course_error; ?></span>
            </div>

            <div class="registration-form-item hide lecturerInput">
                <label for="department" class="registration-form-label">Department</label>
                <select name="department" id="department">
                    <option value="">--Select--</option>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM DEPARTMENT");
                    while($row = $stmt->fetch((PDO::FETCH_ASSOC))){
                        echo('<option value="'.$row['departmentID'].'">'.($row['department_name']).'</option>');
                    }                    
                    ?>
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
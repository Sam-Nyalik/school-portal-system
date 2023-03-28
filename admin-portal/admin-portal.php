<?php
include_once("../pdo.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>School Admin Dashboard</title>
  <link rel="stylesheet" type="text/css" href="../style.css">
  <link rel="stylesheet" type="text/css" href="../lecturer-portal/lecturer-portal.css">
  <link rel="stylesheet" type="text/css" href="admin-portal.css">
</head>

<body>
  <header>
    <h1>School Admin Dashboard</h1>
  </header>
  <nav>
    <ul>
      <li><a href="#">Dashboard</a></li>
      <li><a href="#admin-student-section">Students</a></li>
      <li><a href="#admin-lecturers-section">Lecturers</a></li>
      <li><a href="registration.php">Registration Form</a></li>
      <li><a href="../home.php">Logout</a></li>
    </ul>
  </nav>
  <main>
    <section>
      <h2 id="admin-student-section">Students</h2>
      <table>
        <thead>
          <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Phone Number</th>
            <th>Gender</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Iterate over the students data from the database and populate the table rows -->
          <?php
          $sql = "SELECT USERS.*,STUDENTS.* , COURSE.*
                      FROM USERS 
                      INNER JOIN STUDENTS ON USERS.USERID = STUDENTS.USERID
                      INNER JOIN COURSE ON STUDENTS.COURSEID = COURSE.COURSEID
                      ";
          $stmt = $pdo->query($sql);
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo ("<tr>");
            echo ('<td>ST00' . $row['studentID'] . '</td>');
            echo ('<td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>');
            echo ('<td>' . $row['email'] . '</td>');
            echo ('<td>' . $row['course_name'] . '</td>');
            echo ('<td>' . $row['phone_number'] . '</td>');
            echo ('<td>' . ucfirst($row['gender']) . '</td>');
            echo ("<td class='edit-btns'>
            <form method='post' action='edit-profile.php'>
              <input type='hidden' value='".$row['userID']."' name='studentID'/>
              <button type='submit'>Edit</button>
            </form>
            <form method='post' action='#'>
              <input type='hidden' value='".$row['userID']."'/>
              <button type='submit'>Delete</button>
            </form>
              </td>
            </tr>");
          }
          ;
          ?>

        </tbody>
      </table>
    </section>
    <section>
      <h2 id="admin-lecturers-section">Lecturers</h2>
      <table>
        <thead>
          <tr>
            <th>Lecturer ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Iterate over the lecturers data from the database and populate the table rows -->
          <?php
          $sql = "SELECT USERS.*,LECTURERS.* , DEPARTMENT.*
          FROM USERS 
          INNER JOIN LECTURERS ON USERS.USERID = LECTURERS.USERID
          INNER JOIN DEPARTMENT ON LECTURERS.DEPARTMENTID = DEPARTMENT.DEPARTMENTID";          
          $stmt = $pdo->query($sql);
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo ("<tr>");
            echo ('<td>LEC00' . $row['lecturerID'] . '</td>');
            echo ('<td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>');
            echo ('<td>' . $row['email'] . '</td>');
            echo ('<td>' . $row['department_name'] . '</td>');
            echo("
            <td class='edit-btns'>
              <form method='post' action='../lecturer-portal/lecturer-profile.php'>
                <input type='hidden' value='".$row['userID']."' name='lecID'/>
                <button type='submit'>Edit</button>
              </form>
              <form method='post' action='#'>
              <input type='hidden' value='".$row['userID']."'/>
              <button type='submit'>Delete</button>
              </form>
            </td>
          </tr>");
          };
          ?>
          
          
        </tbody>
      </table>
    </section>
  </main>
  <footer>
      <p>&copy; Student Portal 2023</p>
  </footer>
</body>

</html>
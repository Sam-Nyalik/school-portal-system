<?php
include_once("../pdo.php");

$row = array();

if (isset($_GET["id"])) {
	try{
		$sql = "SELECT USERS.*,STUDENTS.* , COURSE.*
				FROM USERS 
				INNER JOIN STUDENTS ON USERS.USERID = STUDENTS.USERID
				INNER JOIN COURSE ON STUDENTS.COURSEID = COURSE.COURSEID
				WHERE USERS.USERID = :userID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
			":userID" => $_GET["id"]
		));
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		
	} catch(Exception $e){
		echo "Can't find value, try again<br>" .$e->getMessage();
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Portal</title>
	<link rel="stylesheet" type="text/css" href="student-portal.css">
	<script src="student-portal.js" defer></script>
</head>
<body>
	<header>
		<h1>Student Portal</h1>
		<nav>
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">Units</a></li>
				<li><a href="#">Profile</a></li>
				<li><a href="#">Logout</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<section id="personal-info">
			<h2>Personal Information</h2>
			<p>Name: <span id="name"><?= $row['first_name']." ".$row['last_name'] ?></span></p>
			<p>Enrollment Date: <span id="enrollment-date"><?= $row["enrol_date"]  ?></span></p>
			<p>Date of Birth: <span id="date-of-birth"><?= $row["date_of_birth"] ?></span></p>
			<p>Year of Study: <span id="year-of-study"><?= $row["year"] ?></span></p>
			<p>Student ID: <span id="user-id"></span><?= "ST0".$row["studentID"] ?></p>
			<p>Course: <span id="course-id"><?= $row["course_name"] ?></span></p>
		</section>
		<section id="units">
			<h2>Units</h2>
			<table>
				<thead>
					<tr>
						<th>Unit Code</th>
						<th>Lecturer</th>
						<th>Year</th>
					</tr>
				</thead>
				<tbody id="units-table">
				</tbody>
			</table>
		</section>
        <section id="grades">
			<h2>Grades</h2>
			<table>
				<thead>
					<tr>
						<th>Unit Code</th>
						<th>Unit Title</th>
						<th>Year</th>
						<th>Grade</th>
					</tr>
				</thead>
				<tbody id="grades-table">
				</tbody>
			</table>
		</section>
	</main>
	<footer>
		<p>&copy; Student Portal 2023</p>
	</footer>	
</body>
</html>
<?php
include_once("../pdo.php");

if (isset($_GET["id"])) {
	try{
		$sql = "SELECT USERS.*,STUDENTS.* 
				FROM USERS 
				INNER JOIN STUDENTS ON USERS.USERID = STUDENTS.USERID
				WHERE USERS.USERID = :userID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
			":userID" => $_GET["id"]
		));
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		print_r($row);

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
			<p>Name: <span id="name"></span></p>
			<p>Enrollment Date: <span id="enrollment-date"></span></p>
			<p>Date of Birth: <span id="date-of-birth"></span></p>
			<p>Year of Study: <span id="year-of-study"></span></p>
			<p>User ID: <span id="user-id"></span></p>
			<p>Course ID: <span id="course-id"></span></p>
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
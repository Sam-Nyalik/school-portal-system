<?php
include_once("../pdo.php");

$row = array();
$id = $_GET['id'];

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
			<p>Student ID: <span id="user-id"></span><?= "ST00".$row["studentID"] ?></p>
			<p>Enrollment Date: <span id="enrollment-date"><?= date("D d F Y",strtotime($row["enrol_date"]))  ?></span></p>
			<p>Date of Birth: <span id="date-of-birth"><?= date("D d F Y",strtotime($row["date_of_birth"])) ?></span></p>
			<p>Year of Study: <span id="year-of-study"><?= $row["year"] ?></span></p>
			<p>Course: <span id="course-id"><?= $row["course_name"] ?></span></p>
		</section>
		<section id="units">
			<h2>Units</h2>
			<?php
				$sql = "SELECT UNITS.*, UNIT_REGISTRATION.*, LECTURERS.*, USERS.*
						FROM UNIT_REGISTRATION
						INNER JOIN UNITS ON UNITS.UNITID = UNIT_REGISTRATION.UNITID
						INNER JOIN UNITS ON UNITS.LECTURERID = UNIT_REGISTRATION.LECTURERID
						INNER JOIN LECTURERS ON LECTURERS.LECTURERID = UNITS.LECTURERID
						INNER JOIN USERS ON USERS.USERID = LECTURERS.USERID
						WHERE UNIT_REGISTRATION.USERID = :USERID";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array( 
					":USERID" => $id 

				));
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				if(!$row){
					echo "<div>You aren't registered in any units</div>";
				} else {
					echo("
					<table>
						<thead>
							<tr>
								<th>Unit Code</th>
								<th>Unit Title</th>
								<th>Lecturer Name</th>						
							</tr>");
					while($row){
						echo("<tr>
						<td>".$row['unitID']."</td>
						<td>".$row['title']."</td>
						<td>".$row['first_name'].' '.$row['last_name']."</td>
						<tr>");
					}		
					echo("	</thead>
					<tbody id='units-table'>
					</tbody>
					</table>
					
					");
				}						
						
			
			
			?>
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
<?php
include_once("../pdo.php");

$student_row = array();
$id = $_GET['id'];
$unitIDs = array();

if (isset($_GET["id"])) {
	try {
		$sql = "SELECT USERS.*,STUDENTS.* , COURSE.*
				FROM USERS 
				INNER JOIN STUDENTS ON USERS.USERID = STUDENTS.USERID
				INNER JOIN COURSE ON STUDENTS.COURSEID = COURSE.COURSEID
				WHERE USERS.USERID = :userID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(
			array(
				":userID" => $_GET["id"]
			)
		);
		$student_row = $stmt->fetch(PDO::FETCH_ASSOC);

	} catch (Exception $e) {
		echo "Can't find value, try again<br>" . $e->getMessage();
	}

}

if (isset($_POST['studentID']) && isset($_POST['unitID'])) {

	$unitIDs = unserialize($_POST['unitID']);


	foreach ($unitIDs as $unitID) {
		try {
			$sql = "INSERT INTO UNIT_REGISTRATION (studentID , unitID) VALUES (:studentID , :unitID)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(
				array(
					":studentID" => $_POST['studentID'],
					":unitID" => $unitID
				)
			);


		} catch (Exception $e) {

		}
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
			<p>Name: <span id="name">
					<?= $student_row['first_name'] . " " . $student_row['last_name'] ?>
				</span></p>
			<p>Student ID: <span id="user-id"></span>
				<?= "ST00" . $student_row["studentID"] ?>
			</p>
			<p>Enrollment Date: <span id="enrollment-date">
					<?= date("D d F Y", strtotime($student_row["enrol_date"])) ?>
				</span></p>
			<p>Date of Birth: <span id="date-of-birth">
					<?= date("D d F Y", strtotime($student_row["date_of_birth"])) ?>
				</span></p>
			<p>Year of Study: <span id="year-of-study">
					<?= $student_row["year"] ?>
				</span></p>
			<p>Course: <span id="course-id">
					<?= $student_row["course_name"] ?>
				</span></p>
		</section>
		<section id="units">
			<h2>Units</h2>
			<?php
			$sql = "SELECT UNITS.*, UNIT_REGISTRATION.*, LECTURERS.*, USERS.*
						FROM UNIT_REGISTRATION
						INNER JOIN UNITS ON UNITS.UNITID = UNIT_REGISTRATION.UNITID					
						INNER JOIN LECTURERS ON LECTURERS.LECTURERID = UNITS.LECTURERID
						INNER JOIN USERS ON USERS.USERID = LECTURERS.USERID
						WHERE UNIT_REGISTRATION.STUDENTID = :USERID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(
				array(
					":USERID" => $student_row["studentID"]

				)
			);
			$registration_row = $stmt->fetch(PDO::FETCH_ASSOC);

			
			if (!$registration_row) {
				echo "<div>You aren't registered in any units</div>";
				echo "<h4>Eligible Units</h4>";
				$sql = "SELECT * FROM UNITS WHERE COURSEID = :COURSEID AND YEAR = :YEAR";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(
					array(
						":COURSEID" => $student_row["courseID"],
						":YEAR" => $student_row["year"]
					)
				);
				$units_row = $stmt->fetch(PDO::FETCH_ASSOC);

				if ($units_row) {					
					echo "
					<form method='post' action='#'>
					<table>
						<tr>
								<th>Unit Code</th>
								<th>Unit Title</th>
														
							</tr>
							<input type='hidden' value='" . $student_row['studentID'] . "' name='studentID' />";
					while ($units_row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						array_push($unitIDs, $units_row['unitID']);
						echo ("<tr>							
							<td>" . $units_row['unitID'] . "</td>
							<td>" . $units_row['title'] . "</td>					
						</tr>");
					}
					$unitIDs = serialize($unitIDs);
					echo "
					<input type= 'hidden' value='" . $unitIDs . "' name='unitID'/>
					</table>
					<button type='submit'>Submit</button>
					</form>";
				}

			} else {
				echo ("
					<table>
						<thead>
							<tr>
								<th>Unit Code</th>
								<th>Unit Title</th>
								<th>Lecturer Name</th>						
							</tr>
							</thead>
							<tbody id='units-table'>");
				do {
					echo ("<tr>
						<td>" . $registration_row['unitID'] . "</td>
						<td>" . $registration_row['title'] . "</td>
						<td>" . $registration_row['first_name'] . ' ' . $registration_row['last_name'] . "</td>
						</tr>");
						array_push($unitIDs, $registration_row['unitID']);
				} while ($registration_row = $stmt->fetch(PDO::FETCH_ASSOC));
				echo ("	
					
					</tbody>
					</table>
					
					");
			}
			?>
		</section>
		<section id="student-attendance">
			<h2>Today's Lectures</h2>
			<table>
				<thead>
					<tr>
						<th>Unit Code</th>
						<th>Unit Title</th>
						<th>Date</th>						
						<th>Room Name</th>
					</tr>
				</thead>
				<tbody id="lectures-table">
					<form>
					<?php 
					$lectures_today = false;
					foreach($unitIDs as $unitID){
						$sql = "SELECT UNITS.* , LECTURE.* , CLASSROOM.*
								FROM LECTURE
								INNER JOIN UNITS ON UNITS.UNITID = LECTURE.UNITID 
								INNER JOIN CLASSROOM ON CLASSROOM.CLASSROOMID = LECTURE.CLASSROOMID
								WHERE LECTURE.UNITID = :unitID";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(array(
							":unitID" => $unitID
						));
						

						while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
							
							if($row['day'] === date("l")){
								$lectures_today = true;
								echo"
							<tr>
							<td>".$row['unitID']."</td>
							<td>".$row['title']."</td>
							<td>".date("D M j G:i",strtotime("next ".$row['day']. " ".$row['time']))."</td>							
							<td>".$row['classroom_name']."</td>
							</tr>
							";
							} 
							
						}
						
					}
					if(!$lectures_today){
						echo "<tr><td colspan=4>You have no lectures today</td></tr>";
					} else{
						echo"<button>Submit</button>";
					}
					
					
					?>
					
					</form>
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
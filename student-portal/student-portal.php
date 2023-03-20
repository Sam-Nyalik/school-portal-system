<?php
include_once("../pdo.php");

// student_row will store data on the current student, and is populated when the page is opened intially
$student_row = array();

// the student's ID will be stored in $id
$id = $_GET['id'];

// the student's units' IDs are stored in the $unitIDs and this is populated when the student's units are rendered
$unitIDs = array();

// $_GET['id'] is set when the page is rendered after redirection from login. This is the student's userID 
if (isset($_GET["id"])) {
	// to retrieve complete student data, an SQL join on the course, students and users table is used
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
		// this data is stored in $students_row, a global variable
		$student_row = $stmt->fetch(PDO::FETCH_ASSOC);

	} catch (Exception $e) {
		echo "Can't find value, try again<br>" . $e->getMessage();
	}

}

// the following condition is true when the student registers their units
if (isset($_POST['studentID']) && isset($_POST['unitID'])) {

	// $_POST['unitID'] is serialized before the registration form is submitted, 
	// therefore it must be unserialized before it can be used
	$unitIDs = unserialize($_POST['unitID']);

	// the unitIDs are looped through, and for each ID, the unit_registration table is populated 
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
			echo "Error". $e->getMessage();
		}
	}
}

// this condition is true when the student registers their attendance
if(isset($_POST["attendance"]) && isset($_POST["lectureDate"]) && isset($_POST["lectureID"])) {

	// the attended_lecture table is populated
	try{
		$sql = "INSERT INTO ATTENDED_LECTURE (studentID, attended, lectureID, lectureDate) 
				VALUES(:studentID, :attended, :lectureID, :lectureDate)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
			":studentID" => $student_row['studentID'],
			":attended" => $_POST["attendance"],
			":lectureID" => $_POST["lectureID"] ,
			":lectureDate" => $_POST["lectureDate"] 
		));
	}catch(Exception $e){
		echo "Error". $e->getMessage();
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
			<!-- student data is populated from the students_row array-->
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

			// to retrieve and display the student's units, a check is made for whether the student's 
			// units appear in the unit_registration table along with that student's studentID
			$sql = "SELECT UNITS.*, UNIT_REGISTRATION.*, LECTURERS.*, USERS.*
						FROM UNIT_REGISTRATION
						INNER JOIN UNITS ON UNITS.UNITID = UNIT_REGISTRATION.UNITID					
						INNER JOIN LECTURERS ON LECTURERS.LECTURERID = UNITS.LECTURERID
						INNER JOIN USERS ON USERS.USERID = LECTURERS.USERID
						WHERE UNIT_REGISTRATION.STUDENTID = :STUDENTID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(
				array(
					":STUDENTID" => $student_row["studentID"]

				)
			);
			$registration_row = $stmt->fetch(PDO::FETCH_ASSOC);

			// if $registration_row is empty, the student hasn't registered for any units
			if (!$registration_row) {
				echo "<div>You aren't registered in any units</div>";
				echo "<h4>Eligible Units</h4>";

				// since the student isn't registered for any units, any units they might be
				// eligible we rendered using their courseID and year of study
				$sql = "SELECT * FROM UNITS WHERE COURSEID = :COURSEID AND YEAR = :YEAR";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(
					array(
						":COURSEID" => $student_row["courseID"],
						":YEAR" => $student_row["year"]
					)
				);
				$units_row = $stmt->fetch(PDO::FETCH_ASSOC);

				// their eligible units are rendered  as a form so they can be registered
				if ($units_row) {					
					echo "
					<form method='post' action='#'>
					<table>
						<tr>
								<th>Unit Code</th>
								<th>Unit Title</th>
														
							</tr>
							<input type='hidden' value='" . $student_row['studentID'] . "' name='studentID' />";
					 do {
						// the global unitIDs array is populated with the student's units 
						array_push($unitIDs, $units_row['unitID']);
						echo ("<tr>							
							<td>" . $units_row['unitID'] . "</td>
							<td>" . $units_row['title'] . "</td>					
						</tr>");
					} while ($units_row = $stmt->fetch(PDO::FETCH_ASSOC));
					$unitIDs = serialize($unitIDs);
					echo "
					<input type= 'hidden' value='" . $unitIDs . "' name='unitID'/>
					</table>
					<button type='submit'>Submit</button>
					</form>";
				}

			} else {
				// if they have registered units they are displayed
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

						// the global unitIDs array is populated with the student's units
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
						<th>Attended</th>
					</tr>
				</thead>
				<tbody id="lectures-table">
					<form action="#" method="post"> 
					<?php 
					$lectures_today = false;
					
					// a check for whether the unitIDs array is populated
					if(!empty($unitIDs)){

						// the unitIDs array is typecasted otherwise it throws an error
						foreach((array) $unitIDs as $unitID){
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
								
								// for any rows where the day is the same as the current day, that lecture is displayed
								if($row['day'] === date("l")){
									$lectures_today = true;

									//given the day and time a lecture is scheduled in the lectures table,a corresponding date is generated by calculating 
									// the next occurrence of that day and time within the same week 
									$lectureDate = date("D M j G:i",strtotime("next ".$row['day']. " ".$row['time']));
								
									// an attendance radio input is specified to submit the student's attendance
									echo" 
									<tr>
									<td>".$row['unitID']."</td>
									<td>".$row['title']."</td>
									<td>".$lectureDate."</td>							
									<td>".$row['classroom_name']."</td>
									<td>
									<div>
									<label for='attended' >Yes</label>
									<input type='radio' value=1 id='attended' name='attendance' />
									</div>
									<div>
									<label for='didnt-attend'>No</label>
									<input type='radio' value=0 id='didnt-attend' name='attendance' checked />
									<input type='hidden' value ='".$lectureDate."' name='lectureDate'/>
									<input type='hidden' value =".$row['lectureID']." name='lectureID'/>
									</div>
									</td>
									</tr>
									";
									} 								
							} 						
						}
					} else{
						// if the unitIDs array is empty no lectures can be displayed
						$lectures_today = false;
					}
					
					
					// this if-block displays either a submit button or a message
					if(!$lectures_today){
						echo "<tr><td colspan=5>You have no lectures today</td></tr>";
					} else{ 
						echo"<tr><td colspan=5><button>Submit</button></td></tr>";
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
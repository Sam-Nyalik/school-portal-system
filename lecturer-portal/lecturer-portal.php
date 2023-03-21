<?php
include_once("../pdo.php");

$lecturer_row = array();
$student_count = array();
$attendance_lectureid = "";

if (isset($_GET["id"])) {
	try{
		$sql = "SELECT USERS.*,LECTURERS.* , DEPARTMENT.*
				FROM USERS 
				INNER JOIN LECTURERS ON USERS.USERID = LECTURERS.USERID
				INNER JOIN DEPARTMENT ON LECTURERS.DEPARTMENTID = DEPARTMENT.DEPARTMENTID
				WHERE USERS.USERID = :userID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
			":userID" => $_GET["id"]
		));
		$lecturer_row=$stmt->fetch(PDO::FETCH_ASSOC);
		
	} catch(Exception $e){
		echo "Can't find value, try again<br>" .$e->getMessage();
	}
	
}

if(isset($_POST['attendance']) && isset($_POST['studentCount'])){
					
	$student_count = unserialize($_POST['studentCount']);
	$attendance_lectureid = $_POST['attendance'];
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Lecturer Portal</title>
	<link rel="stylesheet" type="text/css" href="lecturer-portal.css">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<script src="lecturer-portal.js"></script>
</head>
<body>
	<header>
		<h1>Lecturer Portal</h1>
		<nav>
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#My Units">My Units</a></li>
				<li><a href="#Attendance">Attendance</a></li>
				<li><a href="lecturer-profile.html">Profile</a></li>
				<li><a href="#">Logout</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<section>
			<h2><u>Personal Information</u></h2>
			<table>
				<tr>
					<th>First Name:</th>
					<td><?= $lecturer_row["first_name"] ?></td>
				</tr>
				<tr>
					<th>Last Name:</th>
					<td><?= $lecturer_row["last_name"] ?></td>
				</tr>
				<tr>
					<th>Email:</th>
					<td><?= $lecturer_row["email"] ?></td>
				</tr>
				<tr>
					<th>Phone:</th>
					<td><?= "+254".$lecturer_row["phone_number"] ?></td>
				</tr>
				<tr>
					<th>Gender:</th>
					<td><?= ucfirst($lecturer_row["gender"]) ?></td>
				</tr>
				<tr>
					<th>Department:</th>
					<td><?= $lecturer_row["department_name"] ?></td>
				</tr>
			</table>
		</section>
		<section id="My Units">
			<h2><u>My Units</u></h2>
			<table>
				<thead>
					<tr>
						<th>Unit Code</th>
						<th>Unit Title</th>
						<th>Year</th>
						<th>Registered Students</th>
					</tr>
				</thead>
				<tbody>				
					<?php 
					$sql = "SELECT UNITS.* , count(UNIT_REGISTRATION.UNITID) AS registration_count 
							FROM UNITS 
							LEFT JOIN UNIT_REGISTRATION  ON UNIT_REGISTRATION.unitID = UNITS.unitID  
							WHERE LECTURERID = :lecturerID
							GROUP BY UNITS.UNITID";

					$stmt= $pdo->prepare($sql);
					$stmt->execute(array(
						":lecturerID" => $lecturer_row['lecturerID']
					));
					$units_row = $stmt->fetch(PDO::FETCH_ASSOC);
					
					if($units_row){
						
						do{
							echo(
								"<tr>
									<td>".$units_row['unitID']."</td>
									<td>".$units_row['title']."</td>
									<td>".$units_row['year']."</td>
									<td>".$units_row['registration_count']."</td>
								</tr>"
							);
							$student_count[$units_row['unitID']] = $units_row['registration_count'];
						}while($units_row = $stmt->fetch(PDO::FETCH_ASSOC));
					}else{
						echo "<tr><td colspan=4>You have no units to teach currently</td></tr>";
					}
					
					?>
				</tbody>
			</table>
		</section>
		<section  id="Attendance">
			<h2><u>Attendance</u></h2>
			<p>Select a lecture to view attendance:</p>
			<form action="#Attendance" method="post">
			<select id="lectureSelect" name="attendance">
				<?php 
				$sql = "SELECT UNITS.*, LECTURE.*
						FROM LECTURE
						INNER JOIN UNITS ON UNITS.UNITID = LECTURE.UNITID
						WHERE UNITS.LECTURERID = :lecturerID
						";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array(
					":lecturerID" => $lecturer_row['lecturerID']
				));
				
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					echo("<option value='".$row['lectureID']."'>".$row['title']."</option>");
				}	
				
				
				?>
			</select>
			<?php 
				$student_count_serialized = serialize($student_count);
				echo("<input type='hidden' value='".$student_count_serialized."' name='studentCount' />")
			?>
			<button id="viewAttendanceButton">View Attendance</button>
			</form>
			
			<div id="attendanceTable">
				
				<?php 
				if(isset($_POST['attendance']) && isset($_POST['studentCount'])){
					$sql = "SELECT UNITS.* , LECTURE.* 
							FROM LECTURE 
							INNER JOIN UNITS ON UNITS.UNITID = LECTURE.UNITID
							WHERE LECTURE.LECTUREID = :lectureID";
					$stmt = $pdo->prepare($sql);
					$stmt->execute(array(
						":lectureID" => $attendance_lectureid
					));

					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					$unit_student_count = $student_count[$row['unitID']];
					
					if($unit_student_count === "0"){
						echo "<h3>".$row['title']."</h3>
							  <div>No students are registered in this unit</div>";
					} else{
						$sql = "SELECT STUDENTS.* ,  USERS.* , ATTENDED_LECTURE.*
								FROM ATTENDED_LECTURE
								INNER JOIN STUDENTS ON STUDENTS.STUDENTID = ATTENDED_LECTURE.STUDENTID 
								INNER JOIN USERS ON STUDENTS.USERID = USERS.USERID 
								WHERE ATTENDED = 1 AND LECTUREID = :LECTUREID";
						
						$stmt = $pdo->prepare($sql);
						$stmt->execute(array(
							":LECTUREID" => $attendance_lectureid
						));

						$present_students = array();
						$absent_students = array();

						while($attendance_row = $stmt->fetch(PDO::FETCH_ASSOC)){
							// the lecture date must be within the last week, for the attendance to be valid 
							$first_day = date("Y-m-d" , strtotime("sunday last week"));
							$last_day = date("Y-m-d", strtotime("sunday this week"));  
							$lecture_date = date("Y-m-d",strtotime($attendance_row['lectureDate']));						

							if($lecture_date > $first_day && $lecture_date < $last_day) {
								array_push($present_students, $attendance_row['first_name']." ".$attendance_row['last_name']);
							 } 
							
						}

						$sql = "SELECT UNIT_REGISTRATION.* , LECTURE.*, STUDENTS.*, USERS.*
								FROM UNIT_REGISTRATION
								INNER JOIN LECTURE ON LECTURE.UNITID = UNIT_REGISTRATION.UNITID
								INNER JOIN STUDENTS ON UNIT_REGISTRATION.STUDENTID = STUDENTS.STUDENTID
								INNER JOIN USERS ON STUDENTS.USERID = USERS.USERID								
								WHERE LECTURE.LECTUREID = :LECTUREID";
						
						$stmt = $pdo->prepare($sql);
						$stmt->execute(array(
							":LECTUREID" => $attendance_lectureid
						));

						while($registered_students = $stmt->fetch(PDO::FETCH_ASSOC)){
							$student_name = $registered_students['first_name']." ".$registered_students['last_name'];
							if(!in_array($student_name, $present_students)){
								array_push($absent_students , $student_name );
							}
						}

						echo "<div class='attendance-section'>";
						echo "<h3>".$row['title']."</h3>";
						echo "<div class='attendance-container'>";
						echo 
						"<div >
						<h4>Students who attended</h4>";
						foreach($present_students as $student){
							echo "<div>".$student."</div>";
						}
						echo"</div>						 
						<div>
						<h4>Students who didn't attend</h4>";
						foreach($absent_students as $student){
							echo "<div>".$student."</div>";
						}
						echo "</div>";
						echo "</div>";
						echo "</div>";
					}				
				
				}
				
				
				?>
			</div>
		</section>
	</form>
</section>
</main>
<footer>
<p>&copy; Lecturer Portal 2023</p>
</footer>

</body>
</html>
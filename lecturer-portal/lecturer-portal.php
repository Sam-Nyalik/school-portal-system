<?php
include_once("../pdo.php");

$row = array();

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
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		
	} catch(Exception $e){
		echo "Can't find value, try again<br>" .$e->getMessage();
	}
	
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
				<li><a href="#">My Units</a></li>
				<li><a href="#">Attendance</a></li>
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
					<td><?= $row["first_name"] ?></td>
				</tr>
				<tr>
					<th>Last Name:</th>
					<td><?= $row["last_name"] ?></td>
				</tr>
				<tr>
					<th>Email:</th>
					<td><?= $row["email"] ?></td>
				</tr>
				<tr>
					<th>Phone:</th>
					<td><?= "+254".$row["phone_number"] ?></td>
				</tr>
				<tr>
					<th>Gender:</th>
					<td><?= ucfirst($row["gender"]) ?></td>
				</tr>
				<tr>
					<th>Department:</th>
					<td><?= $row["department_name"] ?></td>
				</tr>
			</table>
		</section>
		<section>
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
						":lecturerID" => $row['lecturerID']
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
						}while($units_row = $stmt->fetch(PDO::FETCH_ASSOC));
					}else{
						echo "<tr><td colspan=4>You have no units to teach currently</td></tr>";
					}
					
					?>
				</tbody>
			</table>
		</section>
		<section>
			<h2><u>Attendance</u></h2>
			<p>Select a lecture to view attendance:</p>
			<select id="lectureSelect">
				<option value="1">CSCI101 - Introduction to Computer Science (1)</option>
				<option value="2">CSCI202 - Data Structures and Algorithms (2)</option>
				<option value="3">CSCI303 - Advanced Topics in Computer Science (3)</option>
			</select>
			<button id="viewAttendanceButton">View Attendance</button>
			<div id="attendanceTable"></div>
		</section>
	</form>
</section>
</main>
<footer>
<p>&copy; Lecturer Portal 2023</p>
</footer>

</body>
</html>
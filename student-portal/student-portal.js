const studentID = // get student ID from login form

// get student data from backend
fetch(`/students/${studentID}`)
	.then(response => response.json())
	.then(student => {
		// display personal information
		document.getElementById('name').textContent = `${student.first_name} ${student.last_name}`;
		document.getElementById('enrollment-date').textContent = `${student.enrollment}`;
		document.getElementById('date-of-birth').textContent = `${student.dob}`;
		document.getElementById('year-of-study').textContent = `${student.year_of_study}`;
		document.getElementById('user-id').textContent = `${student.user_id}`;
		document.getElementById('course-id').textContent = `${student.course_id}`;})
	
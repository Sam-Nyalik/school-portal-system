// Retrieve lecturer information from the database
const lecturerID = 1; // Replace with the ID of the logged in lecturer
const lecturerInfo = {
  name: "John Doe", // Replace with actual name from database
  department: "Computer Science", // Replace with actual department from database
  email: "johndoe@example.com", // Replace with actual email from database
  phone: "123-456-7890" // Replace with actual phone number from database
};
const unitsTaught = [
  {
    unitID: "COMP101",
    title: "Introduction to Computer Science"
  },
  {
    unitID: "COMP202",
    title: "Data Structures and Algorithms"
  }
]; // Replace with actual units taught from database

// Display lecturer information on the page
document.getElementById("lecturer-name").textContent = lecturerInfo.name;
document.getElementById("department").textContent = lecturerInfo.department;
document.getElementById("email").textContent = lecturerInfo.email;
document.getElementById("phone").textContent = lecturerInfo.phone;

// Display units taught on the page
const unitList = document.getElementById("unit-list");
unitsTaught.forEach((unit) => {
  const listItem = document.createElement("li");
  listItem.textContent = `${unit.unitID} - ${unit.title}`;
  unitList.appendChild(listItem);
});

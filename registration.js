const form = document.querySelector("form");
const firstName = document.getElementById("firstName");
const lastName = document.getElementById("lastName");
const email = document.getElementById("email");
const phoneNumber = document.getElementById("phoneNumber");
const password = document.getElementById("password");
const gender = document.getElementById("gender");
const role = document.getElementById("role");
const department = document.querySelector(".department");
const course = document.querySelector(".course");
const dob = document.querySelector(".dob");
const year = document.querySelector(".year");
const studentsInputs = [course, dob, year];

role.addEventListener("change", (e) => {
  if (role.value === "lecturer") {
    department.classList.remove("hide");
    studentsInputs.forEach((item) => {
      item.classList.add("hide");
    });
  } else if (role.value === "student") {
    studentsInputs.forEach((item) => {
      item.classList.remove("hide");
    });
    department.classList.add("hide");
  } else {
    department.classList.add("hide");
    studentsInputs.forEach((item) => {
      item.classList.add("hide");
    });
  }
});

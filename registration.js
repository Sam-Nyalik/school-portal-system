const form = document.querySelector("form");
const firstName = document.getElementById("firstName");
const lastName = document.getElementById("lastName");
const email = document.getElementById("email");
const phoneNumber = document.getElementById("phoneNumber");
const password = document.getElementById("password");
const gender = document.getElementById("gender");
const role = document.getElementById("role");
const lecturerInput = document.querySelector(".lecturerInput");
const studentsInputs = document.querySelectorAll(".studentsInputs")

role.addEventListener("change", (e) => {
  console.log("role changed")
  if (role.value === "lecturer") {
    lecturerInput.classList.remove("hide");
    studentsInputs.forEach((item) => {
      item.classList.add("hide");
    });
  } else if (role.value === "student") {
    studentsInputs.forEach((item) => {
      item.classList.remove("hide");
    });
    lecturerInput.classList.add("hide");
  } else {
    lecturerInput.classList.add("hide");
    studentsInputs.forEach((item) => {
      item.classList.add("hide");
    });
  }
});

console.log("loaded")
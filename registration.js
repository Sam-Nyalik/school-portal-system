const firstName = document.getElementById("firstName");
const lastName = document.getElementById("lastName");
const emailAddress = document.getElementById("emailAddress");
const phoneNumber = document.getElementById("phoneNumber");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirmPassword");
const gender = document.getElementById("gender");
const dob = document.getElementById("dob");
const yearOfStudy = document.getElementById("yearOfStudy");
const department = document.getElementById("department");
const course = document.getElementById("course");
const role = document.getElementById("role");
const lecturerInput = document.querySelector(".lecturerInput");
const studentsInputs = document.querySelectorAll(".studentsInputs");
const registrationForm = document.getElementById("registration-form");

// Error message nodes
const firstNameError = document.getElementById("firstNameError");
const lastNameError = document.getElementById("lastNameError");
const emailAddressError = document.getElementById("emailAddressError");
const phoneNumberError = document.getElementById("phoneNumberError");
const passwordError = document.getElementById("passwordError");
const confirmPasswordError = document.getElementById("confirmPasswordError");
const genderError = document.getElementById("genderError");
const departmentError = document.getElementById("departmentError");
const dobError = document.getElementById("dobError");
const yearOfStudyError = document.getElementById("yearOfStudyError");
const courseError = document.getElementById("courseError");
const inputs = [
  firstName,
  lastName,
  phoneNumber,
  emailAddress,
  password,
  confirmPassword,
];

// take a guess what this function does
const displayError = (node) => {
  const nodeName = node.name;

  // all error message nodes are in the format nodeNameError, e.g firstNameError. We can dynamically create
  // these node variables to enhance flexibility
  const errorNode = eval(nodeName + "Error");

  // the function checks if there's either a value missing or there's a type mismatch
  if (node.validity.valueMissing) {
    errorNode.textContent = `Field is required!`;

    // only the email address is susceptible to typemismatch so the error message is hardcoded
  } else if (node.validity.typeMismatch) {
    errorNode.textContent = `Please enter a valid email address`;
  }

  errorNode.className = "error active text-danger";
};

// an event listener is added to the role drop down menu
role.addEventListener("change", (e) => {
  // if lecturer is selected, the students' form inputs are hidden, while the lecturers' is shown
  if (role.value === "3") {
    lecturerInput.classList.remove("hide");
    studentsInputs.forEach((item) => {
      item.classList.add("hide");
    });

    // if student is selected, the lecturers' form inputs are hidden, while the students' are shown
  } else if (role.value === "2") {
    studentsInputs.forEach((item) => {
      item.classList.remove("hide");
    });
    lecturerInput.classList.add("hide");

    // when role is changed, a validity check is made on the nodes in the following array, if any one fails displayError is called on that node
    [dob, yearOfStudy, course, department].forEach((node) => {
      const nodeName = node.name;
      const errorNode = eval(nodeName + "Error");

      if (node.validity.valid) {
        errorNode.textContent = "";
      } else {
        displayError(node);
      }
    });

    // if admin is selected, all the other inputs are hidden
  } else {
    lecturerInput.classList.add("hide");
    studentsInputs.forEach((item) => {
      item.classList.add("hide");
    });
  }
});

// EVENT LISTENERS

// all ELs are added via a loop
// an array with all inputs is built and used
[...inputs, dob, yearOfStudy, department, course].forEach((node) => {
  const nodeName = node.name;

  // all error message nodes are in the format nodeNameError so we can dynamically create variables
  // corresponding to their names
  const errorNode = eval(nodeName + "Error");

  // forEach node in the inputs array, when input occurs, its validity is checked and if invalid, displayError is called
  node.addEventListener("input", () => {
    if (node.validity.valid) {
      errorNode.textContent = "";
      errorNode.className = "error";
    } else {
      displayError(node);
    }
  });
});

// anytime confirmPassword changes, its value is compared to the password value, if they don't match an error message is displayed
confirmPassword.addEventListener("input", () => {
  if (confirmPassword.value !== password.value) {
    confirmPasswordError.textContent = "Passwords do not match";
    confirmPasswordError.className = "error active text-danger";
  } else {
    confirmPasswordError.textContent = "";
    confirmPasswordError.className = "error";
  }
});

// before the registrationForm is submitted to the DB validation checks are made once again
registrationForm.addEventListener("submit", (event) => {
  if (
    !firstName.validity.valid ||
    !lastName.validity.valid ||
    !phoneNumber.validity.valid ||
    !emailAddress.validity.valid ||
    !password.validity.valid ||
    !confirmPassword.validity.valid ||
    !dob.validity.valid ||
    !yearOfStudy.validity.valid ||
    department.value === "" ||
    course.value === ""
  ) {
    // all roles share nodes in the inputs array, so they are checked first
    inputs.forEach((node) => {
      if (!node.validity.valid) {
        // if one of the nodes has an error submission is blocked and an error message is displayed
        displayError(node);
        event.preventDefault();
      }
    });

    if (role.value === "2") {
      [dob, yearOfStudy, course].forEach((node) => {
        if (!node.validity.valid) {
          // if one of the nodes has an error submission is blocked and an error message is displayed
          displayError(node);
          event.preventDefault();
        }
      });
    } else if (role.value === "3") {
      if (department.value === "") {
        displayError(department);
        event.preventDefault();
      }
    }
  }

  // if both passwords are valid, a check is made for whether they match
  if (password.validity.valid && confirmPassword.validity.valid) {
    if (password.value !== confirmPassword.value) {
      confirmPasswordError.textContent = "Passwords do not match";
      confirmPasswordError.className = "error active text-danger";

      // if passwords don't match, submission is blocked
      event.preventDefault();
    } else {
      confirmPasswordError.textContent = "";
      confirmPasswordError.className = "error";
    }
  }
});

const firstName = document.getElementById("firstName");
const lastName = document.getElementById("lastName");
const emailAddress = document.getElementById("emailAddress");
const phoneNumber = document.getElementById("phoneNumber");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirmPassword");
const gender = document.getElementById("gender");
const dob = document.getElementById("dob");
const yearOfStudy = document.getElementById("yearOfStudy");
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
  dob,
  yearOfStudy,
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

    // only the email address is succeptible to typemismatch so the error message is hardcoded
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

    // when role is changed, a validity check is made on the dateOfBirth and yearOfStudy, if it fails displayError is called
    if (dob.validity.valid) {
      dobError.textContent = "";
    } else {
      displayError(dob);
    }

    if (yearOfStudy.validity.valid) {
      yearOfStudyError.textContent = "";
    } else {
      displayError(yearOfStudy);
    }

    // if admin is selected, all the other inputs are hidden
  } else {
    lecturerInput.classList.add("hide");
    studentsInputs.forEach((item) => {
      item.classList.add("hide");
    });
  }
});

// EVENT LISTENERS

// textInputs are similar so their event listeners are added in a loop
inputs.forEach((node) => {
  const nodeName = node.name;

  // all error message nodes are in the format nodeNameError so we can dynamically create variables
  // corresponding to their names
  const errorNode = eval(nodeName + "Error");

  // forEach node in the textInputs array, its validity is checked, if invalid, displayError is called
  node.addEventListener("input", () => {
    if (node.validity.valid) {
      errorNode.textContent = "";
      errorNode.className = "error";
    } else {
      displayError(node);
    }
  });
});

/* anytime confirmPassword changes, its value is compared to the password value,
if they don't match an error message is displayed */
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
    !yearOfStudy.validity.valid
  ) {
    if (role.value === "1") {
      textInputs.forEach((node) => {
        if (!node.validity.valid) {
          displayError(node);

          // if one of the nodes has an error submission is blocked
          event.preventDefault();
        }
      });
    } else if (role.value === "2") {
      [...inputs, dob, yearOfStudy].forEach((node) => {
        if (!node.validity.valid) {
          displayError(node);

          // if one of the nodes has an error submission is blocked
          event.preventDefault();
        }
      });
    }
  }

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

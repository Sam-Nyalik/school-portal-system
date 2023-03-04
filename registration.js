const form = document.querySelector("form");
const firstName = document.getElementById("firstName");
const lastName = document.getElementById("lastName");
const emailAddress = document.getElementById("emailAddress");
const phoneNumber = document.getElementById("phoneNumber");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("password");
const gender = document.getElementById("gender");
const dob = document.getElementById("dob")
const yearOfStudy = document.getElementById("yearOfStudy")
const role = document.getElementById("role");
const lecturerInput = document.querySelector(".lecturerInput");
const studentsInputs = document.querySelectorAll(".studentsInputs")
const registrationForm = document.getElementById("registration-form")

// Error message nodes
const firstNameError = document.getElementById("firstNameError")
const lastNameError = document.getElementById("lastNameError")
const emailAddressError = document.getElementById("emailAddressError")
const phoneNumberError = document.getElementById("phoneNumberError")
const passwordError = document.getElementById("passwordError")
const confirmPasswordError = document.getElementById("confirmPasswordError")
const genderError = document.getElementById("genderError")
const departmentError = document.getElementById("departmentError")
const dobError = document.getElementById("dobError")
const yearOfStudyError = document.getElementById("yearOfStudyError")
const courseError = document.getElementById("courseError")
const textInputs = [firstName, lastName, phoneNumber, emailAddress,password,confirmPassword]

const displayError = (node) => {
  const nodeName = node.name
  const errorNode = eval(nodeName+"Error")

 
  if(node.validity.valueMissing) {
      errorNode.textContent = `Field is required!`
  } else if(node.validity.typeMismatch) {
      errorNode.textContent = `Please enter a valid ${nodeName}`
  }

  errorNode.className = "error active text-danger"
}

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

    if(dob.validity.valid){
      dobError.textContent = "";
    } else {
      displayError(dob)
    }

    if(yearOfStudy.validity.valid){
      yearOfStudyError.textContent = "";
    } else {
      displayError(yearOfStudy)
    }


    // if admin is selected, all the other inputs are hidden
  } else {
    lecturerInput.classList.add("hide");
    studentsInputs.forEach((item) => {
      item.classList.add("hide");
    });
  }
});

textInputs.forEach(node => {
  const nodeName = node.name
  const errorNode = eval(nodeName+"Error")

  node.addEventListener("input" , ()=> {
    if(node.validity.valid) {
      errorNode.textContent = ""
      errorNode.className = "error"
    } else {
        displayError(node)
        
    }
  })
})

dob.addEventListener("input", () => {
  if(dob.validity.valid){
    dobError.textContent = "";
  } else {
    displayError(dob)
  }
})

yearOfStudy.addEventListener("input", () => {
  if(yearOfStudy.validity.valid){
    yearOfStudyError.textContent = "";
  } else {
    displayError(yearOfStudy)
  }
})

form.addEventListener("submit", (event) => {
  const {firstName, lastName, phoneNumber, emailAddress,password, confirmPassword, dob,yearOfStudy } = validity.valid

  if(!firstName && !lastName && !phoneNumber && !emailAddress && !password && !confirmPassword){
    if (role.value === "1"){
      [firstName, lastName, phoneNumber, emailAddress, password, confirmPassword].forEach(nodeValid => {
        if(!nodeValid) {
          displayError(eval(nodeValid))
        }
      })
    }
    else if (role.value === "2"){
      [firstName, lastName, phoneNumber, emailAddress, password, confirmPassword, dob, yearOfStudy].forEach(nodeValid => {
        if(!nodeValid) {
          displayError(eval(nodeValid))
          event.preventDefault()
        }
      })
    }
       
  
  event.preventDefault()
  }

  if (password && confirmPassword){
    if (eval(password).textContent !== eval(confirmPassword).textContent){
      console.log(eval(password))
      confirmPasswordError.textContent = "Passwords do not match"
    
    event.preventDefault()
    }
  }

  
})
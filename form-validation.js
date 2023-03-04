//const firstName = document.getElementById("firstName")
const firstNameError = document.getElementById("firstNameError")
//const lastName = document.getElementById("lastName")
const lastNameError = document.getElementById("lastNameError")
//const email = document.getElementById("email")
const emailError = document.getElementById("emailError")
//const phoneNumber = document.getElementById("phoneNumber")
const phoneNumberError = document.getElementById("phoneNumberError")
//const password = document.getElementById("password")
const passwordError = document.getElementById("passwordError")
//const currentPassword = document.getElementById("confirmPassword")
const currentPasswordError = document.getElementById("confirmPasswordError")
//const gender = document.getElementById("gender")
const genderError = document.getElementById("genderError")
//const role = document.getElementById("role")
const department = document.getElementById("department")
//const departmentError = document.getElementById("departmentError")
const dateOfBirth = document.getElementById("dob")
//const dateOfBirthError = document.getElementById("dobError")
const yearOfStudy = document.getElementById("yearOfStudy")
//const yearOfStudyError = document.getElementById("yearOfStudyError")
const course = document.getElementById("course")
//const courseError = document.getElementById("courseError")
const registrationForm = document.getElementById("registration-form")

const displayError = (node) => {
    const nodeName = node.name
    const errorNode = eval(nodeName+"Error")

    if(node.validity.valueMissing) {
        errorNode.textContent = `Your ${nodeName} cannot be left blank`
    } else if(node.validity.typeMismatch) {
        errorNode.textContent = `Please enter your email address`
    }

    //errorNode.className = "error active"
}

email.addEventListener("input" , ()=> {
    if(email.validity.valid) {
        emailError.textContent = ""
        //emailError.className = "error"
    } else {
        displayError(email)
    }
})
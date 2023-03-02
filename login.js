const email = document.getElementById("login-email")
const password = document.getElementById("login-password")
const emailError = document.querySelector(".login-email-error")
const passwordError = document.querySelector(".login-password-error")
const form = document.querySelector(".login-form")

const displayError = (node) => {
    const nodeName = Object.keys({node})[0]
    const errorNode = eval(nodeName+"Error")

    if(node.validity.valueMissing) {
        errorNode.textContent = `Your ${nodeName} cannot be left blank`
    } else if(node.validity.typeMismatch) {
        errorNode.textContent = `Please enter your email address`
    }

    errorNode.className = "error active"
}

email.addEventListener("input" , ()=> {
    if(email.validity.valid) {
        emailError.textContent("")
        emailError.className = "error"
    } else {
        displayError(email)
    }
})

password.addEventListener("input" , ()=> {
    if(password.validity.valid){
        passwordError.textContent("")
        passwordError.className = "error"
    } else {
        displayError(password)
    }
})

form.addEventListener("submit", (event) => {
    if(!password.validity.valid && !email.validity.valid){
        if(!password.validity.valid) {
            displayError(password)
        }
        if(!email.validity.valid) {
            displayError(email)
        }

        event.preventDefault()

    }
})
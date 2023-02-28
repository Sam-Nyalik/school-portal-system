// Define an array to store the user data
let userData = [];

// Get the form element and add an event listener to handle form submission
const form = document.querySelector('form');
form.addEventListener('submit', handleSubmit);

function handleSubmit(event) {
  // Prevent the form from submitting
  event.preventDefault();

  // Get the form values
  const firstName = document.getElementById('firstName').value;
  const lastName = document.getElementById('lastName').value;
  const email = document.getElementById('email').value;
  const phoneNumber = document.getElementById('phoneNumber').value;
  const password = document.getElementById('password').value;
  const gender = document.getElementById('gender').value;
  const isAdmin = document.getElementById('isAdmin').checked
}
<?php

// Importing data  =from the functions page
require_once "../functions/functions.php";

// Database connection
$pdo = db_connect();

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])){
  try{
    $sql = "INSERT INTO CUSTOMER_CONTACTS (name, email,message) VALUES (:name , :email, :message)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ":name" => $_POST['name'],
      ":email" => $_POST['email'],
      ":message" => $_POST['message']
    ));

  } catch(Exception $e){
    echo "Error: " . $e->getMessage();
  }


}


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <link rel="stylesheet" href="about-contact-us.css" />
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="../home.php">Home</a></li>
          <li><a href="about-us.html">About Us</a></li>
        </ul>
      </nav>
    </header>
<div class="contact-form">
    <h2>Contact Us</h2>
    <p>Fill out the form below to get in touch with us.</p>
    <form action="#" method="post">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="message">Message</label>
        <textarea id="message" name="message" rows="5" required></textarea>
      </div>
      <button type="submit" class="btn">Send Message</button>
    </form>
  </div>
  <footer>
    <p>&copy; 2023 Helix Solution Limited. All rights reserved.</p>
</footer>
</body>
</html>
  
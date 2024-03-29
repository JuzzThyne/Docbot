<?php 

require('includes/indexnav.php');
require('includes/database.php');
         
?>
 
<html>
<link rel="stylesheet" type="text/css" href="css/index.css">
<head>
    <title>DocBot</title>
</head>
    <style>
    .form_new {
      width: 400px;
      margin: auto;
      margin-top: 100px;
      border: 1px solid #ccc;
      padding: 20px;
      text-align: center;
      background-color: #fff;
      border-radius: 10px;
    }
    label {
      display: block;
      margin-bottom: 10px;
      text-align: left;
    }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      box-sizing: border-box;
    }
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      cursor: pointer;
    }
    .par{
        float: left;
        
    }
    .ref {
        color: aqua;
    }
    .ref:hover{
        size: unset !important;
        background-color: unset !important;
        color: unset !important;
        font-size: unset !important;
    }
    
  </style>
    <body style=" background: #0a678b;">
    <form method="POST" class="form_new">
    <h1>Register</h1>
    <div id="message"></div>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
    <p class="par">Already Registered? <a href="login.php" class="ref">signin here</a></p>
    <input type="submit" value="Register">
    </form>
    <?php
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $confirm_password = $_POST['confirm_password'];

      // Validate form data
      if ($password !== $confirm_password) {
        echo "<p>Passwords do not match</p>";
      } else {
        // Check if the username is already taken
        $conn = new mysqli('localhost', 'root', '', 'docbot');
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT username FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
          echo "<script>document.getElementById('message').innerHTML = '<span style=\"color:red;\">Username is already taken</span>';</script>";
          // echo "<script>document.getElementById('message').innerHTML = 'Username is already taken';</script>";
        } else {
          // Hash the password and store the user's information in the database
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);

          // Insert the user's information into the database
          $sql = "INSERT INTO users (username, password, status_text) VALUES (?, ?,'Inactive')";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("ss", $username, $hashed_password);
          $stmt->execute();

          // Replace the echo statement with this code
          echo "<script>document.getElementById('message').innerHTML = '<span style=\"color:green;\">User created successfully!</span>';</script>";
          // echo "<script>document.getElementById('message').innerHTML = 'User created successfully!';</script>";
        }
      }
    }

    ?>
</body>

</html>
<?php 

require('includes/indexnav.php');
require('includes/database.php');


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Check if the user is already logged in
if (isset($_SESSION['username'])) {
  // Redirect to the dashboard page
  header("Location: index.php");
}


         
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
        <h1>Login</h1>
        <div id="message"></div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <p class="par">No Account? <a href="register.php" class="ref">register here</a></p>
        <input type="submit" value="Login">
    </form>
    <?php

        // Check if the login form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the username and password inputs
        $username = $_POST["username"];
        $password = $_POST["password"];
    
        // Call the login function to authenticate the user
        if (login($username, $password)) {
        // Set the session variable
        $_SESSION['username'] = $username;
    
        // Redirect to the dashboard page
        header("Location: index.php");
        // echo "<p style='color: red;'>Logged in</p>";
        } else {
        // Display an error message if the login failed
        echo "<script>document.getElementById('message').innerHTML = '<span style=\"color:red;\">Invalid username or password</span>';</script>";
    
        // echo "<p style='color: red;'>Invalid username or password</p>";
        }
    }
    function login($username, $password) {
        // Replace these with your database credentials
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'docbot';
    
        // Create a database connection
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    
        // Check if the connection was successful
        if (!$conn) {
            die('Database connection failed: ' . mysqli_connect_error());
        }
    
        // Sanitize the username input to prevent SQL injection attacks
        $username = mysqli_real_escape_string($conn, $username);
    
        // Build the SQL query to select the user with the given username
        $sql = "SELECT * FROM users WHERE username = '$username' and status = '1'";
    
        // Execute the query
        $result = mysqli_query($conn, $sql);
    
        // Check if the query was successful
        if (!$result) {
            die('Query failed: ' . mysqli_error($conn));
        }
    
        // Check if there is exactly one row in the result set
        if (mysqli_num_rows($result) == 1) {
            // Get the row as an associative array
            $row = mysqli_fetch_assoc($result);
    
            // Check if the password matches the hashed password in the database
            if (password_verify($password, $row['password'])) {
                // The user is authenticated, return true
                return true;
            } else {
                // If the password doesn't match, check if it matches the unhashed password in the database
                if ($password === $row['password']) {
                    // Hash the password and update the user's record in the database
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $id = $row['id'];
                    $update_sql = "UPDATE users SET password = '$hashed_password' WHERE id = $id";
                    mysqli_query($conn, $update_sql);
                    
                    // The user is authenticated, return true
                    return true;
                }
            }
        }
    
        // The user is not authenticated, return false
        return false;
    
        // Close the database connection
        mysqli_close($conn);
    }
    

    ?>
</body>

</html>
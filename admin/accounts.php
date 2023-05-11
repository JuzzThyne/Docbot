<?php

include('includes/navbar.php');
include('../includes/database.php');

?>


<!DOCTYPE html>
<html>
<head>
  <title>Accept/Reject Accounts</title>
  <style>
  /* Style the container */
  .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #F6F6F6;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
  }

  /* Style the table */
  table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
    margin-bottom: 20px;
    border: 1px solid #E5E5E5;
  }

  /* Style the table header */
  th {
    background-color: #F5F5F5;
    font-weight: bold;
    text-align: left;
    padding: 16px;
    border-bottom: 1px solid #E5E5E5;
  }

  /* Style the table cells */
  td {
    text-align: left;
    padding: 16px;
    border-bottom: 1px solid #E5E5E5;
  }

  /* Style the radio buttons */
  input[type="radio"] {
    margin-right: 10px;
  }

  /* Style the submit button */
  /* Style the submit button */
input[type="submit"] {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 8px 16px;
  text-decoration: none;
  margin-top: 20px;
  cursor: pointer;
  border-radius: 4px;
}

/* Style the submit button on hover */
input[type="submit"]:hover {
  background-color: #388E3C;
}

/* Style the submit button when disabled */
input[type="submit"]:disabled {
  opacity: 0.5;
  cursor: default;
  background-color: #9E9E9E;
}
.accept-btn {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 8px 16px;
  text-decoration: none;
  margin-right: 10px;
  cursor: pointer;
  border-radius: 4px;
}

.accept-btn:hover {
  background-color: #388E3C;
}

.reject-btn {
  background-color: #F44336;
  border: none;
  color: white;
  padding: 8px 16px;
  text-decoration: none;
  margin-right: 10px;
  cursor: pointer;
  border-radius: 4px;
}

.reject-btn:hover {
  background-color: #D32F2F;
}
.container {
  width: 50%; /* set the width of the container */
  margin: 0 auto; /* center the container horizontally */
  text-align: center; /* center the contents inside the container */
}
</style> 

</head>
<body style=" background: #0a678b;">

<div class="container" style="margin-top: 60px;">
<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "docbot";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve list of pending accounts
$sql = "SELECT id, username, status_text FROM users WHERE status='0'";
// $sql = "SELECT id, username, status_text FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<form method='post'>";
  echo "<table>";
  echo "<tr><th>ID</th><th>Username</th><th>Status</th><th>Action</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
	echo "<td>" . $row["id"] . "</td>";
	echo "<td>" . $row["username"] . "</td>";
	if ($row["status_text"] == "Inactive") {
		echo "<td style='color: red;'>" . $row["status_text"] . "</td>";
	} else {
		echo "<td style='color: green;'>" . $row["status_text"] . "</td>";
	}
	echo "<td>";
	echo "<button class='accept-btn' type='submit' name='action_" . $row["id"] . "' value='1'>Accept</button>";
	echo "<button class='reject-btn' type='submit' name='action_" . $row["id"] . "' value='0'>Reject</button>";
	echo "</td>";
	echo "</tr>";
  }
  echo "</table>";
  echo "</form>";
} else {
  echo "No pending accounts.";
}

$conn->close();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Connect to database
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Update account status for selected actions
  foreach ($_POST as $key => $value) {
    if (substr($key, 0, 7) == "action_") {
      $id = substr($key, 7);
      $status = $value;
      $sql = "UPDATE users SET status='$status' WHERE id='$id'";
      if ($conn->query($sql) === TRUE) {
        if ($conn->affected_rows > 0) {
          // query was successful and at least one row was updated
          // add your condition here
        //   echo "Updated record for ID $id with status $status<br>";
		  $sql = "UPDATE users SET status_text='Active' WHERE id='$id'";
		  $conn->query($sql);
		  header('accounts.php');
        } else {
          // query was successful but no rows were updated
          echo "No record found <br>";
        }
      } else {
        // query failed
        echo "Error updating record: " . $conn->error;
      }
    }
  }

  $conn->close();
}
?>
</div>
</body>


</html>
<?php 

session_start();
error_reporting(0); 
include('../includes/database.php');

 ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <a class="navbar-brand" href="dashboard.php">
          <img src="../image/docbot_logo.png" alt="Logo" width="200" height="50" class="d-inline-block align-text-center">
         
  </a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    
           <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="dashboard.php">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="responselist.php">Responses List</a>
            </li>

            <li class="nav-item active">
              <a class="nav-link" href="unansweredlist.php">Unanswered List</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="Settings.php">Settings</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="accounts.php">Accounts</a>
            </li>
          </ul>
          <?php 

          $userid = $_SESSION['UID'];

          $query = $conn->query("SELECT * from login where id='$userid'");
          $ret=mysqli_fetch_array($query);

          $name = $ret['Name'];

           ?>
    <ul class="navbar-nav mr-auto">

    <div class="form-inline my-2 my-lg-0">
      <div class="dropdown">
        <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo $name; ?>
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="Logout.php">Logout</a></li>
        </ul>

    </ul>



      </div>
    </div>
  </div>
</nav>
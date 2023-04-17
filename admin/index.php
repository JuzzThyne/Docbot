<?php 
session_start();
error_reporting(0);
require('../includes/database.php');

if (isset($_POST['login'])) {

	$username = $_POST['Username'];
	$password = $_POST['Password'];

	$query = $conn->query("SELECT id from login where Username='$username' and Password = '$password' ");
    $ret=mysqli_fetch_array($query);

    if($ret>0){
      $_SESSION['UID']=$ret['id'];
     	header('location:dashboard.php');
    }
    else{
   	 $msg="Invalid Details.";
    }



}

 ?>


<html>
<link rel="stylesheet" type="text/css" href="css/index.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
 <head>
 	<title>Admin login</title>
 </head>
 <body style=" background: #0a678b;"> 




<div class="container-fluid">
	<div class="row">
		<nav class="navbar navbar-dark bg-dark">
		  <div class="container-fluid">
		    <a class="navbar-brand" href="index.php">
		      <img src="../image/docbot_logo.png" lt="Logo" width="200" height="50" class="d-inline-block align-text-center">
		      
		    </a>
		  </div>
		</nav>


<div class="col-sm-4"></div>


<div class="col-sm-4" style="place-items:center; margin-top:5%;">
				<div class="card">
					<article class="card-body">
						<h4 class="card-title text-center mb-4 mt-1">Sign in</h4>
						<hr>
						<p class="text-danger text-center"><?php echo $msg; ?></p>
						<form method="post">

							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"> <i class="fa fa-user"></i> </span>
									</div>
									<input name="Username" class="form-control" placeholder="Username" type="text">
								</div> 
							</div> 


							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
									</div>
									<input name="Password" class="form-control" placeholder="password" type="password">
								</div> 
							</div> 


							<div class="form-group">
								<button type="submit" name="login" class="btn btn-primary btn-block"> Login </button>
							</div> 
							<p class="text-center"><a href="#" class="btn">Forgot password?</a></p>
						</form>
					</article>
				</div> <!-- card.// -->
	</div>

<div class="col-sm-4"></div>

	</div>
</div>



	


 </body>
 </html>
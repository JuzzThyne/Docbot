<?php 
session_start();
error_reporting(0);	
include('includes/navbar.php');
include('../includes/database.php');

if (strlen( $_SESSION['UID']==0)) {
  header('location:logout.php');
  } 

		$unanswercount="SELECT NoAnswer FROM inquiry";
		if ($resultunanswer=mysqli_query($conn,$unanswercount))
		 {
		  // Return the number of rows in result set
		  $rowcount=mysqli_num_rows($resultunanswer);
		 }

		$responselist="SELECT queries FROM chatbot";
		if($resultresponselist=mysqli_query($conn,$responselist))
		 {
		  // Return the number of rows in result set
		  $rowcount1=mysqli_num_rows($resultresponselist);
		 }




 ?>
 <html>
 <link rel="stylesheet" type="text/css" href="css/dashboard.css">
 <head>
 	<title></title>
 </head>
 <body>
<br><br>

<div class="container">
	<center>
		<h1>Welcome To DocBot Your Doctor Bot Consultant</h1>
	<hr>

		<div class="row">
			<div class="col-sm-6">
				<h3>Responses Count</h3>
				<p class="countsize"><?php echo $rowcount1; ?></p>
			</div>

			<div class="col-sm-6">
				<h3>Unanswered Count</h3>
				<p class="countsize"><?php echo $rowcount; ?></p>
			</div>
		</div>

	</center>
	
</div>
 
 </body>
 </html>
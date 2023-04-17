<?php 
session_start();
error_reporting(0);	

include('includes/navbar.php');
include('../includes/database.php');

if (strlen( $_SESSION['UID']==0)) {
  header('location:logout.php');
  } 


	if(isset($_GET['delid']))
	{
		$rowid=intval($_GET['delid']);
		$query=mysqli_query($conn,"DELETE from inquiry where id='$rowid'");
	if($query){
		 $msg= "Record successfully deleted";		
	}
	else {
		 $msg="Something went wrong. Please try again";

	}

	}



 ?>
 <!DOCTYPE html>
 <html>
<link rel="stylesheet" type="text/css" href="css/response.css">

 

 <head>
 	<title></title>
 </head>
 <body >
 <br>

<div class="container">
<div class="row">
	<div class="col-sm-10"><h1 class="text-left">Unanswered List</h1></div>

	
</div>
	<hr>
	<center><?php echo $msg; ?></center>

	<div class="col-sm-12 overflow-auto" style="height:450px;">
		

	
		<table class="table caption-top table-bordered border-primary tabledesign">
		  
		  <thead>
		    <tr>
		      <th class="col-sm-1" style="position:sticky; top:0; background:white;">No.</th>
		      <th class="col-sm-4" style="position:sticky; top:0; background:white;">Queries</th>
		      <th class="col-sm-4" style="position:sticky; top:0; background:white;">Date of Inquiry</th>
		      <th class="col-sm-2" style="position:sticky; top:0; background:white;">Action</th>
		    </tr>
		  </thead>

		<?php
			
			$ret=mysqli_query($conn,"SELECT * FROM inquiry");
			$cnt=1;

			while ($row=mysqli_fetch_array($ret)) {

		?>
		  <tbody>
		    <tr>
		      <th><?php echo $cnt;?></th>
		      <td><?php echo $row['NoAnswer'];?></td>
		      <td><?php echo $row['Date'];?></td>		   
		      <td>
		      	<a class="btn btn-danger" href="unansweredlist.php?delid=<?php echo $row['id'];?>"><i class="fa fa-trash-o"></i></a>
		      	<a class="btn btn-success" href="editunansweredlist.php?delid=<?php echo $row['id'];?>"><i class="fa fa-plus"></i></a>   
		  	  </td>		  	 
		    </tr>
		<?php 
			$cnt=$cnt+1;
			} 
		?>
			
		  </tbody>

		</table>
	</div>
	
</div>

 </body>
 </html>
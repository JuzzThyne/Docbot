<?php 
session_start();
error_reporting(0);
include('includes/navbar.php');
include('../includes/database.php');
if (strlen( $_SESSION['UID']==0)) {
  header('location:logout.php');
  } 
$userid = $_SESSION['UID'];

$sysname=$_POST['SystemName'];
$intromess=$_POST['IntroductionMessage'];
$noresultmess=$_POST['NoResultmessage'];

	

if (isset($_POST['submit'])) {

	
	$updatesetting = mysqli_query($conn, "UPDATE botsettings SET SystemName='$sysname', introMessage='$intromess', noresultmessage='$noresultmess' ");
 		$targetDir = "../image/";
	    $fileName = basename($_FILES["file"]["name"]);
	    $targetFilePath = $targetDir . $fileName;
	    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

		     $allowTypes = array('jpg','png','jpeg','JPG','PNG','JPEG');
	         if(in_array($fileType, $allowTypes)){
	             // Upload file to server
	            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){

	            $updatequery = mysqli_query($conn, "UPDATE botsettings SET botavatar='$fileName' ");

	                if ($updatequery) {
	                    echo '<script type="text/javascript">
							  window.location.href="settings.php";
							</script>';
	                }       

	            }//Move File            
	         }//Allowtpes


	    $targetDir1 = "../image/";
	    $fileName1 = basename($_FILES["file1"]["name"]);
	    $targetFilePath1 = $targetDir1 . $fileName1;
	    $fileType1 = pathinfo($targetFilePath1,PATHINFO_EXTENSION);

		     $allowTypes1 = array('jpg','png','jpeg','JPG','PNG','JPEG');
	         if(in_array($fileType1, $allowTypes1)){
	             // Upload file to server
	            if(move_uploaded_file($_FILES["file1"]["tmp_name"], $targetFilePath1)){

	            $updatequery1 = mysqli_query($conn, "UPDATE botsettings SET useravatar='$fileName1' ");

	                if ($updatequery1) {
	                    echo '<script type="text/javascript">
							  window.location.href="settings.php";
							</script>';
	                }       

	            }//Move File            
	         }//Allowtpes

}

 ?>

 <html>
 <head>
 	<title></title>
 </head>
 <body style="background: #0a678b; ">
 		<br><br>
 		
<form method="post" enctype="multipart/form-data">
 	<div class="container">

 		<div class="row">
			<div class="col-sm-10"><h1 class="text-left" style="color:white;">System Information</h1></div>
			<div class="col-sm-2">
				<input type="submit" name="submit" class="btn btn-Primary form-control" value="Update Settings" style="border:white solid 2px;">
			</div>
			
		</div>
		<hr>

		<?php 

		$display = mysqli_query($conn, "SELECT * FROM botsettings ");
		$row = $display->fetch_assoc();
		$systemname=$row["SystemName"];
		$intro=$row['introMessage'];
		$resultmess=$row['noresultmessage'];
		$imageURL = "../image/".$row["botavatar"];

		 ?>


 		<div class="row">

 			<div class="col-md-12 card">
 				<br>
 				<label><b>System Name</b></label>
 				<input type="text" class="form-control" placeholder="System Name" name="SystemName" value="<?php echo $systemname; ?>">
 				<br>
 				<label><b>Introduction Message</b></label>
 				<input type="text" class="form-control" placeholder="Introduction Message" name="IntroductionMessage" value="<?php echo $intro; ?>">
 				<br>
 				<label><b>No Result Message</b></label>
 				<input type="text" class="form-control" placeholder="No Result Message" name="NoResultmessage" value="<?php echo $resultmess; ?>">
 				<br> 		
				<div class="container row">
	 				<div class="col-sm-6">

	 					<label><b>Bot Avatar</b></label>
		 				<input class="form-control" type="file" name="file" style="font-weight:bolder; height:45px;">
		 				<br>
		 				
						 <picture>
							<source srcset="<?php echo $imageURL; ?>" type="image/svg+xml">
							<img src="" class="img-fluid img-thumbnail" style="width: 200PX; height:200px;">
						</picture>
						
		 				<br>

	 				</div>


<!-- 	 				<div class="col-sm-6">

	 					<label><b>Group chat logs</b></label>
						<br>
						<textarea class="form-control" rows="7"><?php //nclude('../log.html'); ?></textarea><br>
						<button class="btn btn-danger">Delete Logs</button>
		 				

	 				</div> -->


				</div>



 			</div>



 		</div>
 	</div>
</form>



 </body>
 </html>
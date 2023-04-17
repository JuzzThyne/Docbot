<?php 
session_start();
error_reporting(0);
include('includes/navbar.php');
include('../includes/database.php');

if (strlen( $_SESSION['UID']==0)) {
  header('location:logout.php');
  } 

$userid = $_GET['delid'];
$EQuery = $_POST['query'];
$EReply = $_POST['reply'];
$Sick = $_POST['sick'];
    // File upload path
    $targetDir = "../image/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    if(isset($_POST["submit"])){
	        // Allow certain file formats
	         $allowTypes = array('jpg','png','jpeg','JPG','PNG','JPEG');
	         if(in_array($fileType, $allowTypes)){
	             // Upload file to server
	            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
	            $insertquery = mysqli_query($conn, "INSERT into chatbot (MedImage,queries,replies,Diseases) Values ('$fileName','$EQuery', '$EReply','$Sick') ");
	            $query=mysqli_query($conn,"DELETE from inquiry where id='$userid'");      
	                if ($query) {
	                    echo '<script type="text/javascript">
							  window.location.href="unansweredlist.php";
							</script>';
	                }       

	            }//Move File            
	         }//Allowtpes

	    }//isset

 ?>

 <!DOCTYPE html>
 <html>
 <link rel="stylesheet" type="text/css" href="css/editresponse.css">
 <head>
 	<title></title>
 </head>
 <body>
 
 <br>

<form action="" method="post" enctype="multipart/form-data">

<div class="container">

    <div class="row">

        <div class="col-sm-8"><h1 class="text-left">Edit Unanswered List</h1></div>

        <div class="col-sm-2">      
            <button class="btn btn-success form-control" name="submit" >Save Response</button>       
        </div>

        <div class="col-sm-2">      
             <a href="responselist.php" class="btn btn-warning form-control ">Back</a>   
        </div>
    </div>

    <hr>
       <center><?php// echo $statusMsg; ?></center>
<div class="row">

<?php 
	$userid = $_GET['delid'];

	$display = mysqli_query($conn, "SELECT * FROM inquiry WHERE id='$userid' ");	
	$row = $display->fetch_assoc();
	$querys=$row["NoAnswer"];
	$datess=$row["Date"];
?>

	<div class="col-sm-4">
		<center><label>Query</label></center>
		<textarea class="form-control " rows="10" name="query" value=""><?php echo $querys; ?></textarea> 
	</div>

	<div class="col-sm-4">
		<center><label>Reply</label></center>
		<textarea class="form-control" rows="10" name="reply" value="" required="true"></textarea>
	</div>


    <div class="col-sm-4">
    	<center><label>Select Photo</label></center>


<!--         <div class="card" style="height: 250px;">                        
            <img src="../image/default.jpg"  class="card-img-top" style="height:250px;">
        </div> -->

        <div class="mb-4" style="padding-top:20px;">
       		<input class="form-control" type="file" name="file" style="font-weight:bolder; height:45px;" required="true">
   		</div>


	<div class="mb-4">
		<center><label Style="font-size:20px;">Sickness Or Diseases Can Cure</label></center>
		<input type="text" class="form-control" name="sick" placeholder="Sickness / Diseases can Cure">
	</div>
    </div>

</div>

</div>
</form>

 </body>

 </html>

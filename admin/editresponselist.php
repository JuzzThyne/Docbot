<?php 
session_start();
error_reporting(0);
include('includes/navbar.php');
include('../includes/database.php');

if (strlen( $_SESSION['UID']==0)) {
  header('location:logout.php');
  } 

$userid = $_GET['updid'];
$EQuery = $_POST['query'];
$EReply = $_POST['reply'];
    // File upload path
    $targetDir = "../image/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    if(isset($_POST["submit"])){
         $updates = $conn->query("UPDATE chatbot SET replies='$EReply', queries='$EQuery' where id='$userid'");
	        // Allow certain file formats
	         $allowTypes = array('jpg','png','jpeg','JPG','PNG','JPEG');

	         if(in_array($fileType, $allowTypes)){
	             // Upload file to server
	            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
	                 $upd = $conn->query("UPDATE chatbot SET MedImage='$fileName' where id='$userid'");             

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

        <div class="col-sm-8"><h1 class="text-left">Edit Response List</h1></div>

        <div class="col-sm-2">      
            <button class="btn btn-success form-control" name="submit" >Save Response</button>       
        </div>

        <div class="col-sm-2">      
             <a href="responselist.php" class="btn btn-warning form-control ">Back</a>   
        </div>
    </div>

    <hr>
       <center><?php// echo $statusMsg; ?></center>
<div class="row" >

<?php 
	$userid = $_GET['updid'];

	$display = mysqli_query($conn, "SELECT * FROM chatbot WHERE id='$userid' ");	
	$row = $display->fetch_assoc();
	$querys=$row["queries"];
    $replays=$row["replies"];
	$sick=$row["Diseases"];

?>

	<div class="col-sm-6">
		<center><label style="font-size:30px;">Query</label></center>
		<textarea class="form-control " rows="5" name="query" value="" required="true"><?php echo $querys; ?></textarea> 
	</div>

	<div class="col-sm-6">
		<center><label style="font-size:30px;">Reply</label></center>
		<textarea class="form-control" rows="5" name="reply" value="" required="true"><?php echo $replays; ?></textarea>
	</div>

    <div class="col-sm-6">
        <center><label style="font-size:30px;">Sickness or Diseases Can Cure</label></center>
        <textarea class="form-control" rows="10" name="sick" value="" required="true"><?php echo $sick; ?></textarea>
    </div>


    <div class="col-sm-6">
    	<center><label style="font-size:30px;">Select Photo</label></center>


        <div class="card" style="height: 250px;">
            <?php 
                $userid = $_GET['updid'];
                $query1 = $conn->query("SELECT MedImage FROM chatbot WHERE id='$userid'");
                $row1 = $query1->fetch_assoc();

                $imageURL = "../image/".$row1["MedImage"];
            ?>                          
            <img src="<?php echo $imageURL; ?>"  class="card-img-top" style="height:100%;">
        </div>

        <div class="mb-4" style="padding-top:20px;">
       		<input class="form-control" type="file" name="file" style="font-weight:bolder; height:45px;">
   		</div>
    </div>

</div>

</div>
</form>

 </body>

 </html>

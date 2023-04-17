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
		$query=mysqli_query($conn,"DELETE from chatbot where id='$rowid'");
	if($query){
		 $msg= "Record successfully deleted";
		 header('location:responselist.php');		
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
	<div class="col-sm-10"><h1 class="text-left">Response List</h1></div>
	<div class="col-sm-2">
		<button type="button" class="btn btn-success form-control " data-bs-toggle="modal" data-bs-target="#exampleModal">+ Add Querries</button>
	</div>
	
</div>
	<hr>
	<center><?php //echo $msg; ?></center>

	<div class="col-sm-12 overflow-auto" style="height:450px;">

	
		<table class="table caption-top table-bordered border-primary tabledesign fixed" >
		  
		  <thead>
		    <tr>
		      <th class="col-sm-1" style="position:sticky; top:0; background:white;">No.</th>
		      <th class="col-sm-1" style="position:sticky; top:0; background:white;">Queries</th>
		      <th class="col-sm-5" style="position:sticky; top:0; background:white;">Reply</th>
		      <th class="col-sm-3" style="position:sticky; top:0; background:white;">Sick / Diseases Can Cure</th>
		      <th class="col-sm-3" style="position:sticky; top:0; background:white;">Image</th>
		      <th class="col-sm-1" style="position:sticky; top:0; background:white;">Action</th>
		    </tr>
		  </thead>

		<?php
			
			$ret=mysqli_query($conn,"SELECT * FROM chatbot");
			$cnt=1;

			

			while ($row=mysqli_fetch_array($ret)) {
			$imageURL = "../image/".$row["MedImage"];
		?>
		  <tbody>
		    <tr>
		      <th class="text-truncate"><?php echo $cnt;?></th>
		      <td class="text-truncate" style="max-width: 150px;"><center><?php echo $row['queries'];?></center></td>
		      <td class="text-truncate" style="max-width: 150px; height:10px;"><?php echo $row['replies'];?></td>
		      <td class="text-truncate" style="max-width: 150px; height:10px;"><center><?php echo $row['Diseases'];?></center></td>
		      <td class="text-truncate" style="max-width: 150px; height:10px;">
		      	<center>
			      	<div class="" style="width:80%; height:80px; " >
					  <img class="card-img-top" src="<?php echo $imageURL; ?>" alt="Card image cap" style="height:100%;">
					</div>
				</center>
		      </td>		   
		      <td class="text-truncate">
		      	<a class="btn btn-danger" href="responselist.php?delid=<?php echo $row['id'];?>"><i class="fa fa-trash-o"></i></a>
		      	<a class="btn btn-success" href="editresponselist.php?updid=<?php echo $row['id'];?>"><i class="fa fa-edit"></i></a>   
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


<?php 

if (isset($_POST['submit']) && !empty($_FILES["file"]["name"])) {
	
	$addquery = $_POST['Addquery'];
	$addreply = $_POST['Addreply'];
	$sick = $_POST['diseases'];

	    $targetDir = "../image/";
	    $fileName = basename($_FILES["file"]["name"]);
	    $targetFilePath = $targetDir . $fileName;
	    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

	    // Allow certain file formats
	         $allowTypes = array('jpg','png','jpeg','JPG','PNG','JPEG');

	         if(in_array($fileType, $allowTypes)){
	             // Upload file to server
	            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
	                $inserts = $conn->query("INSERT INTO chatbot (MedImage,queries,replies,Diseases) VALUES ('$fileName','$addquery','$addreply','$sick')");
	                   echo '<script type="text/javascript">
	                                 window.location.href="responselist.php";
	                       </script>';


	            }//Move File            
	         }//Allowtpes
}



 ?>


<!-- Modal -->
<div class="modal fade modaldesign" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Queries</h1>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>

<form action="" method="post" enctype="multipart/form-data">

      <div class="modal-body">
        <div class="col-sm-12"> 
        	<label>Add Query</label>
        	<textarea type="name" name="Addquery" class="form-control" placeholder="Add Query" required="true"></textarea>
        </div>
        <br>
        <div class="col-sm-12"> 
        	<label>Add Reply</label>
        	<textarea type="name" name="Addreply" class="form-control" placeholder="Add Reply" required="true"></textarea>
        </div>

        <div class="col-sm-12"> 
        	<label>Sickness or Disease Can Cure</label>
        	<textarea type="name" name="diseases" class="form-control" placeholder="Sickness or Disease Can Cure" required="true"></textarea>
        </div>

        <br>
        <div class="col-sm-12">
        	<input class="form-control" type="file" name="file" style="font-weight:bolder; height:45px;" required="true">
        </div>





      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
      </div>

</form>


    </div>
  </div>
</div>

 </body>
 </html>


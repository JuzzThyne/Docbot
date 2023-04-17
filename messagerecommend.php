<?php
require('includes/database.php');
// getting user message through ajax
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);

$check_data=mysqli_query($conn,"SELECT * FROM chatbot WHERE Diseases='$getMesg'");

if(mysqli_num_rows($check_data) > 0){

    
    echo '<b>This is the Recommended Medicine for '.$getMesg.'<br><br></b>';
    while($fetch_data=mysqli_fetch_array($check_data)){
    $MedName = $fetch_data['queries'];
    $reply = $fetch_data['replies'];

    echo '<b>'.$MedName.'<b>'.'  ---  '.$reply.'<br><br>';

    }
    
    //echo "<img src='image/".$fetch_data['MedImage']."' style='height:150px; width:100%;'><br><br>";
    
   
}else{
    $display = mysqli_query($conn, "SELECT * FROM botsettings ");
    $row = $display->fetch_assoc();
    $noresult=$row['noresultmessage'];

	$inquiries = "INSERT INTO inquiry (NoAnswer) values ('$getMesg')";
	$query = mysqli_query($conn, $inquiries);

	if ($inquiries) {
		echo $noresult;
	}else{
		 echo "error code";
	}
   
}

?>
<?php
require 'core/int.php';

//$allowed = array('jpg','jpeg','gif','png');
				
$fileName = $_FILES['profile']['name']; // The file name
$fileType = $_FILES['profile']['type']; // The type of file it is
$fileExten = strtolower(end(explode('.',$fileName)));// this returns file extension like png jpg
$file_temp = $_FILES['profile']['tmp_name']; // File in the PHP tmp folder
$fileSize = $_FILES['profile']['size']; // File size in bytes
$fileErr = $_FILES['profile']['error']; // 0 for false and 1 for true
		
	if(!$file_temp){ // if file not chosen
		echo '<p class="logErr">ERROR: Please choose a file.</p>';
		exit();
	}
	if($fileSize > 1048576){
		echo '<p class="logErr">ERROR: Your image file was larger than 1mb.</p>';
		unlink($file_temp); // Remove the uploaded file from the PHP temp folder 
		exit();
	}
	if(!preg_match("/\.(gif|jpg|jpeg|png)$/i", $fileName)){
		echo '<p class="logErr">ERROR: Your image was not .gif, .jpg, .jpeg, png.</p>';
		unlink($file_temp); // Remove the uploaded file from the PHP temp folder 
		exit();
	}
	if($fileErr == 1){
		echo '<p class="logErr">ERROR: An error occured while processing the file. Try again.</p>';
		exit();
	}else{
		userProfileImage($session_userId, $file_temp, $fileExten);
		//echo '<p style="color:green">Upload is complete.</p>';
		echo "1";
	
	}



?>
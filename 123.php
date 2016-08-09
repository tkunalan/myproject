<?php
require 'core/int.php';
global $session_userId;
$id = $_POST['editId']; 
$by = $_POST['editBody'];
$te = $_POST['editTitle'];

if(empty($by) or empty($te)){
			
			echo "<span class='logErr'>empty story</span>";
			exit();
		
		}else{
		
			$sql = "UPDATE stories SET title= '$te', story = '$by', time = now(), edited = '1' WHERE id= $id AND user_id = $session_userId";
			$query=mysqli_query($db,$sql);
			echo "1";
		}



?>
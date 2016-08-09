<?php
require 'core/int.php';
/*if($_POST['pic'] !=""){
$db = new mysqli('localhost' , 'root' , 'root' ,'mydb');
$id = $_POST['pic'];
$query = mysqli_query($db, "SELECT firstName,profile FROM user_information WHERE id = '$id'");
$user_name_check = mysqli_num_rows($query);

	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		
		echo '<img src="'.$row['profile'].'" style="width:120px;max-height:120px;border:2px solid #a4cfff;border-radius:35px;"alt="'.$row['firstName'].'\'s profile image" />';
	}

}

*/

echo '<img src="'.$userData['profile'].'" style="width:120px;max-height:120px;border:2px solid #a4cfff;border-radius:35px;"alt="'.$userData['firstName'].'\'s profile image" />';
?>

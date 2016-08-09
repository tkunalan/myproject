<?php
require 'core/int.php';
 $sender = $_POST['sender_name'];
echo $reciver = $_POST['reciver_name'];
 $message = $_POST['message'];



$sql="INSERT INTO private_message (sender, reciver,message )
			VALUES('$sender','$reciver','$message')";
mysqli_query($db, $sql);
echo"message send!";

?>
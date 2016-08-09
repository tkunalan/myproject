<?php
require 'core/int.php';

 $id = $_POST['by_id']; 
 $un = $_POST['by_un'];
 $title = $_POST['title'];
 $body = $_POST['body'];
 $profile = $_POST['profile'];
//echo "1";

if(empty($title) or empty($body)){
	echo "<span class='logErr'>Empty story.</span>";
	exit();
}
if(strlen($title)>100){
	echo "<span class='logErr'>Title is too long.</span>";
	exit();
}
if(strlen($body) < 20){
	echo "<span class='logErr'>Story is too short.</span>";
	exit();
}
if(strlen($body)>500){
	echo "<span class='logErr'>Story is too long.</span>";
	exit();
}else{
	userStoryReg($id, $un, $title, $body, $profile);
	echo "1";
}
?>
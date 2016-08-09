<?php 
require 'core/int.php';

function bloodCamps111(){
	global $db;
	$sql = "SELECT blood_bank,post_time FROM blood_camps";
	$query = mysqli_query($db, $sql);
	$list;
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		$list .= "<p class='resentupdate'>
					<p>".$row['blood_bank']."</p>
					<span>".$row['post_time']."</span>
					</p>";
	}
	return $list;
}
echo bloodCamps111();
?>
<!-- <form action="" method="post" >
	Name: <input type="text" name="name" id="name" /></br></br>
	Username: <input type="text" name="un" id="un" /></br></br>
	Password: <input type="password" name="pwd" id="pwd" /></br></br>
	<input type="submit" value="Submit" />
</form> --!>
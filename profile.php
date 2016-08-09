<?php
	require 'core/int.php';
	include 'include/login.php';
	
	if(isset($_GET['u'])=== false && empty ($_GET['u'])=== true){
		header("Location:index.php");
		exit();
	}else{
?>	

<?php	
	include 'include/overall/asideprofilepagetop.php';
	$userName = preg_replace('#[^A-Za-z0-9]#i', '', $_GET['u']);
			
	if(userExits($userName)=== true){
			
		$sql = "SELECT *
		FROM user_information, user_contact, user_login
		WHERE user_information.id = user_contact.id
		AND user_contact.id = user_login.id
		AND user_login.userName =  '$userName'
		AND user_login.accountActive = 1";
		$query = mysqli_query($db, $sql);				
			
		while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			$dateTime = $row['registerDate'];	
			$convertedTime = convert_datetime($dateTime);
			$when = makeAgo($convertedTime);
			$id = $row['id'];
			$userName = $row['userName'];
			$userType = $row['userType'];
			$firstName = $row['firstName'];
			$userName = $row['userName'];
			$privacy = $row['privacy'];
			$lastName = $row['lastName'];
			$dob = $row['dob'];
			$gender = $row['gender'];
			$weight = $row['weight'];
			$residenceNo = $row['residenceNo'];
			$profile = $row['profile'];
			$district = $row['district'];
			$bloodGroup = $row['bloodGroup'];
			$mobileNo = $row['mobileNo'];
			$email = $row['email'];
			$address = $row['address'];
		}

		if(loggedIn()===true && userExits($userName)=== true && $session_userId!= $id){
			echo '<button style="float:right;margin:10px;" id="pmopen"><b>Private Message</b></button></br>';
		}
		if(loggedIn()===true && $session_userId == $id){
			echo '<img src="images/print_img.png" title="Print" style="float:right; margin:10px; padding-right:5px;cursor:pointer;"onclick="printContent(\'print_profile\');" /></br>';
		}
		if(loggedIn()===true){
			echo '</br><hr style="border:1px dashed #FFE4E1" >';}
		else{
			echo '<h5 style="float:right;margin:10px;color:#4B0082;">[ Log in to send message to '.$firstName.' ]</h5></br></br>';
			echo '<hr style="border:1px dashed #FFF5EE">';
		}
?>

		</br>
		<span id="PMStatus"></span>
		<div class="interactContainers" id="private_message">
		<form action="javascript:private_mgs();" name="pmForm" id="pmForm" method="post">
		<font size="+1">Sending Private Message to <strong><em><?php echo "$firstName"; ?></em></strong></font><br /><br />
		Subject:
		<input name="pmSubject" id="pmSubject" type="text" maxlength="64" style="width:98%;" />
		Message:
		<textarea name="pmTextArea" id="pmTextArea" rows="8" style="width:98%;" ></textarea>
		  <input name="pm_sender_id" id="pm_sender_id" type="hidden" value="<?php echo $session_userId; ?>" />
		  <input name="pm_sender_name" id="pm_sender_name" type="hidden" value="<?php echo $userData['firstName']; ?>" />
		  <input name="pm_rec_id" id="pm_rec_id" type="hidden" value="<?php echo $id; ?>" />
		  <input name="pm_rec_name" id="pm_rec_name" type="hidden" value="<?php echo $firstName; ?>" />
		  
		  <br /><input name="pmSubmit" id="pmsubmit" type="submit"  value="Send" /> or <button  id="close1">Close</button>
		</form>
		 </div></br>
<?php
			echo '<div id="print_profile"><h2>'.$firstName."'s profile</h2></br>";
			echo '<fieldset class="profile_info">';
			echo '<legend class="pic"><img src="'.$profile.'" alt="'.$firstName.'\'s profile image" title="'.$firstName.'"/></legend>';
			echo '<img class="picbig" src="'.$profile.'" />';
			echo '<p>';
			echo '<label>Username</label>';
			echo '<span>'.$userName.'</span></br></br>';
			echo '<label>User Type</label>';
			if($userType == 1){echo '<span>Administrator</span></br></br>';}else{echo '<span>User</span></br></br>';}
			echo '<label>Joined</label>';
			echo '<span>' .$when.'</span></br></br>';
			echo '<label>First name</label>';
			echo '<span>' .$firstName.'</span></br></br>';
			echo '<label>Last name</label>';
			echo '<span>' .$lastName.'</span></br></br>';
			echo '<label>Date of Birth</label>';
			if($privacy === 'Users' && loggedIn() === false){echo '<span>[You must Login.]</span></br></br>';}
			else{echo '<span>' .$dob.'</span></br></br>';}
			echo '<label>Gender</label>';
			echo '<span>' .$gender.'</span></br></br>';
			echo '<label>Blood Group</label>';
			echo '<span>' .$bloodGroup.'</span></br></br>';
			echo '<label>Weight</label>';
			echo '<span>' .$weight.'</span></br></br>';
			echo '<label>Resident Pno</label>';
			if($privacy === 'Users' && loggedIn() === false){echo '<span>[You must Login.]</span></br></br>';}
			else{echo '<span>' .$residenceNo.'</span></br></br>';}
			echo '<label>Mobile no</label>';
			if($privacy === 'Users' && loggedIn() === false){echo '<span>[You must Login.]</span></br></br>';}
			else{echo '<span>' .$mobileNo.'</span></br></br>';}
			echo '<label>Email</label>';
			if($privacy === 'Users' && loggedIn() === false){echo '<span>[You must Login.]</span></br></br>';}
			else{echo '<span>' .$email.'</span></br></br>';}
			echo '<label>Address</label>';
			echo '<span>' .$address.'</span></br></br>';
			echo '<label>District</label>';
			echo '<span>' .$district.'</span></br></br>';
			echo '</p>';
			echo '</fieldset></div>';
			$locationString = $address.'%20'.$district;
			echo '</br><iframe width="650" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q='.$locationString.'&key=AIzaSyCbnOkIVD3KHjAr1vbFtW0krAMjz858qQs"></iframe>';
	}else{
		echo "<p class='errors'>Sorry, the user does not exit.</p>";
	}
}
?>
<?php
include 'include/overall/asideprofilepagebottom.php';
?>
				

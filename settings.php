<?php
	require 'core/int.php';
	protectedPage();

	if(empty($_POST)===false){
		$required_feilds = array('fname','lname','bdGroup','residentPno','mobileNo','email');
		foreach($_POST as $key=>$value){
			if(empty($value) && in_array($key, $required_feilds)=== true){
				$errors[] = "Fill the required feilds.";
				break 1;
			}
		}
		
		if(empty($errors)===true){
			if(($_POST['residentPno'][0])!=0){
				$errors[]="Enter valid phone number. Ex: 011xxx.";
			}
			if(($_POST['mobileNo'][0])!=0){
				$errors[]="Enter valid mobile number. Ex: 077xxx.";
			}
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)===false){
				$errors[]="Valid email address is required.";
			}else if(emailExits($_POST['email']) === true && $userData['email'] !== $_POST['email']){
				$errors[]="Sorry, the email is already in use.";
			}
		}
		
		
		
	}

	
include 'include/overall/asideprofilepagetop.php';

?>
	<h2>Settings</h2>
<?php
	
	if(empty($_POST)=== false && empty($errors)=== true){
		
			$fN	 =	$_POST['fname'];
			$lN	 =	$_POST['lname'];
			$bG	 =	$_POST['bdGroup'];
			$rN  =	$_POST['residentPno'];
			$mN	 =	$_POST['mobileNo'];
			$eml =	$_POST['email'];
			$pri =	$_POST['privacy'];
			$aE	 =	($_POST['allowEmail'] == 'on') ? 1 : 0;
		
		
		updateData($fN,$lN,$bG,$rN,$mN,$eml,$pri,$aE);
		
		echo '<p class="message">Your details have been updated successfully!</p>';
		echo "<a class='a1' href='index.php'><p class='b2r'>Home</p></a>";
	}else if(empty($errors)=== false){
		//output errors.
		echo outputErrors($errors);
		echo "<a class='a1' href='settings.php'><p class='b2r'><< Back to form</p></a>";
	}else{
	
?>
<form method="POST" action="" >
	<fieldset class="cpwd_info">
		<legend></legend>
			<p>
				<label for="cpwd">First name: <span style="color:red">*</span></label>
				<input type="text" id="fname" name="fname" required placeholder="<?php echo $userData['firstName'];?>"/></br>
				<label for="fname">Last name: <span style="color:red">*</span></label>
				<input type="text" id="lname" name="lname" required placeholder="<?php echo $userData['lastName'];?>"/></br>
				<label for="bdGroup">Blood Group: <span style="color:red">*</span></label>
				<select name="bdGroup" id="bdGroup">
					<option value="0" >-Select Blood Group-</option>
					<option>A+</option>
					<option>A-</option>
					<option>B+</option>
					<option>B-</option>
					<option>AB+</option>
					<option>AB-</option>
					<option>O+</option>
					<option>O-</option>
				</select></br>
				<label for="residentPno">Residence Phone: <span style="color:red" >*</span></label>
				<input type="text" name="residentPno" id="residentPno"  maxlength="10" size="20" placeholder="<?php echo $userData['residenceNo'];?>" required /></br>
				<label for="mobileNo">Mobile No: <span style="color:red">*</span></label>
				<input type="text" name="mobileNo" id="mobileNo"  maxlength="10" size="20" placeholder="<?php echo $userData['mobileNo'];?>" required /></br>
				<label for="email">Email: <span style="color:red">*</span></label>
				<input type="email" id="email" name="email" required placeholder="<?php echo $userData['email'];?>"/></br>
				<label for="privacy">display: (Birthday,Phone No,Email)</label>
				<select name="privacy" id="privacy">
					<option value="Users">Users</option>
					<option value="Public">Public</option>
				</select></br>
				<label for="allowEmail">Would you like to receive email from us?</label>
				<input type="checkbox" id="allowEmail" name="allowEmail" <?php if($userData['allowEmail']==1){echo 'checked="checked"';}?>/>
			</p>
	</fieldset>
	<input class="cpwd_butn" type="submit" value="Update" />
</form>
<?php } ?>
<?php include 'include/overall/asideprofilepagebottom.php'; ?>
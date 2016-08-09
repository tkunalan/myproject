<?php
 require 'core/int.php';
 protectedPage();

if(empty($_POST)===false){
	$required_feilds = array('cpwd','npwd','npwda');
	foreach($_POST as $key=>$value){
		if(empty($value) && in_array($key, $required_feilds)=== true){
			$errors[] = "Fill the required feilds.";
			break 1;
		}
	}

	if(md5($_POST['cpwd'])=== $userData['password']){
		if(trim($_POST['npwd']) !== trim($_POST['npwda'])){
			$errors[] = "Your new password do not much.";
		}else if(strlen($_POST['npwd'])<6){
			$errors[] = "Your password must be at least 6 character.";
		}
	}else{
		$errors[] = "Your current password is incorrect.";
	}
	
	
}

	
include 'include/overall/asideprofilepagetop.php';

?>
	<h2>Change Password</h2>
	
	<?php
	if(empty($_POST)=== false && empty($errors)=== true){
		changePassword($session_userId, $_POST['npwd']);
		echo '<p class="message">Your password has been changed successfully!</p>';
		echo "<a class='a1' href='index.php'><p class='b2r'>Home</p></a>";
	}else if(empty($errors)=== false){
		//output errors.
		echo outputErrors($errors);
		echo "<a class='a1' href='changepwd.php'><p class='b2r'><< Back to form</p></a>";
	}else{
	
	?>
		<form method="POST" Action="" >
			<fieldset class="cpwd_info">
				<legend></legend>
					<p>
						<label for="cpwd">Current password: <span style="color:red">*</span></label>
						<input type="password" id="cpwd" name="cpwd" required /></br>
						<label for="npwd">New password: <span style="color:red">*</span></label>
						<input type="password" id="npwd" name="npwd" required /></br>
						<label for="npwda">New password again: <span style="color:red">*</span></label>
						<input type="password" id="npwda" name="npwda" required />
					</p>
			</fieldset>
			<input class="cpwd_butn" type="submit" value="Change password">
		</form>
		<?php }?>
					
<?php include 'include/overall/asideprofilepagebottom.php'; ?>
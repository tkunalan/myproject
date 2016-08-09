<?php
	require 'core/int.php';
		
		$required_feilds = array('firstName','lastName','userName','password','repassword','date','month','year','gender',
						'bdGroup','weight','residentPno','mobileNo','email','address','district');
						foreach($required_feilds as $feilds){
							if(!isset($_POST[$feilds]) || empty($_POST[$feilds])){
								echo "<p class='errors'><img src='images/round_error.png' /> Fill the required feilds.</p>";
								$err = true;
								break;
								exit();
							}
						}
		
										
		if($err == false){	
		
			if(strlen($_POST['userName'])<4||strlen($_POST['userName'])>15){
				echo "<p class='errors'><img src='images/round_error.png' /> Username must be 4-15 character.</p>";
				echo "<script>$('#userName').focus()</script>";
				echo "<script>$('#userName').css('border-color','#CD5C5C')</script>";
				exit();
			}
			if(preg_match("/\\s/",$_POST['userName'])==true){
				echo "<p class='errors'><img src='images/round_error.png' /> Your username must not contain any spaces.</p>";
				exit();
			}
			if(is_numeric($_POST['userName'][0])){
				echo "<p class='errors'><img src='images/round_error.png' /> Username's first letter must be character.</p>";
				echo "<script>$('#userName').focus()</script>";
				echo "<script>$('#userName').css('border-color','#CD5C5C')</script>";
				exit();
			}
			if(userExits($_POST['userName'])===true){
				echo "<p class='errors'><img src='images/round_error.png' /> Sorry, the username is already taken.</p>";
				echo "<script>$('#userName').focus()</script>";
				echo "<script>$('#userName').css('border-color','#CD5C5C')</script>";
				exit();
			}
			if(strlen($_POST['password'])<6){
				echo "<p class='errors'><img src='images/round_error.png' /> Your password must be at least 6 character.</p>";
				echo "<script>$('#password').focus()</script>";
				echo "<script>$('#password').css('border-color','#CD5C5C')</script>";
				exit();
			}
			if($_POST['password'] !== $_POST['repassword']){
				echo "<p class='errors'><img src='images/round_error.png' /> Your password do not match.</p>";
				echo "<script>$('#password').focus()</script>";
				echo "<script>$('#password').css('border-color','#CD5C5C')</script>";
				exit();
			}
			if(strlen($_POST['firstName'])<4){
				echo "<p class='errors'><img src='images/round_error.png' /> Firstname should be minimum four charecter.</p>";
				echo "<script>$('#firstName').focus()</script>";
				echo '<script>$("#firstName").css("border-color","#CD5C5C")</script>';
				exit();
			}
			
			if(preg_match("/\\s/",$_POST['firstName'])==true){
				echo "<p class='errors'><img src='images/round_error.png' /> Your firstname must not contain any spaces.</p>";
				echo "<script>$('#firstName').focus()</script>";
				echo "<script>$('#firstName').css('border-color','#CD5C5C')</script>";
				exit();
			}
			if(strlen($_POST['lastName'])<4){
				echo "<p class='errors'><img src='images/round_error.png' /> Lastname must be minimum four charecter.</p>";
				echo "<script>$('#lastName').focus()</script>";
				echo "<script>$('#lastName').css('border-color','#CD5C5C')</script>";
				exit();
			}
			if(preg_match("/\\s/",$_POST['lastName'])==true){
				echo "<p class='errors'><img src='images/round_error.png' /> Your lastname must not contain any spaces.</p>";
				echo "<script>$('#lastName').focus()</script>";
				echo "<script>$('#lastName').css('border-color','#CD5C5C')</script>";
				exit();
			}
			if(!checkdate($mth,$dy,$yr)){
				echo "<p class='errors'><img src='images/round_error.png' /> Selected date is not valid.</p>";
				echo "<script>$('#day').focus()</script>";
				echo "<script>$('#day').css('border-color','#CD5C5C')</script>";
				exit();
			}
			if($_POST['weight']<50){
				echo "<p class='errors'><img src='images/round_error.png' /> You can not donate blood. Age is less than 50.</p>";
				echo "<script>$('#weight').focus()</script>";
				echo "<script>$('#weight').css('border-color','#CD5C5C')</script>";
				exit();
			}
			if(!($_POST['residentPno'][0]==0)){
				echo "<p class='errors'><img src='images/round_error.png' /> Enter valid number.</p>";
				echo "<script>$('#residentPno').focus()</script>";
				echo "<script>$('#residentPno').css('border-color','#CD5C5C')</script>";
				exit();
			}
			if(!($_POST['mobileNo'][0]==0)){
				echo "<p class='errors'><img src='images/round_error.png' /> Enter valid number.</p>";
				echo "<script>$('#mobileNo').focus()</script>";
				echo "<script>$('#mobileNo').css('border-color','#CD5C5C')</script>";
				exit();
			}
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)===false){
				echo "<p class='errors'><img src='images/round_error.png' /> Valid email address is required.</p>";
				echo "<script>$('#email').focus()</script>";
				echo "<script>$('#email').css('border-color','#CD5C5C')</script>";
				exit();
			}
			if(emailExits($_POST['email'])===true){
				echo "<p class='errors'><img src='images/round_error.png' /> Sorry, the email is already in use.</p>";
				echo "<script>$('#email').focus()</script>";
				echo "<script>$('#email').css('border-color','#CD5C5C')</script>";
				exit();
			}else{
		
				$dob = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['date'];
											
				registerUser($fN,$lN,$uN,$pwd,$dob,$gdr,$bG,$wht,$rem,$rN,$mN,$eml,$ads,$dst);
				echo "1";
		
			}
		
		}
?>
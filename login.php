<?php
	require 'core/int.php';
	
	if ($_POST['un'] != "" && $_POST['pwd'] != "") {
	
		 $un = $_POST['un'];
		 $pwd = $_POST['pwd'];
	
		if(userExits($un)=== false){ // userdefind  function.
			echo '<p class="logErr">We can\'t find that username.</p>';
			echo '<p class="forgot">Forgot <a href="recover.php?mode=username" >Username?</a></p>';
		}else if(accountActive($un)=== false){ // userdefind  function.
			echo '<p class="logErr">Account is not active yet.</p>';
		}else{
			$logIn = logIn($un,$pwd); // userdefind  function.
		if($logIn===false){
			echo '<p class="logErr">Invalid password.</p>';
			echo '<p class="forgot">Forgot <a href="recover.php?mode=password" >Password?</a></p>';
		}else{
			$_SESSION['userId'] = $logIn;
			echo "login";
			//header('Location:index.php');
			exit();
		}
	}
}



?>

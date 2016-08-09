<?php
	require 'core/int.php';
	include 'include/login.php';
	logInRedirect();
	$modeAllowed = array('username','password');
	if(isset($_GET['mode'])=== false  || in_array($_GET['mode'], $modeAllowed) === false){
		header("Location:index.php");
		exit();
	}else{
	
?>
<?php
		echo 
'<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Online Blood Bank</title>
		<link rel="stylesheet" href="css/main.css" />
	</head>
	<body class="bg">
		<div id="main_container">
			<header id="main_header">
		<h1 class="main_heading">ONLINE BLOOD MANAGEMENT SYSTEM</h1>
		</header>
			<nav id="top_menu">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="">Picture</a></li>
					<li><a href="">Article</a></li>
					<li><a href="">Stories</a></li>
					<li><a href="">About us</a></li>
					<li><a href="">Contact</a></li>
					<li><a href="faq.php">FAQ</a></li>
					<li><a href="">Contact</a></li>
				</ul>
			</nav>';
		
	}
	if(isset($_POST['email'])=== true && empty($_POST['email']) === false){
		if(emailExits($_POST['email'])=== true){
			echo recover($_GET['mode'],$_POST['email']);
		}else{
			echo "<div class='errors'>";
			echo '<p>Oops, we couldn\'t find that email address!</p>';
			echo "</div>";
			echo '<p class="newacc">Don\'t you have an account? Register <a class="a1" href="register.php">here</a></p>';
			
		}
	}else{
		echo
		'<form action="" method="POST">
			<fieldset class="recover_info">
				<legend></legend>
					<p>
						<label for="email">Enter your email address: </label>
						<input type="email" name="email" id="email" required placeholder="Search for yourself" />
					</p>
			</fieldset>
			<input type="submit" class="rc_butn" value="Recover" />
		</form>';
	}
?>
</article>
		</section>
		<?php include'include/overall/footer.php';?>
		</div>
	</body>
</html>
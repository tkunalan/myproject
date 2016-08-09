<?php 
require 'core/int.php';
	//protectedPage();
	//adminProtect();
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Online Blood Bank</title>
		<link rel="stylesheet" href="css/main.css" />
		<script type="text/javascript" src="script/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="script/popup.js"></script>
		<script type="text/javascript" src="script/userprofile.js"></script>
		<script type="text/javascript" src="script/register.js"></script>
	</head>
	<body class="bg">
		<div id="main_container">
			<?php include 'include/overall/header.php';?>
			<nav id="top_menu">
				<ul>
					<li><a href="index">Home</a></li>
					<li><a href="blood_bank">Blood Bank</a></li>
					<li><a href="find_donor">Find Donor</a></li>
					<?php if(isAdmin($session_userId)=== false){echo '<li><a href="request">Request Blood</a></li>';}?>
					<li><a href="stories">Stories</a></li>
					<li><a href="faq">FAQ</a></li>
					<li><a href="about us">About us</a></li>
					<li><a href="contact">Contact</a></li>
				</ul>
			</nav>
			<?php include'include/overall/no_script.php'?>
			
			<aside id="right">
				<article>
					<p>welcome admin</p>
					</br>
					<p><a href="index" target="_blank"> view site </a> | <a href="">Log out</a></p></br>
					<hr></br>
					<div id="admin_links">
						<a class="curr_link" href="adminPannel">Users</a>
						<a href="">Stories</a><hr>
						<a href="mail">Mail</a>
						<a href="message">Message</a><hr>
						<a href="requested">Blood Requests</a>
						<a href="">Blood Camps</a>
					</div>
				</article>
			</aside>
			<section id="section">
				<article>
					<h4>Work in progress...</h4>
				</article>
			</section>
			
			<?php include'include/overall/footer.php';?>
		</div>
	</body>
</html>
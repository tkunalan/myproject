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
						<a href="adminPannel">Users</a>
						<a href="">Stories</a><hr>
						<a href="mail">Mail</a>
						<a class="curr_link" href="message">Message</a><hr>
						<a href="requested">Blood Requests</a>
						<a href="">Blood Camps</a>
					</div>
				</article>
				
				
			</aside>
			<section id="section">
				<article>
					<h2>Message to all</h2>
				 <?php 
					if(empty($_POST)=== false){
						if(empty($_POST['bdGroup'])=== true){
							$errors[] = "Blood group is required";
						}
						if(empty($_POST['district'])=== true){
							$errors[] = "district is required";
						}
						if(empty($_POST['subject'])=== true){
							$errors[] = "Subject is required";
						}
						if(empty($_POST['body'])=== true){
							$errors[] = "Body is required";
						}
						if(empty($errors)=== false){
							echo outputErrors($errors);
							echo "<a class='a1' href='index.php'><p class='b2r'><< Back </p></a>";
						}else{
							$bG = $_POST['bdGroup'];
							$dis = $_POST['district'];
							$sql = "SELECT user_login.id, firstName
							FROM user_information, user_contact, user_login
							WHERE user_information.id = user_contact.id
							AND user_contact.id = user_login.id
							AND user_information.bloodGroup = '$bG'
							AND user_contact.district = '$dis'
							AND user_login.accountActive = 1";
						
							$query=mysqli_query($db,$sql);
							
							while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
								messageUsers($row['id'], $row['firstName'], $session_userId, $userData['firstName'], $_POST['subject'], $_POST['body']);
							}
							echo '<p class="message">Message has been sent successfully!</p>';
							echo "<a class='a1' href='admin.php'><p class='b2r'>Home</p></a>";
						}
					}else{

				 ?>
					
					<form action="" method="POST" >
						<fieldset class="cpwd_info">
							<legend></legend>
								<p>
									<label>Blood Group: <span style="color:red">*</span></label>
										<select name="bdGroup" id="bloodG"  >
											<option value="0">-Select Blood Group-</option>
											<option>A+</option>
											<option>A-</option>
											<option>B+</option>
											<option>B-</option>
											<option>AB+</option>
											<option>AB-</option>
											<option>O+</option>
											<option>O-</option>
										</select></br>
									<label for="District">District: <span style="color:red">*</span></label>
										<select name="district" id="district"  >
											<option value="0">-Select District-</option>
											<option>Ampara</option>
											<option>Anuradhapura</option>
											<option>Badulla</option>
											<option>Batticaloa</option>
											<option>Colombo</option>
											<option>Galle</option>
											<option>Gampaha</option>
											<option>Hambantota</option>
											<option>Jaffna</option>
											<option>Kalutara</option>
											<option>Kandy</option>
											<option>Kegalle</option>
											<option>Kilinochchi</option>
											<option>Kurunegala</option>
											<option>Mannar</option>
											<option>Matale</option>
											<option>Matara</option>
											<option>Moneragala</option>
											<option>Mullaitivu</option>
											<option>Nuwara Eliya</option>
											<option>Polonnaruwa</option>
											<option>Puttalam</option>
											<option>Ratnapura</option>
											<option>Trincomalee</option>
											<option>Vavuniya</option>
										</select>
									<label for="subject">Subject: <span style="color:red">*</span></label></br>
									<input type="text" id="subject" name="subject" required placeholder="Subject of message"/></br>
									<label for="body">Body: <span style="color:red">*</span></label></br>
									<textarea id="body" name="body" required placeholder="Message" rows="10" cols="60" ></textarea>
								</p>
						</fieldset>
						<input class="cpwd_butn" type="submit" value="send" />
					</form>
					<?php }?>
				</article>
			</section>
			
			<?php include'include/overall/footer.php';?>
		</div>
	</body>
</html>
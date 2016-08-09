<?php require 'core/int.php';?>
<?php include 'include/login.php'; ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Online Blood Bank</title>
		<link rel="stylesheet" href="css/main.css" />
		<script type="text/javascript" src="script/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="script/popup.js"></script>
		<script type="text/javascript" src="script/register.js"></script>
		<script type="text/javascript" src="script/userprofile.js"></script>
	</head>
	<body class="bg">
		<div id="main_container">
			<?php include 'include/overall/header.php';?>
			<nav id="top_menu">
				<ul>
					<li><a href="index">Home</a></li>
					<li><a href="blood_bank">Blood Bank</a></li>
					<li><a href="find_donor">Find Donor</a></li>
					<?php if(isAdmin($session_userId)=== false){echo '<li><a href="request" class="current">Request Blood</a></li>';}?>
					<li><a href="stories">Stories</a></li>
					<li><a href="faq">FAQ</a></li>
					<li><a href="about us">About us</a></li>
					<li><a href="contact">Contact</a></li>
				</ul>
			</nav>
			<?php include'include/overall/no_script.php'?>
			<section id="section">
				<article>
					<h2 style="padding:10px">Request Blood</h2>
					<p id="success"></p>
					<form method="POST" action="" id="requestBlood">
						<p style="color:red">* Required Information</p>
						<p id="mgs"></p>
						<fieldset class="cpwd_info">
							<legend>Patient Details.</legend>
								<p>
									<label for="cpwd">Patient name: <span style="color:red">*</span></label>
									<input type="text" id="pname" name="pname" required placeholder="Patient name"/></br>
									<label for="bdGroup">Required Blood Group: <span style="color:red">*</span></label>
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
									<label for="Hna">Hospital Name & Address: <span style="color:red" >*</span></label>
									<textarea name="Hna" id="Hna" rows="5" cols="20"></textarea></br>
									<label for="wR">When Required: <span style="color:red">*</span></label>
									<select name="day"  id="day" style="margin-right:0px ">
										<option value="0">Day</option>
										<option value="01">1</option>
										<option value="02">2</option>
										<option value="03">3</option>
										<option value="04">4</option>
										<option value="05">5</option>
										<option value="06">6</option>
										<option value="07">7</option>
										<option value="08">8</option>
										<option value="09">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
										<option value="21">21</option>
										<option value="22">22</option>
										<option value="23">23</option>
										<option value="24">24</option>
										<option value="25">25</option>
										<option value="26">26</option>
										<option value="27">27</option>
										<option value="28">28</option>
										<option value="29">29</option>
										<option value="30">30</option>
										<option value="31">31</option>
									</select>
									<select name="month"  id="month" style="margin:0px 0px">
										<option value="0">Month</option>
										<option value="01">Jan</option>
										<option value="02">Feb</option>
										<option value="03">Mar</option>
										<option value="04">Apr</option>
										<option value="05">May</option>
										<option value="06">Jun</option>
										<option value="07">Jul</option>
										<option value="08">Aug</option>
										<option value="09">Seb</option>
										<option value="10">Oct</option>
										<option value="11">Nov</option>
										<option value="12">Dec</option>
									</select>
									<select name="year" id="year" style="margin:0px 0px">
										<option value="0">Year</option>
										<option>2016</option>
										<option>2017</option>
										<option>2018</option>
										<option>2019</option>
										<option>2020</option>
									</select>
								</p>
						</fieldset>
						<fieldset class="cpwd_info">
							<legend>Contact Details.</legend>
								<p>
									<label for="cpwd">Contact name: <span style="color:red">*</span></label>
									<input type="text" id="cname" name="cname" value="<?php if(loggedIn()===true) echo $userData['userName'];?>" required placeholder="Contact name"/></br>
									<label for="bdGroup">Contact Email: <span style="color:red">*</span></label>
									<input type="email" name="ce" id="ce" value="<?php if(loggedIn()===true) echo $userData['email'];?>" required placeholder="you@example.com"/>
									<label for="bdGroup">Contact Number: <span style="color:red">*</span></label>
									<input type="tel" name="cn" id="cn" maxlength="10" value="<?php if(loggedIn()===true) echo $userData['mobileNo'];?>" required placeholder="07xxxx">
									<label for="District">District: <span style="color:red">*</span></label>
									<select name="district"   >
										<option value="0">-Select Your District-</option>
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
								</p>
						</fieldset>
						<input class="cpwd_butn" type="submit" value="Request" />
					</form>
				</article>
			</section>
			<aside id="right">
				<article>
					<?php include 'include/wedgets/asidelogin.php';?>
				</article>
				<?php  if(loggedIn() === false){
				echo
				'<article>
					<h3 style="text-align:center;font-weight:bold">Saving lives is quick & easy with a donor account!</h3></br>
					<h4>It also has the following benefit:</h4>
					<p style="line-height:30px"><img src="images/list.png" /> Be reminded when to give blood</p></br>
					<a href="register" ><img style="cursor:hand;" src="images/register.jpg" /></a>
				</article>';
				}
				?>
				<?php  
				if(loggedIn() === false){
					echo
					'<article class="resent">
					<header>
						<h4 class="ahs">Resent Updates</h4>
					</header>
					<p>';?><?php echo registeredUsers()?><?php echo '<p>
					<p style="float:right;margin:10px 5px 5px 5px;"><a style="text-decoration:none;" href="find donor">find more >></a></p>
				</article>';
				}?>
				<article><h4 class="uph" id="bloodStock" title="Click to view">Blood Stock</h4></article>
				<article class="bc">
					<h4 class="ahs">Blood Donation Camps</h4>
					<marquee  scrollamount="3" scrolldelay="0" direction="up" loop="true" onmouseover="this.stop();" onmouseout="this.start();">
						<p><?php echo bloodCamps();?></p>
					</marquee>
				</article>
			</aside>
			<div id="stock_popup">
				<h2>Blood Stock</h4>
				<div>
					<p><? echo 'We have <b>'.userCount().'</b> registred donors';?></p>
					<p><?php echo blood();?></p>
				</div>
				<div>
					<input type="button" id="closeStock" value="CLOSE" />
				</div>
			</div>
			<div id="overlay-bg1"></div>
			<div id="blood_camps">
				<h2>Camp Details</h2>
				<div id="camp_details"></div>
				<div>
					<button id="closebc">Close</button>
				</div>
			</div>
			<?php include'include/overall/pop_up.php';?>
			<?php include'include/overall/footer.php';?>
		</div>
	</body>
</html>
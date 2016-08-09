<?php 
require 'core/int.php';
logInRedirect();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Donor Registration</title>
		<link rel="stylesheet" href="css/register.css" />
		<script src="script/jquery-2.1.4.min.js"></script>
		<script src="script/register.js"></script>
		<script type="text/javascript" src="script/userprofile.js"></script>
	</head>
	<body class="bg">
		<div id="main_container">
			<?php include'include/overall/header.php';?>
			<nav id="top_menu">
				<ul>
					<li><a href="index" class="current">Home</a></li>
					<li><a href="blood_bank">Blood Bank</a></li>
					<li><a href="find_donor">Find Donor</a></li>
					<li><a href="request">Request Blood</a></li>
					<li><a href="stories">Stories</a></li>
					<li><a href="faq">FAQ</a></li>
					<li><a href="about us">About us</a></li>
					<li><a href="contact">Contact</a></li>
				</ul>
			</nav>
			<?php include'include/overall/no_script.php'?>
			<div class="you_are_in">You are here:- :: 
				<a href="index">Home</a> >> :: 
				<a href="register">Donor Registration</a>
			</div>
			<aside id="right">
				<div class="resent">
				</div>
			</aside>
			<section id="section">
				<article>
					<h2 style="padding:10px"> Blood Donor Registration</h2>
					<p id="success"></p>
					<form id="userRegister" method="POST" action="">
						<p style="color:red">* Required Information</p>
						<p id="mgs"></p>
						<fieldset class="rgister_info">
							<legend style="color:blue"><h4><img src="images/login.png"/> Login Information</h4></legend>
								<p>
									<label for="userName">Username: <span style="color:red">*</span></label>
									<input type="text" name="userName" id="userName" placeholder="jone12" maxlength="15" required onblur="javascript:find_un();"/>
									<span id="meg"></span></br>
									<label for="password">Password: <span style="color:red">*</span></label>
									<input type="password" name="password" id="password" placeholder="6 or more character" required /></br>
									<label for="repassword">Confirm Password: <span style="color:red">*</span></label>
									<input type="password" name="repassword" id="repassword" placeholder="Re-enter password" required />
								</p>
						</fieldset></br>
						<fieldset class="rgister_info">
							<legend style="color:blue"><h4><img src="images/donor.png"/> Donor Information</h4></legend>
								<p>
									<label for="firstName">First name: <span style="color:red"  >*</span></label>
									<input type="text" name="firstName" id="firstName"  placeholder="4 or more characters" onkeyup="lettersOnly(this)" required /></br> 
									<label for="lastName">Last name: <span style="color:red">*</span></label>
									<input type="text" name="lastName" id="lastName" placeholder="4 or more characters" onkeyup="lettersOnly(this)" required /></br>
									<label for="dob">Birthday: <span style="color:red">*</span></label>
									<select name="date"  id="day" style="margin-right:0px ">
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
										<option>1960</option>
										<option>1961</option>
										<option>1962</option>
										<option>1963</option>
										<option>1964</option>
										<option>1965</option>
										<option>1966</option>
										<option>1967</option>
										<option>1968</option>
										<option>1969</option>
										<option>1970</option>
										<option>1971</option>
										<option>1972</option>
										<option>1973</option>
										<option>1974</option>
										<option>1975</option>
										<option>1976</option>
										<option>1977</option>
										<option>1978</option>
										<option>1979</option>
										<option>1980</option>
										<option>1981</option>
										<option>1982</option>
										<option>1983</option>
										<option>1984</option>
										<option>1985</option>
										<option>1986</option>
										<option>1987</option>
										<option>1988</option>
										<option>1989</option>
										<option>1990</option>
										<option>1991</option>
										<option>1992</option>
										<option>1993</option>
										<option>1994</option>
										<option>1995</option>
										<option>1996</option>
										<option>1997</option>
										<option>1998</option>
									</select><span id="e1"></span></br>
									<label>Gender: <span style="color:red">*</span></label>
									<input type="radio" name="gender" class="gender" value="Male" required >Male
									<input type="radio" name="gender" class="gender" value="Female" required >Female<span id="e5"></span></br>
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
									</select><span id="e2"></span></br>
									<label for="weight">Weight: <span style="color:red">*</span></label>
									<input type="number" name="weight" id="weight" maxlength="3" size="3" placeholder="Kgs" required />
									<span style="font-size:11px">(should be above 50 kg).</span><span id="e3"></span></br>
									<label for="remark">Remarks:</label>
									<textarea id="remark" rows="5" cols="20" name="remarks" ></textarea>
								</p>
						</fieldset></br>
						<fieldset class="rgister_info">
							<legend style="color:blue"><h4><img src="images/contact.gif"/> Contact Details</h4></legend>
								<p>
									<p>Phone Number</p>
									<label for="residentPno">-Residence Phone: <span style="color:red" >*</span></label>
									<input type="tel" name="residentPno" id="residentPno"  maxlength="10" size="20" placeholder="011xxx" onkeyup= "numbersOnly(this) "required /></br>
									<label for="mobileNo">-Mobile No: <span style="color:red">*</span></label>
									<input type="tel" name="mobileNo" id="mobileNo"  maxlength="10" size="20" placeholder="07xxxx" onkeyup= "numbersOnly(this)" required /></br>
									<label for="email">Email: <span style="color:red">*</span></label>
									<input type="email" name="email" id="email" placeholder="name@example.com" required onblur="javascript:find_email();"/>
									<span id="meg1"></span></br>
									<label for="address">Present Address: <span style="color:red">*</span></label>
									<input type="text" name="address" id="address"  size="20" placeholder="Address" required /></br>
									<label for="District">District: <span style="color:red">*</span></label>
									<select name="district" id="district"  >
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
						</fieldset></br>
						<div>
							<input type="checkbox" name="agree" id="checkbox" value="agree" required /><span id="p"> I hereby assure that 
								I have voluntarily come forward and register 
								my name in the Donor Registry.
							</span><span style="color:red">*</span></br>
							<span id="e4"></span></br></br>
						</div>
						<input type="submit" value="Register Now" id="button" class="regi_butn">
					</form>
				</article>
			</section>
			<?php include'include/overall/footer.php';?>
		</div>
	</body>
</html>
<?php require 'core/int.php';?>
<?php include 'include/login.php'; ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>FAQ</title>
		<link rel="stylesheet" href="css/main.css" />
		<script src="script/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="script/popup.js"></script>
		<script src="script/faq.js"></script>
		<script type="text/javascript" src="script/userprofile.js"></script>
	</head>
	<body class="bg">
		<div id="main_container">
			<?php include'include/overall/header.php';?>
			<nav id="top_menu">
				<ul>
					<li><a href="index">Home</a></li>
					<li><a href="blood_bank">Blood Bank</a></li>
					<li><a href="find_donor">Find Donor</a></li>
					<?php if(isAdmin($session_userId)=== false){echo '<li><a href="request">Request Blood</a></li>';}?>
					<li><a href="stories">Stories</a></li>
					<li><a href="faq" class="current">FAQ</a></li>
					<li><a href="about us">About us</a></li>
					<li><a href="contact">Contact</a></li>
				</ul>
			</nav>
			<?php include'include/overall/no_script.php'?>
			<section id="section">
				<article>
					<h2 style="padding:10px">Frequently Asked Questions</h2>
					<div class="faq">
						<h4>01) Who can give blood?</h4>
						<p>Most people can give blood. If you are generally in good health, 
						age 18 to 65 (if it's your first time) and weigh at least 50kg (7st 12Ib) you can donate. 
						However, If you are female, aged under 20 years old and weigh under 65kg (10st 3lb) and are under 168cm (5'6) in height, 
						we need to estimate your blood volume before donating.</p>
						<h4>02) How often can I give blood?</h4>
						<p>Male donors can donate 4 times in 12 months with a minimum interval of 12 weeks between donations. 
						We advise female donors to donate at an average of 16 weeks or more to reduce the risk of iron deficiency.</p>
						<h4>03) How much blood will be taken?</h4>
						<p>Only about 470ml, which is just under a pint. 
						Your body will replace the lost fluid in a very short period of time.</p>
						<h4>04) How long does it take to donate blood?</h4>
						<p>No more than one hour</p>
						<h4>05) How will giving blood affect my health?</h4>
						<p>If you are fit and healthy, you should not experience any problems whatsoever.</p>
						<h4>07) Why can women donate less frequently than men?</h4>
						<p>Female donors do not have the same levels of stored iron as male donors for lots of reasons. 
						This means that they cannot donate as often as their male counterparts as to do so could potentially put them at risk of anaemia and NHSBT will never risk the health of donors.</p>
						<h4>07) Is it safe for men to donate more frequently?</h4>
						<p>Male donors who give a whole blood donation can safely donate four times a year, as long as they wait twelve weeks between donations. This allows them to improve the lives of thousands more people every year! Allowing male whole blood donors to donate more often is a great step forward in meeting the 8,000 units needed every day to meet hospital demands.</p>
						<h4>08) DO NOT donate blood, if you have any of the following conditions.</h4>
						<p>
						<img src="images/dont_img.png" />&nbsp; <span>Under treatment with antibiotics or any other medication.</span></br>
						<img src="images/dont_img.png" />&nbsp; <span>Cold/fever in the past one week.</span></br>
						<img src="images/dont_img.png" />&nbsp; <span>Cardiac problems, hypertension, epilepsy, diabetes (on insulin therapy), history of cancer, chronic kidney or liver disease, bleeding tendencies, venereal disease etc.</span></br>
						<img src="images/dont_img.png" />&nbsp; <span>Major surgery in the last 6 months.</span></br>
						<img src="images/dont_img.png" />&nbsp; <span>Vaccination in the last 24 hours.</span></br>
						<img src="images/dont_img.png" />&nbsp; <span>Had a miscarriage in the last 6 months or have been pregnant / lactating in the last one year.</span></br>
						<img src="images/dont_img.png" />&nbsp; <span>Had fainting attacks during last donation.</span></br>
						<img src="images/dont_img.png" />&nbsp; <span>Have regularly received treatment with blood products.</span></br>
						<img src="images/dont_img.png" />&nbsp; <span>Shared a needle to inject drugs/ have history of drug addiction.</span></br>
						<img src="images/dont_img.png" />&nbsp; <span>Had sexual relations with different partners or with a high risk individual.</span></br>
						<img src="images/dont_img.png" />&nbsp; <span>Been tested positive for antibodies to HIV.</span></br>
						</p>
					</div>
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
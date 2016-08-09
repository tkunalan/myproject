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
		<script type="text/javascript" src="script/userprofile.js"></script>
	</head>
	<body class="bg">
		<div id="main_container">
			<?php include 'include/overall/header.php';?>
			<nav id="top_menu">
				<ul>
					<li><a href="index" class="current">Home</a></li>
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
			<section id="section">
				<div id="banner">
					<header>
						<hgroup>
							
							<h2 id="h2Heading"><script> loopTimer; frameLooper(); </script></h2>
							<h3>You can be registered donors on OnlineBloodBank</h3>
						</hgroup>
					</header>
					<img style="float:left; margin:5px;"src="images/hand.png" /> 
					</br><p>Blood is universally recognized as the most precious element that sustains life.</p></br><p>The need for blood is great - on any given day, 
					approximately 39,000 units of Red Blood Cells are needed. More than 29 million units of blood components are transfused every year.</p>
				</div>
				<article style="width:310px;float:left;height:192px;margin-top:0px;">
					<header>
						<hgroup>
							<h3>Do You Know..?</h3>
						</hgroup>
					</header></br>
					<div id="wss">
						
					</div>
					<script> wss_elem = document.getElementById("wss"); wssSlide();</script>
				</article>
				<article style="width:310px;float:left;margin-top:0px;">
					<?php  if(loggedIn() === false){
				echo
				'<div>
					<h3 style="text-align:center;font-weight:bold">Saving lives is quick & easy with a donor account!</h3></br>
					<h4>It also has the following benefit:</h4>
					<p style="line-height:30px"><img src="images/list.png" /> Be reminded when to give blood</p></br>
					<a href="register" ><img style="cursor:hand;margin-left:25px;" src="images/register.jpg" /></a>
				</div>';
				}
				?>
				</article>
				
				<?php
				$sql = "SELECT * FROM stories ORDER BY rand() LIMIT 2";
				$query = mysqli_query ($db, $sql);
				while($row = mysqli_fetch_array($query, MYSQL_ASSOC)){ ?>
					<article class="story_in_main">
						<div class="sty_body">
							<span><img src="<?php echo $row['profile'];?>"/></span>
							<img src="images/quote.png" class="quart" /></br>
							<h5><?php echo $row['title']; ?></h5></b></br>
							<p><?php echo  $row['userName']; ?></p>
						</div>
						<hr>
						<div class="sty_link">
							<a href="stories.php">Read <?php echo $row['userName']?>'s story</a>
						</div>
					</article>
					
				<?php }?>
				
			</section>
			<aside id="right">
				<article>
					<?php include 'include/wedgets/asidelogin.php';?>
				</article>
				<?php  
				if(loggedIn() === false){
					echo
					'<article class="resent">
					<header>
						<h4 class="ahs">Resent Updates</h4>
					</header>
					<p>';?><?php echo registeredUsers()?><?php echo '<p>
					<p style="float:right;margin:10px 5px 5px 5px;"><a style="text-decoration:none;" href="find_donor">find more >></a></p>
				</article>';
				}?>
				<article><h4 class="uph" id="bloodStock" title="Click to view">Blood Stock</h4></article>
				<article class="bc">
					<h4 class="ahs">Blood Donation Camps</h4>
					<marquee  scrollamount="2" scrolldelay="0" direction="up" loop="true" onmouseover="this.stop();" onmouseout="this.start();">
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
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
					<li><a href="stories" class="current">Stories</a></li>
					<li><a href="faq">FAQ</a></li>
					<li><a href="about us">About us</a></li>
					<li><a href="contact">Contact</a></li>
				</ul>
			</nav>
			<?php include'include/overall/no_script.php'?>
			<section id="section">
				<article>
					<h2 style="padding:10px">Stories</h2>
					<div id="posted_stories1">Loading... <img src="images/loading.gif"/></div></br>
					<?php if(loggedIn()=== true){?></br>
					<div id="story_container">
						<span id="mgs"></span>
						<form method="post" id="post_story">
							<img src="<?php echo $userData['profile'];?>" alt="<?php echo $userData['userName'];?>" title="<?php echo $userData['userName'];?>"/> 
							<input  type="text" name="title" size="50" maxlength="50" id="title" required placeholder="Title of the story"/>
							<textarea rows="5" cols="50" name="body" id="body"></textarea></br>
							<input type="hidden" name="by_id" value="<?php echo $session_userId;?>" />
							<input type="hidden" name="by_un" value="<?php echo $userData['userName'];?>" />
							<input type="hidden" name="profile" value="<?php echo $userData['profile'];?>" />
							<input type="submit" value="Post"/>
						</form>
					</div>
					<?php }else echo "<p class='forgot'>Login to post.</p>";?>
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
			<div id="editStoryBox">
				<button class="cls_edt" style="float:right;">X</button></br>
				<span id="Status"></span>
				<form  id="editStory" name="editStory" method="post" action="">
					<img src="<?php echo $userData['profile'];?>" alt="<?php echo $userData['userName'];?>" title="<?php echo $userData['userName'];?>"/> 
					<input  type="text" name="editTitle" size="55" id="editTitle" required placeholder="Title of the story"/>
					<textarea rows="5" cols="55" name="editBody" id="editBody"></textarea></br>
					<input type="hidden" name="editId" id="editId"/>
				</form>
				<button onclick ="processEditStory()">Post</button>
			</div>
			<?php include'include/overall/pop_up.php';?>
			<?php include'include/overall/footer.php';?>
		</div>
	</body>
</html>
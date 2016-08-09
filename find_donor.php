<?php
require 'core/int.php';
include 'include/login.php';
$rpp = $_POST['rpp'];
$bg = $_POST['bdGroup'];
$dis = $_POST['district'];
//$db = new mysqli('localhost' , 'root' , 'root' ,'mydb');
// This first query is just to get the total count of rows
	if ($_POST['bdGroup'] && $_POST['district'] && $_POST['rpp']){
		$sql = "SELECT COUNT(user_login.id) 
		FROM user_login, user_information, user_contact 
		WHERE user_information.id = user_contact.id AND user_contact.id = user_login.id 
		AND user_information.bloodGroup = '$bg' 
		AND user_contact.district = '$dis' 
		AND user_login.accountActive = 1";
	}else{
		$sql = "SELECT COUNT(user_login.id) 
		FROM user_login, user_information, user_contact 
		WHERE user_information.id = user_contact.id
		AND user_contact.id = user_login.id
		AND accountActive = 1";
		}
	$query = mysqli_query($db, $sql);
	$row = mysqli_fetch_row($query);
// Here we have the total row count
	$rows = $row[0];
// This is the number of results we want displayed per page
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$page_rows =$rpp;
	}else{
		$page_rows =6;
	}
// This tells us the page number of our last page
	$last = ceil($rows/$page_rows);
// This makes sure $last cannot be less than 1
	if($last < 1){
		$last = 1;
	}
// Establish the $pagenum variable
	$pagenum = 1;
// Get pagenum from URL vars if it is present, else it is = 1
	if(isset($_GET['pn'])){
		$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
	}
// This makes sure the page number isn't below 1, or more than our $last page
	if ($pagenum < 1) { 
		$pagenum = 1; 
	} else if ($pagenum > $last) { 
		$pagenum = $last; 
	}
// This sets the range of rows to query for the chosen $pagenum
	$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
// This is your query again, it is for grabbing just one page worth of rows by applying $limit
	if ($_POST['bdGroup'] && $_POST['district'] && $_POST['rpp']){
		$sql = "SELECT userName,firstName, bloodGroup, district
		FROM user_information, user_contact, user_login
		WHERE user_information.id = user_contact.id
		AND user_contact.id = user_login.id
		AND user_information.bloodGroup = '$bg'
		AND user_contact.district = '$dis'
		AND user_login.accountActive = 1
		ORDER BY user_information.id DESC $limit";

	}else{
		$sql = "SELECT userName,firstName, bloodGroup, district, userName
		FROM user_information, user_contact, user_login
		WHERE user_information.id = user_contact.id
		AND user_contact.id = user_login.id
		AND accountActive = 1
		ORDER BY user_information.id DESC
		$limit";
	}
	$query = mysqli_query($db, $sql);
// This shows the user what page they are on, and the total number of pages
	$textline1 = "Results (<b>$rows</b>) Found. ";
	$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
// Establish the $paginationCtrls variable
	$paginationCtrls = '';
// If there is more than 1 page worth of results
	if($last != 1){
	
		if ($pagenum > 1) {
			$previous = $pagenum - 1;
			$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';
		// Render clickable number links that should appear on the left of the target page number
			for($i = $pagenum-4; $i < $pagenum; $i++){
				if($i > 0){
					$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
				}
			}
		}
		// Render the target page number, but without it being a link
		$paginationCtrls .= ''.$pagenum.' &nbsp; ';
		// Render clickable number links that should appear on the right of the target page number
		for($i = $pagenum+1; $i <= $last; $i++){
			$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
			if($i >= $pagenum+4){
			break;
			}
		}
		// This does the same as above, only checking if we are on the last page, and then generating the "Next"
		if ($pagenum != $last) {
			$next = $pagenum + 1;
			$paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a> ';
		}
	}
	$list = '';
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		$firstName = $row['firstName'];
		$district = $row['district'];
		$bloodGroup = $row['bloodGroup'];
		$userName = $row['userName'];
		 $list .= 
		'<table width="200" border="1" align="center">
			<tr>
				<th>FirstName</th>
				<th>Blood group</th>
				<th>District</th>
				<th>Contact</th>
			</tr>
			<tr>
				<td>'.$firstName.'</td>
				<td style="color:red">'.$bloodGroup.'</td>
				<td>'.$district.'</td>
				<td><a href="request">Click</a></td>
			</tr>
		</table>';
	}
// Close your database connection
//mysqli_close($db_conx);
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
	</head>
	<body class="bg">
		<div id="main_container">
			<?php include 'include/overall/header.php';?>
			<nav id="top_menu">
				<ul>
					<li><a href="index">Home</a></li>
					<li><a href="blood_bank">Blood Bank</a></li>
					<li><a href="find_donor" class="current">Find Donor</a></li>
					<?php if(isAdmin($session_userId)=== false){echo '<li><a href="request">Request Blood</a></li>';}?>
					<li><a href="stories">Stories</a></li>
					<li><a href="faq">FAQ</a></li>
					<li><a href="about us">About us</a></li>
					<li><a href="contact">Contact</a></li>
				</ul>
			</nav>
			<?php include'include/overall/no_script.php'?>
			<section id="section">
				<article>
					<h2 style="padding:10px">Find Donor</h2>
					<form method="POST" action="" >
						<fieldset class="cpwd_info">
						<legend style="font-weight:bold;color:blue;"><img src="images/donor.png"/><img src="images/placeSearch.png" /> Search Donors</legend>
							<p>
								<label>Blood Group: <span style="color:red">*</span></label>
									<select name="bdGroup" id="bloodG"  >
										<option value="0">ALL</option>
										<option>A+</option>
										<option>A-</option>
										<option>B+</option>
										<option>B-</option>
										<option>AB+</option>
										<option>AB-</option>
										<option>O+</option>
										<option>O-</option>
									</select></br>
								<label for="District">Select District you want to find: <span style="color:red">*</span></label>
									<select name="district" id="district"  >
										<option value="0">ALL</option>
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
									</select></br>
								<label for="rpp">Result per page:</label>					
									<select name="rpp" id="rpp">
										<option>10</option>
										<option>20</option>
										<option>30</option>
									</select>
							</p>
						</fieldset>
						<input class="cpwd_butn" type="submit" value="Find Donors" />
					</form></br>
					<button style="float:right; margin-right:10px; padding:1px;" onclick="window.location='find_donor.php'" title="Refresh" ><img src="images/refresh_img.png"/></button>
					<img src="images/print_img.png" title="Print" style="float:right; padding-right:5px;cursor:pointer;"onclick="printContent('print');" /></br>
					<div id="donor_result">
						<div id="print">	
							<p><?php if($_SERVER['REQUEST_METHOD'] == "POST"){echo "<p>You have been searched for: Blood group = <b>". $bg."</b> | District = <b>".$dis."</b>.</p>";}?></p>
							<h2><?php if($rows > 0) {echo $textline1;}else {echo "<p class='logErr' style='color:#ffffff;'>Sorry, result not found :(</p>";}?> </h2>
							<p><?php if($rows > 0){echo $textline2;} ?></p>
							<p><?php echo $list; ?></p></br>
						</div>
						<div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
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
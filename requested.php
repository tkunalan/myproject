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
						<a href="message">Message</a><hr>
						<a href="requested" class="curr_link">Blood Requests</a>
						<a href="">Blood Camps</a>
					</div>
				</article>
				
				
			</aside>
			<section id="section">
				<article>
					<?php
					$sql="SELECT * FROM blood_request WHERE requester_id <> 0 ORDER BY id DESC LIMIT 100";

					$query = mysqli_query($db, $sql);

					echo '<button style="float:right; margin-right:5px; padding:2px;" onclick="window.location=\'requested.php\'" title="Refresh" ><img src="images/refresh_img.png"/></button>';
					echo '<h2>Blood request from user</h2>';
					echo '<p id="Status"></p>';
					$res = mysqli_num_rows($query);
					if($res < 1){ echo "</br><p class='logErr'>No request.</p>";
					}else{
					echo '<table width="650" >
								<tr>
									<th>Sender</th>
									<th>Request</th>
									<th>Time</th>
									<th>Delete</th>
								</tr>';

					while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
						$dateTime = $row['time_sent'];	
						$convertedTime = convert_datetime($dateTime);
						$when = makeAgo($convertedTime);
						
						if($row['opened'] == "0"){
								$textWeight = 'msgDefault';
						} else {
								$textWeight = 'msgRead';
						}
					?>	

						<tr>
							<td><a href="profile.php?u=<?php echo $row['contact_name'];?>"><?php echo $row['contact_name'];?></a></td>
							<td width="58%" valign="top">
							<span class="toggle" style="padding:3px;">
						  <a class="<?php echo $textWeight; ?>" style="cursor:pointer;" onclick="requestSeen('<?php echo $row['id']?>')"><?php echo stripslashes('patient: '.$row['patient_name']); ?></a>
						  </span>
						  <div class="hiddenDiv"> 
							<hr style="margin-top:5px; color:#f00"  /><br />
							<?php echo '<p> Blood group: '.$row['request_blood'].'</p></br>
									  <p> District: '.$row['district'].'</p></br>
									  <p> When (y/m/d): '.$row['date_required'].'</p></br>
									  <p> Hospital: '.$row['hospital'].'</p></br>
									  <hr></br>
									  <p> Sender Number: '.$row['contact_number'].'</p></br>
									  <p> Sender Email: '.$row['contact_email'].'</p></br>'; ?>
							</div>
						  </td>
							<td><?php echo $when;?></td>
							<td><img src="images/delete_img.png" style="cursor:pointer;" onclick="requestDelete('<?php echo $row['id']?>')"/></td>
						</tr>
			
						<?php }
						} ?> 
						</table>
					<?php
					$sql="SELECT * FROM blood_request WHERE requester_id = 0 ORDER BY id DESC LIMIT 100";
					$query = mysqli_query($db, $sql);


					echo '</br><h2>Blood request from guest</h2>';
					echo '<p id="Status"></p>';
					$res = mysqli_num_rows($query);
					if($res < 1){ echo "</br><p class='logErr'>No request.</p>";
					}else{
					echo '<table width="650" >
								<tr>
									<th>Sender</th>
									<th>Request</th>
									<th>Time</th>
									<th>Delete</th>
								</tr>';

					while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
						$dateTime = $row['time_sent'];	
						$convertedTime = convert_datetime($dateTime);
						$when = makeAgo($convertedTime);
						
						if($row['opened'] == "0"){
								$textWeight = 'msgDefault';
						} else {
								$textWeight = 'msgRead';
						}
					?>	

						<tr>
							<td><?php echo $row['contact_name'];?></td>
							<td width="58%" valign="top">
							<span class="toggle" style="padding:3px;">
						  <a class="<?php echo $textWeight; ?>" style="cursor:pointer;" onclick="requestSeen('<?php echo $row['id']?>')"><?php echo stripslashes('patient: '.$row['patient_name']); ?></a>
						  </span>
						  <div class="hiddenDiv"> 
							<hr style="margin-top:5px; color:#f00"  /><br />
							<?php echo '<p> Blood group: '.$row['request_blood'].'</p></br>
									  <p> District: '.$row['district'].'</p></br>
									  <p> When (y/m/d): '.$row['date_required'].'</p></br>
									  <p> Hospital: '.$row['hospital'].'</p></br>
									  <hr></br>
									  <p> Sender Number: '.$row['contact_number'].'</p></br>
									  <p> Sender Email: '.$row['contact_email'].'</p></br>'; ?>
							</div>
						  </td>
							<td><?php echo $when;?></td>
							<td><img src="images/delete_img.png" style="cursor:pointer;" onclick="requestDelete('<?php echo $row['id']?>')"/></td>
						</tr>
			
						<?php }
						} ?> 
						</table>
				</article>
			</section>
			<?php include'include/overall/footer.php';?>
		</div>
	</body>
</html>

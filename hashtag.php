<?php
require 'core/int.php';
include 'include/overall/asideprofilepagetop.php';
if(isset($_GET['tag'])){
	
	$tag = preg_replace('#[^a-z0-9_]#i', '', $_GET['tag']);
	echo '<h2 style="padding:10px">hashtag : #'.$tag.'</h2>';

	$sql = "SELECT * FROM stories WHERE title LIKE '%$tag%' AND story LIKE '%$tag%' ORDER BY id DESC";
	$query = mysqli_query($db, $sql);
	$res = mysqli_num_rows($query);
	if($res < 1){echo "</br><p class='logErr'>No much data.</p>";}else{
		while($row = mysqli_fetch_array($query, MYSQL_ASSOC)){
			
		?>
			<div id="posted_stories">
				<div id="story_title">
					<img id="pic" src="<?php echo $row['profile'];?>" alt="profile" />&nbsp;
					<img id="hidden_pic" src="<?php echo $row['profile'];?>" alt="profile" />
					<p><a href="profile.php?u=<?php echo $row['userName'];?>"><?php echo $row['userName'];?></a></p>&nbsp;&nbsp;
					<img src="images/quote.png"/>
					<p><b><?php echo $row['title'];?></b></p>
				</div>
				<p style="padding:10px;font-family:tahoma;"><?php echo $s = preg_replace ('#[^a-zA-Z0-9 ]#i','', $row['story']);?></p>
			</div></br>
<?php
		}
	}
}
include 'include/overall/asideprofilepagebottom.php';
?>

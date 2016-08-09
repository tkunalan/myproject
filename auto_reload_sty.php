<?php
require 'core/int.php';

$sql = "SELECT * FROM stories ORDER BY id DESC";
$query = mysqli_query($db, $sql);

	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
				$dateTime = $row['time'];	
					$convertedTime = convert_datetime($dateTime);
					$when = makeAgo($convertedTime);
	?>
		<div id="posted_stories">
			<div id="story_title">
				<img id="pic" src="<?php echo $row['profile'];?>" alt="profile" />&nbsp;
				<img id="hidden_pic" src="<?php echo $row['profile'];?>" alt="profile" />
				<p><a href="profile.php?u=<?php echo $row['userName'];?>"><?php echo $row['userName'];?></a></p>&nbsp;&nbsp;
				<img src="images/quote.png"/>
				<p><b><?php echo $row['title'];?></b></p>
				<?php if($row['user_id']==$session_userId){?> 
				<img id="del" style="float:right;cursor:pointer;margin:5px;" title="delete" width="15" height="15" src="images/delete_img" onclick="deletePostStory('<?php echo $row['id']?>')"/>
				<img class="edt" style="float:right;cursor:pointer;margin:5px;" title="edit" width="15" height="15" src="images/edit.png" onclick="editPostStory('<?php echo $row['id']?>', '<?php echo $row['title']?>','<?php echo $row['story']?>')"/>
				<?php } ?>
			</div>
			<p style="padding:10px;font-family:tahoma;"><?php echo convertHashtags($row['story']);?></p>
			<?php if($row['edited'] == "1"){echo '<span style="margin-left:13cm;color:#9370db;">Edited&nbsp;&nbsp;&nbsp;'.$when.'</span>';}else {?>
				<span style="margin-left:14.5cm;color:#9370db;"><?php echo $when;?></span>
			<?php }?>
			<?php if(loggedIn()=== true){?>
				<hr style="color:#888888">
				<div style="margin:5px 5px 5px 60px;">
					<?php if(likedBy($session_userId, $row['id']) == true ){ ?>
					<span class="dislike_img"><img class="like" title="unlike" src="images/liked.png" width="20" height="20" onclick="unlikeStory('<?php echo $row['id']?>')"/></span>
					<?php }else{?>
					<span class="like_img"><img class="like" title="like" src="images/like.png" width="20" height="20" onclick="likeStory('<?php echo $row['id']?>')"/></span>
					<?php } ?>
					&nbsp;&nbsp; 
					<p id="swP" ><?php echo countLikes($row['id']);?> pepople<?php if(countLikes($row['id']) > 1){echo 's';}?> like this </p>
					<div id="likesPeople">
						<span><?php echo likePeopleName($row['id']);?></span>
					</div>
				</div>
			<?php } ?>
		</div>
		</br>	
					
<?php } ?>

<?php
	require 'core/int.php';
	protectedPage();
	
$sql="SELECT * FROM private_messages WHERE to_id='$session_userId' AND recipientDelete='0' ORDER BY id DESC LIMIT 100";

$query = mysqli_query($db, $sql);
include 'include/overall/asideprofilepagetop.php';
echo '<button style="float:right; margin-right:5px; padding:2px;" onclick="window.location=\'inbox.php\'" title="Refresh" ><img src="images/refresh_img.png"/></button>';
echo '<h2>'.$userData['firstName'].'\'s Message Inbox</h2>';
echo '<p id="PMStatus"></p>';
$res = mysqli_num_rows($query);
if($res < 1){ echo "</br><p class='logErr'>No messages.</p>";
}else{
echo '<table width="650" >
			<tr>
				<th>Sender</th>
				<th>Message</th>
				<th>Time</th>
				<th>Delete</th>
			</tr>';

while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
	$dateTime = $row['time_sent'];	
	$convertedTime = convert_datetime($dateTime);
	$when = makeAgo($convertedTime);
	$from = $row['from_name'];
	if($row['opened'] == "0"){
		    $textWeight = 'msgDefault';
    } else {
			$textWeight = 'msgRead';
    }
?>	

			<tr>
				<td><?php echo $row['from_name'];?></td>
				<td width="58%" valign="top">
				<span class="toggle" style="padding:3px;">
              <a class="<?php echo $textWeight; ?>" style="cursor:pointer;" onclick="javascript:readMessage(<?php echo $row['id']; ?>)"><?php echo stripslashes($row['subject']); ?></a>
              </span>
              <div class="hiddenDiv"> 
			  <hr style="margin-top:5px; color:#f00"  /><br />
                <?php echo $row['message']; ?>
                </br></br><span style="cursor:pointer;color:blue;"class="rplopen" onclick="javascript:reply_message('<?php echo $row['subject'];?>','<?php echo $row['to_id'];?>','<?php echo $row['to_name'];?>','<?php echo $row['from_id'];?>','<?php echo $row['from_name'];?>')"><b>Reply</b></span>
				</br></br>
			  </div>
			  </td>
				<td><?php echo $when;?></td>
				<td><img src="images/delete_img.png" style="cursor:pointer;" onclick="javascript:deleteMessage(<?php echo $row['id']; ?>)"/></td>
			</tr>
			
<?php }
} ?> 

</table>
<div id="replyBox">
<button class="close" style="cursor:pointer; float:right"><img src="images/cancel_img.png"/></button></br>
<h2>Replying to <span style="color:#4B0082;" id="recipientShow"></span></h2>
Subject: <strong><span style="color:#800000;" id="subjectShow"></span></strong> <br>
<form action="javascript:processReply()" name="replyForm" id="replyForm" method="post">
<textarea id="pmTextArea" rows="8" style="width:98%;"></textarea><br />
<input type="hidden" id="pmSubject" />
<input type="hidden" id="pm_rec_id" />
<input type="hidden" id="pm_rec_name" />
<input type="hidden" id="pm_sender_id" />
<input type="hidden" id="pm_sender_name" />
<input type="hidden" id="pmWipit" />
<br />
<input name="replyBtn" type="submit" class="submit" value="Send" />
</form>
</div>
<?php include 'include/overall/asideprofilepagebottom.php';?>		
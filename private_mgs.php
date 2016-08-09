<?php
require 'core/int.php';
if($_POST['pmSub'] ==""){
echo '<img src="images/round_error.png"> <span style="color:#f00;">Missing Subject</span></br>';
exit();
}
if($_POST['pmMes'] ==""){
echo '<img src="images/round_error.png"> <span style="color:#f00;">Missing Data</span>';
exit();
}
// PREVENT FROM DOUBLE MESSAGES
$checkuserid = $_POST['pmSendId'];
$prevent_dp = mysqli_query($db,"SELECT id FROM private_messages WHERE from_id='$checkuserid' AND time_sent between subtime(now(),'0:0:20') and now()");
$nr = mysqli_num_rows($prevent_dp);
if ($nr > 0){
	echo '<img src="images/round_error.png" alt="Error"  /> &nbsp; <span style="color:#f00;">You must wait 20 seconds between your private message sending.</span>';
	exit();
}
// PREVENT MORE THAN 30 MESSAGES IN ONE DAY BY THIS USER
$sql = mysqli_query($db,"SELECT id FROM private_messages WHERE from_id='$checkuserid' AND DATE(time_sent) = DATE(NOW()) LIMIT 40");
$numRows = mysqli_num_rows($sql);
if ($numRows > 30) {
	echo '<img src="images/round_error.png" alt="Error"  /> &nbsp; <span style="color:#f00;">You can only send 30 Private Messages per day.</span>';
    exit();
}
///////////////////////////////////////////////////////////////////////////
/////////////// Process the message once it has been sent /////////////////
///////////////////////////////////////////////////////////////////////////
  $to = preg_replace('#[^0-9]#i', '', $_POST['pmRecId']); 
  $from = preg_replace('#[^0-9]#i', '', $_POST['pmSendId']);
  $sub = sanatize($_POST['pmSub']);
  $msg = sanatize($_POST['pmMes']);
  $to_name = $_POST['pmRecName'];
  $from_name = $_POST['pmSendName'];
  
  // Delete the message residing at the tail end of their list so they cannot archive more than 100 PMs ------------------
        $sqldeleteTail = mysqli_query($db,"SELECT * FROM private_messages WHERE to_id='$to' ORDER BY time_sent DESC LIMIT 0,100"); 
        $dci = 1;
        while($row = mysqli_fetch_array($sqldeleteTail)){ 
                $pm_id = $row["id"];
				if ($dci > 99) {
					$deleteTail = mysqli_query($db,"DELETE FROM private_msg WHERE id='$pm_id'"); 
				}
				$dci++;
        }
// End delete any comments past 100 off of the tail end -------------  
// INSERT the data into your table now
    $sql = "INSERT INTO private_messages (to_id, to_name, from_id, from_name, time_sent, subject, message) VALUES ('$to','$to_name','$from', '$from_name', now(), '$sub', '$msg')"; 
	mysqli_query($db,$sql);
	 echo '<img src="images/round_success.png" alt="Success" /> &nbsp;<strong style="color:green">Message sent successfully</strong>';
	exit();


















?>
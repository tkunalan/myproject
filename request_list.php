<?php
	require 'core/int.php';
	protectedPage();



/* to find request which sent from registered user */
$sql="SELECT * FROM blood_request WHERE requester_id='$session_userId' AND req_delete='0' ORDER BY id DESC LIMIT 100";

$query = mysqli_query($db, $sql);
include 'include/overall/asideprofilepagetop.php';
echo '<button style="float:right; margin-right:5px; padding:2px;" onclick="window.location=\'request_list.php\'" title="Refresh" ><img src="images/refresh_img.png"/></button>';
echo '<h2>'.$userData['firstName'].'\'s blood request list</h2>';
echo '<p id="Status"></p>';
$res = mysqli_num_rows($query);
if($res < 1){ echo "</br><p class='logErr'>No request.</p>";
}else{
echo '<table width="650" >
		<tr>
			<th>Patent Name</th>
			<th>Blood group</th>
			<th>Date required</th>
			<th>Time</th>
			<th>Status</th>
			<th>Delete</th>
		</tr>';

while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
	$dateTime = $row['time_sent'];	// store in local veriable
	$convertedTime = convert_datetime($dateTime); // user define function.
	$when = makeAgo($convertedTime);// display 'ago' format.
  ?>
		<tr>
			<td><?php echo $row['patient_name'];?></td>
			<td><?php echo $row['request_blood'];?></td>
			<td><?php echo $row['date_required'];?></td>
			<td><?php echo $when;?></td>
			<td><?php if($row['opened']=="1"){echo "seen";}else{echo "not seen";}?></td>
            <td><img src="images/delete_img.png" style="cursor:pointer;" onclick="deleteRequestList('<?php echo $row['id'];?>');"/></td>
		</tr>
<?php
	}
echo '</table>';
echo '<span>.</span>';
}
include 'include/overall/asideprofilepagebottom.php';
?>




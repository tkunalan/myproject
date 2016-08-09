<?php
require 'core/int.php';
/******************************************
******* auto username suggestion **********
*******************************************/
	if($_POST['name2suggest']){
		$un = preg_replace('#[^A-Za-z0-9]#i', '', $_POST['name2suggest']);
		
		$query = mysqli_query($db, "SELECT profile, userName
			FROM user_information, user_login
			WHERE user_information.id = user_login.id
			AND userName LIKE  '%$un%'
			AND accountActive = 1
			ORDER BY userName
			AND accountActive =1");
			$user_name_check = mysqli_num_rows($query);

		while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			echo "<option value='".$row['userName']."'>";
		}
	}
/*************************************************
****** check username ****************************
*************************************************/
	if($_POST['name2check']){
		$un = $_POST['name2check'];
		$result = mysqli_query($db, "SELECT UserName FROM user_login WHERE userName='$un' LIMIT 1");
		$user_name_check = mysqli_num_rows($result);

		if(strlen($un)<4){
			echo "<span style='color:red'>4-15 character</span>";
			exit();
		}
		if(is_numeric($un[0])){
			echo "<span style='color:red'>First letter must be character</span>";
			exit();
		}
		if($user_name_check<1){

			echo "<img src='images/round_success.png'/>&nbsp;<span style='color:green'><strong>".$un."</strong> is Available. </span>";
			exit();
		}else{
			echo "<img src='images/round_error.png'/>&nbsp;<span style='color:red'><strong>".$un."</strong> is Taken. </span>";
			exit();
		}
	}
/******************************************************
********** check email address ***********************
*******************************************************/
	if($_POST['email2check']){
		$db = new mysqli('localhost' , 'root' , 'root' ,'mydb');
		$email = $_POST['email2check'];
		$result = mysqli_query($db, "SELECT email FROM user_contact WHERE email='$email' LIMIT 1");
		$email_check = mysqli_num_rows($result);

		if(filter_var($email, FILTER_VALIDATE_EMAIL)===false){
			exit();
		}
		if($email_check<1){
			echo "<img src='images/round_success.png'/>&nbsp;<span style='color:green'><strong>is Available.</strong></span>";
			exit();
		}else{
			echo "<img src='images/round_error.png'/>&nbsp;<span style='color:red'><strong>is Taken.</strong></span>";
			exit();
		}
	}
/***********************************************************************************************************
********************************** Blood Requests **********************************************************
*************************************************************************************************************/
//----------------------------------------------------------------------------------------------------------
/* ************************************************* 
*** update blood_request opened='1' ajax request ***
****************************************************/
	if($_POST['bld_req_adm_seen_id']){
		$id = $_POST['bld_req_adm_seen_id'];
		$sql = "UPDATE blood_request SET opened ='1' WHERE id = $id";
		$query=mysqli_query($db,$sql);
	}/* end here */

/* ************************************************* 
*** blood request admin delete ajax request ********
****************************************************/
	if($_POST['bld_req_adm_del_id']){
		$id = $_POST['bld_req_adm_del_id'];
		$sql = "DELETE FROM blood_request WHERE id = $id";
		$query=mysqli_query($db,$sql);
		echo "1";
	}/* end here */
	
/* ************************************************* 
*** this comes from request delete ajax request ****
****************************************************/	
	if($_POST['bld_req_Del_id']){
	$id = $_POST['bld_req_Del_id'];
	$sql = "UPDATE blood_request SET req_delete ='1' WHERE id = $id";
	$query=mysqli_query($db,$sql);
	echo "1";
	}/* end here */
	
/***********************************************************************************************************
********************************** Private messages **********************************************************
*************************************************************************************************************/
//----------------------------------------------------------------------------------------------------------
/* ************************************************* 
*** private message delete ajax request ************
****************************************************/
	if($_POST['pvt_mgs_del_id']){
	$id = $_POST['pvt_mgs_del_id'];
	$sql = "UPDATE private_messages SET recipientDelete='1' WHERE id = $id";
	$query=mysqli_query($db,$sql);
	echo "1";
	}/* end here */
	
/* ************************************************* 
*** private message read ajax request ************
****************************************************/
	if($_POST['pvt_mgs_rd_id']){
		$id = $_POST['pvt_mgs_rd_id'];
		$sql = "UPDATE private_messages SET opened='1' WHERE id = $id";
		$query=mysqli_query($db,$sql);
	}

/***********************************************************************************************************
********************************** stories **********************************************************
*************************************************************************************************************/
//----------------------------------------------------------------------------------------------------------
/* ************************************************* 
*** story delete by user ajax request ************
****************************************************/
	if($_POST['del_pos_sty_id']){
		global $session_userId;
		$id = $_POST['del_pos_sty_id'];
		if(countLikes($id) > 0){
			$sql = "DELETE stories, likes 
					FROM stories, likes 
					WHERE stories.user_id = $session_userId 
					AND stories.id = $id 
					AND likes.story_id = $id";
			$query=mysqli_query($db,$sql);
			echo "1";
		}else{
			$sql = "DELETE  
					FROM stories
					WHERE stories.user_id = $session_userId 
					AND stories.id = $id";
			$query=mysqli_query($db,$sql);
			echo "1";
		}
	}
/* ************************************************* 
*** story update by user ajax request ************
****************************************************/
	if($_POST['edt_id'] or $_POST['edt_title'] && $_POST['edt_story']){
		global $session_userId;
		$id = (int)$_POST['edt_id'];
		$eT = sanatize($_POST['edt_title']);
		$eS = sanatize($_POST['edt_story']);
		if(empty($eT) or empty($eS)){
			
			echo "<span class='logErr'>empty story</span>";
			exit();
		
		}else{
		
			$sql = "UPDATE stories SET title= '$eT', story = '$eS', time = now(), edited = '1' WHERE id= $id AND user_id = $session_userId";
			$query=mysqli_query($db,$sql);
			echo "1";
		}
	}
/* ************************************************* 
*** story like by user ajax request ************
****************************************************/
	if($_POST['sty_id']){
		global $session_userId;
		$sty_id = (int)$_POST['sty_id'];
		
			$sql = "INSERT INTO likes (story_id,user_id)
						SELECT $sty_id, $session_userId
						FROM stories 
						WHERE EXISTS (
						SELECT id 
						FROM stories
						WHERE id = $sty_id 
						)
						AND NOT EXISTS(
						SELECT id 
						FROM likes
						WHERE story_id = $sty_id 
						AND user_id = $session_userId
						)
						LIMIT 1";
			mysqli_query($db,$sql);
			echo "1";
		
	}
/*INSERT INTO likes (story_id,user_id)
						SELECT 1, 1
						FROM likes
						WHERE  NOT EXISTS(
						SELECT id 
						FROM likes
						WHERE story_id = 1
						AND user_id = 1
						)
						LIMIT 1*/
/* ************************************************* 
*** story unlike by user ajax request ************
****************************************************/
	if($_POST['unlike_sty_id']){
		
		global $session_userId;
		$sty_id = (int)$_POST['unlike_sty_id'];
		$sql = "DELETE FROM likes WHERE story_id = $sty_id AND user_id = $session_userId";
		mysqli_query($db,$sql);
		echo "1";
		
	}
	
	if($_POST['bld_details']){
		$id = (int)$_POST['bld_details'];
		$sql = "SELECT * FROM blood_camps WHERE id = $id";
		$query = mysqli_query($db, $sql);
			$list .= '<table>';
		while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		$locationString = $row['camp_venue'];
	$list.= '<tr>
			  <td><b>Blood Bank</b></td>
			  <td>'.$row['blood_bank'].'</td>
			</tr>
			<tr>
			  <td><b>Date & Time of the Camp</b></td>
			  <td>'.$row['camp_time'].'</td>
			</tr>
			<tr>
			  <td><b>Venue of the Camp</b></td>
			  <td>'.$row['camp_venue'].'</td>
			</tr>
			<tr>
			  <td><b>Name of the Organizer</b></td>
			  <td>'.$row['organizer'].'</td>
			</tr>
			<tr>
			  <td><b>Organizer Contact No</b></td>
			  <td>'.$row['contact'].'</td>
			</tr>
			<tr>
			  <td><b>Camp\'s Map</b></td>
			  <td><iframe width="150" height="150" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q='.$locationString.'&key=AIzaSyCbnOkIVD3KHjAr1vbFtW0krAMjz858qQs"></iframe></td>
			</tr>';
		
			}
	echo	$list .= '</table>';
	}
?>
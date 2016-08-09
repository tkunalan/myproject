<?php
 require 'core/int.php';

 $reuester_id = $session_userId;
 $pname = $_POST['pname'];
 $req_blood = $_POST['bdGroup'];
 $hospital = $_POST['Hna'];
 $day = $_POST['day'];
 $month = $_POST['month'];
 $year = $_POST['year'];
 $contact_nm = $_POST['cname'];
 $contact_email = $_POST['ce'];
 $contact_number = $_POST['cn'];
 $dis = $_POST['district'];
 
 foreach($_POST as $post){
     if(empty($post)){
		echo "<p class='errors'><img src='images/round_error.png' /> Fill the required feilds.</p>";
		
		exit();
	 }
 }

 if(preg_match("/\\s/",$pname)==true){
		echo "<p class='errors'><img src='images/round_error.png' /> Patient name must not contain any spaces.</p>";
		echo "<script>$('#pname').focus()</script>";
		echo "<script>$('#pname').css('border-color','#CD5C5C')</script>";
		exit();
 }
 if(!checkdate($month,$day,$year)){
		echo "<p class='errors'><img src='images/round_error.png' /> Selected date is not valid.</p>";
		echo "<script>$('#day').focus()</script>";
		echo "<script>$('#day').css('border-color','#CD5C5C')</script>";
		exit();
	}
 if(loggedIn()===true && $contact_nm != $userData['userName']){
		echo "<p class='errors'><img src='images/round_error.png' /> Your username is required.</p>";
		echo "<script>$('#cname').focus()</script>";
		echo "<script>$('#cname').css('border-color','#CD5C5C')</script>";
		exit();
}
if(loggedIn()===true && $contact_email != $userData['email']){
		echo "<p class='errors'><img src='images/round_error.png' /> Registered email is required.</p>";
		echo "<script>$('#ce').focus()</script>";
		echo "<script>$('#ce').css('border-color','#CD5C5C')</script>";
		exit();
}
if(loggedIn()=== false && !($contact_number[0]==0)){
		echo "<p class='errors'><img src='images/round_error.png' /> Enter valid mobile number.</p>";
		echo "<script>$('#cn').focus()</script>";
		echo "<script>$('#cn').css('border-color','#CD5C5C')</script>";
		exit();
}
if(loggedIn()===true && $contact_number != $userData['mobileNo']){
		echo "<p class='errors'><img src='images/round_error.png' /> Registered mobile number is required.</p>";
		echo "<script>$('#cn').focus()</script>";
		echo "<script>$('#cn').css('border-color','#CD5C5C')</script>";
		exit();
}
	else{
		
		$dob = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
		bloodRequest($reuester_id, $pname, $req_blood, $hospital, $dob, $contact_nm, $contact_email, $contact_number, $dis);
		echo "1";
	}


?>
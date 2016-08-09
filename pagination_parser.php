<?php

	
	$bg = $_POST['bdGroup'];
	$dis = $_POST['district'];
	$db = new mysqli('localhost' , 'root' , 'root' ,'mydb');
	// This first query is just to get the total num of rows.
	$sql = "SELECT COUNT(user_login.id) 
			FROM user_login, user_information, user_contact 
			WHERE user_information.id = user_contact.id AND user_contact.id = user_login.id 
			AND user_information.bloodGroup = 'B+' 
			AND user_contact.district = 'Jaffna' 
			AND user_login.accountActive = 1";
	$s = mysqli_query($db,$sql);
	$row = mysqli_fetch_row($s);
	// Here we count total rw count
	$total_rows = $row[0];
	// This is the number of results we want display per page
	$page_rows = 1; 
	// This tells us the page number of last page
	$last = ceil($total_rows/$page_rows);
	// This makes sure $last con not be less than 1
	if($last < 1){
		$last = 1;
	}
	// Establish the $pagenum variable
	$pagenum = 1;
	// Get $pagenum from URL variable if it is present, else it is = 1
	if(isset($_GET['pn'])){
		$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
	}
	// This makes sure the page number is not below 1, or more than $last page
	if($pagenum < 1){
		$pagenum = 1;
	}else if($pagenum > $last){
		$pagenum = $last;
	}
	// This sets set of rows to query for the chosen $pagenum
	$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
	// This is your query again, it is for grabbing just one page worth of rows by applying $limit
	$sql = "SELECT firstName, bloodGroup, district
			FROM user_information, user_contact, user_login
			WHERE user_information.id = user_contact.id
			AND user_contact.id = user_login.id
			AND user_information.bloodGroup = 'B+'
			AND user_contact.district = 'Jaffna'
			AND user_login.accountActive = 1
			ORDER BY user_information.id ASC $limit";
	$query = mysqli_query($db,$sql);

	// This shows the user what page they are on, and the total number of pages
	$textline1 = "Record found (<b>$total_rows</b>)";
	$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
	// Establish $paginationCtrls variable
	
	$paginationCtrls = "";
	if($last != 1){
		if($pagenum > 1){
			$previous = $pagenum - 1;
			$paginationCtrls = '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';
			// Render clickable numbers links left side
			for($i= $pagenum-4; $i < $pagenim; $i++){
				if($i > 0){
					$paginationCtrls = '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
				}
			}
		}
		// Render the target page number without link
		$paginationCtrls .= ''.$pagenum.' &nbsp; ';
		// Render clickable numbers links right side
		for($i=$pagenum+1; $i <= $last; $i++){
			$paginationCtrls = '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
			if($i >= $pagenum+4 ){
				break;
			}
		}
		// The "NEXT" link
		if($pagenum != $last){
			$next = $pagenum+1;
			$paginationCtrls = ' &nbsp; &nbsp; <a href=ajaxpageexample.php?pn='.$next.'>Next</a> ';
		}
	}

	 $list="";
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		$firstName = $row['firstName'];
		$district = $row['district'];
		$bloodGroup = $row['bloodGroup'];
		 $list .= "<p>First name = " .$firstName. " | District = " .$district. " | Blood group = " .$bloodGroup."</p>";
	}

	 echo 'You have been searched for: Blood group - <b>'.$bg.'</b> District - <b>'.$dis.'</b>.';
			 echo $textline1;
		echo $textline2;
			echo $list; 
			 echo $paginationCtrls;
	
	
	
	
	
	

//mysqli_close($db);
?>
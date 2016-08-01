<?php
include ("config.php");
$utype=$_SESSION['usertype'];
	if($_SESSION['usertype']=="admin")
	{
		$page="adminhome.php";
		
	}
	elseif($_SESSION['usertype']=="manager")
	{
		$page="managerhome.php";
		
	}
	
	?>
   


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

<div class="box-header well" data-original-title>
      <a class="btn btn-success" href="<?php echo $page; ?>?pg=staff.php&option=view&report=staff"><i class="icon-zoom-in icon-white"></i> Staff Details</a>
      <a class="btn btn-success" href="<?php echo $page; ?>?pg=elders details.php&option=view&report=elders"><i class="icon-zoom-in icon-white"></i> Elders Details </a>
      <a class="btn btn-success" href="<?php echo $page; ?>?pg=salary.php&option=view"><i class="icon-zoom-in icon-white"></i> Salary Details </a>
       <a class="btn btn-success" href="<?php echo $page; ?>?pg=sponsor registration.php&option=view&report=sponsor"><i class="icon-zoom-in icon-white"></i> sponsor Details </a>
 </div>
</body>
</html>
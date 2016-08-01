<?php

include ("config.php");
//session_start();
$username=$_SESSION['username'];
$usertype=$_SESSION['usertype'];


if($usertype=="admin")
{
	$page="adminhome.php";
}
elseif($usertype=="manager")
{
	$page="managerhome.php";
}
elseif($usertype=="clerk")
{
	$page="clerkhome.php";
}
elseif($usertype=="ward-incharge")
{
	$page="wardincharhome.php";
}
elseif($usertype=="sponsor")
{
	$page="sponsorhome.php";
}
elseif($usertype=="doctor")
{
	$page="doctorhome.php";
}

	?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script> 
function goback()
{
	var n=history.length;
	window.history.back(-n);
}
		</script>
</head>

<body>

<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <?php
						$userId=$_SESSION['username'];
						$type=$_SESSION['usertype'];
						if($type=="sponsor")
						{
							$sql="SELECT * FROM sponsor WHERE user_id='$userId'";
						$result=mysql_query($sql);
						$row=mysql_fetch_assoc($result);
						$nam=$row['name'];
						$snam=substr($nam, 0, 8);
						?>
						<?php	echo "<img width='40' height='40' src='photos/". $row['photo']."'>" ;?><span class="hidden-phone"> <?php echo $snam;?>(Sponsor)</span>
						<span class=""></span>
                        <?php
						}
						else
						{
						$sql="SELECT * FROM staff WHERE user_id='$userId'";
						$result=mysql_query($sql);
						$row=mysql_fetch_assoc($result);
						$name=$row['name'];
						$sname=substr($name, 0, 6);
						
						$sql1="SELECT branch_name FROM branch WHERE branch_id='$row[branch_id]'";
						$result1=mysql_query($sql1);
						$row1=mysql_fetch_assoc($result1);
						?>
				<?php	echo "<img width='40' height='40' src='photos/". $row['photo']."'>" ;?><span class="hidden-phone"></span> <?php echo $sname; echo "(";echo $row1['branch_name']; echo ")"." / ".$type; ?></span>
						
                        <?php
						}
						?>
					</a>
					<ul class="dropdown-menu">
                   <?php if($usertype=="sponsor")
						{?>
						<li><a href="sponsorhome.php?pg=sponsor%20profile.php&option=view">Profile</a></li>
						<li class="divider"></li>
						<li><a href="logout.php" onClick="goback()">Logout</a></li>
						<?php }  
						
                        				
						 else 
						{ ?>
						<li><a href="<?php echo $page; ?>?pg=profile.php&option=view">Profile</a></li>
						<li class="divider"></li>
						<li><a href="logout.php" onClick="goback()">Logout</a></li>
						<?php 
						}
						?>
					</ul>
				</div>
				<!-- user dropdown ends --><!--/.nav-collapse -->
	        <p align="center"><img src="img/web-heading.png"  alt=""/></p>
            </div>
		</div>
	</div>
	<!-- topbar ends -->


</body>
</html>
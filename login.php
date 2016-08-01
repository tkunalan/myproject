<?php
ob_start();
?>
<script>
// function for password
function password()
{
	var str = document.getElementById("txtpassword").value;
	var res = str.length; 
	if(res>6)
	{
		return true;
	}
	else
	{
			alert("enter more than 6 character password");
			document.getElementById("txtpassword").value="";		
			return false;
	}
	
}
</script>

<?php
	include ("config.php");//include database connection
	//session_start();
		if(isset($_SESSION['username']) )
{		echo '<script>window.location.assign("index.php")</script>';
	//header("location:index.php");
	}
	else
	{
	$msg="Please login with your Username and Password.";
	if(isset($_POST['login']))
	{
		
			$userId   = $_POST['txtusername'];//get userid from the form
			$password = $_POST['txtpassword'];//get password from the form
	
		$sql1 = "SELECT * FROM user WHERE user_id  = '$userId' AND password = '$password'";//connect with user table userid and password

		$result = mysql_query($sql1) or die('Query failed. ' . mysql_error());
		$sql2 = "SELECT * FROM user WHERE user_id  = '$userId'";
		

		$result2 = mysql_query($sql2) or die('Query failed. ' . mysql_error());
	$row2 = mysql_fetch_assoc($result2);
		if (mysql_num_rows($result) == 1) 
		{
			$row = mysql_fetch_assoc( $result );
			$type=$row['usertype'];
			$_SESSION['username']=$userId;//get username to session
			$_SESSION['usertype']=$type;//get usertype tosession
			$sql2 = "UPDATE user SET attempts=0 WHERE user_id='$userId'";
						$result2=mysql_query($sql2) or die("Error in sql2".mysql_error());
			$sql="SELECT branch_id FROM staff WHERE user_id='$userId'";
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			$_SESSION['branch_id']=$row['branch_id'];
			if ($type==='admin')//check usertype
			{
				//header('location: adminhome.php');
				echo '<script>window.location.assign("adminhome.php")</script>';
		    	exit;
		 	}
			elseif($type==='manager')
			{
				header('location: managerhome.php');
		    	exit;
			}
			elseif($type==='clerk')
			{
				header('location: clerkhome.php');
		    	exit;
			}
			elseif($type==='doctor')
			{
				header('location: doctorhome.php');
		    	exit;
			}
			elseif($type==='pending')
			{
				echo "<script>alert('Your request not accept by admin yet'); window.location.href='index.php'; </script>";
		    	exit;
			}
			elseif($type==='sponsor')
			{
				header('location: sponsorhome.php');
		    	exit;
			}
			elseif($type==='ward-incharge')
			{
				header('location: wardincharhome.php');
		    	exit;
			}
			elseif($type==='Delete')
			{
				echo "<script>alert('You cannot access our system'); window.location.href='logout.php'; </script>";
		    	exit;
			}
		}
		else if($row2['attempts']>=3)//check attempts
		{
			echo "<script> alert('You attempt more than three please give your userID and contact number'); window.location.href='index.php?pg=forget.php';</script>";
		} 
		else // if enter wrong user name or password
		{
			$msg="<font color=#FF0000>Your username or Password incorrect, Please try again</font>";
			$sql2 = "UPDATE user SET attempts=attempts+1 WHERE user_id='$userId'";
						$result2=mysql_query($sql2) or die("Error in sql2".mysql_error());
		}
	}
	?>


<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<title>Elders' Home</title>
	

	<!-- The styles -->
	<link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/charisma-app.css" rel="stylesheet">
	<link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='css/fullcalendar.css' rel='stylesheet'>
	<link href='css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='css/chosen.css' rel='stylesheet'>
	<link href='css/uniform.default.css' rel='stylesheet'>
	<link href='css/colorbox.css' rel='stylesheet'>
	<link href='css/jquery.cleditor.css' rel='stylesheet'>
	<link href='css/jquery.noty.css' rel='stylesheet'>
	<link href='css/noty_theme_default.css' rel='stylesheet'>
	<link href='css/elfinder.min.css' rel='stylesheet'>
	<link href='css/elfinder.theme.css' rel='stylesheet'>
	<link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='css/opa-icons.css' rel='stylesheet'>
	<link href='css/uploadify.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
		
</head>
<body>
		<div class="container-fluid">
		   <div class="row-fluid">
		
			   <div class="row-fluid">
				<div class="span12 center login-header">
					<h2>Pillayar Medi Clinic</h2>
				</div><!--/span-->
			   </div><!--/row-->
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
						<?php echo $msg; ?>
					</div>
                           
					<form class="form-horizontal" action="" method="post">
						<fieldset>
							<div class="input-prepend" title="Username" data-rel="tooltip">
                           								<span class="add-on"><i class="icon-user"></i></span><input name="txtusername" type="text" autofocus required class="input-large span10" id="username" placeholder="username"/>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input name="txtpassword" type="password" required class="input-large span10" id="password" placeholder="password" onBlur="password()"  />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend">
							<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>
							</div>
							<div class="clearfix"></div>
             
                            <div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary" name="login">Submit</button>
							</p>
                            
                     
						</fieldset>
					</form>
                   
                     
					  <p><h4><a href="#" class="btn-setting">forget password </a></h4>  </p>
							
                              <div class="modal hide fade" id="myModal">
			<div class="modal-header">
            
             <button type="button" class="close" data-dismiss="modal">×</button>  <h3>Forget Password</h3></div>
			
					<?php include('forget.php');?>
            			</div>
				</div><!--/span-->
				</div>
			</div><!--/row-->
				
				
			</div>	
            
		
		
		
	

	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<script src="js/jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="js/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="js/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="js/bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="js/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="js/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="js/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="js/jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='js/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='js/jquery.dataTables.min.js'></script>

	<!-- chart libraries start -->
	<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.min.js"></script>
	<script src="js/jquery.flot.pie.min.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>
	<!-- chart libraries end -->

	<!-- select or dropdown enhancer -->
	<script src="js/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="js/jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="js/jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="js/jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="js/jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="js/jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="js/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="js/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="js/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="js/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="js/jquery.history.js"></script>
	<!-- application script for Charisma demo -->
	<script src="js/charisma.js"></script>
	
		
</body>
</html>
<?php
}
?>


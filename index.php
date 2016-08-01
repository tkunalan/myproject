<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<title>New Pillayar Medi Clnic</title>
	
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
	<link rel="shortcut icon" href="img/logo.ico">
		
</head>

<body>
		<!-- topbar starts -->
        
        
	<div class="navbar">
		<div class="navbar-inner">
        
			<div class="container-fluid">
            
             
					<!-- <div class="btn-group pull-right" >
                    
                    <a href="#" class="btn btn-setting btn-round">login </a>
                     <div class="modal hide fade" id="myModal">
			<div class="modal-header">
            
             <button type="button" class="close" data-dismiss="modal">×</button> </div>
            
              
			
				<?php //include('login.php');?>
            			</div>
                   
			    </div>-->
				
                <!--/.nav-collapse --><p align="center" ><img src="img/web-heading.png"  alt="" /></p>
                
            </div>
		</div>
	</div>
    
	<!-- topbar ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Main Menu</li>
                        <?php

        
	if(isset($_SESSION['username']) )
{
	echo "<h3>Welcome to our system</h3>";
$type=$_SESSION['usertype'];
echo "<li>";
if ($type==='admin')
			{
				echo "<a class='ajax-link' href='adminhome.php'><span class='hidden-tablet'><i>Go To My Interface </i></span></a>";
		    	
		 	}
			elseif($type==='manager')
			{
				echo "<a class='ajax-link' href='managerhome.php'><span class='hidden-tablet'><i>Go To My Interface </i></span></a>";
		    	
			}
			elseif($type==='clerk')
			{
				echo "<a class='ajax-link' href='clerkhome.php'><span class='hidden-tablet'><i>Go To My Interface </i></span></a>";
		    	
			}
			elseif($type==='doctor')
			{
				echo "<a class='ajax-link' href='doctorhome.php'><span class='hidden-tablet'><i>Go To My Interface </i></span></a>";
		    	
			}
			
			elseif($type==='sponsor')
			{
				echo "<a class='ajax-link' href='sponsorhome.php'><span class='hidden-tablet'><i>Go To My Interface </i></span></a>";
		    	
			}
			else
			{
				echo "<a class='ajax-link' href='wardincharhome.php'><span class='hidden-tablet'><i>Go To My Interface </i></span></a>";
		    	
			}
			
echo "</li>";
?>
<li><a class="ajax-link" href="logout.php"><i class="icon-edit"></i><span class="hidden-tablet"> Logout</span></a></li>

	<?php
}
else
{
	?>
                        
						<li><a class="ajax-link" href="index.php"><i class="icon-home"></i><span class="hidden-tablet"> Home</span></a></li>
                   <li>  <a href="index.php?pg=login.php" ><i class="icon-lock"></i><span class="hidden-tablet"> Login</span></a>
	<li><a class="ajax-link" href="index.php?pg=aboutus.php"><i class="icon-eye-open"></i><span class="hidden-tablet"> About Us</span></a></li>
						
<li><a class="ajax-link" href="index.php?pg=spres.php&option=new"><i class="icon-pencil"></i><span class="hidden-tablet">Sponsor Registration</span></a></li>
						<li><a class="ajax-link" href="index.php?pg=contact.php"><i class="icon-certificate"></i><span class="hidden-tablet"> Contact Us</span></a></li>
                                                   <?php

}
?>
												
					</ul>

				</div>

				<!--/.well -->
			</div><!--/span-->
     
            
			<!-- left menu ends -->
            
            <noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			
			<?php include("pages.php") ?>
			
			</div>
					
			
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
				
		<hr>

		<footer>
			<p class="pull-left">&copy; <a href="#" target="_blank">Elders Home</a> 2014			</p>
		<p class="pull-right">Powered by: <a href="#">T.Yathavan</a></p>
		</footer>
		
	<!--/.fluid-container-->

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

<?php
	session_start();
	$utype=$_SESSION['usertype'];
	$username=$_SESSION['username'];
	
	if(isset($_SESSION['username']) && $_SESSION['usertype']=='admin')
{
	?>

<!DOCTYPE html>
<html lang="en">
<!--number only-->

<SCRIPT language=Javascript>
       <!--
       function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
       //-->
    </SCRIPT>
	
<!--phone number-->	
	
	<script>
function phonenumber()
{
	var phoneno = /^\d{10}$/;
	if(document.getElementById("txt_contactno").value=="")
	{
	}
	else
	{
		if( document.getElementById("txt_contactno").value.match(phoneno))
		{
			//return true;
			hand();
		}
		else
		{
			alert("Enter 10 digit hand phone start with 07 number");
			document.getElementById("txt_contactno").value="";		
			return false;
		}
	}	 
}
function hand()
{
	var str = document.getElementById("txt_contactno").value;
	var res = str.substring(0,2);
	if(res=="07")
	{
		return true;
	}
	else
	{
		alert("Enter 10 digit hand phone start with 07 number");
		document.getElementById("txt_contactno").value="";		
		return false;
	}
}
</script>


<!--text only-->

<script language="javascript">
       function isTextKey(evt)
       {
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if (((charCode >64 && charCode < 91)||(charCode >96 && charCode < 123)||charCode ==08 || charCode ==127||charCode ==32||charCode ==46)&&(!(evt.ctrlKey&&(charCode==118||charCode==86))))
             return true;
			
          return false;
       }
</script>
<!--nic number-->	
	
	<script>
function nicnumber()
{
var nicno = /^[0-9]{9}[vVxX]$/;
	if(document.getElementById("txt_nicno").value=="")
	{
	}
	else
	{
		if( document.getElementById("txt_nicno").value.match(nicno))
		{
			return true;
		}
		else
		{
			alert("Enter 10 digit nic number");
			document.getElementById("txt_nicno").value="";		
			return false;
		}
	}	 
}
</script>
<script>
// function for password
function password()
{
	var str = document.getElementById("pwd").value;
	var res = str.length; 
	if(res>6)
	{
		return true;
	}
	else
	{
			alert("enter more than 6 character password");
			document.getElementById("pwd").value="";		
			return false;
	}
	
}
</script>
<head>
	
	<meta charset="utf-8">
	<title>Pillayar Medi Clnic</title>
	
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
		<link rel="stylesheet" href="css/styles.css">
</head>

<body>
		<?php include ("tophead.php"); ?>
       
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Admin Home</li>
						<li><a class="ajax-link" href="adminhome.php"><i class="icon-home"></i><span class="hidden-tablet"> Home</span></a></li>
 			<li><a class="ajax-link" href="adminhome.php?pg=profile.php&option=view"><i class="icon-user"></i><span class="hidden-tablet"> Profile</span></a></li>
					  <li><a class="ajax-link" href="adminhome.php?pg=staff.php&option=view"><i class="icon-list-alt"></i><span class="hidden-tablet"> Staff Details</span></a></li>
						
						<li><a class="ajax-link" href="adminhome.php?pg=elders details.php&option=view"><i class="icon-list-alt"></i><span class="hidden-tablet"> Elders Details</span></a></li>
						<li><a class="ajax-link" href="adminhome.php?pg=salary.php&option=view"><i class="icon-list-alt"></i>Salary Details<span class="hidden-tablet"></span></a></li>
						
                        	<li><a class="ajax-link" href="adminhome.php?pg=item.php&option=view"><i class="icon-list-alt"></i><span class="hidden-tablet"> Item Details</span></a></li>
						<li><a class="ajax-link" href="adminhome.php?pg=eventres.php&option=view"><i class="icon-list-alt"></i><span class="hidden-tablet"> Events Details</span></a></li>
                        						
                                                          <li><a class="ajax-link" href="adminhome.php?pg=payment.php&option=view"><i class="icon-list-alt"></i><span class="hidden-tablet">Payment Schedule</span></a></li>
                                                                                        <li><a class="ajax-link" href="adminhome.php?pg=branch details.php&option=view"><i class="icon-list-alt"></i><span class="hidden-tablet">Branch Details</span></a></li>
                                                                                              
              
                       <li><a class="ajax-link" href="adminhome.php?pg=sponsor registration.php&option=view"><i class="icon-list-alt"></i><span class="hidden-tablet">Sponsor Details</span></a></li>
                       
                       <li><a class="ajax-link" href="adminhome.php?pg=news.php&option=view"><i class="icon-list-alt"></i><span class="hidden-tablet">News Details</span></a></li>
					  
					    <li><a class="ajax-link" href="adminhome.php?pg=death.php&option=view"><i class="icon-list-alt"></i><span class="hidden-tablet">Death Details</span></a></li>
                       
						
					
                                               <li><a href="logout.php"><i class="icon-lock"></i><span class="hidden-tablet"> Logout</span></a></li>
												
					</ul>
				</div>

				<!--/.well -->
			</div><!--/span-->
			<!-- left menu ends --><noscript>
            
            
            
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
        <!--///////////////////////////////////////////////////////////-->
			<div id="content" class="span10">
             <!--////////////////////////////////////////////////////////////////-->
              <?php
		 	$sql1="SELECT mess_id FROM message WHERE to_id='$username' AND status='1'";
			$result=mysql_query($sql1);
			$n=mysql_num_rows($result);
			
			?>
        <div id='cssmenu'>
<ul>
   
   <li class='has-sub'><a href='#'> <i class="icon-filter"></i><span class="hidden-tablet">Report</span></a>
      <ul>
         <li><a href='<?php echo $page; ?>?pg=staff.php&option=view&report=staff'><span>Staff</span></a></li>
         <li><a href='<?php echo $page; ?>?pg=elders details.php&option=view&report=elders'><span>Elders</span></a></li>
         <li class='last'><a href='<?php echo $page; ?>?pg=salary.php&option=view'><span>Salay</span></a></li>
          <li class='last'><a href='<?php echo $page; ?>?pg=sponsor registration.php&option=view&report=sponsor'><span>Sponsor</span></a></li>
           <li class='last'><a href='<?php echo $page; ?>?pg=eventres.php&option=view&report=event'><span>Event</span></a></li>
            <li class='last'><a href='<?php echo $page; ?>?pg=purchase.php&option=view&report=purchase'><span>purchase</span></a></li>
            <li class='last'><a href='<?php echo $page; ?>?pg=supply.php&option=view&report=supply'><span>supply</span></a></li>
             <li class='last'><a href='<?php echo $page; ?>?pg=food.php&option=view&report=food'><span>food</span></a></li>
             <li class='last'><a href='<?php echo $page; ?>?pg=expense.php&option=view&report=expense'><span>Expense</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span><?php if($n>0) { ?><table><tr><td>Message</td><td bgcolor="#FF0000"><?php  echo "(".$n.")"; ?></td></tr></table><?php } else echo "Message";?></span></a>
      <ul>
         <li><a href="adminhome.php?pg=message.php&option=new"><span>Compose</span></a></li>
         <li class=''><a href='adminhome.php?pg=message.php&option=inbox'><span>Inbox</span></a></li>
         <li class='last'><a href='adminhome.php?pg=message.php&option=sent'><span>Sent Message</span></a></li>
      </ul>
   </li>
   <li class='last'><a href='adminhome.php?pg=ward.php&option=view'><i class="icon-list-alt"></i><span class="hidden-tablet">ward</span></a></li>
   <li class='last'><a href='adminhome.php?pg=duty details.php&option=view'><i class="icon-list-alt"></i><span class="hidden-tablet">Duty</span></a></li>
    <li class='has-sub'><a href='#'><i class="icon-list-alt"></i><span class="hidden-tablet">Item</span></a>
    <ul>
    <li><a class="ajax-link" href="adminhome.php?pg=item.php&option=view"><span> Item Details</span></a></li>
  <li class='last'><a href='adminhome.php?pg=purchase.php&option=view'><span>purchase</span></a></li>
  <li class='last'><a href='adminhome.php?pg=supply.php&option=view'><span>Supply</span></a></li>
  </ul>
  </li>
   <li class='last'><a href='adminhome.php?pg=medicine.php&option=view'><i class="icon-list-alt"></i><span class="hidden-tablet">Medicine</span></a></li>
   <li><a class="ajax-link" href="adminhome.php?pg=food.php&option=view"><i class="icon-list-alt"></i><span class="hidden-tablet">Food</span></a></li>
         <li><a class="ajax-link" href="adminhome.php?pg=expense.php&option=view"><i class="icon-list-alt"></i><span class="hidden-tablet">Expense</span></a></li>
         
  <li><a class="ajax-link" href="adminhome.php?pg=running.php&option=view"><i class="icon-list-alt"></i><span class="hidden-tablet"> Running Chart </span></a></li>       
         
</ul>
</div>       
			<!-- content starts -->
          
			

			
			<div class="sortable row-fluid">
			
			<a id="tips"></a>
			<?php include("pages.php") ?>
            
            
            <center><a href="#tips">Top</a></center>
            </div>
			
			<div class="row-fluid"></div>
					
			<div class="row-fluid sortable"><!--/span--><!--/span--><!--/span-->
			</div><!--/row-->

			<div class="row-fluid sortable"><!--/span--><!--/span--><!--/span-->
			</div><!--/row-->
				  

		  
       
					<!-- content ends -->
			</div><!--/#content.span10-->
		</div><!--/fluid-row-->
				
				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>

		<footer>
			<p class="pull-left">&copy; <a href="#" target="_blank">Elders Home</a> 2014			</p>
			<p class="pull-right">Powered by: <a href="#">T.Yathavan</a></p>
		</footer>
		
	</div><!--/.fluid-container-->

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
else
{
header("location:index.php");	
}

?>
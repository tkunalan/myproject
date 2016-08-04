<script>
function nicnumber()
{
var nicno = /^[0-9]{9}[vVxX]$/;
	if(document.getElementById("txtnicno").value=="")
	{
	}
	else
	{
		if( document.getElementById("txtnicno").value.match(nicno))
		{
			return true;
		}
		else
		{
			alert("Enter 10 digit nic number");
			document.getElementById("txtnicno").value="";		
			return false;
		}
	}	 
}
</script>
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
	if(document.getElementById("tpnum").value=="")
	{
	}
	else
	{
		if( document.getElementById("tpnum").value.match(phoneno))
		{
			return true;
		}
		else
		{
			alert("Enter 10 digit hand phone number");
			document.getElementById("tpnum").value="";		
			return false;
		}
	}	 
}
</script>
<script language="Javascript">
// function for password
function password()
{
	var str = document.getElementById("txtnewpassword").value;
	var res = str.length; 
	if(res>6)
	{
		return true;
	}
	else
	{
			alert("enter more than 6 character password");
			document.getElementById("txtnewpassword").value="";		
			return false;
	}
	
}
</script>

<?php
include "config.php";
//session_start();
$username=$_SESSION['username'];
$usertype=$_SESSION['usertype'];
$msg="";

if($usertype="sponsor")
{
	$page="sponsorhome.php";
}



$sql1="SELECT * FROM sponsor WHERE user_id='$username'";
		$result=mysqli_query($connection,$sql1) or die("Error in mysqli:".mysqli_error());
		$row=mysqli_fetch_assoc($result);
		
		if(isset($_POST['editsubmit']))
		{
			//if($table=='staff')
			
			{
				$spid= $_POST ['txtspid'];
				$spname= $_POST ['txtspname'];
				$country=$_POST['txtcountry'];
				$address= $_POST ['txtaddress'];
				$tpno= $_POST ['txttelephonenumber'];
				
				
				$sql2= "UPDATE sponsor
				SET address = '$address',
				country='$country',
				name='$spname',
				contact_no = '$tpno'
				WHERE user_id ='$spid'";
			
			
			}
			$result = mysqli_query($connection,$sql2) or die('Query failed, '. mysqli_error());
			
			
		if ($result)
			{
				echo '<table bgcolor="#FF0000"><tr><td><p align="center"><strong><font color="#FF0000">Your details update successfully</font></strong></p></td></tr></table>';
				echo '<p align="center"><img border="0" src="photos/sucess.jpg" width="100" height="50"></p>';
				echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$page.'?pg=sponsor profile.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
				//include 'successadmin.php';
				
			}
			else 
			{
				die ( mysqli_error () );
			}
Exit;		
}
elseif(isset($_POST['changesubmit']))
	{
		$newpass=$_POST['txtnewpassword'];
		$oldpass=$_POST['txtoldpassword'];
		$cnewpass=$_POST['txtcnewpassword'];
		if($newpass==$cnewpass)
		{
			$sql1="SELECT password FROM user WHERE user_id='$username'";
			$result=mysqli_query($connection,$sql1) or die("error in my sql".mysqli_error());
			$row=mysqli_fetch_assoc($result);
			if($oldpass==$row['password'])
			{
				$sql2= "UPDATE user
				SET password='$newpass'
				WHERE user_id = '$username'";
				$result=mysqli_query($sql2);
				if ($result)
				{
					echo '<table bgcolor="#FF0000"><tr align="center" ><td><p align="center"><strong><font color="#FF0000">Your password changed successfully</font></strong></p></td></tr></table>';
					echo '<p align="center"><img border="0" src="photos/sucess.jpg" width="100" height="50"></p>';
					echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$page.'?pg=sponsor profile.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
				}
				else 
				{
					die ( mysqli_error () );
				}
				exit;
				
			}
			else
			{
				$_GET['option']=="change";
				$msg="Your current password error";
			}
		}
		else
		{
			$_GET['option']=="change";
			$msg="Password mismatch with new password";
		}
	}
				
				
				

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>

</head>

<body>



<div>
	<ul class="breadcrumb">
		<li>
		<h4><i class="icon-user"></i> Profile</h4>

        </li>
	</ul>
</div>

<!--/new entry design begin-->
<?php
	if(isset($_GET['option']))
	{
		if($_GET['option']=="view")
		{
			
			?>
        
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <a class="btn btn-primary" href="<?php echo $page; ?>?pg=sponsor profile.php&option=edit"><i class="icon icon-edit icon-white"></i> Edit Profile </a> 
      <a class="btn btn-primary" href="<?php echo $page; ?>?pg=sponsor profile.php&option=change"><i class="icon icon-edit icon-white"></i> Change Password </a>           
    </div>
    <div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
          <table width="100%"><tr><td>
          <div class="control-group">
            <label class="control-label" for="typeahead">Sponsor ID </label>
            <div class="controls">
 <input type="text" class="input-xlarge focused" readonly id="typeahead"  name="txtspid" value="<?php echo $row['user_id']; ?>" name="txtstaffid">
              
            </div>
          </div>
          
                      <div class="control-group">
            <label class="control-label" for="typeahead">Sponsor Name </label>
            <div class="controls">
              <input  name="txtspname" type="text"  readonly value="<?php echo $row['name']; ?>" required class="input-xlarge focused" id="txtspname" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="typeahead">Country </label>
            <div class="controls">
              <input  name="txtcountry" type="text" readonly class="input-xlarge focused" id="typeahead" value="<?php echo $row['country']; ?>" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Address </label>
            <div class="controls">
              <input  name="txtaddress" type="text" readonly class="input-xlarge focused" id="typeahead" value="<?php echo $row['address']; ?>" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
          
          
        
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Telephone Number </label>
            <div class="controls">
              <input  name="txttelephonenumber" type="text" readonly class="input-xlarge focused" id="typeahead" value="<?php echo $row['contact_no']; ?>" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
                      
          </td></tr></table>
          
                 </fieldset>
      </form>
    </div>
  </div>
  <!--/span-->
</div>
<?php
	}
	elseif($_GET['option']=="edit")
	{
		?>
        
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <a class="btn btn-primary" href="<?php echo $page; ?>?pg=sponsor profile.php&option=edit"><i class="icon icon-edit icon-white"></i> Edit Profile </a> 
      <a class="btn btn-primary" href="<?php echo $page; ?>?pg=sponsor profile.php&option=change"><i class="icon icon-edit icon-white"></i> Change Password </a>                
    </div>
    <div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
          <table width="100%"><tr><td>
          <div class="control-group">
            <label class="control-label" for="typeahead">Sponsor ID </label>
            <div class="controls"> 
            <input type="text" class="input-xlarge focused" readonly id="txtspid"  name="txtspid" value="<?php echo $row['user_id']; ?>"  >
              
            </div>
          </div>
          
                      <div class="control-group">
            <label class="control-label" for="typeahead">Sponsor Name </label>
            <div class="controls">
              <input  name="txtspname" type="text" value="<?php echo $row['name']; ?>" required class="input-xlarge focused"  onkeypress="return isTextKey(event)" id="txtspname" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
            <div class="control-group">
            <label class="control-label" for="typeahead">Country </label>
            <div class="controls">
              <input  name="txtcountry" type="text"  class="input-xlarge focused" id="typeahead" value="<?php echo $row['country']; ?>" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Address </label>
            <div class="controls">
              <input type="text" value="<?php echo $row['address']; ?>" class="input-xlarge focused" required id="typeahead"  name="txtaddress" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
       
          
        
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Telephone Number </label>
            <div class="controls">
              <input type="text" value="<?php echo $row['contact_no']; ?>" class="input-xlarge focused" required id="typeahead" placeholder="Ex: 07xxxxxxxx" onkeypress="return isNumberKey(event)" onblur="phonenumber()" name="txttelephonenumber" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
       
          
          
          
        </td>  </tr></table>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary" name="editsubmit">Save changes</button>
             <a href="<?php echo $page; ?>?pg=sponsor profile.php&option=view"<button type="button" class="btn btn-primary" name="cancel">Cancel</button></a>

           </div>
        	</a>
        </fieldset>
      </form>
    </div>
  </div>
  <!--/span-->
</div>
<?php
		}
		elseif($_GET['option']=="change")
		{
		?>
        <div class="row-fluid sortable">
  		<div class="box span12">
    	<div class="box-header well" data-original-title>
      			 <a class="btn btn-primary" href="<?php echo $page; ?>?pg=sponsor profile.php&option=edit"><i class="icon icon-edit icon-white"></i> Edit Profile </a> 
      			<a class="btn btn-primary" href="<?php echo $page; ?>?pg=sponsor profile.php&option=change"><i class="icon icon-edit icon-white"></i> Change Password </a>        </div>
    	<div class="box-content">
        
        <?php
        	//if(isset($_GET['passmissmatch']))
			//{
				echo '<font color="#FF0000"><b>'.$msg.'</b></font>';
			//}
			?>
        
        <form class="form-horizontal" action="" method="post">
        <fieldset>
		<div class="control-group">
            <label class="control-label" for="typeahead">Current Password </label>
            <div class="controls">
              <input type="password" class="input-xlarge focused" id="typeahead"  name="txtoldpassword" required class="input-large span10">
              
            </div>
          </div>
		  
		  <div class="control-group">
            <label class="control-label" for="typeahead">New Password </label>
            <div class="controls">
              <input type="password" class="input-xlarge focused" id="txtnewpassword"  name="txtnewpassword" required class="input-large span10" onBlur="password()">
              
            </div>
          </div>
		  
		  <div class="control-group">
            <label class="control-label" for="typeahead">Confirm Password </label>
            <div class="controls">
              <input type="password" class="input-xlarge focused" id="typeahead"  name="txtcnewpassword">
              
              
            </div>
          </div>
		  
		  <div class="form-actions">
            <button type="submit" class="btn btn-primary" name="changesubmit">Save</button>
            <a href="<?php echo $page; ?>?pg=profile.php&option=view"<button type="button" class="btn btn-primary" name="cancel">Cancel</button></a>
          </div>
		</fieldset>
        </form>
        </div>
        </div>
        </div>
        <?php
	}
}
?>
<!--/new entry design end-->


</body>
</html>
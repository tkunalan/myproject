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


$sql1="SELECT * FROM staff WHERE user_id='$username'";
		$result=mysqli_query($connection,$sql1) or die("Error in mysqli:".mysqli_error());
		$row=mysqli_fetch_assoc($result);
		
		if(isset($_POST['editsubmit']))
		{
			//if($table=='staff')
			
			{
				$staffid= $_POST ['txtstaffid'];
				$dname= $_POST ['txtstaffname'];
				$address= $_POST ['txtaddress'];
				$nicno=  $_POST ['txtnicno'];
				$designation = $_POST ['txtdesignation'];
				$tpno= $_POST ['txttelephonenumber'];
				$email = $_POST ['txtemail'];
				
				$sql2= "UPDATE staff
				SET name='$dname',
				address = '$address',
				nic_no ='$nicno',
				contact_no = '$tpno',
				email_id = '$email'
				WHERE user_id = '$staffid'";
			
			
			}
			$result = mysqli_query($connection,$sql2) or die('Query failed, '. mysqli_error());
			
			
		if ($result)
			{
				echo '<table bgcolor="#FF0000"><tr><td><p align="center"><strong><font color="#FF0000">Your details update successfully</font></strong></p></td></tr></table>';
				echo '<p align="center"><img border="0" src="photos/sucess.jpg" width="100" height="50"></p>';
				echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$page.'?pg=profile.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
				//include 'successadmin.php';
				
			}
			else 
			{
				die ( mysql_error () );
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
			$result=mysql_query($sql1) or die("error in my sql".mysql_error());
			$row=mysql_fetch_assoc($result);
			if($oldpass==$row['password'])
			{
				$sql2= "UPDATE user
				SET password='$newpass'
				WHERE user_id = '$username'";
				$result=mysql_query($sql2);
				if ($result)
				{
					echo '<table bgcolor="#FF0000"><tr align="center" ><td><p align="center"><strong><font color="#FF0000">Your password changed successfully</font></strong></p></td></tr></table>';
					echo '<p align="center"><img border="0" src="photos/sucess.jpg" width="100" height="50"></p>';
					echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$page.'?pg=profile.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
				}
				else 
				{
					die ( mysql_error () );
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
		<h4><i class="icon-user">Profile</i></h4>

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
      <a class="btn btn-primary" href="<?php echo $page; ?>?pg=profile.php&option=edit"><i class="icon icon-edit icon-white"></i> Edit Profile </a> 
      <a class="btn btn-primary" href="<?php echo $page; ?>?pg=profile.php&option=change"><i class="icon icon-edit icon-white"></i> Change Password </a>           
    </div>
    <div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
          <table width="100%"><tr><td>
          <div class="control-group">
            <label class="control-label" for="typeahead">Staff ID </label>
            <div class="controls">
 <input type="text" class="input-xlarge focused" disabled="" id="typeahead"  name="txtstaffid" value="<?php echo $row['user_id']; ?>" name="txtstaffid">
              
            </div>
          </div>
          
                      <div class="control-group">
            <label class="control-label" for="typeahead">Staff Name </label>
            <div class="controls">
              <input  name="txtstaffname" type="text"  disabled="" value="<?php echo $row['name']; ?>" required class="input-xlarge focused" id="typeahead" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Address </label>
            <div class="controls">
              <input  name="txtaddress" type="text" disabled class="input-xlarge focused" id="typeahead" value="<?php echo $row['address']; ?>" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">NIC No </label>
            <div class="controls">
              <input  name="txtnicno" type="text" disabled class="input-xlarge focused" id="typeahead" value="<?php echo $row['nic_no']; ?>" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Designation </label>
            <div class="controls">
              <input  name="txtdesignation" type="text" disabled class="input-xlarge focused" readonly id="typeahead" value="<?php echo $row['staff_designation']; ?>" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          </td><td>
          <div class="control-group">
            <label class="control-label" for="typeahead">Telephone Number </label>
            <div class="controls">
              <input  name="txttelephonenumber" type="text" disabled class="input-xlarge focused" id="typeahead" value="<?php echo $row['contact_no']; ?>" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Email </label>
            <div class="controls">
              <input  name="txtemail" type="text" disabled class="input-xlarge focused" id="email" value="<?php echo $row['email_id']; ?>" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Date of Birth </label>
            <div class="controls">
              <input  name="txtUserName" type="text" disabled class="input-xlarge focused" id="UserName" value="<?php echo $row['dob']; ?>" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
                    
          <div class="control-group">
            <label class="control-label" for="typeahead">Branch Code </label>
            <div class="controls">
              <input  name="txtBranchCode" type="text" disabled  class="input-xlarge focused" id="typeahead"  value="<?php echo $row['branch_id']; ?>" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          <div class="control-group">
								<label class="control-label" for="appendedPrependedInput">Salary</label>
								<div class="controls">
								  <div class="input-prepend input-append">
									<span class="add-on">Rs</span><input name="txtsalary" type="text" disabled id="appendedPrependedInput" value="<?php echo $row['basic_salary']; ?>" size="16" ><span class="add-on">.00</span>
								  </div>
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
      <a class="btn btn-primary" href="<?php echo $page; ?>?pg=profile.php&option=edit"><i class="icon icon-edit icon-white"></i> Edit Profile </a> 
      <a class="btn btn-primary" href="<?php echo $page; ?>?pg=profile.php&option=change"><i class="icon icon-edit icon-white"></i> Change Password </a>                
    </div>
    <div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
          <table width="100%"><tr><td>
          <div class="control-group">
            <label class="control-label" for="typeahead">Staff ID </label>
            <div class="controls">
 <input type="text" class="input-xlarge focused" readonly id="typeahead"  name="txtstaffid" value="<?php echo $row['user_id']; ?>" name="txtstaffid" >
              
            </div>
          </div>
          
                      <div class="control-group">
            <label class="control-label" for="typeahead">Staff Name </label>
            <div class="controls">
              <input  name="txtstaffname" type="text" value="<?php echo $row['name']; ?>" required class="input-xlarge focused"  onkeypress="return isTextKey(event)" id="typeahead" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Address </label>
            <div class="controls">
              <input type="text" value="<?php echo $row['address']; ?>" class="input-xlarge focused" required id="typeahead"  name="txtaddress" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">NIC No </label>
            <div class="controls">
              <input type="text" value="<?php echo $row['nic_no']; ?>" class="input-xlarge focused" readonly id="typeahead" onkeypress="return isNumberKey(event)" name="txtnicno" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Designation </label>
            <div class="controls">
              <input  name="txtdesignation" type="text" class="input-xlarge focused" id="typeahead" readonly  value="<?php echo $row['staff_designation']; ?>" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          </td><td>
          <div class="control-group">
            <label class="control-label" for="typeahead">Telephone Number </label>
            <div class="controls">
              <input type="text" value="<?php echo $row['contact_no']; ?>" class="input-xlarge focused" required id="typeahead" placeholder="Ex: 07xxxxxxxx" onkeypress="return isNumberKey(event)" onblur="phonenumber()" name="txttelephonenumber" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Email </label>
            <div class="controls">
              <input type="text" value="<?php echo $row['email_id']; ?>" class="input-xlarge focused" id="email" required  name="txtemail" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Date of Birth </label>
            <div class="controls">
              <input  name="txtUserName" type="text" readonly class="input-xlarge focused" id="UserName" value="<?php echo $row['dob']; ?>" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          
                    
          <div class="control-group">
            <label class="control-label" for="typeahead">Branch Code </label>
            <div class="controls">
              <input  name="txtBranchCode" type="text" readonly  class="input-xlarge focused" id="typeahead"  value="<?php echo $row['branch_id']; ?>" data-provide="typeahead" data-items="4">
              
            </div>
          </div>
          <div class="control-group">
								<label class="control-label" for="appendedPrependedInput">Salary</label>

								<div class="controls">
								  <div class="input-prepend input-append">
									<span class="add-on">Rs</span><input name="txtsalary" type="text" readonly id="appendedPrependedInput" value="<?php echo $row['basic_salary']; ?>" size="16" ><span class="add-on">.00</span>
								  </div>
								</div>
							  </div>
          
          </td></tr></table>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary" name="editsubmit">Save changes</button>
             <a href="<?php echo $page; ?>?pg=profile.php&option=view"<button type="button" class="btn btn-primary" name="cancel">Cancel</button></a>

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
      			 <a class="btn btn-primary" href="<?php echo $page; ?>?pg=profile.php&option=edit"><i class="icon icon-edit icon-white"></i> Edit Profile </a> 
      			<a class="btn btn-primary" href="<?php echo $page; ?>?pg=profile.php&option=change"><i class="icon icon-edit icon-white"></i> Change Password </a>        </div>
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
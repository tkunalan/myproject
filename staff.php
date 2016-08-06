<script language="Javascript">
// function for password
function password()
{
	var str = document.getElementById("txt_pass").value;
	var res = str.length; 
	if(res>6)
	{
		return true;
	}
	else
	{
			alert("enter more than 6 character password");
			document.getElementById("txt_pass").value="";		
			return false;
	}
	
}
</script>
<?php
	include ("config.php");
	if(isset($_SESSION['username']) && ($_SESSION['usertype']=='admin' || $_SESSION['usertype']=='manager' || $_SESSION['usertype']=='clerk'))
{
	if($_SESSION['usertype']=="admin")
	{
		$newpage="adminhome.php?pg=staff.php&option=new";
		$viewpage="adminhome.php?pg=staff.php&option=view";
		$pastpage="adminhome.php?pg=staff.php&option=past";
	}
	if($_SESSION['usertype']=="manager")
	{
		$newpage="managerhome.php?pg=staff.php&option=new";
		$viewpage="managerhome.php?pg=staff.php&option=view";
		$pastpage="managerhome.php?pg=staff.php&option=past";
	}
	elseif($_SESSION['usertype']=="clerk")
	{
		$viewpage="clerkhome.php?pg=staff.php&option=view";
	}
	if(isset($_POST['save']))
	{
		if($_SESSION['usertype']=="admin")
		{
			$barnchid=$_POST['txt_branchid'];
		}
		else
		{
			$sql8 ="SELECT *  FROM branch WHERE branch_name='$_POST[txt_branchid]'";
				$result8=mysqli_query($connection,$sql8) or die ("mysqli.error:".mysqli_error($connection));
				$row8=mysqli_fetch_assoc($result8);
				$barnchid=$row8['branch_id'];
		}
		
		//file upload start
		
		
			if(file_exists("upload/".$_FILES["img_photo"]["name"]))
			{
				echo $_FILES["img_photo"]["name"]."already exists.";
			}
			else
			{
				move_uploaded_file($_FILES["img_photo"]["tmp_name"],"photos/".$_FILES["img_photo"]["name"]);
			}
		
		
		//file upload end
		
					$date=date("Y-m-d", strtotime($_POST['txt_dob']));
					
					$sql2 = "INSERT INTO user(user_id,password,usertype) 
						VALUES(
						'".mysqli_real_escape_string($connection,$_POST['txt_staffid'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_pass'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_usertype'])."')";
						
					$sql = "INSERT INTO staff(user_id,title,name,staff_designation,address,contact_no,nic_no,email_id,dob,branch_id,basic_salary,photo)
						VALUES(
						'".mysqli_real_escape_string($connection,$_POST['txt_staffid'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_title'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_name'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_designation'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_address'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_contactno'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_nicno'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_email'])."',
						'".mysqli_real_escape_string($connection,$date)."',
						'".mysqli_real_escape_string($connection,$barnchid)."',
						'".mysqli_real_escape_string($connection,$_POST['txt_bsalary'])."',
						'".mysqli_real_escape_string($connection,$_FILES["img_photo"]["name"])."'
						)";
						
						$result2=mysqli_query($connection,$sql2) or die("Error in sql2 ".mysqli_error());
						$result=mysqli_query($connection,$sql) or die("Error in sql ".mysqli_error());
						
						if($result and $result2)
						{
							
					echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
				echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$viewpage.'?pg=staff.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
						}
						else
						{
							echo mysqli_error();
						}
				}
				
	if(isset($_POST['savechanges']))
	{
		$sid=$_POST['txt_staffid'];
		$sql="UPDATE staff SET 
							title='".mysqli_real_escape_string($connection,$_POST['txt_title'])."',
							name='".mysqli_real_escape_string($connection,$_POST['txt_name'])."',
							staff_designation='".mysqli_real_escape_string($connection,$_POST['txt_designation'])."',
						        address=	'".mysqli_real_escape_string($connection,$_POST['txt_address'])."',
						      contact_no='".mysqli_real_escape_string($connection,$_POST['txt_contactno'])."',
						          nic_no='".mysqli_real_escape_string($connection,$_POST['txt_nicno'])."',
						      email_id='".mysqli_real_escape_string($connection,$_POST['txt_email'])."',
						           dob='".mysqli_real_escape_string($connection,$_POST['txt_dob'])."',
						basic_salary='".mysqli_real_escape_string($connection,$_POST['txt_bsalary'])."',
						photo='".mysqli_real_escape_string($connection,$_POST['img_photo'])."'
						WHERE user_id='$sid'";
			$result=mysqli_query($connection,$sql);
			$sql1="UPDATE user SET 
							password='".mysqli_real_escape_string($connection,$_POST['txt_pass'])."',
							usertype='".mysqli_real_escape_string($connection,$_POST['txt_usertype'])."'
						WHERE user_id='$sid'";
			$result=mysqli_query($connection,$sql1);
										
	}
				
				
				
				?>
			

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Elders Home</title>

<script type="text/javascript">
function deleteconfirm() // make alert for delete elders details 
{
	var x=confirm("Are You Sure Add in  Retired Staff List");
	if(x)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>

</head>

<body>
<?php
	
							if(!(isset($_GET['pr']) || isset($_GET['report'])))//allow user, if report or print button is not set
							{
							?>
    <div class="box-header well" data-original-title>
      <h2><i class="icon-edit"></i>Staff Details </h2>
      
    </div>
  <?php }
  
    else
    {
	?>
		<div class="box-header well" data-original-title>
    <center>  <h2><i class="icon-edit"></i> Elder's Home Staff Details Report</h2></center>
      
    </div>
    
    <?php 
    }?>

            


<?php
	if(isset($_GET['status']))
	{
		$sid=$_GET['sid'];
		//Staff view start
		if($_GET['status']=="staffview")
		{
			$sql1 ="SELECT * FROM staff WHERE user_id='$sid'";
			$result=mysqli_query($connection,$sql1) or die ("mysql.error:".mysqli_error());
			$row=mysqli_fetch_assoc($result);
			?>
			<div class="row-fluid sortable">		
				<div class="box span6">
                <?php
							if((isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
    <div class="box-header well" data-original-title>
    <center>  <h3><i class="icon-edit"></i>Elder's Home Staff Personal Details</h3></center>
      
    </div>
  <?php }?>
                    
					<div class="box-content">
                     <?php if(isset($_GET['pr']))
				  {
					  echo "<center><table border=1 cellspacing=0 cellpadding=0 width=30%>";
				  }
				  else
				  {
					  ?>
						<table class="table">
                        <?php
				  }
				  ?>
						
                        <center><img width="100" height="100" src="photos/<?php echo $row['photo']; ?>"></center></br>
						<tr><td>Staff id</td><td><?php echo $row['user_id']; ?></td>
                        <tr><td>Title</td><td><?php echo $row['title']; ?></td>
                        <tr><td>Staff Name</td><td><?php echo $row['name']; ?></td>
                        <tr><td>Staff designation</td><td><?php echo $row['staff_designation']; ?></td>
                        <tr><td>Address</td><td><?php echo $row['address']; ?></td>
                        <tr><td>contact No</td><td><?php echo $row['contact_no']; ?></td>
                        <tr><td>NIC</td><td><?php echo $row['nic_no']; ?></td>
                        <tr><td>E-mail Address</td><td><?php echo $row['email_id']; ?></td>
                        <tr><td>DOB</td><td><?php echo $row['dob']; ?></td>
                        <tr><td>Branch</td><td><?php 
										$bid=$row['branch_id'];
										$sql2 ="SELECT branch_name FROM branch WHERE branch_id='$bid'";
										$result2=mysqli_query($connection,$sql2) or die ("mysql.error:".mysqli_error());
										$row2=mysqli_fetch_assoc($result2);
						
										echo $row2['branch_name']; ?></td></tr>
                        <tr><td>Basic Salary</td><td><?php echo $row['basic_salary']; ?></td>
                        <tr><td>Photo</td><td><?php echo $row['photo']; ?></td>
                        
                        <?php 
		  		$sql4 ="SELECT * FROM user WHERE user_id='$sid'";
				$result4=mysqli_query($connection,$sql4) or die ("mysql.error:".mysqli_error());
				$row4=mysqli_fetch_assoc($result4)
          		
          ?>
          
                        <tr><td>User Name</td><td><?php echo $row4['user_id']; ?></td></tr>
                         <!--<tr><td>Password</td><td><?php echo $row4['password']; ?></td></tr>-->
                         <tr><td>User Type</td><td><?php echo $row4['usertype']; ?></td></tr>
                          <?php
						 
							 if(isset($_GET['pr']))
								{
									
								}
								else
								{
									?>
                      
                        <tr><td><a class="btn btn-success" href="<?php echo $viewpage; ?>">
										<i class="icon-arrow-left icon-white"></i>  
										Go back                                            
									</a>&nbsp;&nbsp;&nbsp; <a class="btn btn-info" 
				onclick="window.open('print.php?pr=staff.php&option=view&status=staffview&sid=<?php echo $row['user_id']?>','_blank')";
				><i class="icon icon-print icon-white"></i> print</a></td><td></td></tr>
                               
                                     <?php
									 
								}
								?>   
          						</table>
                     </div>
                 </div>
			</div>
            
            <?php
			exit;
		}
		//Staff view end
		
		//staff edit start
		elseif($_GET['status']=="staffedit")
		{
			$sql1 ="SELECT * FROM staff WHERE user_id='$sid'";
			$result=mysqli_query($connection,$sql1) or die ("mysql.error:".mysqli_error());
			$row=mysqli_fetch_assoc($result);
			global $userid;
			$userid=$row['user_id'];
			?>
            
			<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-edit"></i> Edit Staff</h2>
      
    </div>
    <div class="box-content">
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=staffview&sid=<?php echo $sid; ?>" method="post">
        <fieldset>
          <table width="100%">
          <tr><td>
          <div class="control-group">
            <label class="control-label" for="typeahead">Staff ID </label>
            <div class="controls">
              <input type="text" required class="span8 typeahead" name="txt_staffid" id="txt_staffid" readonly  value="<?php echo $row['user_id']; ?>">
              
            </div>
          </div>  
          <div class="control-group">
								<label class="control-label" for="selectError" id="title_text">Title</label>
			<div class="controls">
			  <select required id="txt_title" name="txt_title" class="span8 typeahead" data-rel="chosen">
                                  	<option selected value="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></option>
                                  	<option value="Mr">Mr</option>
									<option value="Miss">Miss</option>
									<option value="Mrs">Mrs</option>
			  </select>
            
            
            </div>
            
		  </div>
         
          <div class="control-group">
            <label class="control-label" for="typeahead">Full Name </label>
            <div class="controls">
            
             <input type="text" required class="span8 typeahead" name="txt_name" id="txt_name"  value="<?php echo $row['name']; ?>" onkeypress="return isTextKey(event)"> 
   
           </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Designation </label>
            <div class="controls">
            <?php
			global $userid;
			if(($userid==$_SESSION['username'])&&($_SESSION['usertype']=="manager"))
			{
			?>	
 <input type="text" rows="5" cols="50"required class="span8 typeahead" id="txt_designation" readonly name="txt_designation" value="superintendent">
  
              
            </div>
          </div>
          <?php		
			}
			else
			{
				if($_SESSION['usertype']=="manager")
				{
				?>
           
            <select required id="txt_title" name="txt_designation" class="span8 typeahead" data-rel="chosen">
                                  	<option selected value="<?php echo $row['staff_designation']; ?>"><?php echo $row['staff_designation']; ?></option>
                                  	<option value="clerk">Clerk</option>
									<option value="Doctor">Doctor</option>
                                    <option value="Ward incharge">Ward incharge</option>
                                    <option value="Accountant">Accountant</option>
			  </select>
                   <?php
				}
				else
				{
					?>
                    <select required id="txt_title" name="txt_designation" class="span8 typeahead" data-rel="chosen">
                                  	<option selected value="<?php echo $row['staff_designation']; ?>"><?php echo $row['staff_designation']; ?></option>
                                  	<option value="clerk">Clerk</option>
									<option value="superintendent">superintendent</option>
									<option value="Doctor">Doctor</option>
                                    <option value="Ward incharge">Ward incharge</option>
                                    <option value="Accountant">Accountant</option>
			  </select>
                    <?php
				}
			}
			?>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="typeahead">Address </label>
            <div class="controls">
 <input type="textarea" rows="5" cols="50"required class="span8 typeahead" id="txt_address" name="txt_address" value="<?php echo $row['address']; ?>">
  
              
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="typeahead">Contact No </label>
            <div class="controls">
        <input type="tel" required class="span8 typeahead" id="txt_contactno" name="txt_contactno" maxlength="10" value="<?php echo $row['contact_no']; ?>" placeholder="Ex: 07xxxxxxxx" onkeypress="return isNumberKey(event)" onblur="phonenumber()">
              
            </div>
          </div>
    
				
							          <div class="control-group">
            <label class="control-label" for="typeahead">NIC NO</label>
            <div class="controls">
           <input type="text" required class="span8 typeahead" id="txt_nicno" name="txt_nicno" maxlength="10" value="<?php echo $row['nic_no']; ?>" placeholder="Ex: xxxxxxxxxX/V"  onblur="nicnumber()">
              
            </div>
          </div>
          
         
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Email ID</label>
            <div class="controls">
              <input type="email" class="span8 typeahead" id="txt_email" name="txt_email" value="<?php echo $row['email_id']; ?>">
              
            </div>
          </div>
           </td><td>
          
          <div class="control-group">
            <label class="control-label" for="date01">Date of Birth</label>
            <div class="controls">
              <input type="date" required class="span8 typeahead" id="txt_dob" value="<?php echo $row['dob']; ?>" name="txt_dob">
            </div>
          </div>
                   <?php
				    $branch_id=$_SESSION['branch_id'];
		  		$sql3 ="SELECT * FROM branch WHERE branch_id='$branch_id'";
				$result3=mysqli_query($connection,$sql3) or die ("mysql.error:".mysqli_error());
          		$row3=mysqli_fetch_assoc($result3)
          ?>
          <div class="control-group">
            <label class="control-label" for="typeahead">Branch Name</label>
            <div class="controls">
              
              					<input type="text" readonly name="txt_branchid" id="txt_branchid" class="span8 typeahead" value="<?php echo $row3['branch_name']; ?>">
               
                                            </div>
          </div>
         
          <div class="control-group">
            <label class="control-label" for="typeahead">Basic Salary</label>
            <div class="controls">
            <div class="input-prepend input-append">
             <?php
			global $userid;
			if(($userid==$_SESSION['username'])&&($_SESSION['usertype']=="manager"))
			{
			?>	
 <span class="add-on">Rs</span><input type="text" required class="" id="basic_text" maxlength="5" onkeypress="return isNumberKey(event)" name="txt_bsalary" readonly value="<?php echo $row['basic_salary']; ?>"><span class="add-on">.00</span>
  
              
            </div>
          </div>
          <?php		
			}
			else
			{
				?>
<span class="add-on">Rs</span><input type="text"  onkeypress="return isNumberKey(event)"  maxlength="5" required class="" id="basic_text"   name="txt_bsalary" value="<?php echo $row['basic_salary']; ?>"><span class="add-on">.00</span>
<?php
			}
			?>
              </div>
            </div>
          </div>
          
           <div class="control-group">
            <label class="control-label" for="typeahead">Photo </label>
            <div class="controls">
            <input class="input-file uniform_on" id="img_photo" type="text" name="img_photo" value="<?php echo $row['photo']; ?>">

            </div>
          </div>
          
               <?php 
		  		$sql4 ="SELECT * FROM user WHERE user_id='$sid'";
				$result4=mysqli_query($connection,$sql4) or die ("mysql.error:".mysqli_error());
				$row4=mysqli_fetch_assoc($result4)
          		
          ?>
          
            <div class="control-group">
            <label class="control-label" for="typeahead">Password</label>
            <div class="controls">
              <input type="password" required class="span8 typeahead"  name="txt_pass" value="<?php echo $row4['password']; ?>"  >
              
            </div>
          </div>
            <div class="control-group">
            <label class="control-label" for="typeahead">Staff Type</label>
            <div class="controls">
              <?php
			global $userid;
			if(($userid==$_SESSION['username'])&&($_SESSION['usertype']=="manager"))
			{
			?>	
 <input type="text" rows="5" cols="50"required class="span8 typeahead" id="txt_usertype" readonly name="txt_usertype" value="manager">
  
              
            </div>
          </div>
          <?php		
			}
			else
			{
				if($_SESSION['usertype']=="manager")
				{
				?>
              <select required id="txt_usertype" name="txt_usertype" class="span8 typeahead" data-rel="chosen">
                                  	<option selected value="<?php echo $row4['usertype']; ?>"><?php echo $row4['usertype']; ?></option>
                                  	<option value="ward-incharge">ward-incharge</option>
									<option Value="clerk">clerk</option>
                                    <option Value="doctor">doctor</option> 
                                    <option value="Labour">Labour</option>             
                                    
			  </select>
              	
             <?php
				}
				else
				{
					?>
                     <select required id="txt_usertype" name="txt_usertype" class="span8 typeahead" data-rel="chosen">
                                  	<option selected value="<?php echo $row4['usertype']; ?>"><?php echo $row4['usertype']; ?></option>
                                  	<option value="ward-incharge">ward-incharge</option>
									<option Value="clerk">clerk</option>
									<option value="admin">admin</option>
                                    <option Value="doctor">doctor</option>
                                    <option Value="manager">manager</option>
                                    <option value="Labour">Labour</option>              
                                    
			  </select>
                    <?php
				}
			}
			?>
              
            </div>
          </div>
          
 </td></tr></table>          
            
          <div class="form-actions">
            <button type="submit" class="btn btn-primary" name="savechanges" id="save">Save changes</button>
           
            <a href="<?php echo $viewpage; ?>"<button type="button" class="btn btn-success"><i class="icon-arrow-left icon-white"></i>Go Back</button></a>
          </div>
        </fieldset>

      </form>
    </div>
  </div>
  <!--/span-->
</div>
		<?php	
		exit;
		}
		//staff edit end
		
		//staff delete start
		elseif($_GET['status']=="staffdelete")
		{
			$sql2= "UPDATE staff SET staff_designation='Delete' WHERE user_id='$sid'";
			$result=mysqli_query($connection,$sql2) or die("Error in mysql :".mysqli_error());			
		}
		//staff delete end
	}
	
	?>
	
	
	
	
	
	
	
<!--/new entry design begin-->
<?php
	if(isset($_GET['option']))
	{
		//new staff entry begin
		if($_GET['option']=="new")
		{
			include ("config.php");
			$sql1 ="SELECT user_id FROM staff ORDER BY user_id ASC";
			$result=mysqli_query($connection,$sql1) or die ("mysqli.error:".mysqli_error());
			if(mysqli_num_rows($result)>0)
			{
				while($row=mysqli_fetch_assoc($result))
				{
					$Staff_No=$row['user_id'];
				}
				$n=(string)$Staff_No;
				$Staff_No=++$n;
			}
			else
			{
				$Staff_No="S001";
			}
?>
        
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-edit"></i> New Staff Entry</h2>
      </div>
    <div class="box-content">
      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <fieldset>
          <table width="100%">
          <tr><td>
          <div class="control-group">
            <label class="control-label" for="typeahead">Staff ID </label>
            <div class="controls">
         <input type="text" required class="span8 typeahead" name="txt_staffid" readonly id="txt_staffid"   value="<?php echo $Staff_No; ?>">
              
            </div>
          </div>  
               
               
    
    
    
    
          
          
          <div class="control-group">
								<label class="control-label" for="selectError" id="title_text">Title</label>
								<div class="controls">
								  <select required id="txt_title" class="span6 typeahead" name="txt_title" data-rel="chosen">
                                  <option></option>
                                  	<option value="Mr">Mr</option>
									<option value="Miss">Miss</option>
									<option value="Mrs">Mrs</option>
								 </select>
                                 
			</div>
  		  </div>
           
    
          
         
          	
          <div class="control-group">
            <label class="control-label" for="date01">Date of Birth</label>
            <div class="controls">
              <input type="date" required id="txt_dob" class="span6 typeahead" value="" name="txt_dob">
            </div>
          </div>
         
          <div class="control-group">
            <label class="control-label" for="typeahead">Full Name </label>
            <div class="controls">
              <input type="text" required class="span8 typeahead" name="txt_name" id="txt_name" onkeypress="return isTextKey(event)">   
           </div>
          </div>
          
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Designation </label>
            <div class="controls">
              
                                 <?php		
			
				if($_SESSION['usertype']=="manager")
				{
				?>
             <select required id="txt_designation" class="span6 typeahead" name="txt_designation" value="" data-rel="chosen">
                                  <option></option>
									<option value="clerk">Clerk</option>
									<option value="Doctor">Doctor</option>
                                    <option value="Ward incharge">Ward incharge</option>
                                    <option value="Accountant">Accountant</option>
                                    <option value="Labour">Labour</option>
								 </select>
              	
             <?php
				}
				else
				{
					?>
                     <select required id="txt_designation" class="span6 typeahead" name="txt_designation" value="" data-rel="chosen">
                                  <option></option>
									<option value="clerk">Clerk</option>
									<option value="superintendent">superintendent</option>
									<option value="Doctor">Doctor</option>
                                    <option value="Ward incharge">Ward incharge</option>
                                    <option value="Accountant">Accountant</option>
                                    <option value="Labour">Labour</option>
								 </select>
                    <?php
				}
			
			?>
              
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Address </label>
            <div class="controls">
              
              <textarea rows="3" cols="50" name="txt_address" id="txt_address" class="autogrow" ></textarea>
              
            </div>
          </div>
          
    
          
          
          <div class="control-group">
            <label class="control-label" for="inputIcon">Email ID</label>
            <div class="controls">
            <div class="input-prepend">
    <span class="add-on"><i class="icon-envelope" ></i></span><input type="email" required  id="txt_email"  name="txt_email"  >
             </div> 
            </div>
          </div>     
      
     </td>
    <td>    
          
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Contact No </label>
            <div class="controls">
              <input type="tel" required class="span8 typeahead" maxlength="10"id="txt_contactno" name="txt_contactno" placeholder="Ex: 07xxxxxxxx" onkeypress="return isNumberKey(event)" onblur="phonenumber()">
              
            </div>
          </div>
   
				
							          <div class="control-group">
            <label class="control-label" for="typeahead">NIC NO</label>
            <div class="controls">
              <input type="text" required class="span8 typeahead" maxlength="10" id="txt_nicno" name="txt_nicno" placeholder="Ex: xxxxxxxxxX/V"  onblur="nicnumber()">
              
            </div>
          </div>
          
      
         
                   <?php 
		  		$sql3 ="SELECT *  FROM branch";
				$result3=mysqli_query($connection,$sql3) or die ("mysqli.error:".mysqli_error());
          		
          ?>
          <div class="control-group">
            <label class="control-label" for="typeahead">Branch Name</label>
            <div class="controls">
            <?php
			if($_SESSION['usertype']=="manager")
			
				{
					$branch_id=$_SESSION['branch_id'];
					$sql4 ="SELECT *  FROM branch WHERE branch_id='$branch_id'";
				$result4=mysqli_query($connection,$sql4) or die ("mysqli.error:".mysqli_error());
				$row4=mysqli_fetch_assoc($result4);
					?>
					         <input type="text" name="txt_branchid" class="span8 typeahead" id="txt_branchid" readonly value="<?php echo $row4['branch_name'];?>">
			<?php
            	}
				else
				{
			?>
              
              					<select required name="txt_branchid" class="span8 typeahead" id="txt_branchid"  data-rel="chosen">
								<?php 
								
									while($row=mysqli_fetch_assoc($result3))
									{
										echo "<option value=".$row['branch_id'].">".$row['branch_name']."</option>";
									}
									?>										
								 </select>
                                 <?php
				}
				?>
            </div>
          </div>
         
          <div class="control-group">
            <label class="control-label" for="typeahead">Basic Salary</label>
            <div class="controls">
            <div class="input-prepend input-append ">
              <span class="add-on">Rs</span><input type="text" required   maxlength="5" onkeypress="return isNumberKey(event)" id="basic_text" name="txt_bsalary"><span class="add-on">.00</span>
              </div>
            </div>
          </div>
            <div class="control-group">
            <label class="control-label" for="typeahead">Photo </label>
            <div class="controls">
            <input type="file" name="img_photo">
<!--class="input-file uniform_on"-->
           </div>
          </div>
            <div class="control-group">
            <label class="control-label" for="typeahead">Password</label>
            <div class="controls">
              <input type="password" required name="txt_pass" id="txt_pass"  class="span8 typeahead" onBlur="password()">
              
            </div>
          </div>
            <div class="control-group">
            <label class="control-label" for="typeahead">Staff Type</label>
            <div class="controls">
               <?php		
			
				if($_SESSION['usertype']=="manager")
				{
				?>
              <select required id="txt_usertype" name="txt_usertype" class="span8 typeahead" data-rel="chosen">
                                     <option></option>
                                  	<option value="ward-incharge">ward-incharge</option>
									<option Value="clerk">clerk</option>
                                    <option Value="doctor">doctor</option> 
                                    <option value="Labour">Labour</option>             
                                    
			  </select>
              	
             <?php
				}
				else
				{
					?>
                     <select required id="txt_usertype" name="txt_usertype" class="span8 typeahead" data-rel="chosen">
                                  <option></option>
                                  	<option value="ward-incharge">ward-incharge</option>
									<option Value="clerk">clerk</option>
									<option value="admin">admin</option>
                                    <option Value="doctor">doctor</option>
                                    <option Value="manager">manager</option> 
                                    <option value="Labour">Labour</option>             
                                    
			  </select>
                    <?php
				}
			
			?>
              
            </div>
          </div>
          
 </td>
 </tr>

 </table>
    <div class="form-actions">
            <button type="submit" class="btn btn-primary" name="save" id="save">Save</button>
            <a href="<?php echo $viewpage; ?>" <button type="button" class="btn btn-success"><i class="icon-arrow-left icon-white"></i>  
										Go Back</button></a>
            <button type="reset" class="btn btn-danger" name="save" id="save" value="Reset">Reset</button>
          </div>       
            
          
        </fieldset>

      </form>
    </div>
  </div>
  <!--/span-->
</div>
<?php	
}
//new staff entry end
//view staff or search staff begin
elseif(($_GET['option']=="view"))
{
	global $bid;
?>
	<div class="row-fluid sortable" >		
		<div class="box span12" >
		<div class="box-header well" data-original-title>
        <?php
			if($_SESSION['usertype']=="admin" || $_SESSION['usertype']=="manager")
			{
				?>
                <?php
                if(!(isset($_GET['pr']) || isset($_GET['report'])))
				{
				?>
				<a class="btn btn-primary"  href="<?php echo $newpage; ?>"  ><i class="icon icon-add icon-orange"></i> Add New Staff </a>
                <a class="btn btn-primary"  href="<?php echo $pastpage; ?>"  ><i class=""></i> Retired Staff </a>
                <?php
			}
			}
			
			else
			{
				?>
				<h4><i class="icon-user"></i> Staff Information</h4>
                <?php
			}
			?>
			
		</div>
        
					<div class="box-content">
						
						   <?php
						if(isset($_GET['pr']))
						{
							echo "<center><table width=50% border=1 cellspacing=0 cellpadding=0>";
						}
						else
						{
							?>
							<table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <?php
						}
						?>
                          <thead>
                          
							  <tr>
								  <th>Staff ID</th>
								  <th>Staff Name</th>
								  <th>Designation</th>
								  <th>Branch Name</th>
                                   <?php 
								  if(!(isset($_GET['pr']) || isset($_GET['report'])))
									{
								  		echo "<th>Actions</th>";
									}
									?>
								
							  </tr>
						  </thead>   
						  <tbody>
	
							<?php
								$branch_id=$_SESSION['branch_id'];
								if($_SESSION['usertype']=="admin")
								{
									$sql2="SELECT * FROM staff";
								}
								else
								{
									$sql2="SELECT * FROM staff WHERE branch_id='$branch_id' and staff_designation!='superintendent'";
									
								}
								
								$result=mysqli_query($connection,$sql2);
								while($row=mysqli_fetch_assoc($result))
								{
									$bid=$row['branch_id'];
									$sql9 = "SELECT * FROM staff WHERE staff_designation  = '$row[staff_designation]'";

									$result9 = mysqli_query($connection,$sql9) or die('Query failed. ' . mysqli_error());
									$row9 = mysqli_fetch_assoc($result9);
									if($row9['staff_designation']=="Delete")
									{
										
									}
									else
									{
	/* The report php function start here EDIT HERE */
							?>
							<tr><td class="center" align="center"><?php echo $row['user_id']; ?></td><td class="center" align="center"><?php echo $row['name']; ?></td><td class="center" align="center"><?php echo $row['staff_designation']; ?></td><td class="center" align="center"><?php 
								$sql3="SELECT * FROM branch WHERE branch_id='$bid'";
								$result3=mysqli_query($connection,$sql3);
								$row3=mysqli_fetch_assoc($result3);
								$bname=$row3['branch_name'];
							echo $bname; ?></td>
                             <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
							?><td class="center"><a class="btn btn-success" href="<?php echo $viewpage; ?>&status=staffview&sid=<?php echo $row['user_id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <?php
                                    if($_SESSION['usertype']=="admin" || $_SESSION['usertype']=="manager")
									{ 
										?>
                               <a class="btn btn-info" href="<?php echo $viewpage; ?>&status=staffedit&sid=<?php echo $row['user_id']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
						<a class="btn btn-danger" href="<?php echo $viewpage; ?>&status=staffdelete&sid=<?php echo $row['user_id']; ?>" onclick="return deleteconfirm()">
										<i class="icon-trash icon-white"></i> 
										Delete
									</a>
                                    <?php
                                    }
									?>
                                    </td>
                                    <?php }?>
                                    </tr>
                        		<?php
									}
								}
								?>
                                </tbody>
                                
                                </table></center>
                                 <?php
							if(!isset($_GET['pr']))
							{
								?>
                                <a class="btn btn-info" 
				onclick="window.open('print.php?pr=staff.php&option=view','_blank')";
				><i class="icon icon-print icon-white"></i> print</a>
				<?php }?>
                                </div>
                                </div>
                                <?php
								
			}
elseif(($_GET['option']=="past"))
{
	global $bid;
?>
	<div class="row-fluid sortable" >		
		<div class="box span12" >
		<div class="box-header well" data-original-title>
        <?php
			if($_SESSION['usertype']=="admin" || $_SESSION['usertype']=="manager")
			{
				?>
                <?php
                if(!(isset($_GET['pr']) || isset($_GET['report'])))
				{
				?>
				<a class="btn btn-primary"  href="<?php echo $viewpage; ?>"  ><i class=""></i> Staff </a>
                <?php
				}
			}
				
			
			?>
			
		</div>
        
					<div class="box-content">
						
						   <?php
						if(isset($_GET['pr']))
						{
							echo "<center><table width=50% border=1 cellspacing=0 cellpadding=0>";
						}
						else
						{
							?>
							<table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <?php
						}
						?>
                          <thead>
                          
							  <tr>
								  <th>Staff ID</th>
								  <th>Staff Name</th>
								  <th>Designation</th>
								  <th>Branch Name</th>
                                   <?php 
								  if(!(isset($_GET['pr']) || isset($_GET['report'])))
									{
								  		echo "<th>Actions</th>";
									}
									?>
								
							  </tr>
						  </thead>   
						  <tbody>
							<?php
								$branch_id=$_SESSION['branch_id'];
								if($_SESSION['usertype']=="admin")
								{
									$sql2="SELECT * FROM staff";
								}
								else if($_SESSION['usertype']=="manager")
								{
									$sql2="SELECT * FROM staff WHERE branch_id='$branch_id'";
								}
								$result=mysqli_query($connection,$sql2);
								while($row=mysqli_fetch_assoc($result))
								{
									$bid=$row['branch_id'];
									$sql9 = "SELECT * FROM staff WHERE staff_designation = '$row[staff_designation]'";

									$result9 = mysqli_query($connection,$sql9) or die('Query failed. ' . mysqli_error());
									$row9 = mysqli_fetch_assoc($result9);
									if($row9['staff_designation']!="Delete")
									{
										
									}
									else
									{
							?>
							<tr><td class="center" align="center"><?php echo $row['user_id']; ?></td><td class="center" align="center"><?php echo $row['name']; ?></td><td class="center" align="center"><?php echo $row['staff_designation']; ?></td><td class="center" align="center"><?php 
								$sql3="SELECT * FROM branch WHERE branch_id='$bid'";
								$result3=mysqli_query($connection,$sql3);
								$row3=mysqli_fetch_assoc($result3);
								$bname=$row3['branch_name'];
							echo $bname; ?></td>
                             <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
							?><td class="center"><a class="btn btn-success" href="<?php echo $viewpage; ?>&status=staffview&sid=<?php echo $row['user_id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    
                                    </td>
                                    <?php 
									}
									?>
                                    </tr>
                        		<?php
									}
								}
								?>
                                </tbody>
                                
                                </table></center>
                                 <?php
							if(!isset($_GET['pr']))
							{
								?>
                                <a class="btn btn-info" 
				onclick="window.open('print.php?pr=staff.php&option=past','_blank')";
				><i class="icon icon-print icon-white"></i> print</a>
				<?php }?>
                                </div>
                                </div>
                                <?php
								
			}
	}
?>
<!--/new entry design end-->
</div>
	
</body>
</html>
<?php
}
else
{
//header("location:index.php");	
echo "Oops..!";
}

?>
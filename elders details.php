
<?php
	
	date_default_timezone_set('Asia/Colombo');
$utype=$_SESSION['usertype'];
?>
     <script >
	 function branchsel() //Option script for branch select if usertype is admin, in add new elder form
	{
	    var f = <?php echo json_encode($utype); ?>;
		var e = document.getElementById("txt_branchid");//get the branch name from add new elder form		
		var branchname = e.options[e.selectedIndex].text;
	    window.location.href = f+"home.php?pg=elders details.php&option=new&st1=" + branchname;
		//return false;
		//alert("branch selection");
		
	}
	 function homeseladmin() //Option script for home select if usertype is admin, in add new elder form
	{
	   var f = <?php echo json_encode($utype); ?>;
	    var w = document.getElementById("txt_homeno");	//get the home number from add new elder form	
		var homeno = w.options[w.selectedIndex].text;
		var e = document.getElementById("txt_branchid");//get the branch name from add new elder form		
		var branchname = e.options[e.selectedIndex].text;
	     window.location.href = f+"home.php?pg=elders details.php&option=new&st1=" + branchname+"&ht1="+homeno;
		//return false;
		//alert("admin home selection");
		
	}
	 function homeselman() //Option script for home select if usertype is manager/clerk, in add new elder form
	{
	    var f = <?php echo json_encode($utype); ?>;
		 var w = document.getElementById("txt_homeno");		//get the home number from add new elder form
		var homeno = w.options[w.selectedIndex].text;
	    window.location.href = f+"home.php?pg=elders details.php&option=new&ht1=" + homeno;
		//return false;
		//alert("man home selection");
		
	}
	 function wardseladmin() //Option script for ward select if usertype is admin, in add new elder form
	{
	   var f = <?php echo json_encode($utype); ?>;
	    var w = document.getElementById("txt_homeno");		
		var homeno = w.options[w.selectedIndex].text;
		var e = document.getElementById("txt_branchid");		
		var branchname = e.options[e.selectedIndex].text;
		var t = document.getElementById("txt_wardno");		
		var wardno = t.options[t.selectedIndex].value;
	     window.location.href = f+"home.php?pg=elders details.php&option=new&st1=" + branchname+"&ht1="+homeno+"&wt1="+wardno;
		//return false;
		//alert("admin ward selection");
		
	}
	 function wardselman() //Option script for ward select if usertype is manager/clerk, in add new elder form
	{
	    var f = <?php echo json_encode($utype); ?>;
		 var w = document.getElementById("txt_homeno");		
		var homeno = w.options[w.selectedIndex].text;
		var t = document.getElementById("txt_wardno");		
		var wardno = t.options[t.selectedIndex].value;
	    window.location.href = f+"home.php?pg=elders details.php&option=new&ht1=" + homeno+"&wt1="+wardno;
		//return false;
		//alert("man ward selection");
		
	}
	 function bedseladmin() //Option script for bed select if usertype is admin, in add new elder form
	{
	   var f = <?php echo json_encode($utype); ?>;
	    var w = document.getElementById("txt_homeno");		
		var homeno = w.options[w.selectedIndex].text;
		var e = document.getElementById("txt_branchid");		
		var branchname = e.options[e.selectedIndex].text;
		var t = document.getElementById("txt_wardno");		
		var wardno = t.options[t.selectedIndex].value;
		var b = document.getElementById("txt_bedno");		
		var bedno = b.options[b.selectedIndex].text;
	     window.location.href = f+"home.php?pg=elders details.php&option=new&st1=" + branchname+"&ht1="+homeno+"&wt1="+wardno+"&bt1="+bedno;
		//return false;
		//alert("man ward selection");
	}
	 function bedselman() //Option script for bed select if usertype is manager/clerk, in add new elder form
	{
	    var f = <?php echo json_encode($utype); ?>;
		 var w = document.getElementById("txt_homeno");		
		var homeno = w.options[w.selectedIndex].text;
		var t = document.getElementById("txt_wardno");		
		var wardno = t.options[t.selectedIndex].value;
		var b = document.getElementById("txt_bedno");		
		var bedno = b.options[b.selectedIndex].text;
	    window.location.href = f+"home.php?pg=elders details.php&option=new&ht1=" + homeno+"&wt1="+wardno+"&bt1="+bedno;
		//return false;
		//alert("man ward selection");
		
	}
	
</script>



<?php
include ("config.php");
$utype=$_SESSION['usertype'];
if(isset($_SESSION['username']) && ($_SESSION['usertype']=='admin' ||$_SESSION['usertype']=='manager' ||$_SESSION['usertype']=='clerk' ||$_SESSION['usertype']=='ward-incharge' || $_SESSION['usertype']=='doctor'))
{
	if($_SESSION['usertype']=="admin")
	{
		$newpage="adminhome.php?pg=elders details.php&option=new";
		$viewpage="adminhome.php?pg=elders details.php&option=view";
	}
	elseif($_SESSION['usertype']=="manager")
	{
		$newpage="managerhome.php?pg=elders details.php&option=new";
		$viewpage="managerhome.php?pg=elders details.php&option=view";
	}
	elseif($_SESSION['usertype']=="clerk")
	{
		$newpage="clerkhome.php?pg=elders details.php&option=new";
		$viewpage="clerkhome.php?pg=elders details.php&option=view";
	}
	elseif($_SESSION['usertype']=="ward-incharge")
	{
		$viewpage="wardincharhome.php?pg=elders details.php&option=view";
	}
	elseif($_SESSION['usertype']=="doctor")
	{
		$viewpage="doctorhome.php?pg=elders details.php&option=view";
	}
	?>

<?php	
	if(isset($_GET['st1']))
	{
			global $branchselect;
			$branchselect = $_GET['st1'];
	}
	if(isset($_GET['ht1']))
	{
			global $homeselect;
			$homeselect = $_GET['ht1'];
	}
	if(isset($_GET['wt1']))
	{
			global $wardselect;
			$wardselect = $_GET['wt1'];
	}
	if(isset($_GET['bt1']))
	{
			global $bedselect;
			$bedselect = $_GET['bt1'];
	}
?>
    <?php
	include ("config.php");
$utype=$_SESSION['usertype'];
	if(isset($_POST['saveadd'])) //coding start for add new elder to database
	{
		if($_SESSION['usertype']=="admin")//if user type is admin select the baranch id for selected branch name in form
		{
			$barnchid=$_POST['txt_branchid'];
		}
		else //if user type is manager/clerk select the baranch id for their branch name
		{
			$sql8 ="SELECT *  FROM branch WHERE branch_name='$_POST[txt_branchid]'";
				$result8=mysqli_query($connection,$sql8) or die ("mysqli.error:".mysqli_error());
				$row8=mysqli_fetch_assoc($result8);
				$barnchid=$row8['branch_id'];
		}
		//file (elder's photo) upload start
		
		
			if(file_exists("upload/".$_FILES["img_photo"]["name"]))
			{
				echo $_FILES["img_photo"]["name"]."already exists.";
			}
			else
			{
				move_uploaded_file($_FILES["img_photo"]["tmp_name"],"photos/".$_FILES["img_photo"]["name"]);
			}
		
		
		//file upload end
		
		$date=date("Y-m-d", strtotime($_POST['txt_dob']));//convert the date to date format of database
		$date1=date("Y-m-d", strtotime($_POST['txt_doj']));//convert the date to date format of database
		$sql2 = "INSERT INTO guardian(admission_no,name,contact_no,address) 
						VALUES(
						'".mysqli_real_escape_string($connection,$_POST['txt_admission'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_name1'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_contactno'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_address1'])."'
						)";
		
		
		
		$sql = "INSERT INTO elders(admission_no,name,address,dob,joint_date,photo,location,home_no,gender,ward_no, status,religion,bed_no,branch_id)
						VALUES(
						'".mysqli_real_escape_string($connection,$_POST['txt_admission'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_name'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_address'])."',
						'".mysqli_real_escape_string($connection,$date)."',
						'".mysqli_real_escape_string($connection,$date1)."',
						'".mysqli_real_escape_string($connection,$_FILES["img_photo"]["name"])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_location'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_homeno'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_gender'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_wardno'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_status'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_religion'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_bedno'])."',
						'".mysqli_real_escape_string($connection,$barnchid)."'
						)";
						
				$result2=mysqli_query($connection,$sql2) or die("Error in sql2 ".mysqli_error());
						
				$result=mysqli_query($connection,$sql) or die("Error in sql ".mysqli_error());
					if($result and $result2)//if successful go to view page
						{
								echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
				echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$viewpage.'?pg=elders details.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
						}
						else
						{
							echo mysqli_error();
						}
	}
		
		
        


	if(isset($_POST['savechanges']))//coding start for edit/update of elders details.
	{
		
		$adm=$_POST['txt_admission'];
		$branch=$_POST['txt_branchid'];
		$sql3 ="SELECT * FROM branch WHERE branch_name='$branch'";
				$result3=mysqli_query($connection,$sql3) or die ("mysqli.error:".mysqli_error());
				$row3=mysqli_fetch_assoc($result3);
		$sql="UPDATE elders SET 
							name='".mysqli_real_escape_string($connection,$_POST['txt_name'])."',
							address=	'".mysqli_real_escape_string($connection,$_POST['txt_address'])."',
							 dob='".mysqli_real_escape_string($connection,$_POST['txt_dob'])."',
							 joint_date='".mysqli_real_escape_string($connection,$_POST['txt_doj'])."',
							photo='".mysqli_real_escape_string($connection,$_POST['img_photo'])."',
							location='".mysqli_real_escape_string($connection,$_POST['txt_location'])."',
							home_no='".mysqli_real_escape_string($connection,$_POST['txt_homeno'])."',
						    gender= '".mysqli_real_escape_string($connection,$_POST['txt_gender'])."',
						ward_no='".mysqli_real_escape_string($connection,$_POST['txt_wardno'])."',
						status='".mysqli_real_escape_string($connection,$_POST['txt_status'])."',
						religion='".mysqli_real_escape_string($connection,$_POST['txt_religion'])."',
						bed_no='".mysqli_real_escape_string($connection,$_POST['txt_bedno'])."',
						branch_id='".mysqli_real_escape_string($connection,$row3['branch_id'])."'
						
						WHERE admission_no='$adm'";
			$result=mysqli_query($connection,$sql);
			$sql1="UPDATE guardian SET 
							name='".mysqli_real_escape_string($connection,$_POST['txt_name1'])."',
						contact_no='".mysqli_real_escape_string($connection,$_POST['txt_contactno'])."',
						address='".mysqli_real_escape_string($connection,$_POST['txt_address1'])."'
						WHERE admission_no='$adm'";
			$result=mysqli_query($connection,$sql1);
										
	}
	?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Elders home</title>
<script type="text/javascript">
function deleteconfirm() // make alert for delete elders details 
{
	var x=confirm("Are you delete this record");
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
      <h2><i class="icon-edit"></i>Elder's Details </h2>
      
    </div>
  <?php }
  
    else
    {
	?>
		<div class="box-header well" data-original-title>
    <center>  <h2><i class="icon-edit"></i> Elder's Home Elders Details Report</h2></center>
      
    </div>
    
    <?php 
    }
    if(isset($_GET['status']))//status option start
	{
		
		 $adm=$_GET['adm'];
		 
		//Staff view start
		if($_GET['status']=="eldersview")//the coding start for elders view
		{
			$sql1 ="SELECT * FROM elders WHERE admission_no='$adm'";
			$result=mysqli_query($connection,$sql1) or die ("mysqli.error:".mysqli_error());
			$row=mysqli_fetch_assoc($result);
			?>
			<div class="row-fluid sortable">		
				<div class="box span6">
                <?php
							if((isset($_GET['pr']) || isset($_GET['report'])))//allow user, if report or print button is set
							{
							?>
    <div class="box-header well" data-original-title>
   <center>   <h3><i class="icon-edit"></i>Elder's Home Elders personal Details</h3></center>
      
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
						<tr><td>Admission No</td><td><?php echo $row['admission_no']; ?></td>
                        <tr><td>Full Name</td><td><?php echo $row['name']; ?></td>
                        <tr><td>Address</td><td><?php echo $row['address']; ?></td>
                        <tr><td>DoB</td><td><?php echo $row['dob']; ?></td>
                        <tr><td>Joint Date</td><td><?php echo $row['joint_date']; ?></td>
                        <tr><td>Photo</td><td><?php echo $row['photo']; ?></td>
                        <tr><td>Location</td><td><?php echo $row['location']; ?></td>
                        <tr><td>Home No</td><td><?php echo $row['home_no']; ?></td>
                        <tr><td>Gender</td><td><?php echo $row['gender']; ?></td>
                        <tr><td>Ward No</td><td><?php echo $row['ward_no']; ?></td>
                        <tr><td>Status</td><td><?php echo $row['status']; ?></td>
                        <tr><td>Religion</td><td><?php echo $row['religion']; ?></td>
                        <tr><td>Bed No</td><td><?php echo $row['bed_no']; ?></td>
                        <tr><td>Branch Name</td><td><?php 
										$bid=$row['branch_id'];
										$sql2 ="SELECT branch_name FROM branch WHERE branch_id='$bid'";
										$result2=mysqli_query($connection,$sql2) or die ("mysqli.error:".mysqli_error());
										$row2=mysqli_fetch_assoc($result2);
						
										echo $row2['branch_name']; ?></td></tr>
                        
                        
                        <?php 
		  		$sql4 ="SELECT * FROM guardian WHERE admission_no='$adm'";
				$result4=mysqli_query($connection,$sql4) or die ("mysqli.error:".mysqli_error());
				$row4=mysqli_fetch_assoc($result4)
          		
          ?>
             <tr><td> <h4><i class="icon-edit"></i>Guardian Details </h4><br></td></tr>
          
                        <tr><td>Full Name</td><td><?php echo $row4['name']; ?></td></tr>
                         <tr><td>Contact No</td><td><?php echo $row4['contact_no']; ?></td></tr>
                         <tr><td>Address</td><td><?php echo $row4['address']; ?></td></tr>
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
									</a>&nbsp;&nbsp;&nbsp;   
	                                
                                  <?php  if($_SESSION['usertype']=="admin" || $_SESSION['usertype']=="manager")
								  {?>
                                    <a class="btn btn-info" 
				onclick="window.open('print.php?pr=elders details.php&option=view&status=eldersview&adm=<?php echo $row['admission_no']?>','_blank')";
				><i class="icon icon-print icon-white"></i> print</a></td><td></td></tr>
								<?php   }?>
                                   <?php
								  
								}
								?>
          						</table></center>
                                
                     </div>
                 </div>
			</div>
            
            <?php
			exit;
		}
		 
		
		//elders view end
		
		//elders edit start
		elseif($_GET['status']=="eldersedit")
		{
			$sql1 ="SELECT * FROM elders WHERE admission_no='$adm'";
			$result=mysqli_query($connection,$sql1) or die ("mysqli.error:".mysqli_error());
			$row=mysqli_fetch_assoc($result);
			global $adm;
			$adm=$row['admission_no'];
			?>
    		 <div class="box-content">
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=eldersview&adm=<?php echo $adm; ?>" method="post">
        <fieldset>
          <table width="100%">
          <tr><td>
          <div class="control-group">
            <label class="control-label" for="typeahead">Admission No </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_admission" id="txt_admission"   readonly
               value="<?php echo $row['admission_no']; ?>" >
              
            </div>
          </div>  
      		  
        
          <div class="control-group">
          
            <label class="control-label" for="typeahead">Full Name </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_name" id="txt_name" value="<?php echo $row['name']; ?>"  onkeypress="return isTextKey(event)"> 
           </div>
          </div>
          
        
          <div class="control-group">
            <label class="control-label" for="typeahead">Address </label>
            <div class="controls">
             <input type="textarea" rows="5" cols="50"required class="input-xlarge focused" id="txt_address" name="txt_address" value="<?php echo $row['address']; ?>">
            
              
            </div>
          </div>
          
          
             <div class="control-group">
            <label class="control-label" for="date01">DoB</label>
            <div class="controls">
              <input type="date" required class="input-xlarge focused" id="txt_dob" value="<?php echo $row['dob']; ?>" name="txt_dob" readonly>
            </div>
          </div>
             <div class="control-group">
            <label class="control-label" for="date01">Joint Date</label>
            <div class="controls">
              <input type="date" required class="input-xlarge focused" id="txt_doj" value="<?php echo $row['joint_date']; ?>" name="txt_doj" readonly>
            </div>
          </div>
            <div class="control-group">
            <label class="control-label" for="typeahead">Photo </label>
            <div class="controls">
            <input class="input-file uniform_on" id="fileInput" type="text" name="img_photo" value="<?php echo $row['photo']; ?>">

            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="typeahead">Location</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_location" name="txt_location" 
              value="<?php echo $row['location']; ?>">
              
            </div>
          </div>
    </td><td>
				
							          <div class="control-group">
            <label class="control-label" for="typeahead">Home No</label>
            <div class="controls">
           <input type="text" required class="input-xlarge focused" id="txt_homeno" name="txt_homeno"  value="<?php echo $row['home_no']; ?>" readonly>
            
              
            </div>
          </div>
          		  <div class="control-group">
								<label class="control-label" for="selectError">Gender</label>
								<div class="controls">
								  <select id="selectError" name="txt_gender" data-rel="chosen">
                                  <?Php
								  if($row['gender']=="Male")
                                  {
                                  		echo "<option value='$row[gender]' selected >$row[gender]</option>";
										echo "<option>Female</option>";
                                  }
								  else
								  {
										echo "<option value='$row[gender]' selected >$row[gender]</option>";
										echo "<option>Male</option>"; 
								  }
								  ?> 								                  
                                  </select>
								</div>
			    </div>
                             
               <div class="control-group">
            <label class="control-label" for="typeahead">Ward No</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_wardno" name="txt_wardno" readonly 
              value="<?php echo $row['ward_no']; ?>" >
              </div>
              </div>
              
              
              
              			  <div class="control-group">
								<label class="control-label">Status</label>
								<div class="controls">
                                <?php 
								if($row['status']=='Live')
								{
									?>
								
								
								  <label class="radio">
                                  
					<input type="radio" name="txt_status"  id="txt_status" checked value="Live" >Live</label>
								  <div style="clear:both"></div>
						<label class="radio">
						<input type="radio"  name="txt_status" id="txt_status" value="Death" >Death</label>
								<?php
								}
								else
								{?>
									<label class="radio">
                                  
					<input type="radio" name="txt_status" id="txt_status"  value="Live" >Live</label>
								  <div style="clear:both"></div>
						<label class="radio">
						<input type="radio" name="txt_status" id="txt_status"   value="Death" checked>Death</label>
							<?php
                            	} 
								?>
							</div>
			    </div>
                              
                              <div class="control-group">
								<label class="control-label" for="selectError">Religion</label>
								<div class="controls">
								  <select id="txt_religion" name="txt_religion" data-rel="chosen">
                                  <option value="<?php echo $row['religion']; ?>"><?php echo $row['religion']; ?></option>
									<option>Hindu</option>
                                    <option>Buddhist</option>
									<option>Christian</option> 
                                    <option>Muslim</option>								                                 
                                  </select>
								</div>
							  </div>
                                                    					                 <div class="control-group">
            <label class="control-label" for="typeahead">Bed No</label>
            <div class="controls">
            <input type="text" required class="input-xlarge focused" id="txt_bedno" name="txt_bedno" value="<?php echo $row['bed_no']; ?>" readonly >
              </div>
              </div>
           <?php
				    //$branch_id=$_SESSION['branch_id'];
		  		$sql3 ="SELECT * FROM branch WHERE branch_id='$row[branch_id]'";
				$result3=mysqli_query($connection,$sql3) or die ("mysqli.error:".mysqli_error());
				$row3=mysqli_fetch_assoc($result3);	
          		
          ?>
          <div class="control-group">
            <label class="control-label" for="typeahead">Branch Name</label>
            <div class="controls">
          <!--    <select required name="txt_branchid" id="txt_branchid" class="input-xlarge focused" data-rel="chosen">
                                <?php 
								/*	while($row3=mysqli_fetch_assoc($result3))
									{
										if ($row['branch_id']==$row3['branch_id'])
										{
											?>
										<option selected value="<?php echo $row['branch_id']; ?>"><?php echo $row3['branch_name']; ?></option>
                                            <?php
										}
										?>
										<option value="<?php echo $row3['branch_id']; ?>"><?php echo $row3['branch_name']; ?></option>
                                        <?php
									}*/
									?>										
								 </select>-->
  <input type="text" required class="input-xlarge focused" readonly id="txt_branchid" name="txt_branchid" value="<?php echo $row3['branch_name']; ?>" >
                                
            </div>
          </div>
            <?php 
		  		$sql4 ="SELECT * FROM  guardian WHERE admission_no='$adm'";
				$result4=mysqli_query($connection,$sql4) or die ("mysqli.error:".mysqli_error());
				$row4=mysqli_fetch_assoc($result4)
          		
          ?>
        
         
         </td></tr></table>
         <h4><i class="icon-edit"></i>Guardian Details </h4><br><br>
          <div class="control-group">
          
            <label class="control-label" for="typeahead">Full Name </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_name1" id="txt_name1" value="<?php echo $row4['name']; ?>"  onkeypress="return isTextKey(event)" > 
           </div>
          </div>
            <div class="control-group">
            <label class="control-label" for="typeahead">Contact No </label>
            <div class="controls">
      <input type="tel" required class="input-xlarge focused" id="txt_contactno" name="txt_contactno"  placeholder="Ex: 07xxxxxxxx" onkeypress="return isNumberKey(event)" onblur="phonenumber()"
         value="<?php echo $row4['contact_no']; ?>" />
              
            </div>
          </div>
           <div class="control-group">
            <label class="control-label" for="typeahead">Address </label>
            <div class="controls">
              <input type="textarea" rows="5" cols="50"required class="input-xlarge focused" id="txt_address1" name="txt_address1" value="<?php echo $row4['address']; ?>">
              
              
            </div>
          </div>
          
          
           
            
          <div class="form-actions">
           <button type="submit" class="btn btn-primary" name="savechanges" id="savechanges">Save changes</button>
           
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
		//elders edit end
		
		//elders delete start
		elseif($_GET['status']=="eldersdelete")
		{
			
				$sql2="DELETE FROM guardian  WHERE admission_no='$adm'";
				$result=mysqli_query($connection,$sql2) or die("Error in mysqli :".mysqli_error());
			
			
		}
		//elders delete end
	}
	
	?>
	
    
    <?php
	if(isset($_GET['option']))
	{ 
	   global $admno;
		//new elders entry begin
		if($_GET['option']=="new")
		{//auto adm no
			include ("config.php");
			$sql1 ="SELECT admission_no FROM elders ORDER BY admission_no ASC";//select admission no fromelders table and order
			$result=mysqli_query($connection,$sql1) or die ("mysqli.error:".mysqli_error());
			if(mysqli_num_rows($result)>0)
			{
				while($row=mysqli_fetch_assoc($result))
				{
					$admno=$row['admission_no'];
				}
				$n=(string)$admno;
				$admno=++$n;
				
			}
			else
			{
				$admno="A0001";
	        }
	    
	
?>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Elders New Entry</h2>
                    </div>
    <div class="box-content">
      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <fieldset>
          <table width="100%">
          <tr><td>
          <div class="control-group">
            <label class="control-label" for="typeahead">Admission No </label>
            <div class="controls">
           <input type="text" required class="input-large focused" name="txt_admission" id="txt_admission" readonly  value="<?php echo $admno; ?>" >
              
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
			if($_SESSION['usertype']=="manager"||$_SESSION['usertype']=="clerk") // if user type is manager/clerk, display their's branch name
			
				{
					$branch_id=$_SESSION['branch_id'];
					$sql4 ="SELECT *  FROM branch WHERE branch_id='$branch_id'";
				$result4=mysqli_query($connection,$sql4) or die ("mysqli.error:".mysqli_error());
				$row4=mysqli_fetch_assoc($result4);
					?>
	 <input type="text" name="txt_branchid" class="input-large focused" id="txt_branchid" readonly value="<?php echo $row4['branch_name'];?>">
			<?php
            	}
				else if($_SESSION['usertype']=="admin") // if user type is admin, display their's branch name in option.
				{
			?>
              
              					
								<?php
								global $wardtypeselect;
								global $branchselect;
								echo "<select required name='txt_branchid' class='input-large focused' onchange='branchsel()' id='txt_branchid'  data-rel='chosen'>";
                               echo "<option></option> ";
							   
								
									do
									{
										if($row['branch_name']==$branchselect)
										 	{
												echo "<option selected value=".$row['branch_id'].">".$row['branch_name']."</option>"; 
											 }
											 else
											 {
												echo "<option value=".$row['branch_id'].">".$row['branch_name']."</option>";
											 }
									}
									while($row=mysqli_fetch_assoc($result3));
									?>										
								<?php									
								echo "</select>";
								?>
                                 <?php
				}
				?>
                </div>
                </div>
               
            <div class="control-group">
            <label class="control-label" for="typeahead">Home No</label>
            <div class="controls">
               <?php
			   global $branchselect;
				global $homeselect;
			if($_SESSION['usertype']=="manager"||$_SESSION['usertype']=="clerk")//check usertype manager or clerk
			
				{
					$branch_id=$_SESSION['branch_id'];//get session branchid
            	}
				else
				{
					$sql7 ="SELECT *  FROM branch WHERE branch_name='$branchselect'";
					$result7=mysqli_query($connection,$sql7) or die ("mysqli.error:".mysqli_error());
					$row7=mysqli_fetch_assoc($result7);
					$branch_id=$row7["branch_id"];
				}
									$sql5 ="SELECT DISTINCT home_no  FROM ward WHERE branch_id='$branch_id'";
									$result5=mysqli_query($connection,$sql5) or die ("mysqli.error:".mysqli_error());
									$row5=mysqli_fetch_assoc($result5);
									if($_SESSION['usertype']=="manager"||$_SESSION['usertype']=="clerk")
			
								{
									echo "<select required name='txt_homeno' class='input-large focused' onchange='homeselman()' id='txt_homeno'  data-rel='chosen'>";
									echo "<option selected></option> ";
									$count=0;
									do
									{
										 $count=0;
										$sql8 ="SELECT DISTINCT ward_no  FROM ward WHERE branch_id='$branch_id' AND home_no='$row5[home_no]'";
										$result8=mysqli_query($connection,$sql8) or die ("mysqli.error:".mysqli_error());
										$row8=mysqli_fetch_assoc($result8);
										
										do
										{
											$sql7 ="SELECT *  FROM elders WHERE branch_id='$branch_id' AND home_no='$row5[home_no]' AND ward_no='$row8[ward_no]' AND status='Live'";
										$result7=mysqli_query($connection,$sql7) or die ("mysqli.error:".mysqli_error());
										$row7=mysqli_fetch_assoc($result7);
											if(mysqli_num_rows($result7)==5)
											{
											}
											else
											{
												$count=$count+1;
												if($count==1)
												{
													if($row5['home_no']==$homeselect)
													{
														echo "<option selected value=".$row5['home_no'].">".$row5['home_no']."</option>"; 
													}
													else
													{
														echo "<option value=".$row5['home_no'].">".$row5['home_no']."</option>";
													}
												}
											}
										}
										while($row8=mysqli_fetch_assoc($result8));
									}
									while($row5=mysqli_fetch_assoc($result5));									
								echo "</select>";
								}
								else if($_SESSION['usertype']=="admin")//check usertype admin
								{
							echo "<select required name='txt_homeno' onchange='homeseladmin()' class='input-large focused' id='txt_homeno'  data-rel='chosen'>";
                               echo "<option selected></option> ";
							   $count=0;
									do
									{
										$count=0;
										$sql8 ="SELECT DISTINCT ward_no  FROM ward WHERE branch_id='$branch_id' AND home_no='$row5[home_no]'";
										$result8=mysqli_query($connection,$sql8) or die ("mysqli.error:".mysqli_error());
										$row8=mysqli_fetch_assoc($result8);
										
										do
										{
										$sql7 ="SELECT *  FROM elders WHERE branch_id='$branch_id' AND home_no='$row5[home_no]' AND ward_no='$row8[ward_no]' AND status='Live'";
										$result7=mysqli_query($connection,$sql7) or die ("mysqli.error:".mysqli_error());
										$row7=mysqli_fetch_assoc($result7);
										if(mysql_num_rows($result7)==5)
										{
										}
										else
										{
											$count=$count+1;
											if($count==1)
											{
										if($row5['home_no']==$homeselect)
										 	{
												echo "<option selected value=".$row5['home_no'].">".$row5['home_no']."</option>"; 
											 }
											 else
											 {
												echo "<option value=".$row5['home_no'].">".$row5['home_no']."</option>";
											 }
											}
										}
										}
										while($row8=mysql_fetch_assoc($result8));
									}
									while($row5=mysql_fetch_assoc($result5));									
								echo "</select>";
								}
									?>										
								 
             </div>
          </div>
      		  
               <div class="control-group">
            <label class="control-label" for="typeahead">Ward No</label>
            <div class="controls">
            <?php
			   global $branchselect;
				global $homeselect;
				global $wardselect;
			if($_SESSION['usertype']=="manager"||$_SESSION['usertype']=="clerk")//check usertype manager or clerk
			
				{
					$branch_id=$_SESSION['branch_id'];
            	}
				else
				{
					$sql7 ="SELECT *  FROM branch WHERE branch_name='$branchselect'";
					$result7=mysqli_query($connection,$sql7) or die ("mysqli.error:".mysql_error());
					$row7=mysqli_fetch_assoc($result7);
					$branch_id=$row7["branch_id"];
				}
									
									$sql5 ="SELECT DISTINCT *  FROM ward WHERE branch_id='$branch_id' AND home_no='$homeselect' AND no_of_beds!='0'";
									$result5=mysqli_query($connection,$sql5) or die ("mysqli.error:".mysql_error());
									$row5=mysqli_fetch_assoc($result5);
									if($_SESSION['usertype']=="manager"||$_SESSION['usertype']=="clerk")
			
								{
									echo "<select required name='txt_wardno' onchange='wardselman()' id='txt_wardno' class='input-large focused'  data-rel='chosen'>";
                               echo "<option ></option> ";
							  
									do
									{
										$sql7 ="SELECT *  FROM elders WHERE branch_id='$branch_id' AND home_no='$homeselect' AND ward_no='$row5[ward_no]' AND status='Live'";
										$result7=mysqli_query($connection,$sql7) or die ("mysqli.error:".mysqli_error());
										$row7=mysqli_fetch_assoc($result7);
										if(mysqli_num_rows($result7)==5)
										{
										}
										else
										{
										if($row5['ward_no']==$wardselect )
										 	{
												if(mysqli_num_rows($result7)>0)
												{
												echo "<option selected value=".$row5['ward_no'].">".$row5['ward_no']."(".$row5['ward_type'].")</option>"; 
												}
											 }
											 else
											 {
												
												echo "<option value=".$row5['ward_no'].">".$row5['ward_no']."(".$row5['ward_type'].")</option>";
												
											 }
										}
									}
									while($row5=mysql_fetch_assoc($result5));
									echo "</select>";
								}
								else if($_SESSION['usertype']=="admin")
								{
							echo "<select required name='txt_wardno' onchange='wardseladmin()' id='txt_wardno' class='input-large focused' data-rel='chosen'>";
                               echo "<option selected></option>";
									
									do
									{
										$sql7 ="SELECT *  FROM elders WHERE branch_id='$branch_id' AND home_no='$homeselect' AND ward_no='$row5[ward_no]' AND status='Live'";
										$result7=mysqli_query($connection,$sql7) or die ("mysqli.error:".mysqli_error());
										$row7=mysqli_fetch_assoc($result7);
										if(mysqli_num_rows($result7)==5)
										{
										}
										else
										{
										if($row5['ward_no']==$wardselect && $row5['ward_no']>=0)
										 	{
												if(mysqli_num_rows($result7)>0)
												{
												echo "<option selected value=".$row5['ward_no'].">".$row5['ward_no']."(".$row5['ward_type'].")</option>"; 
												}
											 }
											 else
											 {
												echo "<option value=".$row5['ward_no'].">".$row5['ward_no']."(".$row5['ward_type'].")</option>";
											 }
										}
									}
									while($row5=mysql_fetch_assoc($result5));
									echo "</select>";
								}
									?>
								
              </div>
              </div>
              <div class="control-group">
            <label class="control-label" for="typeahead">Bed No</label>
            <div class="controls"> 
             <?php
			  global $branchselect;
				global $homeselect;
				global $wardselect;
				global $bedselect;
			if($_SESSION['usertype']=="manager"||$_SESSION['usertype']=="clerk")
			
				{
					$branch_id=$_SESSION['branch_id'];
            	}
				else
				{
					$sql7 ="SELECT *  FROM branch WHERE branch_name='$branchselect'";
					$result7=mysqli_query($connection,$sql7) or die ("mysqli.error:".mysql_error());
					$row7=mysqli_fetch_assoc($result7);
					$branch_id=$row7["branch_id"];
				}
									
									$sql5 ="SELECT no_of_beds  FROM ward WHERE branch_id='$branch_id' AND home_no='$homeselect' AND ward_no='$wardselect'";
									$result5=mysqli_query($connection,$sql5) or die ("mysqli.error:".mysql_error());
									$row5=mysql_fetch_assoc($result5);
									$numofbeds=$row5['no_of_beds'];
									
									echo "<select required name='txt_bedno'  id='txt_bedno' class='input-large focused' data-rel='chosen'>";
									echo "<option selected></option> ";
							  	
								
										
										$sql7 ="SELECT *  FROM elders WHERE branch_id='$branch_id' AND home_no='$homeselect' AND ward_no='$wardselect' AND status='Live'";
										$result7=mysqli_query($connection,$sql7) or die ("mysqli.error:".mysqli_error());
										$row7=mysql_fetch_assoc($result7);
										$noofrows=mysql_num_rows($result7);
										$bed=array();
										$b=0;
										do
										{								
											$bed[$b]=$row7['bed_no'];
											$b++;
										}
										while($row7=mysql_fetch_assoc($result7));
										for($c=1;$c<=$numofbeds;$c++)
										{
											$beds=0;
											for($d=0;$d<$noofrows;$d++)
											{
												if($bed[$d]==$c)
												{
													$beds=$beds+1;
												}
												
											}
											if($beds==0)
											{
											echo "<option>".$c."</option> ";
											}
										}
										echo "</select>";
								?>										
								 
              </div>
              </div>
         
          <div class="control-group">
          
            <label class="control-label" for="typeahead">Full Name </label>
            <div class="controls">
              <input type="text" required class="input-large focused" name="txt_name" id="txt_name" value="" onkeypress="return isTextKey(event)" > 
           </div>
          </div>
          
        
          <div class="control-group">
            <label class="control-label" for="typeahead">Address </label>
            <div class="controls">
            <textarea rows="3" cols="50" name="txt_address" id="txt_address" class="autogrow" ></textarea>
              
            </div>
          </div>
          </td><td>
                    
             <div class="control-group">
            <label class="control-label" for="date01">Date of Birth</label>
            <div class="controls">
              <input type="date" required class="input-large focused" id="txt_dob" value="" name="txt_dob">
            </div>
          </div>
             <div class="control-group">
            <label class="control-label" for="date01">Joint Date</label>
            <div class="controls">
              <input type="date" required class="input-large focused" id="txt_doj" value="" name="txt_doj">
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
            <label class="control-label" for="typeahead">Location</label>
            <div class="controls">
              <input type="text" required class="input-large focused" id="txt_location" name="txt_location"  data-provide="typeahead" data-items="4">
              
            </div>
          </div>
    
				
			
          		  <div class="control-group">
								<label class="control-label" for="selectError">Gender</label>
								<div class="controls">
								  <select id="selectError" name="txt_gender"  class="input-large focused"data-rel="chosen">
                                  <option></option>
									<option>Male</option>
									<option>Female</option> 								                                  
									</select>
								</div>
							  </div>
                             
              
              
              
              
              			  <div class="control-group">
								<label class="control-label">Status</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="txt_status" id="txt_status" value="Live" checked="">
Live
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="txt_status" id="optionsRadios2" value="Death">Death</label>

							</div>
							  </div>
                              
                              <div class="control-group">
							      <label class="control-label" for="selectError">Religion    </label>
								<div class="controls">
								  <select id="txt_religion" name="txt_religion" class="input-large focused" data-rel="chosen">
                                  <option></option>
									<option>Hindu   </option>
                                    <option>Buddhist   </option>
									<option>Christian  </option> 
                                    <option>Muslim   </option>								                                  
                                  </select>
								
                               </div>
							  </div>
         
         </td>
		 </tr> 
		 </table>
		 <h4><i class="icon-edit"></i>Guardian Details </h4>
               
            <div class="control-group">
          
            <label class="control-label" for="typeahead">Full Name </label>
            <div class="controls">
              <input type="text" required class="input-large focused" name="txt_name1" id="txt_name1" value="" onkeypress="return isTextKey(event)" > 
           </div>
          </div>
            <div class="control-group">
            <label class="control-label" for="typeahead">Contact No </label>
            <div class="controls">
              <input type="tel" required class="input-large focused" maxlength="10" id="txt_contactno" name="txt_contactno" placeholder="Ex: 07xxxxxxxx" onkeypress="return isNumberKey(event)" onblur="phonenumber()"  />
              
            </div>
          </div>
           <div class="control-group">
            <label class="control-label" for="typeahead">Address </label>
            <div class="controls">
             
               <textarea rows="3" cols="50" name="txt_address1" id="txt_address1" class="autogrow" ></textarea>
            </div>
          </div>
          
          			
                               <div class="form-actions">
            <button type="submit" class="btn btn-primary"  name="saveadd" id="saveadd" > Save </button>
            <a href="<?php echo $viewpage; ?>"<button type="button" class="btn btn-success"><i class="icon-arrow-left icon-white"></i>  
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
//new elder entry end
//view elder or search elder begin
elseif(($_GET['option']=="view"))
        {
	global $bid;
	
?>

	<div class="row-fluid sortable">		
		<div class="box span12">
		<div class="box-header well" data-original-title>
        <?php
			if($_SESSION['usertype']=="admin" || $_SESSION['usertype']=="manager"||$_SESSION['usertype']=="clerk")
			{
				if(!(isset($_GET['pr']) || isset($_GET['report'])))
				{
				?>
                
				<a class="btn btn-primary " href="<?php echo $newpage; ?>"><i class="icon icon-add icon-orange"></i> Add New elder </a>
                <?php
				}
			}
			else
			{
				?>
				<h4><i class="icon-user"></i> Elders Information</h4>
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
								  <th width="5%">Admission No</th>
								  <th width="20%">Elder Name</th>
								  <th width="20%">Address</th>
                                  <th width="5%">Home No</th>
                                  <th width="5%">Ward No</th>
                                  <th width="5%">Status</th>
  								  <th width="5%">Branch Name</th>
                                  
                                  <?php 
								  if(!(isset($_GET['pr']) || isset($_GET['report'])))
									{
								  		echo "<th width=25%>Actions</th>";
									}
									?>
							  </tr>
						  </thead>   
						  <tbody>
							<?php
								$branch_id=$_SESSION['branch_id'];
								if($_SESSION['usertype']=="admin")
								{
									$sql2="SELECT * FROM elders";
								}
								else
								{
									$sql2="SELECT * FROM elders WHERE branch_id='$branch_id'";
								}
								$result=mysqli_query($connection,$sql2);
								while($row=mysqli_fetch_assoc($result))
								{
									$bid=$row['branch_id'];
							?>
                            
                           <?php
                            $sql4 ="SELECT user_id FROM user";
				   $result4=mysqli_query($connection,$sql4) or die ("mysqli.error:".mysqli_error());
				   $row4=mysqli_fetch_assoc($result4)
							?>
                            
							<tr><td class="center" align="center"><?php echo $row['admission_no']; ?></td><td class="center" align="center"><?php echo $row['name']; ?></td><td class="center" align="center"><?php echo $row['address']; ?></td><td class="center" align="center"><?php echo $row['home_no']; ?></td><td class="center" align="center"><?php echo $row['ward_no']; ?></td><td class="center" align="center"><?php echo $row['status']; ?></td><td class="center" align="center"><?php 
								$sql3="SELECT * FROM branch WHERE branch_id='$bid'";
								$result3=mysql_query($sql3);
								$row3=mysql_fetch_assoc($result3);
								$bname=$row3['branch_name'];
							echo $bname; ?></td>
                            <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
                            
                            <td class="center"> <a class="btn btn-success" href="<?php echo $viewpage; ?>&status=eldersview&adm=<?php echo $row['admission_no']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <?php
                                    if($_SESSION['usertype']=="admin" || $_SESSION['usertype']=="manager"||$_SESSION['usertype']=="clerk")
									{ 
										?>
                          <a class="btn btn-info" href="<?php echo $viewpage; ?>&status=eldersedit&adm=<?php echo $row['admission_no']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
                                    <?php
                                    if($_SESSION['usertype']<>"clerk")
									{?>
						<a class="btn btn-danger" href="<?php echo $viewpage; ?>&status=eldersdelete&adm=<?php echo $row['admission_no']; ?> " onclick="return deleteconfirm()">
										<i class="icon-trash icon-white"></i> 
										Delete
									</a>
									
                                    <?php
                                    }}
									?>
                                    
                                    </td>
                                    <?php } ?>
                                    </tr>
                                    
                        		<?php
								}
								?>
                                
                                </tbody>
                                </table></center>
                                 <?php
							if(!isset($_GET['pr']))
							{
							?>
							<?php  if($_SESSION['usertype']=="admin" || $_SESSION['usertype']=="manager")
								  {?>
                                <a class="btn btn-info" 
				onclick="window.open('print.php?pr=elders details.php&option=view','_blank')";
				><i class="icon icon-print icon-white"></i> print</a>
                <?php }?>
                <?php
                }
                ?>
                                </div>
                                </div>
                                
                                
                                <?php
								
								
	    }
	
	 
	}

?>
</div>




</body>
</html>
<?php
}
else
{
header("location:index.php");	
}

?>
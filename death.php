<?php
	date_default_timezone_set('Asia/Colombo');
	include ("config.php");
	if(isset($_SESSION['username']) && ($_SESSION['usertype']=='admin' || $_SESSION['usertype']=='manager' || $_SESSION['usertype']=='doctor'))
{
	if($_SESSION['usertype']=="admin")
	{
		//$newpage="adminhome.php?pg=death.php&option=new";
		$viewpage="adminhome.php?pg=death.php&option=view";
	}
	elseif($_SESSION['usertype']=="manager")
	{
		$newpage="managerhome.php?pg=death.php&option=new";
		$viewpage="managerhome.php?pg=death.php&option=view";
	}
	elseif($_SESSION['usertype']=="ward-incharge")
	{
		//$newpage="wardincharhome.php?pg=diagnosis.php&option=new";
		//$viewpage="wardincharhome.php?pg=death.php&option=view";
	}
	elseif($_SESSION['usertype']=="doctor")
	{
		$newpage="doctorhome.php?pg=death.php&option=new";
		$viewpage="doctorhome.php?pg=death.php&option=view";
	}
	
	
	
	
	
	
	if(isset($_POST['save']))
	{
		$date=date("Y-m-d", strtotime($_POST['txt_date']));
		$aid=$_POST['txt_admission'];
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
		
		$sql= "INSERT INTO death(admission_no,date,death_certificate,reason) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_admission'])."',
						'".mysql_real_escape_string($date)."',
						'".mysql_real_escape_string($_FILES["img_photo"]["name"])."',
						'".mysql_real_escape_string($_POST['txt_reason'])."'
						
						)";
		
		$sql1="UPDATE elders SET
		                    
						    status='".mysql_real_escape_string('Death')."'						
													
						WHERE admission_no='$aid'";
			
			
			$result1=mysql_query($sql1);
							
				$result=mysql_query($sql) or die("Error in sql ".mysql_error());
					if($result && $result1)
						{
							
							echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
				echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$viewpage.'?pg=death.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
						}
						else
						{
							echo mysql_error();
						}
	
	}

	
	if(isset($_POST['savechanges']))
	{
		
		$aid=$_POST['txt_admission'];     
		$sql2 ="SELECT * FROM elders WHERE name='$aid'";
			$result2=mysql_query($sql2) or die ("mysql.error:".mysql_error());
			$row2=mysql_fetch_assoc($result2);
		
		
		$sql="UPDATE death SET
		                    admission_no='".mysql_real_escape_string($row2['admission_no'])."', 
		                    date='".mysql_real_escape_string($_POST['txt_date'])."',
							death_certificate='".mysql_real_escape_string($_POST['img_photo'])."',
						    reason='".mysql_real_escape_string($_POST['txt_reason'])."'
							
							
													
						WHERE admission_no='$row2[admission_no]'";
			$result=mysql_query($sql);
		
			
										
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
	var x=confirm("Are You Sure delete this record");
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

    <div class="box-header well" data-original-title>
      <h2><i class="icon-edit"></i> Death Details </h2>
      
    </div>
    
    
    
	<?php
	if(isset($_GET['status']))
	{
		
		$aid=$_GET['aid'];     
		
	
		 
		 
		//death view start
		if($_GET['status']=="deathview")
		{
			$sql1 ="SELECT * FROM death WHERE admission_no='$aid'";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			
			$sql2 ="SELECT * FROM elders WHERE admission_no='$aid'";
			$result2=mysql_query($sql2) or die ("mysql.error:".mysql_error());
			$row2=mysql_fetch_assoc($result2);
			?>
			<div class="row-fluid sortable">		
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i>Death Details</h2>
                        
					</div>
                 
                    
                    
                    
                    
				  <div class="box-content">
						<table class="table">
						<tr><td>Admission No</td><td><?php echo $row2['name']; ?></td>
                        <tr><td>Date</td><td><?php echo $row['date']; ?></td>
                        <tr><td>Death Certificate</td><td><?php echo $row['death_certificate']; ?></td>
                        <tr><td>Reason</td><td><?php echo $row['reason']; ?></td>
                       
                                               
                        
                               
                         <tr><td><a class="btn btn-success" href="<?php echo $viewpage; ?>">
										<i class="icon-arrow-left icon-white"></i>  
										Go back                                            
									</a></td><td></td></tr>
                                     
          						</table>
                     </div>
                 </div>
			</div>
            
            <?php
			exit;
		}
		//death view end
		
		//death edit start
		elseif($_GET['status']=="deathedit")
		{
			$sql1 ="SELECT * FROM death WHERE admission_no='$aid'";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			
			$sql2 ="SELECT * FROM elders WHERE admission_no='$aid'";
			$result2=mysql_query($sql2) or die ("mysql.error:".mysql_error());
			$row2=mysql_fetch_assoc($result2);
			
			?>

<div class="box-content">
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=deathview&aid=<?php echo $aid; ?>" method="post">
        <fieldset>
        
        <table width="100%">
          <tr><td>
  <div class="control-group">
            <label class="control-label" for="typeahead">Admission No </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_admission" id="txt_admission"   value="<?php echo $row2['name']; ?>" >
              
            </div>
          </div>  
          
           <div class="control-group">
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
              <input type="date" required class="input-xlarge focused" id="txt_date" value="<?php echo $row['date']; ?>" name="txt_date">
            </div>
          </div>
         
                              
             
          
          
          
           <div class="control-group">
            <label class="control-label" for="typeahead">Death Certificate </label>
            <div class="controls">
            <input  id="img_photo" type="text" name="img_photo" value="<?php echo $row['death_certificate']; ?>">

          </div>
          </div>
        
      		  
              				          <div class="control-group">
            <label class="control-label" for="typeahead">Reason</label>
            <div class="controls">
           <input type="text" required class="input-xlarge focused" id="txt_reason" name="txt_reason" value="<?php echo $row['reason']; ?>" >
            
              
            </div>
          </div>
          
         
          
<div class="form-actions">
           <button type="submit" class="btn btn-primary" name="savechanges" id="save">Save changes</button>
           
            <a href="<?php echo $viewpage; ?>"<button type="button" class="btn btn-success"><i class="icon-arrow-left icon-white"></i>Go Back</button></a>
          </div>
          
          </td></tr>
          </table>
    </fieldset>
    </form>

 </div>
  </div>
  <!--/span-->
</div>
	<?php	
		exit;
		}
			//death edit end
		
		//death delete start
		elseif($_GET['status']=="deathdelete")
		{
			$sql2="DELETE FROM death  WHERE admission_no='$aid'";
			$result=mysql_query($sql2) or die("Error in mysql :".mysql_error());
			
			$sql1="UPDATE elders SET
		                    
						    status='".mysql_real_escape_string('Live')."'						
													
						WHERE admission_no='$aid'";
			
			
			$result1=mysql_query($sql1);
			
		}
		//death delete end
	}
	
	?>
     <?php
	if(isset($_GET['option']))
	{ 
	  
		//death  entry begin
		if($_GET['option']=="new")
		{
			include ("config.php");
			
	
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Elders Home</title>
</head>

<body>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-edit"></i>Death Details From</h2>
      
    </div>
<div class="box-content">
      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <fieldset>
        
        <table width="100%">
        <tr><td>
  
    <div class="control-group">
            <label class="control-label" for="typeahead">Admission No </label>
            <div class="controls">
              <?php
								
								$branch_id=$_SESSION['branch_id'];
								$name=$_SESSION['username'];
								 echo "<select required name='txt_admission'  id='txt_admission' data-rel='chosen'>";
										 echo "<option></option>";
								
										$sql5="SELECT *  FROM elders WHERE branch_id='$branch_id' AND status='Live'";
				                          $result5=mysql_query($sql5) or die ("mysql.error:".mysql_error());
          		                         $row5=mysql_fetch_assoc($result5);
										 do
										 {
										 	
												echo "<option value=".$row5['admission_no'].">".$row5['name']."</option>";
											}
											while($row5=mysql_fetch_assoc($result5));
									echo "</select>";
									?>
            </div>
          </div>  
          
           <div class="control-group">
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
              <input type="date" required class="input-xlarge focused" id="txt_date" value="" name="txt_date">
            </div>
          </div>
         
                              
           
          
         <div class="control-group">
            <label class="control-label" for="typeahead">Death Certificate </label>
            <div class="controls">
            <input id="img_photo" type="file" id="img_photo" name="img_photo" value="">

          </div>
          </div>
      		  
              				          <div class="control-group">
            <label class="control-label" for="typeahead">Reason</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_reason" name="txt_reason" value="" >
            
              
            </div>
          </div>
          
                
          
                   
          
         

   <div class="form-actions">
            <button type="submit" class="btn btn-primary" name="save" id="save">Save</button>
            <a href="<?php echo $viewpage; ?>"<button type="button" class="btn btn-success"><i class="icon-arrow-left icon-white"></i>  
										Go Back</button></a>
            <button type="reset" class="btn btn-danger" name="save" id="save" value="Reset">Reset</button>
        </div>
        </td></tr>
        </table>
        </fieldset>

      </form>
       </div>
	
  </div>
 <!--/span-->
</div>
<?php	
}
//new death entry end
//view death or search death begin
elseif(($_GET['option']=="view"))
        {
	global $aid;
	
	
	
?>
<div class="row-fluid sortable">		
		<div class="box span12">
		<div class="box-header well" data-original-title>
        <?php
			if($_SESSION['usertype']=="doctor" || $_SESSION['usertype']=="manager" )
			{
				?>
				<a class="btn btn-primary " href="<?php echo $newpage; ?>"><i class="icon icon-add icon-orange"></i> Add New Death</a>
                <?php
			}

			else
			{
				?>
				<h4><i class="icon-user"></i> Death Information</h4>
                <?php
			}
			?>
            </div>
            <div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Admission No</th>
								   <th>Date</th>
                                   <th>Reason</th>
								 <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                          	<?php
								$branch_id=$_SESSION['branch_id'];
								if($_SESSION['usertype']=="admin")
								{
									$sql2="SELECT * FROM death";
								
									$result=mysql_query($sql2);
									while($row=mysql_fetch_assoc($result))
									{						
									$sql3 ="SELECT * FROM elders WHERE admission_no='$row[admission_no]'";
									$result3=mysql_query($sql3) or die ("mysql.error:".mysql_error());
									$row3=mysql_fetch_assoc($result3);                       
									?>
									<tr><td class="center"><?php echo $row3['name']; ?></td><td class="center"><?php echo $row['date']; ?></td><td class="center"><?php echo $row['reason']; ?></td><td class="center"><a class="btn btn-success"   href="<?php echo $viewpage; ?>&status=deathview&aid=<?php echo $row['admission_no']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                 
									
                                   </td></tr>
                                    <?php
									}
												
								}
								else
								{
									$sql2="SELECT * FROM elders WHERE branch_id='$branch_id'";					
									$result=mysql_query($sql2);
									while($row=mysql_fetch_assoc($result))
									{			
									$sql3 ="SELECT * FROM death WHERE admission_no='$row[admission_no]'";
									$result3=mysql_query($sql3) or die ("mysql.error:".mysql_error());
									$row3=mysql_fetch_assoc($result3);
			              
											if(mysql_num_rows($result3)==0)
												{
											 
												}
												else
												{    
													?>
												<tr><td class="center"><?php echo $row['name']; ?></td><td class="center"><?php echo $row3['date']; ?></td><td class="center"><?php echo $row3['reason']; ?></td><td class="center"><a class="btn btn-success"   href="<?php echo $viewpage; ?>&status=deathview&aid=<?php echo $row['admission_no']; ?>">
												<i class="icon-zoom-in icon-white"></i>  
												View                                            
													</a>
                                     
												<?php
										 
								
												if($_SESSION['usertype']=="doctor"|| $_SESSION['usertype']=="manager")
												{ 
												?>
												<a class="btn btn-info" href="<?php echo $viewpage; ?>&status=deathedit&aid=<?php echo $row['admission_no']; ?>">
												<i class="icon-edit icon-white"></i>  
												Edit                                            
												</a>
												<a class="btn btn-danger" href="<?php echo $viewpage; ?>&status=deathdelete&aid=<?php echo $row['admission_no']; ?>" onclick="return deleteconfirm()">
												<i class="icon-trash icon-white"></i> 
												Delete
												</a>
												<?php
												}
												}
												?>
												</td></tr>
												<?php
									}
								}
								?>
                                </tbody>
                                </table>
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
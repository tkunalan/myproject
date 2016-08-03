<?php
	date_default_timezone_set('Asia/Colombo');
	include ("config.php");
		if(isset($_SESSION['username']) && ($_SESSION['usertype']=='ward-incharge' || $_SESSION['usertype']=='doctor'))
{
	if($_SESSION['usertype']=="admin")
	{
		//$newpage="adminhome.php?pg=.php&option=new";
		//$viewpage="adminhome.php?pg=.php&option=view";
	}
	elseif($_SESSION['usertype']=="manager")
	{
		//$newpage="managerhome.php?pg=supply.php&option=new";
		//$viewpage="managerhome.php?pg=medicine.php&option=view";
	}
	elseif($_SESSION['usertype']=="ward-incharge")
	{
		//$newpage="wardincharhome.php?pg=diagnosis.php&option=new";
		$viewpage="wardincharhome.php?pg=diagnosis.php&option=view";
	}
	elseif($_SESSION['usertype']=="doctor")
	{
		$newpage="doctorhome.php?pg=diagnosis.php&option=new";
		$viewpage="doctorhome.php?pg=diagnosis.php&option=view";
	}
	
	
	
	
	
	
	if(isset($_POST['save']))
	{
		$date=date("Y-m-d", strtotime($_POST['txt_date']));
		$aid=$_POST['txt_admission'];     
		$did=$_POST['txt_date'];
		$uid=$_POST['txt_userid'];
									$sql5="SELECT *  FROM staff WHERE name='$uid' ";
				                     $result5=mysqli_query($connection,$sql5) or die ("mysql.error:".mysqli_error());
          		                         $row5=mysqli_fetch_assoc($result5);
		
		$sql= "INSERT INTO diagnosis(date,admission_no,user_id,remarks) 
						VALUES(
						'".mysqli_real_escape_string($connection,$date)."',
						'".mysqli_real_escape_string($connection,$_POST['txt_admission'])."',
						'".mysqli_real_escape_string($connection,$row5['user_id'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_remarks'])."'
						
						)";
		
		
		
		
												
				$result=mysqli_query($connection,$sql) or die("Error in sql ".mysqli_error());
					if($result)
						{
							
							 echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
			echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$viewpage.'?pg=diagnosis.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
						}
						else
						{
							echo mysqli_error();
						}
	
	}

	
	if(isset($_POST['savechanges']))
	{
		
		$aid=$_POST['txt_admission'];     
		$did=$_POST['txt_date'];
		$aid=$_POST['txt_admission'];     
		$did=$_POST['txt_date'];
		$uid=$_POST['txt_userid'];
									$sql5="SELECT *  FROM staff WHERE name='$uid' ";
				                     $result5=mysqli_query($connection,$sql5) or die ("mysql.error:".mysqli_error());
          		                         $row5=mysqli_fetch_assoc($result5);
										 
										 $sql6="SELECT *  FROM elders WHERE name='$aid' ";
				                          $result6=mysqli_query($connection,$sql6) or die ("mysql.error:".mysqli_error());
          		                         $row6=mysqli_fetch_assoc($result6);
		
		
		$sql="UPDATE diagnosis SET 
		                    date='".mysqli_real_escape_string($connection,$_POST['txt_date'])."',
							admission_no='".mysqli_real_escape_string($connection,$row6['admission_no'])."',
							user_id='".mysqli_real_escape_string($connection,$row5['user_id'])."',
						    remarks='".mysqli_real_escape_string($connection,$_POST['txt_remarks'])."'
							
							
													
						WHERE admission_no='$row6[admission_no]' AND date='$did'";
			$result=mysqli_query($connection,$sql);
		
			
										
	}
	?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Elders home</title>
<script type="text/javascript">
function deleteconfirm() // make alert for delete branch details 
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
      <h2><i class="icon-list"></i>patient Details </h2>
      
    </div>
    
    
    
	<?php
	if(isset($_GET['status']))
	{
		
		$aid=$_GET['aid'];     
		$did=$_GET['did'];
	
		 
		 
		//diagnosis view start
		if($_GET['status']=="diagnosisview")
		{
			$sql1 ="SELECT * FROM diagnosis WHERE admission_no='$aid' AND date='$did'";
			$result=mysqli_query($connection,$sql1) or die ("mysql.error:".mysqli_error());
			$row=mysqli_fetch_assoc($result);
			
									$sql5="SELECT *  FROM staff WHERE user_id='$row[user_id]' ";
				                     $result5=mysqli_query($connection,$sql5) or die ("mysqli.error:".mysqli_error());
          		                         $row5=mysqli_fetch_assoc($result5);
										 
										 $sql6="SELECT *  FROM elders WHERE admission_no='$aid' ";
				                          $result6=mysqli_query($connection,$sql6) or die ("mysql.error:".mysqli_error());
          		                         $row6=mysqli_fetch_assoc($result6);
			?>
			<div class="row-fluid sortable">		
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i>patient Details</h2>
                        
					</div>
                 
                    
                    
                    
                    
				  <div class="box-content">
						<table class="table">
						<tr><td>Patient Name</td><td><?php echo $row6['name']; ?></td>
                        <tr><td>Date</td><td><?php echo $row['date']; ?></td>
                        <tr><td>Remarks</td><td><?php echo $row['remarks']; ?></td>
                        <tr><td>Staff Name</td><td><?php echo $row5['name']; ?></td>
                       
                                               
                        
                               
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
		//diagnosis view end
		
		//diagnosis edit start
		elseif($_GET['status']=="diagnosisedit")
		{
			$sql1 ="SELECT * FROM diagnosis WHERE admission_no='$aid' AND date='$did'";
			$result=mysqli_query($connection,$sql1) or die ("mysqli.error:".mysqli_error());
			$row=mysqli_fetch_assoc($result);
									$sql5="SELECT *  FROM staff WHERE user_id='$row[user_id]' ";
				                     $result5=mysqli_query($connection,$sql5) or die ("mysqli.error:".mysqli_error());
          		                         $row5=mysqli_fetch_assoc($result5);
										 
										 $sql6="SELECT *  FROM elders WHERE admission_no='$aid' ";
				                          $result6=mysqli_query($connection,$sql6) or die ("mysqli.error:".mysqli_error());
          		                         $row6=mysqli_fetch_assoc($result6);
			
			
			?>

<div class="box-content">
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=diagnosisview&aid=<?php echo $aid; ?>&did=<?php echo $did; ?>" method="post">
        <fieldset>
        
        <table width="100%">
          <tr><td>
  <div class="control-group">
            <label class="control-label" for="typeahead">Patient name </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" readonly name="txt_admission" id="txt_admission"   value="<?php echo $row6['name']; ?>" >
              
              
            </div>
          </div>  
          
           <div class="control-group">
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
              <input type="date" required class="input-xlarge focused" id="txt_date" value="<?php echo $row['date']; ?>" name="txt_date">
            </div>
          </div>
         
                              
             
          
          
          
          
            <div class="control-group">
            <label class="control-label" for="typeahead">Remarks</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_remarks" name="txt_remarks" value="<?php echo $row['remarks']; ?>"  />
              
            </div>
          </div>
        
      		  
              				          <div class="control-group">
            <label class="control-label" for="typeahead">Staff Name</label>
            <div class="controls">
           <input type="text" required class="input-xlarge focused" id="txt_userid" readonly name="txt_userid" value="<?php echo $row5['name']; ?>" >
            
              
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
			//diagnosis edit end
		
		//diagnosis delete start
		elseif($_GET['status']=="diagnosisdelete")
		{
			$sql2="DELETE FROM diagnosis  WHERE admission_no='$aid' AND date='$did'";
			$result=mysqli_query($connection,$sql2) or die("Error in mysqli :".mysqli_error());
			
		}
		//diagnosis delete end
	}
	
	?>
     <?php
	if(isset($_GET['option']))
	{ 
	  
		//diagnosis  entry begin
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
      <h2><i class="icon-edit"></i>patient Details Form</h2>
      
    </div>
<div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
        
        <table width="100%">
        <tr><td>
  
    <div class="control-group">
            <label class="control-label" for="typeahead">Patient name </label>
            <div class="controls">
               <?php
								
								$branch_id=$_SESSION['branch_id'];
								$name=$_SESSION['username'];
								 echo "<select required name='txt_admission'  id='txt_admission' data-rel='chosen'>";
										 echo "<option></option>";
								
										$sql5="SELECT *  FROM elders WHERE branch_id='$branch_id' AND status='Live'";
				                          $result5=mysqli_query($connection,$sql5) or die ("mysqli.error:".mysqli_error());
          		                         $row5=mysqli_fetch_assoc($result5);
										 do
										 {
										 	
												echo "<option value=".$row5['admission_no'].">".$row5['name']."</option>";
											}
											while($row5=mysqli_fetch_assoc($result5));
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
            <label class="control-label" for="typeahead">Remarks</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_remarks" name="txt_remarks" value=""  />
              
            </div>
          </div>
        
      		  
              				          <div class="control-group">
            <label class="control-label" for="typeahead">Staff Name</label>
            <div class="controls">
            <?php
			$name=$_SESSION['username'];
			 $sql2 ="SELECT *FROM staff WHERE user_id='$name'";
				$result2=mysqli_query($connection,$sql2) or die ("mysqli.error:".mysqli_error());
				$row2=mysqli_fetch_assoc($result2);
			?>
              <input type="text" required class="input-xlarge focused" id="txt_userid" readonly name="txt_userid" value="<?php echo $row2['name']; ?>" >
            
              
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
//new diagnosis entry end
//view diagnosis or search diagnosis begin
elseif(($_GET['option']=="view"))
        {
	global $aid;
	global $did;
	
	
?>
<div class="row-fluid sortable">		
		<div class="box span12">
		<div class="box-header well" data-original-title>
        <?php
			if($_SESSION['usertype']=="doctor")
			{
				?>
				<a class="btn btn-primary " href="<?php echo $newpage; ?>"><i class="icon icon-add icon-orange"></i> Add patient</a>
                <?php
			}

			else
			{
				?>
				<h4><i class="icon-user"></i>patient Information</h4>
                <?php
			}
			?>
            </div>
            <div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Patient name</th>
								   <th>Staff Name</th>
                                   <th>Date</th>
								 <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                          	<?php
								$branch_id=$_SESSION['branch_id'];
								$name=$_SESSION['username'];
								if($_SESSION['usertype']=="ward-incharge")
								{
									$branch_id=$_SESSION['branch_id'];
								$name=$_SESSION['username'];
								$sql6="SELECT  home_no  FROM ward WHERE incharge='$name' ";
				                          $result6=mysqli_query($connection,$sql6) or die ("mysqli.error:".mysqli_error());
          		                         $row6=mysqli_fetch_assoc($result6);
								do
								{
										$sql7="SELECT  ward_no  FROM ward WHERE incharge='$name' AND home_no='$row6[home_no]' ";
				                          $result7=mysqli_query($connection,$sql7) or die ("mysqli.error:".mysqli_error());
          		                         $row7=mysqli_fetch_assoc($result7);
										 
										
									do
									{
										$sql5="SELECT *  FROM elders WHERE branch_id='$branch_id' AND home_no='$row6[home_no]' AND ward_no='$row7[ward_no]' AND status='Live'";
										$result5=mysqli_query($connection,$sql5) or die ("mysqli.error:".mysqli_error());
										$row5=mysqli_fetch_assoc($result5);
										 do
										 {
										 	$sql2="SELECT * FROM diagnosis WHERE admission_no='$row5[admission_no]'";
													$result=mysqli_query($connection,$sql2);
													$row=mysqli_fetch_assoc($result);
											do
											{
											$sql9="SELECT *  FROM staff WHERE user_id='$row[user_id]' ";
											$result9=mysqli_query($sql9) or die ("mysqli.error:".mysqli_error());
											$row9=mysqli_fetch_assoc($result9);
										 
												$sql66="SELECT *  FROM elders WHERE admission_no='$row[admission_no]' ";
												$result66=mysqli_query($connection,$sql66) or die ("mysqli.error:".mysqli_error());
												$row66=mysqli_fetch_assoc($result66);
												do
												{
												if(mysqli_num_rows($result)==0)
												{
											 
												}
												else
												{
			              
		                         
												?>
												<tr><td class="center"><?php echo $row66['name']; ?></td><td class="center"><?php echo $row9['name']; ?></td><td class="center"><?php echo $row['date']; ?></td><td class="center"><a class="btn btn-success"   href="<?php echo $viewpage; ?>&status=diagnosisview&aid=<?php echo $row['admission_no']; ?>&did=<?php echo $row['date']; ?>">
												<i class="icon-zoom-in icon-white"></i>  
												View                                            
												</a>
												</td></tr>
												<?php
												}
												}
												while($row66=mysqli_fetch_assoc($result66));
											}
											while($row=mysqli_fetch_assoc($result));
								
										}
										while($row5=mysqli_fetch_assoc($result5));
										
									}
									while($row7=mysqli_fetch_assoc($result7));
								}
								while($row6=mysqli_fetch_assoc($result6));
										
									
								}
								else
								
								{
									$sql2="SELECT * FROM diagnosis WHERE user_id='$name'";
								
						
								$result=mysqli_query($connection,$sql2);
								while($row=mysqli_fetch_assoc($result))
								{
									$sql5="SELECT *  FROM staff WHERE user_id='$name' ";
				                     $result5=mysqli_query($connection,$sql5) or die ("mysqli.error:".mysqli_error());
          		                         $row5=mysqli_fetch_assoc($result5);
										 
										 $sql6="SELECT *  FROM elders WHERE admission_no='$row[admission_no]' ";
				                          $result6=mysqli_query($connection,$sql6) or die ("mysqli.error:".mysqli_error());
          		                         $row6=mysqli_fetch_assoc($result6);
			              
								
							?>
							<tr><td class="center"><?php echo $row6['name']; ?></td><td class="center"><?php echo $row5['name']; ?></td><td class="center"><?php echo $row['date']; ?></td><td class="center"><a class="btn btn-success"   href="<?php echo $viewpage; ?>&status=diagnosisview&aid=<?php echo $row['admission_no']; ?>&did=<?php echo $row['date']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <?php
								
                                    if($_SESSION['usertype']=="doctor")
									{ 
										?>
                          <a class="btn btn-info" href="<?php echo $viewpage; ?>&status=diagnosisedit&aid=<?php echo $row['admission_no']; ?>&did=<?php echo $row['date']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
						<a class="btn btn-danger" href="<?php echo $viewpage; ?>&status=diagnosisdelete&aid=<?php echo $row['admission_no']; ?>&did=<?php echo $row['date']; ?>" onclick="return deleteconfirm()">
										<i class="icon-trash icon-white"></i> 
										Delete
									</a>
                                    <?php
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
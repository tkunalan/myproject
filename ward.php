<?php
	include ("config.php");
	if(isset($_SESSION['username']) && ($_SESSION['usertype']=='admin' ||$_SESSION['usertype']=='manager' ||$_SESSION['usertype']=='ward-incharge' || $_SESSION['usertype']=='clerk'))
{

	if($_SESSION['usertype']=="admin")
	{
		
		$viewpage="adminhome.php?pg=ward.php&option=view";
	}
	if($_SESSION['usertype']=="manager")
	{
		$newpage="managerhome.php?pg=ward.php&option=new";
		$viewpage="managerhome.php?pg=ward.php&option=view";
	}
	if($_SESSION['usertype']=="clerk")
	{
		$viewpage="clerkhome.php?pg=ward.php&option=view";
	}
	if($_SESSION['usertype']=="ward-incharge")
	{
		$viewpage="wardincharhome.php?pg=ward.php&option=view";
	}
	
	
	if(isset($_POST['save']))
	{
		$sql8 ="SELECT *  FROM branch WHERE branch_name='$_POST[txt_branchid]'";
				$result8=mysqli_query($connection,$sql8) or die ("mysqli.error:".mysqli_error());
				$row8=mysqli_fetch_assoc($result8);
				$barnchid=$row8['branch_id'];
		$sql2 = "INSERT INTO ward(home_no,ward_no,no_of_beds,incharge,remarks,ward_type,branch_id) 
						VALUES(
						'".mysqli_real_escape_string($connection,$_POST['txt_homeno'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_wardno'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_noofbeds'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_staffid'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_remarks'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_wardtype'])."',
						'".mysqli_real_escape_string($connection,$barnchid)."'
						)";
		$result2=mysqli_query($connection,$sql2) or die("Error in sql2 ".mysqli_error());
						
						
						if($result2)
						{
							echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
				echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$viewpage.'?pg=ward.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
						}
						else
						{
							echo mysqli_error();
						}
	}
	
	if(isset($_POST['savechanges']))
	{
		
		$hid=$_POST['txt_homeno'];
		$wid=$_POST['txt_wardno'];
		$bid=$_POST['txt_branchid'];
		$sql="UPDATE ward SET 
							home_no='".mysqli_real_escape_string($connection,$_POST['txt_homeno'])."',
							ward_no='".mysqli_real_escape_string($connection,$_POST['txt_wardno'])."',
							no_of_beds=	'".mysqli_real_escape_string($connection,$_POST['txt_noofbeds'])."',
							incharge='".mysqli_real_escape_string($connection,$_POST['txt_staffid'])."',
							remarks='".mysqli_real_escape_string($connection,$_POST['txt_remarks'])."',
							ward_type='".mysqli_real_escape_string($connection,$_POST['txt_wardtype'])."',
							branch_id='".mysqli_real_escape_string($connection,$_POST['txt_branchid'])."'
							 
						
						WHERE home_no='$hid' AND ward_no='$wid' AND branch_id='$bid' ";
			$result=mysqli_query($connection,$sql);
			
										
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

   
    
	<?php
	if(isset($_GET['status']))
	{
		
		 $hid=$_GET['hid'];
		 $wid=$_GET['wid'];
		 $branch_id=$_SESSION['branch_id'];
		// $wid=$row['ward_no'];
		 //global $wid ;
		//Staff view start
		if($_GET['status']=="wardview")
		{
			if($_SESSION['usertype']=="admin")
			{
				$sql1 ="SELECT * FROM ward  WHERE home_no='$hid' AND ward_no='$wid'";
				$result=mysqli_query($connection,$sql1) or die ("mysql.error:".mysqli_error());
				$row=mysqli_fetch_assoc($result);
				 $sql6="SELECT name  FROM staff WHERE user_id='$row[incharge]'";
				                          $result6=mysqli_query($connection,$sql6) or die ("mysql.error:".mysqli_error());
          		                         $row6=mysqli_fetch_assoc($result6);
				
			}
			else
			{
			$sql1 ="SELECT * FROM ward  WHERE home_no='$hid' AND ward_no='$wid' AND branch_id='$branch_id' ";
			$result=mysqli_query($connection,$sql1) or die ("mysql.error:".mysqli_error());
			$row=mysqli_fetch_assoc($result);
													 $sql6="SELECT name  FROM staff WHERE user_id='$row[incharge]'";
				                          $result6=mysqli_query($connection,$sql6) or die ("mysql.error:".mysqli_error());
          		                         $row6=mysqli_fetch_assoc($result6);

			}
			$sql10 ="SELECT * FROM branch WHERE branch_id='$row[branch_id]'";
			$result10=mysqli_query($connection,$sql10) or die ("mysql.error:".mysqli_error());
			$row10=mysqli_fetch_assoc($result10);
			//$wid=$row['ward_no']
			?>
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Ward Details</h2>
                        
					</div>
                    
                    
                    
                    
                   
				  <div class="box-content">
						<table class="table">
						<tr><td>Home No</td><td><?php echo $row['home_no']; ?></td></tr>
                        <tr><td>Ward No</td><td><?php echo $row['ward_no']; ?></td></tr>
                        <tr><td>No of Beds</td><td><?php echo $row['no_of_beds']; ?></td></tr>
                        <tr><td>Staff Name</td><td><?php echo $row6['name']; ?></td></tr>
                        <tr><td>Remarks</td><td><?php echo $row['remarks']; ?></td></tr>
                        <tr><td>Ward Type</td><td><?php echo $row['ward_type']; ?></td></tr>
                        <tr><td>Branch Name</td><td><?php echo $row10['branch_name']; ?></td></tr>                                         
                                                                   
                               
                <tr><td><a class="btn btn-success" href="<?php echo $viewpage; ?>">
										<i class="icon-arrow-left icon-white"></i>  
										Go back                                            
									</a>
                              </td><td></td></tr>      
          						</table>
                     </div>
                 </div>
			</div>
            
            <?php
			exit;
		}
		//ward view end
		
		//ward edit start
		elseif($_GET['status']=="wardedit")
		{
			$sql1 ="SELECT * FROM ward WHERE home_no='$hid' AND ward_no='$wid'AND branch_id='$branch_id'";
			$result=mysqli_query($connection,$sql1) or die ("mysqli.error:".mysqli_error());
			$row=mysqli_fetch_assoc($result);
			
			?>

<div class="box-content">
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=wardview&hid=<?php echo $hid; ?>&wid=<?php echo $wid; ?>&bid=<?php echo $branch_id ?>" method="post">
        <fieldset>
        
        <table width="100%">
          <tr><td>

  <div class="control-group">
          
            <label class="control-label" for="typeahead">Home No</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" readonly name="txt_homeno" id="txt_homeno" value="<?php echo $hid; ?>" > 
           </div>
          </div>
          
        
                
        
        
 <div class="control-group">
          
            <label class="control-label" for="typeahead">Ward No </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused"  readonly name="txt_wardno" id="txt_wardno" value="<?php echo $wid; ?>" > 
           </div>
          </div>
          
  <div class="control-group">
            <label class="control-label" for="typeahead">No Of Beds</label>
            <div class="controls">
              <input type="text" rows="5" required class="input-xlarge focused" id="txt_noofbeds" name="txt_noofbeds" 
              value="<?php echo $row['no_of_beds']; ?>" >
              
            </div>
          </div>        

                 <?php 
				 $branch_id=$_SESSION['branch_id'];
		  		$sql3 ="SELECT *  FROM staff WHERE branch_id='$branch_id' ";
				$result3=mysqli_query($connection,$sql3) or die ("mysqli.error:".mysqli_error());
          		$row3=mysqli_fetch_assoc($result3);
          ?>
          <div class="control-group">
            <label class="control-label" for="typeahead">Staff Name</label>
            <div class="controls">
              
              					<select required name="txt_staffid" id="txt_staffid" data-rel="chosen">
                                
								<?php 
									do
									{
										$sql4="SELECT *  FROM user WHERE user_id='$row3[user_id]' AND usertype='ward-incharge' ";
				                          $result4=mysqli_query($connection,$sql4) or die ("mysqli.error:".mysqli_error());
          		                         $row4=mysqli_fetch_assoc($result4);
										 $sql5="SELECT *  FROM staff WHERE user_id='$row4[user_id]' ";
				                          $result5=mysqli_query($connection,$sql5) or die ("mysqli.error:".mysqli_error());
          		                         $row5=mysqli_fetch_assoc($result5);
										/* if($row['incharge']=='0')
										 {
											echo "<option value=".$row4['user_id'].">".$row5['name']."</option>";
										 }
										 else
										 {*/
										 	if($row4['user_id']==$row['incharge'])
										 	{
												echo "<option selected value=".$row4['user_id'].">".$row5['name']."</option>"; 
											 }
											 else
											 {
												echo "<option value=".$row4['user_id'].">".$row5['name']."</option>";
											 }
										// }
									}
									while($row3=mysql_fetch_assoc($result3));
									?>										
								 </select>
            </div>
          </div>
<div class="control-group">
            <label class="control-label" for="typeahead">Remarks</label>
            <div class="controls">
              <input type="text" rows="5" required class="input-xlarge focused" id="txt_remarks" name="txt_remarks" 
              value="<?php echo $row['remarks']; ?>">
              
            </div>
          </div>
          
            <div class="control-group">
								<label class="control-label" for="selectError">Ward Type</label>
								<div class="controls">
								  <select id="selectError" name="txt_wardtype" data-rel="chosen">
                                 <?Php
								  if($row['ward_type']=="normal")
                                  {
                                  		echo "<option value='$row[ward_type]' selected >$row[ward_type]</option>";
										echo "<option>mental</option>";
                                  }
								  else if($row['ward_type']=="upnormal")
								  {
										echo "<option value='$row[ward_type]' selected >$row[ward_type]</option>";
										echo "<option>normal</option>"; 
								  }
								  else
								  {
									  echo "<option>normal</option>";
									  echo "<option>upnormal</option>";
								  }
								  ?>
								  </select>
								</div>
							  </div>
          
          <label class="control-label" for="typeahead">Branch ID </label>
            <div class="controls">
   <input type="text" required class="input-xlarge focused" name="txt_branchid" id="txt_branchid" value="<?php echo $branch_id; ?>" > 
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
			//ward edit end
		
		//ward delete start
		elseif($_GET['status']=="warddelete")
		{
			/*$sql2="DELETE FROM ward  WHERE home_no='$hid' AND ward_no='$Wid' AND branch_id='$branch_id'";
			$result2=mysql_query($sql2) or die("Error in mysql :".mysql_error());*/
		 $branch_id=$_SESSION['branch_id'];	
		$sql2="UPDATE ward SET 
							no_of_beds=	'".mysqli_real_escape_string('0')."',
							incharge='".mysqli_real_escape_string('0')."',
							remarks='".mysqli_real_escape_string('0')."',
							ward_type='".mysqli_real_escape_string('0')."'							 
						
						WHERE home_no='$hid' AND ward_no='$wid' AND branch_id='$branch_id' ";
			$result2=mysqli_query($connection,$sql2) or die("Error in mysqli :".mysqli_error());
			
		}
		//ward delete end
	}
	
	?>
     <?php
	if(isset($_GET['option']))
	{ 
	  global $bid;
		//new branch entry begin
		if($_GET['option']=="new")
		{
			include ("config.php");
			$branch_id=$_SESSION['branch_id'];
			$sql1 ="SELECT * FROM ward WHERE branch_id='$branch_id' ORDER BY home_no ASC";
			$result=mysqli_query($connection,$sql1) or die ("mysqli.error:".mysqli_error());
			$row=mysqli_fetch_assoc($result);
			//echo $row['home_no'];
			if(mysqli_num_rows($result)>0)
			{
							do
							{
								$homeno=$row['home_no'];
							}
							while($row=mysqli_fetch_assoc($result));
					$sql2 ="SELECT * FROM ward WHERE branch_id='$branch_id' AND home_no='$homeno' ORDER BY ward_no ASC";
			        $result2=mysqli_query($connection,$sql2) or die ("mysqli.error:".mysqli_error());
			        $row2=mysqli_fetch_assoc($result2);
					//echo $row2['ward_no'];
					if(mysqli_num_rows($result2)>0)
			   			{
							global $wid;
							
							
							if(mysqli_num_rows($result2)<5)
			   				{
								do
								{
									$wid=$row2['ward_no'];
								}
								while($row2=mysqli_fetch_assoc($result2));
								$k=(string)$wid;
								$wid=++$k;
								$hid=$homeno;
							}
							else
							{
								$hid=$homeno;
								$m=(string)$hid;
								$hid=++$m;
								$wid="W001";
								//echo "dai lol";
							}
								
				
						}
					else
						{
							$hid=$homeno;
							$wid="W001";
	    				}
	    
				
				
			}
			else
			{
				$hid="H001";
				$wid="W001";
	        }
	    
	
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
      <h2><i class="icon-edit"></i>Ward Details Form</h2>
      
    </div>
<div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
        
        <table width="100%">
        <tr><td>
  <div class="control-group">
          
            <label class="control-label" for="typeahead">Home No</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_homeno" id="txt_homeno" readonly value="<?php echo $hid; ?>" > 
           </div>
          </div>
          
        
                
        
        
 <div class="control-group">
          
            <label class="control-label" for="typeahead">Ward No </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_wardno" id="txt_wardno" readonly value="<?php echo $wid; ?>" > 
           </div>
          </div>
          
  <div class="control-group">
            <label class="control-label" for="typeahead">No Of Beds</label>
            <div class="controls">
              <input type="text" rows="5" required class="input-xlarge focused" id="txt_noofbeds" name="txt_noofbeds" >
              
            </div>
          </div>        

                 <?php 
				 $branch_id=$_SESSION['branch_id'];
		  		$sql3 ="SELECT *  FROM staff WHERE branch_id='$branch_id' ";
				$result3=mysqli_query($connection,$sql3) or die ("mysqli.error:".mysqli_error());
          		$row3=mysqli_fetch_assoc($result3);
          ?>
          <div class="control-group">
            <label class="control-label" for="typeahead">Staff Name</label>
            <div class="controls">
              
              					<select required name="txt_staffid" id="txt_staffid" data-rel="chosen">
								<?php 
									do
									{
										$sql4="SELECT *  FROM user WHERE user_id='$row3[user_id]' AND usertype='ward-incharge' ";
				                          $result4=mysqli_query($connection,$sql4) or die ("mysqli.error:".mysqli_error());
          		                         $row4=mysqli_fetch_assoc($result4);
										  $sql6="SELECT *  FROM ward WHERE incharge='$row4[user_id]' ";
				                          $result6=mysqli_query($connection,$sql6) or die ("mysqli.error:".mysqli_error());
          		                         $row6=mysqli_fetch_assoc($result6);
										 $sql5="SELECT *  FROM staff WHERE user_id='$row4[user_id]' ";
				                          $result5=mysqli_query($connection,$sql5) or die ("mysqli.error:".mysqli_error());
          		                         $row5=mysqli_fetch_assoc($result5);
										if($row6['incharge']==$row4['user_id'])
										 {
										 }
										 else
										 {
										echo "<option value=".$row4['user_id'].">".$row5['name']."</option>";
										 }
									}
									while($row3=mysqli_fetch_assoc($result3));
									?>										
								 </select>
            </div>
          </div>
<div class="control-group">
            <label class="control-label" for="typeahead">Remarks</label>
            <div class="controls">
              <input type="text" rows="5" required class="input-xlarge focused" id="txt_remarks" name="txt_remarks" >
              
            </div>
          </div>
          
            <div class="control-group">
								<label class="control-label" for="selectError">Ward Type</label>
								<div class="controls">
								  <select id="selectError" name="txt_wardtype" data-rel="chosen">
                                  <option></option>
									<option>normal</option>
									<option>upnormal</option> 								                                  </select>
								</div>
							  </div>
                              <?php
                              $branch_id=$_SESSION['branch_id'];
					$sql4 ="SELECT *  FROM branch WHERE branch_id='$branch_id'";
				$result4=mysqli_query($connection,$sql4) or die ("mysqli.error:".mysqli_error());
				$row4=mysqli_fetch_assoc($result4);
				?>
          
          <label class="control-label" for="typeahead">Branch Name </label>
            <div class="controls">
   <input type="text" required class="input-xlarge focused" name="txt_branchid" id="txt_branchid" readonly value="<?php echo $row4['branch_name']; ?>" > 
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
//new ward entry end
//view ward or search ward begin
elseif(($_GET['option']=="view"))
        {
	global $bid;
	
?>
<div class="row-fluid sortable">		
		<div class="box span12">
		<div class="box-header well" data-original-title>
        <?php
			if($_SESSION['usertype']=="manager")
			{
				?>
				<a class="btn btn-primary " href="<?php echo $newpage; ?>"><i class="icon icon-add icon-orange"></i> Add New Home/Ward </a>
                <?php
			}
			else
			{
				?>
				<h4><i class="icon-list"></i> Home/Ward Information</h4>
                <?php
			}
			?>
            </div>
            <div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Home No</th>
								  <th>Ward No</th>
								  <th>Ward type</th>
                                  <th>Staff Name </th>
                                  <th>Branch Name </th>
								 <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                          	<?php
								$branch_id=$_SESSION['branch_id'];
								$userId=$_SESSION['username'];
								if($_SESSION['usertype']=="admin")
								{
									$sql2="SELECT * FROM ward";
								}
								else if(($_SESSION['usertype']=="manager") || ($_SESSION['usertype']=="clerk"))
								{
									$sql2="SELECT * FROM ward WHERE branch_id='$branch_id'";
								}
								else if($_SESSION['usertype']=="ward-incharge" )
								{
									$sql2="SELECT * FROM ward WHERE incharge='$userId'";
								}
								$result=mysqli_query($connection,$sql2);
								while($row=mysqli_fetch_assoc($result))
								{
									$bid=$row['branch_id'];
							?>
							<tr><td class="center"><?php echo $row['home_no']; ?></td><td class="center"><?php echo $row['ward_no']; ?></td><td class="center"><?php echo $row['ward_type']; ?></td> <td class="center"><?php $sql6="SELECT name  FROM staff WHERE user_id='$row[incharge]'";
				                          $result6=mysqli_query($connection,$sql6) or die ("mysql.error:".mysqli_error());
          		                         $row6=mysqli_fetch_assoc($result6);
 echo $row6['name']; ?></td><td><?php 
								$sql3="SELECT * FROM branch WHERE branch_id='$bid'";
								$result3=mysqli_query($connection,$sql3);
								$row3=mysqli_fetch_assoc($result3);
								$bname=$row3['branch_name'];
							echo $bname; ?></td><td class="center"><a class="btn btn-success" href="<?php echo $viewpage; ?>&status=wardview&hid=<?php echo $row['home_no']; ?>&wid=<?php echo $row['ward_no']; ?>&bid=<?php echo $row['branch_id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <?php
                                    if($_SESSION['usertype']=="manager")
									{ 
										?>
                          <a class="btn btn-info" href="<?php echo $viewpage; ?>&status=wardedit&hid=<?php echo $row['home_no']; ?>&wid=<?php echo $row['ward_no']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
						<a class="btn btn-danger" href="<?php echo $viewpage; ?>&status=warddelete&hid=<?php echo $row['home_no']; ?>&wid=<?php echo $row['ward_no']; ?>" onclick="return deleteconfirm()">
										<i class="icon-trash icon-white"></i> 
										Delete
									</a>
                                    <?php
                                    }
									?>
                                    </td></tr>
                                    <?php
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
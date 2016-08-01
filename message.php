<?php
	include ("config.php");

	if($_SESSION['usertype']=="admin")
	{
		//$newpage="adminhome.php?pg=message.php.php&option=new";
		$viewpage="adminhome.php?pg=message.php&option=sent";
	}
	elseif($_SESSION['usertype']=="manager")
	{
		//$newpage="managerhome.php?pg=message.php&option=new";
		$viewpage="managerhome.php?pg=message.php&option=sent";
	}
	elseif($_SESSION['usertype']=="clerk")
	{
		//$newpage="clerkhome.php?pg=message.php.php&option=new";
		$viewpage="clerkhome.php?pg=message.php&option=sent";
	}
	elseif($_SESSION['usertype']=="ward-incharge")
	{
		//$newpage="wardincharhome.php?pg=message.php.php&option=new";
		$viewpage="wardincharhome.php?pg=message.php&option=sent";
	}
	elseif($_SESSION['usertype']=="doctor")
	{
		//$newpage="doctorhome.php?pg=message.php.php&option=new";
		$viewpage="doctorhome.php?pg=message.php&option=sent";
	}
	elseif($_SESSION['usertype']=="sponsor")
	{
		//$newpage="sponsorhome.php?pg=message.php.php&option=new";
		$viewpage="sponsorhome.php?pg=message.php&option=sent";
	}
	?>
	
	<?php
	
	if(isset($_POST['save']))
	{
		$sql2 = "INSERT INTO message(mess_id,user_id,to_id,message,status,inboxstatus,sentstatus) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_messid'])."',
						'".mysql_real_escape_string($_POST['txt_userid'])."',
						'".mysql_real_escape_string($_POST['txt_toid'])."',
						'".mysql_real_escape_string($_POST['txt_mess'])."',
						'".mysql_real_escape_string('1')."',
						'".mysql_real_escape_string('1')."',
						'".mysql_real_escape_string('1')."'
						)";
		$result2=mysql_query($sql2) or die("Error in sql2 ".mysql_error());
						
						
						if($result2)
						{
							header("location:".$viewpage);
						}
						else
						{
							echo mysql_error();
						}
	}
	
	
	?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Elders home</title>
</head>

<body>

    
    
    
    
	<?php
	if(isset($_GET['status']))
	{
		
		 $mid=$_GET['mid'];
		 
		//item view start
		if($_GET['status']=="messageview")
		{
			$sql2="UPDATE message SET status='0' WHERE to_id='$username' AND mess_id='$mid'";
			$result=mysql_query($sql2) or die ("mysql.error:".mysql_error());
			
			$sql1 ="SELECT * FROM message WHERE mess_id='$mid'";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
									$sql4 ="SELECT *  FROM user WHERE user_id='$row[user_id]' ";
									$result4=mysql_query($sql4) or die ("mysql.error:".mysql_error());
          							$row4=mysql_fetch_assoc($result4);
									if($row4['usertype']=="sponsor")
									{
									$sql3 ="SELECT *  FROM sponsor WHERE user_id='$row[user_id]' ";
									$result3=mysql_query($sql3) or die ("mysql.error:".mysql_error());
          							$row3=mysql_fetch_assoc($result3);
									}
									else 
									{
									$sql3 ="SELECT *  FROM staff WHERE user_id='$row[user_id]' ";
									$result3=mysql_query($sql3) or die ("mysql.error:".mysql_error());
          							$row3=mysql_fetch_assoc($result3);
									}
									
									$sql5 ="SELECT *  FROM user WHERE user_id='$row[to_id]' ";
									$result5=mysql_query($sql5) or die ("mysql.error:".mysql_error());
          							$row5=mysql_fetch_assoc($result5);
									if($row5['usertype']=="sponsor")
									{
									$sql6 ="SELECT *  FROM sponsor WHERE user_id='$row[to_id]' ";
									$result6=mysql_query($sql6) or die ("mysql.error:".mysql_error());
          							$row6=mysql_fetch_assoc($result6);
									}
									else 
									{
									$sql6 ="SELECT *  FROM staff WHERE user_id='$row[to_id]' ";
									$result6=mysql_query($sql6) or die ("mysql.error:".mysql_error());
          							$row6=mysql_fetch_assoc($result6);
									}
			?>
			<div class="row-fluid sortable">		
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i>  Message Details</h2>
                        
					</div>
                    
                    
                    
                    
                    
				  <div class="box-content">
						<table class="table">
						<tr><td>From</td><td><?php echo $row3['name']; ?></td>
                        <tr><td>To</td><td><?php echo $row6['name']; ?></td>
                        <tr><td>Message</td><td><?php echo $row['message']; ?></td>
                        
                        
                        
                        
                       
           
                         
                        <tr><td><a class="btn btn-success" href="<?php echo $viewpage; ?>">
										<i class="icon-arrow-left icon-white"></i>  
										Go back                                            
									</a>
                                     
          						</table>
                     </div>
                 </div>
			</div>
            
            <?php
			exit;
		}
		//item view end
		//item delete start
		elseif($_GET['status']=="inboxdelete")
		{
			$mid=$_GET['mid'];
			$sql1="SELECT * FROM message WHERE mess_id='$mid'";
			$result=mysql_query($sql1) or die("Error in mysql :".mysql_error());
			$row=mysql_fetch_assoc($result);
			
			if($row['sentstatus']==1)
			{
				$sql2="UPDATE message SET inboxstatus='0' WHERE mess_id='$mid'";
				$result=mysql_query($sql2) or die("Error in mysql :".mysql_error());
			}
			else
			{
				$sql2="DELETE FROM message WHERE mess_id='$mid'";
				$result=mysql_query($sql2) or die("Error in mysql :".mysql_error());
			}
			
		}
		elseif($_GET['status']=="sentdelete")
		{
			$mid=$_GET['mid'];
			$sql1="SELECT * FROM message WHERE mess_id='$mid'";
			$result=mysql_query($sql1) or die("Error in mysql :".mysql_error());
			$row=mysql_fetch_assoc($result);
			
			if($row['inboxstatus']==1)
			{
				$sql2="UPDATE message SET sentstatus='0' WHERE mess_id='$mid'";
				$result=mysql_query($sql2) or die("Error in mysql :".mysql_error());
			}
			else
			{
				$sql2="DELETE FROM message WHERE mess_id='$mid'";
				$result=mysql_query($sql2) or die("Error in mysql :".mysql_error());
			}
		}
		//item delete end
	}
	
	?>
     <?php
	if(isset($_GET['option']))
	{ 
	  global $bid;
		//new item entry begin
		if($_GET['option']=="new")
		{
			include ("config.php");
			$sql1 ="SELECT mess_id FROM message ORDER BY mess_id  ASC";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			if(mysql_num_rows($result)>0)
			{
				while($row=mysql_fetch_assoc($result))
				{
					$tid=$row['mess_id'];
				}
				$n=(string)$tid;
				$tid=++$n;
				
			}
			else
			{
				$tid="M00001";
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
      <h2><i class="icon-edit"></i>message compose</h2>
      
    </div>
<div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
        
        <table width="100%">
        <tr><td>
  <div class="control-group">
          
           <!-- <label class="control-label" for="typeahead">Message No</label> -->
            <div class="controls">
              <input type="hidden" required class="input-xlarge focused" name="txt_messid" id="txt_messid" value="<?php echo $tid; ?>" > 
           </div>
          </div>
          
        <?php
                $userId=$_SESSION['username'];
        ?>
        
 <div class="control-group">
          
            <label class="control-label" for="typeahead">User ID </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_userid" id="txt_userid" readonly value="<?php echo $userId;?> " > 
           </div>
          </div>
         <?php 
          if($_SESSION['usertype']=='sponsor')
{
									$sql4 ="SELECT *  FROM user WHERE usertype='admin' ";
									$result4=mysql_query($sql4) or die ("mysql.error:".mysql_error());
          							$row4=mysql_fetch_assoc($result4);
									$sql3 ="SELECT *  FROM staff WHERE user_id='$row4[user_id]' ";
									$result3=mysql_query($sql3) or die ("mysql.error:".mysql_error());
          							$row3=mysql_fetch_assoc($result3);
									
	?>
    <div class="control-group">
    
          
            <label class="control-label" for="typeahead">To ID </label>
            <div class="controls">
            <input type="hidden" required class="input-xlarge focused" name="txt_toid" id="txt_toid" value="<?php echo $row4['user_id']; ?>" > 
              <input type="text"  class="input-xlarge focused" readonly value="admin(<?php echo $row3['name']; ?>)" > 
           </div>
          </div>
<?php
}
else if($_SESSION['usertype']=='admin')
{
	 $branch_id=$_SESSION['branch_id'];
	 $username=$_SESSION['username'];
		  		$sql3 ="SELECT *  FROM staff WHERE user_id!='$username' AND staff_designation!='Delete'";
				$result3=mysql_query($sql3) or die ("mysql.error:".mysql_error());
          		$row3=mysql_fetch_assoc($result3);
				
				$sql4 ="SELECT *  FROM sponsor ";
				$result4=mysql_query($sql4) or die ("mysql.error:".mysql_error());
          		$row4=mysql_fetch_assoc($result4);
	?>
    <div class="control-group">
								<label class="control-label" for="selectError">TO NAME</label>
								<div class="controls">
								  <select required name="txt_toid" id="txt_toid" data-rel="chosen">
                                  <option></option>
								<?php 
									do
									{
										if($row3['user_id']==$username)
										{
											
										}
										else
										{										
										echo "<option value=".$row3['user_id'].">".$row3['name']."</option>";
										}
										
									}
									while($row3=mysql_fetch_assoc($result3));
									
									do
									{
																				
										echo "<option value=".$row4['user_id'].">"."Sponsor(".$row4['name'].")</option>";
										
										
									}
									while($row4=mysql_fetch_assoc($result4));
									?>										
								 </select>
								</div>
							  </div>
                             

<?php
}
else 
{
	 $branch_id=$_SESSION['branch_id'];
	 $username=$_SESSION['username'];
		  		$sql3 ="SELECT *  FROM staff WHERE branch_id='$branch_id' AND user_id!='$username' AND staff_designation!='Delete'";
				$result3=mysql_query($sql3) or die ("mysql.error:".mysql_error());
          		$row3=mysql_fetch_assoc($result3);
	?>
    <div class="control-group">
								<label class="control-label" for="selectError">TO NAME</label>
								<div class="controls">
								  <select required name="txt_toid" id="txt_toid" data-rel="chosen">
                                  <option></option>
								<?php 
									do
									{										
										echo "<option value=".$row3['user_id'].">".$row3['name']."</option>";
										
										
									}
									while($row3=mysql_fetch_assoc($result3));
									?>										
								 </select>
								</div>
							  </div>
                             
               <?php
}
?>
<div class="control-group">
            <label class="control-label" for="typeahead">Message </label>
            <div class="controls">
             
               <textarea rows="3" cols="50" name="txt_mess" id="txt_mess" class="input-xlarge focused" ></textarea>
            </div>
          </div>





   <div class="form-actions">
            <button type="submit" class="btn btn-primary" name="save" id="save">Sent</button>
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
//new branch entry end
//view branch or search branch begin
else if(($_GET['option']=="sent"))
        {
	global $tid;
	
?>
<div class="row-fluid sortable">		
		<div class="box span12">
		<div class="box-header well" data-original-title>
       <h3><i class="icon-envelope"></i>Sent Message </h3>
            </div>
            <div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>From</th>
								  <th>To</th>
								 <th>Message</th>
                                 <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
                          	<?php
								$userId=$_SESSION['username'];
								
									$sql2="SELECT * FROM message WHERE user_id='$userId' and sentstatus=1";
								
								$result=mysql_query($sql2);
								while($row=mysql_fetch_assoc($result))
								{
									$sql4 ="SELECT *  FROM user WHERE user_id='$row[to_id]' ";
									$result4=mysql_query($sql4) or die ("mysql.error:".mysql_error());
          							$row4=mysql_fetch_assoc($result4);
									if($row4['usertype']=="sponsor")
									{
									$sql3 ="SELECT *  FROM sponsor WHERE user_id='$row[to_id]' ";
									$result3=mysql_query($sql3) or die ("mysql.error:".mysql_error());
          							$row3=mysql_fetch_assoc($result3);
									}
									else 
									{
									$sql3 ="SELECT *  FROM staff WHERE user_id='$row[to_id]' ";
									$result3=mysql_query($sql3) or die ("mysql.error:".mysql_error());
          							$row3=mysql_fetch_assoc($result3);
									}
							?>
							<tr><td class="center"><?php echo $row['user_id']; ?></td><td class="center"><?php echo $row3['name']; ?></td><td class="center"><?php echo $row['message']; ?></td><td class="center"><a class="btn btn-success" 
                            href="<?php echo $viewpage; ?>&status=messageview&mid=<?php echo $row['mess_id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <a class="btn btn-danger" 
                            href="<?php echo $viewpage; ?>&status=sentdelete&mid=<?php echo $row['mess_id']; ?>">
										<i class="icon-trash icon-white"></i>  
										Delete                                            
									</a>
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
//new branch entry end
//view branch or search branch begin
else if(($_GET['option']=="inbox"))
        {
	global $tid;
	
?>
<div class="row-fluid sortable">		
		<div class="box span12">
		<div class="box-header well" data-original-title>
      <h3> <i class="icon-envelope"></i> Inbox</h3>
            </div>
            <div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>From</th>
								  <th>To</th>
								 <th>Message</th>
                                 <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
                          	<?php
								$userId=$_SESSION['username'];
								
									$sql2="SELECT * FROM message WHERE to_id='$userId' and inboxstatus=1";
								
								$result=mysql_query($sql2);
								while($row=mysql_fetch_assoc($result))
								{
									$sql4 ="SELECT *  FROM user WHERE user_id='$row[user_id]' ";
									$result4=mysql_query($sql4) or die ("mysql.error:".mysql_error());
          							$row4=mysql_fetch_assoc($result4);
									if($row4['usertype']=="sponsor")
									{
									$sql3 ="SELECT *  FROM sponsor WHERE user_id='$row[user_id]' ";
									$result3=mysql_query($sql3) or die ("mysql.error:".mysql_error());
          							$row3=mysql_fetch_assoc($result3);
									}
									else 
									{
									$sql3 ="SELECT *  FROM staff WHERE user_id='$row[user_id]' ";
									$result3=mysql_query($sql3) or die ("mysql.error:".mysql_error());
          							$row3=mysql_fetch_assoc($result3);
									}
									?>
							<tr><td class="center"><?php echo $row3['name']; ?></td><td class="center"><?php echo $row['to_id']; ?></td><td class="center"><?php echo $row['message']; ?></td><td class="center"><a class="btn btn-success" 
                            href="<?php echo $viewpage; ?>&status=messageview&mid=<?php echo $row['mess_id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <a class="btn btn-danger" 
                            href="<?php echo $viewpage; ?>&status=inboxdelete&mid=<?php echo $row['mess_id']; ?>">
										<i class="icon-trash icon-white"></i>  
										Delete                                            
									</a>
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
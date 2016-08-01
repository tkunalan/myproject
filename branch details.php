<?php
	include ("config.php");
if(isset($_SESSION['username']) && ($_SESSION['usertype']=='admin' ))
{
	if($_SESSION['usertype']=="admin")
	{
		$newpage="adminhome.php?pg=branch details.php&option=new";
		$viewpage="adminhome.php?pg=branch details.php&option=view";
	}
	
	
	
	
	if(isset($_POST['save']))
	{
		$sql2 = "INSERT INTO branch(branch_id,branch_name,address,contact_no) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_branchid'])."',
						'".mysql_real_escape_string($_POST['txt_bname'])."',
						'".mysql_real_escape_string($_POST['txt_address'])."',
						'".mysql_real_escape_string($_POST['txt_contactno'])."'
						)";
		$result2=mysql_query($sql2) or die("Error in sql2 ".mysql_error());
						
						
						if($result2)
						{
							echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
			echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$viewpage.'?pg=branch details.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
						}
						else
						{
							echo mysql_error();
						}
	}
	
	if(isset($_POST['savechanges']))
	{
		
		$bid=$_POST['txt_branchid'];
		$sql="UPDATE branch SET 
							branch_name='".mysql_real_escape_string($_POST['txt_bname'])."',
							address=	'".mysql_real_escape_string($_POST['txt_address'])."',
							contact_no=	'".mysql_real_escape_string($_POST['txt_contactno'])."'
							 
						
						WHERE branch_id='$bid'";
			$result=mysql_query($sql);
			
										
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
      <h2><i class="icon-edit"></i>branch Details Form</h2>
      
    </div>
    
    
    
	<?php
	if(isset($_GET['status']))
	{
		
		 $bid=$_GET['bid'];
		 
		//branch view start
		if($_GET['status']=="branchview")
		{
			$sql2 ="SELECT * FROM branch WHERE branch_id='$bid'";
			$result2=mysql_query($sql2) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result2);
			?>
			<div class="row-fluid sortable">		
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> branch Details</h2>
                        
					</div>
                    
                  <div class="box-content">
						<table class="table">
						<tr><td>Branch Id</td><td><?php echo $row['branch_id']; ?></td></tr>
                        <tr><td>Branch Name</td><td><?php echo $row['branch_name']; ?></td></tr>
                        <tr><td>Address</td><td><?php echo $row['address']; ?></td></tr>
                        <tr><td>Contact No</td><td><?php echo $row['contact_no']; ?></td></tr>
                        
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
		//branch view end
		
		//branch edit start
		elseif($_GET['status']=="branchedit")
		{
			$sql1 ="SELECT * FROM branch WHERE branch_id='$bid'";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			
			?>

<div class="box-content">
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=branchview&bid=<?php echo $bid; ?>" method="post">
        <fieldset>
        
        <table width="100%">
          <tr><td>
  <div class="control-group">
          
            <label class="control-label" for="typeahead">Branch ID </label>
            <div class="controls">
   <input type="text" required class="input-xlarge focused"  readonly name="txt_branchid" id="txt_branchid" value="<?php echo $row['branch_id']; ?>" > 
           </div>
          </div>
          
        
                
        
        
 <div class="control-group">
          
            <label class="control-label" for="typeahead">Branch Name </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_bname" id="txt_bname" 
              value="<?php echo $row['branch_name']; ?>" > 
           </div>
          </div>
          
  <div class="control-group">
            <label class="control-label" for="typeahead">Address </label>
            <div class="controls">
             <input type="textarea" rows="5" required class="input-xlarge focused" id="txt_address" name="txt_address"  
             value="<?php echo $row['address'];?>">
              
            </div>
          </div>        


  <div class="control-group">
            <label class="control-label" for="typeahead">Contact No </label>
            <div class="controls">
              <input type="text" rows="5" required class="input-xlarge focused" id="txt_contactno" name="txt_contactno" 
              value="<?php echo $row['contact_no']; ?>">
              
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
			//branch edit end
		
		//branch delete start
		elseif($_GET['status']=="branchdelete")
		{
			$sql2="DELETE FROM branch  WHERE branch_id='$bid'";
			$result=mysql_query($sql2) or die("Error in mysql :".mysql_error());
			
		}
		//branch delete end
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
			$sql1 ="SELECT branch_id FROM branch ORDER BY branch_id ASC";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			if(mysql_num_rows($result)>0)
			{
				while($row=mysql_fetch_assoc($result))
				{
					$bid=$row['branch_id'];
				}
				$n=(string)$bid;
				$bid=++$n;
				
			}
			else
			{
				$bid="B001";
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
      <h2><i class="icon-edit"></i>Branch Details Form</h2>
      
    </div>
<div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
        
        <table width="100%">
        <tr><td>
  <div class="control-group">
          
            <label class="control-label" for="typeahead">Branch ID </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_branchid" id="txt_branchid" value="<?php echo $bid; ?>" > 
           </div>
          </div>
          
        
                
        
        
 <div class="control-group">
          
            <label class="control-label" for="typeahead">Branch Name </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_bname" id="txt_bname" value="" > 
           </div>
          </div>
          
  <div class="control-group">
            <label class="control-label" for="typeahead">Address </label>
            <div class="controls">
              <input type="textarea" rows="5" required class="input-xlarge focused" id="txt_address" name="txt_address" >
              
            </div>
          </div>        


  <div class="control-group">
            <label class="control-label" for="typeahead">Contact No </label>
            <div class="controls">
              <input type="text" rows="5" required class="input-xlarge focused" id="txt_contactno" name="txt_contactno" >
              
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
//new branch entry end
//view branch or search branch begin
elseif(($_GET['option']=="view"))
        {
	global $bid;
	
?>
<div class="row-fluid sortable">		
		<div class="box span12">
		<div class="box-header well" data-original-title>
        <?php
			if($_SESSION['usertype']=="admin")
			{
				?>
				<a class="btn btn-primary " href="<?php echo $newpage; ?>"><i class="icon icon-add icon-orange"></i> Add New branch </a>
                <?php
			}
			else
			{
				?>
				<h4><i class="icon-user"></i> branch Information</h4>
                <?php
			}
			?>
            </div>
            <div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Branch ID</th>
								  <th>Branch Name</th>
								  <th>Address</th>
								 <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                          	<?php
								$branch_id=$_SESSION['branch_id'];
								if($_SESSION['usertype']=="admin")
								{
									$sql2="SELECT * FROM branch";
								}
								else
								{
									$sql2="SELECT * FROM branch WHERE branch_id='$bid'";
								}
								$result=mysql_query($sql2);
								while($row=mysql_fetch_assoc($result))
								{
									$bid=$row['branch_id'];
							?>
							<tr><td class="center"><?php echo $row['branch_id']; ?></td><td class="center"><?php echo $row['branch_name']; ?></td><td class="center"><?php echo $row['address']; ?></td><?php 
								$sql3="SELECT * FROM branch WHERE branch_id='$bid'";
								$result3=mysql_query($sql3);
								$row3=mysql_fetch_assoc($result3);
								$bname=$row3['branch_name'];
							//echo $bname; ?></td><td class="center"><a class="btn btn-success" href="<?php echo $viewpage; ?>&status=branchview&bid=<?php echo $row['branch_id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <?php
                                    if($_SESSION['usertype']=="admin")
									{ 
										?>
                          <a class="btn btn-info" href="<?php echo $viewpage; ?>&status=branchedit&bid=<?php echo $row['branch_id']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
						<a class="btn btn-danger" href="<?php echo $viewpage; ?>&status=branchdelete&bid=<?php echo $row['branch_id']; ?>" onclick="return deleteconfirm()">
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
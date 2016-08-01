<?php
	include ("config.php");
if(isset($_SESSION['username']) && ($_SESSION['usertype']=='admin'))
{
	if($_SESSION['usertype']=="admin")
	{
		$newpage="adminhome.php?pg=item.php&option=new";
		$viewpage="adminhome.php?pg=item.php&option=view";
	}
	
	
	
	
	if(isset($_POST['save']))
	{
		$sql2 = "INSERT INTO item(item_no,item_name,item_type) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_itemno'])."',
						'".mysql_real_escape_string($_POST['txt_itemname'])."',
						'".mysql_real_escape_string($_POST['txt_itemtype'])."'
						)";
		$result2=mysql_query($sql2) or die("Error in sql2 ".mysql_error());
						
						
						if($result2)
						{
								echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
				echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$viewpage.'?pg=item.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
						}
						else
						{
							echo mysql_error();
						}
	}
	
	if(isset($_POST['savechanges']))
	{
		
		$tid=$_POST['txt_itemno'];
		$sql="UPDATE item SET 
							item_no='".mysql_real_escape_string($_POST['txt_itemno'])."',
							item_name=	'".mysql_real_escape_string($_POST['txt_itemname'])."',
							item_type=	'".mysql_real_escape_string($_POST['txt_itemtype'])."'
							 
						
						WHERE item_no='$tid'";
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
      <h2><i class="icon-list"></i> Items Details</h2>
      
    </div>
    
    
    
	<?php
	if(isset($_GET['status']))
	{
		
		 $tid=$_GET['tid'];
		 
		//item view start
		if($_GET['status']=="itemview")
		{
			$sql1 ="SELECT * FROM item WHERE item_no='$tid'";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			?>
			<div class="row-fluid sortable">		
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-list"></i> Items individual Details</h2>
                        
					</div>
                    
                    
                    
                    
                    
				  <div class="box-content">
						<table class="table">
						<tr><td>Item No</td><td><?php echo $row['item_no']; ?></td>
                        <tr><td>Item Name</td><td><?php echo $row['item_name']; ?></td>
                        <tr><td>Item Type</td><td><?php echo $row['item_type']; ?></td>
                        
                        
                        
                        
                       
           
                         
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
		//item view end
		
		//item edit start
		elseif($_GET['status']=="itemedit")
		{
			$sql1 ="SELECT * FROM item WHERE item_no='$tid'";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			
			?>

<div class="box-content">
<div class="box-header well" data-original-title>
      <h2><i class="icon-edit"></i>Edit Items Details</h2>
      
    </div>
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=itemview&tid=<?php echo $tid; ?>" method="post">
        <fieldset>
        
        <table width="100%">
          <tr><td>
 <div class="control-group">
          
            <label class="control-label" for="typeahead">Item NO</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_itemno" id="txt_itemno" value="<?php echo $row['item_no']; ?>" > 
           </div>
          </div>
          
        
                
        
        
 <div class="control-group">
          
            <label class="control-label" for="typeahead">Item Name </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_itemname" id="txt_itemname" value="<?php echo $row['item_name']; ?>" > 
           </div>
          </div>
         


  <div class="control-group">
								<label class="control-label" for="selectError">Item Type</label>
								<div class="controls">
								  <select id="selectError" name="txt_itemtype" data-rel="chosen">
                                  <option value="<?php echo $row['item_type']; ?>"><?php echo $row['item_type']; ?></option>
									<option>Asset</option>
									<option>Consumable</option> 								                                  
                                    </select>
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
			//item edit end
		
		//item delete start
		elseif($_GET['status']=="itemdelete")
		{
			$sql2="DELETE FROM item  WHERE item_no='$tid'";
			$result=mysql_query($sql2) or die("Error in mysql :".mysql_error());
			
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
			$sql1 ="SELECT item_no FROM item ORDER BY item_no  ASC";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			if(mysql_num_rows($result)>0)
			{
				while($row=mysql_fetch_assoc($result))
				{
					$tid=$row['item_no'];
				}
				$n=(string)$tid;
				$tid=++$n;
				
			}
			else
			{
				$tid="I00001";
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
      <h2><i class="icon-edit"></i>Item Details Form</h2>
      
    </div>
<div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
        
        <table width="100%">
        <tr><td>
  <div class="control-group">
          
            <label class="control-label" for="typeahead">Item NO</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_itemno" id="txt_itemno" value="<?php echo $tid; ?>" > 
           </div>
          </div>
          
        
                
        
        
 <div class="control-group">
          
            <label class="control-label" for="typeahead">Item Name </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_itemname" id="txt_itemname" value="" > 
           </div>
          </div>
    


  <div class="control-group">
								<label class="control-label" for="selectError">Item Type</label>
								<div class="controls">
								  <select id="selectError" name="txt_itemtype" data-rel="chosen">
                                  <option></option>
									<option>Asset</option>
									<option>Consumable</option> 								                                  
                                    </select>
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
	global $tid;
	
?>
<div class="row-fluid sortable">		
		<div class="box span12">
		<div class="box-header well" data-original-title>
        <?php
			if($_SESSION['usertype']=="admin")
			{
				?>
				<a class="btn btn-primary " href="<?php echo $newpage; ?>"><i class="icon icon-add icon-orange"></i> Add New Item </a>
                <?php
			}
			else
			{
				?>
				<h4><i class="icon-user"></i> Item Information</h4>
                <?php
			}
			?>
            </div>
            <div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Item No</th>
								  <th>Item Name</th>
								  <th>Item Type</th>
								 <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                          	<?php
								$branch_id=$_SESSION['branch_id'];
								if($_SESSION['usertype']=="admin")
								{
									$sql2="SELECT * FROM item";
								}
								else
								{
									$sql2="SELECT * FROM branch WHERE branch_id='$bid'";
								}
								$result=mysql_query($sql2);
								while($row=mysql_fetch_assoc($result))
								{
									$tid=$row['item_no'];
							?>
							<tr><td class="center"><?php echo $row['item_no']; ?></td><td class="center"><?php echo $row['item_name']; ?></td><td class="center"><?php echo $row['item_type']; ?></td><?php 
								$sql3="SELECT * FROM branch WHERE branch_id='$bid'";
								$result3=mysql_query($sql3);
								$row3=mysql_fetch_assoc($result3);
								$bname=$row3['branch_name'];
							//echo $bname; ?></td><td class="center"><a class="btn btn-success" 
                            href="<?php echo $viewpage; ?>&status=itemview&tid=<?php echo $row['item_no']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <?php
                                    if($_SESSION['usertype']=="admin")
									{ 
										?>
                          <a class="btn btn-info" href="<?php echo $viewpage; ?>&status=itemedit&tid=<?php echo $row['item_no']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
						<a class="btn btn-danger" href="<?php echo $viewpage; ?>&status=itemdelete&tid=<?php echo $row['item_no']; ?>" onclick="return deleteconfirm()">
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
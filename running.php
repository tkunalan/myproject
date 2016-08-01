<?php
	date_default_timezone_set('Asia/Colombo');
	include ("config.php");
if(isset($_SESSION['username']) && ($_SESSION['usertype']=='admin' ||$_SESSION['usertype']=='manager' || $_SESSION['usertype']=='clerk'))
{
	if($_SESSION['usertype']=="admin")
	{
		//$newpage="adminhome.php?pg=running.php&option=new";
		$viewpage="adminhome.php?pg=running.php&option=view";
	}
	elseif($_SESSION['usertype']=="manager")
	{
		//$newpage="managerhome.php?pg=running.php&option=new";
		$viewpage="managerhome.php?pg=running.php&option=view";
	}
	elseif($_SESSION['usertype']=="clerk")
	{
		$newpage="clerkhome.php?pg=running.php&option=new";
		$viewpage="clerkhome.php?pg=running.php&option=view";
	}
	
	
	
	
	
	
	if(isset($_POST['save']))
	{
		$date=date("Y-m-d", strtotime($_POST['txt_date']));
		
		$sql8 ="SELECT *  FROM branch WHERE branch_name='$_POST[txt_branchid]'";
				$result8=mysql_query($sql8) or die ("mysql.error:".mysql_error());
				$row8=mysql_fetch_assoc($result8);
				$barnchid=$row8['branch_id'];
		
		$sql= "INSERT INTO running_chart(chart_id,date,type,start_reading,end_reading,branch_id) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_chartid'])."',
						'".mysql_real_escape_string($date)."',
						'".mysql_real_escape_string($_POST['txt_type'])."',
						'".mysql_real_escape_string($_POST['txt_sreading'])."',
						'".mysql_real_escape_string($_POST['txt_ereading'])."',
						'".mysql_real_escape_string($barnchid)."'
						)";
		
		
		
		
												
				$result=mysql_query($sql) or die("Error in sql ".mysql_error());
					if($result)
						{
							
							 echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
				echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$viewpage.'?pg=running.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
						}
						else
						{
							echo mysql_error();
						}
	
	}

	
	if(isset($_POST['savechanges']))
	{
		
		$cid=$_POST['txt_chartid'];     
		
        $branch_id=$_SESSION['branch_id'];
         $sql3 ="SELECT *  FROM branch WHERE branch_id='$branch_id'";
				$result3=mysql_query($sql3) or die ("mysql.error:".mysql_error());
				$row3=mysql_fetch_assoc($result3);
		
		$sql="UPDATE running_chart SET 
							chart_id='".mysql_real_escape_string($_POST['txt_chartid'])."',
							date='".mysql_real_escape_string($_POST['txt_date'])."',
						 type='".mysql_real_escape_string($_POST['txt_type'])."',
							start_reading='".mysql_real_escape_string($_POST['txt_sreading'])."',
								end_reading='".mysql_real_escape_string($_POST['txt_ereading'])."',
							branch_id='".mysql_real_escape_string($branch_id)."'
							
													
						WHERE chart_id='$cid'";
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
      <h2><i class="icon-edit"></i>Running Chart Details</h2>
      
    </div>
    
    
    
	<?php
	if(isset($_GET['status']))
	{
		
		$cid=$_GET['cid'];     
		
		 
		 
		//running view start
		if($_GET['status']=="runningview")
		{
			$sql1 ="SELECT * FROM running_chart WHERE chart_id='$cid' ";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			?>
			<div class="row-fluid sortable">		
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i>Running Chart Details</h2>
                        
					</div>
                 
                     <?php 
					$sql6 ="SELECT * FROM branch WHERE branch_id='$row[branch_id]'";
			$result6=mysql_query($sql6) or die ("mysql.error:".mysql_error());
			$row6=mysql_fetch_assoc($result6);
							 ?>
                    
                    
                    
				  <div class="box-content">
						<table class="table">
						<tr><td>Chart Id</td><td><?php echo $row['chart_id']; ?></td>
                        <tr><td>Date</td><td><?php echo $row['date']; ?></td>
                        <tr><td>Vechile Type</td><td><?php echo $row['type']; ?></td>
                        <tr><td>Start Reading</td><td><?php echo $row['start_reading']; ?></td>
                        <tr><td>End Reading</td><td><?php echo $row['end_reading']; ?></td>
                        <tr><td>Branch Name</td><td><?php echo $row6['branch_name']; ?></td>
                       
                                               
                        
                               
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
		//running view end
		
		//running edit start
		elseif($_GET['status']=="runningedit")
		{
			$sql1 ="SELECT * FROM running_chart WHERE chart_id='$cid' ";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			
			
			
			?>

<div class="box-content">
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=runningview&cid=<?php echo $cid; ?>" method="post">
        <fieldset>
        
        <table width="100%">
          <tr><td>
   <div class="control-group">
            <label class="control-label" for="typeahead">Chart ID </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_chartid" id="txt_chartid" readonly  value="<?php echo $row['chart_id']; ?>" >
              
            </div>
          </div>  
          
           <div class="control-group">
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
              <input type="date" required class="input-xlarge focused" id="txt_date"  name="txt_date" value="<?php echo $row['date']; ?>">
            </div>
          </div>
         
           
          <div class="control-group">
								<label class="control-label" for="selectError" id="title_text">Vechile Type</label>
								<div class="controls">
								  <select required id="txt_type" class="input-xlarge focused" name="txt_type" data-rel="chosen">
                                  <option value="<?php echo $row['type']; ?>"><?php echo $row['type']; ?></option>
                                  	<option value="Van">Van</option>
									<option value="Auto">Auto</option>
									<option value="others">others</option>
								 </select>
                                 
			</div>
  		  </div>
           
                              
             <div class="control-group">
            <label class="control-label" for="typeahead">Start Reading</label>
            <div class="controls">
    <input type="text" required class="input-xlarge focused" id="txt_sreading" name="txt_sreading" value="<?php echo $row['start_reading']; ?>"  />
              
            </div>
          </div>
          
          
          
          <div class="control-group">
            <label class="control-label" for="typeahead">End Reading</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_ereading" name="txt_ereading" value="<?php echo $row['end_reading']; ?>"  />
              
            </div>
          </div>
          
          <?php
		 $branch_id=$_SESSION['branch_id'];
         $sql3 ="SELECT *  FROM branch WHERE branch_id='$branch_id'";
				$result3=mysql_query($sql3) or die ("mysql.error:".mysql_error());
				$row3=mysql_fetch_assoc($result3);
				?>
                
                
                 <div class="control-group">
            <label class="control-label" for="typeahead">Branch Name</label>
            <div class="controls">
            
            				         <input type="text" name="txt_branchid" class="input-xlarge focused" id="txt_branchid" readonly value="<?php echo $row3['branch_name'];?>">
      		
                                 
                                 
              
                       
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
			//running edit end
		
		//running delete start
		elseif($_GET['status']=="runningdelete")
		{
			$sql2="DELETE FROM running_chart  WHERE chart_id='$cid' ";
			$result=mysql_query($sql2) or die("Error in mysql :".mysql_error());
			
		}
		//running delete end
	}
	
	?>
     <?php
	if(isset($_GET['option']))
	{ 
	  
		//new running entry begin
		if($_GET['option']=="new")
		{
			include ("config.php");
			
			$sql1 ="SELECT chart_id FROM running_chart ORDER BY chart_id  ASC";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			if(mysql_num_rows($result)>0)
			{
				while($row=mysql_fetch_assoc($result))
				{
					$cid=$row['chart_id'];
				}
				$n=(string)$cid;
				$cid=++$n;
				
			}
			else
			{
				$cid="C00001";
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
      <h2><i class="icon-edit"></i>Running Chart Details Form</h2>
      
    </div>
<div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
        
        <table width="100%">
        <tr><td>
  
    <div class="control-group">
            <label class="control-label" for="typeahead">Chart ID </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_chartid"  readonly id="txt_chartid"   value="<?php echo $cid;?>" >
              
            </div>
          </div>  
          
           <div class="control-group">
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
              <input type="date" required class="input-xlarge focused" id="txt_date" value="" name="txt_date">
            </div>
          </div>
         
           
          <div class="control-group">
								<label class="control-label" for="selectError" id="title_text">Vechile Type</label>
								<div class="controls">
								  <select required id="txt_type" class="input-xlarge focused" name="txt_type" data-rel="chosen">
                                  <option></option>
                                  	<option value="Van">Van</option>
									<option value="Auto">Auto</option>
									<option value="others">others</option>
								 </select>
                                 
			</div>
  		  </div>
           
                              
             <div class="control-group">
            <label class="control-label" for="typeahead">Start Reading</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_sreading" name="txt_sreading" value=""  />
              
            </div>
          </div>
          
          
          
          <div class="control-group">
            <label class="control-label" for="typeahead">End Reading</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_ereading" name="txt_ereading" value=""  />
              
            </div>
          </div>
          
          <?php
		  $branch_id=$_SESSION['branch_id'];
         $sql3 ="SELECT *  FROM branch WHERE branch_id='$branch_id'";
				$result3=mysql_query($sql3) or die ("mysql.error:".mysql_error());
				$row3=mysql_fetch_assoc($result3);
				?>
                
                
                 <div class="control-group">
            <label class="control-label" for="typeahead">Branch Name</label>
            <div class="controls">
   <input type="text" name="txt_branchid" class="input-xlarge focused" id="txt_branchid" readonly value="<?php echo $row3['branch_name'];?>">
      		
                                 
                  
              
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
//new running entry end
//view running  or search running  begin
elseif(($_GET['option']=="view"))
        {
	global $cid;
	;
	
?>
<div class="row-fluid sortable">		
		<div class="box span12">
		<div class="box-header well" data-original-title>
        <?php
			if($_SESSION['usertype']=="clerk")
			{
				?>
				<a class="btn btn-primary " href="<?php echo $newpage; ?>"><i class="icon icon-add icon-orange"></i> Add New Running Chart</a>
                <?php
			}

			else
			{
				?>
				<h4><i class="icon-user"></i> Running Chart</h4>
                <?php
			}
			?>
            </div>
            <div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>ChartId</th>
								  <th>Date</th>
                                 <th> Vechile Type</th>
                                  <th>Branch Name</th>
								 <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                          	<?php
								$branch_id=$_SESSION['branch_id'];
								if($_SESSION['usertype']=="admin")
								{
									$sql2="SELECT * FROM running_chart";
								}
								else
								{
									$sql2="SELECT * FROM running_chart WHERE branch_id='$branch_id'";
								}
						
								$result=mysql_query($sql2);
								while($row=mysql_fetch_assoc($result))
								{
									
							
							
			              
		                            
							?>
							<tr><td class="center"><?php echo $row['chart_id']; ?></td><td class="center"><?php echo $row['date']; ?></td><td class="center"><?php echo $row['type']; ?></td><td class="center"><?php 
								$sql6 ="SELECT * FROM branch WHERE branch_id='$row[branch_id]'";
			                   $result6=mysql_query($sql6) or die ("mysql.error:".mysql_error());
			                    $row6=mysql_fetch_assoc($result6);
								$bname=$row6['branch_name'];
							echo $bname; ?></td> <td class="center"><a class="btn btn-success" href="<?php echo $viewpage; ?>&status=runningview&cid=<?php echo $row['chart_id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <?php
                                    if( $_SESSION['usertype']=="clerk")
									{ 
										?>
                          <a class="btn btn-info" href="<?php echo $viewpage; ?>&status=runningedit&cid=<?php echo $row['chart_id']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
					<a class="btn btn-danger" href="<?php echo $viewpage; ?>&status=runningdelete&cid=<?php echo $row['chart_id']; ?>"onclick="return deleteconfirm()">
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
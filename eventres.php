<?php
	date_default_timezone_set('Asia/Colombo');
	include ("config.php");
if(isset($_SESSION['username']) && ($_SESSION['usertype']=='admin' || $_SESSION['usertype']=='manager'))
{
	if($_SESSION['usertype']=="admin")
	{
		$newpage="adminhome.php?pg=eventform.php&option=new";
		$viewpage="adminhome.php?pg=eventres.php&option=view";
	}
	if($_SESSION['usertype']=="manager")
	{
		$viewpage="managerhome.php?pg=eventres.php&option=view";
	}
	
	if(!isset($_GET['status']))
	{
		
		
	?>
   
	<div class="row-fluid sortable">		
				<div class="box span12">
                <?php
							if(!isset($_GET['pr']) || isset($_GET['report']))//check print page or report page
							{
							?>
					<div class="box-header well" data-original-title>
						<h2><i class=""></i> select Month And Year</h2>
                           
					</div>
                 <?php   }?>
                    
                    
                    
                    <div class="box-content">
                     <?php
							if(!isset($_GET['pr']) || isset($_GET['report']))
							{
							?>
                    <form class="form-horizontal" action="" method="post">
                    <table><tr><td>
                    <div class="control-group">
                    
								<label class="control-label" for="selectError1">Month</label>
								<div class="controls">
								  <select name="txtmonth" data-rel="chosen">
                                 <!-- <option value="<?php echo date("m"); ?>" selected><?php echo date("F"); ?></option>
                                  <option value='1'>January</option>
									<option value='2'>February</option>
                                    <option value='3'>March</option>
                                    <option value='4'>April</option>
                                    <option value='5'>May</option>-->
                                     <?php
									 if(isset($_POST['txtmonth']))
									 {
										 $m=$_POST['txtmonth'];
									 }
									 else
									 {
										 $m=date("m");
									 }
									 $month=array("Select the month","January","February","March","April","May","June","July","August","September","October","November","December");//get months in array
								  	for($x=0;$x<=12;$x++)
									{
										if($x==$m)
										{
											echo "<option value=".$x." selected>".$month[$x]."</option>";
										}
										else
										{
											echo "<option value=".$x.">".$month[$x]."</option>";
										}
									}
									?>			                  
                                  </select>
								</div>
			   	 	</div>
                    </td><td>
                    		<div class="control-group">
								<label class="control-label" for="selectError2">Year</label>
								<div class="controls">
								  <select name="txtyear" data-rel="chosen">
                                  
                                  <?php
								  
								   if(isset($_POST['txtyear']))
									 {
										 $y=$_POST['txtyear'];
									 }
									 else
									 {
										 $y=date("Y");
									 }
								  	for($x=date("Y");$x>=(date("Y")-5);$x--)
									{
										if($x==$y)
										{
											echo "<option value=".$x." selected>".$x."</option>";
										}
										else
										{
											echo "<option value=".$x.">".$x."</option>";
										}
									}
									?>
                                          
                                  </select>
								</div>
			   	 			</div>
                            
                            </td></tr><tr><td colspan="2">
                            <center><button type="submit" class="btn btn-primary" name="submit">Submit </button></center>
                            </td></tr></table>
                            </form>
                            <?php }?>
                            </div>
                            </div></div>
                            <?php
	}
	
if(isset($_POST['submit']) )
{
	$month=$_POST['txtmonth'];//get month from form
	$_SESSION['month']=$_POST['txtmonth'];
	$year=$_POST['txtyear'];//get month from form
	$_SESSION['year']=$_POST['txtyear'];

	 $m=$_POST['txtmonth'];
	 $m=date($month);
	
}
else if(isset($_SESSION['month']))
{
	
	$month=$_SESSION['month'];
	$year=$_SESSION['year'];
	
}
else
{
	
	$month=date("m");
	$year=date("Y");
}
	
	
	
	
	
	
	if(isset($_POST['save']))
	{
		$date=date("Y-m-d", strtotime($_POST['txt_date']));
		
		$sql= "INSERT INTO event(event_id,address,country,name,contact_no,date,photo) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_eventid'])."',
						'".mysql_real_escape_string($_POST['txt_address'])."',
						'".mysql_real_escape_string($_POST['txt_country'])."',
						'".mysql_real_escape_string($_POST['txt_name'])."',
						'".mysql_real_escape_string($_POST['txt_contactno'])."',
						'".mysql_real_escape_string($date)."',
						'".mysql_real_escape_string($_POST['txt_photo'])."'
						)";
		$sql2 = "INSERT INTO user(user_id,password,usertype) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_userid'])."',
						'".mysql_real_escape_string($_POST['txt_pass'])."',
						'".mysql_real_escape_string($_POST['txt_usertype'])."')";
						$result2=mysql_query($sql2) or die("Error in sql2 ".mysql_error());
		
		
		
												
				$result=mysql_query($sql) or die("Error in sql ".mysql_error());
					if($result and $result2)
						{
							
							 header("location:".$viewpage);
						}
						else
						{
							echo mysql_error();
						}
	
	}

	
	if(isset($_POST['savechanges']))
	{
		
		$eid=$_POST['txt_eventid'];
		/*$bid=$_POST['txt_branchid'];
		$sql4 ="SELECT *  FROM branch WHERE branch_name='$bid'";
				$result4=mysql_query($sql4) or die ("mysql.error:".mysql_error());
				$row4=mysql_fetch_assoc($result4);*/
		
		$sql="UPDATE event SET 
							event_id='".mysql_real_escape_string($_POST['txt_eventid'])."',
							date='".mysql_real_escape_string($_POST['txt_date'])."',
							event='".mysql_real_escape_string($_POST['txt_event'])."',
							remarks='".mysql_real_escape_string($_POST['txt_remarks'])."'
							 
						
						WHERE event_id='$eid'";
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

       <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
                            <div class="box-header well" data-original-title>
    <center>  <h2><i class="icon-list"></i>  Event Details </h2></center>
    </div>
  <?php }
  
    else
    {
	?>
		<div class="box-header well" data-original-title>
    <center>  <h2><i class="icon-list"></i> Elder's Home Event Details Report</h2></center>
      
    </div>
    
    <?php 
    }?>
    
    
    
	<?php
	if(isset($_GET['status']))
	{
		
		 $eid=$_GET['eid'];
		 
		 
		//event view start
		if($_GET['status']=="eventview")
		{
			$sql1 ="SELECT * FROM event WHERE event_id='$eid'";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			$sql4 ="SELECT *  FROM branch WHERE branch_id='$row[branch_id]'";
				$result4=mysql_query($sql4) or die ("mysql.error:".mysql_error());
				$row4=mysql_fetch_assoc($result4);
			?>
			<div class="row-fluid sortable">		
				<div class="box span6">
					 <?php
							if((isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
    <div class="box-header well" data-original-title>
   <center><h3><i class="icon-edit"></i>Elder's Home Event individual Details</h3></center>
      
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
						<tr><td>Event ID</td><td><?php echo $row['event_id']; ?></td>
                        <tr><td>Sponsor ID</td><td><?php echo $row['user_id']; ?></td>
                        <tr><td>Branch Name</td><td><?php echo $row4['branch_name']; ?></td>
                        <tr><td>Event Type</td><td><?php echo $row['event_type']; ?></td>
                        <tr><td>Date</td><td><?php echo $row['date']; ?></td>
                        <tr><td>Event</td><td><?php echo $row['event']; ?></td>
                        <tr><td>Remarks</td><td><?php echo $row['remarks']; ?></td>
                        
                        
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
									</a> &nbsp;&nbsp;&nbsp;<a class="btn btn-info" 
				onclick="window.open('print.php?pr=eventres.php&option=view&status=eventview&eid=<?php echo $row['event_id']; ?>','_blank')";
				><i class="icon icon-print icon-white"></i> print</a></td><td></td></tr>
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
		//event view end
		
		//event edit start
		elseif($_GET['status']=="eventedit")
		{
			$sql1 ="SELECT * FROM event WHERE event_id='$eid'";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			
			
			?>

<div class="box-content">
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=eventview&eid=<?php echo $eid; ?>" method="post">
        <fieldset>
        
        <table width="100%">
          <tr><td>
          <div class="control-group">
            <label class="control-label" for="typeahead">Event ID </label>
            <div class="controls">
            <input type="text" required class="input-xlarge focused"  name="txt_eventid" id="txt_eventid"  readonly value="<?php echo $row['event_id'];?>" >
              
            </div>
          </div>  
 <div class="control-group">
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
              <input type="date" required class="input-xlarge focused" id="txt_date"  value="<?php echo $row['date']; ?>" name="txt_date">
            </div>
          </div>
         
            
          
    <div class="control-group">
            <label class="control-label" for="typeahead">Event</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_event" name="txt_event" value="<?php echo $row['event']; ?>"  >
              
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="typeahead">Remarks</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_remarks" name="txt_remarks"  value="<?php echo $row['remarks']; ?>"  >
              
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
			//event edit end
		
		//event delete start
		elseif($_GET['status']=="eventdelete")
		{
			$sql2="DELETE FROM event  WHERE event_id='$eid'";
			$result=mysql_query($sql2) or die("Error in mysql :".mysql_error());
			
		}
		//event delete end
	}
	
	?>
     <?php
	if(isset($_GET['option']))
	{ 
	  
		//new eve entry begin
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
      <h2><i class="icon-list"></i>Event Details </h2>
      
    </div>>
<!--<div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
        
        <table width="100%">
        <tr><td>
  
    <div class="control-group">
            <label class="control-label" for="typeahead">Sponsor ID </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_userid" id="txt_userid"   value="" >
              
            </div>
          </div>  
         
                              
                              <div class="control-group">
            <label class="control-label" for="typeahead">Address </label>
            <div class="controls">
            <textarea rows="3" cols="50" name="txt_address" id="txt_address" class="input-xlarge focused" ></textarea>
              
            </div>
          </div>
      		  
              				          <div class="control-group">
            <label class="control-label" for="typeahead">Country</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_country" name="txt_country" >
            
              
            </div>
          </div>
         
          <div class="control-group">
          
            <label class="control-label" for="typeahead">Full Name </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_name" id="txt_name" value="" > 
           </div>
          </div>
          
            <div class="control-group">
            <label class="control-label" for="typeahead">Contact No </label>
            <div class="controls">
              <input type="tel" required class="input-xlarge focused" id="txt_contactno" name="txt_contactno"  />
              
            </div>
          </div>
        
          
          
          
             <div class="control-group">
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
              <input type="date" required class="input-xlarge focused" id="txt_dob" value="" name="txt_date">
            </div>
          </div>
         
            <div class="control-group">
            <label class="control-label" for="typeahead">Photo </label>
            <div class="controls">
            <input class="input-file uniform_on" id="fileInput" type="file" name="txt_photo">

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
       </div>-->
	
  </div>
 <!--/span-->
</div>
<?php	
}
//new payment entry end
//view payment or search payment begin
elseif(($_GET['option']=="view"))
        {
	//global $tid;
	
?>
<div class="row-fluid sortable">		
		<div class="box span12">
		<div class="box-header well" data-original-title>
        <?php
			if($_SESSION['usertype']=="")
			{
				?>
				<a class="btn btn-primary " href="<?php echo $newpage; ?>"><i class="icon icon-add icon-orange"></i> Add New event</a>
                <?php
			}
			else
			{
				
                 
				
			?>
            <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
								
							?>
                            
				
      <h2><i class="icon-list"></i>Event Details </h2>
      
	 
                <?php
							}
			}
			?>
            </div>
            <div class="box-content">
              <?php
						if(isset($_GET['pr']))
						{
							if(isset($_SESSION['month']))
							{
								$month=$_SESSION['month'];
								$year=$_SESSION['year'];
							}
							else
							{
								$month=date("m");
								$year=date("Y");
							}
							
							?>
							
                            
                            
                            <center><table width="40%"><tr><td align="right">Month :</td><td><?php echo $month; ?></td><td align="right">Year :</td><td><?php echo $year; ?></td></tr></table></center>
                            <?php
						
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
								  <th>Event ID</th>
								  <th>Sponsor ID</th>
                                   <th>Branch Name</th>
                                  <th>Date</th>
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
								
								if(isset($_POST['submit']) || isset($_SESSION['month']))
								{
								$month=$_SESSION['month'];//get month from session
								
								$year=$_SESSION['year'];//get month from session
								}
								else
								{
									$month=date('m');
									$year=date('Y');
								}

								$branch_id=$_SESSION['branch_id'];
								if($_SESSION['usertype']=="admin")
								{
									
									$sql2="SELECT * FROM event Where month(date)='$month' AND year(date)='$year'";
								}
								else if($_SESSION['usertype']=="manager")
								{
									
									$sql2="SELECT * FROM event WHERE branch_id='$branch_id' AND month(date)='$month' AND year(date)='$year'";
								}
								$result=mysql_query($sql2);
								while($row=mysql_fetch_assoc($result))
								{
									$eid=$row['event_id'];
									$sql4 ="SELECT *  FROM branch WHERE branch_id='$row[branch_id]'";
				$result4=mysql_query($sql4) or die ("mysql.error:".mysql_error());
				$row4=mysql_fetch_assoc($result4);
		                            
							?>
							<tr><td class="center"><?php echo $row['event_id']; ?></td><td class="center"><?php echo $row['user_id']; ?></td><td class="center"><?php echo $row4['branch_name']; ?></td><td class="center"><?php echo $row['date']; ?></td>
                              <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
                            <td class="center"><a class="btn btn-success" 
                            href="<?php echo $viewpage; ?>&status=eventview&eid=<?php echo $row['event_id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <?php
                                    if($_SESSION['usertype']=="admin")
									{ 
										?>
                          <a class="btn btn-info" href="<?php echo $viewpage; ?>&status=eventedit&eid=<?php echo $row['event_id']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
						<a class="btn btn-danger" href="<?php echo $viewpage; ?>&status=eventdelete&eid=<?php echo $row['event_id']; ?>" onclick="return deleteconfirm()">
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
								?>
                                </tbody>
                                </table></center>
                                    <?php
							if(!isset($_GET['pr']))
							{
							?>
                                <a class="btn btn-info" 
				onclick="window.open('print.php?pr=eventres.php&option=view','_blank')";
				><i class="icon icon-print icon-white"></i> print</a>
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
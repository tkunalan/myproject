<?php
	date_default_timezone_set('Asia/Colombo');
	include ("config.php");
	if(isset($_SESSION['username']) && ($_SESSION['usertype']=='admin'))
{

	if($_SESSION['usertype']=="admin")
	{
		$newpage="adminhome.php?pg=sponsor registration.php&option=new";
		$viewpage="adminhome.php?pg=sponsor registration.php&option=view";
	}
	
	
	
//include ("monthfilter.php");
//select month and year
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
						<h2></i> select Month And Year</h2>
                           
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
		
		$sql= "INSERT INTO sponsor(user_id,address,country,name,contact_no,date,photo) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_userid'])."',
						'".mysql_real_escape_string($_POST['txt_address'])."',
						'".mysql_real_escape_string($_POST['txt_country'])."',
						'".mysql_real_escape_string($_POST['txt_name'])."',
						'".mysql_real_escape_string($_POST['txt_contactno'])."',
						'".mysql_real_escape_string($date)."',
						'".mysql_real_escape_string($_POST['img_photo'])."'
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
		
		$uid=$_POST['txt_userid'];
		
		$sql="UPDATE sponsor SET 
							user_id='".mysql_real_escape_string($_POST['txt_userid'])."',
							address='".mysql_real_escape_string($_POST['txt_address'])."',
							country='".mysql_real_escape_string($_POST['txt_country'])."',
							name='".mysql_real_escape_string($_POST['txt_name'])."',
							contact_no='".mysql_real_escape_string($_POST['txt_contactno'])."',
							date='".mysql_real_escape_string($_POST['txt_date'])."',
							photo='".mysql_real_escape_string($_POST['img_photo'])."'
							 
						
						WHERE usid_id='$uid'";
			$result=mysql_query($sql);
			$sql1="UPDATE user SET 
							usertype='".mysql_real_escape_string($_POST['txt_usertype'])."'
						WHERE user_id='$uid'";
			$result=mysql_query($sql1);
			
										
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
      <h2><i class="icon-edit"></i>sponsors Details </h2>
      
    </div>
  <?php }
  
    else
    {
	?>
		<div class="box-header well" data-original-title>
    <center>  <h2><i class="icon-edit"></i> Elder's Home sponsors Details Report</h2></center>
      
    </div>
    
    <?php 
    }?>
    
    
    
    
	<?php
	if(isset($_GET['status']))
	{
		
		 $uid=$_GET['uid'];
		 
		 
		//sponsor view start
		if($_GET['status']=="sponsorview")
		{
			$sql1 ="SELECT * FROM sponsor WHERE user_id='$uid'";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			?>
			<div class="row-fluid sortable">		
				<div class="box span6">
					         <?php
							if((isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
    <div class="box-header well" data-original-title>
   <center>   <h3><i class="icon-edit"></i>Elder's Home sponsors personal Details</h3></center>
      
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
						<tr><td>Sponsor ID</td><td><?php echo $row['user_id']; ?></td>
                        <tr><td>Address</td><td><?php echo $row['address']; ?></td>
                        <tr><td>Country</td><td><?php echo $row['country']; ?></td>
                        <tr><td>Full Name</td><td><?php echo $row['name']; ?></td>
                        <tr><td>Contact No</td><td><?php echo $row['contact_no']; ?></td>
                        <tr><td>Date</td><td><?php echo $row['date']; ?></td>
                        <tr><td>Photo</td><td><?php echo $row['photo']; ?></td>
                        
                        
                        
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
									</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-info" 
				onclick="window.open('print.php?pr=sponsor registration.php&option=view&status=sponsorview&uid=<?php echo $row['user_id']?>','_blank')";
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
		//sponsor view end
		
		//sponsor edit start
		elseif($_GET['status']=="sponsoredit")
		{
			$sql1 ="SELECT * FROM sponsor WHERE user_id='$uid'";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			
			$sql2 ="SELECT * FROM user WHERE user_id='$uid'";
			$result2=mysql_query($sql2) or die ("mysql.error:".mysql_error());
			$row2=mysql_fetch_assoc($result2);
			
			?>

<div class="box-content">
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=sponsorview&uid=<?php echo $uid; ?>" method="post">
        <fieldset>
        
        <table width="100%">
          <tr><td>
<div class="control-group">
            <label class="control-label" for="typeahead">Sponsor ID </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_userid" id="txt_userid" readonly  value="<?php echo $row['user_id']; ?>" >
              
            </div>
          </div>  
        
                              
                              <div class="control-group">
            <label class="control-label" for="typeahead">Address </label>
            <div class="controls">
            <input type="textarea" required class="input-xlarge focused" name="txt_address" readonly id="txt_address"   value="<?php echo $row['address']; ?>" >
              
            </div>
          </div>
      		  
              				          <div class="control-group">
            <label class="control-label" for="typeahead">Country</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_country" name="txt_country" readonly value="<?php echo $row['country']; ?>" >
            
              
            </div>
          </div>
         
          <div class="control-group">
          
            <label class="control-label" for="typeahead">Full Name </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_name" readonly id="txt_name" value="<?php echo $row['name']; ?>" > 
           </div>
          </div>
          
            <div class="control-group">
            <label class="control-label" for="typeahead">Contact No </label>
            <div class="controls">
              <input type="tel" required class="input-xlarge focused" id="txt_contactno" readonly name="txt_contactno"  value="<?php echo $row['contact_no']; ?>">
              
            </div>
          </div>
        
          
          
          
             <div class="control-group">
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
    <input type="text" required class="input-xlarge focused" id="txt_date" readonly name="txt_date" value="<?php echo $row['date']; ?>">
            </div>
          </div>
         
            <div class="control-group">
            <label class="control-label" for="typeahead">Photo </label>
            <div class="controls">
            <input class="input-file uniform_on" id="img_photo" type="text" name="img_photo" readonly value="<?php echo $row['photo']; ?>">

          </div>
          </div>
          
        <!--  <div class="control-group">
            <label class="control-label" for="typeahead">Password</label>
            <div class="controls">
              <input type="password" required class="input-xlarge focused"  name="txt_pass" value=""  > -->
              
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="typeahead">User Type</label>
            <div class="controls">
            <select   required class="input-xlarge focused"  name="txt_usertype" id="txt_usertype" data-rel="chosen">
            <?php
			if($row2['usertype']=="pending")
			{
				echo "<option selected value='$row2[usertype]'>".$row2['usertype']."</option>";
				echo "<option  value='sponsor'>sponsor</option>";
			}
			else
			{
				echo "<option selected value='$row2[usertype]'>".$row2['usertype']."</option>";
				echo "<option  value='pending'>pending</option>";
			}
			?>
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
			//sponsor edit end
		
		//sponsor delete start
		elseif($_GET['status']=="sponsordelete")
		{
			$sql2="DELETE FROM sponsor  WHERE user_id='$uid'";
			$result=mysql_query($sql2) or die("Error in mysql :".mysql_error());
			
		}
		//sponsor delete end
	}
	
	?>
     <?php
	if(isset($_GET['option']))
	{ 
	  
		//new sponsor entry begin
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
      <h2><i class="icon-edit"></i>Sponsors Details Form</h2>
      
    </div>
<div class="box-content">
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
              <input type="date" required class="input-xlarge focused" id="txt_date" value="" name="txt_date">
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
       </div>
	
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
				<a class="btn btn-primary " href="<?php echo $newpage; ?>"><i class="icon icon-add icon-orange"></i> Add New Sponsor</a>
                <?php
			}
			else
			{
				?>
                 <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
								
							?>
                            
				<h4><i class="icon-user"></i> Sponsor Information</h4>
                <?php
			}}
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
								  <th>Sponsor ID</th>
								  <th>Sponsor Name</th>
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
									$sdate=$year."-".$month."-1";
									$sdate=date("Y-m-d",strtotime($sdate));
									$edate=$year."-".$month."-31";
									$edate=date("Y-m-d",strtotime($edate));
									$sql2="SELECT * FROM sponsor Where month(date)='$month' AND year(date)='$year'";
								}
								//else
								{
									//$sql2="SELECT * FROM branch WHERE branch_id='$bid'";
								}
								$result=mysql_query($sql2);
								while($row=mysql_fetch_assoc($result))
								{
									$uid=$row['user_id'];
		                            
							?>
							<tr><td class="center" align="center"><?php echo $row['user_id']; ?></td><td class="center" align="center"><?php echo $row['name']; ?></td><td class="center" align="center"><?php echo $row['date']; ?></td>
                             <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
                            <td class="center"><a class="btn btn-success" 
                            href="<?php echo $viewpage; ?>&status=sponsorview&uid=<?php echo $row['user_id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <?php
                                    if($_SESSION['usertype']=="admin")
									{ 
										?>
                          <a class="btn btn-info" href="<?php echo $viewpage; ?>&status=sponsoredit&uid=<?php echo $row['user_id']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
						<a class="btn btn-danger" href="<?php echo $viewpage; ?>&status=sponsordelete&uid=<?php echo $row['user_id']; ?>"onclick="return deleteconfirm()">
										<i class="icon-trash icon-white"></i> 
										Delete
									</a>
                                    <?php
                                    }
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
                                <a class="btn btn-info" 
				onclick="window.open('print.php?pr=sponsor registration.php&option=view','_blank')";
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
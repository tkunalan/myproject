<?php
//include ("monthfilter.php");

	include ("config.php");//insert into config page
	date_default_timezone_set('Asia/Colombo');
	if(isset($_SESSION['username']) && ($_SESSION['usertype']=='admin' || $_SESSION['usertype']=='manager'||$_SESSION['usertype']=='clerk'))
{
	if($_SESSION['usertype']=="admin")//check session user type
	{
		
		$viewpage="adminhome.php?pg=salary.php&option=view";
	}
	elseif($_SESSION['usertype']=="manager")
	{
		
		$viewpage="managerhome.php?pg=salary.php&option=view";
	}
	elseif($_SESSION['usertype']=="clerk")
	{
		
		$viewpage="clerkhome.php?pg=salary.php&option=view";
	}
	if(!isset($_GET['status']))
	{
		
		
	?>
   
	<div class="row-fluid sortable">		
				<div class="box span12">
                <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))//check print page or report page
							{
							?>
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> select Salary Month And Year</h2>
                           
					</div>
                 <?php   }?>
                    
                    
                    
                    <div class="box-content">
                     <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
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
                    		<?php
							if(isset($_POST['txtyear']))
									 {
										 $y=$_POST['txtyear'];
									 }
									 else
									 {
										 $y=date("Y");
									 }
							?>
                            <div class="control-group">
								<label class="control-label" for="selectError2">Year</label>
								<div class="controls">
								  <select name="txtyear" data-rel="chosen">
                                  
                                  <?php
								   
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
?>
<?php
if(isset($_GET['status']))
	{
		$sid=$_GET['sid'];
		//$bid=$_GET['bid'];
		$overtime=$_GET['overtime'];
		$allavance=$_GET['allavance'];
		//Staff view start
		if($_GET['status']=="salaryview")
		{
			$sql1 ="SELECT * FROM staff WHERE user_id='$sid'";
			$result=mysqli_query($connection,$sql1) or die ("mysqli.error:".mysqli_error());
			$row=mysqli_fetch_assoc($result);
			?>
			<div class="row-fluid sortable">		
				<div class="box span12">
					
						<?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
    <div class="box-header well" data-original-title>
     <h2><i class="icon-edit"></i>Elder's home Staff Salary Details</h2>
      
    </div>
  <?php }
  
    else
    {
	?>
		<div class="box-header well" data-original-title>
    <center>  <h2><i class="icon-edit"></i>Elder's home staff Salary personal Details Report</h2></center>
      
    </div>
    
    <?php 
    }?>
                        
					
                    
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
                  
						  <tr><td>Month</td><td><?php echo $month; ?></td>
                        <tr><td>Year</td><td><?php echo $year; ?></td> 
						<tr><td>Staff id</td><td><?php echo $row['user_id']; ?></td>
                        <tr><td>Staff Name</td><td><?php echo $row['name']; ?></td>
                        <tr><td>Staff designation</td><td><?php echo $row['staff_designation']; ?></td>
                        <tr><td>Branch</td><td><?php 
										$bid=$row['branch_id'];
										$sql2 ="SELECT branch_name FROM branch WHERE branch_id='$bid'";
										$result2=mysqli_query($connection,$sql2) or die ("mysqli.error:".mysqli_error());
										$row2=mysqli_fetch_assoc($result2);
						
										echo $row2['branch_name']; ?></td>
                        <tr><td>Basic Salary</td><td>Rs <?php echo $row['basic_salary']; ?>/=</td>
                        
             
                        <tr><td>Over Time</td><td>Rs <?php echo $overtime; ?>/=</td></tr>
                         <tr><td>Allowance</td><td>Rs <?php echo $allavance; ?>/=</td></tr>
                         <tr><td>Total</td><td>Rs <?php echo $row['basic_salary']+$allavance+$overtime; ?>/=</td></tr>
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
									</a>&nbsp;&nbsp;&nbsp; <a class="btn btn-info" 
				onclick="window.open('print.php?pr=salary.php&option=view&status=salaryview&sid=<?php echo $row['user_id']?>&overtime=<?php echo $overtime?>&allavance=<?php echo $allavance?>&month=<?php echo $month?>&year=<?php echo $year?>','_blank')";
				><i class="icon icon-print icon-white"></i> print</a></td><td></td></tr>
                 <?php
									 
								}
								?>   
                                     
          						</table>
                     </div>
                 </div>
			</div>
            
            <?php
			exit;
		}
		//Staff view end
	}

?>
<div class="row-fluid sortable">		
				<div class="box span12">
                <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Staff Salary Details</h2>
                        
					</div>
                   <?php }
                   else
				   {
				   ?>
                 <center>  <h2><i class="icon-user"></i>Elders home Staff Salary Details report</h2></center>
                 <table align="center">
                        <tr><td>Month</td><td><?php echo $month; ?></td>
                        <td>Year</td><td><?php echo $year; ?></td></tr></table>
                  <?php  }?>
                    
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
								  <th>Staff Id</th>
								  <th>Staff Name</th>
								  <th>Designation</th>
								  <th>Basic Salary</th>
                                  <th>Over Time</th>
                                  <th>Allowance</th>
								  <th>Total</th>
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
								$branch_id=$_SESSION['branch_id'];
								if($_SESSION['usertype']=="admin")
								{
									$sql2="SELECT * FROM staff";
								}
								else
								{
									$sql2="SELECT * FROM staff WHERE branch_id='$branch_id'";
								}
								$result=mysqli_query($connection,$sql2);
								while($row=mysqli_fetch_assoc($result))
								{
									$bid=$row['branch_id'];
							?>
                            
                                                       
							<tr><td class="center"><?php echo $row['user_id']; ?></td><td class="center"><?php echo $row['name']; ?></td><td class="center"><?php echo $row['staff_designation']; ?></td><td class="center"><?php echo $row['basic_salary']; ?></td><td class="center"><?php 								$sdate=$year."-".$month."-1";
								$sdate=date("Y-m-d",strtotime($sdate));
								$edate=$year."-".$month."-31";
								$edate=date("Y-m-d",strtotime($edate));
								//echo $edate;
								//echo $sdate;
								$userid=$row['user_id'];
								$sql3="SELECT * FROM duty WHERE user_id='$userid' AND month(date)='$month' AND year(date)='$year'";
								$result3=mysqli_query($connection,$sql3);
								$timest=date("H:i:s",strtotime( 000000));
								$timeen=date("H:i:s",strtotime( 235959));
								$count=0;
								while($row3=mysqli_fetch_assoc($result3))//claculate overtime amount
								{
									if(($row3['departure_time']-$row3['arrival_time'])<0)
									{
										$count=$count+((($row3['departure_time']+(24))-$row3['arrival_time']))-8;
										//$count=$count+(($row3['departure_time']+($timest-$row3['arrival_time']))-8);
										//echo $count;
										//echo ($row3['departure_time']+($timeen-$row3['arrival_time']));
									}
									else if(($row3['departure_time']-$row3['arrival_time'])>8)
									{
										$count=$count+(($row3['departure_time']-$row3['arrival_time'])-8);
										//echo $count;
									}
									
								}
								//echo strtotime($row3['departure_time']);
								//echo $count;
								
								//echo $time1;
								$sql5="SELECT * FROM user WHERE user_id='$userid'";
								$result5 =mysqli_query($connection,$sql5);
								$row5= mysqli_fetch_assoc($result5);
								$sql4="SELECT * FROM payment WHERE usertype='$row5[usertype]' AND paymenttype='overtime'";
								$result4=mysqli_query($connection,$sql4);
								$row4=mysqli_fetch_assoc($result4);
								$sql6="SELECT * FROM payment WHERE usertype='admin' AND paymenttype='allowance'";
								$result6=mysqli_query($connection,$sql6);
								$row6=mysqli_fetch_assoc($result6);
								
								$overtime=$row4['amount']*$count;
								
								
							echo $overtime; ?></td>
                            <td class="center"><?php echo $row6['amount']; ?></td>
                            <td class="center"><?php echo $row['basic_salary']+$row6['amount']+$overtime; ?></td><!--salary total calculate-->
                            
                           <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
							?> 
                            <td class="center"><a class="btn btn-success" href="<?php echo $viewpage; ?>&status=salaryview&sid=<?php echo $row['user_id']; ?>&overtime=<?php echo $overtime; ?>&allavance=<?php echo $row6['amount']; ?>&month=<?php echo $month; ?>&year=<?php echo $year;?>&bid=<?php echo $row['branch_id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a></td>
                                    <?php }?>
                                    </tr>
                        		<?php
								}
								?>
                                </tbody>
                                </table>
                                             <?php
							if(!isset($_GET['pr']))
							{
								?>
                                <a class="btn btn-info" 
				onclick="window.open('print.php?pr=salary.php&option=view','_blank')";
				><i class="icon icon-print icon-white"></i> print</a>
				<?php }?>
                               </div></div></div>
							   
		<?php
}
else
{
header("location:index.php");	
}

?>					   
							   
							   
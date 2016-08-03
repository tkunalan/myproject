<?php
	include ("config.php");
date_default_timezone_set('Asia/Colombo');
$utype=$_SESSION['usertype'];
?>

  <script >
	function staffsel() 
	{
	   var e = document.getElementById("txt_userid");
		var f = <?php echo json_encode($utype); ?>;
		var staffname = e.options[e.selectedIndex].text;
	    window.location.href = f+"home.php?pg=duty details.php&option=new&st1=" + staffname;
		return false;
		
	}
</script>
<?php
if(isset($_SESSION['username']) && ($_SESSION['usertype']=='admin' ||$_SESSION['usertype']=='manager' || $_SESSION['usertype']=='clerk'))
{
	if($_SESSION['usertype']=="admin")
	{
		
		$viewpage="adminhome.php?pg=duty details.php&option=view";
	}
	if($_SESSION['usertype']=="manager")
	{
		$newpage="managerhome.php?pg=duty details.php&option=new";
		$viewpage="managerhome.php?pg=duty details.php&option=view";
	}
	if($_SESSION['usertype']=="clerk")
	{
		$newpage="clerkhome.php?pg=duty details.php&option=new";
		$viewpage="clerkhome.php?pg=duty details.php&option=view";
		
	}
	?>
  
	
<?php	
	if(isset($_GET['st1']))
	{
			global $staffselect;
			global $stafftype;
			global $staffname;
			$staffselect = $_GET['st1'];
			$sql4 ="SELECT * FROM staff WHERE name='$staffselect'";
				$result4=mysql_query($sql4) or die ("mysql.error:".mysql_error());
				$row4=mysql_fetch_assoc($result4);
			$sql5 ="SELECT * FROM user WHERE user_id='$row4[user_id]'";
				$result5=mysql_query($sql5) or die ("mysql.error:".mysql_error());
				$row5=mysql_fetch_assoc($result5);	
				$stafftype=$row5['usertype'];
				$staffname=$row4['user_id'];
	}
?>
	
	<?php
	
	if(isset($_POST['save']))
	{
		$date=date("Y-m-d", strtotime($_POST['txt_date']));
		$sql2 = "INSERT INTO duty(user_id,arrival_time,date,departure_time,home_no,work) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_userid'])."',
						'".mysql_real_escape_string($_POST['txt_arrival'])."',
						'".mysql_real_escape_string($date)."',
						'".mysql_real_escape_string($_POST['txt_departure'])."',
						'".mysql_real_escape_string($_POST['txt_homeno'])."',
						'".mysql_real_escape_string($_POST['txt_work'])."'
						)";
		$result2=mysql_query($sql2) or die("Error in sql2 ".mysql_error());
						
						
						if($result2)
						{
							echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
			echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$viewpage.'?pg=duty details.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
						}
						else
						{
							echo mysql_error();
						}
	}
	
	if(isset($_POST['savechanges']))
	{
		
		$sid=$_POST['txt_userid'];
		$arr=$_POST['txt_arrival'];
		$date=$_POST['txt_date'];
		$sql="UPDATE duty SET 
							user_id='".mysql_real_escape_string($_POST['txt_userid'])."',
							arrival_time=	'".mysql_real_escape_string($_POST['txt_arrival'])."',
								date='".mysql_real_escape_string($_POST['txt_date'])."',
							departure_time=	'".mysql_real_escape_string($_POST['txt_departure'])."',
								home_no='".mysql_real_escape_string($_POST['txt_homeno'])."',
							work='".mysql_real_escape_string($_POST['txt_work'])."'
							 
						
						WHERE user_id='$sid' AND arrival_time='$arr' AND date='$date' ";
			$result=mysql_query($sql);
			
										
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
		
		 //$bid=$_GET['bid'];
		 $sid=$_GET['sid'];
		$arr=$_GET['arr'];
		$date=$_GET['date'];
		 
		//duty view start
		if($_GET['status']=="dutyview")
		{
			$sql ="SELECT * FROM duty WHERE user_id='$sid' AND arrival_time='$arr' AND date='$date' ";
			$result=mysqli_query($connection,$sql) or die ("mysql.error:".mysqli_error());
			$row=mysqli_fetch_assoc($result);
			?>
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Duty Details</h2>
                        
					</div>
                    
                    
                    
                    
                    
				  <div class="box-content">
						<table class="table">
						<tr><td>Sfaff ID</td><td><?php echo $row['user_id']; ?></td>
                        <tr><td>Home No</td><td><?php echo $row['home_no']; ?></td>
                        <tr><td>Date</td><td><?php echo $row['date']; ?></td>
                        <tr><td>Arrival Time</td><td><?php echo $row['arrival_time']; ?></td>
                        <tr><td>Departure Time</td><td><?php echo $row['departure_time']; ?></td>
                        <tr><td>Work</td><td><?php echo $row['work']; ?></td>
                        
                        
                        
                        
                       
           
                         
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
		//duty view end
		
		//duty edit start
		elseif($_GET['status']=="dutyedit")
		{
			$sql1 ="SELECT * FROM duty WHERE user_id='$sid' AND arrival_time='$arr' AND date='$date'";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			
			?>

<div class="box-content">
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=dutyview&sid=<?php echo $sid; ?>&arr=<?php echo $arr; ?>&date=<?php echo $date; ?>" method="post">
        <fieldset>
        
        <table width="100%">
        <tr><td>
  <div class="control-group">
          
            <label class="control-label" for="typeahead">Staff ID </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_userid" readonly id="txt_userid" value="<?php echo $sid; ?>" > 
           </div>
          </div>
          
        
                
        
        
 <div class="control-group">
          
            <label class="control-label" for="typeahead">Home NO</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_homeno" readonly id="txt_homeno" value="<?php echo $row['home_no']; ?>" > 
           </div>
          </div>
          
  <div class="control-group">
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
              <input type="date" required id="txt_date" class="span4 typeahead" readonly value="<?php echo $row['date']; ?>" name="txt_date">
            </div>
          </div>      


  <div class="control-group">
            <label class="control-label" for="typeahead">Arrival Time </label>
            <div class="controls">
              <input type="text" rows="5" required class="input-xlarge focused" readonly id="txt_arrival" name="txt_arrival" 
              value="<?php echo $row['arrival_time']; ?>">
              
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="typeahead">Departure Time </label>
            <div class="controls">
              <input type="text" rows="5" required class="input-xlarge focused" id="txt_departure" name="txt_departure" 
              value="<?php echo $row['departure_time']; ?>">
              
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Work </label>
            <div class="controls">
              <input type="text" rows="5" required class="input-xlarge focused" id="txt_work" name="txt_work" 
              value="<?php echo $row['work']; ?>" >
              
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
			//duty edit end
		
		//duty delete start
		elseif($_GET['status']=="dutydelete")
		{
			$sql2="DELETE FROM duty  WHERE user_id='$sid' AND arrival_time='$arr' AND date='$date'";
			$result=mysql_query($sql2) or die("Error in mysql :".mysql_error());
			
		}
		//duty delete end
	}
	
	?>
     <?php
	if(isset($_GET['option']))
	{ 
	  global $bid;
		//new duty entry begin
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
      <h2><i class="icon-edit"></i>Duty Details Form</h2>
      
    </div>
<div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
        
        <table width="100%">
        <tr><td>
   <div class="control-group">
            <label class="control-label" for="typeahead">Staff Name</label>
            <div class="controls">
              
              					
                                
								<?php
								global $staffselect;
								$branch_id=$_SESSION['branch_id'];
										 $sql5="SELECT *  FROM staff WHERE branch_id='$branch_id' ";
				                          $result5=mysql_query($sql5) or die ("mysql.error:".mysql_error());
          		                         $row5=mysql_fetch_assoc($result5);
										 echo "<select required name='txt_userid' onchange='staffsel()' id='txt_userid' data-rel='chosen'>";
										 echo "<option></option>";
									do
									{
										
										/* if($row['incharge']=='0')
										 {
											echo "<option value=".$row4['user_id'].">".$row5['name']."</option>";
										 }
										 else
										 {*/
										 	if($row5['name']==$staffselect)
										 	{
												echo "<option selected value=".$row5['user_id'].">".$row5['name']."</option>"; 
											 }
											 else
											 {
												echo "<option value=".$row5['user_id'].">".$row5['name']."</option>";
											 }
										// }
									}
									while($row5=mysql_fetch_assoc($result5));
									?>										
								 </select>
            </div>
          </div>
          
        
                
        
        
 <div class="control-group">
          
            <label class="control-label" for="typeahead">Home NO</label>
            <div class="controls">
            <?php
			global $stafftype;
			global $staffname;
			$branch_id=$_SESSION['branch_id'];
			if($stafftype=="ward-incharge")
			{
				$sql9= "SELECT * FROM ward WHERE incharge='$staffname' AND branch_id='$branch_id' ORDER BY home_no DESC "; 
				$result9= mysqli_query($connection,$sql9) or die("Error in sql9".mysqli_error());
				$row9=mysqli_fetch_assoc($result9);
				$homeno=$row9['home_no'];
				echo "<input type='text' name='txt_homeno' id='txt_homeno' readonly  value='$homeno'>"."</input>";
			}
			else if($stafftype=="Labour")
			{
				$sql9= "SELECT DISTINCT home_no FROM ward WHERE branch_id='$branch_id' "; 
				$result9= mysqli_query($connection,$sql9) or die("Error in sql9".mysqli_error());
				$row9=mysqli_fetch_assoc($result9);
				$homeno=$row9['home_no'];
				echo "<select name='txt_homeno' data-rel='chosen' id='txt_homeno' required>";
				do{
						echo "<option value=".$row9['home_no'].">".$row9['home_no']."</option>";
					
				}while($row9=mysql_fetch_assoc($result9));
				echo "</select>";
			}
			else
			{
				echo "<input type='text' name='txt_homeno' id='txt_homeno' readonly  value='HOO1'>"."</input>";
			}
			?>
              <!--<input type="text" required class="input-xlarge focused" name="txt_homeno" id="txt_homeno" value="" > -->
           </div>
          </div>
          
  <div class="control-group">
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
              <input type="date" required id="txt_date" class="span4 typeahead" value="" name="txt_date">
            </div>
          </div>        


  <div class="control-group">
            <label class="control-label" for="typeahead">Arrival Time </label>
            <div class="controls">
              <input type="text" value="<?php echo date("H:i:s"); ?>" rows="5" required class="input-xlarge focused" id="txt_arrival" name="txt_arrival" >
              
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="typeahead">Departure Time </label>
            <div class="controls">
              <input type="text" rows="5" required class="input-xlarge focused" value="<?php echo date("H:i:s"); ?>" id="txt_departure" name="txt_departure" >
              
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Work </label>
            <div class="controls">
              <input type="text" rows="5" required class="input-xlarge focused" id="txt_work" name="txt_work" >
              
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
//new duty entry end
//view duty or search duty begin
elseif(($_GET['option']=="view"))
        {
	global $bid;
	
?>
<div class="row-fluid sortable">		
		<div class="box span12">
		<div class="box-header well" data-original-title>
        <?php
			if($_SESSION['usertype']=="manager"|| $_SESSION['usertype']=="clerk")
			{
				?>
				<a class="btn btn-primary " href="<?php echo $newpage; ?>"><i class="icon icon-add icon-orange"></i> Add New Duty </a>
                <?php
			}
			else
			{
				?>
				<h4><i class="icon-user"></i> Duty Information</h4>
                <?php
			}
			?>
            </div>
            <div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Sfaff ID</th>
								  <th>Date</th>
								  <th>Arrival Time</th>
								 <th>Actions</th>
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
									$sql2="SELECT user_id FROM staff WHERE branch_id='$branch_id'";
									
								}
								$result2=mysqli_query($connection,$sql2);
								while($row2=mysqli_fetch_assoc($result2))
								{
									$sql1="SELECT * FROM duty WHERE user_id='$row2[user_id]'";
									$result1= mysqli_query($connection,$sql1) or die("Error in sql1".mysqli_error());
									
									if(mysqli_num_rows($result1)<=0)
									{
									}
									else
									{
									while($row= mysqli_fetch_assoc($result1))
									{
							?>
							<tr><td class="center"><?php echo $row['user_id']; ?></td><td class="center"><?php echo $row['date']; ?></td><td class="center"><?php echo $row['arrival_time']; ?></td></td><td class="center"><a class="btn btn-success" href="<?php echo $viewpage; ?>&status=dutyview&sid=<?php echo $row['user_id']; ?>&arr=<?php echo $row['arrival_time']; ?>&date=<?php echo $row['date']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <?php
                                    if($_SESSION['usertype']=="manager"|| $_SESSION['usertype']=="clerk")
									{ 
										?>
                          <a class="btn btn-info" href="<?php echo $viewpage; ?>&status=dutyedit&sid=<?php echo $row['user_id']; ?>&arr=<?php echo $row['arrival_time']; ?>&date=<?php echo $row['date']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
                                    <?php
                                    } 
									?>
                                    </td></tr>
                                    <?php
									}
								}}
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
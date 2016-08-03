<?php
	include ("config.php");
	if(isset($_SESSION['username']) && ($_SESSION['usertype']=='admin' ||$_SESSION['usertype']=='manager' ||$_SESSION['usertype']=='ward-incharge' || $_SESSION['usertype']=='clerk'))
{
		date_default_timezone_set('Asia/Colombo');
$utype=$_SESSION['usertype'];

	if($_SESSION['usertype']=="admin")
	{
		
		$viewpage="adminhome.php?pg=food.php&option=view";
	}
	if($_SESSION['usertype']=="manager")
	{
		
		$viewpage="managerhome.php?pg=food.php&option=view";
	}
	if($_SESSION['usertype']=="clerk")
	{
		$viewpage="clerkhome.php?pg=food.php&option=view";
	}
	if($_SESSION['usertype']=="ward-incharge")
	{
		$newpage="wardincharhome.php?pg=food.php&option=new";
		$viewpage="wardincharhome.php?pg=food.php&option=view";
	}
	
	
	if(isset($_POST['submit']) )
	{
		$date=$_POST['txtdate'];//get date from form
		$_SESSION['txtdate']=$_POST['txtdate'];
	}
	else if(isset($_SESSION['txtdate']))
	{
		$date=$_SESSION['txtdate'];
		
	}
	else
	{
		$date=date("Y-m-d");
	}
	
	?>
    <script>
     function homesel() 
	{
	    var f = <?php echo json_encode($utype); ?>;
		var k = document.getElementById("txt_homeno");		
		var homesel = k.options[k.selectedIndex].text;
	    window.location.href = "wardincharhome.php?pg=food.php&option=new&hid=" + homesel;
		return false;
		
	}
    
 </script>
 <?php
 if(isset($_GET['hid']))
	{
			global $homeselect;
			$homeselect = $_GET['hid'];
	}
 ?>   
    <div class="row-fluid sortable">		
				<div class="box span12">
                <?php
							if(!isset($_GET['pr']) || isset($_GET['report']))//check print page or report page
							{
							?>
					<div class="box-header well" data-original-title>
						<h2></i> select Date</h2>
                           
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
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
              <input type="date" required class="input-xlarge focused" id="txtdate" value="<?php echo $date; ?>" name="txtdate">
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
	
	if(isset($_POST['save']))
	{
		
		$date=date("Y-m-d", strtotime($_POST['txt_date']));
		$sql8 ="SELECT *  FROM branch WHERE branch_name='$_POST[txt_branchid]'";
				$result8=mysqli_query($connection,$sql8) or die ("mysqli.error:".mysqli_error());
				$row8=mysqli_fetch_assoc($result8);
				$barnchid=$row8['branch_id'];
		$sql2 = "INSERT INTO food(ward_no,home_no,date,breakfast,lunch,dinner,branch_id) 
						VALUES(
						'".mysqli_real_escape_string($connection,$_POST['txt_wardno'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_homeno'])."',
						'".mysqli_real_escape_string($connection,$date)."',
						'".mysqli_real_escape_string($connection,$_POST['txt_bfast'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_lunch'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_dinner'])."',
						'".mysqli_real_escape_string($connection,$barnchid)."'
						)";
		$result2=mysqli_query($connection,$sql2) or die("Error in sql2 ".mysqli_error());
						
						
						if($result2)
						{
							echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
				echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$viewpage.'?pg=food.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
						}
						else
						{
							echo mysql_error();
						}
	}
	
	if(isset($_POST['savechanges']))
	{
		$sql8 ="SELECT *  FROM branch WHERE branch_name='$_POST[txt_branchid]'";
				$result8=mysqli_query($connection,$sql8) or die ("mysqli.error:".mysqli_error());
				$row8=mysqli_fetch_assoc($result8);
				$barnchid=$row8['branch_id'];
		$hid=$_POST['txt_homeno'];
		$wid=$_POST['txt_wardno'];
		$bid=$barnchid;
		$did=$_POST['txt_date'];
		
	 
                     
                              $branch_id=$_SESSION['branch_id'];
					$sql4 ="SELECT *  FROM branch WHERE branch_id='$branch_id'";
				$result4=mysqli_query($connection,$sql4) or die ("mysqli.error:".mysqli_error());
				$row4=mysqli_fetch_assoc($result4);
			
		$sql="UPDATE food SET 
			                ward_no='".mysqli_real_escape_string($_POST['txt_wardno'])."',
							home_no='".mysqli_real_escape_string($connection,$_POST['txt_homeno'])."',
							date=	'".mysqli_real_escape_string($connection,$_POST['txt_date'])."',
							breakfast='".mysqli_real_escape_string($connection,$_POST['txt_bfast'])."',
							lunch='".mysqli_real_escape_string($connection,$_POST['txt_lunch'])."',
							dinner='".mysqli_real_escape_string($connection,$_POST['txt_dinner'])."',
							branch_id='".mysqli_real_escape_string($connection,$branch_id)."'
							 
						
						WHERE home_no='$hid' AND ward_no='$wid' AND branch_id='$bid' AND date='$did' ";
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
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
    <div class="box-header well" data-original-title>
      <h2><i class="icon-edit"></i>Food Details </h2>
      
    </div>
  <?php }
  
    else
    {
	?>
		<div class="box-header well" data-original-title>
    <center>  <h2><i class="icon-edit"></i> Elder's Home Food Details Report</h2></center>
      
    </div>
    
    <?php 
    }?>
    
    
    
	<?php
	if(isset($_GET['status']))
	{
		
		 $hid=$_GET['hid'];
		 $wid=$_GET['wid'];
		 $branch_id=$_SESSION['branch_id'];
		 $did=$_GET['did'];
		  $bid=$_GET['bid'];
		
		if($_GET['status']=="foodview")
		{
			
				$sql1 ="SELECT * FROM food  WHERE home_no='$hid' AND ward_no='$wid' AND branch_id='$bid' AND date='$did'";
				$result=mysqli_query($connection,$sql1) or die ("mysqli.error:".mysqli_error());
				$row=mysqli_fetch_assoc($result);
				
			
			
			//$wid=$row['ward_no']
			?>
			<div class="row-fluid sortable">		
				<div class="box span6">
														         <?php
							if((isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
    <div class="box-header well" data-original-title>
   <center>   <h3><i class="icon-edit"></i>Elder's Home Food individual Details</h3></center>
      
    </div>
  <?php }
                    

                    
                     
					$sql6 ="SELECT * FROM branch WHERE branch_id='$row[branch_id]'";
			$result6=mysqli_query($connection,$sql6) or die ("mysqli.error:".mysqli_error());
			$row6=mysqli_fetch_assoc($result6);
							 ?>
                    
               
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
						<tr><td>Home No</td><td><?php echo $row['home_no']; ?></td></tr>
                        <tr><td>Ward No</td><td><?php echo $row['ward_no']; ?></td></tr>
                        <tr><td>Date</td><td><?php echo $row['date']; ?></td></tr>
                        <tr><td>BreakFast</td><td><?php echo $row['breakfast']; ?></td></tr>
                        <tr><td>Lunch</td><td><?php echo $row['lunch']; ?></td></tr>
                        <tr><td>Dinner</td><td><?php echo $row['dinner']; ?></td></tr>
                        <tr><td>Branch Id</td><td><?php echo $row6['branch_name']; ?></td></tr>                                         
                                                                   
                               
                               
                               
                               
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
									</a>
                              &nbsp;&nbsp;&nbsp;<a class="btn btn-info" 
				onclick="window.open('print.php?pr=food.php&option=view&status=foodview&hid=<?php echo $row['home_no']; ?>&wid=<?php echo $row['ward_no']; ?>&bid=<?php echo $row['branch_id']; ?>&did=<?php echo $row['date']; ?>','_blank')";
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
		//food view end
		
		//food edit start
		elseif($_GET['status']=="foodedit")
		{
			$sql1 ="SELECT * FROM food WHERE home_no='$hid' AND ward_no='$wid'AND branch_id='$branch_id' AND date='$did'";
			$result=mysqli_query($connection,$sql1) or die ("mysqli.error:".mysqli_error());
			$row=mysqli_fetch_assoc($result);
			
			?>

<div class="box-content">
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=foodview&hid=<?php echo $hid; ?>&wid=<?php echo $wid; ?>&bid=<?php echo $bid; ?>&did=<?php echo $did; ?>" method="post">
        <fieldset>
        
        <table width="100%">
          <tr><td>

        <div class="control-group">    
            <label class="control-label" for="typeahead">Home No</label>
            <div class="controls">
   <input type="text" required class="input-xlarge focused" name="txt_homeno" id="txt_homeno" readonly value="<?php echo $row['home_no']; ?>" > 
           </div>
          </div>
          
        
                
        
        
 <div class="control-group">
            <label class="control-label" for="typeahead">Ward No </label>
            <div class="controls">
    <input type="text" required class="input-xlarge focused" name="txt_wardno" id="txt_wardno" readonly value="<?php echo $row['ward_no']; ?>" > 
           </div>
          </div>
          
  <div class="control-group">
            <label class="control-label" for="typeahead">date</label>
            <div class="controls">
              <input type="date" rows="5" required class="input-xlarge focused" id="txt_date" name="txt_date"  value="<?php echo $row['date']; ?>">
              
            </div>
          </div>        

                 <?php 
				 $branch_id=$_SESSION['branch_id'];
		  		$sql3 ="SELECT *  FROM staff WHERE branch_id='$branch_id' ";
				$result3=mysqli_query($connection,$sql3) or die ("mysqli.error:".mysqli_error());
          		$row3=mysqli_fetch_assoc($result3);
          ?>
          <div class="control-group">
            <label class="control-label" for="typeahead">Breakfast</label>
            <div class="controls">
            <input type="text"  required class="input-xlarge focused" id="txt_bfast" name="txt_bfast"  value="<?php echo $row['breakfast']; ?>">  
              					
            </div>
          </div>
<div class="control-group">
            <label class="control-label" for="typeahead">Lunch</label>
            <div class="controls">
              <input type="text"  required class="input-xlarge focused" id="txt_lunch" name="txt_lunch" value="<?php echo $row['lunch']; ?>" >
              
            </div>
          </div>
          
          
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Dinner</label>
            <div class="controls">
            <input type="text"  required class="input-xlarge focused" id="txt_dinner" name="txt_dinner" value="<?php echo $row['dinner']; ?>">
              
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
			//food edit end
		
		//food delete start
		elseif($_GET['status']=="fooddelete")
		{
			$sql2="DELETE FROM food  WHERE home_no='$hid' AND ward_no='$wid' AND branch_id='$branch_id' AND date='$did'";
			$result2=mysqli_query($connection,$sql2) or die("Error in mysqli :".mysqli_error());
		
		}
		//food delete end
	}
	
	?>
     <?php
	if(isset($_GET['option']))
	{ 
	  global $bid;
		//new food entry begin
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
      <h2><i class="icon-edit"></i>Food Requirement Details Form</h2>
      
    </div>
<div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
        
        <table width="100%">
        <tr><td>
     <div class="control-group">
            <label class="control-label" for="typeahead">Home NO</label>
            <div class="controls">
                 <?php
			
			global $homeselect;
			echo "<select id='txt_homeno' name='txt_homeno' onchange='homesel()' data-rel='chosen'>";
                                 echo "<option></option>";
								 $branch_id=$_SESSION['branch_id'];
				
				
           $sql4="SELECT DISTINCT home_no FROM ward WHERE branch_id='$branch_id' AND incharge='$userId' ";
				$result4=mysql_query($sql4);
				$row4=mysql_fetch_assoc($result4);	
				do
				{
					if($row4['home_no']==$homeselect)
			 		{
						echo "<option selected value=".$row4['home_no'].">".$row4['home_no']."</option>"; 
					 }
					 else
					 {
						echo "<option value=".$row4['home_no'].">".$row4['home_no']."</option>";
					 }
				}
				while($row4=mysql_fetch_assoc($result4));
				echo "</select>";
              ?>
              
            </div>
          </div>
          
        
               
          <div class="control-group">
            <label class="control-label" for="typeahead">Ward No </label>
            <div class="controls">
                     <?php
			global $supplyselect;
			global $itemselect;
			global $purchaseselect;
			global $homeselect;
			
			echo "<select id='txt_wardno' name='txt_wardno'  data-rel='chosen'>";
                                 echo "<option></option>";
								 $branch_id=$_SESSION['branch_id'];
				$userId=$_SESSION['username'];
				
           $sql4="SELECT DISTINCT ward_no FROM ward WHERE branch_id='$branch_id' AND home_no='$homeselect' AND no_of_beds!='0' AND incharge='$userId' ";
				$result4=mysql_query($sql4);
				$row4=mysql_fetch_assoc($result4);	
				do
				{
					
						echo "<option value=".$row4['ward_no'].">".$row4['ward_no']."</option>";
					 
				}
				while($row4=mysql_fetch_assoc($result4));
				echo "</select>";
              ?>
              
            </div>
          </div>
          
  <div class="control-group">
            <label class="control-label" for="typeahead">date</label>
            <div class="controls">
              <input type="date" rows="5" required class="input-xlarge focused" id="txt_date" name="txt_date" >
              
            </div>
          </div>        

                 <?php 
				 $branch_id=$_SESSION['branch_id'];
		  		$sql3 ="SELECT *  FROM staff WHERE branch_id='$branch_id' ";
				$result3=mysqli_query($connection,$sql3) or die ("mysqli.error:".mysqli_error());
          		$row3=mysqli_fetch_assoc($result3);
          ?>
          <div class="control-group">
            <label class="control-label" for="typeahead">Breakfast</label>
            <div class="controls">
            <input type="text"  required class="input-xlarge focused" id="txt_bfast" name="txt_bfast" >  
              					
            </div>
          </div>
<div class="control-group">
            <label class="control-label" for="typeahead">Lunch</label>
            <div class="controls">
              <input type="text"  required class="input-xlarge focused" id="txt_lunch" name="txt_lunch" >
              
            </div>
          </div>
          
          
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Dinner</label>
            <div class="controls">
              <input type="text"  required class="input-xlarge focused" id="txt_dinner" name="txt_dinner" >
              
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
//new food entry end
//view food or search food begin
elseif(($_GET['option']=="view"))
        {
	global $bid;
	
?>
<div class="row-fluid sortable">		
		<div class="box span12">
		<div class="box-header well" data-original-title>
        <?php
			if($_SESSION['usertype']=="ward-incharge")
			{
				?>
                <?php
                if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
								
							?>
				<a class="btn btn-primary " href="<?php echo $newpage; ?>"><i class="icon icon-add icon-orange"></i> Add New Food </a>
                <?php
			}}
			else
			{
				?>
				
                <?php
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
								  <th>Home No</th>
								  <th>Ward No</th>
                                  <th>Branch Name</th>
								  <th>BreakFast</th>
                                  <th>Lunch</th>
                                  <th>Dinner</th>
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
								$userId=$_SESSION['username'];
								//$row4['incharge']=$_SESSION['username'];
								if($_SESSION['usertype']=="admin")
								{
									$sql2="SELECT * FROM food WHERE date='$date'";
								}
								else if(($_SESSION['usertype']=="manager") || ($_SESSION['usertype']=="clerk"))
								{
									$sql2="SELECT * FROM food WHERE branch_id='$branch_id' AND date='$date'";
								}
								elseif ($_SESSION['usertype']=="ward-incharge")
								{
									$sql4="SELECT * FROM ward WHERE branch_id='$branch_id' AND incharge='$userId' ";
				                    $result4=mysql_query($sql4);
				                    $row4=mysql_fetch_assoc($result4);
									$wardno=$row4['ward_no'];
									$sql2="SELECT * FROM food WHERE branch_id='$branch_id' AND date='$date' AND ward_no='$wardno'";
								}
								
								$result=mysql_query($sql2);
								$bfast=0;
								$lunch=0;
								$dinner=0;
								//$result=mysql_query($sql2) or die(mysql_error());
								while($row=mysql_fetch_assoc($result))
								{
									$bid=$row['branch_id'];
									$bfast=$bfast+$row['breakfast'];
							$lunch=$lunch+$row['lunch'];
									$dinner=$dinner+$row['dinner'];
							?>
							<tr><td class="center"><?php echo $row['home_no']; ?></td><td class="center"><?php echo $row['ward_no']; ?></td>
                            
                            <td class="center"><?php 
								$sql3="SELECT * FROM branch WHERE branch_id='$bid'";
								$result3=mysql_query($sql3);
								$row3=mysql_fetch_assoc($result3);
								$bname=$row3['branch_name'];
							echo $bname; ?></td>
                            
                            <td class="center"><?php echo $row['breakfast']; ?></td><td class="center"><?php echo $row['lunch']; ?></td><td class="center"><?php echo $row['dinner']; ?></td> 
                              <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
                            
                            
                            <td class="center"><a class="btn btn-success" href="<?php echo $viewpage; ?>&status=foodview&hid=<?php echo $row['home_no']; ?>&wid=<?php echo $row['ward_no']; ?>&bid=<?php echo $row['branch_id']; ?>&did=<?php echo $row['date']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <?php
                                    if($_SESSION['usertype']=="ward-incharge")
									{ 
										?>
                          <a class="btn btn-info" href="<?php echo $viewpage; ?>&status=foodedit&hid=<?php echo $row['home_no']; ?>&wid=<?php echo $row['ward_no']; ?>&bid=<?php echo $row['branch_id']; ?>&did=<?php echo $row['date']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
						<a class="btn btn-danger" href="<?php echo $viewpage; ?>&status=fooddelete&hid=<?php echo $row['home_no']; ?>&wid=<?php echo $row['ward_no']; ?>&bid=<?php echo $row['branch_id']; ?>&did=<?php echo $row['date']; ?>" onclick="return deleteconfirm()">
										<i class="icon-trash icon-white"></i> 
										Delete
									</a>
                                    <?php
                                    }
									?>
                                    </td> <?php }?> </tr>
                                    <?php
								}
								?>
                               <tr><td>Z</td><td></td><td align="right"></td><td>Total Breakfast =<?php echo $bfast; ?></td><td>Total Lunch =<?php echo $lunch; ?></td><td>Total Dinner =<?php echo $dinner; ?></td>
                                <?php
                                if(!isset($_GET['pr']))
							{
                                ?>
                                <td></td>
                                <?php } ?>
                                </tr>
                                </tbody>
                                </table>
                                
                                </center>
                                
                                
                                     <?php
							if(!isset($_GET['pr']))
							{
							?>
                                <a class="btn btn-info" 
				onclick="window.open('print.php?pr=food.php&option=view','_blank')";
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
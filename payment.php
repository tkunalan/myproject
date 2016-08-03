<?php
	include ("config.php");
if(isset($_SESSION['username']) && ($_SESSION['usertype']=='admin' || $_SESSION['usertype']=='manager'))
{
	if($_SESSION['usertype']=="admin")
	{
		$newpage="adminhome.php?pg=payment.php&option=new";
		$viewpage="adminhome.php?pg=payment.php&option=view";
	}
	
	
	
	
	if(isset($_POST['save']))
	{
		$sql2 = "INSERT INTO payment(usertype,paymenttype,amount) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_usertype'])."',
						'".mysql_real_escape_string($_POST['txt_paytype'])."',
						'".mysql_real_escape_string($_POST['txt_amount'])."'
						)";
		$result2=mysql_query($sql2) or die("Error in sql2 ".mysql_error());
						
						
						if($result2)
						{
									
					echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
				echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$viewpage.'?pg=payment.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
						}
						else
						{
							echo mysql_error();
						}
	}
	
	if(isset($_POST['savechanges']))
	{
		
		$utid=$_POST['txt_usertype'];
		$ptid=$_POST['txt_paytype'];
		$sql="UPDATE payment SET 
							usertype='".mysql_real_escape_string($_POST['txt_usertype'])."',
							paymenttype='".mysql_real_escape_string($_POST['txt_paytype'])."',
							amount='".mysql_real_escape_string($_POST['txt_amount'])."'
							 
						
						WHERE usertype='$utid' AND paymenttype='$ptid'";
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
      <h2><i class="icon-edit"></i>Staff Payment Details Form</h2>
      
    </div>
    
    
    
	<?php
	if(isset($_GET['status']))
	{
		
		 $utid=$_GET['utid'];
		 $ptid=$_GET['ptid'];
		 
		//payment view start
		if($_GET['status']=="paymentview")
		{
			$sql1 ="SELECT * FROM payment WHERE usertype='$utid' AND paymenttype='$ptid'";
			$result=mysqli_query($connection,$sql1) or die ("mysqli.error:".mysqli_error());
			$row=mysqli_fetch_assoc($result);
			?>
			<div class="row-fluid sortable">		
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i>Sfaff Payment Details</h2>
                        
					</div>
                    
                    
                    
                    
                    
				  <div class="box-content">
						<table class="table">
						<tr><td>Staff Type</td><td><?php echo $row['usertype']; ?></td>
                        <tr><td>Payment Type</td><td><?php echo $row['paymenttype']; ?></td>
                        <tr><td>Amount</td><td><?php echo $row['amount']; ?></td>
                        
                        
                        
                        
                       
           
                         
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
		//payment view end
		
		//payment edit start
		elseif($_GET['status']=="paymentedit")
		{
			$sql1 ="SELECT * FROM payment WHERE usertype='$utid' AND paymenttype='$ptid'";
			$result=mysqli_query($connection,$sql1) or die ("mysqli.error:".mysqli_error());
			$row=mysqli_fetch_assoc($result);
			
			?>

<div class="box-content">
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=paymentview&utid=<?php echo $utid; ?>&ptid=<?php echo $ptid; ?>" method="post">
        <fieldset>
        
        <table width="100%">
          <tr><td>
   <div class="control-group">
								<label class="control-label" for="selectError">Staff Type</label>
								<div class="controls">
								  <select id="txt_usertype" name="txt_usertype" data-rel="chosen">
                                  <option value="<?php echo $row['usertype']; ?>"><?php echo $row['usertype']; ?></option>
                                   	<option value="ward-incharge">ward-incharge</option>
									<option Value="clerk">clerk</option>
									<option value="admin">admin</option>
                                    <option Value="doctor">doctor</option>
                                    <option Value="manager">manager</option> 
                                    <option value="Labour">Labour</option>   								                                  
                                    </select>
								</div>
							  </div>
                              
                              
  <div class="control-group">
								<label class="control-label" for="selectError">Payment Type</label>
								<div class="controls">
								  <select id="txt_paytype" name="txt_paytype" data-rel="chosen">
                                  <option value="<?php echo $row['paymenttype']; ?>"><?php echo $row['paymenttype']; ?></option>
									<option>Allowance</option>
									<option>overtime</option> 								                                  
                                    </select>
								</div>
							  </div>
          
        
                
        
        
<div class="control-group">
            <label class="control-label" for="typeahead">Amount</label>
            <div class="controls">
            <div class="input-prepend input-append ">
              <span class="add-on">Rs</span><input type="text" required class="" value="<?php echo $row['amount']; ?>"id="txt_amount" name="txt_amount"><span class="add-on">.00</span>
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
			//payment edit end
		
		//payment delete start
		elseif($_GET['status']=="paymentdelete")
		{
			$sql2="DELETE FROM payment  WHERE usertype='$utid' AND paymenttype='$ptid'";
			$result=mysqli_query($connection,$sql2) or die("Error in mysqli :".mysqli_error());
			
		}
		//payment delete end
	}
	
	?>
     <?php
	if(isset($_GET['option']))
	{ 
	  //global $bid;
		//new payment entry begin
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
      <h2><i class="icon-edit"></i>Sfaff Payment Details Form</h2>
      
    </div>
<div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
        
        <table width="100%">
        <tr><td>
  
  <div class="control-group">
								<label class="control-label" for="selectError">Staff Type</label>
								<div class="controls">
								  <select id="txt_usertype" name="txt_usertype" data-rel="chosen">
                                  <option></option>
                                   	<option value="ward-incharge">ward-incharge</option>
									<option Value="clerk">clerk</option>
									<option value="admin">admin</option>
                                    <option Value="doctor">doctor</option>
                                    <option Value="manager">manager</option> 
                                    <option value="Labour">Labour</option>   								                                  
                                    </select>
								</div>
							  </div>
                              
                              
  <div class="control-group">
								<label class="control-label" for="selectError">Payment Type</label>
								<div class="controls">
								  <select id="txt_paytype" name="txt_paytype" data-rel="chosen">
                                  <option></option>
									<option>Allowance</option>
									<option>overtime</option> 								                                  
                                    </select>
								</div>
							  </div>
          
        
                
        
        
<div class="control-group">
            <label class="control-label" for="typeahead">Amount</label>
            <div class="controls">
            <div class="input-prepend input-append ">
              <span class="add-on">Rs</span><input type="text" required class="" id="txt_amount" name="txt_amount"><span class="add-on">.00</span>
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
			if($_SESSION['usertype']=="admin")
			{
				?>
				<a class="btn btn-primary " href="<?php echo $newpage; ?>"><i class="icon icon-add icon-orange"></i> Add New Payment</a>
                <?php
			}
			else
			{
				?>
				<h4><i class="icon-user"></i> Staff Payment Information</h4>
                <?php
			}
			?>
            </div>
            <div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Staff Type</th>
								  <th>Payment Type</th>
								  <th>Amount</th>
								 <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                          	<?php
								$branch_id=$_SESSION['branch_id'];
								if($_SESSION['usertype']=="admin")
								{
									$sql2="SELECT * FROM payment";
								}
								//else
								{
									//$sql2="SELECT * FROM branch WHERE branch_id='$bid'";
								}
								$result=mysql_query($sql2);
								while($row=mysql_fetch_assoc($result))
								{
									$utid=$row['usertype'];
		                            $ptid=$row['paymenttype'];
							?>
							<tr><td class="center"><?php echo $row['usertype']; ?></td><td class="center"><?php echo $row['paymenttype']; ?></td><td class="center"><?php echo $row['amount']; ?></td><?php 
								//$sql3="SELECT * FROM branch WHERE branch_id='$bid'";
								//$result3=mysql_query($sql3);
								//$row3=mysql_fetch_assoc($result3);
								//$bname=$row3['branch_name'];
							//echo $bname; ?></td><td class="center"><a class="btn btn-success" 
                            href="<?php echo $viewpage; ?>&status=paymentview&utid=<?php echo $row['usertype']; ?>&ptid=<?php echo $row['paymenttype']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <?php
                                    if($_SESSION['usertype']=="admin")
									{ 
										?>
                          <a class="btn btn-info" href="<?php echo $viewpage; ?>&status=paymentedit&utid=<?php echo $row['usertype']; ?>&ptid=<?php echo $row['paymenttype']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
						<a class="btn btn-danger" href="<?php echo $viewpage; ?>&status=paymentdelete&utid=<?php echo $row['usertype']; ?>&ptid=<?php echo $row['paymenttype']; ?>" onclick="return deleteconfirm()">
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
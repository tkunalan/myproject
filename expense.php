<?php
	date_default_timezone_set('Asia/Colombo');
	include ("config.php");
	if(isset($_SESSION['username']) && ($_SESSION['usertype']=='admin' ||$_SESSION['usertype']=='manager' || $_SESSION['usertype']=='clerk'))
{

	if($_SESSION['usertype']=="admin")
	{
		//$newpage="adminhome.php?pg=expense.php&option=new";
		$viewpage="adminhome.php?pg=expense.php&option=view";
	}
	elseif($_SESSION['usertype']=="manager")
	{
		$newpage="managerhome.php?pg=expense.php&option=new";
		$viewpage="managerhome.php?pg=expense.php&option=view";
	}
	elseif($_SESSION['usertype']=="clerk")
	{
		$newpage="clerkhome.php?pg=expense.php&option=new";
		$viewpage="clerkhome.php?pg=expense.php&option=view";
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
									 $month=array("Select the month","January","February","March","April","May","June","July","August","September","October","November","December","All Months");//get months in array
								  	for($x=0;$x<=13;$x++)
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
		 $branch_id=$_SESSION['branch_id'];
         $sql3 ="SELECT  branch_name, branch_id FROM branch";
				$result3=mysql_query($sql3) or die ("mysql.error:".mysql_error());
				$row3=mysql_fetch_assoc($result3);
		
		
		$sql= "INSERT INTO expense(expense_id,date,expense_type,amount,remarks,branch_id) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_exp'])."',
						'".mysql_real_escape_string($date)."',
						'".mysql_real_escape_string($_POST['txt_exptype'])."',
						'".mysql_real_escape_string($_POST['txt_amount'])."',
						'".mysql_real_escape_string($_POST['txt_remarks'])."',
						'".mysql_real_escape_string($branch_id)."'
						)";
		
		
		
		
												
				$result=mysql_query($sql) or die("Error in sql ".mysql_error());
					if($result)
						{
							
							 echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
				echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$viewpage.'?pg=expense.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
						}
						else
						{
							echo mysql_error();
						}
	
	}

	
	if(isset($_POST['savechanges']))
	{
		
		$eid=$_POST['txt_exp'];     
		 $branch_id=$_SESSION['branch_id'];
		
		$sql="UPDATE expense SET 
							expense_id='".mysql_real_escape_string($_POST['txt_exp'])."',
							date='".mysql_real_escape_string($_POST['txt_date'])."',
						  expense_type='".mysql_real_escape_string($_POST['txt_exptype'])."',
							amount='".mysql_real_escape_string($_POST['txt_amount'])."',
								remarks='".mysql_real_escape_string($_POST['txt_remarks'])."',
							branch_id='".mysql_real_escape_string($branch_id)."'
							
													
						WHERE expense_id='$eid' ";
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
      <h2><i class="icon-edit"></i>Expense Details </h2>
      
    </div>
  <?php }
  
    else
    {
	?>
		<div class="box-header well" data-original-title>
    <center>  <h2><i class="icon-edit"></i> Elder's Home Expense Details Report</h2></center>
      
    </div>
    
    <?php 
    }?>
    
    
    
    
	<?php
	if(isset($_GET['status']))
	{
		
		$eid=$_GET['eid'];     
		
		 
		 
		//expense view start
		if($_GET['status']=="expenseview")
		{
			$sql1 ="SELECT * FROM expense WHERE expense_id='$eid' ";
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
   <center>   <h3><i class="icon-edit"></i>Elder's Home Expense Individual Details</h3></center>
      
    </div>
  <?php }?>
                    
                 
                    <?php 
					$sql6 ="SELECT * FROM branch WHERE branch_id='$row[branch_id]'";
			$result6=mysql_query($sql6) or die ("mysql.error:".mysql_error());
			$row6=mysql_fetch_assoc($result6);
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
						<tr><td>Expense Id</td><td><?php echo $row['expense_id']; ?></td>
                        <tr><td>Date</td><td><?php echo $row['date']; ?></td>
                        <tr><td>Expense Type</td><td><?php echo $row['expense_type']; ?></td>
                        <tr><td>Amount</td><td><?php echo $row['amount']; ?></td>
                        <tr><td>Remarks</td><td><?php echo $row['remarks']; ?></td>
                        <tr><td>Branch Name</td><td><?php echo $row6['branch_name']; ?></td>
                       
                                               
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
				onclick="window.open('print.php?pr=expense.php&option=view&status=expenseview&eid=<?php echo $row['expense_id']?>','_blank')";
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
		//expense view end
		
		//expense edit start
		elseif($_GET['status']=="expenseedit")
		{
			$sql1 ="SELECT * FROM expense WHERE expense_id='$eid' ";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			
			
			
			?>

<div class="box-content">
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=expenseview&eid=<?php echo $eid; ?>" method="post">
        <fieldset>
        
        <table width="100%">
          <tr><td>
  <div class="control-group">
            <label class="control-label" for="typeahead">Expense ID </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_exp" id="txt_exp" readonly  value="<?php echo $row['expense_id']; ?>" >
              
            </div>
          </div>  
          
           <div class="control-group">
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
      <input type="date" required class="input-xlarge focused" id="txt_date" name="txt_date" value="<?php echo $row['date']; ?>">
            </div>
          </div>
         
           
          <div class="control-group">
								<label class="control-label" for="selectError" id="title_text">Expense Type</label>
								<div class="controls">
								  <select required id="txt_exptype" class="input-xlarge focused" name="txt_exptype" data-rel="chosen">
                                  <option value="<?php echo $row['expense_type']; ?>"><?php echo $row['expense_type']; ?></option>
                                  	<option value="phone bill">phone bill</option>
									<option value="current bill">current bill</option>
									<option value="others">others</option>
								 </select>
                                 
			</div>
  		  </div>
           
                              
               <div class="control-group">
            <label class="control-label" for="typeahead">amount</label>
            <div class="controls">
            <div class="input-prepend input-append ">
              <span class="add-on">Rs</span><input type="text" required class=""  maxlength="5" onkeypress="return isNumberKey(event)" id="txt_amount" name="txt_amount" value="<?php echo $row['amount']; ?>"><span class="add-on">.00</span>
              </div>
            </div>
          </div>
          
         
          
          
                      <div class="control-group">
            <label class="control-label" for="typeahead">Remarks</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_remarks" name="txt_remarks" value="<?php echo $row['remarks']; ?>"  />
              
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="typeahead">Branch Name</label>
            <div class="controls">
          <?php 
					 $branch_id=$_SESSION['branch_id'];
								$sql3="SELECT * FROM branch WHERE branch_id='$branch_id'";
								$result3=mysql_query($sql3);
								$row3=mysql_fetch_assoc($result3);
								$bname=$row3['branch_name'];
							 ?>
    <input type="text" required class="input-xlarge focused" name="txt_itemno" id="txt_itemno" readonly value="<?php echo $bname; ?>" >
                                 
              
            
              
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
			//expense edit end
		
		//expense delete start
		elseif($_GET['status']=="expensedelete")
		{
			$sql2="DELETE FROM expense  WHERE expense_id='$eid' ";
			$result=mysql_query($sql2) or die("Error in mysql :".mysql_error());
			
		}
		//expense delete end
	}
	
	?>
     <?php
	if(isset($_GET['option']))
	{ 
	  
		//new expense entry begin
		if($_GET['option']=="new")
		{
			include ("config.php");
				
			$sql1 ="SELECT expense_id FROM expense ORDER BY expense_id  ASC";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			if(mysql_num_rows($result)>0)
			{
				while($row=mysql_fetch_assoc($result))
				{
					$eid=$row['expense_id'];
				}
				$n=(string)$eid;
				$eid=++$n;
				
			}
			else
			{
				$eid="EX00001";
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
      <h2><i class="icon-edit"></i>Expense Details Form</h2>
      
    </div>
<div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
        
        <table width="100%">
        <tr><td>
  
    <div class="control-group">
            <label class="control-label" for="typeahead">Expense ID </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_exp" id="txt_exp" readonly  value="<?php echo $eid; ?>" >
              
            </div>
          </div>  
          
           <div class="control-group">
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
              <input type="date" required class="input-xlarge focused" id="txt_date" value="" name="txt_date">
            </div>
          </div>
         
           
          <div class="control-group">
								<label class="control-label" for="selectError" id="title_text">Expense Type</label>
								<div class="controls">
								  <select required id="txt_exptype" class="input-xlarge focused" name="txt_exptype" data-rel="chosen">
                                  <option></option>
                                  	<option value="phone bill">phone bill</option>
									<option value="current bill">current bill</option>
									<option value="others">others</option>
								 </select>
                                 
			</div>
  		  </div>
           
                              
               <div class="control-group">
            <label class="control-label" for="typeahead">Amount</label>
            <div class="controls">
            <div class="input-prepend input-append ">
              <span class="add-on">Rs</span><input type="text" required class=""  maxlength="5" onkeypress="return isNumberKey(event)" id="txt_amount" name="txt_amount"><span class="add-on">.00</span>
              </div>
            </div>
          </div
          
         
          
          
                      ><div class="control-group">
            <label class="control-label" for="typeahead">Remarks</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_remarks" name="txt_remarks" value=""  />
              
            </div>
          </div>
          <br>
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
//new expense entry end
//view expense  or search expense  begin
elseif(($_GET['option']=="view"))
        {
	global $eid;
	;
	
?>
<div class="row-fluid sortable">		
		<div class="box span12">
		<div class="box-header well" data-original-title>
        <?php
			if($_SESSION['usertype']=="manager" || $_SESSION['usertype']=="clerk")
			{
				?> 
                <?php
                if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
								
							?>
				<a class="btn btn-primary " href="<?php echo $newpage; ?>"><i class="icon icon-add icon-orange"></i> Add New Expense</a>
                <?php
			}}

			else
			{
				
                if(!(isset($_GET['pr']) || isset($_GET['report'])))
			{
				?>
				<h4><i class="icon-list"></i> Expense Information</h4>
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
							
                            
                            
                            <center><table width="40%"><tr><?php if($month<>"13") { ?><td align="right">Month :</td><td><?php echo $month; ?></td><?php } ?><td align="right">Year :</td><td><?php echo $year; ?></td></tr></table></center>
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
								  <th>Expense Id</th>
								  <th>Date</th>
                                  <th>Expense Type</th>
                                   <th>Branch Name</th>
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
								if($month=="13")
								{
									if($_SESSION['usertype']=="admin")
									{
										$sql2="SELECT * FROM expense Where year(date)='$year'";
									}
									else if($_SESSION['usertype']=="manager"||$_SESSION['usertype']=="clerk")
									{
										$sql2="SELECT * FROM expense WHERE branch_id='$branch_id' AND year(date)='$year'";
									}
								}
								else
								{
									if($_SESSION['usertype']=="admin")
									{
										$sql2="SELECT * FROM expense Where year(date)='$year' AND month(date)='$month'";
									}
									else if($_SESSION['usertype']=="manager"||$_SESSION['usertype']=="clerk")
									{
										$sql2="SELECT * FROM expense WHERE branch_id='$branch_id' AND year(date)='$year' AND month(date)='$month'";
									}
								}
								$result=mysql_query($sql2) or die(mysql_error());
								while($row=mysql_fetch_assoc($result))
								{
		                            
							?>
							<tr><td class="center"><?php echo $row['expense_id']; ?></td><td class="center"><?php echo $row['date']; ?></td><td class="center"><?php echo $row['expense_type']; ?></td><td class="center"><?php 
								$sql6 ="SELECT * FROM branch WHERE branch_id='$row[branch_id]'";
			                   $result6=mysql_query($sql6) or die ("mysql.error:".mysql_error());
			                    $row6=mysql_fetch_assoc($result6);
								$bname=$row6['branch_name'];
							echo $bname; ?></td>
                            <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
                            
                            
                             <td class="center"><a class="btn btn-success" href="<?php echo $viewpage; ?>&status=expenseview&eid=<?php echo $row['expense_id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <?php
                                    if($_SESSION['usertype']=="manager"|| $_SESSION['usertype']=="clerk")
									{ 
										?>
                          <a class="btn btn-info" href="<?php echo $viewpage; ?>&status=expenseedit&eid=<?php echo $row['expense_id']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
						<a class="btn btn-danger" href="<?php echo $viewpage; ?>&status=expensedelete&eid=<?php echo $row['expense_id']; ?>" onclick="return deleteconfirm()">
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
				onclick="window.open('print.php?pr=expense.php&option=view','_blank')";
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
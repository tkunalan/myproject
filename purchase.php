
<?php
	include ("config.php");
	date_default_timezone_set('Asia/Colombo');
$utype=$_SESSION['usertype'];
if(isset($_SESSION['username']) && ($_SESSION['usertype']=='admin' ||$_SESSION['usertype']=='manager' || $_SESSION['usertype']=='clerk'))
{
	if($_SESSION['usertype']=="admin")
	{
		$newpage="adminhome.php?pg=purchase.php&option=new";
		$viewpage="adminhome.php?pg=purchase.php&option=view";
	}
	if($_SESSION['usertype']=="manager")
	{
		$newpage="managerhome.php?pg=purchase.php&option=new";
		$viewpage="managerhome.php?pg=purchase.php&option=view";
	}
	elseif($_SESSION['usertype']=="clerk")
	{
		$newpage="clerkhome.php?pg=purchase.php&option=new";
		$viewpage="clerkhome.php?pg=purchase.php&option=view";
	}
	?>
	
	 <script >
	 function purchasesel() 
	{
	    var f = <?php echo json_encode($utype); ?>;
		var e = document.getElementById("txt_ptype");		
		var purchase = e.options[e.selectedIndex].text;
	    window.location.href = f+"home.php?pg=purchase.php&option=new&st1=" + purchase;
		return false;
		
	}
	 function itemsel() 
	{
	    var f = <?php echo json_encode($utype); ?>;
		var e = document.getElementById("txt_ptype");		
		var purchase = e.options[e.selectedIndex].text;
			var i = document.getElementById("txt_itemno");		
		var itemsel = i.options[i.selectedIndex].text;
	    window.location.href = f+"home.php?pg=purchase.php&option=new&st1=" + purchase+"&it1="+itemsel;
		return false;
		
	}
    </script>
    
    
    <?php
	if(isset($_GET['st1']))
	{
			global $purchaseselect;
			$purchaseselect = $_GET['st1'];
	}
	if(isset($_GET['it1']))
	{
			global $itemselect;
			$itemselect = $_GET['it1'];
	}
	?>

    
  
  
  
  
  
  
   <?php 
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
		global $purchaseselect;
		$date=date("Y-m-d", strtotime($_POST['txt_date']));
		$sql8 ="SELECT *  FROM branch WHERE branch_name='$_POST[txt_branchid]'";
				$result8=mysql_query($sql8) or die ("mysql.error:".mysql_error());
				$row8=mysql_fetch_assoc($result8);
				$barnchid=$row8['branch_id'];
		if($purchaseselect=="Asset")
		{
		$sql2 = "INSERT INTO purchase(purchase_id,branch_id,purchase_date,item_no,no_of_items,unit_price) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_pno'])."',
						'".mysql_real_escape_string($barnchid)."',
						'".mysql_real_escape_string($date)."',
						'".mysql_real_escape_string($_POST['txt_itemno'])."',
						'".mysql_real_escape_string($_POST['txt_noofitems'])."',
						'".mysql_real_escape_string($_POST['txt_unitprice'])."'
						)";
		$result2=mysql_query($sql2) or die("Error in sql2 ".mysql_error());
		$sql1 = "INSERT INTO asset(purchase_id,remarks,asset_type) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_pno'])."',
						'".mysql_real_escape_string($_POST['txt_remarks'])."',
						'".mysql_real_escape_string($_POST['txt_atype'])."'
						)";
		$result1=mysql_query($sql1) or die("Error in sql1 ".mysql_error());
		
		
						
						
						if($result2 && $result1)
						{
							echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
				echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$viewpage.'?pg=purchase.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
						}
						else
						{
							echo mysql_error();
						}
		}
		else if($purchaseselect=="Consumable")
		{
			$sql2 = "INSERT INTO purchase(purchase_id,branch_id,purchase_date,item_no,no_of_items,unit_price) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_pno'])."',
						'".mysql_real_escape_string($barnchid)."',
						'".mysql_real_escape_string($date)."',
						'".mysql_real_escape_string($_POST['txt_itemno'])."',
						'".mysql_real_escape_string($_POST['txt_noofitems'])."',
						'".mysql_real_escape_string($_POST['txt_unitprice'])."'
						)";
		$result2=mysql_query($sql2) or die("Error in sql2 ".mysql_error());
			$sql1 = "INSERT INTO consumable(purchase_id,item_type,expiry_date) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_pno'])."',
						'".mysql_real_escape_string($_POST['txt_itype'])."',
						'".mysql_real_escape_string($_POST['txt_edate'])."'
						)";
		$result1=mysql_query($sql1) or die("Error in sql1 ".mysql_error());
			
		
						
						
						if($result2 && $result1)
						{
							echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
				echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$viewpage.'?pg=purchase.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
						}
						else
						{
							echo mysql_error();
						}
		
		}
	}
	
	if(isset($_POST['savechanges']))
	{
		
		$pid=$_POST['txt_pno'];
		$sql="UPDATE purchase SET 
							purchase_date='".mysql_real_escape_string($_POST['txt_date'])."',
							no_of_items='".mysql_real_escape_string($_POST['txt_noofitems'])."'
							 
						
						WHERE purchase_id='$pid'";
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
      <h2><i class="icon-edit"></i>Purchase Details </h2>
      
    </div>
  <?php }
  
    else
    {
	?>
		<div class="box-header well" data-original-title>
    <center>  <h2><i class="icon-edit"></i> Elder's Home purchase Details Report</h2></center>
      
    </div>
    
    <?php 
    }?>
    
    
    
	<?php
	if(isset($_GET['status']))
	{
		
		 $pid=$_GET['pid'];
		 $pid=$_GET['pid'];
		 
		//purchase view start
		if($_GET['status']=="purchaseview")
		{
			$sql1 ="SELECT * FROM purchase WHERE purchase_id='$pid'";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			
			$sql2 ="SELECT * FROM item WHERE item_no='$row[item_no]'";
			$result2=mysql_query($sql2) or die ("mysql.error:".mysql_error());
			$row2=mysql_fetch_assoc($result2);
			
			$sql6 ="SELECT * FROM branch WHERE branch_id='$row[branch_id]'";
			$result6=mysql_query($sql6) or die ("mysql.error:".mysql_error());
			$row6=mysql_fetch_assoc($result6);
			if($row2['item_type']=="Asset")
			{
				$sql7 ="SELECT * FROM asset WHERE purchase_id='$pid'";
				$result7=mysql_query($sql7) or die ("mysql.error:".mysql_error());
				$row7=mysql_fetch_assoc($result7);
			}
			else if($row2['item_type']=="Consumable")
			{
				$sql7 ="SELECT * FROM consumable WHERE purchase_id='$pid'";
				$result7=mysql_query($sql7) or die ("mysql.error:".mysql_error());
				$row7=mysql_fetch_assoc($result7);
			}
			?>
			<div class="row-fluid sortable">		
				<div class="box span6">
								         <?php
							if((isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
    <div class="box-header well" data-original-title>
   <center>   <h3><i class="icon-edit"></i>Elder's Home purchase individual Details</h3></center>
      
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
						
						<tr><td>Purchase No</td><td><?php echo $row['purchase_id']; ?></td>
                        <tr><td>purchase Date</td><td><?php echo $row['purchase_date']; ?></td>
                         <tr><td>Branch Name</td><td><?php echo $row6['branch_name']; ?></td>
                         <tr><td>Item Name</td><td><?php echo $row2['item_name']; ?></td>
                        <tr><td>Unit Price</td><td><?php echo $row['unit_price']; ?></td>
                        <tr><td>No of Items</td><td><?php echo $row['no_of_items']; ?></td>
                        <?php
				
						if($row2['item_type']=="Asset")
						{
							?>
                        	<tr><td>Remarks</td><td><?php echo $row7['remarks']; ?></td>
                        	<tr><td>Asset Type</td><td><?php echo $row7['asset_type']; ?></td>
                        <?php
						}
						else if($row2['item_type']=="Consumable")
						{
							?>
                        	<tr><td>Item Type</td><td><?php echo $row7['item_type']; ?></td>
                            <tr><td>Expiry Date</td><td><?php echo $row7['expiry_date']; ?></td>                        	
                            <?php
						}
						?>
                        
                        
                        
                        
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
				onclick="window.open('print.php?pr=purchase.php&option=view&status=purchaseview&pid=<?php echo $row['purchase_id']?>','_blank')";
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
		//purchase view end
		
		//purchase edit start
		elseif($_GET['status']=="purchaseedit")
		{
			$sql1 ="SELECT * FROM purchase WHERE purchase_id='$pid'";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			
			$sql2 ="SELECT * FROM item WHERE item_no='$row[item_no]'";
			$result2=mysql_query($sql2) or die ("mysql.error:".mysql_error());
			$row2=mysql_fetch_assoc($result2);
			
			$sql6 ="SELECT * FROM branch WHERE branch_id='$row[branch_id]'";
			$result6=mysql_query($sql6) or die ("mysql.error:".mysql_error());
			$row6=mysql_fetch_assoc($result6);
			if($row2['item_type']=="Asset")
			{
				$sql7 ="SELECT * FROM asset WHERE purchase_id='$pid'";
				$result7=mysql_query($sql7) or die ("mysql.error:".mysql_error());
				$row7=mysql_fetch_assoc($result7);
			}
			else if($row2['item_type']=="Consumable")
			{
				$sql7 ="SELECT * FROM consumable WHERE purchase_id='$pid'";
				$result7=mysql_query($sql7) or die ("mysql.error:".mysql_error());
				$row7=mysql_fetch_assoc($result7);
			}
			?>

<div class="box-content">
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=purchaseview&pid=<?php echo $pid; ?>" method="post">
        <fieldset>
        
        <table width="100%">
          <tr><td>
 <div class="control-group">
          
            <label class="control-label" for="typeahead">Purchase NO</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_pno" id="txt_pno" readonly value="<?php echo $row['purchase_id']; ?>" > 
           </div>
          </div>
          
        
                
        
        
 <div class="control-group">
          
            <label class="control-label" for="typeahead">Purchase Date </label>
            <div class="controls">
        <input type="date" required class="input-xlarge focused" name="txt_date" id="txt_date"  value="<?php echo $row['purchase_date']; ?>" > 
           </div>
          </div>
    


<div class="control-group">
          
            <label class="control-label" for="typeahead">Item Name</label>
            <div class="controls">
        <input type="text" required class="input-xlarge focused" name="txt_itemno" readonly id="txt_itemno" value="<?php echo $row2['item_name']; ?>" > 
           </div>
          </div>
            <div class="control-group">
            <label class="control-label" for="typeahead">Unit Price</label>
            <div class="controls">
            <div class="input-prepend input-append ">
              <span class="add-on">Rs</span><input type="text" required class="input-xlarge focused" readonly id="txt_unitprice" name="txt_unitprice" value="<?php echo $row['unit_price']; ?>"><span class="add-on">.00</span>
              </div>
            </div>
            </div>
            </div>
            
            <div class="control-group">
          
            <label class="control-label" for="typeahead">Number Of Item</label>
            <div class="controls">
        <input type="text" required class="input-xlarge focused" name="txt_noofitems" id="txt_noofitems" value="<?php echo $row['no_of_items']; ?>" > 
           </div>
          </div>
          
          <div class="control-group">
          
            <label class="control-label" for="typeahead">Branch Name</label>
            <div class="controls">
        <input type="text" required class="input-xlarge focused" name="txt_itemno" id="txt_itemno" readonly value="<?php echo $row6['branch_name']; ?>" > 
           </div>
          </div>
            
             <?php
				
						if($row2['item_type']=="Asset")
						{
							?>
                        	<div class="control-group">
          
            <label class="control-label" for="typeahead">Remarks</label>
            <div class="controls">
                            <input type="text" required class="input-xlarge focused" name="txt_remarks" id="txt_remarks" readonly value="<?php echo $row7['remarks']; ?>">
                         </div>
          </div>
                        	<div class="control-group">
          
            <label class="control-label" for="typeahead">Asset Type</label>
            <div class="controls">
                            <input type="text" required class="input-xlarge focused" name="txt_assettype" id="txt_assettype" readonly value="<?php echo $row7['asset_type']; ?>">
                         </div>
          </div>
                        <?php
						}
						else if($row2['item_type']=="Consumable")
						{
							?>
                        	<div class="control-group">
          
            <label class="control-label" for="typeahead">Consumable Item Type</label>
            <div class="controls">
                            <input type="text" required class="input-xlarge focused" name="txt_itemtype" id="txt_itemtype" readonly value="<?php echo $row7['item_type']; ?>">
                         </div>
          </div>
          
          <div class="control-group">
          
            <label class="control-label" for="typeahead">Expiry Date</label>
            <div class="controls">
                            <input type="text" required class="input-xlarge focused" name="txt_expdate" id="txt_expdate"  value="<?php echo $row7['expiry_date']; ?>">
                         </div>
          </div>                       	
                            <?php
						}
						?>
            
            
          
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
			//purchase edit end
		
		//purchase delete start
		elseif($_GET['status']=="purchasedelete")
		{
			$sql2="DELETE FROM item  WHERE purchase_id='$pid'";
			$result=mysql_query($sql2) or die("Error in mysql :".mysql_error());
			
		}
		//purchase delete end
	}
	
	?>
     <?php
	if(isset($_GET['option']))
	{ 
	  global $pid;
		//new purchase entry begin
		if($_GET['option']=="new")
		{
			include ("config.php");
			$sql1 ="SELECT purchase_id FROM purchase ORDER BY purchase_id  ASC";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			if(mysql_num_rows($result)>0)
			{
				while($row=mysql_fetch_assoc($result))
				{
					$pid=$row['purchase_id'];
				}
				$n=(string)$pid;
				$pid=++$n;
				
			}
			else
			{
				$pid="P00001";
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
      <h2><i class="icon-edit"></i>Purchase Details Form</h2>
      
    </div>
<div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
        
        <table width="100%">
        <tr><td>
        
         <div class="control-group">
								<label class="control-label" for="selectError">Purchase Type</label>
								<div class="controls">
								  <select id="txt_ptype" name="txt_ptype" onchange="purchasesel()"data-rel="chosen">
                                  <option></option>
                                  <?php
								  global $purchaseselect;
								  if($purchaseselect=="Asset")
								  {
									  echo "<option selected >Asset</option>";
									echo "<option>Consumable</option>";
								  }
								  else if($purchaseselect=="Consumable")
								  {
									  echo "<option>Asset</option>";
									echo "<option selected>Consumable</option>";
								  }
								  else
								  {
									  echo "<option>Asset</option>";
									echo "<option >Consumable</option>"; 
								  }
								  ?>
									 								                                  
                                    </select>
								</div>
							  </div>
                              
                              
         
  <div class="control-group">
          
            <label class="control-label" for="typeahead">Purchase NO</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" readonly name="txt_pno" id="txt_pno" value="<?php echo $pid;?>" > 
           </div>
          </div>
          
        <div class="control-group">
            <label class="control-label" for="typeahead">Item NO</label>
            <div class="controls">
            
            <?php
			global $purchaseselect;
			global $itemselect;
			echo "<select id='txt_itemno' name='txt_itemno' onchange='itemsel()' data-rel='chosen'>";
                                 echo "<option></option>";
			if($purchaseselect=="Asset")
			{
				$sql4="SELECT * FROM item WHERE item_type='Asset' ";
				$result4=mysql_query($sql4);
				$row4=mysql_fetch_assoc($result4);	
				do
				{
					if($row4['item_name']==$itemselect)
			 		{
						echo "<option selected value=".$row4['item_no'].">".$row4['item_name']."</option>"; 
					 }
					 else
					 {
						echo "<option value=".$row4['item_no'].">".$row4['item_name']."</option>";
					 }
				}
				while($row4=mysql_fetch_assoc($result4));
			}
			if($purchaseselect=="Consumable")
			{
				$sql4="SELECT * FROM item WHERE item_type='Consumable' ";
				$result4=mysql_query($sql4);
				$row4=mysql_fetch_assoc($result4);
				do
				{
					if($row4['item_name']==$itemselect)
			 		{
						echo "<option selected value=".$row4['item_no'].">".$row4['item_name']."</option>"; 
					 }
					 else
					 {
						echo "<option value=".$row4['item_no'].">".$row4['item_name']."</option>";
					 }
				}
				while($row4=mysql_fetch_assoc($result4));
			}			
			?>
            </select>
           </div>
          </div>
                 
        
        
 <div class="control-group">
          
            <label class="control-label" for="typeahead">Purchase Date </label>
            <div class="controls">
              <input type="date" required class="input-xlarge focused" name="txt_date" id="txt_date" value="" > 
           </div>
          </div>
    



            <div class="control-group">
            <label class="control-label" for="typeahead">Unit Price</label>
            <div class="controls">
            <div class="input-prepend input-append ">
              <span class="add-on">Rs</span><input type="text" required class="" id="txt_unitprice" name="txt_unitprice"><span class="add-on">.00</span>
              </div>
            </div><br>
            

        <div class="control-group">
          
            <label class="control-label" for="typeahead">Branch Name</label>
            <div class="controls">
              <?php
					$branch_id=$_SESSION['branch_id'];
					$sql4 ="SELECT *  FROM branch WHERE branch_id='$branch_id'";
				$result4=mysql_query($sql4) or die ("mysql.error:".mysql_error());
				$row4=mysql_fetch_assoc($result4);
					?>
	 <input type="text" name="txt_branchid" class="input-xlarge focus" id="txt_branchid" readonly value="<?php echo $row4['branch_name'];?>"> 
           </div>
          </div>
          
          <div class="control-group">
          
            <label class="control-label" for="typeahead">No Of Items</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_noofitems" id="txt_noofitems" value="" > 
           </div>
          </div>
          <?php
		  
			  global $purchaseselect;
			  if($purchaseselect=="Asset")
			   {
				   ?>
         <h3> ASSET</h3>
  <label class="control-label" for="typeahead">Remarks</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_remarks" id="txt_remarks" value="" > 
           </div>
          </div>
          <label class="control-label" for="typeahead">Asset Type</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_atype" id="txt_atype" value="" > 
           </div>
          </div>
          <?php
			   }
			   
		//global $purchaseselect;
		  else if($purchaseselect=="Consumable")
		  {
			  ?>
    <h3> consumable</h3>
  <label class="control-label" for="typeahead">Item type</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_itype" id="txt_itype" value="" > 
           </div>
          </div><br>
          
          <label class="control-label" for="typeahead">Expiry Date</label>
            <div class="controls">
 <input type="date" required class="input-xlarge focused" name="txt_edate" id="txt_edate" value="" >           
          </div>
          </div>
<?php
		  }
		  ?>
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
//new purchase entry end
//view branch or search branch begin
elseif(($_GET['option']=="view"))
        {
	global $tid;
	
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
				<a class="btn btn-primary " href="<?php echo $newpage; ?>"><i class="icon icon-add icon-orange"></i> Add New Purchase</a>
                <?php
			
			}
			else
			{
				?>
				<h4><i class="icon-list"></i> Purchase Information</h4>
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
								  <th>Purchase No</th>
								  <th>Purchase Date</th>
								  <th>Item Name</th>
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
								if($_SESSION['usertype']=="admin")
								{
									$sql2="SELECT * FROM purchase WHERE month(purchase_date)='$month' AND year(purchase_date)='$year'";
								}
								else if($_SESSION['usertype']=="manager" || $_SESSION['usertype']=="clerk")
								{
									
									$sql2="SELECT * FROM purchase WHERE branch_id='$branch_id' AND month(purchase_date)='$month' AND year(purchase_date)='$year'";
								}
								$result=mysql_query($sql2) or die(mysql_error());
								while($row=mysql_fetch_assoc($result))
								{
									$branch_id=$row['branch_id'];
									$sql5 ="SELECT * FROM item WHERE item_no='$row[item_no]'";
									$result5=mysql_query($sql5) or die ("mysql.error:".mysql_error());
									$row5=mysql_fetch_assoc($result5);
									
							?>
							<tr><td class="center"><?php echo $row['purchase_id']; ?></td><td class="center"><?php echo $row['purchase_date']; ?></td><td class="center"><?php echo $row5['item_name']; ?></td><td class="center"><?php 
								$sql3="SELECT * FROM branch WHERE branch_id='$branch_id'";
								$result3=mysql_query($sql3);
								$row3=mysql_fetch_assoc($result3);
								$bname=$row3['branch_name'];
							echo $bname; ?></td>
                              <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
                            <td class="center"><a class="btn btn-success" 
                            href="<?php echo $viewpage; ?>&status=purchaseview&pid=<?php echo $row['purchase_id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <?php
                                    if($_SESSION['usertype']=="manager" || $_SESSION['usertype']=="clerk")
									{ 
										?>
                          <a class="btn btn-info" href="<?php echo $viewpage; ?>&status=purchaseedit&pid=<?php echo $row['purchase_id']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
						<a class="btn btn-danger" href="<?php echo $viewpage; ?>&status=purchasedelete&pid=<?php echo $row['purchase_id']; ?>" onclick="return deleteconfirm()">
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
				onclick="window.open('print.php?pr=purchase.php&option=view','_blank')";
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
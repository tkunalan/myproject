<?php
	
	include ("config.php");
		date_default_timezone_set('Asia/Colombo');
$utype=$_SESSION['usertype'];
if(isset($_SESSION['username']) && ($_SESSION['usertype']=='admin' || $_SESSION['usertype']=='manager'))
{

	if($_SESSION['usertype']=="admin")
	{
		//$newpage="adminhome.php?pg=supply.php&option=new";
		$viewpage="adminhome.php?pg=supply.php&option=view";
	}
	elseif($_SESSION['usertype']=="manager")
	{
		$newpage="managerhome.php?pg=supply.php&option=new";
		$viewpage="managerhome.php?pg=supply.php&option=view";
	}
	
	
	?>
      <script >
	 function supplysel() 
	{
	    var f = <?php echo json_encode($utype); ?>;
		var e = document.getElementById("txt_ptype");		
		var purchase = e.options[e.selectedIndex].text;
	    window.location.href = f+"home.php?pg=supply.php&option=new&st1=" + purchase;
		return false;
		
	}
	
	
	 function itemsel() 
	{
	    var f = <?php echo json_encode($utype); ?>;
		var e = document.getElementById("txt_ptype");		
		var purchase = e.options[e.selectedIndex].text;
			var i = document.getElementById("txt_itemno");		
		var itemsel = i.options[i.selectedIndex].text;
	    window.location.href = f+"home.php?pg=supply.php&option=new&st1=" + purchase+"&it1="+itemsel;
		return false;
		
	}
	 function purchasesel() 
	{
	    var f = <?php echo json_encode($utype); ?>;
		var e = document.getElementById("txt_ptype");		
		var purchase = e.options[e.selectedIndex].text;
			var i = document.getElementById("txt_itemno");		
		var itemsel = i.options[i.selectedIndex].text;
		var j = document.getElementById("txt_purchaseid");		
		var purchaseid = j.options[j.selectedIndex].text;
	    window.location.href = f+"home.php?pg=supply.php&option=new&st1=" + purchase+"&it1="+itemsel+"&pid="+purchaseid;
		return false;
		
	}
	 function homesel() 
	{
	    var f = <?php echo json_encode($utype); ?>;
		var e = document.getElementById("txt_ptype");		
		var purchase = e.options[e.selectedIndex].text;
			var i = document.getElementById("txt_itemno");		
		var itemsel = i.options[i.selectedIndex].text;
		var j = document.getElementById("txt_purchaseid");		
		var purchaseid = j.options[j.selectedIndex].text;
		var k = document.getElementById("txt_homeno");		
		var homesel = k.options[k.selectedIndex].text;
	    window.location.href = f+"home.php?pg=supply.php&option=new&st1=" + purchase+"&it1="+itemsel+"&pid="+purchaseid+"&hid="+homesel;
		return false;
		
	}
	
	</script>
    <?php
	if(isset($_GET['st1']))
	{
			global $supplyselect;
			$supplyselect = $_GET['st1'];
	}
	
	
	if(isset($_GET['it1']))
	{
			global $itemselect;
			$itemselect = $_GET['it1'];
	}
	if(isset($_GET['pid']))
	{
			global $purchaseselect;
			$purchaseselect = $_GET['pid'];
	}
	if(isset($_GET['hid']))
	{
			global $homeselect;
			$homeselect = $_GET['hid'];
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
		$date=date("Y-m-d", strtotime($_POST['txt_date']));
		$uid=$_POST['txt_userid'];
		$pid=$_POST['txt_purchaseid'];
		$noitem=$_POST['txt_noofitems'];
			 $sql4="SELECT * FROM purchase WHERE purchase_id='$pid' ";
				$result4=mysql_query($sql4);
				$row4=mysql_fetch_assoc($result4);
									
			if($row4['no_of_items']<$noitem)
			{
				echo "<script> alert('please change the number of item');</script>";
			}
			else
			{
									$sql5="SELECT *  FROM staff WHERE name='$uid' ";
				                     $result5=mysql_query($sql5) or die ("mysql.error:".mysql_error());
          		                         $row5=mysql_fetch_assoc($result5);
		
					$sql= "INSERT INTO supply(supply_id,purchase_id,user_id,date,no_of_items,home_no,ward_no) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_supplyid'])."',
						'".mysql_real_escape_string($_POST['txt_purchaseid'])."',
						'".mysql_real_escape_string($row5['user_id'])."',
						'".mysql_real_escape_string($date)."',
						'".mysql_real_escape_string($_POST['txt_noofitems'])."',
						'".mysql_real_escape_string($_POST['txt_homeno'])."',
						'".mysql_real_escape_string($_POST['txt_wardno'])."'
						)";
						
						$noitem=$_POST['txt_noofitems'];
					 $sql4="SELECT * FROM purchase WHERE purchase_id='$pid' ";
				$result4=mysql_query($sql4);
				$row4=mysql_fetch_assoc($result4);
					$row4['no_of_items']=$row4['no_of_items']-$noitem;
						
		$sql1="UPDATE purchase SET
		                    
						    no_of_items='$row4[no_of_items]'						
													
						WHERE purchase_id='$_POST[txt_purchaseid]'";
			
			
			$result1=mysql_query($sql1);
		
												
				$result=mysql_query($sql) or die("Error in sql ".mysql_error());
					if($result && $result1)
						{
							
								echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
				echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$viewpage.'?pg=supply.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
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
		
		$sid=$_POST['txt_supplyid'];
		$uid=$_POST['txt_userid'];
		//$noitem=$_POST['txt_noofitems'];
		$sql5="SELECT *  FROM staff WHERE name='$uid' ";
				                     $result5=mysql_query($sql5) or die ("mysql.error:".mysql_error());
          		                         $row5=mysql_fetch_assoc($result5);
		
		$sql="UPDATE supply SET 
							supply_id='".mysql_real_escape_string($_POST['txt_supplyid'])."',
							purchase_id='".mysql_real_escape_string($_POST['txt_purchaseid'])."',
							user_id='".mysql_real_escape_string($row5['user_id'])."',
							date='".mysql_real_escape_string($_POST['txt_date'])."',
							no_of_items='".mysql_real_escape_string($_POST['txt_noofitems'])."',
							home_no='".mysql_real_escape_string($_POST['txt_homeno'])."',
							ward_no='".mysql_real_escape_string($_POST['txt_wardno'])."'
							 
						
						WHERE supply_id='$sid'";
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
      <h2><i class="icon-edit"></i>supply Details </h2>
      
    </div>
  <?php }
  
    else
    {
	?>
		<div class="box-header well" data-original-title>
    <center>  <h2><i class="icon-edit"></i> Elder's Home supply Details Report</h2></center>
      
    </div>
    
    <?php 
    }?>
    
    
    
    
	<?php
	if(isset($_GET['status']))
	{
		
		 $sid=$_GET['sid'];
		 
		 
		//sponsor view start
		if($_GET['status']=="supplyview")
		{
			$sql1 ="SELECT * FROM supply WHERE supply_id='$sid'";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			$sql5="SELECT *  FROM staff WHERE user_id='$row[user_id]' ";
				                     $result5=mysql_query($sql5) or die ("mysql.error:".mysql_error());
          		                         $row5=mysql_fetch_assoc($result5);
			?>
			<div class="row-fluid sortable">		
				<div class="box span6">
											         <?php
							if((isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
    <div class="box-header well" data-original-title>
   <center>   <h3><i class="icon-edit"></i>Elder's Home supply individual Details</h3></center>
      
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
						
						<tr><td>Supply Id</td><td><?php echo $row['supply_id']; ?></td>
                        <tr><td>purchase Name</td><td><?php echo $row['purchase_id']; ?></td>
                        <tr><td>Staff Name</td><td><?php echo $row5['name']; ?></td>
                        <tr><td>Date</td><td><?php echo $row['date']; ?></td>
                        <tr><td>No Of Items</td><td><?php echo $row['no_of_items']; ?></td>
                        <tr><td>Home No</td><td><?php echo $row['home_no']; ?></td>
                        <tr><td>Ward No</td><td><?php echo $row['ward_no']; ?></td>
                        
                        
                        
                        
                        
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
				onclick="window.open('print.php?pr=supply.php&option=view&status=supplyview&sid=<?php echo $row['supply_id']?>','_blank')";
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
		//supply view end
		
		//supply edit start
		elseif($_GET['status']=="supplyedit")
		{
			$sql1 ="SELECT * FROM supply WHERE supply_id='$sid'";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			$row=mysql_fetch_assoc($result);
			
			$sql5="SELECT *  FROM staff WHERE user_id='$row[user_id]' ";
				                     $result5=mysql_query($sql5) or die ("mysql.error:".mysql_error());
          		                         $row5=mysql_fetch_assoc($result5);
			
			?>

<div class="box-content">
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=supplyview&sid=<?php echo $sid; ?>" method="post">
        <fieldset>
        
        <table width="100%">
          <tr><td>
 <div class="control-group">
            <label class="control-label" for="typeahead">Supply Id </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_supplyid" id="txt_supplyid"   value="<?php echo $row['supply_id']; ?>" >
              
            </div>
          </div>  
          
         
         
         
                              
                              <div class="control-group">
            <label class="control-label" for="typeahead">Purchase Name </label>
            <div class="controls">
           <input type="text" required class="input-xlarge focused" name="txt_purchaseid" id="txt_purchaseid"   value="<?php echo $row['purchase_id']; ?>" >
              
            </div>
          </div>
      		  
              				          <div class="control-group">
            <label class="control-label" for="typeahead">Staff Name</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_userid" name="txt_userid" readonly value="<?php echo $row5['name']; ?>">
            
              
            </div>
          </div>
           <div class="control-group">
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
              <input type="date" required class="input-xlarge focused" id="txt_date" value="<?php echo $row['date']; ?>" name="txt_date">
            </div>
          </div>
         
          <div class="control-group">
          
            <label class="control-label" for="typeahead">No Of Items</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_noofitems" id="txt_noofitems" value="<?php echo $row['no_of_items']; ?>" > 
           </div>
          </div>
          
            <div class="control-group">
            <label class="control-label" for="typeahead">Home NO</label>
            <div class="controls">
              <input type="tel" required class="input-xlarge focused" id="txt_homeno" name="txt_homeno"  value="<?php echo $row['home_no']; ?>"/>
              
            </div>
          </div>
        
          
          
          
            
          <div class="control-group">
            <label class="control-label" for="typeahead">Ward No </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_wardno" name="txt_wardno" value="<?php echo $row['ward_no']; ?>" />
              
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
			//supply edit end
		
		//supply delete start
		elseif($_GET['status']=="supplydelete")
		{
				$sql5="SELECT * FROM supply WHERE supply_id='$sid' ";
				$result5=mysql_query($sql5);
				$row5=mysql_fetch_assoc($result5);
				$sql4="SELECT * FROM purchase WHERE purchase_id='$row5[purchase_id]' ";
				$result4=mysql_query($sql4);
				$row4=mysql_fetch_assoc($result4);
					$row4['no_of_items']=$row4['no_of_items']+$row5['no_of_items'];
						
		$sql1="UPDATE purchase SET
		                    
						    no_of_items='$row4[no_of_items]'						
													
						WHERE purchase_id='$row5[purchase_id]'";
			
			
			$result1=mysql_query($sql1);
			$sql2="DELETE FROM supply  WHERE supply_id='$sid'";
			$result=mysql_query($sql2) or die("Error in mysql :".mysql_error());
			
		}
		//supply delete end
	}
	
	?>
     <?php
	if(isset($_GET['option']))
	{ 
	  
		//new sponsor entry begin
		if($_GET['option']=="new")
		{
			
			include ("config.php");
			$sql1 ="SELECT supply_id FROM supply ORDER BY supply_id  ASC";
			$result=mysql_query($sql1) or die ("mysql.error:".mysql_error());
			if(mysql_num_rows($result)>0)
			{
				while($row=mysql_fetch_assoc($result))
				{
					$sid=$row['supply_id'];
				}
				$n=(string)$sid;
				$sid=++$n;
				
			}
			else
			{
				$sid="SI00001";
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
      <h2><i class="icon-edit"></i>Supply Details Form</h2>
      
    </div>
<div class="box-content">
      <form class="form-horizontal" action="" method="post">
        <fieldset>
        
        <table width="100%">
        <tr><td>
  
    <div class="control-group">
            <label class="control-label" for="typeahead">Supply Id </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_supplyid" id="txt_supplyid"   value="<?php echo $sid;?>">
			  </div>
          </div>  
          
          
           <div class="control-group">
								<label class="control-label" for="selectError">Supply Type</label>
								<div class="controls">
								  <select id="txt_ptype" name="txt_ptype" onchange="supplysel()"data-rel="chosen">
                                  <option></option>
                                  <?php
								  global $supplyselect;
								  if($supplyselect=="Asset")
								  {
									  echo "<option selected >Asset</option>";
									echo "<option>Consumable</option>";
								  }
								  else if($supplyselect=="Consumable")
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
            <label class="control-label" for="typeahead">Item Name</label>
            <div class="controls">
            
            <?php
			global $supplyselect;
			global $itemselect;
			echo "<select id='txt_itemno' name='txt_itemno' onchange='itemsel()' data-rel='chosen'>";
                                 echo "<option></option>";
			if($supplyselect=="Asset")
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
			if($supplyselect=="Consumable")
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
            <label class="control-label" for="typeahead">Purchase ID </label>
            <div class="controls">
           <?php
		   $branch_id=$_SESSION['branch_id'];
			global $supplyselect;
			global $itemselect;
			global $purchaseselect;
			echo "<select id='txt_purchaseid' name='txt_purchaseid' onchange='purchasesel()' data-rel='chosen'>";
                                 echo "<option></option>";
				$sql5="SELECT * FROM item WHERE item_name='$itemselect' ";
				$result5=mysql_query($sql5);
				$row5=mysql_fetch_assoc($result5);
				
           $sql4="SELECT * FROM purchase WHERE item_no='$row5[item_no]' AND no_of_items!='0' AND branch_id='$branch_id' ";
				$result4=mysql_query($sql4);
				$row4=mysql_fetch_assoc($result4);	
				do
				{
					if($row4['purchase_id']==$purchaseselect)
			 		{
						echo "<option selected value=".$row4['purchase_id'].">".$row4['purchase_id']."</option>"; 
					 }
					 else
					 {
						echo "<option value=".$row4['purchase_id'].">".$row4['purchase_id']."</option>";
					 }
				}
				while($row4=mysql_fetch_assoc($result4));
				echo "</select>";
              ?>
            </div>
          </div>
          <?php
		  $name=$_SESSION['username'];
		  $sql5="SELECT *  FROM staff WHERE user_id='$name' ";
		$result5=mysql_query($sql5) or die ("mysql.error:".mysql_error());
      $row5=mysql_fetch_assoc($result5);
		  
		  ?>
      		  
              				          <div class="control-group">
            <label class="control-label" for="typeahead">Staff Name</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_userid" name="txt_userid" readonly value="<?php echo $row5['name']; ?>">
            
              
            </div>
          </div>
           <div class="control-group">
            <label class="control-label" for="typeahead">Home NO</label>
            <div class="controls">
                 <?php
			global $supplyselect;
			global $itemselect;
			global $purchaseselect;
			global $homeselect;
			echo "<select id='txt_homeno' name='txt_homeno' onchange='homesel()' data-rel='chosen'>";
                                 echo "<option></option>";
								 $branch_id=$_SESSION['branch_id'];
				
				
           $sql4="SELECT DISTINCT home_no FROM ward WHERE branch_id='$branch_id' ";
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
				
				
           $sql4="SELECT DISTINCT ward_no FROM ward WHERE branch_id='$branch_id' AND home_no='$homeselect' AND no_of_beds!='0' ";
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
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
              <input type="date" required class="input-xlarge focused" id="txt_date" value="" name="txt_date">
            </div>
          </div>
         
          <div class="control-group">
          
            <label class="control-label" for="typeahead">No Of Items</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_noofitems"  id="txt_noofitems" value="" > 
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
//new supply entry end
//view supply or search supply begin
elseif(($_GET['option']=="view"))
        {
	global $sid;
	
?>
<div class="row-fluid sortable">		
		<div class="box span12">
		<div class="box-header well" data-original-title>
        <?php
			if($_SESSION['usertype']=="manager")
			{
				?>
                 <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
								
							?>
				<a class="btn btn-primary " href="<?php echo $newpage; ?>"><i class="icon icon-add icon-orange"></i> Add New Supply</a>
                <?php
			}}
			else
			{
				if(!(isset($_GET['pr']) || isset($_GET['report'])))
			{
				?>
                
               
							
				<h4><i class="icon-user"></i> Supply Information</h4>
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
								  <th>Supply ID</th>
								  <th>Purchase ID</th>
                                  <th>Staff Name</th>
                                  <th>Home No</th>
                                  <th>Ward No</th>
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
								$name=$_SESSION['username'];
								if($_SESSION['usertype']=="admin")
								{
									$sdate=$year."-".$month."-1";
									$sdate=date("Y-m-d",strtotime($sdate));
									$edate=$year."-".$month."-31";
									$edate=date("Y-m-d",strtotime($edate));
									
									$sql2="SELECT * FROM supply  Where month(date)='$month' AND year(date)='$year'";
								}
								else if($_SESSION['usertype']=="manager")
								{
									$sdate=$year."-".$month."-1";
									$sdate=date("Y-m-d",strtotime($sdate));
									$edate=$year."-".$month."-31";
									$edate=date("Y-m-d",strtotime($edate));
									$sql2="SELECT * FROM supply WHERE user_id='$name' AND month(date)='$month' AND year(date)='$year' ";
								}
								
								$result=mysqli_query($connection,$sql2);
								while($row=mysqli_fetch_assoc($result))
								{
									$sid=$row['supply_id'];
									$sql5="SELECT *  FROM staff WHERE user_id='$row[user_id]' ";
				                     $result5=mysqli_query($connection,$sql5) or die ("mysql.error:".mysqli_error());
          		                         $row5=mysqli_fetch_assoc($result5);
		                            
							?>
							<tr><td class="center"><?php echo $row['supply_id']; ?></td><td class="center"><?php echo $row['purchase_id']; ?></td><td class="center"><?php echo $row5['name']; ?></td><td class="center"><?php echo $row['home_no']; ?></td><td class="center"><?php echo $row['ward_no']; ?></td><td class="center"><?php echo $row['date']; ?></td>
                               <?php
							if(!(isset($_GET['pr']) || isset($_GET['report'])))
							{
							?>
                            
                            <td class="center"><a class="btn btn-success" 
                            href="<?php echo $viewpage; ?>&status=supplyview&sid=<?php echo $row['supply_id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <?php
                                    if($_SESSION['usertype']=="manager")
									{ 
										?>
                          <a class="btn btn-info" href="<?php echo $viewpage; ?>&status=supplyedit&sid=<?php echo $row['supply_id']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
						<a class="btn btn-danger" href="<?php echo $viewpage; ?>&status=supplydelete&sid=<?php echo $row['supply_id']; ?>" onclick="return deleteconfirm()">
										<i class="icon-trash icon-white"></i> 
										Delete
									</a>
                                    <?php
                                    }
									?>
                                    </td>
                                    <?php }?></tr>
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
				onclick="window.open('print.php?pr=supply.php&option=view','_blank')";
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
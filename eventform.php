<?php
date_default_timezone_set('Asia/Colombo');
include ("config.php");
$utype=$_SESSION['usertype'];
?>
<!--number only-->

<SCRIPT language=Javascript>
       <!--
       function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
       //-->
    </SCRIPT>
	
<!--phone number-->	
	
	<script>
       function isTextKey(evt)
       {
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if (((charCode >64 && charCode < 91)||(charCode >96 && charCode < 123)||charCode ==08 || charCode ==127||charCode ==32||charCode ==46)&&(!(evt.ctrlKey&&(charCode==118||charCode==86))))
             return true;
			
          return false;
       }
</script>

   <script >
	 function branchsel() 
	{
	    var f = <?php echo json_encode($utype); ?>;
		var e = document.getElementById("txt_branchid");		
		var branchname = e.options[e.selectedIndex].text;
	    window.location.href = f+"home.php?pg=eventform.php&option=new&st1=" + branchname;
		return false;
		
	}
	
	 function eventsel() 
	{
	   var f = <?php echo json_encode($utype); ?>;
	    var w = document.getElementById("txt_eventtype");		
		var eventse = w.options[w.selectedIndex].text;
		var e = document.getElementById("txt_branchid");		
		var branchname = e.options[e.selectedIndex].text;
	     window.location.href = f+"home.php?pg=eventform.php&option=new&st1=" + branchname+"&ht1="+eventse;
		return false;
		
	}
	
	 function eventdatesel() 
	{
	   var f = <?php echo json_encode($utype); ?>;
	    var w = document.getElementById("txt_eventtype");		
		var eventse = w.options[w.selectedIndex].text;
		var e = document.getElementById("txt_branchid");		
		var branchname = e.options[e.selectedIndex].text;
		var t = document.getElementById("txt_evtdate");
		var d=frmevent.txt_evtdate.value
		//var d = t.toString();
		//var d = new Date(t);
	     window.location.href = f+"home.php?pg=eventform.php&option=new&st1=" + branchname+"&ht1="+eventse+"&wt1="+d;
		return false;
		
	}
	</script>



<?php
date_default_timezone_set('Asia/Colombo');
include ("config.php");
if(isset($_GET['st1']))
	{
			global $branchselect;
			$branchselect = $_GET['st1'];
	}
	if(isset($_GET['ht1']))
	{
			global $eventselect;
			$eventselect = $_GET['ht1'];
	}
	if(isset($_GET['wt1']))
	{
			global $dateselect;
			global $eventselect;
			global $branchselect;
			$datesel = $_GET['wt1'];
			$dateselect=date("Y-m-d",strtotime($datesel));
			$sql6="SELECT *  FROM branch WHERE branch_name='$branchselect' ";
			$result6=mysqli_query($connection,$sql6) or die ("mysqli.error:".mysqli_error());
          	$row6=mysqli_fetch_assoc($result6);
			if($eventselect=="Function")
			{
				$sql5="SELECT *  FROM event WHERE branch_id='$row6[branch_id]' AND date='$dateselect' AND event_type='Function'";
				$result5=mysqli_query($connection,$sql5) or die ("mysqli.error:".mysqli_error());
          		$row5=mysqli_fetch_assoc($result5);
				if(mysqli_num_rows($result5)==0)
				{
					
				}
				else
				{
					echo "<script> alert('please select another date because this day already booked');</script>";
					$dateselect ="";
				}
			}
			
	}
if(isset($_POST['save']))
	{
		$date=date("Y-m-d", strtotime($_POST['txt_evtdate']));
		$user_id=$_POST['txt_userid'];
				$sql5="SELECT *  FROM sponsor WHERE name='$user_id'";
				$result5=mysqli_query($connection,$sql5) or die ("mysqli.error:".mysqli_error());
          		$row5=mysqli_fetch_assoc($result5);
		
		$sql= "INSERT INTO event(event_id,user_id,branch_id,event_type,date,event,remarks) 
						VALUES(
						'".mysqli_real_escape_string($connection,$_POST['txt_eventid'])."',
						'".mysqli_real_escape_string($connection,$row5['user_id'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_branchid'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_eventtype'])."',
						'".mysqli_real_escape_string($connection,$date)."',
						'".mysqli_real_escape_string($connection,$_POST['txt_event'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_remarks'])."'
						)";
		
	
		
												
				$result=mysql_query($sql) or die("Error in sql ".mysql_error());
					if($result)
						{
							
							echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
			echo '<p align="center">&lt;&lt;&lt;&lt; <a href="sponsorhome.php?pg=eventform.php&option=new">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
							
						}
						else
						{
							echo mysql_error();
							
						}
	
	}


?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Elders home</title>
</head>
<div class="row-fluid sortable">
<div class="box span12">
<div class="box-header well" data-original-title>
<h4><i class=""></i> Event Registration Form</h4>
</div>
<body>
<?php
if($_GET['option']=="new")
		{
			include ("config.php");
			$sql1 ="SELECT event_id FROM event ORDER BY event_id ASC";
			$result=mysqli_query($connection,$sql1) or die ("mysqli.error:".mysqli_error());
			if(mysqli_num_rows($result)>0)
			{
				while($row=mysqli_fetch_assoc($result))
				{
					$e_No=$row['event_id'];
				}
				$n=(string)$e_No;
				$e_No=++$n;
			}
			else
			{
				$e_No="E001";
			}


?>


 <div class="box-content">
      <form class="form-horizontal" action="" method="post" name="frmevent">
        <fieldset>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Event ID </label>
            <div class="controls">
            <input type="text" required class="input-xlarge focused" name="txt_eventid" id="txt_eventid"  readonly value="<?php echo $e_No;?>" >
              
            </div>
          </div>  
           <?php
		   
		  
		  $name=$_SESSION['username'];
      		  $sql2 ="SELECT *FROM sponsor WHERE user_id='$name'";
				$result2=mysqli_query($connection,$sql2) or die ("mysqli.error:".mysqli_error());
				$row2=mysqli_fetch_assoc($result2);
				$name=$row2['name'];
              
              ?>
         
                              
                              <div class="control-group">
            <label class="control-label" for="typeahead">Sponsor Name </label>
            <div class="controls">
          
       <input type="text" required class="input-xlarge focused" id="txt_userid" readonly name="txt_userid" value="<?php echo $name;?>"  >
            </div>
          </div>
          <?php
		  
		 // $branch_id=$_SESSION['branch_id'];
      		  $sql3 ="SELECT  branch_name, branch_id FROM branch";
				$result3=mysqli_query($connection,$sql3) or die ("mysqli.error:".mysqli_error());
				$row3=mysqli_fetch_assoc($result3);
				//$barnchid=$row2['branch_id'];
              
              ?>
              
              
              				          <div class="control-group">
            <label class="control-label" for="typeahead">Branch Name</label>
            <div class="controls">
              
              
								<?php
								global $branchselect;
								echo "<select required name='txt_branchid' onchange='branchsel()' id='txt_branchid'  data-rel='chosen'>";
                               echo "<option></option> ";
							   
								
									do
									{
										if($row3['branch_name']==$branchselect)
										 	{
												echo "<option selected value=".$row3['branch_id'].">".$row3['branch_name']."</option>"; 
											 }
											 else
											 {
												 if ($row3['branch_name']=='Kaithady'||$row3['branch_name']=='Vavuniya' )
												 {
												echo "<option value=".$row3['branch_id'].">".$row3['branch_name']."</option>";
												 }
												 else
												 {
													 echo "<option disabled  value=".$row3['branch_id'].">".$row3['branch_name']."</option>";
												 }
												
											 }
									}
									while($row3=mysql_fetch_assoc($result3));
									?>											
								 </select>
                                 
              
            
              
            </div>
          </div>
         
          <div class="control-group">
								<label class="control-label" for="selectError">Event Type</label>
								<div class="controls">
								  
                                  <?php
								global $eventselect;
								echo "<select id='txt_eventtype' name='txt_eventtype' onchange='eventsel()' data-rel='chosen'>";
                                 echo "<option></option>";
								 
							   
								if($eventselect=="Fund or Things")
								{
									echo "<option selected value='Fund or Things'>Fund or Things</option>";
									echo "<option value='Function'>Function</option>";
								}
								else if($eventselect=="Function")
								{
									echo "<option  value='Fund or Things'>Fund or Things</option>";
									echo "<option selected value='Function'>Function</option>";
								}
								else
								{
									echo "<option  value='Fund or Things'>Fund or Things</option>";
									echo "<option  value='Function'>Function</option>";
								}
									
									?>	 								                                 
                                    </select>
								</div>
							  </div>
          
            
        
          
          
          
             <div class="control-group">
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
            <?php 
			global $dateselect;
			?>
              <input type="date"  class="input-xlarge focused" id="txt_evtdate" name="txt_evtdate" onblur="eventdatesel()" value="<?php 
			   echo $dateselect; ?>" >
            </div>
          </div>
         
            
          
    <div class="control-group">
            <label class="control-label" for="typeahead">Event</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_event" name="txt_event" value=""  >
              
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="typeahead">Remarks</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_remarks" name="txt_remarks"  value=""  >
              
            </div>
          </div>
				     
              
          			
            <div class="form-actions">
            <button type="submit" class="btn btn-primary" name="save" id="save">Save </button>
           
            <button type="reset" class="btn btn-danger" name="save" id="save" value="Reset">Reset</button>
        </div>
        
        </fieldset>

      </form>
      
   

   
      <?php
		}
		?>

   	
  </div>
   </div>

</body>
</html>
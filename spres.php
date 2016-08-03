<!--number only-->

<SCRIPT language="Javascript">
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
	
	<script language="Javascript">
       function isTextKey(evt)
       {
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if (((charCode >64 && charCode < 91)||(charCode >96 && charCode < 123)||charCode ==08 || charCode ==127||charCode ==32||charCode ==46)&&(!(evt.ctrlKey&&(charCode==118||charCode==86))))
             return true;
			
          return false;
       }
</script>

<script language="Javascript">
// function for password
function password()
{
	var str = document.getElementById("txt_pass").value;
	var res = str.length; 
	if(res>6)
	{
		return true;
	}
	else
	{
			alert("enter more than 6 character password");
			document.getElementById("txt_pass").value="";		
			return false;
	}
	
}
</script>



<?php
date_default_timezone_set('Asia/Colombo');
include ("config.php");
if(isset($_POST['save']))
	{
		//file upload start
		/*echo '<script>alert("Successfully added your details");</script>';*/
		
			if(file_exists("upload/".$_FILES["img_photo"]["name"]))
			{
				echo $_FILES["img_photo"]["name"]."already exists.";
			}
			else
			{
				move_uploaded_file($_FILES["img_photo"]["tmp_name"],"photos/".$_FILES["img_photo"]["name"]);
			}
		
		
		//file upload end
		
		
		
		
		
		
		$date=date("Y-m-d", strtotime($_POST['txt_date']));
		
		$sql= "INSERT INTO sponsor(user_id,address,country,name,contact_no,date,photo) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_userid'])."',
						'".mysql_real_escape_string($_POST['txt_address'])."',
						'".mysql_real_escape_string($_POST['txt_country'])."',
						'".mysql_real_escape_string($_POST['txt_name'])."',
						'".mysql_real_escape_string($_POST['txt_contactno'])."',
						'".mysql_real_escape_string($date)."',
						'".mysql_real_escape_string($_FILES["img_photo"]["name"])."'
						)";
		
		$sql2 = "INSERT INTO user(user_id,password,usertype) 
						VALUES(
						'".mysql_real_escape_string($_POST['txt_userid'])."',
						'".mysql_real_escape_string($_POST['txt_pass'])."',
						'".mysql_real_escape_string('pending')."')";
						$result2=mysqli_query($connection,$sql2) or die("Error in sql2 ".mysqli_error());
		
												
				$result=mysqli_query($connection,$sql) or die("Error in sql ".mysqli_error());
					if($result and $result2 )
						{
							//header("location:".$viewpage);
							echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
			echo '<p align="center">&lt;&lt;&lt;&lt; <a href="index.php?pg=spres.php&option=new">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
							echo "";
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

<body>
<?php
$loginpage="index.php?";
if($_GET['option']=="new")
		{
			include ("config.php");
			$sql1 ="SELECT user_id FROM sponsor ORDER BY user_id ASC";
			$result=mysqli_query($connection,$sql1) or die ("mysql.error:".mysqli_error());
			if(mysqli_num_rows($result)>0)
			{
				while($row=mysqli_fetch_assoc($result))
				{
					$sp_No=$row['user_id'];
				}
				$n=(string)$sp_No;
				$sp_No=++$n;
			}
			else
			{
				$sp_No="SP001";
			}


?>

<div class="box span10">
<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Sponsor Registration Form</h2>
  
                        <div class="box-icon"> <a href="#" title="Click Here" class="btn btn-setting btn-round" data-rel="tooltip"><i class="icon-plus"></i></a>   </div>
                    </div>
                    <div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Sponsor Registration Form</h3>
			</div>
                    
 <div class="box-content">
   
      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <fieldset>
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Sponsor ID </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_userid" id="txt_userid"  readonly value="<?php echo $sp_No;?>" >
              
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
              <input type="text" required class="input-xlarge focused" id="txt_country" name="txt_country" onkeypress="return isTextKey(event)" >
            
              
            </div>
          </div>
         
          <div class="control-group">
          
            <label class="control-label" for="typeahead">Full Name </label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" name="txt_name" id="txt_name" value="" onkeypress="return isTextKey(event)" > 
           </div>
          </div>
          
            <div class="control-group">
            <label class="control-label" for="typeahead">Contact No </label>
            <div class="controls">
              <input type="tel" required class="input-xlarge focused" id="txt_contactno" name="txt_contactno" onkeypress="return isNumberKey(event)" />
              
            </div>
          </div>
        
          
          
          
             <div class="control-group">
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_dob" readonly value="<?php  echo date("Y-m-d");?>" name="txt_date">
            </div>
          </div>
         
            <div class="control-group">
            <label class="control-label" for="typeahead">Photo </label>
            <div class="controls">
            <input class="input-file uniform_on" id="img_photo" type="file" name="img_photo">

          </div>
          </div>
          
    <div class="control-group">
            <label class="control-label" for="typeahead">Password</label>
            <div class="controls">
              <input type="password" required class="input-xlarge focused"  name="txt_pass" id="txt_pass"  onblur="password()" >
              
            </div>
          </div>
         
				     
              
          			
            <div class="form-actions">
            <button type="submit" class="btn btn-primary" name="save" id="save">Save </button>
            <a class="btn btn-success" href="<?php echo $loginpage; ?>"><i class="icon-arrow-left icon-white"></i>Go Back</a>
            <button type="reset" class="btn btn-danger" name="save" id="save" value="Reset">Reset</button>
        </div>
        
        </fieldset>

      </form>
     
      <?php
		}
		?>

    </div>
	
  </div>
  
<p align="center" ><img src="photos/e1.jpg"  alt="" width="1000" height="300" /></p>
</body>
</html>

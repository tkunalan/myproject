<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<?php 
$loginpage="index.php?pg=login.php";
if(isset($_POST['forget']))
	{
				include("config.php");	
				$txt_userid   = $_POST['txt_userid'];//get userid from form
				$txt_tpnum = $_POST['txt_tpnum'];//get telephone number from form
				
				$sql2="SELECT * FROM user WHERE user_id='$txt_userid'";//select usertype from user table equal to get userid
				$result2=mysql_query($sql2) or die("Error in sql2 ".mysql_error());
				$row2=mysql_fetch_assoc($result2);
				if($row2['usertype']=="sponsor")
				{
					$sql1="SELECT * FROM sponsor WHERE user_id='$txt_userid'";//select userid from staff table equal to get userid
					$result1=mysql_query($sql1) or die("Error in sql1 ".mysql_error());
					$row1=mysql_fetch_assoc($result1);
					$tonum=$row1['contact_no'];
				}
				else if(!($row2['usertype']=="Labour" || $row2['usertype']=="pending"))
				{
					$sql1="SELECT * FROM staff WHERE user_id='$txt_userid'";//select userid from staff table equal to get userid
					$result1=mysql_query($sql1) or die("Error in sql1 ".mysql_error());
					$row1=mysql_fetch_assoc($result1);
					$tonum=$row1['contact_no'];
				}
				
					//check userid and contactno
				if(mysql_num_rows($result2)<=0)
				{
					echo "<script> alert('Your user Id is wrong');</script>";
				}
				else if($txt_tpnum!=$row1['contact_no'])
				{
					echo "<script>alert('Your contact number not match with database');</script>";
				}
				else
				{
					$code=rand();
					$user = "94778445220";
          			$password = "7824";
          			$text = urlencode($code);
          			$to = "94$tonum";


         			$baseurl ="http://www.textit.biz/sendmsg";
			
        			  $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
        			  $ret = file($url);

 

        			 $res= explode(":",$ret[0]);
					 $sql1="UPDATE user SET 
							code='".mysql_real_escape_string($code)."'
						WHERE user_id='$txt_userid'";
						$result=mysql_query($sql1);
			
         			if (trim($res[0])=="OK")
            		   {
            			  echo "<script> alert('please check your phone we send a code'); window.location.href='index.php?pg=codever.php&tp=$txt_tpnum&user=$txt_userid';</script>";
            		  }
         			else
         		     {
         			     echo "<script> alert('sorry phone gateway have some problem'); window.location.href='index.php?pg=login.php';</script>";
            		  }
					
					
				}
	}
 ?>
<body>
<div class="box span10">
 <div class="box-content">


<form class="form-horizontal" action="" method="POST">
        <fieldset>
       <table width="100%">
			<div class="control-group">
            <label class="control-label" for="typeahead">User ID</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_userid" name="txt_userid">
              
            </div>
          </div>
          				          <div class="control-group">
            <label class="control-label" for="typeahead">Contact Number</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_tpnum" name="txt_tpnum">
              
            </div>
          </div>
       </table>   
          <div class="form-actions">
        <p class="center span5">    <button type="submit" class="btn btn-primary" name="forget" id="forget">Save</button></p>
<!--<a class="btn btn-primary" href="<?php echo $loginpage; ?>"><i class="icon-arrow-left icon-white"></i> Go Back </a>-->
 
</div>

</fieldset>
</form>
</div>
</div>
</body>

</html>
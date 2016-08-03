<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<?php 
$loginpage="index.php";
if(isset($_GET['pg']))
{
$tp=$_GET['tp'];
$user=$_GET['user'];
$tonum=substr($tp, 1,10);


if(isset($_POST['name']))
	{
				include("config.php");	
				$txt_code   = $_POST['txt_code'];
					$sql1="SELECT * FROM user WHERE user_id='$user'";//select userid user table equal to $user
					$result1=mysqli_query($connection,$sql1) or die("Error in sql1 ".mysqli_error());
					$row1=mysqli_fetch_assoc($result1);
						$pwd=$row1['password'];
				if( $row1['code'] == $txt_code)
				{
					$user = "94778445220";
          			$password = "7824";
          			$text = urlencode($pwd);
          			$to = "94$tonum";//start number947


         			$baseurl ="http://www.textit.biz/sendmsg";
			
        			  $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
        			  $ret = file($url);

 

        			 $res= explode(":",$ret[0]);
					 
			
         			if (trim($res[0])=="OK")
            		   {
            			  echo "<script> alert('please check your phone we send a password'); window.location.href='index.php?pg=login.php'</script>";
            		   }
         			else
         		     {
         			     echo "<script> alert('sorry phone gateway have some problem'); window.location.href='index.php?pg=login.php';</script>";
            		  }
					
					
					
						
					
					
				}
				else
				{
					echo "<script> alert('your verification code is not match'); window.location.href='index.php?pg=login.php';</script>";
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
            <label class="control-label" for="typeahead">Verification Code</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_code" name="txt_code">
              
            </div>
          </div>
         </table>
          <div class="form-actions">
           <button type="submit" class="btn btn-primary" name="name" id="name">Submit</button>
<a class="btn btn-primary" href="<?php echo $loginpage; ?>"><i class="icon-arrow-left icon-white"></i> Cancel </a>
 
</div>
 
</fieldset>
</form>
</div>
</div>
</body>

</html>
<?php
}
else
{
}
?>
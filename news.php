<?php
	include ("config.php");

	if($_SESSION['usertype']=="admin")
	{
		$newpage="adminhome.php?pg=news.php&option=new";
		$viewpage="adminhome.php?pg=news.php&option=view";
	}
	
	
	
	
	if(isset($_POST['save']))
	
	{
		
		
		//file upload start
		
		
			if(file_exists("upload/".$_FILES["img_photo"]["name"]))
			{
				echo $_FILES["img_photo"]["name"]."already exists.";
			}
			else
			{
				move_uploaded_file($_FILES["img_photo"]["tmp_name"],"photos/".$_FILES["img_photo"]["name"]);
			}
		
		
		//file upload end
		
		$uid=$_POST['txt_userid'];
		$sql5="SELECT *  FROM staff WHERE name='$uid' ";
				                     $result5=mysqli_query($connection,$sql5) or die ("mysqli.error:".mysqli_error());
          		                         $row5=mysqli_fetch_assoc($result5);
		$date=date("Y-m-d", strtotime($_POST['txt_date']));
		$sql2 = "INSERT INTO news(news_id,news,date,photo,user_id) 
						VALUES(
						'".mysqli_real_escape_string($connection,$_POST['txt_newsid'])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_news'])."',
						'".mysqli_real_escape_string($connection,$date)."',
						'".mysqli_real_escape_string($connection,$_FILES["img_photo"]["name"])."',
						'".mysqli_real_escape_string($connection,$_POST['txt_userid'])."'
						)";
		$result2=mysqli_query($connection,$sql2) or die("Error in sql2 ".mysqli_error());
						
						
						if($result2)
						{
							echo '<p align="center"><center><img border="0" src="photos/sucess.jpg" width="100" height="50"></center></p>';
				echo '<p align="center">&lt;&lt;&lt;&lt; <a href="'.$viewpage.'?pg=news.php&option=view">Go Back</a> &gt;&gt;&gt;&gt;</p>';
					exit;
						}
						else
						{
							echo mysql_error();
						}
	}
	
	if(isset($_POST['savechanges']))
	{
		
		$nid=$_POST['txt_newsid'];
		
		$sql="UPDATE news SET 
		                   	news='".mysql_real_escape_string($_POST['txt_news'])."'
															
						WHERE news_id='$nid'";
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
      <h2><i class="icon-edit"></i>news Details</h2>
      
    </div>
    
    
    
	<?php
	if(isset($_GET['status']))
	{
		
		 $nid=$_GET['nid'];
		 
		//news view start
		if($_GET['status']=="newsview")
		{
			$sql1 ="SELECT * FROM news WHERE news_id='$nid'";
			$result=mysqli_query($connection,$sql1) or die ("mysqli.error:".mysqli_error());
			$row=mysqli_fetch_assoc($result);
			?>
			<div class="row-fluid sortable">		
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> News Details</h2>
                        
					</div>
                    
                    
                    
                    
                    
				  <div class="box-content">
						<table class="table">
                        <center><img width="100" height="100" src="photos/<?php echo $row['photo']; ?>"></center></br>
						 <tr><td>Photo</td><td><?php echo $row['photo']; ?></td>
                        <tr><td>News</td><td><?php echo $row['news']; ?></td>
                        <tr><td>Date</td><td><?php echo $row['date']; ?></td></tr>
                        
                        
                        
                        
                       
           
                         
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
		//item view end
		
		//item edit start
		elseif($_GET['status']=="newsedit")
		{
			$sql1 ="SELECT * FROM news WHERE news_id='$nid'";
			$result=mysqli_query($connection,$sql1) or die ("mysqli.error:".mysqli_error());
			$row=mysqli_fetch_assoc($result);
			
			?>

<div class="box-content">
      <form class="form-horizontal" action="<?php echo $viewpage; ?>&status=newsview&nid=<?php echo $nid; ?>" method="post">
        <fieldset>
        
        <table width="100%">
          <tr><td>
          <div class="control-group">
          
            <label class="control-label" for="typeahead">News Id</label>
            <div class="controls">
            <input type="text" required  readonly class="input-xlarge focused" name="txt_newsid" id="txt_newsid" value="<?php echo $row['news_id']; ?>" > 
           </div>
          </div>
 <div class="control-group">
          
           
           <div class="control-group">
							  <label class="control-label" for="textarea2">News</label>
							  <div class="controls">
                              <textarea class="cleditor" id="txt_news" name="txt_news" rows="3"><?php echo $row['news']; ?></textarea>
		<!--<input  type="text" class="cleditor" id="txt_news" name="txt_news" rows="10" value="">-->
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
			//news edit end
		
		//news delete start
		elseif($_GET['status']=="newsdelete")
		{
			$sql2="DELETE FROM news  WHERE news_id='$nid'";
			$result=mysqli_query($connection,$sql2) or die("Error in mysqli :".mysqli_error());
			
		}
		//news delete end
	}
	
	?>
     <?php
	if(isset($_GET['option']))
	{ 
	  global $bid;
		//new news entry begin
		if($_GET['option']=="new")
		{
			include ("config.php");
			$sql1 ="SELECT news_id FROM news ORDER BY news_id  ASC";
			$result=mysqli_query($connection,$sql1) or die ("mysqli.error:".mysqli_error());
			if(mysqli_num_rows($result)>0)
			{
				while($row=mysqli_fetch_assoc($result))
				{
					$nid=$row['news_id'];
				}
				$n=(string)$nid;
				$nid=++$n;
				
			}
			else
			{
				$nid="N00001";
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
      <h2><i class="icon-edit"></i>News Details Form</h2>
      
    </div>
<div class="box-content">
      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <fieldset>
        
        <table width="100%">
        <tr><td>
  <div class="control-group">
          
            <label class="control-label" for="typeahead">News Id</label>
            <div class="controls">
            <input type="text" required  readonly class="input-xlarge focused" name="txt_newsid" id="txt_newsid" value="<?php echo $nid; ?>" > 
           </div>
          </div>
          
        
                
        
   <div class="control-group">
							  <label class="control-label" for="textarea2">News</label>
							  <div class="controls">
								<textarea class="cleditor" id="txt_news" name="txt_news" rows="3"></textarea>
							  </div>
							</div>
    <div class="control-group">
            <label class="control-label" for="typeahead">Photo </label>
            <div class="controls">
            <input  id="img_photo" type="file" name="img_photo">

          </div>
          </div>


   <div class="control-group">
            <label class="control-label" for="date01">Date</label>
            <div class="controls">
              <input type="text" required class="input-xlarge focused" id="txt_date" readonly value="<?php  echo date("Y-m-d");?>" name="txt_date">
            </div>
            
          </div>
          <?php 
		   $name=$_SESSION['username'];
		  $sql5="SELECT *  FROM staff  ";
		$result5=mysqli_query($connection,$sql5) or die ("mysqli.error:".mysqli_error());
      $row5=mysqli_fetch_assoc($result5);
	  ?>
          
          
          <div class="control-group">
            <label class="control-label" for="typeahead">Staff Id</label>
            <div class="controls">
     <input type="text" required class="input-xlarge focused" id="txt_userid" name="txt_userid"  value="<?php echo $row5['user_id']; ?>">
            
              
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
//new news entry end
//view news or search news begin
elseif(($_GET['option']=="view"))
        {
	global $nid;
	
?>
<div class="row-fluid sortable">		
		<div class="box span12">
		<div class="box-header well" data-original-title>
        <?php
			if($_SESSION['usertype']=="admin")
			{
				?>
				<a class="btn btn-primary " href="<?php echo $newpage; ?>"><i class="icon icon-add icon-orange"></i> Add News </a>
                <?php
			}
			else
			{
				?>
				<h4><i class="icon-user"></i>news Information</h4>
                <?php
			}
			?>
            </div>
            <div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th width="5%">News Id</th>
								  <th width="60%">News</th>
								  <th width="10%">Date</th>
								 <th width="25%">Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                          	<?php
								$branch_id=$_SESSION['branch_id'];
								if($_SESSION['usertype']=="admin")
								{
									$sql2="SELECT * FROM News";
								}
								//else
								{
									//$sql2="SELECT * FROM branch WHERE branch_id='$bid'";
								}
								$result=mysqli_query($connection,$sql2);
								while($row=mysqli_fetch_assoc($result))
								{
									$nid=$row['news_id'];
							?>
							<tr><td class="center"><?php echo $row['news_id']; ?></td><td class="center"><?php echo $row['news']; ?></td><td class="center"><?php echo $row['date']; ?></td><td class="center"><a class="btn btn-success" 
                            href="<?php echo $viewpage; ?>&status=newsview&nid=<?php echo $row['news_id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    <?php
                                    if($_SESSION['usertype']=="admin")
									{ 
										?>
                          <a class="btn btn-info" href="<?php echo $viewpage; ?>&status=newsedit&nid=<?php echo $row['news_id']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
						<a class="btn btn-danger" href="<?php echo $viewpage; ?>&status=newsdelete&nid=<?php echo $row['news_id']; ?>" onclick="return deleteconfirm()">
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
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
 <div class="control-group">
								<label class="control-label" for="selectError">Ward Type</label>
								<div class="controls">
								  <select  id="txt_wardtype" name="txt_wardtype" onchange="wardtypesel()" data-rel="chosen">
                                  <option></option>
                                  <?php
								  global $wardtypeselect;
								global $branchselect;
								if($_SESSION['usertype']=="manager"||$_SESSION['usertype']=="clerk")
			
								{
								$branch_id=$_SESSION['branch_id'];
								}
								else
								{
								$sql7 ="SELECT *  FROM branch WHERE branch_name='$branchselect'";
								$result7=mysqli_query($connection,$sql7) or die ("mysqli.error:".mysqli_error());
								$row7=mysqli_fetch_assoc($result7);
								$branch_id=$row7["branch_id"];
								}
								
								
								  $sql6 ="SELECT DISTINCT ward_type  FROM ward WHERE branch_id='$branch_id'";
								$result6=mysqli_query($connection,$sql6) or die ("mysqli.error:".mysqli_error());
								$row6=mysqli_fetch_assoc($result6);
									do
									{
										if($row6['ward_type']==$wardtypeselect)
										 	{
												echo "<option selected value=".$row6['ward_type'].">".$row6['ward_type']."</option>"; 
											 }
											 else
											 {
												echo "<option value=".$row6['ward_type'].">".$row6['ward_type']."</option>";
											 }
									}
									while($row6=mysql_fetch_assoc($result6)); 
									?>
                                    </select>
								</div>
							  </div>
<body>
</body>
</html>
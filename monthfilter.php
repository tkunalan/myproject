<?php
session_start();
	include ("config.php");
	if($_SESSION['usertype']=="admin")
	{
		$page="adminhome.php";
		$viewpage="adminhome.php?pg=elders details.php&option=view";
	}
	elseif($_SESSION['usertype']=="manager")
	{
		$newpage="managerhome.php?pg=elders details.php&option=new";
		$viewpage="managerhome.php?pg=elders details.php&option=view";
	}
	elseif($_SESSION['usertype']=="clerk")
	{
		$newpage="managerhome.php?pg=elders details.php&option=new";
		$viewpage="managerhome.php?pg=elders details.php&option=view";
	}
	elseif($_SESSION['usertype']=="ward-incharge")
	{
		$viewpage="managerhome.php?pg=elders details.php&option=view";
	}
	?>
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Elders Details</h2>
                        
					</div>
                    <div class="box-content">
                    <form class="form-horizontal" action="<?php echo $page; ?>?pg=salary.php" method="post">
                    <table><tr><td>
                    <div class="control-group">
                    
								<label class="control-label" for="selectError1">Month</label>
								<div class="controls">
								  <select name="txtmonth" data-rel="chosen">
                                  <option value='1' selected >January</option>
									<option value='2'>February</option>
                                    <option value='3'>March</option>
                                    <option value='4'>April</option>
                                    <option value='5'>May</option>			                  
                                  </select>
								</div>
			   	 	</div>
                    </td><td>
                    		<div class="control-group">
								<label class="control-label" for="selectError2">Year</label>
								<div class="controls">
								  <select name="txtyear" data-rel="chosen">
                                  <option value='2010'>2010</option>
									<option value='2011'>2011</option>
                                    <option value='2012'>2012</option>
                                    <option value='2013'>2013</option>
                                    <option value='2014' selected >2014</option>			                  
                                  </select>
								</div>
			   	 			</div>
                            
                            </td></tr><tr><td colspan="2">
                            <center><button type="submit" class="btn btn-primary" name="submit">Submit </button></center>
                            </td></tr></table>
                            </form>
                            </div>
                            </div></div>
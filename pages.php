          <?php 
		   if(isset($_GET['pg']))
		      {
					$filename=$_GET['pg'];
					if (file_exists($filename)) 
						{
							include ($filename);
						}
						else
						{
							include ("home.php");
						}

			  }
		 else
		 {
			 if (file_exists("home.php"))
			  {
				  include ("home.php");
			 }
			else
			{
				include ("home.php");
			}
 		}
	    ?>
          
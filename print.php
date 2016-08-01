<script type="text/javascript">
    function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
    }
</script>

<html>
<center><img src="img/b1.jpg"></center>
<input id="printpagebutton" type="button" value="Print this page" onclick="printpage()"/>
<center>Print Date : <?php echo date("Y-m-d"); ?></center>
<?php
session_start();
if(isset($_GET['pr']))
{
$filename=$_GET['pr'];
include($filename);
}
else
{
}
?>

<body>
</body>
</html>
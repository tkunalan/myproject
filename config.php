<?php
  $host='localhost';//localhostname
  $uname='root';//username
  $pass='';//password
  
  $connection= mysqli_connect($host, $uname, $pass)or die("cannot connect"); ;
  
  if (!$connection) {
     die ("A connection to the server could not be established!"); 
  }
    $result=mysqli_select_db($connection,"eldershome")or die("cannot select DB");//select database
  
  if (! $result) {
     die ("database could not be selected");
  }

?>
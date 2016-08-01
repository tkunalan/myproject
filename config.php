<?php
  $host='localhost';//localhostname
  $uname='root';//username
  $pass='';//password
  
  $connection= mysql_connect($host, $uname, $pass);
  
  if (!$connection) {
     die ("A connection to the server could not be established!"); 
  }
  
  $result=mysql_select_db ("eldershome");//select database
  
  if (! $result) {
     die ("database could not be selected");
  }

?>
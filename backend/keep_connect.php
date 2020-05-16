<?php
define('db_user','root');
define('db_password','');
define('db_host','localhost');
define('db_name','keep');
$dbc=mysqli_connect(db_host,db_user,db_password,db_name) or die ('Could not connect to MySQL'.mysqli_connect_error());
?>

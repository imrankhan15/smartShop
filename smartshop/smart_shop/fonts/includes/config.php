<?php
$mysql_hostname="localhost";
$mysql_user="root";
$mysql_password="";
$mysql_database="ride_database";

$bd=mysql_connect($mysql_hostname,$mysql_user,$mysql_password);
mysql_select_db($mysql_database,$bd);

?>
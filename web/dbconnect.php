<?php
$MyUsername = "gu133";  // enter your username for mysql
$MyPassword = "123456";  // enter your password for mysql
$MyHostname = "mydb.ics.purdue.edu";      // this is usually "localhost" unless your database resides on a different server

$dbh = mysql_pconnect($MyHostname , $MyUsername, $MyPassword);
$selected = mysql_select_db("SensorStatus",$dbh);
?>
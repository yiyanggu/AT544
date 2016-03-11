<?php
    // Connect to MySQL
    include("dbconnect.php");

    // Prepare the SQL statement
	$result_past=mysql_query("SELECT Activity FROM gu133.WorkerStatus WHERE EmployeeID = '".$_GET["id"]."' ORDER BY ActivityID DESC LIMIT 1");
	//$result_time=mysql_query("SELECT Time FROM gu133.WorkerStatus WHERE EmployeeID = '".$_GET["id"]."' ORDER BY ActivityID DESC LIMIT 1");
	$activity_past=mysql_result($result_past, 0);
	//$activity_time=mysql_result($result_time, 0);
	//echo time();
	//$SQL_overdue = "INSERT INTO gu133.WorkerStatus (EmployeeID,FName,LName,Activity) VALUES ('".$id."','".$fname."','".$lname."','".OVERDUE."')";
	if ($activity_past==IN)
		{$activity=OUT;}
	else
		{$activity=IN;}
	$id=$_GET["id"];
	$fname=$_GET["fname"];
	$lname=$_GET["lname"];
	
    $SQL = "INSERT INTO gu133.WorkerStatus (EmployeeID,FName,LName,Activity) VALUES ('".$id."','".$fname."','".$lname."','".$activity."')";
	

    // Execute SQL statement
    mysql_query($SQL);

    // Go to the review_data.php (optional)
    header("Location: WorkerStatus.php");
?>

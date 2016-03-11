<!This program is used to read data from server database into a table format. Then show the top 10 recent activities>
<?php 
    // Start MySQL Connection
    include('dbconnect.php'); 
    $page = $_SERVER['PHP_SELF'];
    $sec = "5";
?>

<html>
<head>
    <title>Employee Status Monitor</title>
    <style type="text/css">
        .table_titles, .table_cells_odd, .table_cells_even {
                padding-right: 20px;
                padding-left: 20px;
                color: #000;
        }
        .table_titles {
            color: #FFF;
            background-color: #666;
        }
        .table_cells_alarm {
            background-color: #FC0404;
        }
        .table_cells_normal {
            background-color: #FAFAFA;
        }
        table,th,td {
            border: 1px solid #333;
        }
        body { font-family: "Trebuchet MS", Arial; }
    </style>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
</head>

    <body>
        <h1>Employee Status Monitor</h1>
    <table border="0" cellspacing="0" cellpadding="4">
      <tr>
            <td class="table_titles">ActivityID</td>
            <td class="table_titles">Time</td>
            <td class="table_titles">EmployeeID</td>
			<td class="table_titles">First Name</td>
			<td class="table_titles">Last Name</td>
		<td class="table_titles">Activity</td>
          </tr>
<?php
    // Retrieve all records and display them
    $result = mysql_query("SELECT * FROM gu133.WorkerStatus ORDER BY Time desc LIMIT 10");
	$result_mostrecent=mysql_query("SELECT o1.* FROM gu133.WorkerStatus o1 JOIN(SELECT EmployeeID, MAX(Time) as lastone FROM gu133.WorkerStatus GROUP BY EmployeeID) o2 on o1.EmployeeID = o2.EmployeeID and o1.Time = o2.lastone GROUP BY o1.EmployeeID");
	$record_number=mysql_result(mysql_query("SELECT COUNT(ActivityID)FROM gu133.WorkerStatus"),0);
    // auto-refresh
    echo "Auto Refresh 5 Seconds";
	
    // process every record
	$timelimit=7200;//overdue timelimit in seconds
	while( $check = mysql_fetch_array($result_mostrecent) ){
		$time=strtotime($check["Time"]);
		$gap=time()-$time;
		if ($gap>$timelimit and $check["Activity"]==IN){
			$SQL="INSERT INTO gu133.WorkerStatus (EmployeeID,FName,LName,Activity) VALUES ('".$check["EmployeeID"]."','".$check["FName"]."','".$check["LName"]."','".OVERDUE."')";
			mysql_query($SQL);
		}  
	}
    while( $row = mysql_fetch_array($result) )
    {$css_class_normal=' class="table_cells_normal"';
        echo '<tr>';
        echo '   <td'.$css_class_normal.'>'.$row["ActivityID"].'</td>';
        echo '   <td'.$css_class_normal.'>'.$row["Time"].'</td>';
        echo '   <td'.$css_class_normal.'>'.$row["EmployeeID"].'</td>';
	echo '   <td'.$css_class_normal.'>'.$row["FName"].'</td>';
	echo '   <td'.$css_class_normal.'>'.$row["LName"].'</td>';
	echo '   <td'.$css_class_normal.'>'.$row["Activity"].'</td>';
        echo '</tr>';
    }
?>
    </table>
    </body>
</html>
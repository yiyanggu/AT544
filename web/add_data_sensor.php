<?php
    // Connect to MySQL
    include("dbconnect.php");

    // Prepare the SQL statement
    $SQL = "UPDATE  gu133.SensorStatus SET  Sensor = '".$_GET["Sensor"]."' WHERE  SensorStatus.Row ='".$_GET["Row"]."'AND SensorStatus.side ='".$_GET["Side"]."'; "; 
   

    // Execute SQL statement
    mysql_query($SQL);

    // Go to the review_data.php (optional)
    header("Location: SensorStatus.php");
?>
https://web.ics.purdue.edu/~gu133/add_data.php?SensorL=0&SensorR=0&Row=16
<!This program is used to read data from server database into a table format. Then highlight the missing rows>
<?php 
    // Start MySQL Connection
    include('dbconnect.php'); 
    $page = $_SERVER['PHP_SELF'];
    $sec = "5";
?>

<html>
<head>
    <title>CRJ Seat Monitor</title>
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
            border: 2px solid #333;
        }
        body { font-family: "Trebuchet MS", Arial; }
    </style>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
</head>

    <body>
        <h1>CRJ Seat Monitor</h1>
    <table border="0" cellspacing="0" cellpadding="4">
      <tr>
            <td class="table_titles">SensorL</td>
            <td class="table_titles">Row</td>
            <td class="table_titles">SensorR</td>
          </tr>
<?php
    // Retrieve all records and display them
    $result = mysql_query("SELECT * FROM gu133.SensorStatus ORDER BY Row");

    // auto-refresh
    echo "Auto Refresh 5 Seconds";
    // process every record
    while( $row = mysql_fetch_array($result) )
    {$css_class_normal=' class="table_cells_normal"';
        if ($row["SensorL"]=='0') 
        { 
            $css_class_left=' class="table_cells_alarm"'; 
        }
        
        else
        { 
            $css_class_left=' class="table_cells_normal"'; 
        }
		 if ($row["SensorR"]=='0') 
        { 
            $css_class_right=' class="table_cells_alarm"'; 
        }
        
        else
        { 
            $css_class_right=' class="table_cells_normal"'; 
        }

       

        echo '<tr>';
        echo '   <td'.$css_class_left.'>'.'</td>';
        echo '   <td'.$css_class_normal.'>'.$row["Row"].'</td>';
        echo '   <td'.$css_class_right.'>'.'</td>';
        echo '</tr>';
        
    
    }
?>
    </table>
    </body>
</html>
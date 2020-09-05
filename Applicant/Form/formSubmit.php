<?php
    require("includes/databaseBlockdata.php");
    
    $uidd = $_POST['uniqueid'];
    $emp1_val = $_POST['emp1'];
    $emp2_val = $_POST['emp2'];
    $emp3_val = $_POST['emp3'];

    $sql ="INSERT INTO approvaldb (uid,emp1,emp2,emp3) VALUES('$uidd','$emp1_val','$emp2_val','$emp3_val')";
    if (mysqli_query($conn, $sql))
    {
        echo "Data inserted!";
    }
    else
    {
        echo "You have already submitted a request. Please Wait for the process!";
    }
    mysqli_close($conn);
?>
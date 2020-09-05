<?php
    require("./dependency/database.php");
    $trackingid = $_POST['uid'];
    $emp = $_POST['emp'];
    $ctime = $_POST['time'];

    if($emp=="Employee1")
    {
        $sql = "UPDATE approvaldb SET emp1=0, emp2=1, emp1_time=$ctime WHERE uid='$trackingid'";
        
        if ($conn->query($sql) === TRUE) 
        {
            echo "Request Approved successfully";
        }
        else
        {
            echo "Some Error Happened. Try Again later!";
        }
    }
    elseif($emp=="Employee2")
    {
        $sql = "UPDATE approvaldb SET emp2=0, emp3=1,emp2_time=$ctime WHERE uid='$trackingid'";
        if ($conn->query($sql) === TRUE) 
        {
            echo "Request Approved successfully";
        }
        else
        {
            echo "Some Error Happened. Try Again later!";
        }
    }
    else
    {
        $sql = "UPDATE approvaldb SET emp3=0, emp3_time=$ctimeWHERE uid='$trackingid'";
        if ($conn->query($sql) === TRUE) 
        {
            echo "Request Approved successfully";
        } 
        else
        {
            echo "Some Error Happened. Try Again later!";
        }
    }
?>
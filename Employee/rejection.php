<?php
    require("./dependency/database.php");
    $trackingid = $_POST['uid'];
    $emp = $_POST['emp'];
    $ctime = $_POST['time'];
    $reason = $_POST['reason'];
    $flag = 0;
    // update comment entered in db

    $insert="INSERT into commentdb(uid,emp_name,comment,time) VALUES('$trackingid','$emp','$reason',$ctime)";
    $run=$conn->query($insert);
    if($run)
    {
        $flag=1;
    }
    else
    {
        $flag = 0;
    }

    //now check for each employee
    if($emp=="Employee1"){
        $sql = "UPDATE approvaldb SET emp1=-1, emp1_time=$ctime WHERE uid='$trackingid'";
        if ($conn->query($sql) === TRUE) 
        {
            echo "Request Rejected successfully";
        }
        else
        {
            echo "Some Error Happened. Try Again later!";
        }
    }
    elseif($emp=="Employee2"){
        $sql = "UPDATE approvaldb SET emp2=-1,emp2_time=$ctime WHERE uid='$trackingid'";
        if ($conn->query($sql) === TRUE) 
        {
            echo "Request Rejected successfully";
        }
        else
        {
            echo "Some Error Happened. Try Again later!";
        }
    }
    else
    {
        //process complete --> update in file
        $sql = "UPDATE approvaldb SET emp3=-1,emp3_time=$ctime WHERE uid='$trackingid'";
        if ($conn->query($sql) === TRUE) {
            echo "Request Rejected successfully";
        } 
        else
        {
            echo "Some Error Happened. Try Again later!";
        }
    }
    
    
?>
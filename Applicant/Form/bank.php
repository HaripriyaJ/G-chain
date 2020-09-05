<?php
    require("includes/databaseIFSC.php");
    $ifsc_check=$_POST['ifsc_input'];

    // bank_details --> TABLE
    $select="select * from bank_details where bank_ifsc='$ifsc_check'";
    $result=$conn->query($select);
    if($result->num_rows > 0)
    {
        while($row = mysqli_fetch_assoc($result)) {
            $display = $row["bank_name"]."\n".$row["bank_branch"]."\n".$row["bank_address"]."\n";
            echo $display;
                 
        }
    }
    else
    {
        echo "INVALID IFSC, Enter correctly! ";
    }
?>

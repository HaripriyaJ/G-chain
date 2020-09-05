<?php

    $conn= new mysqli("localhost","root","","blockdata");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $anumber = $_POST['aadhar'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $insert="INSERT into applicant_db(aadhar,name,email,password) VALUES('$anumber','$name','$email','$pass')";
    $run=$conn->query($insert);
    if($run)
    {
        echo "Account Created Successfully!";
    }
    else
    {
        echo "Already Registered";
    }
?>
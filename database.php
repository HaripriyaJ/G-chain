<?php

$conn= new mysqli("localhost","root","","blockdata");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
 }
?>
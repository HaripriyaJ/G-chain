<?php

$conn= new mysqli("localhost","root","", DATABASE NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
 }
?>
<?php

$servername = "ec2-52-37-193-247.us-west-2.compute.amazonaws.com";
$username = "root";
$password = "rp2016";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";


<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "restaurant";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset('utf-8');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else {
    //echo "Connect success";
}

?>
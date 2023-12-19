<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "restaurant";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Set the character set
    if (!$conn->set_charset("utf8")) {
        printf("Error loading character set utf8: %s\n", $conn->error);
        exit();
    }
    // Connection successful
    //echo "Connect success";
}

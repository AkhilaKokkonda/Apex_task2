<?php
// config.php
// Database configuration for XAMPP

$servername = "localhost";   // Usually localhost
$dbusername = "root";         // Default XAMPP MySQL username
$dbpassword = "";             // Default XAMPP MySQL password is empty
$dbname     = "apex_task2";  // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: set charset to avoid encoding issues
$conn->set_charset("utf8mb4");
?>

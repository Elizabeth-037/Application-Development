<!-- dblogin.php -->

<?php
// Database configuration
$servername = "127.0.0.1"; // Replace with your database server name or IP address
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "project"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

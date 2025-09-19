<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; // Default password is empty in XAMPP
$database = "mental_health_tracker1";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

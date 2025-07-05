<?php
$servername = "localhost"; // Change if needed
$username = "root"; // Change if your MySQL has a different user
$password = ""; // Keep empty if no password
$database = "railway"; // Ensure this matches your database name

$conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "School_Management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verify tables exist
$requiredTables = ['pupils', 'classes'];
foreach ($requiredTables as $table) {
    if (!$conn->query("SELECT 1 FROM `$table` LIMIT 1")) {
        die("Error: Table '$table' doesn't exist!");
    }
}
?>
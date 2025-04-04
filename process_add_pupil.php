<?php
require 'db_connect.php';

// Debugging
error_log("Starting process_add_pupil.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: add_pupil.php?error=Invalid request method");
    exit();
}

// Get form data
$name = $conn->real_escape_string($_POST['name'] ?? '');
$address = $conn->real_escape_string($_POST['address'] ?? '');
$medical_info = $conn->real_escape_string($_POST['medical_info'] ?? '');
$class_id = (int)($_POST['class_id'] ?? 0);

// Validate
if (empty($name) || empty($address) || $class_id <= 0) {
    header("Location: add_pupil.php?error=Please fill all required fields");
    exit();
}

// Insert data
$sql = "INSERT INTO pupils (name, address, medical_info, class_id) 
        VALUES ('$name', '$address', '$medical_info', $class_id)";

if ($conn->query($sql)) {
    header("Location: view_pupils.php?success=Pupil added successfully");
} else {
    header("Location: add_pupil.php?error=" . urlencode($conn->error));
}

$conn->close();
exit();
?>
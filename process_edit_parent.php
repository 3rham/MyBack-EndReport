<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: view_parents.php");
    exit;
}

$parent_id = (int)$_POST['parent_id'];
$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);

$sql = "UPDATE parents SET 
        name = '$name',
        email = '$email',
        phone = '$phone'
        WHERE parent_id = $parent_id";

if ($conn->query($sql)) {
    header("Location: view_parents.php?success=Parent updated successfully");
} else {
    header("Location: edit_parent.php?id=$parent_id&error=" . urlencode($conn->error));
}

$conn->close();
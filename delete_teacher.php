<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header("Location: view_teachers.php?error=" . urlencode("No teacher ID provided"));
    exit;
}

$teacher_id = $_GET['id'];

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare("DELETE FROM teachers WHERE teacher_id = :teacher_id");
    $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header("Location: view_teachers.php?success=" . urlencode("Teacher deleted successfully"));
    } else {
        header("Location: view_teachers.php?error=" . urlencode("Failed to delete teacher"));
    }
} catch (PDOException $e) {
    header("Location: view_teachers.php?error=" . urlencode("Database error: " . $e->getMessage()));
}
exit;
?>
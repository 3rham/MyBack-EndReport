<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header("Location: view_parents.php?error=" . urlencode("No parent ID provided"));
    exit;
}

$parent_id = $_GET['id'];

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // First, delete any associations in the pupil_parent table
    $stmt = $conn->prepare("DELETE FROM pupil_parent WHERE parent_id = :parent_id");
    $stmt->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
    $stmt->execute();
    
    // Then, delete the parent
    $stmt = $conn->prepare("DELETE FROM parents WHERE parent_id = :parent_id");
    $stmt->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header("Location: view_parents.php?success=" . urlencode("Parent deleted successfully"));
    } else {
        header("Location: view_parents.php?error=" . urlencode("Failed to delete parent"));
    }
} catch (PDOException $e) {
    header("Location: view_parents.php?error=" . urlencode("Database error: " . $e->getMessage()));
}
exit;
?>
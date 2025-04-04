<?php
require 'db_connect.php';

// Check if the pupil ID is set in the database
if (isset($_GET['id'])) {
    $pupil_id = intval($_GET['id']); // Ensure That the value is integer

    // the DELETE statement
    $sql = "DELETE FROM pupils WHERE pupil_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pupil_id);

    // Execute  statement
    if ($stmt->execute()) {
        // Redirect with success message
        header("Location: view_pupils.php?success=Record deleted successfully.");
        exit();
    } else {
        // Redirect --->> error message
        header("Location: view_pupils.php?error=Error deleting record: " . $conn->error);
        exit();
    }
} else {
    // Redirect if no ID is provided. done
    header("Location: view_pupils.php?error=No pupil ID provided.");
    exit();
}
?>

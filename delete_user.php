<?php
// Include database connection
include("database.php"); // Assuming your database connection script is named database.php

// Retrieve user_id from cookie
// $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;

// Check if user_id exists and is numeric
if (isset($_POST['uid']) && is_numeric($_POST['uid'])) {
    $user_id = $_POST['uid'];

    // Check if user_id is not 1
    if ($user_id != 1) {
        // Prepare and execute SQL to delete user data
        $stmt = $conn->prepare("DELETE FROM users WHERE id_user = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            // Deletion successful
            echo "success"; // Send success message
        } else {
            // No rows affected (user not found)
            echo "error: User not found or no data deleted."; // Send error message
        }
    } else {
        // User ID is 1, cannot delete
        echo "error: Cannot delete user with ID 1."; // Send error message
    }
    $stmt->close();
} else {
    // Invalid user_id or parameter not set
    echo "error: Invalid user_id or parameter not set."; // Send error message
}

// Close database connection
$conn->close();
?>

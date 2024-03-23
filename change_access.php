<?php
// Include database connection
include("database.php"); // Assuming your database connection script is named database.php

// Handle AJAX request

    // Sanitize user input
    $user_id = $_COOKIE["user_id"];

    // Check if user_id exists and is numeric
    if ($user_id !== null && is_numeric($user_id)) {
        // Prepare and execute SQL to update user access level
        $stmt = $conn->prepare("UPDATE users SET access = 0 WHERE id_user = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            // Access level changed successfully
            echo "success"; // Send success message
            include("logout.php");
        } else {
            // No rows affected (user not found)
            echo "error: User not found or access level not changed."; // Send error message
        }
        $stmt->close();
    } else {
        // Invalid user_id
        echo "error: Invalid user_id."; // Send error message
    }

?>

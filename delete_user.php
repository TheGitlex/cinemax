<?php
// Include database connection
include("database.php"); // Assuming your database connection script is named database.php

// Retrieve user_id from cookie
$user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;

// Check if user_id exists and is numeric
if ($user_id !== null && is_numeric($user_id)) {
    // Check if user_id is not 1
    if ($user_id != 1) {
        // Prepare and execute SQL to delete user data
        $stmt = $conn->prepare("DELETE FROM users WHERE id_user = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            // Deletion successful
            echo "User data deleted successfully.";
            // Unset cookies
            setcookie("user_id", $user_data['id_user'], -(time() + (86400 * 30)));
            setcookie("user_email", $user_data['id_user'], -(time() + (86400 * 30)));
            setcookie("user_name", $user_data['id_user'], -(time() + (86400 * 30)));
            setcookie('login_error', '', time() - 3600, '/');
        } else {
            // No rows affected (user not found)
            echo "User not found or no data deleted.";
        }
    } else {
        // User ID is 1, cannot delete
        echo "Cannot delete user with ID 1.";
    }
    $stmt->close();
} else {
    // Invalid user_id or cookie not set
    echo "Invalid user_id or cookie not set.";
}

// Close database connection
$conn->close();
?>

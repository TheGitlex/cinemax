<?php
// Include database connection
include("database.php"); // Assuming your database connection script is named database.php

// Get code from POST data
$code = $_POST['code'] ?? '';

if (!empty($code)) {
    // Prepare and execute SQL to update the discounts table
    $stmt = $conn->prepare("UPDATE discounts SET active = 0, uses = uses + 1 WHERE code = ?");
    $stmt->bind_param("s", $code);
    $stmt->execute();

    // Check if any rows were affected
    if ($stmt->affected_rows > 0) {
        // Deactivation successful
        echo 'success';
    } else {
        // Code not found or unable to deactivate
        echo 'error: Unable to deactivate code';
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // Code not provided
    echo 'error: Code not provided';
}
?>

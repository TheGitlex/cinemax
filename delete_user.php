<?php

include("database.php"); 

if (isset($_POST['uid']) && is_numeric($_POST['uid'])) {
    $user_id = $_POST['uid'];

    if ($user_id != 1) {

        $stmt = $conn->prepare("DELETE FROM users WHERE id_user = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {

            echo "success"; 
        } else {

            echo "error: User not found or no data deleted."; 
        }
    } else {

        echo "error: Cannot delete user with ID 1."; 
    }
    $stmt->close();
} else {

    echo "error: Invalid user_id or parameter not set."; 
}

$conn->close();

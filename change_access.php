<?php

include("database.php"); 

    $user_id = $_COOKIE["user_id"];

    if ($user_id !== null && is_numeric($user_id)) {

        $stmt = $conn->prepare("UPDATE users SET access = 0 WHERE id_user = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {

            echo "success"; 
            include("logout.php");
        } else {

            echo "error: User not found or access level not changed."; 
        }
        $stmt->close();
    } else {

        echo "error: Invalid user_id."; 
    }


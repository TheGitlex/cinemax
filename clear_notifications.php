<?php
include("database.php");

// Check for the user_email cookie
$user_email = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : null;

if ($user_email) {
    // SQL query to get user information for the currently logged-in user
    $sql = "SELECT id_user FROM users WHERE email = '$user_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user information
        $row = $result->fetch_assoc();
        $userId = $row['id_user'];

        // Delete notifications for the user where release_date is in the past
        $delete_query = "DELETE FROM notifications WHERE id_user = $userId AND id_movie IN (SELECT id_movie FROM movies WHERE release_date < NOW())";
        $conn->query($delete_query);
    }
}
?>

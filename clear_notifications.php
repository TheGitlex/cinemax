<?php
include("database.php");

$user_email = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : null;

if ($user_email) {

    $sql = "SELECT id_user FROM users WHERE email = '$user_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $userId = $row['id_user'];

        $delete_query = "DELETE FROM notifications WHERE id_user = $userId AND id_movie IN (SELECT id_movie FROM movies WHERE release_date < NOW())";
        $conn->query($delete_query);
    }
}

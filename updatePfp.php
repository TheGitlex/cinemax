<?php
include("database.php");

$user_email = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user_email) {

    $sql = "SELECT * FROM users WHERE email = '$user_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_user = $row['id_user'];

        $imageURL = isset($_POST['imageURL']) ? $_POST['imageURL'] : '';

        if (!empty($imageURL)) {

            $updateSQL = "UPDATE users SET pfp = '$imageURL' WHERE id_user = $id_user";

            if ($conn->query($updateSQL)) {
                echo json_encode(['success' => true, 'imageURL' => $imageURL]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error updating database']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Image URL is empty']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

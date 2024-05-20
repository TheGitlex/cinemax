<?php
include("database.php");
$user_email = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $newFirstName = $_POST['newFirstName'];
    $newLastName = $_POST['newLastName'];
    $newPassword = $_POST['newPassword'];

    if (!empty($newFirstName) || !empty($newLastName) || !empty($newPassword)) {

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET ";
        $updates = array();
        if (!empty($newFirstName)) {
            $updates[] = "f_name='" . mysqli_real_escape_string($conn, $newFirstName) . "'";
        }
        if (!empty($newLastName)) {
            $updates[] = "l_name='" . mysqli_real_escape_string($conn, $newLastName) . "'";
        }
        if (!empty($newPassword)) {
            $updates[] = "password='" . mysqli_real_escape_string($conn, $hashedPassword) . "'";
        }
        $sql .= implode(", ", $updates);
        $sql .= " WHERE email='$user_email'";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(array("success" => true, "message" => "Profile updated successfully"));
        } else {
            echo json_encode(array("success" => false, "message" => "Error updating profile: " . $conn->error));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "No fields to update"));
    }

}

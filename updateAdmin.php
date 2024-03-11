<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $action = $_POST['action'];

    // Validate if email is not empty
    if (empty($email)) {
        echo "Please provide an email address.";
        exit();
    }

    // Check if the user exists
    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    if ($check_result && mysqli_num_rows($check_result) > 0) {
        // User exists, update the admin field
        $update_query = "UPDATE users SET admin = " . ($action === 'add' ? '1' : '0') . " WHERE email = '$email'";
        if (mysqli_query($conn, $update_query)) {
            echo "Admin status updated successfully.";
        } else {
            echo "Error updating admin status: " . mysqli_error($conn);
        }
    } else {
        echo "User with email '$email' not found.";
    }
} else {
    echo "Invalid request method.";
}
?>

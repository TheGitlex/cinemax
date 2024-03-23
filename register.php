<?php
include 'database.php';

$error = ''; // Initialize an empty string for the error message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $birth_date = mysqli_real_escape_string($conn, $_POST['birth_date']);

    // Perform password matching validation
    if ($password !== $confirm_password) {
        $error = "Паролите не съвпадат.";
    } else {
        // Check if the email already exists
        $check_query = "SELECT * FROM users WHERE email = '$email'";
        $check_result = mysqli_query($conn, $check_query);

        if ($check_result && mysqli_num_rows($check_result) > 0) {
            $error = "Изберете друг email.";
        } else {
            // Hash the password before storing in the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user data into the database
            $insert_query = "INSERT INTO users (f_name, l_name, email, password, birth, joined) VALUES ('$first_name', '$last_name', '$email', '$hashed_password', '$birth_date', NOW())";

            if (mysqli_query($conn, $insert_query)) {
                // Set cookies upon successful registration
                $user_id = mysqli_insert_id($conn);
                setcookie("user_id", $user_id, time() + (86400 * 30));
                setcookie("user_email", $email, time() + (86400 * 30));
                setcookie("user_name", $first_name, time() + (86400 * 30));

                // Redirect to main.php
                header('Location: main.php');
                exit();
            } else {
                $error = "Error: " . $insert_query . "<br>" . mysqli_error($conn);
            }
        }
    }
}

// Redirect to the registration page with an error message if applicable
$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'registerplace.php';
$errorString = !empty($error) ? 'error=' . urlencode($error) : '';
$url = $referrer . (strpos($referrer, '?') !== false ? '&' : '?') . $errorString;
header("Location: $url");
exit();
?>

<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch the user data from the database
    $query = "SELECT * FROM users WHERE email = '$email' AND access = 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user_data['password'])) {
            // Password is correct, proceed with login

            // Set persistent login cookies
            setcookie("user_id", $user_data['id_user'], time() + (86400 * 30));
            setcookie("user_email", $email, time() + (86400 * 30));
            setcookie("user_name", $user_data['f_name'], time() + (86400 * 30));

            header('Location: main.php');
            exit();
        }
    }

    // Display an error message for wrong email or password
    $error = "Грешен email или парола";
    header("Location: loginplace.php?error=" . urlencode($error));
    exit();
}
?>

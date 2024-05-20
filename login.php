<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' AND access = 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);

        if (password_verify($password, $user_data['password'])) {

            setcookie("user_id", $user_data['id_user'], time() + (86400 * 30));
            setcookie("user_email", $email, time() + (86400 * 30));
            setcookie("user_name", $user_data['f_name'], time() + (86400 * 30));

            header('Location: main.php');
            exit();
        }
    }

    $error = "Грешен email или парола";
    header("Location: loginplace.php?error=" . urlencode($error));
    exit();
}

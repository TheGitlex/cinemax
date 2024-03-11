<?php
include("database.php");

// Get user email from the cookie
$user_email = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : null;

// Get movie ID from the POST data
$movieId = isset($_POST['id_movie']) ? $_POST['id_movie'] : null;

if ($user_email && $movieId) {
    // SQL query to get user ID based on email
    $user_query = "SELECT id_user FROM users WHERE email = '$user_email'";
    $user_result = $conn->query($user_query);

    if ($user_result->num_rows > 0) {
        $user_row = $user_result->fetch_assoc();
        $user_id = $user_row['id_user'];

        // Check if the user has rated the specified movie
        $rating_query = "SELECT * FROM ratings WHERE id_user = $user_id AND id_movie = $movieId";
        $rating_result = $conn->query($rating_query);

        if ($rating_result->num_rows > 0) {
            // Delete the rating
            $delete_query = "DELETE FROM ratings WHERE id_user = $user_id AND id_movie = $movieId";
            if ($conn->query($delete_query) === TRUE) {
                echo "Rating deleted successfully";
            } else {
                echo "Error deleting rating: " . $conn->error;
            }
        } else {
            echo "User has not rated this movie";
        }
    } else {
        echo "User not found";
    }
} else {
    echo "User email or movie ID not provided";
}
?>

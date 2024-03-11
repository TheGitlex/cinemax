<?php
include("database.php");

$user_email = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : null;

if ($user_email && isset($_POST['rating']) && isset($_POST['id_movie'])) {
    $sql = "SELECT * FROM users WHERE email = '$user_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_user = $row['id_user']; // Assuming 'user_id' is the primary key

        // Get movie ID and user rating
        $id_movie = $_POST['id_movie'];
        $user_rating = $_POST['rating'];

        // Check if the movie release date is in the past
        $releaseDateSql = "SELECT release_date FROM movies WHERE id_movie = '$id_movie'";
        $releaseDateResult = $conn->query($releaseDateSql);

        if ($releaseDateResult->num_rows > 0) {
            $releaseDateRow = $releaseDateResult->fetch_assoc();
            $releaseDate = $releaseDateRow['release_date'];

            // Compare release date with current date
            if (strtotime($releaseDate) < time()) {
                // Release date is in the past, proceed with rating
                // Check if the user has already rated the movie
                $existingRatingSql = "SELECT * FROM ratings WHERE id_user = '$id_user' AND id_movie = '$id_movie'";
                $existingRatingResult = $conn->query($existingRatingSql);

                if ($existingRatingResult->num_rows > 0) {
                    // User has already rated the movie, update the existing rating
                    $updateSql = "UPDATE ratings SET rating_value = '$user_rating' WHERE id_user = '$id_user' AND id_movie = '$id_movie'";
                    $conn->query($updateSql);

                    echo "Rating updated successfully!";
                } else {
                    // User has not rated the movie, insert a new rating
                    $insertSql = "INSERT INTO ratings (id_user, id_movie, rating_value) VALUES ('$id_user', '$id_movie', '$user_rating')";
                    $conn->query($insertSql);

                    echo "Rating submitted successfully!";
                }
            } else {
                echo "Movie release date is in the future. You cannot rate the movie yet.";
            }
        } else {
            echo "Movie not found.";
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request.";
}

?>

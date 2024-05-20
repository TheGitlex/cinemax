<?php

include 'database.php';

$query = "INSERT INTO movies (title, genre, director, release_date, duration, description, trailer, icon, age_rating) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {

    mysqli_stmt_bind_param($stmt, "sssssssss", $title, $genre, $director, $release_date, $duration, $description, $trailer, $icon, $age_rating);

    $title = "Example Title";
    $genre = "Example Genre";
    $director = "Example Director";
    $release_date = "2023-11-17"; 
    $duration = "120"; 
    $description = "Example Description";
    $trailer = "Example Trailer";
    $icon = "Example Icon";
    $age_rating = "PG-13"; 

    if (mysqli_stmt_execute($stmt)) {
        $response = 'New movie added successfully';
    } else {
        $response = 'Failed to add new movie: ' . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    $response = 'Failed to prepare the statement: ' . mysqli_error($conn);
}

echo $response;

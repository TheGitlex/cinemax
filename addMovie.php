<?php
// Include your database connection code
include 'database.php';

// Prepare the SQL query with bind parameters
$query = "INSERT INTO movies (title, genre, director, release_date, duration, description, trailer, icon, age_rating) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);

// Check if the statement preparation is successful
if ($stmt) {
    // Bind values to the parameters
    mysqli_stmt_bind_param($stmt, "sssssssss", $title, $genre, $director, $release_date, $duration, $description, $trailer, $icon, $age_rating);

    // Set values for the parameters
    $title = "Example Title";
    $genre = "Example Genre";
    $director = "Example Director";
    $release_date = "2023-11-17"; // Replace with the actual release date
    $duration = "120"; // Replace with the actual duration
    $description = "Example Description";
    $trailer = "Example Trailer";
    $icon = "Example Icon";
    $age_rating = "PG-13"; // Replace with the actual age rating

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        $response = 'New movie added successfully';
    } else {
        $response = 'Failed to add new movie: ' . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    $response = 'Failed to prepare the statement: ' . mysqli_error($conn);
}

// Send the plain text response
echo $response;
?>

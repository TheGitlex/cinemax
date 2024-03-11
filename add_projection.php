<?php
// Assuming you have a database connection established
include("database.php");

// Retrieve form data
$idMovie = $_POST['idMovie'] ?? null;
$hour = $_POST['hour'] ?? null;
$date = $_POST['date'] ?? null;
$hall = $_POST['hall'] ?? null;

// Validate input values (you can add your own validation logic here)

// Insert new projection into the projections table
if ($idMovie && $hour && $date && $hall) {
    $query = "INSERT INTO projections (id_movie, time, date, id_hall) VALUES (?, ?, ?, ?)";
    $statement = $conn->prepare($query);
    $statement->bind_param('issi', $idMovie, $hour, $date, $hall);
    
    if ($statement->execute()) {
        // Projection inserted successfully
        echo 'Projection added successfully';
    } else {
        // Error occurred while inserting projection
        echo 'Error: Projection not added';
    }
} else {
    // Invalid input values
    echo 'Error: Invalid input values';
}
?>

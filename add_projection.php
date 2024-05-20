<?php

include("database.php");

$idMovie = $_POST['idMovie'] ?? null;
$hour = $_POST['hour'] ?? null;
$date = $_POST['date'] ?? null;
$hall = $_POST['hall'] ?? null;

if ($idMovie && $hour && $date && $hall) {
    $query = "INSERT INTO projections (id_movie, time, date, id_hall) VALUES (?, ?, ?, ?)";
    $statement = $conn->prepare($query);
    $statement->bind_param('issi', $idMovie, $hour, $date, $hall);

    if ($statement->execute()) {

        echo 'Projection added successfully';
    } else {

        echo 'Error: Projection not added';
    }
} else {

    echo 'Error: Invalid input values';
}

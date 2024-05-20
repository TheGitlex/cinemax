<?php

include 'database.php';

$searchTerm = $_GET['term'];

$query = "SELECT id_movie, title,icon FROM movies WHERE title LIKE '%$searchTerm%' AND active=1 AND release_date < CURRENT_DATE";
$result = mysqli_query($conn, $query);

$searchResults = array();
while ($row = mysqli_fetch_assoc($result)) {
    $searchResults[] = array(
        'id' => $row['id_movie'],
        'icon' => $row['icon'],
        'title' => $row['title']
    );
}

echo json_encode($searchResults);
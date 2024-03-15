<?php
// Include your database connection code
include 'database.php';

// Get the search term from the AJAX request
$searchTerm = $_GET['term'];

// Perform a search in the movies table based on the title
$query = "SELECT id_movie, title,icon FROM movies WHERE title LIKE '%$searchTerm%' AND active=1 AND release_date < CURRENT_DATE";
$result = mysqli_query($conn, $query);

// Return the results as JSON
$searchResults = array();
while ($row = mysqli_fetch_assoc($result)) {
    $searchResults[] = array(
        'id' => $row['id_movie'],
        'icon' => $row['icon'],
        'title' => $row['title']
    );
}

echo json_encode($searchResults);

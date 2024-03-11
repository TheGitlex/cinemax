<?php
include 'database.php'; // Include your database connection file

// Fetch the next upcoming movie from the database
$sql = "SELECT title, release_date, icon, active, id_movie FROM movies WHERE release_date > NOW() AND active=1 ORDER BY release_date LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nextMovie = array(
        'title' => $row['title'],
        'releaseDate' => $row['release_date'],
        'icon' => $row['icon'],
        'id' => $row['id_movie']
    );
    echo json_encode($nextMovie);
} else {
    // No upcoming movies
    echo json_encode(null);
}

// Close the database connection
$conn->close();
?>

<?php
include 'database.php'; 

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
    echo json_encode(null);
}

$conn->close();


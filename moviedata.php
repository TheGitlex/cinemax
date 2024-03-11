<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$movieId = 1;

$sql = "SELECT * FROM movies ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $genre =$row['genre'];
    $director =$row['director'];
    $duration =$row['duration'];
    $trailer = $row['trailer'];
    $description = $row['description'];
    $icon =$row['icon'];
    $age_rating =$row['age_rating'];
    $release_date =$row['release_date'];
    
} else {
    echo "0 results";
}
?>



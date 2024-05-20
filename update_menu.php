<?php include("database.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_movie = $_POST["id_movie"];
    $status = $_POST["status"];

    $sql = "UPDATE movies SET active = $status WHERE id_movie = $id_movie";

    if ($conn->query($sql) === TRUE) {
        echo "Update successful";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();



<?php
include 'database.php';
$formData = $_POST;

$id_movie = $formData['id_movie'];

$updates = array();
foreach ($formData as $key => $value) {
    if ($key === 'id_movie' || empty($value)) {
        continue;
    }

    $value = mysqli_real_escape_string($conn, $value); // Escape values to prevent SQL injection

    $updates[] = "$key = '$value'";
}

$updatesString = implode(", ", $updates);

$query = "UPDATE movies SET " . $updatesString . " WHERE id_movie = $id_movie";

if (mysqli_query($conn, $query)) {
    $response = ['status' => 'success', 'message' => 'Movie updated successfully'];
} else {
    $response = ['status' => 'error', 'message' => 'Failed to update movie'];
}

echo json_encode($response);



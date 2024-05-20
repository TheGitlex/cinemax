<?php

include 'database.php';

$userId = $_COOKIE['user_id'] ?? null;

$data = json_decode(file_get_contents('php://input'), true);

$movieId = $data['movieId'] ?? null;
$projectionId = $data['projection'] ?? null;
$price = $data['price'] ?? null;
$seatNumbers = $data['seatNumbers'] ?? null;
$time = $data['time'] ?? null;
$date = $data['date'] ?? null;
$hall = $data['hall'] ?? null;

if ($userId && $movieId && $projectionId && $price && $seatNumbers) {

    $query = "SELECT COUNT(*) AS num_booked_seats FROM tickets WHERE id_projection = ? AND seat_number IN (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $projectionId, $seatNumbers);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $numBookedSeats = $row['num_booked_seats'];

    if ($numBookedSeats > 0) {

        http_response_code(400);
        echo "Error: Selected seats are already booked.";
    } else {

        $stmt = $conn->prepare("INSERT INTO tickets (id_user, id_movie, id_projection, price, seat_number, purchase_date) VALUES (?, ?, ?, ?, ?, NOW()) ");

        $stmt->bind_param("iiiss", $userId, $movieId, $projectionId, $price, $seatNumbers);
        if ($stmt->execute()) {

            header("Location: confirm.php");
            exit(); 
        } else {

            http_response_code(500);
        }
    }

    $stmt->close();
} else {

    http_response_code(400);
}

$conn->close();
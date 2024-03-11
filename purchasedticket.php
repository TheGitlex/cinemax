<?php
// Include database connection
include 'database.php';

// Get user ID from COOKIE[id_user]
$userId = $_COOKIE['user_id'] ?? null;

// Get data sent from JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// Extract data
$movieId = $data['movieId'] ?? null;
$projectionId = $data['projection'] ?? null;
$price = $data['price'] ?? null;
$seatNumbers = $data['seatNumbers'] ?? null;
$time = $data['time'] ?? null;
$date = $data['date'] ?? null;
$hall = $data['hall'] ?? null;

// Check if all necessary data is available
if ($userId && $movieId && $projectionId && $price && $seatNumbers) {
    // Check if selected seats are already booked for this projection
    $query = "SELECT COUNT(*) AS num_booked_seats FROM tickets WHERE id_projection = ? AND seat_number IN (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $projectionId, $seatNumbers);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $numBookedSeats = $row['num_booked_seats'];

    if ($numBookedSeats > 0) {
        // Some seats are already booked, handle accordingly (e.g., show error message)
        http_response_code(400);
        echo "Error: Selected seats are already booked.";
    } else {
        // No booked seats found, proceed with insertion
        $stmt = $conn->prepare("INSERT INTO tickets (id_user, id_movie, id_projection, price, seat_number, purchase_date) VALUES (?, ?, ?, ?, ?, NOW()) ");
        // Bind parameters and execute the statement
        $stmt->bind_param("iiiss", $userId, $movieId, $projectionId, $price, $seatNumbers);
        if ($stmt->execute()) {
            // Data inserted successfully
            // Redirect to confirm.php
            header("Location: confirm.php");
            exit(); // Stop script execution after the redirect
        } else {
            // Error inserting data
            http_response_code(500);
        }
    }

    // Close statement
    $stmt->close();
} else {
    // Missing parameters
    http_response_code(400);
}

// Close database connection
$conn->close();

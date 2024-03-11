<?php
include("database.php");

// Get the movie ID and user ID from the AJAX request
$movieId = $_POST['movieId'];
$userId = $_POST['userId'];

// Check if the user is already subscribed for notifications for this movie
$checkSubscriptionSql = "SELECT * FROM notifications WHERE id_user = $userId AND id_movie = $movieId";
$subscriptionResult = $conn->query($checkSubscriptionSql);

if ($subscriptionResult->num_rows > 0) {
    // User is already subscribed, so delete the notification record (unsubscribe)
    $deleteNotificationSql = "DELETE FROM notifications WHERE id_user = $userId AND id_movie = $movieId";
    $conn->query($deleteNotificationSql);

    // Send a success response back to the client
    echo json_encode(['success' => true, 'action' => 'unsubscribe', 'message' => 'Unsubscribed successfully']);
} else {
    // User is not subscribed, so insert a new notification record (subscribe)
    $insertNotificationSql = "INSERT INTO notifications (id_user, id_movie, notif_date) VALUES ($userId, $movieId, (SELECT release_date FROM movies WHERE id_movie = $movieId))";
    $conn->query($insertNotificationSql);

    // Send a success response back to the client
    echo json_encode(['success' => true, 'action' => 'subscribe', 'message' => 'Subscribed successfully']);
}
?>

<?php
include("database.php");

$movieId = $_POST['movieId'];
$userId = $_POST['userId'];

$checkSubscriptionSql = "SELECT * FROM notifications WHERE id_user = $userId AND id_movie = $movieId";
$subscriptionResult = $conn->query($checkSubscriptionSql);

if ($subscriptionResult->num_rows > 0) {

    $deleteNotificationSql = "DELETE FROM notifications WHERE id_user = $userId AND id_movie = $movieId";
    $conn->query($deleteNotificationSql);

    echo json_encode(['success' => true, 'action' => 'unsubscribe', 'message' => 'Unsubscribed successfully']);
} else {

    $insertNotificationSql = "INSERT INTO notifications (id_user, id_movie, notif_date) VALUES ($userId, $movieId, (SELECT release_date FROM movies WHERE id_movie = $movieId))";
    $conn->query($insertNotificationSql);

    echo json_encode(['success' => true, 'action' => 'subscribe', 'message' => 'Subscribed successfully']);
}

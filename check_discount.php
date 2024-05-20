<?php

include("database.php"); 

$code = $_POST['code'] ?? '';

if (!empty($code)) {

    $stmt = $conn->prepare("UPDATE discounts SET active = 0, uses = uses + 1 WHERE code = ?");
    $stmt->bind_param("s", $code);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {

        echo 'success';
    } else {

        echo 'error: Unable to deactivate code';
    }

    $stmt->close();
    $conn->close();
} else {

    echo 'error: Code not provided';
}

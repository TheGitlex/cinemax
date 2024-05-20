<?php
include("database.php");

header('Content-Type: application/json');

$query = "SELECT code, amount FROM discounts WHERE active = 1";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(['error' => 'Database error']);
    exit;
}

$validCodes = [];
$discountAmounts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $validCodes[] = $row['code'];
    $discountAmounts[$row['code']] = $row['amount'];
}

$data = json_decode(file_get_contents('php://input'), true);

$isValid = validateCode($data['code'], $validCodes);

if ($isValid) {
    $discountAmount = $discountAmounts[$data['code']] ?? 0; 
    echo json_encode(['valid' => true, 'discountAmount' => $discountAmount]);
} else {
    echo json_encode(['valid' => false]);
}

function validateCode($enteredCode, $validCodes) {
    return in_array($enteredCode, $validCodes);
}

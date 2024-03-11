<?php
include("database.php");

header('Content-Type: application/json');

// Fetch code and discount amount from the database
$query = "SELECT code, amount FROM discounts WHERE active = 1";
$result = mysqli_query($conn, $query);

// Check for errors in the database query
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

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

// Validate the entered code
$isValid = validateCode($data['code'], $validCodes);

// Send a JSON response with discount amount (if valid)
if ($isValid) {
    $discountAmount = $discountAmounts[$data['code']] ?? 0; // Default to 0 if code not found
    echo json_encode(['valid' => true, 'discountAmount' => $discountAmount]);
} else {
    echo json_encode(['valid' => false]);
}

function validateCode($enteredCode, $validCodes) {
    return in_array($enteredCode, $validCodes);
}
?>

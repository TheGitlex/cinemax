<?php

include("database.php");

// Handle the addition of a discount
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);

    // Check if the code already exists
    $check_sql = "SELECT * FROM discounts WHERE code = '$code'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Code already exists, update its status
        $update_sql = "UPDATE discounts SET active = 1, amount = '$amount' WHERE code = '$code'";

        if ($conn->query($update_sql) === TRUE) {
            // Success
            echo "Discount already exists, status updated";
        } else {
            // Error
            echo "Error updating discount status: " . $conn->error;
        }
    } else {
        // Code does not exist, insert new discount
        $insert_sql = "INSERT INTO discounts (code, amount, active) VALUES ('$code', '$amount', 1)";
        if ($conn->query($insert_sql) === TRUE) {
            // Success
            echo "Discount added successfully";
        } else {
            // Error
            echo "Error adding discount: " . $conn->error;
        }
    }
} else {
    // Request method is not POST
    echo "Invalid request method";
}

?>

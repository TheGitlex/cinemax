<?php

include("database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);

    $check_sql = "SELECT * FROM discounts WHERE code = '$code'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {

        $update_sql = "UPDATE discounts SET active = 1, amount = '$amount' WHERE code = '$code'";

        if ($conn->query($update_sql) === TRUE) {

            echo "Discount already exists, status updated";
        } else {

            echo "Error updating discount status: " . $conn->error;
        }
    } else {

        $insert_sql = "INSERT INTO discounts (code, amount, active) VALUES ('$code', '$amount', 1)";
        if ($conn->query($insert_sql) === TRUE) {

            echo "Discount added successfully";
        } else {

            echo "Error adding discount: " . $conn->error;
        }
    }
} else {

    echo "Invalid request method";
}


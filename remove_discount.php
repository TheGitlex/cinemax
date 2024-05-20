<?php

include("database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $code = mysqli_real_escape_string($conn, $_POST['code']);

    $sql = "UPDATE discounts SET active = 0 WHERE code = '$code'";

    if ($conn->query($sql) === TRUE) {

        echo "Discount removed successfully";
    } else {

        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {

    echo "Invalid request method";
}


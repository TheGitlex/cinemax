<?php

include("database.php");

// Handle the removal of a discount
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $code = mysqli_real_escape_string($conn, $_POST['code']);

    // Update active field to 0 in the database for the specified code
    $sql = "UPDATE discounts SET active = 0 WHERE code = '$code'";

    if ($conn->query($sql) === TRUE) {
        // Success
        echo "Discount removed successfully";
    } else {
        // Error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Request method is not POST
    echo "Invalid request method";
}

?>

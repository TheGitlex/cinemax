<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'emailer/src/Exception.php';
require 'emailer/src/PHPMailer.php';
require 'emailer/src/SMTP.php';

// Get data sent from JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// Extract data
$movieId = $data['movieId'] ?? null;
$time = $data['time'] ?? null;
$date = $data['date'] ?? null;
$seatNumbers = $data['seatNumbers'] ?? null;
$price = $data['price'] ?? null;
$hall = $data['hall'] ?? null;

// Function to send email
function sendEmail($movieId, $time, $date, $hall, $seatNumbers, $price) {
    // Include database connection
    include 'database.php';

    // Fetch movie title based on movie ID
    $movieTitle = '';
    $sql = "SELECT title FROM movies WHERE id_movie = $movieId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $movieTitle = $row['title'];
        }
    }

    // Get recipient email from cookie
    $recipientEmail = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : '';

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 2; // Enable verbose debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'alexiliev111@gmail.com'; // SMTP username
        $mail->Password = 'ttim nafm lpfn mzhf'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        // Recipients
        $mail->setFrom('cinemax@gmail.com', 'Cinemax');
        $mail->addAddress($recipientEmail, ''); // Add a recipient from the cookie

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->CharSet = 'UTF-8'; // Set charset to UTF-8
        $mail->Encoding = 'base64'; // Set encoding to base64
        $mail->Subject = '=?UTF-8?B?' . base64_encode('Потвърждение за билет') . '?='; // Subject with Bulgarian text

        // Construct email body with movie details, selected seats, and price
        $mail->Body = "Филм: $movieTitle<br> От: $time<br>На: $date <br>Зала: $hall <br>Място: " . implode(', ', explode(',', $seatNumbers)) . "<br><br>Платено: $price лв ";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // Send the email
        // $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
}

// Call the sendEmail function with the provided data
sendEmail($movieId, $time, $date, $hall, $seatNumbers, $price);


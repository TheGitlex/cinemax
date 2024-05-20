<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'emailer/src/Exception.php';
require 'emailer/src/PHPMailer.php';
require 'emailer/src/SMTP.php';

$data = json_decode(file_get_contents('php://input'), true);

$movieId = $data['movieId'] ?? null;
$time = $data['time'] ?? null;
$date = $data['date'] ?? null;
$seatNumbers = $data['seatNumbers'] ?? null;
$price = $data['price'] ?? null;
$hall = $data['hall'] ?? null;

function sendEmail($movieId, $time, $date, $hall, $seatNumbers, $price) {
    include 'database.php';

    $movieTitle = '';
    $sql = "SELECT title FROM movies WHERE id_movie = $movieId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $movieTitle = $row['title'];
        }
    }

    $recipientEmail = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : '';

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
        $mail->setFrom('alexiliev111@gmail.com', 'Cinemax');
        $mail->addAddress($recipientEmail, ''); // Add a recipient from the cookie

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->CharSet = 'UTF-8'; // Set charset to UTF-8
        $mail->Encoding = 'base64'; // Set encoding to base64
        $mail->Subject = '=?UTF-8?B?' . base64_encode('Потвърждение за билет') . '?='; // Subject with Bulgarian text

        $mail->Body = "
    <b>Филм:</b> $movieTitle <br>
    <b>Час:</b> $time<br>
    <b>Дата:</b> $date<br>
    <b>Зала:</b> $hall<br>
    <b>Място:</b> " . implode(', ', explode(',', $seatNumbers)) . "<br>
    <hr>
    <b>Платено:</b> $price лв
    <p><img src='https://files.catbox.moe/y2sr5h.jpg'></p>
";

        $mail->AltBody = 'Билет';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
}

sendEmail($movieId, $time, $date, $hall, $seatNumbers, $price);


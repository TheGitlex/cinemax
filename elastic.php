<?php
$api_key = "400008FC35305583894BAB3202EE5F6EF87D05B9DAF1354046EBBBAFAF0E27FE192E117A6796205CF1F095FE14097BBC";

// Email data
$from = "alexiliev111@gmail.com";
$to = "alexiliev111@gmail.com";
$subject = "Test Email";
$message = "This is a test email sent from PHP using Elastic Email.";

// API URL
$url = "https://api.elasticemail.com/v2/email/send";

// Prepare data for POST request
$post = [
    'from' => $from,
    'to' => $to,
    'subject' => $subject,
    'body' => $message,
    'apikey' => $api_key
];

// Initialize cURL
$ch = curl_init($url);

// Set the POST request options
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the request
$response = curl_exec($ch);

// Check for errors
if(curl_errno($ch)){
    echo 'Error: ' . curl_error($ch);
}

// Close cURL session
curl_close ($ch);

// Print response
echo $response;
?>

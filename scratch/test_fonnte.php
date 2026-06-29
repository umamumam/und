<?php
$phone = '085799352991'; // Phone number from your Fonnte screenshot
$message = 'Test koneksi Fonnte API';
$token = 'ymdNLoxUvzaz3X1Vx625';

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.fonnte.com/send',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => array(
        'target' => $phone,
        'message' => $message,
    ),
    CURLOPT_HTTPHEADER => array(
        'Authorization: ' . $token
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

echo "=== Fonnte API Test ===\n";
if ($err) {
    echo "CURL ERROR: " . $err . "\n";
} else {
    echo "RESPONSE: " . $response . "\n";
}

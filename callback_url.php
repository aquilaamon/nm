<?php
// Set header to application/json for M-PESA
header("Content-Type: application/json");

// Prepare response for M-PESA confirmation
$response = json_encode([
    "ResultCode" => 0,
    "ResultDesc" => "Confirmation Received Successfully"
]);

// Get M-PESA response data
$mpesaResponse = file_get_contents('php://input');

// Log the response (for debugging and tracking)
$logFile = "M_PESAConfirmationResponse.txt";
$log = fopen($logFile, "a");
fwrite($log, $mpesaResponse);
fclose($log);

// Send response back to M-PESA
echo $response;
?>

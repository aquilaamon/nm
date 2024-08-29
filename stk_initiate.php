<?php
if (isset($_POST['submit'])) {
    date_default_timezone_set('Africa/Nairobi');

    // Access token details
    $consumerKey = 'SoAfRQGBR4PLA1NRyk8b3tQZOmYAGImRBQiq7oGKa6cOwK1x';
    $consumerSecret = 'jwIm8SKA3jpDyAgqRQlBAjbJHi5A6tgZfwEmCEXB4czzUeiLFGCgAwlhB1F4aMRg';

    // Define the necessary variables
    $BusinessShortCode = '174379';
    $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
    $PartyA = $_POST['phone'];
    $AccountReference = '2255';
    $TransactionDesc = 'Donation Payment';
    $Amount = $_POST['amount'];

    // Get the timestamp in the required format
    $Timestamp = date('YmdHis');

    // Generate the password
    $Password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);

    // Get the access token
    $headers = ['Content-Type:application/json; charset=utf8'];
    $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    
    $curl = curl_init($access_token_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_HEADER, FALSE);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
    $result = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $result = json_decode($result);
    $access_token = $result->access_token;
    curl_close($curl);

    // Initiate the STK Push
    $stkheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];
    $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    
    $curl_post_data = array(
        'BusinessShortCode' => $BusinessShortCode,
        'Password' => $Password,
        'Timestamp' => $Timestamp,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $Amount,
        'PartyA' => $PartyA,
        'PartyB' => $BusinessShortCode,
        'PhoneNumber' => $PartyA,
        'CallBackURL' => 'localhost/NASHA/donate.php/callback_url.php', // Use your domain or Heroku URL
        'AccountReference' => $AccountReference,
        'TransactionDesc' => $TransactionDesc
    );

    $data_string = json_encode($curl_post_data);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $initiate_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    $curl_response = curl_exec($curl);
    
    if($curl_response === FALSE){
        echo 'Curl error: ' . curl_error($curl);
    }
    
    curl_close($curl);
    
    echo $curl_response; // You can print this for debugging or handle it otherwise
}
?>

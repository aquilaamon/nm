<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $reset_code = rand(100000, 999999); // Generate a 6-digit random code

    // Store the reset code in the database
    $query = "INSERT INTO password_resets (email, reset_code) VALUES ('$email', '$reset_code')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Prepare the email content
        $subject = "Your Password Reset Code";
        $message = "Dear user,\n\nHere is your password reset code: $reset_code\n\nPlease enter this code on the password reset page to reset your password.\n\nBest regards,\nYour Website Team";
        $headers = "From: no-reply@yourwebsite.com";

        // Send the email
        if (mail($email, $subject, $message, $headers)) {
            echo "A password reset code has been sent to your email address.";
        } else {
            echo "There was a problem sending the email. Please try again later.";
        }
    } else {
        echo "There was a problem storing the reset code. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #f8c6d4, #f0e1f5);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .reset-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .reset-container h1 {
            color: #333;
            margin-bottom: 20px;
        }
        .reset-container label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }
        .reset-container input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .reset-container button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #6a1b29;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .reset-container button:hover {
            background-color: #4a0c17;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h1>Request Password Reset</h1>
        <form method="POST" action="reset_password.php">
            <label for="email">Enter your email:</label>
            <input type="email" name="email" id="email" required>
            <button type="submit">Request Reset Code</button>
        </form>
    </div>
</body>
</html>

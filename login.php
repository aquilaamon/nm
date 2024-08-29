<?php
session_start();
include 'db.php';

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login_username']) && isset($_POST['login_password'])) {
    $username = $_POST['login_username'];
    $password = md5($_POST['login_password']);

    $query = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $login_error = "Invalid username or password";
    }
}

// Handle password reset code request (for login form)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_request_email'])) {
    $email = $_POST['reset_request_email'];
    
    // Generate a reset code
    $reset_code = rand(100000, 999999);
    
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
            header("Location: verify_code.php?email=" . urlencode($email));
            exit();
        } else {
            $reset_error = "There was a problem sending the email. Please try again later.";
        }
    } else {
        $reset_error = "There was a problem storing the reset code. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Reset Password</title>
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
        .container {
            display: flex;
            justify-content: space-between;
            width: 80%;
            max-width: 1000px;
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 45%;
            text-align: center;
        }
        .form-container h1 {
            color: #333;
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }
        .form-container input[type="text"],
        .form-container input[type="password"],
        .form-container input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .form-container button {
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
        .form-container button:hover {
            background-color: #4a0c17;
        }
        .error-message,
        .success-message {
            color: red;
            margin-top: 10px;
        }
        .success-message {
            color: green;
        }
        .forgot-links {
            margin-top: 15px;
        }
        .forgot-links a {
            color: #6a1b29;
            text-decoration: none;
        }
        .forgot-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container" id="login-form">
            <h1>Login</h1>
            <form method="POST" action="login.php">
                <label for="login_username">Username:</label>
                <input type="text" name="login_username" id="login_username" required>
                
                <label for="login_password">Password:</label>
                <input type="password" name="login_password" id="login_password" required>
                
                <button type="submit">Login</button>
                <?php if (isset($login_error)): ?>
                    <div class="error-message"><?php echo $login_error; ?></div>
                <?php endif; ?>
            </form>
            <div class="forgot-links">
                <p><a href="#" onclick="showResetForm()">Forgot Password?</a></p>
            </div>
        </div>

        <div class="form-container" id="reset-form" style="display:none;">
            <h1>Request Password Reset</h1>
            <form method="POST" action="login.php">
                <label for="reset_request_email">Enter your email:</label>
                <input type="email" name="reset_request_email" id="reset_request_email" required>
                
                <button type="submit">Request Reset Code</button>
                <?php if (isset($reset_error)): ?>
                    <div class="error-message"><?php echo $reset_error; ?></div>
                <?php endif; ?>
            </form>
            <div class="forgot-links">
                <p><a href="#" onclick="showLoginForm()">Back to Login</a></p>
            </div>
        </div>
    </div>

    <script>
        function showResetForm() {
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('reset-form').style.display = 'block';
        }

        function showLoginForm() {
            document.getElementById('reset-form').style.display = 'none';
            document.getElementById('login-form').style.display = 'block';
        }
    </script>
</body>
</html>

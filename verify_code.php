<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $reset_code = $_POST['reset_code'];
    $new_password = md5($_POST['new_password']); // Hash the new password

    // Check if the reset code is valid
    $query = "SELECT * FROM password_resets WHERE email='$email' AND reset_code='$reset_code'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Update the password in the database
        $update_query = "UPDATE admins SET password='$new_password' WHERE email='$email'";
        if (mysqli_query($conn, $update_query)) {
            // Remove the reset code from the database
            $delete_query = "DELETE FROM password_resets WHERE email='$email' AND reset_code='$reset_code'";
            mysqli_query($conn, $delete_query);

            header("Location: reset_success.php");
            exit();
        } else {
            $error = "There was a problem updating the password.";
        }
    } else {
        $error = "Invalid reset code.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Reset Code</title>
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
        .reset-container input[type="text"],
        .reset-container input[type="password"] {
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
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h1>Verify Reset Code</h1>
        <form method="POST" action="verify_code.php">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">

            <label for="reset_code">Reset Code:</label>
            <input type="text" name="reset_code" id="reset_code" required>
            
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password" required>
            
            <button type="submit">Reset Password</button>
            <?php if (isset($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>

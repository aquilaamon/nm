<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $company = htmlspecialchars($_POST['company']);
    $subject = htmlspecialchars($_POST['subject']);
    $question = htmlspecialchars($_POST['question']);

    // Recipient email
    $to = "nashaministries@gmail.com";

    // Subject of the email
    $mailSubject = "New Contact Form Submission: " . $subject;

    // Email content
    $message = "Name: $name\n";
    $message .= "Phone Number: $phone\n";
    $message .= "Email: $email\n";
    $message .= "Subject: $subject\n\n";
    $message .= "Question:\n$question";

    // Headers
    $headers = "From: $email";

    // Send email
    if (mail($to, $mailSubject, $message, $headers)) {
        // Success message
        echo "Thank you! Your message has been sent.";
    } else {
        // Failure message
        echo "Sorry, there was a problem sending your message. Please try again later.";
    }
}
?>

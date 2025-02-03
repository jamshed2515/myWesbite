<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If using Composer, otherwise include PHPMailer manually

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $visitor_email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate email format
    if (!filter_var($visitor_email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email address!'); window.history.back();</script>";
        exit;
    }

    $mail = new PHPMailer(true);
    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP Server
        $mail->SMTPAuth = true;
        $mail->Username = 'sheikhjamshed789@gmail.com'; // Your Gmail address
        $mail->Password = 'rune ggrg ygic hlna';  // Your Gmail App Password here
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Details
        $mail->setFrom('sheikhjamshed789@gmail.com', 'Bright Future Academy'); // Your Gmail Address
        $mail->addAddress('sheikhjamshed789@gmail.com'); // The recipient email address (your email)
        $mail->addReplyTo($visitor_email, $name); // Reply-to address (user's email)

        // Email Content
        $mail->isHTML(false); // Plain text email
        $mail->Subject = "New Contact Form Submission: $subject";
        $mail->Body = "User Name: $name\n".
                      "User Email: $visitor_email\n".
                      "Subject: $subject\n\n".
                      "Message:\n$message\n";

        // Send Email
        $mail->send();
        echo "<script>alert('Message sent successfully!'); window.location.href='contact.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Error: {$mail->ErrorInfo}'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.history.back();</script>";
}
?>

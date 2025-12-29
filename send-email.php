<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if(isset($_POST['submit'])) {

    // Sanitize form input
    $name    = strip_tags(trim($_POST['name']));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = nl2br(htmlspecialchars(trim($_POST['message'])));

    // Validate input
    if(empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        echo "<script>alert('Please fill in all fields correctly.'); window.history.back();</script>";
        exit;
    }

    // Email recipients
        // $recipients = [
        //     'vivek_m@fyndsol.com',
        //     'sainath_g@fyndsol.com'
        // ];


    $recipients = [
        'mohan1973cm@gmail.com'
    ];

    // Email subject
    $subject = "New Inquiry from {$name} [FyndSol Contact Form]";

    // Email body (HTML)
    $body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; }
            .header { background: #002A61; color: #fff; padding: 15px; text-align: center; }
            .content { padding: 15px; border: 1px solid #eee; }
            .label { font-weight: bold; color: #002A61; }
        </style>
    </head>
    <body>
        <div class='header'><h2>New Contact Form Inquiry</h2></div>
        <div class='content'>
            <p><span class='label'>Name:</span> {$name}</p>
            <p><span class='label'>Email:</span> {$email}</p>
            <p><span class='label'>Message:</span><br>{$message}</p>
        </div>
    </body>
    </html>";

    // PHPMailer setup
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.yourdomain.com'; // Replace with your SMTP host
        $mail->SMTPAuth   = true;
        $mail->Username   = 'reshmamcse2021@jerusalemengg.ac.in'; // SMTP email
        $mail->Password   = 'MReshmadeepika';   // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('webmaster@fyndsol.com', 'FyndSol Webmaster');
        foreach($recipients as $recipient) {
            $mail->addAddress($recipient);
        }
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        echo "<script>alert('Thank you! Your message has been sent successfully.'); window.location.href='contact.html';</script>";

    } catch (Exception $e) {
        echo "<script>alert('Mailer Error: {$mail->ErrorInfo}'); window.history.back();</script>";
    }

} else {
    header("Location: contact.html");
    exit;
}
?>

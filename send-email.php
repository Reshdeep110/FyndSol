<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require __DIR__ . '/PHPMailer/Exception.php';
require __DIR__ . '/PHPMailer/PHPMailer.php';
require __DIR__ . '/PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

   
    $name    = strip_tags(trim($_POST['name'] ?? ''));
    $email   = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST['message'] ?? '');

   
    if (empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        echo "<script>alert('Please fill all fields correctly'); window.history.back();</script>";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
       
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

       
        $mail->Username   = 'reshma@fyndsol.com';    
        $mail->Password   = 'zrxa ymgm xkmf lhat';    
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

       
        $mail->setFrom('reshma@fyndsol.com', 'FyndSol Website Contact');
        
       
        $mail->addAddress('vivek_m@fyndsol.com');
        $mail->addAddress('sainath_g@fyndsol.com');
       
        $mail->addReplyTo($email, $name);

     
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Message – $name";

        $mail->Body = "
            <h3>New Contact Form Submission</h3>
            <p><b>Name:</b> {$name}</p>
            <p><b>Email:</b> {$email}</p>
            <p><b>Message:</b><br>" . nl2br(htmlspecialchars($message)) . "</p>
        ";

        $mail->AltBody = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        $mail->send();

        echo "<script>
                alert('Message sent successfully! Thank you for Reaching us.');
                window.location.href = 'contact.html';
              </script>";

    } catch (Exception $e) {
        echo "<script>
                alert('Mailer Error: {$mail->ErrorInfo}');
                window.history.back();
              </script>";
    }

} else {
    header("Location: contact.html");
    exit;
}
?>
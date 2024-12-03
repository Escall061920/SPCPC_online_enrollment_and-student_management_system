<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; 

function generateOTP() {
    return rand(100000, 999999); // Generates a 6-digit OTP
}

function sendOTPEmail($email, $otp) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Use Gmail's SMTP server or any other SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'spcpc2017ph@gmail.com'; // Your Gmail address or SMTP username
        $mail->Password   = 'vkjy hafe vfcg dhrq';  // Your Gmail password or SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('spcpc2017ph@gmail.com', 'SPCPC');
        $mail->addAddress($email); // Recipient's email address

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Your Password Reset OTP';
        $mail->Body    = "Your OTP is: $otp. It expires in 15 minutes.";

        $mail->send();
        echo 'OTP has been sent to your email.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function sendOTPSMS($contact_number, $otp) {
    // Placeholder function for SMS sending
    echo "SMS function is not implemented yet.";
}
?>

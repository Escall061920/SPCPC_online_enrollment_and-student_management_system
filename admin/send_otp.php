<?php
require_once("../include/initialize.php");
require_once("otp_functions.php"); // Custom file for sending email/SMS

// First create the password_resets table if it doesn't exist
$create_table_sql = "CREATE TABLE IF NOT EXISTS password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    otp VARCHAR(6) NOT NULL,
    expires_at DATETIME NOT NULL,
    is_used TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$mydb->setQuery($create_table_sql);
$mydb->executeQuery();

if (isset($_POST['email_or_contact'])) {
    $input = $_POST['email_or_contact'];
    $otp = generateOTP(); // Function to generate a 6-digit OTP
    $expiry_time = date('Y-m-d H:i:s', strtotime('+15 minutes')); // OTP expires in 15 minutes
    
    // Store the OTP in the database
    $sql = "INSERT INTO password_resets (email, otp, expires_at) VALUES ('$input', '$otp', '$expiry_time')";
    $mydb->setQuery($sql);
    $mydb->executeQuery();

    // Send OTP via email or SMS
    sendOTPEmail($input, $otp); // Custom function to send OTP via email
    sendOTPSMS($input, $otp);   // Custom function to send OTP via SMS

    // Redirect to OTP entry page
    header("Location: verify_otp.php?email=" . urlencode($input));
    exit();

    echo "OTP has been sent to your gmail.";
}
?>

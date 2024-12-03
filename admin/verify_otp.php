<?php
require_once("../include/initialize.php");
require_once("otp_functions.php"); // Custom file for sending email/SMS

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $otp = $_POST['otp'];

    // Query to find the OTP for the given email that has not expired and has not been used
    $sql = "SELECT * FROM password_resets WHERE email = '$email' AND otp = '$otp' AND expires_at > NOW() AND is_used = 0";
    $mydb->setQuery($sql);
    $result = $mydb->loadSingleResult(); // Adjusted method based on your previous code

    if ($result) {
        // OTP is valid
        echo "OTP is valid!";

        // Mark OTP as used
        $update_sql = "UPDATE password_resets SET is_used = 1 WHERE id = '{$result->id}'";
        $mydb->setQuery($update_sql);
        $mydb->executeQuery();

        // Redirect to the password reset page
        header("Location: reset_password.php");
        exit(); // Ensure no further code is executed
    } else {
        // OTP is invalid or expired
        echo "Invalid or expired OTP.";
    }
} else {
    echo '
    <div class="notification-banner">
        <p>OTP has been sent, please check your Gmail inbox.</p>
    </div>
    ';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <style>
        body {
            background-color: #098744;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .login-form {
            margin-top: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form[role="login"] {
            color: #5d5d5d;
            background: #accbb2;
            padding: 26px;
            border-radius: 10px;
            -moz-border-radius: 10px;
            -webkit-border-radius: 10px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        form[role="login"] img {
            display: block;
            margin: 0 auto;
            margin-bottom: 35px;
            height: 90px;
            border-radius: 100%;
        }

        form[role="login"] input,
        form[role="login"] button {
            font-size: 18px;
            margin: 16px 0;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form[role="login"] button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        form[role="login"] button:hover {
            background-color: #45a049;
        }

        /* Placeholder styling */
        input::placeholder {
            font-size: 18px;
            color: #5d5d5d;
        }

        .form-links {
            text-align: center;
            margin-top: 1em;
            margin-bottom: 50px;
        }

        .form-links a {
            color: #fff;
            text-decoration: none;
        }
        .notification-banner {
    background-color: #4CAF50; /* Green background */
    color: white; /* White text */
    text-align: center; /* Center the text */
    padding: 15px; /* Padding around the text */
    border-radius: 5px; /* Rounded corners */
    margin: 20px 0; /* Space above and below the banner */
    font-size: 25px; /* Font size */
    position: relative; /* For absolute positioning of any close button */
    z-index: 1000; /* Ensure it appears above other content */
}

.notification-banner p {
    margin: 0; /* Remove default margin */
}

    </style>
</head>
<body>
    <div class="login-form">
        <form method="post" action="reset_password.php" role="login">
            <img src="../img/SPCPC.ico" alt="Logo">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

            <label for="otp">Enter OTP:</label>
            <input type="text" name="otp" id="otp" placeholder="Enter OTP" required>
            <button type="submit">Verify OTP</button>

            <div class="form-links">
                <a href="login.php">Back to login</a>
            </div>
        </form>
    </div>
</body>
</html>

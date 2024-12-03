<?php
require_once("../include/initialize.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted email and new password
    $email = $_POST['email'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $otp = $_POST['otp'] ? $_POST['otp'] : null;
   
    if (!$otp == null) {
        $sql = "SELECT * FROM password_resets WHERE email = '$email' AND otp = '$otp' AND expires_at > NOW() AND is_used = 0";
        $mydb->setQuery($sql);
        $result = $mydb->loadSingleResult(); // Adjusted method based on your previous code

        // Debugging output

        if ($result) {
            // OTP is valid
            echo "OTP is valid!";

            // Optionally, mark OTP as used
            $update_sql = "UPDATE password_resets SET is_used = 1 WHERE id = '{$result->id}'";
            $mydb->setQuery($update_sql);
            $mydb->executeQuery();

            // Redirect to the password reset page
             header("Location: reset_password.php");
            exit(); // Ensure no further code is executed
        } else {
            // OTP is invalid or expired

        }
    }
    
} else {
    // If the request method is not POST, show an error
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background-color: #098744;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .reset-form {
            margin-top: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form[role="reset"] {
            background-color: #accbb2;
            padding: 26px;
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            color: #5d5d5d;
        }


        form[role="reset"] img {
            display: block;
            margin: 0 auto;
            margin-bottom: 35px;
            height: 90px;
            border-radius: 100%;
        }

        form[role="reset"] input,
        form[role="reset"] button {
            font-size: 18px;
            margin: 16px 0;
            padding: 10px;
            width: 95%;
            border-radius: 10px;
            border: 1px solid #ccc;
        }

        form[role="reset"] button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        form[role="reset"] button:hover {
            background-color: #45a049;
        }

        input::placeholder {
            font-size: 18px;
            color: #5d5d5d;
        }
    </style>
</head>

<body>
    <div class="reset-form">
        <form method="post" action="password_reset.php" role="reset" onsubmit="return validatePassword()" >
        <img src="../img/SPCPC.ico" alt="Logo">
            <h2>Reset Your Password</h2>
            <input type="hidden" name="email" value="joerenzescallente027@gmail.com"> <!-- Replace with dynamic email -->

            <label for="new_password">New Password:</label>
            <div style="position: relative;">
                <input type="password" name="new_password" id="new_password" placeholder="Enter New Password" required>
                <i class="fas fa-eye" id="eye-icon" onclick="togglePasswordVisibility()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
            </div>

            <button type="submit">Reset Password</button>
        </form>
    </div>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('new_password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash'); // Change icon to indicate password is visible
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye'); // Change back to eye icon
            }
        }

        function validatePassword() {
            const password = document.getElementById('new_password').value;
            const specialCharPattern = /[!@#$%^&*(),.?":{}|<>=]/g;

            if (specialCharPattern.test(password)) {
                alert("Password must not contain special characters. Only Numbers, Letters and characters of Underscore and Dash are allowed");
                return false;
            }
            return true;
        }
    </script>
</body>


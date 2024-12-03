<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
    </style>
</head>
<body>
    <div class="login-form">
        <form method="post" action="send_otp.php" role="login">
            <img src="../img/SPCPC.ico" alt="Logo">
            <label for="email"></label>
            <input type="text" name="email_or_contact" id="email" placeholder="Enter your Email " required>
            <button type="submit">Send OTP</button>
            <div class="form-links">
                <a href="login.php">Back to login</a>
            </div>
        </form>
    </div>
</body>
</html>

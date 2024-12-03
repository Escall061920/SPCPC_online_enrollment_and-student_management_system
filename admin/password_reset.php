<?php
require_once("../include/initialize.php");
$mydb = new PDO('mysql:host=localhost;dbname=dbgreenvalley', 'root', '');
$mydb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    echo $email??"test"; 
    if (empty($email) || empty($new_password)) {
        echo "Email and new password are required.";
        exit;
    }

    // Hash the new password
    // $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    $hashed_password = sha1($new_password);

    // Update the password in the database
    // Changed 'email' column to 'ACCOUNT_USERNAME' since that appears to be the correct column name
    $sql = "UPDATE useraccounts SET ACCOUNT_PASSWORD = :password WHERE ACCOUNT_USERNAME = :email";
    $stmt = $mydb->prepare($sql);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':email', $email);

    if ($stmt->execute()) {
        echo "Password has been reset successfully.";
        // Optionally redirect to a login page or another page
        header("Location: login.php");
        exit();
    } else {
        echo "Failed to update password.";
    }
} else {
    // If the request method is not POST, show an error
    echo "Invalid request.";
}
?>

<script>
    function validatePassword() {
        const passwordInput = document.getElementById('new_password').value;
        const regex = /^[a-zA-Z0-9_-]+$/;
        if (!regex.test(passwordInput)) {
            alert("Invalid password. Only alphanumeric characters, underscores, and dashes are allowed.");
            return false; // Prevent form submission if validation fails
        }
        return true; // Allow form submission if validation passes
    }
</script>

<?php
require_once("../include/initialize.php");

if (isset($_POST['email']) && isset($_POST['new_password'])) {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];

    // Validate inputs
    if (empty($email) || empty($new_password)) {
        echo "Email and new password are required.";
        exit;
    }
    // gumagana ba tong file na to?
    // Hash the new password using password_hash()
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    // Update password in the users table
    $sql = "UPDATE users SET password = :password WHERE email = :email";
    $stmt = $mydb->prepare($sql);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':email', $email);

    if ($stmt->execute()) {
        echo "Your password has been successfully updated!";
    } else {
        echo "Failed to update password.";
    }
}
?>

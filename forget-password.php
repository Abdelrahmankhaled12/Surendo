<?php
require "db_connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["email"])) {
    $email = $_POST["email"];
    $mail = new PHPMailer(true);

    // Generate a random 10-character password
    $password = substr(bin2hex(random_bytes(5)), 0, 10);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the user exists with the given email
    $sql = 'SELECT * FROM users WHERE `email` = ?';
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // If no user is found with this email
    if ($result->num_rows === 0) {
        die("No user found with this email.");
    }

    // User exists, update the password
    $updateSql = 'UPDATE users SET `password` = ? WHERE `email` = ?';
    $updateStmt = $conn->prepare($updateSql);

    if (!$updateStmt) {
        die("Failed to prepare update statement: " . $conn->error);
    }

    $updateStmt->bind_param("ss", $hashedPassword, $email);
    if ($updateStmt->execute()) {

        $mail->isSMTP();
        $mail->Host = 'mail.surendo.com';
        $mail->SMTPAuth = true;
        $mail->Username = '';
        $mail->Password = '';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('office@surendo.com');
        $mail->addAddress($_POST["email"]);
        $mail->isHTML(true);
        $mail->Subject = 'Surendo reset password mail';
        $mail->Body =
            '
                <div style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; border: 1px solid #ddd; border-radius: 10px; max-width: 500px; margin: 0 auto;">
                    <h2 style="color: #4CAF50; text-align: center;">Password Reset Successful!</h2>
                    <p style="font-size: 16px; color: #333; text-align: center;">
                        Your new password is:
                    </p>
                    <p style="font-size: 24px; color: #FF5722; font-weight: bold; text-align: center;">
                        ' . htmlspecialchars($password) . '
                    </p>
                    <p style="font-size: 14px; color: #777; text-align: center;">
                        Please keep this password safe and consider changing it after logging in.
                    </p>
                </div>
            ';
        $mail->send();

        $_SESSION['password-reset'] = 'Password reset mail sent successfully.';
        header('Location: password.php');
    } else {
        die("Failed to update password: " . $updateStmt->error);
    }

    // Close statements
    $stmt->close();
    $updateStmt->close();
} else {
    die("Must send email!");
}

// Close database connection
$conn->close();

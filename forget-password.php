<?php
require "db_connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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
        $mail->Username = 'office@surendo.com';
        $mail->Password = '(Gxtb9Me51Xq';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('service@surendo.com');
        $mail->addAddress($_POST["email"]);
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8'; // Sicherstellen, dass UTF-8 verwendet wird
        // Betreff der E-Mail
        $mail->Subject = 'Surendo.com – Ihr Passwort wurde erfolgreich geändert – Sie können sich jetzt anmelden';
        $mail->Body =
        // Inhalt der E-Mail
            '
                <div style="font-family: Arial, sans-serif; background-color: #cfe9ee7c; padding: 20px; border: 0px; border-radius: 12px; max-width: 500px; margin: 0 auto;">
                    <h2 style="color: #113388; text-align: center;">Ihr neues Passwort wurde erfolgreich erstellt</h2>
                    <p style="font-size: 16px; color: #333; text-align: center;">
                        Ihr neues Passwort lautet:
                    </p>
                    <p style="font-size: 24px; color: #333; font-weight: bold; text-align: center;">
                        ' . htmlspecialchars($password) . '
                    </p>
                    <p style="font-size: 14px; color: #333; text-align: center;">
                        Bitte bewahren Sie dieses Passwort sicher auf.
                    </p>
                </div>
            ';
        $mail->send();

        $_SESSION['password-reset'] = 'Bitte rufen Sie Ihre E-Mails ab.';
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

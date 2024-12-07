<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}// Session starten

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Datenbankverbindung einbinden
require 'db_connection.php'; // Stellt die Verbindung zu $conn her

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST["email"])
        &&
        isset($_POST["password"])
    ) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Query to fetch the user by email
        $sql = "SELECT `id`, `email`, `password` FROM `users` WHERE `email`=?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param('s', $email);
        if (!$stmt->execute()) {
            $stmt->close();
            die("Error executing query: " . $stmt->error);
        }

        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, hash: $user["password"])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION["logged_in"] = true;
                header("Location: http://localhost/Surendo/home.php");
                exit();
            } else {
                die('Invalid password. Please try again.');
            }
        } else {
            die('No user found with this email');
        }

        $stmt->close();
    } else {
        die("Email and password are required.");
    }
} else {
    die("Invalid request method.");
}


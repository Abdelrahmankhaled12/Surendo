<?php
require "db_connection.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["form_id"])) {
    $form_id = $_SESSION["form_id"];

    $sql = "SELECT * FROM `pv_plants` WHERE `id` = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param('i', $form_id);

    if (!$stmt->execute()) {
        $stmt->close();
        die("Error executing statement: " . $stmt->error);
    }
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $result = $result->fetch_assoc();
    } else {
        echo "No record found with the provided form_id.";
    }

    $stmt->close();
} else {
    die("No form_id provided in the session.");
}

?>
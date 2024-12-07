<?php
require "db_connection.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["form_id"])) {
    $completed = 1;
    $formId = $_POST["form_id"];

    $sql = 'UPDATE `pv_plants` SET `is_completed` = ? WHERE `id` = ?';
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing UPDATE statement: " . $conn->error);
    }

    $stmt->bind_param('ii', $completed, $formId);

    if (!$stmt->execute()) {
        $stmt->close();
        die("Error executing UPDATE statement: " . $stmt->error);
    }

    if ($stmt->affected_rows > 0) {
        header("Location: http://localhost/Surendo/home.php");
    } else {
        die("No record was updated. Please check if the ID exists.");
    }

    // Close the statement
    $stmt->close();
} else {
    die("No form_id provided in the GET request.");
}

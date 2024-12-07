<?php
require "db_connection.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["user_id"])) {
    $sql = 'SELECT * FROM `pv_plants` WHERE `user_id` = ? ORDER BY `is_completed` ASC';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_SESSION["user_id"]);
    if (!$stmt->execute()) {
        $stmt->close();
        die("Error executing SELECT statement: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $stmt->close();
} else {
    die('you must log in first!');
}

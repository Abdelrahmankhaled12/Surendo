<?php
// Alle Fehler anzeigen, um Debugging zu erleichtern
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verbindung zur MySQL-Datenbank herstellen
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "surendo";

// Verbindung herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
}

// Optional: Zeichensatz auf UTF-8 setzen, um Sonderzeichen zu unterstützen
$conn->set_charset("utf8");
?>

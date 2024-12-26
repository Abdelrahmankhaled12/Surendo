<?php
require "db_connection.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Datenbankverbindung einbinden
require 'db_connection.php'; // Stellt die Verbindung zu $conn her

$sql = 'SELECT * FROM `pv_plants` WHERE `id` = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $_POST['form_id']);
if (!$stmt->execute()) {
    $stmt->close();
    die("Error executing SELECT statement: " . $stmt->error);
}

$form = $stmt->get_result()->fetch_assoc();

// Funktion zur sicheren Konvertierung von Eingaben in Dezimalwerte
function convertToDecimal($value)
{
    if (!is_numeric(str_replace(',', '.', $value))) {
        return 0.00; // Standardwert, falls ungültige Eingabe
    }
    return number_format((float)str_replace(',', '.', $value), 2, '.', '');
}
// Daten aus dem Formular abrufen
$id = $_POST['form_id']; // ID to identify which record to update
$applicant = $_POST['applicant'] ?? $form['applicant'];
$street = $_POST['street'] ?? $form['street'];
$postalcode = $_POST['postalcode'] ?? $form['postalcode'];
$place = $_POST['place'] ?? $form['place'];
$applicant_email = $_POST['applicant_email'] ?? $form['applicant_email'];

$relation_to_plant = $_POST['relation_to_plant'] ?? $form['relation_to_plant'];
$owner_name = $_POST['owner_name'] ?? $form['owner_name'];
$owner_street = $_POST['owner_street'] ?? $form['owner_street'];
$owner_postalcode = $_POST['owner_postalcode'] ?? $form['owner_postalcode'];
$owner_place = $_POST['owner_place'] ?? $form['owner_place'];

$operator_name = $_POST['operator_name'] ?? $form['operator_name'];
$operator_street = $_POST['operator_street'] ?? $form['operator_street'];
$operator_postalcode = $_POST['operator_postalcode'] ?? $form['operator_postalcode'];
$operator_place = $_POST['operator_place'] ?? $form['operator_place'];
$address_or_coordinates = $_POST['address_or_coordinates'] ?? $form['address_or_coordinates'];

$address_street = $_POST['address_street'] ?? $form['address_street'];
$address_postalcode = $_POST['address_postalcode'] ?? $form['address_postalcode'];
$address_place = $_POST['address_place'] ?? $form['address_place'];
$coordinates = $_POST['coordinates'] ?? $form['coordinates'];
$insured_land = $_POST['insured_land'] ?? $form['insured_land'];

$name_other_land = $_POST['name_other_land'] ?? $form['name_other_land'];
$applicant_share_50 = $_POST['applicant_share_50'] ?? $form['applicant_share_50'];
$water = $_POST['water'] ?? $form['water'];
$hagelregister = $_POST['hagelregister'] ?? $form['hagelregister'];
$in_operation = $_POST['in_operation'] ?? $form['in_operation'];

$shadowed = $_POST['shadowed'] ?? $form['shadowed'];
$tracker = $_POST['tracker'] ?? $form['tracker'];
$ground_condition = $_POST['ground_condition'] ?? $form['ground_condition'];

$panel_manufacturer = $_POST['panel_manufacturer'] ?? $form['panel_manufacturer'];
$panel_type = $_POST['panel_type'] ?? $form['panel_type'];
$panel_amount = $_POST['panel_amount'] ?? $form['panel_amount'];
$output_per_panel = convertToDecimal($_POST['output_per_panel'] ?? $form['output_per_panel']);
$output_total = convertToDecimal($_POST['output_total'] ?? $form['output_total']);
$area = convertToDecimal($_POST['area'] ?? $form['area']);

$inverter_manufacturer = $_POST['inverter_manufacturer'] ?? $form['inverter_manufacturer'];
$inverter_type = $_POST['inverter_type'] ?? $form['inverter_type'];

$inverter_amount = $_POST['inverter_amount'] ?? $form['inverter_amount'];
$output_per_inverter = convertToDecimal($_POST['output_per_inverter'] ?? $form['output_per_inverter']);

$eur_panels = convertToDecimal($_POST['eur_panels'] ?? $form['eur_panels']);
$eur_inverter = convertToDecimal($_POST['eur_inverter'] ?? $form['eur_inverter']);
$eur_transformer = convertToDecimal($_POST['eur_transformer'] ?? $form['eur_transformer']);
$eur_supporting_structure = convertToDecimal($_POST['eur_supporting_structure'] ?? $form['eur_supporting_structure']);
$eur_video = convertToDecimal($_POST['eur_video'] ?? $form['eur_video']);
$eur_fence = convertToDecimal($_POST['eur_fence'] ?? $form['eur_fence']);
$eur_miscellaneous = convertToDecimal($_POST['eur_miscellaneous'] ?? $form['eur_miscellaneous']);

$date_commencement = $_POST['date_commencement'] ?? $form['date_commencement'];

$business_interruption = $_POST['business_interruption'] ?? $form['business_interruption'];
$BI_annual_feed = $_POST['business_interruption'] == 'Nien' ? $_POST['BI_annual_feed'] : 0;
$BI_feed_in_tariff = $_POST['business_interruption'] == 'Nien' ? $_POST['BI_feed_in_tariff'] : 0;

$self_consumption = $_POST['self_consumption'] ?? $form['self_consumption'];
$BI_annual_self_consumption = $_POST["self_consumption"] == 'Nien' ? $_POST['BI_annual_self_consumption'] : 0;
$BI_self_consumption_tariff = $_POST["self_consumption"] == 'Nien' ? $_POST['BI_self_consumption_tariff'] : 0;

$isCompleted = isset($_POST["completed"]) ? '1' : '0';

// Validate if ID is provided
if (!$id) {
    die("No ID provided for the update.");
}

// Update SQL query
$sql = "UPDATE `pv_plants` 
        SET `applicant` = ?, `street` = ?, `postalcode` = ?, `place` = ?, `tracker` = ?, 
            `relation_to_plant` = ?, `owner_name` = ?, `owner_street` = ?, `owner_postalcode` = ?, 
            `owner_place` = ?, `operator_name` = ?, `operator_street` = ?, `operator_postalcode` = ?, 
            `operator_place` = ?, `address_or_coordinates` = ?, `address_street` = ?, 
            `address_postalcode` = ?, `address_place` = ?, `coordinates` = ?, `insured_land` = ?, 
            `name_other_land` = ?, `applicant_share_50` = ?, `water` = ?, `hagelregister` = ?, 
            `in_operation` = ?, `shadowed` = ?, `ground_condition` = ?,`panel_manufacturer` = ?,
            `panel_type` = ?, `panel_amount` = ?, `output_per_panel` = ?, 
            `output_total` = ?, `area` = ?, `inverter_manufacturer` = ?, `inverter_type` = ?, 
            `inverter_amount` = ?, `output_per_inverter` = ?, `eur_panels` = ?, `eur_inverter` = ?, 
            `eur_transformer` = ?, `eur_supporting_structure` = ?, `eur_video` = ?, `eur_fence` = ?, 
            `eur_miscellaneous` = ?, `date_commencement` = ?, `business_interruption` = ?, 
            `BI_annual_feed` = ?, `BI_feed_in_tariff` = ?, `BI_annual_self_consumption` = ?, 
            `BI_self_consumption_tariff` = ?, `self_consumption` = ?, `is_completed` = ? 
        WHERE `id` = ?";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Fehler bei der SQL-Vorbereitung: " . $conn->error);
}

if (!$stmt->bind_param(
    "ssssssssssssssssssssssssssssssssssssssssssssssssssssi",
    $applicant,
    $street,
    $postalcode,
    $place,
    $tracker,
    $relation_to_plant,
    $owner_name,
    $owner_street,
    $owner_postalcode,
    $owner_place,
    $operator_name,
    $operator_street,
    $operator_postalcode,
    $operator_place,
    $address_or_coordinates,
    $address_street,
    $address_postalcode,
    $address_place,
    $coordinates,
    $insured_land,
    $name_other_land,
    $applicant_share_50,
    $water,
    $hagelregister,
    $in_operation,
    $shadowed,
    $ground_condition,
    $panel_manufacturer,
    $panel_type,
    $panel_amount,
    $output_per_panel,
    $output_total,
    $area,
    $inverter_manufacturer,
    $inverter_type,
    $inverter_amount,
    $output_per_inverter,
    $eur_panels,
    $eur_inverter,
    $eur_transformer,
    $eur_supporting_structure,
    $eur_video,
    $eur_fence,
    $eur_miscellaneous,
    $date_commencement,
    $business_interruption,
    $BI_annual_feed,
    $BI_feed_in_tariff,
    $BI_annual_self_consumption,
    $BI_self_consumption_tariff,
    $self_consumption,
    $isCompleted,
    $id
)) {
    die("Fehler beim Binden der Parameter: " . $stmt->error);
}

if ($stmt->execute()) {
    $_SESSION['success_message'] = "Daten erfolgreich aktualisiert.";
    session_write_close();
    header("Location: home.php");
    exit();
} else {
    die("Fehler beim Aktualisieren der Daten: " . $stmt->error);
}

$stmt->close();
$conn->close();

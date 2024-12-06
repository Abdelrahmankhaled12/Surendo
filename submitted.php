<?php
session_start(); // Session starten

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Datenbankverbindung einbinden
require 'db_connection.php'; // Stellt die Verbindung zu $conn her

// Funktion zur sicheren Konvertierung von Eingaben in Dezimalwerte
function convertToDecimal($value) {
    if (!is_numeric(str_replace(',', '.', $value))) {
        return 0.00; // Standardwert, falls ungültige Eingabe
    }
    return number_format((float)str_replace(',', '.', $value), 2, '.', '');
}

// Daten aus dem Formular abrufen
$applicant = $_POST['applicant'] ?? '';
$street = $_POST['street'] ?? '';
$postalcode = $_POST['postalcode'] ?? '';
$place = $_POST['place'] ?? '';
$applicant_email = $_POST['applicant_email'] ?? '';

$relation_to_plant = $_POST['relation_to_plant'] ?? '';
$owner_name = $_POST['owner_name'] ?? '';
$owner_street = $_POST['owner_street'] ?? '';
$owner_postalcode = $_POST['owner_postalcode'] ?? '';
$owner_place = $_POST['owner_place'] ?? '';

$operator_name = $_POST['operator_name'] ?? '';
$operator_street = $_POST['operator_street'] ?? '';
$operator_postalcode = $_POST['operator_postalcode'] ?? '';
$operator_place = $_POST['operator_place'] ?? '';
$address_or_coordinates = $_POST['address_or_coordinates'] ?? '';

$address_street = $_POST['address_street'] ?? '';
$address_postalcode = $_POST['address_postalcode'] ?? '';
$address_place = $_POST['address_place'] ?? '';
$coordinates = $_POST['coordinates'] ?? '';
$insured_land = $_POST['insured_land'] ?? '';

$name_other_land = $_POST['name_other_land'] ?? '';
$applicant_share_50 = $_POST['applicant_share_50'] ?? '';
$water = $_POST['water'] ?? '';
$hagelregister = $_POST['hagelregister'] ?? '';
$in_operation = $_POST['in_operation'] ?? '';

$shadowed = $_POST['shadowed'] ?? '';
$tracker = $_POST['tracker'] ?? '';
$ground_condition = $_POST['ground_condition'] ?? '';

$panel_manufacturer = $_POST['panel_manufacturer'] ?? '';
$panel_type = $_POST['panel_type'] ?? '';
$panel_amount = $_POST['panel_amount'] ?? 0;
$output_per_panel = convertToDecimal($_POST['output_per_panel'] ?? '');
$output_total = convertToDecimal($_POST['output_total'] ?? '');
$area = convertToDecimal($_POST['area'] ?? '');

$inverter_manufacturer = $_POST['inverter_manufacturer'] ?? '';
$inverter_type = $_POST['inverter_type'] ?? '';

$inverter_amount = $_POST['inverter_amount'] ?? 0;
$output_per_inverter = convertToDecimal($_POST['output_per_inverter'] ?? '');

$eur_panels = convertToDecimal($_POST['eur_panels'] ?? '');
$eur_inverter = convertToDecimal($_POST['eur_inverter'] ?? '');
$eur_transformer = convertToDecimal($_POST['eur_transformer'] ?? '');
$eur_supporting_structure = convertToDecimal($_POST['eur_supporting_structure'] ?? '');
$eur_video = convertToDecimal($_POST['eur_video'] ?? '');
$eur_fence = convertToDecimal($_POST['eur_fence'] ?? '');
$eur_miscellaneous = convertToDecimal($_POST['eur_miscellaneous'] ?? '');

$date_commencement = $_POST['date_commencement'] ?? null;

$business_interruption = $_POST['business_interruption'] ?? '';
$BI_annual_feed = $_POST['BI_annual_feed'] ?? '';
$BI_feed_in_tariff = $_POST['BI_feed_in_tariff'] ?? '';
$BI_annual_self_consumption = $_POST['BI_annual_self_consumption'] ?? '';
$BI_self_consumption_tariff = $_POST['BI_self_consumption_tariff'] ?? '';
$self_consumption = $_POST['self_consumption'] ?? '';


if (!empty($date_commencement)) {
    $today = date('Y-m-d'); // Aktuelles Datum im Format YYYY-MM-DD

    // Prüfen, ob das Datum das korrekte Format hat (nur als Fallback-Schutz)
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date_commencement)) {
        // Prüfen, ob das Datum nicht in der Vergangenheit liegt
        if ($date_commencement < $today) {
            die("Das Datum darf nicht in der Vergangenheit liegen.");
        }
        // Gültiges Datum, kann verwendet werden
    } else {
        die("Das eingegebene Datum ist ungültig.");
    }
} else {
    die("Das Datum des Versicherungsbeginns ist erforderlich.");
}


// Debugging: Prüfen, ob die POST-Daten vorhanden sind
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($applicant) || empty($street) || empty($postalcode) || empty($place) || empty($applicant_email) || empty($relation_to_plant)) {
        die("Alle erforderlichen Felder müssen ausgefüllt werden.");
    }

    if ($relation_to_plant === 'operator_foreign_plant') {
        if (empty($owner_name) || empty($owner_street) || empty($owner_postalcode) || empty($owner_place)) {
            die("Alle erforderlichen Felder für den Eigentümer müssen ausgefüllt werden.");
        }
    } elseif ($relation_to_plant === 'owner_only') {
        if (empty($operator_name) || empty($operator_street) || empty($operator_postalcode) || empty($operator_place)) {
            die("Alle erforderlichen Felder für den Betreiber müssen ausgefüllt werden.");
        }
    }

    // SQL-Statement erweitern
    $sql = "INSERT INTO pv_plants (applicant, street, postalcode, place, applicant_email, relation_to_plant, owner_name, owner_street, owner_postalcode, owner_place, operator_name, operator_street, operator_postalcode, operator_place, address_or_coordinates, address_street, address_postalcode, address_place, coordinates, insured_land, name_other_land, applicant_share_50, water, hagelregister, in_operation, shadowed, tracker, ground_condition, panel_manufacturer, panel_type, panel_amount, output_per_panel, output_total, area, inverter_manufacturer, inverter_type, inverter_amount, output_per_inverter, eur_panels, eur_inverter, eur_transformer, eur_supporting_structure, eur_video, eur_fence, eur_miscellaneous, date_commencement, business_interruption, BI_annual_feed, BI_feed_in_tariff, BI_annual_self_consumption, BI_self_consumption_tariff, self_consumption) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Fehler bei der SQL-Vorbereitung: " . $conn->error);
    }

    if (!$stmt->bind_param("ssssssssssssssssssssssssssssssssssssssssssssssssssss", 
        $applicant, $street, $postalcode, $place, $applicant_email, $relation_to_plant, 
        $owner_name, $owner_street, $owner_postalcode, $owner_place, $operator_name, 
        $operator_street, $operator_postalcode, $operator_place, $address_or_coordinates, 
        $address_street, $address_postalcode, $address_place, $coordinates, $insured_land, 
        $name_other_land, $applicant_share_50, $water, $hagelregister, $in_operation, 
        $shadowed, $tracker, $ground_condition, $panel_manufacturer, $panel_type, 
        $panel_amount, $output_per_panel, $output_total, $area, $inverter_manufacturer, 
        $inverter_type, $inverter_amount, $output_per_inverter, $eur_panels, $eur_inverter, 
        $eur_transformer, $eur_supporting_structure, $eur_video, $eur_fence, $eur_miscellaneous, 
        $date_commencement, $business_interruption, $BI_annual_feed, $BI_feed_in_tariff, $BI_annual_self_consumption, $BI_self_consumption_tariff, $self_consumption)) {
        die("Fehler beim Binden der Parameter: " . $stmt->error);
    }

    if ($stmt->execute()) {
        $last_id = $conn->insert_id;
        $_SESSION['success_message'] = "Daten erfolgreich übermittelt. Ihre Eintrags-ID lautet: <strong>$last_id</strong>";
        
        // Session speichern und schließen
        session_write_close();
        
        // Weiterleitung zur Startseite
        header("Location: index.php");
        exit();
    } else {
        die("Fehler beim Einfügen der Daten: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>

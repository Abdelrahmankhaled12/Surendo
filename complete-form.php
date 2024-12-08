<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST["form_id"])) {
    $_SESSION["form_id"] = $_POST["form_id"];
    require "form-data.php";
    // print_r($result);
    // die();
} else {
    die("No Form exists in the request.");
}
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Allrisk-Versicherung Photovoltaikanlagen - Neuer Antrag</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <div class="icons-container">
        <a href="login.php" class="login-link">
            <button class="login-btn">
                <i class="fa-regular fa-user"></i>
            </button>
        </a>
    </div>

    <img src="./gfx/Logo_clean_Pfad_Randlos_BIG.jpg" alt="Image" />
    <br>

    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    } // Session starten

    // Erfolgsnachricht anzeigen, falls vorhanden
    if (isset($_SESSION['success_message'])) {
        echo "<div class='center'>"; // Container für die Erfolgsnachricht
        echo "<p>" . $_SESSION['success_message'] . "</p>";
        echo "</div>"; // Ende des Containers
        unset($_SESSION['success_message']); // Lösche die Nachricht nach der Anzeige
    }
    ?>
    <br>


    <form method="post" action="update-form.php">
        <input type="text" hidden name="form_id" value="<?php echo $result["id"] ?>">
        <div class="box_headline">
            <h1>Allrisk- inkl. Ertragsausfallversicherung <br>für Photovoltaikanlagen</h1>
        </div>

        <br>

        <hr class="blue-line"> <!-- Blaue Linie eingefügt -->

        <div>
            <h2>1. Antragsteller/in (Versicherungsnehmer/in)</h2>
        </div>

        <label class="label-classic">Firmenname</label>
        <input type="text" name="applicant" value="<?php echo $result["applicant"] ?>" required>
        <br>
        <label class="label-classic">Straße und Hausnummer</label>
        <input type="text" name="street" value="<?php echo $result["street"] ?>" required>
        <br>
        <label class="label-classic">Postleitzahl</label>
        <input type="text" name="postalcode" value="<?php echo $result["postalcode"] ?>" maxlength="8" required>
        <br>
        <label class="label-classic">Ort</label>
        <input type="text" name="place" value="<?php echo $result["place"] ?>" required>
        <br>
        <!-- <label class="label-classic">E-Mail</label>
        <input type="email" name="applicant_email" value="" required> -->
        <!-- Validierung ob es sich um eine echte E-Mail-Adresse handelt, wird aufgrund HTML5 durchgeführt. -->
        <br>
        <br>

        <!-- Radiobutton für Anschrift des Antragstellers (applicant) -->
        <div class="subsection"><b>Antragsteller/in im Verhältnis zur Anlage</b></div>

        <!-- Toggle-Buttons JA/NEIN -->
        <input type="radio" id="option1" name="relation_to_plant" value="operator_owner" <?php echo $result["relation_to_plant"] == "operator_owner" ? 'checked' : '' ?>>
        <!-- name ist der DB-Parameter -->
        <label for="option1" class="toggle-label">Betreiber & Eigentümer</label>

        <input type="radio" id="option2" name="relation_to_plant" value="operator_foreign_plant" <?php echo $result["relation_to_plant"] == "operator_foreign_plant" ? 'checked' : '' ?>>
        <label for="option2" class="toggle-label">Betreiber einer fremden Anlage</label>

        <input type="radio" id="option3" name="relation_to_plant" value="owner_only" <?php echo $result["relation_to_plant"] == "owner_only" ? 'checked' : '' ?>>
        <label for="option3" class="toggle-label">Nur Eigentümer</label>
        <br><br>


        <!-- Wenn der Radiobutton 2 "Betreiber/in einer fremden Anlage" gewählt ist, dann wird eingeblendet... -->
        <div class="toggle-content-applicant content-operator-foreign-plant">
            <div class="relation_to_plant_style"><label><b>Eigentümer/in der Anlage</b> (keine automatische
                    Mitversicherung - diese muss unter Abschnitt Mitversicherung beantragt werden)</label></div>
            <br>
            <label class="label-classic">Firmenname</label>
            <input type="text" name="owner_name" id="owner_name" value="<?php echo $result["owner_name"] ?>">
            <br>
            <label class="label-classic">Straße und Hausnummer</label>
            <input type="text" name="owner_street" value="<?php echo $result["owner_street"] ?>" id="owner_street">
            <br>
            <label class="label-classic">Postleitzahl</label>
            <input type="text" name="owner_postalcode" value="<?php echo $result["owner_postalcode"] ?>" id="owner_postalcode" maxlength="8">
            <br>
            <label class="label-classic">Ort</label>
            <input type="text" name="owner_place" value="<?php echo $result["owner_place"] ?>" id="owner_place">
            <br><br>
        </div>

        <!-- Wenn der Radiobutton 3 "Nur Eigentümer" gewählt ist, dann wird eingeblendet... -->
        <div class="toggle-content-applicant content-owner-only">

            <div class="relation_to_plant_style"><label><b>Betreiber/in der Anlage</b> (keine automatische
                    Mitversicherung - diese muss unter Abschnitt Mitversicherung beantragt werden)</label></div>
            <br>
            <label class="label-classic">Firmenname</label>
            <input type="text" name="operator_name" value="<?php echo $result["operator_name"] ?>" id="operator_name">
            <br>
            <label class="label-classic">Straße und Hausnummer</label>
            <input type="text" name="operator_street" value="<?php echo $result["operator_street"] ?>" id="operator_street">
            <br>
            <label class="label-classic">Postleitzahl</label>
            <input type="text" name="operator_postalcode" value="<?php echo $result["operator_postalcode"] ?>" id="operator_postalcode" maxlength="8">
            <br>
            <label class="label-classic">Ort</label>
            <input type="text" name="operator_place" value="<?php echo $result["operator_place"] ?>" id="operator_place">
            <br><br>
        </div>

        <hr class="blue-line"> <!-- Blaue Linie eingefügt -->

        <!-- ABSCHNITT VERSICHERUNGSORT - -->
        <div>
            <h2>2. Versicherungsort</h2>
        </div>


        <!-- Radiobutton für Adress- oder Koordinateneingabe des VO -->
        <div class="subsection"><b>Address- oder Koordinateneingabe:</b></div>

        <!-- Toggle-Buttons JA/NEIN -->
        <input type="radio" id="option1_address" name="address_or_coordinates" value="address" <?php echo $result["address_or_coordinates"] == 'address' ? 'checked' : '' ?>>
        <!-- name ist der DB-Parameter -->
        <label for="option1_address" class="toggle-label">Adresse</label>

        <input type="radio" id="option2_coordinates" name="address_or_coordinates" value="coordinates" <?php echo $result["address_or_coordinates"] == 'coordinates' ? 'checked' : '' ?>>
        <label for="option2_coordinates" class="toggle-label">Koordinaten</label>
        <br>

        <!-- Inhalt, der nur bei "Adresse" eingeblendet wird -->
        <div class="toggle-content-address-coordinates content-address">
            <br>
            <label class="label-classic">Straße und Hausnummer</label>
            <input type="text" name="address_street" value="<?php echo $result["address_street"] ?>" id="address_street" required>
            <br>
            <label class="label-classic">Postleitzahl</label>
            <input type="text" name="address_postalcode" value="<?php echo $result["address_postalcode"] ?>" id="address_postalcode" maxlength="8" required>
            <br>
            <label class="label-classic">Ort</label>
            <input type="text" name="address_place" value="<?php echo $result["address_place"] ?>" id="address_place" required>
            <br>
        </div>

        <!-- Inhalt, der nur bei "Koordinaten" eingeblendet wird -->
        <div class="toggle-content-address-coordinates content-coordinates">
            <br>
            <label class="label-classic">Ost/Nord-Koordinaten (Dezimalgrad z.B. 2.17403 41.40338)</label>
            <input type="text" name="coordinates" value="<?php echo $result["coordinates"] ?>" id="coordinates">
            <br>
        </div>

        <br>

        <!-- Radiobutton für das Versicherungs-Land -->
        <div class="subsection"><b>Land</b></div>

        <!-- Toggle-Buttons JA/NEIN -->
        <input type="radio" id="option1_insured_land" name="insured_land" value="Österreich" <?php echo $result["insured_land"] == 'Österreich' ? 'checked' : '' ?>>
        <label for="option1_insured_land" class="toggle-label">Österreich</label>

        <input type="radio" id="option2_insured_land" name="insured_land" value="Ausland" <?php echo $result["insured_land"] == 'Ausland' ? 'checked' : '' ?>>
        <label for="option2_insured_land" class="toggle-label">Anderes Land</label>
        <br>

        <!-- Inhalt, der nur bei "Ja" eingeblendet wird -->
        <div class="toggle-content-insured-land">
            <br>
            <label class="label-classic">Name des Landes</label>
            <input type="text" name="name_other_land" value="<?php echo $result["name_other_land"] ?>" id="name_other_land">
            <br><br>
            <label class="label-classic">Die Gesellschaft des Antragssteller/-s/-in befindet sich zu mindestens 50% in
                österreichischem Besitz (direkt oder indirekt)</label>
            <select name="applicant_share_50" id="applicant_share_50">
                <option value="" disabled hidden>Bitte wählen</option>
                <option value="Ja" <?php echo $result["applicant_share_50"] == 'Ja' ? 'selected' : '' ?>>Ja</option>
                <option value="Nein" <?php echo $result["applicant_share_50"] == 'Nein' ? 'selected' : '' ?>>Nein</option>
            </select>
            <br>

        </div>

        <br>
        <div class="subsection"><b>Sonstige Fragen</b></div>
        <label class="label-classic"><b>Wurde die PV-Anlage in/ auf Gewässern errichtet?</b></label>
        <select name="water" required>
            <option value="" disabled hidden>Bitte wählen</option>
            <option value="Ja" <?php echo $result["water"] == 'Ja' ? 'selected' : '' ?>>Ja</option>
            <option value="Nein" <?php echo $result["water"] == 'Nein' ? 'selected' : '' ?>>Nein</option>
        </select>
        <br><br>
        <label class="label-classic"><b>Sind die PV-Module im österreichischen <a href="https://www.hagelregister.at"
                    target="_blank" rel="noopener noreferrer">Hagelschutzregister</a> eingetragen?</b></label>
        <select name="hagelregister" required>
            <option value="" disabled hidden>Bitte wählen</option>
            <option value="Ja" <?php echo $result["hagelregister"] == 'Ja' ? 'selected' : '' ?>>Ja</option>
            <option value="Nein" <?php echo $result["hagelregister"] == 'Nein' ? 'selected' : '' ?>>Nein</option>
            <option value="Ist nicht bekannt" <?php echo $result["hagelregister"] == 'Ist nicht bekannt' ? 'selected' : '' ?>>Ist nicht bekannt</option>
        </select>
        <br><br>
        <label class="label-classic"><b>Ist die PV-Anlage betriebsfertig?</b></label>
        <select name="in_operation" required>
            <option value="" disabled hidden>Bitte wählen</option>
            <option value="Ja" <?php echo $result["in_operation"] == 'Ja' ? 'selected' : '' ?>>Ja</option>
            <option value="Nein. Die PV-Anlage ist im Bau befindlich bzw. noch nicht fertiggestellt." <?php echo $result["in_operation"] == 'Nein. Die PV-Anlage ist im Bau befindlich bzw. noch nicht fertiggestellt.' ? 'selected' : '' ?>>Nein. Die
                PV-Anlage ist im Bau befindlich bzw. noch nicht fertiggestellt.</option>
        </select>
        <br><br>
        <label class="label-classic"><b>Fällt irgendwo Schatten auf die Module der Anlage? Durch die (Teil)-
                Verschattung ist die Bildung von Hot-Spots möglich.</b></label>
        <select name="shadowed" class="custom-dropdown" required>
            <option value="" disabled hidden>Bitte wählen</option>
            <option value="Ja. Die Anlage ist verschattet oder teilverschattet (Keine Deckung für Brand, Blitzschlag, etc.)" <?php echo $result["shadowed"] == 'Ja. Die Anlage ist verschattet oder teilverschattet (Keine Deckung für Brand, Blitzschlag, etc.)' ? 'selected' : '' ?>>
                Ja. Die Anlage ist verschattet oder teilverschattet (Keine Deckung für Brand, Blitzschlag, etc.)
            </option>
            <option
                value="Ja. Die Anlage ist verschattet oder teilverschattet, wobei technologisch keine Hot-Spots auftreten können">
                <?php echo $result["shadowed"] == 'Ja. Die Anlage ist verschattet oder teilverschattet, wobei technologisch keine Hot-Spots auftreten können' ? 'selected' : '' ?>
                Ja. Die Anlage ist verschattet oder teilverschattet, wobei technologisch keine Hot-Spots auftreten
                können</option>
            <option value="Nein" <?php echo $result["shadowed"] == 'Nein' ? 'selected' : '' ?>>Nein</option>
        </select>
        <br><br>
        <label class="label-classic"><b>Sind die Module sonnenstandsnachgeführt? ("Tracker")?</b></label>
        <select name="tracker" required>
            <option value="" disabled hidden>Bitte wählen</option>
            <option value="Ja" <?php echo $result["tracker"] == 'Ja' ? 'selected' : '' ?>>Ja</option>
            <option value="Nein" <?php echo $result["tracker"] == 'Nein' ? 'selected' : '' ?>>Nein</option>
        </select>
        <br><br>
        <label class="label-classic"><b>Ist der Zustand des Untergrunds der PV-Anlage (Dachflächen, Grund und Boden)
                frei von bekannten Schäden, Mängeln, Schadstoffen oder Umwelt-Altlasten?</b></label>
        <select name="ground_condition" required>
            <option value="" disabled hidden>Bitte wählen</option>
            <option value="Ja" <?php echo $result["ground_condition"] == 'Ja' ? 'selected' : '' ?>>Ja</option>
            <option value="Nein" <?php echo $result["ground_condition"] == 'Nein' ? 'selected' : '' ?>>Nein</option>
        </select>
        <br><br>

        <hr class="blue-line"> <!-- Blaue Linie eingefügt -->

        <!-- VERSICHERUNGSBEGINN - -->
        <div>
            <h2>3. Versicherungsbeginn</h2>
        </div>

        <div class="form-container"> <!-- Container damit Input-Felder Date linksbündig angeordnet wird -->
            <label class="label-classic" for="date_commencement">Versicherungsbeginn (keine Deckung vor Eingang des
                Antrags beim Versicherer):</label>
            <br>
            <!-- Min und Wert auf heute setzen -->
            <input type="date" id="date_commencement" name="date_commencement"
                min="<?= htmlspecialchars(date('Y-m-d')) ?>" value="<?= $result["date_commencement"] ?>" required>
            <!-- Fallback für ältere Browser muss evtl. noch programmiert werden -->
            <br>
        </div>
        <hr class="blue-line"> <!-- Blaue Linie eingefügt -->
        <div class="subsection-save">
            <span class="small-text">Sichern Sie den aktuellen Stand Ihrer Eingaben, z.B. um zu einem späteren Zeitpunkt
                damit fortzufahren.</span>
            <button class="save-btn" id="save-btn">Speichern</button>
        </div>
        <hr class="blue-line"> <!-- Blaue Linie eingefügt -->

        <!-- TECHNISCHE DATEN DER PV-ANLAGE - -->
        <div>
            <h2>4. Technische Daten der PV-Anlage</h2>
        </div>
        <div class="subsection"><b>Module und Leistung</b></div>

        <label class="label-classic">Hersteller</label>
        <input type="text" name="panel_manufacturer" value="<?= $result["panel_manufacturer"] ?>" required>
        <br>
        <label class="label-classic">Type</label>
        <input type="text" name="panel_type" value="<?= $result["panel_type"] ?>" required>
        <br>

        <div class="form-container"> <!-- Container damit Input-Felder Zahlen linksbündig angeordnet werden -->
            <label class="label-classic">Anzahl der Module</label>
            <input type="number" name="panel_amount" value="<?= $result["panel_amount"] ?>" required>

            <label class="label-classic">Leistung je Modul (Wp)</label>
            <input type="number" name="output_per_panel" value="<?= $result["output_per_panel"] ?>" step="0.01" required>

            <label class="label-classic">Nennleistung gesamt bzw. aller Module (kWp)</label>
            <input type="number" name="output_total" value="<?= $result["output_total"] ?>" step="0.01" required>

            <label class="label-classic">Gesamtfläche (m²)</label>
            <input type="number" name="area" value="<?= $result["area"] ?>" step="0.01">
            <br>
        </div>

        <div class="subsection"><b>Wechselrichter</b></div>
        <label class="label-classic">Hersteller</label>
        <input type="text" name="inverter_manufacturer" value="<?= $result["inverter_manufacturer"] ?>" required>

        <label class="label-classic">Type</label>
        <input type="text" name="inverter_type" value="<?= $result["inverter_type"] ?>" required>

        <div class="form-container"> <!-- Container damit Input-Felder Zahlen linksbündig angeordnet werden -->
            <label class="label-classic">Anzahl der Wechselrichter</label>
            <input type="number" name="inverter_amount" value="<?= $result["inverter_amount"] ?>" required>

            <label class="label-classic">Leistung je Wechselrichter (kVA)</label>
            <input type="number" name="output_per_inverter" value="<?= $result["output_per_inverter"] ?>" step="0.01">
        </div>
        <br>

        <div class="subsection"><b>Neuwert in € (ohne Preisnachlässe)</b>
            <br>
            <span class="small-text">Bitte "0" eingeben, wenn Komponente nicht Bestandteil der Anlage ist</span>
        </div>

        <div class="form-container"> <!-- Container damit Input-Felder Zahlen linksbündig angeordnet werden -->
            <label class="label-classic">Module (€)</label>
            <input type="number" id="eur_panels" name="eur_panels" step="0.01" oninput="calculateTotal()"
                value="<?php echo isset($_POST['eur_panels']) ? number_format($_POST['eur_panels'], 2, ',', '.') : $result["eur_panels"]; ?>"
                required>

            <label class="label-classic">Wechselrichter (€)</label>
            <input type="number" id="eur_inverter" name="eur_inverter" step="0.01" oninput="calculateTotal()"
                value="<?php echo isset($_POST['eur_inverter']) ? number_format($_POST['eur_inverter'], 2, ',', '.') : $result["eur_inverter"]; ?>"
                required>

            <label class="label-classic">Transformator NUR für die PV-Anlage; nur dann ist der Trafo versicherbar
                (€)</label>
            <input type="number" id="eur_transformer" name="eur_transformer" step="0.01" oninput="calculateTotal()"
                value="<?php echo isset($_POST['eur_transformer']) ? number_format($_POST['eur_transformer'], 2, ',', '.') : $result["eur_transformer"]; ?>"
                required>

            <label class="label-classic">Tragkonstruktion (€)</label>
            <input type="number" id="eur_supporting_structure" name="eur_supporting_structure" step="0.01"
                oninput="calculateTotal()"
                value="<?php echo isset($_POST['eur_supporting_structure']) ? number_format($_POST['eur_supporting_structure'], 2, ',', '.') : $result["eur_supporting_structure"]; ?>"
                required>

            <label class="label-classic">24/7-Videoüberwachung mit Bewegungsmelder (€)</label>
            <input type="number" id="eur_video" name="eur_video" step="0.01" oninput="calculateTotal()"
                value="<?php echo isset($_POST['eur_video']) ? number_format($_POST['eur_video'], 2, ',', '.') : $result["eur_video"]; ?>"
                required>

            <label class="label-classic">Zaun/ Umzäunung; kein Mobilzaun! (€)</label>
            <input type="number" id="eur_fence" name="eur_fence" step="0.01" oninput="calculateTotal()"
                value="<?php echo isset($_POST['eur_fence']) ? number_format($_POST['eur_fence'], 2, ',', '.') : $result["eur_fence"]; ?>"
                required>

            <label class="label-classic">Sonstige bzw. Sammelposition für zuvor nicht genannte Komponenten (€)</label>
            <input type="number" id="eur_miscellaneous" name="eur_miscellaneous" step="0.01" oninput="calculateTotal()"
                value="<?php echo isset($_POST['eur_miscellaneous']) ? number_format($_POST['eur_miscellaneous'], 2, ',', '.') : $result["eur_miscellaneous"]; ?>"
                required>
        </div>

        <label class="label-classic"><b>Gesamtversicherungssumme der PV-Anlage (exkl. E-Ladestationen):</b></label>
        <div class="subsection"><span id="total"></span></div>
        <br>

        <hr class="blue-line"> <!-- Blaue Linie eingefügt -->

        <!-- ERTRAGSAUSFALL- BZW. BETRIEBSUNTERBRECHUNGSVERSICHERUNG - -->
        <div>
            <h2>5. Ertragsausfall- bzw. Betriebsunterbrechungsversicherung</h2>
        </div>

        <!-- BU STROM-VERKAUF -->
        <label class="label-classic">Soll der Ertragsausfall des eingespeisten (verkauften) Stroms versichert
            werden?</label>
        <br>

        <!-- Toggle-Buttons JA/NEIN -->

        <input type="radio" id="yes-sale" name="business_interruption" value="Ja" <?php echo $result["business_interruption"] == 'Ja' ? 'checked' : ''; ?>>
        <label for="yes-sale" class="toggle-label">Ja</label>

        <input type="radio" id="no-sale" name="business_interruption" value="Nein" <?php echo $result["business_interruption"] == 'Nein' ? 'checked' : ''; ?>>
        <label for="no-sale" class="toggle-label">Nein</label>
        <br>

        <!-- Inhalt, der nur bei "Ja" eingeblendet wird -->
        <div class="toggle-content-bi-sale">

            <div class="subsection"><b>Strom-Verkauf (bei Einspeisung)</b></div>
            <div class="form-container"> <!-- Container damit Input-Felder Zahlen linksbündig angeordnet werden -->

                <label>kWh an Jahres-Einspeisung</label>
                <input type="number" id="BI_annual_feed" name="BI_annual_feed" step="0.01"
                    oninput="calculate_BI_Total()"
                    value="<?php echo isset($result['BI_annual_feed']) ? $result['BI_annual_feed'] : 0; ?>">

                <label>x Einspeisevergütung gemäß EVU-Vertrag in € / kWh</label>
                <input type="number" id="BI_feed_in_tariff" name="BI_feed_in_tariff" step="0.01"
                    oninput="calculate_BI_Total()"
                    value="<?php echo isset($result['BI_feed_in_tariff']) ? $result['BI_feed_in_tariff'] : 0; ?>">
            </div>
        </div>
        <br>

        <!-- BU STROM-ZUKAUF -->
        <label class="label-classic">Soll der Ertragsausfall des Strom-Eigenverbrauchs versichert werden?</label>
        <br>

        <!-- Toggle-Buttons JA/NEIN -->
        <input type="radio" id="yes-self" name="self_consumption" value="Ja" <?php echo $result["self_consumption"] == 'Ja' ? 'checked' : ''; ?>> <!-- name = DB-Name -->
        <label for="yes-self" class="toggle-label">Ja</label>

        <input type="radio" id="no-self" name="self_consumption" value="Nein" <?php echo $result["self_consumption"] == 'Nein' ? 'checked' : ''; ?>>
        <label for="no-self" class="toggle-label">Nein</label>

        <!-- Inhalt, der nur bei "Ja" eingeblendet wird -->
        <div class="toggle-content-bi-self">

            <div class="subsection"><b>Strom-Zukauf (Eigenverbrauch)</b></div>
            <div class="form-container"> <!-- Container damit Input-Felder Zahlen linksbündig angeordnet werden -->

                <label class="label-classic">kWh an Jahres-Eigenverbrauch</label>
                <input type="number" id="BI_annual_self_consumption" name="BI_annual_self_consumption" step="0.01"
                    oninput="calculate_BI_Total()"
                    value="<?php echo isset($result["BI_annual_self_consumption"]) ? $result["BI_annual_self_consumption"] : 0; ?>">

                <label class="label-classic">x Einspeisevergütung gemäß EVU-Vertrag in € / kWh</label>
                <input type="number" id="BI_self_consumption_tariff" name="BI_self_consumption_tariff" step="0.01"
                    oninput="calculate_BI_Total()"
                    value="<?php echo isset($result['BI_self_consumption_tariff']) ? $result['BI_self_consumption_tariff'] : 0; ?>">
            </div>
        </div>
        <br><br>

        <label class="label-classic"><b>Jahresversicherungssumme Ertragsausfall:</b></label>
        <div class="subsection"><span id="BI_total"></span></div>
        <br>
        <hr class="blue-line"> <!-- Blaue Linie eingefügt -->

        <div class="subsection-save">

            <span class="small-text">
                Durch Absenden dieses Formulars wird bestätigt, dass sämtliche Fragen wahrheitsgetreu beantwortet
                wurden. Unrichtige Angaben können einen Deckungsverlust zur Folge haben.</span>

            <input type="submit" value="Senden" name="completed"><br>

    </form>

    <div class="center">
        <a href="index.php">Formular leeren</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="load.php">Gespeicherten Antrag
            forsetzen</a>
    </div>

    <!-- Hier binden wir die externe JavaScript-Datei ein -->

    <script src="js/script.js?v=2.8"></script>

</body>

</html>
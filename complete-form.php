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

        <input type="text" name="address_street" value="<?php echo $result["address_street"] ?>" id="address_street">

        <br>

        <label class="label-classic">Postleitzahl</label>

        <input type="text" name="address_postalcode" value="<?php echo $result["address_postalcode"] ?>" id="address_postalcode" maxlength="8">

        <br>

        <label class="label-classic">Ort</label>

        <input type="text" name="address_place" value="<?php echo $result["address_place"] ?>" id="address_place">

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

    <label class="label-classic-twolined"><b>Fällt irgendwo Schatten auf die Module der Anlage? Durch die (Teil)-Verschattung ist die Bildung von Hot-Spots möglich.</b></label>

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

    <label class="label-classic-twolined"><b>Ist der Zustand des Untergrunds der PV-Anlage (Dachflächen, Grund und Boden) frei von bekannten Schäden, Mängeln, Schadstoffen oder Umwelt-Altlasten?</b></label>

    <select name="ground_condition" required>

        <option value="" disabled hidden>Bitte wählen</option>

        <option value="Ja" <?php echo $result["ground_condition"] == 'Ja' ? 'selected' : '' ?>>Ja</option>

        <option value="Nein" <?php echo $result["ground_condition"] == 'Nein' ? 'selected' : '' ?>>Nein</option>

    </select>

    <br><br>



    <hr class="blue-line"> <!-- Blaue Linie eingefügt -->

    <!-- VERSICHERTE SACHE - -->

    <!-- VERSICHERTE SACHE - -->
    <div>
        <h2>3. Versicherte Sache</h2>
    </div>

    <!-- Begin TYPE OF PV PLANT -->

    <div class="subsection"><b>Art der Photovoltaikanlage</b></div>

    <!-- Toggle-Buttons JA/NEIN -->
    <input type="radio" id="plant_type_ground" name="plant_type" value="Bodenanlage" checked>
    <label for="plant_type_ground" class="toggle-label">Bodenanlage</label>

    <input type="radio" id="plant_type_roof" name="plant_type" value="Auf-Dachanlage">
    <label for="plant_type_roof" class="toggle-label">Auf-Dachanlage</label>
    <br>
    <br>

    <!-- End TYPE OF PV PLANT -->

    <div class="subsection"><b>Allgemeine Fragen</b></div>

    <label class="label-classic-twolined"><b>Alter der Anlage (bei älteren Anlagen ist das Schaden-Rendement des Vorversicherers zu übermitteln)</b></label>
    <select name="age" id="age"  required>
        <option value="" <?php echo $result['age'] == '' ? 'selected' : ''?>>Bitte wählen</option>
        <option value="Neue Anlage mit erstmaliger Inbetriebnahme" <?php echo $result['age'] == 'Neue Anlage mit erstmaliger Inbetriebnahme' ? 'selected' : ''?>>Neue Anlage mit erstmaliger Inbetriebnahme</option>
        <option value="Gebrauchte Anlage (nicht älter als 3 Jahre)" <?php echo $result['age'] == 'Gebrauchte Anlage (nicht älter als 3 Jahre)' ? 'selected' : ''?>>Gebrauchte Anlage (nicht älter als 3 Jahre)</option>
        <option value="Gebrauchte Anlage (älter als 3 Jahre)" <?php echo $result['age'] == 'Gebrauchte Anlage (älter als 3 Jahre)' ? 'selected' : ''?>>Gebrauchte Anlage (älter als 3 Jahre)</option>
    </select>
    <br><br>

    <label class="label-classic-twolined"><b>Ist ein DC-Lasttrennschalter ("Feuerwehrschalter") verbaut, durch den die PV-Anlage im Brandfall stromlos geschaltet werden kann?</b></label>
    <select name="load_break_switch" required>
        <option value="" <?php echo $result['load_break_switch'] == '' ? 'selected' : '' ?>> Bitte wählen</option>
        <option value="Ja" <?php echo $result['load_break_switch'] == 'Ja' ? 'selected' : '' ?>>Ja</option>
        <option value="Nein (Keine Deckung für Brand, Blitzschlag, etc.)" <?php echo $result['load_break_switch'] == 'Nein (Keine Deckung für Brand, Blitzschlag, etc.)' ? 'selected' : '' ?>>Nein (Keine Deckung für Brand, Blitzschlag, etc.)</option>
    </select>
    <br><br>
    
    <label class="label-classic-twolined"><b>Ist eine 24/7-Videoüberwachung mit Bewegungsmelder über den gesamten Anlagenbereich vorhanden? Wird zusätzlich ein automatischer Alarm an eine ständig besetzte Stelle (z.B. Polizei oder privater Sicherheitsdienst) ausgelöst?</b></label>

    <select name="theft_video"  id="theft_video" required>
        <option value="" <?php echo $result['theft_video'] == '' ? 'selected' : ''?>>Bitte wählen</option>
        <option value="Ja" <?php echo $result['theft_video'] == 'Ja' ? 'selected' : ''?>>Ja</option>
        <option value="Nein" <?php echo $result['theft_video'] == 'Nein' ? 'selected' : ''?>>Nein</option>
    </select>
    <br><br>

    <label class="label-classic-twolined"><b>Wird der Versicherungsort vollständig mit einem lückenlosen und standsicheren, mind. 1,8 m hohen Zaun (kein Mobilzaun) mit Übersteigschutz eingegrenzt und sind sämtliche Zugänge versperrt?</b></label>
    <select name="theft_fence" id="theft_fence" required>
        <option value="" <?php echo $result['theft_fence'] == '' ? 'selected' : ''?>>Bitte wählen</option>
        <option value="Ja - oder mit Hochstellung von max. 20cm über der Geländeorberkante" <?php echo $result['theft_fence'] == 'Ja - oder mit Hochstellung von max. 20cm über der Geländeorberkante' ? 'selected' : ''?>>Ja - oder mit Hochstellung von max. 20cm über der Geländeorberkante</option>
        <option value="Ja, aber mit Hochstellung von mehr als 20cm über der Geländeorberkante" <?php echo $result['theft_fence'] == 'Ja, aber mit Hochstellung von mehr als 20cm über der Geländeorberkante' ? 'selected' : ''?>>Ja, aber mit Hochstellung von mehr als 20cm über der Geländeorberkante</option>
        <option value="Nein" <?php echo $result['theft_fence'] == 'Nein' ? 'selected' : ''?>>Nein</option>
    </select>
    <br>

    <!-- Begin SPECIAL QUESTIONS PV PLANTS ON THE GROUND -->
    <div class="toggle-content-bodenanlage">
        <div class="subsection"><b>Spezielle Fragen zur Bodenanlage</b></div>
        <label class="label-classic"><b>Ist die Bodenanlage aufgeständert?</b></label>
        <select name="ground_plant_elevated" id="ground_plant_elevated">
            <option value="" <?php echo $result['ground_plant_elevated'] == '' ? 'selected' : ''?>>Bitte wählen</option>
            <option value="Ja" <?php echo $result['ground_plant_elevated'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein" <?php echo $result['ground_plant_elevated'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>

        <label class="label-classic-twolined"><b>Ist die Anlage auf setzungsempfindlichem Untergrund (z.B. Deponie, Tagebau, Halde, Sumpf- und Torfgebiet, etc.) gebaut und/ oder befindet sich in einer Hanglage (> 30 % Hangneigung)?</b></label>
        <select name="ground_plant_underground" id="ground_plant_underground">
            <option value="" <?php echo $result['ground_plant_underground'] == '' ? 'selected' : ''?>>Bitte wählen</option>
            <option value="Ja" <?php echo $result['ground_plant_underground'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein" <?php echo $result['ground_plant_underground'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>
    </div>

    <!-- End SPECIAL QUESTIONS PV PLANTS ON THE GROUND -->
    <div class="toggle-content-dachanlage">
        <div class="subsection"><b>Spezielle Fragen zur Auf-Dachanlage</b></div>
        <label class="label-classic-twolined"><b>"Contracting" (Die Anlage befindet sich auf dem Gebäude eines Dritten)</b></label>
        <select name="roof_plant_contracting" id="roof_plant_contracting">
            <option value="" <?php echo $result['roof_plant_contracting'] == '' ? 'selected' : ''?>>Bitte wählen</option>
            <option value="Ja" <?php echo $result['roof_plant_contracting'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein" <?php echo $result['roof_plant_contracting'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>

        <label class="label-classic"><b>Auf wievielen Gebäuden befinden sich PV-Module?</b></label>
        <select name="roof_plant_amount_buildings" id="roof_plant_amount_buildings">
            <option value="" <?php echo $result['roof_plant_amount_buildings'] == '' ? 'selected' : ''?>>Bitte wählen</option>
            <option value="1" <?php echo $result['roof_plant_amount_buildings'] == '1' ? 'selected' : ''?>>1</option>
            <option value="2" <?php echo $result['roof_plant_amount_buildings'] == '2' ? 'selected' : ''?>>2</option>
            <option value="3" <?php echo $result['roof_plant_amount_buildings'] == '3' ? 'selected' : ''?>>3</option>
            <option value="4" <?php echo $result['roof_plant_amount_buildings'] == '4' ? 'selected' : ''?>>4</option>
            <option value="5" <?php echo $result['roof_plant_amount_buildings'] == '5' ? 'selected' : ''?>>5</option>
            <option value="6" <?php echo $result['roof_plant_amount_buildings'] == '6' ? 'selected' : ''?>>6</option>
            <option value="7" <?php echo $result['roof_plant_amount_buildings'] == '7' ? 'selected' : ''?>>7</option>
            <option value="8" <?php echo $result['roof_plant_amount_buildings'] == '8' ? 'selected' : ''?>>8</option>
            <option value="9" <?php echo $result['roof_plant_amount_buildings'] == '9' ? 'selected' : ''?>>9</option>
            <option value="10" <?php echo $result['roof_plant_amount_buildings'] == '10' ? 'selected' : ''?>>10</option>
            <option value="11" <?php echo $result['roof_plant_amount_buildings'] == '11' ? 'selected' : ''?>>11</option>
            <option value="12" <?php echo $result['roof_plant_amount_buildings'] == '12' ? 'selected' : ''?>>12</option>
            <option value="13" <?php echo $result['roof_plant_amount_buildings'] == '13' ? 'selected' : ''?>>13</option>
            <option value="14" <?php echo $result['roof_plant_amount_buildings'] == '14' ? 'selected' : ''?>>14</option>
            <option value="15" <?php echo $result['roof_plant_amount_buildings'] == '15' ? 'selected' : ''?>>15</option>
        </select>
        <br><br>

        <label class="label-classic">Wie wird das Gebäude genutzt? (z.B. Wohngebäude, Landwirtschaftliches Gebäude, Lager)</label>
        <input type="text" name="roof_plant_usage" id="roof_plant_usage" maxlength="250" value="<?= $result["roof_plant_usage"] ?>" >
        <br><br>

        <label class="label-classic"><b>Traufhöhe (in Meter) des höchsten Gebäudes</b></label>
        <select name="roof_plant_eaves_height" id="roof_plant_eaves_height">
            <option value="" <?php echo $result['roof_plant_eaves_height'] == '' ? 'selected' : ''?>>Bitte wählen</option>
            <option value="< 3 m (Weitere Sicherungen notwendig für ED- & Diebstahl-Deckung)" <?php echo $result['roof_plant_eaves_height'] == '< 3 m (Weitere Sicherungen notwendig für ED- & Diebstahl-Deckung)' ? 'selected' : ''?>>< 3 m (Weitere Sicherungen notwendig für ED- & Diebstahl-Deckung)</option>
            <option value="≥ 3 m < 15 m" <?php echo $result['roof_plant_eaves_height'] == '≥ 3 m < 15 m' ? 'selected' : ''?>>≥ 3 m < 15 m</option>
            <option value="≥ 15 m" <?php echo $result['roof_plant_eaves_height'] == '≥ 15 m' ? 'selected' : ''?>>≥ 15 m</option>
        </select>
        <br><br>

        <label class="label-classic-twolined"><b>Gebäude mit nicht harter Bedachung (z.B. Holz, Ried, Hartfaserplatten, Kunststoffe, PVC-Folien, etc.)</b></label>
        <select name="roof_plant_soft_roofing" id="roof_plant_soft_roofing">
            <option value="" <?php echo $result['roof_plant_soft_roofing'] == '' ? 'selected' : ''?>>Bitte wählen</option>
            <option value="Ja (Nicht harte Bedachung vorhanden)" <?php echo $result['roof_plant_soft_roofing'] == 'Ja (Nicht harte Bedachung vorhanden)' ? 'selected' : ''?>>Ja (Nicht harte Bedachung vorhanden)</option>
            <option value="Nein (Harte Bedachung vorhanden)" <?php echo $result['roof_plant_soft_roofing'] == 'Nein (Harte Bedachung vorhanden)' ? 'selected' : ''?>>Nein (Harte Bedachung vorhanden)</option>
        </select>
        <br><br>

        <label class="label-classic-twolined"><b>Gebäude mit nicht-massiven Außenwänden (Holz, Kunststoff oder leicht bis normal-entflammbar klassifizierte Sandwich-Paneele)</b></label>
        <select name="roof_plant_soft_walls" id="roof_plant_soft_walls">
            <option value="" <?php echo $result['roof_plant_soft_walls'] == '' ? 'selected' : ''?>>Bitte wählen</option>
            <option value="Ja (Nicht massive Außenwänden vorhanden)" <?php echo $result['roof_plant_soft_walls'] == 'Ja (Nicht massive Außenwänden vorhanden)' ? 'selected' : ''?>>Ja (Nicht massive Außenwänden vorhanden)</option>
            <option value="Nein (Außenwände sind massiv)" <?php echo $result['roof_plant_soft_walls'] == 'Nein (Außenwände sind massiv)' ? 'selected' : ''?>>Nein (Außenwände sind massiv)</option>
        </select>
        <br><br>

        <label class="label-classic-twolined"><b>Sind die Modulrahmen der Auf-Dachanlage mit mechanischen Sicherungen (z. B. Spezialverschraubung, Verklebung, Verschweißung, Vernietung) gegen Diebstahl gesichert?</b></label>
        <select name="roof_plant_mechanical_protection" id="roof_plant_mechanical_protection">
            <option value="" <?php echo $result['roof_plant_mechanical_protection'] == '' ? 'selected' : ''?>>Bitte wählen</option>
            <option value="Ja" <?php echo $result['roof_plant_mechanical_protection'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein" <?php echo $result['roof_plant_mechanical_protection'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>

        <label class="label-classic-twolined"><b>Befindet sich die PV-Anlage auf Dächern von Heuschobern, Tierfarmen oder Lagern mit leichtentzündlichen Waren oder Vorräten?</b></label>
        <select name="roof_plant_animal_farm" id="roof_plant_animal_farm">>
            <option value="" <?php echo $result['roof_plant_animal_farm'] == '' ? 'selected' : ''?>>Bitte wählen</option>
            <option value="Ja (Keine Deckung für Brand, Blitzschlag, etc.)" <?php echo $result['roof_plant_animal_farm'] == 'Ja (Keine Deckung für Brand, Blitzschlag, etc.)' ? 'selected' : ''?>>Ja (Keine Deckung für Brand, Blitzschlag, etc.)</option>
            <option value="Nein" <?php echo $result['roof_plant_animal_farm'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>

        <label class="label-classic-twolined"><b>Wurden Leitungen durch eine Brandwand oder brandabschnittsbildende Wand verlegt?</b></label>
        <select name="roof_plant_fire_wall" id="roof_plant_fire_wall"> class="custom-dropdown">
            <option value="" <?php echo $result['roof_plant_fire_wall'] == '' ? 'selected' : ''?>>Bitte wählen</option>
            <option value="Ja, aber ohne geeignete Leitungsschotts oder Brandschutzkanäle (Keine Deckung für Brand, Blitzschlag, etc.)" <?php echo $result['roof_plant_fire_wall'] == 'Ja, aber ohne geeignete Leitungsschotts oder Brandschutzkanäle (Keine Deckung für Brand, Blitzschlag, etc.)' ? 'selected' : ''?>>Ja, aber ohne geeignete Leitungsschotts oder Brandschutzkanäle (Keine Deckung für Brand, Blitzschlag, etc.)</option>
            <option value="Ja. Die Leitungen wurden mit Leitungsschotts (UV- und witterungsbeständig für den Außenbereich) versehen" <?php echo $result['roof_plant_fire_wall'] == 'Ja. Die Leitungen wurden mit Leitungsschotts (UV- und witterungsbeständig für den Außenbereich) versehen' ? 'selected' : ''?>>Ja. Die Leitungen wurden mit Leitungsschotts (UV- und witterungsbeständig für den Außenbereich) versehen</option>
            <option value="Ja. Die Leitungen wurden in nicht brennbaren Brandschutzkanälen verlegt" <?php echo $result['roof_plant_fire_wall'] == 'Ja. Die Leitungen wurden in nicht brennbaren Brandschutzkanälen verlegt' ? 'selected' : ''?>>Ja. Die Leitungen wurden in nicht brennbaren Brandschutzkanälen verlegt</option>
            <option value="Nein" <?php echo $result['roof_plant_fire_wall'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>

        <label class="label-classic-twolined"><b>Ist sichergestellt, dass die Dachkonstruktion hinsichtlich Statik für die PV-Anlage ausgelegt ist? (Einsturzrisiko)</b></label>
        <select name="roof_plant_collapse" id="roof_plant_collapse">>
            <option value="" <?php echo $result['roof_plant_collapse'] == '' ? 'selected' : ''?>>Bitte wählen</option>
            <option value="Ja" <?php echo $result['roof_plant_collapse'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein" <?php echo $result['roof_plant_collapse'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>

        <label class="label-classic-twolined"><b>Sind entsprechend große Durchgänge am Dach vorhanden um eine Schneeräumung der Module - ohne Beschädigung weiterer Module - gewährleisten zu können?</b></label>
        <select name="roof_plant_snow_removal" id="roof_plant_snow_removal">>
            <option value="" <?php echo $result['roof_plant_snow_removal'] == '' ? 'selected' : ''?>>Bitte wählen</option>
            <option value="Ja" <?php echo $result['roof_plant_snow_removal'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein (Keine Deckung von Sturm und Schneedruck)" <?php echo $result['roof_plant_snow_removal'] == 'Nein (Keine Deckung von Sturm und Schneedruck)' ? 'selected' : ''?>>Nein (Keine Deckung von Sturm und Schneedruck)</option>
        </select>
        <br><br>

        <label class="label-classic-twolined"><b>Wurde im Zuge der Errichtung der PV-Anlage eine evtl. vorhandene Dach-Bekiesung <u>dauerhaft</u> entfernt?</b></label>
        <select name="roof_plant_gravel" id="roof_plant_gravel">>
            <option value="" <?php echo $result['roof_plant_gravel'] == '' ? 'selected' : ''?>>Bitte wählen</option>
            <option value="Ja" <?php echo $result['roof_plant_gravel'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein" <?php echo $result['roof_plant_gravel'] == 'Nein' ? 'selected' : ''?>>Nein</option>
            <option value="Es war niemals eine Dach-Bekiesung vorhanden" <?php echo $result['roof_plant_gravel'] == 'Es war niemals eine Dach-Bekiesung vorhanden"' ? 'selected' : ''?>>Es war niemals eine Dach-Bekiesung vorhanden</option>
        </select>
        <br><br>
    </div>

    <hr class="blue-line"> <!-- Blaue Linie eingefügt -->

    <!-- VERSICHERUNGSBEGINN - -->

    <div>

        <h2>4. Versicherungsbeginn</h2>

    </div>



    <div class="form-container"> <!-- Container damit Input-Felder Date linksbündig angeordnet wird -->

        <label class="label-classic" for="date_commencement">Versicherungsbeginn (keine Deckung vor Eingang des Antrags beim Versicherer):</label>

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

        <h2>5. Technische Daten der PV-Anlage</h2>

    </div>

    <div class="subsection"><b>Module und Leistung</b></div>



    <label class="label-classic">Hersteller</label>

    <input type="text" name="panel_manufacturer" id="panel_manufacturer" value="<?= $result["panel_manufacturer"] ?>" required>

    <br>

    <label class="label-classic">Type</label>

    <input type="text" name="panel_type" id="panel_type" value="<?= $result["panel_type"] ?>" required>

    <br>



    <div class="form-container"> <!-- Container damit Input-Felder Zahlen linksbündig angeordnet werden -->

        <label class="label-classic">Anzahl der Module</label>

        <input type="number" name="panel_amount" id="panel_amount" value="<?= $result["panel_amount"] ?>" required>



        <label class="label-classic">Leistung je Modul (Wp)</label>

        <input type="number" name="output_per_panel" id="output_per_panel" value="<?= $result["output_per_panel"] ?>" step="0.01" required>



        <label class="label-classic">Nennleistung gesamt bzw. aller Module (kWp)</label>

        <input type="number" name="output_total" id="output_total" value="<?= $result["output_total"] ?>" step="0.01" required>



        <label class="label-classic">Gesamtfläche (m²)</label>

        <input type="number" name="area"  id="area" value="<?= $result["area"] ?>" step="0.01">

        <br>

    </div>



    <div class="subsection"><b>Wechselrichter</b></div>

    <label class="label-classic">Hersteller</label>

    <input type="text" name="inverter_manufacturer" id="inverter_manufacturer" value="<?= $result["inverter_manufacturer"] ?>" required>



    <label class="label-classic">Type</label>

    <input type="text" name="inverter_type" id="inverter_type" value="<?= $result["inverter_type"] ?>" required>



    <div class="form-container"> <!-- Container damit Input-Felder Zahlen linksbündig angeordnet werden -->

        <label class="label-classic">Anzahl der Wechselrichter</label>

        <input type="number" name="inverter_amount" id="inverter_amount" value="<?= $result["inverter_amount"] ?>" required>



        <label class="label-classic">Leistung je Wechselrichter (kVA)</label>

        <input type="number" name="output_per_inverter" id="output_per_inverter" value="<?= $result["output_per_inverter"] ?>" step="0.01">

    </div>

    <br>

    <!-- BEGIN SECTION CHARGING STATION & BATTERY STORAGE -->
    <div class="subsection"><b>Batteriespeicher und E-Ladestationen</b></div>

    <label class="label-classic_v2">Ist eine E-Ladestation vorhanden?</label>

    <!-- Begin Toggle-Buttons YES/NO for CHARGING STATION -->
    <input type="radio" id="yes-charging_station" name="charging_station" value="Ja"> <!-- name = DB-Name -->
    <label for="yes-charging_station" class="toggle-label">Ja</label>

    <input type="radio" id="no-charging_station" name="charging_station" value="Nein" checked>
    <label for="no-charging_station" class="toggle-label">Nein</label>
    <!-- End Toggle-Buttons YES/NO for CHARGING STATION -->
    <br><br>

    <label class="label-classic_v2">Ist ein Batteriespeicher vorhanden?</label>

    <!-- Begin Toggle-Buttons YES/NO for BATTERY STORAGE -->
    <input type="radio" id="yes-battery_storage" name="battery_storage" value="Ja"> <!-- name = DB-Name -->
    <label for="yes-battery_storage" class="toggle-label">Ja</label>

    <input type="radio" id="no-battery_storage" name="battery_storage" value="Nein" checked>
    <label for="no-battery_storage" class="toggle-label">Nein</label>
    <!-- End Toggle-Buttons YES/NO for BATTERY STORAGE -->
    <br>
    </div>
    <!-- END SECTION CHARGING STATION & BATTERY STORAGE -->
    <br>

    <div class="subsection"><b>Neuwert in € (ohne Preisnachlässe)</b>
        <br>
        <span class="small-text">Bitte "0" eingeben, wenn Komponente nicht Bestandteil der Anlage ist</span>
    </div>
    <br>
    <div class="form-container"> <!-- Container damit Input-Felder Zahlen linksbündig angeordnet werden -->
        <label class="label-classic">Module (€)</label>
        <input type="number" id="eur_panels" name="eur_panels" step="0.01" oninput="calculateTotal()"
            value="<?php echo $result['eur_panels']; ?>"
            required>
            <br>

        <label class="label-classic">Wechselrichter (€)</label>
        <input type="number" id="eur_inverter" name="eur_inverter" step="0.01" oninput="calculateTotal()"
            value="<?php echo $result['eur_inverter'] ?>"
            required>
            <br>

        <label class="label-classic">Transformator NUR für die PV-Anlage; nur dann ist der Trafo versicherbar
            (€)</label>
        <input type="number" id="eur_transformer" name="eur_transformer" step="0.01" oninput="calculateTotal()"
            value="<?php echo $result['eur_transformer']; ?>"
            required>
            <br>

        <label class="label-classic">Tragkonstruktion (€)</label>
        <input type="number" id="eur_supporting_structure" name="eur_supporting_structure" step="0.01"
            oninput="calculateTotal()"
            value="<?php echo  $result['eur_supporting_structure']; ?>"
            required>
            <br>

        <label class="label-classic">24/7-Videoüberwachung mit Bewegungsmelder (€)</label>
        <input type="number" id="eur_video" name="eur_video" step="0.01" oninput="calculateTotal()"
            value="<?php echo $result['eur_video']; ?>"
            required>
            <br>

        <label class="label-classic">Zaun/ Umzäunung; kein Mobilzaun! (€)</label>
        <input type="number" id="eur_fence" name="eur_fence" step="0.01" oninput="calculateTotal()"
            value="<?php echo $result['eur_fence']; ?>"
            required>
        <!-- BEGIN TOGGLE VALUE CHARGING STATION - -->
        <div class="toggle-content-charging_station">
            <label class="label-classic">E-Ladestation (€)</label>
            <input type="number" id="eur_charging_station" name="eur_charging_station" step="0.01"
                value="<?php echo $result['eur_charging_station']; ?>">
        </div>
        <!-- END TOGGLE VALUE CHARGING STATION - -->

        <!-- BEGIN TOGGLE VALUE BATTERY STORAGE - -->
        <div class="toggle-content-battery_storage">
        <label class="label-classic">Batteriespeicher (€)</label>
        <input type="number" id="eur_battery_storage" name="eur_battery_storage" step="0.01" oninput="calculateTotal()"
            value="<?php echo $result['eur_battery_storage']; ?>">
        </div>
        <!-- END TOGGLE VALUE BATTERY STORAGE - -->
        <br>

        <label class="label-classic">Sonstige bzw. Sammelposition für zuvor nicht genannte Komponenten (€)</label>
        <input type="number" id="eur_miscellaneous" name="eur_miscellaneous" step="0.01" oninput="calculateTotal()"
            value="<?php echo $result['eur_miscellaneous']; ?>"
            required>
    </div>
    <br>

    <label class="label-classic"><b>Gesamtversicherungssumme der PV-Anlage (exkl. E-Ladestationen):</b></label>
    <div class="subsection"><span id="total"></span></div>
    <br>

    <label class="label-classic">Ersatz der Umsatzsteuer</label>
    <select name="indemnify_VAT" class="custom-dropdown" required>
        <option value="" disabled  hidden <?php echo $result['indemnify_VAT'] == '' ? 'selected' : '' ?>>Bitte wählen</option>
        <option value="Ja, die angegebenen Versicherungssummen enthalten Umsatzsteuer" <?php echo $result['indemnify_VAT'] == 'Ja, die angegebenen Versicherungssummen enthalten Umsatzsteuer' ? 'selected' : '' ?>>Ja, die angegebenen Versicherungssummen enthalten Umsatzsteuer</option>
        <option value="Nein, die angegebenen Versicherungssummen enthalten keine Umsatzsteuer" <?php echo $result['indemnify_VAT'] == 'Nein, die angegebenen Versicherungssummen enthalten keine Umsatzsteuer' ? 'selected' : '' ?>>Nein, die angegebenen Versicherungssummen enthalten keine Umsatzsteuer</option>
        <option value="Teilweise, die Versicherungssummen wurden teilweise inkl. und exkl. Umsatzsteuer angegeben" <?php echo $result['indemnify_VAT'] == 'Teilweise, die Versicherungssummen wurden teilweise inkl. und exkl. Umsatzsteuer angegeben' ? 'selected' : '' ?>>Teilweise, die Versicherungssummen wurden teilweise inkl. und exkl. Umsatzsteuer angegeben</option>
    </select>
    <br>

<hr class="blue-line"> <!-- Blaue Linie eingefügt -->




    <!-- ERTRAGSAUSFALL- BZW. BETRIEBSUNTERBRECHUNGSVERSICHERUNG - -->

    <div>

        <h2>6. Ertragsausfall- bzw. Betriebsunterbrechungsversicherung</h2>

    </div>



    <!-- BU STROM-VERKAUF -->

    <label class="label-classic_v2">Soll der Ertragsausfall des eingespeisten (verkauften) Stroms versichert werden?</label>



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

    <label class="label-classic_v2">Soll der Ertragsausfall des Strom-Eigenverbrauchs versichert werden?</label>



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

        <!-- BEGIN SECTION RISK DESCRIPTION -->
        <div>
            <h2>Risikobeschreibung</h2>
        </div>

        <label class="label-classic-twolined">Wurde die Anlage von einem Fachbetrieb nach den anerkannten Regeln der Technik installiert und gesamtheitlich abgenommen (keine Selbstmontage)?</label>
        <select  name="risk_description_expert" id="risk_description_expert" required>
            <option value="" <?php echo $result['risk_description_expert'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
            <option value="Ja" <?php echo $result['risk_description_expert'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein" <?php echo $result['risk_description_expert'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>

        <label class="label-classic-twolined">Sind alle Komponenten erprobt und seriengefertigt (d.h. es handelt sich nicht um Erstkonstruktionen, Prototypen, Sonderanfertigungen oder Nullserien)?</label>
        <select name="risk_description_prototype" id="risk_description_prototype" required>
            <option value="" <?php echo $result['risk_description_prototype'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
            <option value="Ja" <?php echo $result['risk_description_prototype'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein" <?php echo $result['risk_description_prototype'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>

        <label class="label-classic-twolined">Wurde die Anlage nach dem Stand der Technik, den einschlägigen Normen, Richtlinien und Behördenvorschriften (z.B. mit Elektro-Erstprüfungsprotokoll) ausgeführt und abgenommen? Wird die Anlage gemäß Herstellervorgaben regelmäßig gewartet?</label>
        <select name="risk_description_maintenance" id="risk_description_maintenance" required>
            <option value="" <?php echo $result['risk_description_maintenance'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
            <option value="Ja" <?php echo $result['risk_description_maintenance'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein" <?php echo $result['risk_description_maintenance'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>

        <label class="label-classic-twolined">Entsprechen Blitz-, Überspannungs- und Überstromschutzeinrichtungen dem aktuellen Stand der Technik/ den einschlägigen Normen (z.B. EN 62305), wurden sie auf die Anlage abgestimmt und durch einen autorisierten Fachkundigen abgenommen?</label>
        <select name="risk_description_lightning"  id="risk_description_lightning" required>
            <option value="" <?php echo $result['risk_description_lightning'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
            <option value="Ja" <?php echo $result['risk_description_lightning'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein (Keine Deckung für Brand, Blitzschlag, etc.)" <?php echo $result['risk_description_lightning'] == 'Nein (Keine Deckung für Brand, Blitzschlag, etc.)' ? 'selected' : ''?>>Nein (Keine Deckung für Brand, Blitzschlag, etc.)</option>
        </select>
        <br><br>

        <label class="label-classic-twolined_v2">Sind der/ die Wechselrichter durch Überdachung, Bauart (oder da im Gebäude-Inneren befindlich) vor Witterungseinflüssen (z.B. Sturm, Hagel, Regen, Sonne, Schnee und Eis) geschützt?</label>
        
        <!-- Begin Buttons, but without Toggle-function -->
        <input type="radio" id="yes-risk_description_inverter_protection" name="risk_description_inverter_protection" value="Ja" <?php echo $result['risk_description_inverter_protection'] == 'Ja' ? 'checked' : ''?>>
        <label for="yes-risk_description_inverter_protection" class="toggle-label">Ja</label>

        <input type="radio" id="no-risk_description_inverter_protection" name="risk_description_inverter_protection" value="Nein" <?php echo $result['risk_description_inverter_protection'] == 'Nein' ? 'checked' : ''?>>
        <label for="no-risk_description_inverter_protection" class="toggle-label">Nein</label>
        <!-- End Buttons, but without Toggle-function -->
        <br><br>

        <label class="label-classic-twolined">Sind der/ die Wechselrichter und/ oder PV-Module direkt auf brennbarem Unterbau/ Untergrund montiert?</label>
        <select name="risk_description_combustible_substructure"  id="risk_description_combustible_substructure"  required>
            <option value="" <?php echo $result['risk_description_combustible_substructure'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
            <option value="Ja (Keine Deckung für Brand, Blitzschlag, etc.)"  <?php echo $result['risk_description_combustible_substructure'] == 'Ja (Keine Deckung für Brand, Blitzschlag, etc.)' ? 'selected' : ''?>>Ja (Keine Deckung für Brand, Blitzschlag, etc.)</option>
            <option value="Nein" <?php echo $result['risk_description_combustible_substructure'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>

        <label class="label-classic">Befindet sich die Anlage in einem unbewohnten Gebiet?</label>
        <select name="risk_description_uninhabited_area" id="risk_description_uninhabited_area" required>
            <option value="" <?php echo $result['risk_description_uninhabited_area'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
            <option value="Ja" <?php echo $result['risk_description_uninhabited_area'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein" <?php echo $result['risk_description_uninhabited_area'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>

        <label class="label-classic-twolined">Befindet sich die PV-Anlage auf oder an Gebäuden oder in der Nachbarschaft (in 30 m Umkreis) von folgenden Betrieben?</label>
        <select name="risk_description_fire_exposed_area" id="risk_description_fire_exposed_area"  required>
            <option value="" <?php echo $result['risk_description_fire_exposed_area'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
            <option value="Nein - kein Betrieb oder Betriebsart ist zutreffend." <?php echo $result['risk_description_fire_exposed_area'] == 'Nein - kein Betrieb oder Betriebsart ist zutreffend.' ? 'selected' : ''?>>Nein - kein Betrieb oder Betriebsart ist zutreffend.</option>
            <option value="Bergbau" <?php echo $result['risk_description_fire_exposed_area'] == 'Bergbau' ? 'selected' : ''?>>Bergbau</option>
            <option value="Chemische Industrie (mit leicht entflammbaren, brennbaren oder explosiven Stoffen)" <?php echo $result['risk_description_fire_exposed_area'] == 'Chemische Industrie (mit leicht entflammbaren, brennbaren oder explosiven Stoffen)' ? 'selected' : ''?>>Chemische Industrie (mit leicht entflammbaren, brennbaren oder explosiven Stoffen)</option>
            <option value="Erdöl oder Erdgas" <?php echo $result['risk_description_fire_exposed_area'] == 'Erdöl oder Erdgas' ? 'selected' : ''?>>Erdöl oder Erdgas</option>
            <option value="Gummi- oder Kunststoffindustrie" <?php echo $result['risk_description_fire_exposed_area'] == 'Gummi- oder Kunststoffindustrie' ? 'selected' : ''?>>Gummi- oder Kunststoffindustrie</option>
            <option value="Handel mit Waren aller Art (ohne Kenntnis der Warenart)" <?php echo $result['risk_description_fire_exposed_area'] == 'Handel mit Waren aller Art (ohne Kenntnis der Warenart)' ? 'selected' : ''?>>Handel mit Waren aller Art (ohne Kenntnis der Warenart)</option>
            <option value="Holzbetriebe" <?php echo $result['risk_description_fire_exposed_area'] == 'Holzbetriebe' ? 'selected' : ''?>>Holzbetriebe</option>
            <option value="Metallerzeugende Industrie" <?php echo $result['risk_description_fire_exposed_area'] == 'Metallerzeugende Industrie' ? 'selected' : ''?>>Metallerzeugende Industrie</option>
            <option value="Müllsammlung oder Recycling" <?php echo $result['risk_description_fire_exposed_area'] == 'Müllsammlung oder Recycling' ? 'selected' : ''?>>Müllsammlung oder Recycling</option>
            <option value="Papier- oder Zellstofferzeugung" <?php echo $result['risk_description_fire_exposed_area'] == 'Papier- oder Zellstofferzeugung' ? 'selected' : ''?>>Papier- oder Zellstofferzeugung</option>
            <option value="Pharmazeutische Industrie" <?php echo $result['risk_description_fire_exposed_area'] == 'Pharmazeutische Industrie' ? 'selected' : ''?>>Pharmazeutische Industrie</option>
        </select>
        <br><br>

        <label class="label-classic-twolined">Befindet sich die Anlage in einem wald-/ steppenbrandgefährdetem Gebiet? (Wenn ja, bitte Vorlage des Brandschutzkonzepts)</label>
        <select name="risk_description_wildfire" id="risk_description_wildfire"  required>
            <option value="" <?php echo $result['risk_description_wildfire'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
            <option value="Ja (Keine Deckung für Brand, Blitzschlag, etc.)" <?php echo $result['risk_description_wildfire'] == 'Ja (Keine Deckung für Brand, Blitzschlag, etc.)' ? 'selected' : ''?>>Ja (Keine Deckung für Brand, Blitzschlag, etc.)</option>
            <option value="Nein" <?php echo $result['risk_description_wildfire'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>

        <label class="label-classic-twolined">Ist die PV-Anlage leicht erreichbar? (bzw. im Brandfall müssen keine Behelfsstraßen, etc. errichtet werden)</label>
        <select name="risk_description_accessibility" id="risk_description_accessibility"  required>
            <option value="" <?php echo $result['risk_description_accessibility'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
            <option value="Ja, die Anlage ist leicht erreichbar" <?php echo $result['risk_description_accessibility'] == 'Ja, die Anlage ist leicht erreichbar' ? 'selected' : ''?>>Ja, die Anlage ist leicht erreichbar</option>
            <option value="Nein (Keine Deckung für Brand, Blitzschlag, etc.)" <?php echo $result['risk_description_accessibility'] == 'Nein (Keine Deckung für Brand, Blitzschlag, etc.)' ? 'selected' : ''?>>Nein (Keine Deckung für Brand, Blitzschlag, etc.)</option>
        </select>
        <br><br>

        <label class="label-classic-twolined">Befindet sich die PV-Anlage in unmittelbarer Nähe einer Windkraftanlage oder eines Flughafens? (Risiko des Eiswurfs)</label>
        <select name="risk_description_windpower"  id="risk_description_windpower" required>
            <option value="" <?php echo $result['risk_description_windpower'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
            <option value="Ja" <?php echo $result['risk_description_windpower'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein" <?php echo $result['risk_description_windpower'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>

        <label class="label-classic_v2"><b>Gibt es behördliche Wiederaufbau- oder Betriebsbeschränkungen?</b></label>
        <input type="radio" id="yes-restriction" name="risk_description_official_restriction" value="Ja" <?php echo $result['risk_description_official_restriction'] == 'Ja' ? 'checked' : ''?>>
        <label for="yes-restriction" class="toggle-label">Ja</label>
        <input type="radio" id="no-restriction" name="risk_description_official_restriction" value="Nein" <?php echo $result['risk_description_official_restriction'] == 'Nein' ? 'checked' : ''?>>
        <label for="no-restriction" class="toggle-label">Nein</label>
        <div class="toggle-content-restriction">
            <br>
            <label class="label-classic">In welcher Form?</label>
            <input type="text" name="risk_description_official_restriction_details"  id="risk_description_official_restriction_details"  value=<?php echo $result['risk_description_official_restriction_details']?>>
        </div>
        <br><br>

        <label class="label-classic-twolined">Ist die Systemstatik des Tragsystems der PV-Module für die Umgebungsbedingungen (Schnee- und Windlasten u.a.) nach den anerkannten Regeln der Technik (z.B. Euro Code 1 und 7, DIN 1055 oder gleichwertige Normen) nachgewiesen und eingehalten?</label>
        <select name="risk_description_statics" id="risk_description_statics" required>
            <option value="" <?php echo $result['risk_description_statics'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
            <option value="Ja" <?php echo $result['risk_description_statics'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein" <?php echo $result['risk_description_statics'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>

        <label class="label-classic">Sind die Module nach IEC 61215, IEC 61646 oder gleichwertigen Normen zertifiziert?</label>
        <select name="risk_description_certified" id="risk_description_certified" required>
            <option value="" <?php echo $result['risk_description_certified'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
            <option value="Ja" <?php echo $result['risk_description_certified'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein" <?php echo $result['risk_description_certified'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>

        <label class="label-classic">Besitzt die PV-Anlage flexible Dünnschichtmodule?</label>
        <select name="risk_description_flexible_modules" id="risk_description_flexible_modules" required>
            <option value="" <?php echo $result['risk_description_flexible_modules'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
            <option value="Ja (Keine Deckung von Hagel)" <?php echo $result['risk_description_flexible_modules'] == 'Ja' ? 'selected' : ''?>>Ja (Keine Deckung von Hagel)</option>
            <option value="Nein" <?php echo $result['risk_description_flexible_modules'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>

        <label class="label-classic-twolined">Wurden die Kabelstränge in Kabelschächten oder Leerrohren innerhalb und außerhalb der Anlage diebstahlsicher fixiert und verschlossen? (dies gilt insbesondere für Schachtöffnungen und Revisionsklappen)</label>
        <select name="risk_description_cable" id="risk_description_cable" required>
            <option value="" <?php echo $result['risk_description_cable'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
            <option value="Ja" <?php echo $result['risk_description_cable'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein" <?php echo $result['risk_description_cable'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>
        <br><br>
        <div class="toggle-content-charging_station">
            <!-- BEGIN RISK QUESTIONS CHARGING STATION -->
            <div class="subsection"><b>E-Ladestation(en)</b></div>
            <label class="label-classic">Handelt es sich um erprobte Typen, Konstruktionen (keine Prototypen)?</label>
            <select name="risk_description_charging_station_prototype" id="risk_description_charging_station_prototype">
                <option value="" <?php echo $result['risk_description_charging_station_prototype'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
                <option value="Ja" <?php echo $result['risk_description_charging_station_prototype'] == 'Ja' ? 'selected' : ''?>>Ja</option>
                <option value="Nein - Keine Deckung für Ladestationen" <?php echo $result['risk_description_charging_station_prototype'] == 'Nein - Keine Deckung für Ladestationen' ? 'selected' : ''?> >Nein - Keine Deckung für Ladestationen</option>
            </select>
            <br><br>

            <label class="label-classic-twolined">Erfolgte die Errichtung und Einbindung der Ladepunkte in das Verteilnetz nach den aktuellen, einschlägigen Normen und Verordnungen (z. B. DIN VDE 0100-722, IEC 63110)?</label>
            <select name="risk_description_charging_station_point" id="risk_description_charging_station_point">
                <option value="" <?php echo $result['risk_description_charging_station_point'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
                <option value="Ja" <?php echo $result['risk_description_charging_station_point'] == 'Ja' ? 'selected' : ''?>>Ja</option>
                <option value="Nein - Keine Deckung für Ladestationen" <?php echo $result['risk_description_charging_station_point'] == 'Nein - Keine Deckung für Ladestationen' ? 'selected' : ''?> >Nein - Keine Deckung für Ladestationen</option>
            </select>
            <br><br>

            <label class="label-classic-twolined">Wurde die Erstprüfung bei Errichtung bzw. Inbetriebnahme sowie regelmäßigen Wiederholungsprüfungen gemäß aktuellen einschlägigen Normen und Verordnungen durchgeführt?</label>
            <select name="risk_description_charging_station_standards" id="risk_description_charging_station_standards">
                <option value=""  <?php echo $result['risk_description_charging_station_standards'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
                <option value="Ja"  <?php echo $result['risk_description_charging_station_standards'] == 'Ja' ? 'selected' : ''?>>Ja</option>
                <option value="Nein - Keine Deckung für Ladestationen"  <?php echo $result['risk_description_charging_station_standards'] == 'Nein - Keine Deckung für Ladestationen' ? 'selected' : ''?>>Nein - Keine Deckung für Ladestationen</option>
            </select>
            <br><br>

            <label class="label-classic-twolined">Wurden die Ladepunkte auf Fahrebenen-Niveau konstruktiv mit einem wirksamen Anfahr-, Kollisions- bzw. Rammschutz versehen? (z. B. Rammschutzbügel, mindestens 50cm zurückversetzt auf einer Plattform mit Schramm- oder Hochboard)</label>
            <select name="risk_description_charging_station_protection" id="risk_description_charging_station_protection">
                <option value="" <?php echo $result['risk_description_charging_station_protection'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
                <option value="Ja" <?php echo $result['risk_description_charging_station_protection'] == 'Ja' ? 'selected' : ''?>>Ja</option>
                <option value="Nein - Keine Deckung für Ladestationen" <?php echo $result['risk_description_charging_station_protection'] == '"Nein - Keine Deckung für Ladestationen' ? 'selected' : ''?>>Nein - Keine Deckung für Ladestationen</option>
            </select>

            <!-- END RISK QUESTIONS CHARGING STATION -->
            <br><br>
        </div>
        <div class="toggle-content-battery_storage">
            <!-- BEGIN RISK QUESTIONS BATTERY STORAGE -->
            <div class="subsection"><b>Batteriespeicher</b></div>
            <label class="label-classic-twolined">Verfügt der Batteriespeicher über einen Tiefentladungsschutz und ist keine Unterschreitung der max. Entladetiefe gemäß Herstellervorgaben möglich? Wird die Anzahl der Ladezyklen dokumentiert bzw. aufgezeichnet?</label>
            <select name="risk_description_battery_storage_discharge_protection" id="risk_description_battery_storage_discharge_protection">
                <option value="" <?php echo $result['risk_description_battery_storage_discharge_protection'] == '' ? 'selected' : ''?>>Bitte wählen</option>
                <option value="Ja" <?php echo $result['risk_description_battery_storage_discharge_protection'] == 'Ja' ? 'selected' : ''?>>Ja</option>
                <option value="Nein - Keine Deckung für Batteriespeicher" <?php echo $result['risk_description_battery_storage_discharge_protection'] == 'Nein - Keine Deckung für Batteriespeicher' ? 'selected' : ''?>>Nein - Keine Deckung für Batteriespeicher</option>
            </select>
            <!-- END RISK QUESTIONS BATTERY STORAGE -->
            <br><br>
        </div>
        <hr class="blue-line"> <!-- Blaue Linie eingefügt -->
        <!-- END SECTION RISK DESCRIPTION -->

        <!-- BEGIN SECTION PREDAMAGE -->
        <div>
            <h2>Vorschäden/ Sonstige</h2>
        </div>

        <label class="label-classic_v2"><b>Gab es Schäden in den letzten fünf Jahren?</b></label>
        
        <div class="grey_bg_toggle"><label>Schäden für die noch kein Versicherungsschutz bestanden hat, sind auch anzugeben.</label>
        </div>
       

        <!-- Toggle-Buttons YES/NO -->

        <input type="radio" id="yes-predamage" name="predamage" value="Ja" <?php echo $result['predamage'] == 'Ja' ? 'checked' : ''?>>
        <label for="yes-predamage" class="toggle-label">Ja</label>

        <input type="radio" id="no-predamage" name="predamage" value="Nein" <?php echo $result['predamage'] == 'Nein' ? 'checked' : ''?>>
        <label for="no-predamage" class="toggle-label">Nein</label>
        <div class="toggle-content-predamage">
            <br>
            <label class="label-classic">Art, Anzahl, Zeitpunkt, Ursache und Aufwendung der Schäden sind anzugeben:</label>
            <textarea name="predamage_details" id="predamage_details" rows="4" cols="1" maxlength="500"><?php echo $result['predamage_details']?></textarea>
        </div>
        <br>
        <br>
        <label class="label-classic-twolined">Wurde die Versicherung der Anlage in der Vergangenheit von Allianz oder einem anderen Versicherer abgelehnt?</label>
        <select name="predamage_refusal"  id="predamage_refusal" required>
            <option value="" <?php echo $result['predamage_refusal'] == '' ? 'selected' : ''?>>Bitte wählen</option>x^
            <option value="Ja" <?php echo $result['predamage_refusal'] == 'Ja' ? 'selected' : ''?>>Ja</option>
            <option value="Nein" <?php echo $result['predamage_refusal'] == 'Nein' ? 'selected' : ''?>>Nein</option>
        </select>


        <hr class="blue-line"> <!-- Blaue Linie eingefügt -->

        <!-- END SECTION PREDAMAGE -->

        <!-- BEGIN SECTION HOLD -->
        <div>
            <h2>Sperrschein</h2>
        </div>

        <label class="label-classic_v2"><b>Wird eine Vinkulierung (Sperrschein) benötigt?</b><br></label>

        <!-- Toggle-Buttons YES/NO -->

        <input type="radio" id="yes-hold" name="hold" value="Ja" <?php echo $result['hold'] == 'Ja' ? 'checked' : ''?>>
        <label for="yes-hold" class="toggle-label">Ja</label>

        <input type="radio" id="no-hold" name="hold" value="Nein" <?php echo $result['hold'] == 'Nein' ? 'checked' : ''?>>
        <label for="no-hold" class="toggle-label">Nein</label>
        <div class="toggle-content-hold">
            <br>
            <label class="label-classic" for="hold_street">Gläubiger gemäß Firmenbuch (z.B. Bank, Leasingfirma)</label>
            <input type="text" name="hold_creditor" id="hold_creditor" value=<?php echo $result['hold_creditor']?>>
            <br>
            <label class="label-classic" for="hold_street">Straße und Hausnummer</label>
            <input type="text" name="hold_street" id="hold_street" value=<?php echo $result['hold_street']?>>
            <br>
            <label class="label-classic" for="hold_postalcode">Postleitzahl</label>
            <input type="text" name="hold_postalcode"  id="hold_postalcode" maxlength="8" value=<?php echo $result['hold_postalcode']?>>
            <br>
            <label class="label-classic" for="hold_place">Ort</label>
            <input type="text" name="hold_place" id="hold_place" value=<?php echo $result['hold_place']?>>
            <br>
            <label class="label-classic" for="hold_contact">Kontaktperson</label>
            <input type="text" name="hold_contact" id="hold_contact" value=<?php echo $result['hold_contact']?>>
            <br>
            <label class="label-classic" for="hold_email">E-Mail</label>
            <input type="email" name="hold_email" id="hold_email" value=<?php echo $result['hold_email']?>>
            <!-- Validierung ob es sich um eine echte E-Mail-Adresse handelt, wird aufgrund HTML5 durchgeführt. -->
        </div>

        <hr class="blue-line"> <!-- Blaue Linie eingefügt -->

        <!-- END SECTION HOLD -->

        <!-- BEGIN SECTION COINSURED COMPANY -->
        <div>
            <h2>Mitversichertes Unternehmen</h2>
        </div>

        <label class="label-classic_v2"><b>Wird die Mitversicherung eines Unternehmens gewünscht?</b><br></label>

        <!-- Toggle-Buttons YES/NO -->
        <input type="radio" id="yes-coinsured" name="coinsured" value="Ja" <?php echo $result['coinsured'] == 'Ja' ? 'checked' : '' ?>>
        <label for="yes-coinsured" class="toggle-label">Ja</label>

        <input type="radio" id="no-coinsured" name="coinsured" value="Nein" <?php echo $result['coinsured'] == 'Nein' ? 'checked' : '' ?>>
        <label for="no-coinsured" class="toggle-label">Nein</label>
        <br>

        <div class="toggle-content-coinsured">
            <div class="grey_bg_toggle"><label>Falls sich der Versicherungsort außerhalb Österreichs befindet: Min. 50% der Gesellschaft muss in österreichischem Besitz sein.</label>
            </div>
            <br>
            <label class="label-classic">Name des Unternehmens</label>
            <input type="text" name="coinsured_company" id="coinsured_company" value=<?php echo  $result['coinsured_company']?>>
            <br>
            <label class="label-classic">Straße und Hausnummer</label>
            <input type="text" name="coinsured_street"  id="coinsured_street" value=<?php echo  $result['coinsured_street']?>>
            <br>
            <label class="label-classic">Postleitzahl</label>
            <input type="text" name="coinsured_postalcode"  id="coinsured_postalcode" maxlength="8" value=<?php echo  $result['coinsured_postalcode']?>>
            <br>
            <label class="label-classic">Ort</label>
            <input type="text" name="coinsured_place" id="coinsured_place" value=<?php echo  $result['coinsured_place']?>>
            <br>
            <label class="label-classic">In der Eigenschaft als</label>
            <input type="text" name="coinsured_function" id="coinsured_function" value=<?php echo  $result['coinsured_function']?>>
        </div>


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
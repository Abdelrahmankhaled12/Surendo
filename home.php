<?php
require "db_connection.php";
session_start();

if (isset($_SESSION["user_id"])) {
    $sql = 'SELECT * FROM `pv_plants` WHERE `user_id` = ? ORDER BY `is_completed` ASC, `id` DESC';
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Allrisk-Versicherung Photovoltaikanlagen - Neuer Antrag</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/table.css">
</head>

<body>
    <img src="./gfx/Logo_clean_Pfad_Randlos_BIG.jpg" alt="Image" />
    <br>
    <br>
    <div>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="formBox">
                <div class="top">
                    <p><strong>Versicherungsbeginn:</strong> <?php echo $row["date_commencement"] ?></p>
                    <div class="flex">
                        <?php if (!($row["is_completed"])) { ?>
                            <div class="status uncompleted">
                                uncompleted
                            </div>
                            <form method="POST" action="complete-form.php">
                                <input type="hidden" name="form_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <div class="buttons">
                                    <button type="submit">Complete</button>
                                </div>
                            </form>
                        <?php } ?>
                        <?php if ($row["is_completed"]) { ?>
                            <div class="status completed">
                                completed
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <table onabort="">
                    <thead>
                        <tr>
                            <th>1. Antragsteller/in (Versicherungsnehmer/in)</th>
                            <th>2. Versicherungsort</th>
                            <th>3. Technische Daten der PV-Anlage</th>
                            <th>4. Ertragsausfall- bzw. Betriebsunterbrechungsversicherung</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="box">
                                    <p><strong> Firmenname:</strong> <?php echo $row["applicant"] ?></p>
                                    <p><strong> Straße und Hausnummer:</strong> <?php echo $row["street"] ?></p>
                                    <p><strong> Postleitzahl:</strong> <?php echo $row["postalcode"] ?></p>
                                    <p><strong> Ort:</strong> <?php echo $row["place"] ?></p>
                                    <p><strong> E-Mail:</strong> <?php echo $row["tracker"] ?></p>
                                    <div class="subsection"><b>Antragsteller/in im Verhältnis zur Anlage: <?php echo $row["relation_to_plant"] ?></b></div>
                                    <?php if ($row["relation_to_plant"] == 'owner_only') { ?>
                                        <p><strong> Firmenname:</strong> <?php echo $row["owner_name"] ?></p>
                                        <p><strong> Straße und Hausnummer:</strong> <?php echo $row["owner_street"] ?></p>
                                        <p><strong> Postleitzahl:</strong> <?php echo $row["owner_postalcode"] ?></p>
                                        <p><strong> Ort:</strong> <?php echo $row["owner_place"] ?></p>
                                    <?php } ?>

                                    <?php if ($row["relation_to_plant"] == 'operator_foreign_plant') { ?>
                                        <p><strong> Firmenname:</strong> <?php echo $row["operator_name"] ?></p>
                                        <p><strong> Straße und Hausnummer:</strong> <?php echo $row["operator_street"] ?></p>
                                        <p><strong> Postleitzahl:</strong> <?php echo $row["operator_postalcode"] ?></p>
                                        <p><strong> Ort:</strong> <?php echo $row["operator_place"] ?></p>
                                    <?php } ?>
                                </div>
                            </td>
                            <td>
                                <div class="box">
                                    <div class="subsection"><b>Address- oder Koordinateneingabe</b></div>
                                    <?php if (($row["address_or_coordinates"] == "address")) { ?>
                                        <p><strong> Straße und Hausnummer:</strong> <?php echo $row["address_street"] ?></p>
                                        <p><strong> Postleitzahl:</strong> <?php echo $row["address_postalcode"] ?></p>
                                        <p><strong> Ort:</strong> <?php echo $row["address_place"] ?></p>
                                    <?php } else { ?>
                                        <p><strong>Ost/Nord-Koordinaten (Dezimalgrad z.B. 2.17403 41.40338): </strong> <?php echo $row["coordinates"] ?></p>
                                    <?php } ?>
                                    <div class="subsection"><b>Land</b></div>
                                    <?php if (($row["insured_land"] == "Ausland")) { ?>
                                        <p><strong> Land:</strong> <?php echo $row["insured_land"] ?></p>
                                        <p><strong> Name des Landes:</strong> <?php echo $row["name_other_land"] ?></p>
                                        <p><strong> Die Gesellschaft des Antragssteller/-s/-in befindet sich zu mindestens 50% in österreichischem Besitz (direkt oder indirekt):</strong> <?php echo $row["applicant_share_50"] ?></p>
                                    <?php } else { ?>
                                        <p><strong> Land:</strong> <?php echo $row["insured_land"] ?></p>
                                    <?php } ?>

                                    <div class="subsection"><b>Sonstige Fragen</b></div>
                                    <p><strong>Wurde die PV-Anlage in/ auf Gewässern errichtet:</strong> <?php echo $row["water"] ?></p>
                                    <p><strong>Sind die PV-Module im österreichischen Hagelschutzregister eingetragen:</strong> <?php echo $row["hagelregister"] ?>
                                    </p>
                                    <p><strong>Ist die PV-Anlage betriebsfertig:</strong> <?php echo $row["in_operation"] ?></p>
                                    <p><strong>Fällt irgendwo Schatten auf die Module der Anlage? Durch die (Teil)- Verschattung ist
                                            die Bildung von Hot-Spots möglich:</strong> <?php echo $row["shadowed"] ?></p>
                                    <p><strong>Sind die Module sonnenstandsnachgeführt? ("Tracker"):</strong> <?php echo $row["tracker"] ?></p>
                                    <p><strong>st der Zustand des Untergrunds der PV-Anlage (Dachflächen, Grund und Boden) frei von
                                            bekannten Schäden, Mängeln, Schadstoffen oder Umwelt-Altlasten:</strong> <?php echo $row["ground_condition"] ?></p>
                                </div>
                            </td>
                            <td>
                                <div class="box">
                                    <div class="subsection"><b>Module und Leistung</b></div>
                                    <p>
                                        <strong>Hersteller:</strong> <?php echo $row["panel_manufacturer"] ?>
                                    </p>
                                    <p>
                                        <strong>Type:</strong> <?php echo $row["panel_type"] ?>
                                    </p>
                                    <p>
                                        <strong>Anzahl der Module:</strong> <?php echo $row["panel_amount"] ?>
                                    </p>
                                    <p>
                                        <strong>Leistung je Module (Wp):</strong> <?php echo $row["output_per_panel"] ?>
                                    </p>
                                    <p>
                                        <strong>Nennleistung gesamt bzw. aller Module (kWp):</strong> <?php echo $row["output_total"] ?>
                                    </p>
                                    <p>
                                        <strong>Gesamtfläche (m²):</strong> <?php echo $row["area"] ?>
                                    </p>
                                    <div class="subsection"><b>Wechselrichter</b></div>
                                    <p>
                                        <strong>Hersteller:</strong> <?php echo $row["inverter_manufacturer"] ?>
                                    </p>
                                    <p>
                                        <strong>Type:</strong> <?php echo $row["inverter_type"] ?>
                                    </p>
                                    <p>
                                        <strong>Anzahl der Wechselrichter:</strong> <?php echo $row["inverter_amount"] ?>
                                    </p>
                                    <p>
                                        <strong>Leistung je Wechselrichter (kVA):</strong> <?php echo $row["output_per_inverter"] ?>
                                    </p>
                                    <div class="subsection"><b>Neuwert in € (ohne Preisnachlässe)</b></div>
                                    <p>
                                        <strong>Module (€):</strong> <?php echo $row["eur_panels"] ?>
                                    </p>
                                    <p>
                                        <strong>Wechselrichter (€):</strong> <?php echo $row["eur_inverter"] ?>
                                    </p>
                                    <p>
                                        <strong>Transformator NUR für die PV-Anlage; nur dann ist der Trafo versicherbar
                                            (€):</strong> <?php echo $row["eur_transformer"] ?>
                                    </p>
                                    <p>
                                        <strong>Tragkonstruktion (€):</strong> <?php echo $row["eur_supporting_structure"] ?>
                                    </p>
                                    <p>
                                        <strong>24/7-Videoüberwachung mit Bewegungsmelder (€):</strong> <?php echo $row["eur_video"] ?>
                                    </p>
                                    <p>
                                        <strong>Zaun/ Umzäunung; kein Mobilzaun! (€):</strong> <?php echo $row["eur_fence"] ?>
                                    </p>
                                    <p>
                                        <strong>Sonstige bzw. Sammelposition für zuvor nicht genannte Komponenten (€):</strong> <?php echo $row["eur_miscellaneous"] ?>
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="box">
                                    <?php if ($row["business_interruption"] == "Ja") { ?>
                                        <p><strong>Soll der Ertragsausfall des eingespeisten (verkauften) Stroms versichert
                                                werden: </strong> <?php echo $row["business_interruption"] ?></p>
                                        <div class="subsection"><b>Strom-Verkauf (bei Einspeisung)</b></div>
                                        <p>
                                            <strong>kWh an Jahres-Eigenverbrauch:</strong> <?php echo $row["BI_annual_feed"] ?>
                                        </p>
                                        <p>
                                            <strong>x Einspeisevergütung gemäß EVU-Vertrag in € / kWh:</strong> <?php echo $row["BI_feed_in_tariff"] ?>
                                        </p>
                                    <?php } else { ?>
                                        <p><strong>Soll der Ertragsausfall des eingespeisten (verkauften) Stroms versichert
                                                werden: </strong> <?php echo $row["business_interruption"] ?></p>
                                    <?php } ?>

                                    <div class="subsection"><b>Strom-Zukauf (Eigenverbrauch)</b></div>
                                    <?php if ($row["self_consumption"] == "Ja") { ?>
                                        <p><strong>Soll der Ertragsausfall des Strom-Eigenverbrauchs versichert werden: </strong> <?php echo $row["self_consumption"] ?></p>
                                        <div class="subsection"><b>Strom-Verkauf (bei Einspeisung)</b></div>
                                        <p>
                                            <strong>kWh an Jahres-Eigenverbrauch:</strong> <?php echo $row["BI_annual_self_consumption"] ?>
                                        </p>
                                        <p>
                                            <strong>x Einspeisevergütung gemäß EVU-Vertrag in € / kWh:</strong> <?php echo $row["BI_self_consumption_tariff"] ?>
                                        </p>
                                    <?php } else { ?>
                                        <p><strong>Soll der Ertragsausfall des Strom-Eigenverbrauchs versichert werden: </strong> <?php echo $row["self_consumption"] ?></p>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>


</body>

</html>
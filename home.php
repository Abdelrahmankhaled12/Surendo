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
    $_SESSION["must_login_first"] = true;
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Allrisk-Versicherung Photovoltaikanlagen - Neuer Antrag</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css?v=1.1">
    <link rel="stylesheet" href="./css/table.css">
</head>
<body>
<div class="icons-container">
    <a href="log-out.php" class="login-link">
        <button class="login-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
        </button>
    </a>
</div>
<img src="./gfx/Logo_clean_Pfad_Randlos_BIG.jpg" alt="Image" />
<br>
<br>
<div>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="formBox">
            <div class="top">
                <div class="flex">
                    <?php if (!($row["is_completed"])) { ?>
                        <div class="status uncompleted">
                            <i class="fa-solid fa-square-xmark"></i> Offen
                        </div>
                        <form method="POST" action="complete-form.php">
                            <input type="hidden" name="form_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <div class="buttons">
                                <button type="submit">Projekt fertigstellen</button>
                            </div>
                        </form>
                    <?php } ?>
                    <?php if ($row["is_completed"]) { ?>
                        <div class="status completed">
                            <i class="fa-solid fa-square-check"></i> Abgeschlossen
                        </div>
                    <?php } ?>
                </div>
            </div>
            <table>
                <thead>
                <tr>
                    <th>Projekt-ID, Antragsteller/in, etc. </th>
                    <th>Standort der Anlage</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <div class="box">
                            <p><strong>ID-Nr.:</strong> <?php echo $row["id"] ?></p>
                            <p><strong><?php echo $row["applicant"] ?></strong>, <?php echo $row["street"] ?>, <?php echo $row["postalcode"] ?> <?php echo $row["place"] ?></p>
                            <p><strong>Versicherungsbeginn:</strong> <?php echo $row["date_commencement"] ?></p>
                        </div>
                    </td>
                    <td>
                        <div class="box">
                            <?php if (($row["address_or_coordinates"] == "address")) { ?>
                                <p><strong>Straße und Hausnummer:</strong> <?php echo $row["address_street"] ?></p>
                                <p><strong>Postleitzahl und Ort:</strong> <?php echo $row["address_postalcode"] ?> <?php echo $row["address_place"] ?></p>
                            <?php } else { ?>
                                <p><strong>Ost/Nord-Koordinaten (Dezimalgrad z.B. 2.17403 41.40338):</strong> <?php echo $row["coordinates"] ?></p>
                            <?php } ?>
                            <?php if (($row["insured_land"] == "Ausland")) { ?>
                                <p><strong>Land:</strong> <?php echo $row["insured_land"] ?></p>
                                <p><strong>Name des Landes:</strong> <?php echo $row["name_other_land"] ?></p>
                            <?php } else { ?>
                                <p><strong>Land:</strong> <?php echo $row["insured_land"] ?></p>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>
<?php if (isset($_SESSION["success_message"])) { ?>
    <div class="showPass" id="showPass">
        <div class="closeModel" id="closeModel"></div>
        <div class="content">
            <div class="center">
                <h1>Projekt erfolgreich abgeschlossen</h1>
                <br>Sie haben das Projekt erfolgreich abgeschlossen bzw. die Formulardaten übermittelt.<br>&nbsp;<br>
                <button id="closeModelButton">OK</button>
            </div>
        </div>
    </div>
<?php }
unset($_SESSION["success_message"]); ?>
<script src="js/script.js?v=2.8"></script>
</body>
</html>
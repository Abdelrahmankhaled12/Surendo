<!DOCTYPE html>
<html lang="de">
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Allrisk-Versicherung Photovoltaikanlagen - Passwort vergessen</title>
    <link rel="stylesheet" href="css/style.css?v=1.1">
</head>

<body>
    <img src="/gfx/Logo_clean_Pfad_Randlos_BIG.jpg" alt="Image" />
    <br><br>

    <form method="post" action="forget-password.php"> <!-- Action points to the PHP script that handles submission -->

        <div class="box_headline">
            <h1>Allrisk- inkl. Ertragsausfallversicherung <br>für Photovoltaikanlagen</h1>
        </div>

        <br>

        <hr class="blue-line"> <!-- Blaue Linie eingefügt -->

        <div>
            <h2>Passwort vergessen</h2>
        </div>

        <div class="form-container"> <!-- Container to align input fields -->
            <label class="label-classic" for="applicant_email">E-Mail</label>
            <input type="email" id="applicant_email" name="email" required>
            <br>&nbsp;<br>
        </div>

        <hr class="blue-line"> <!-- Blaue Linie eingefügt -->

        <div class="subsection-save">
            <input type="submit" value="Passwort senden">
        </div>

    </form>

    <div class="center">
        <a href="index.php">Neuer Antrag</a>
    </div>
    <?php if (isset($_SESSION["password-reset"])) { ?>
        <div class="showPass" id="showPass">
            <div class="closeModel" id="closeModel"></div>
            <div class="content">
                <div style="text-align: center;">
                    <h1>Ein neues Passwort wurde an Ihre E-Mail-Adresse gesendet</h1>
                    <br>
                        <?php echo htmlspecialchars($_SESSION["password-reset"]); ?><br>&nbsp;<br>
                    
                    <button id="closeModelButton">Ok</button>
                </div>
            </div>
        </div>
    <?php }
    unset($_SESSION["password-reset"]); ?>

    <script src="js/script.js?v=2.8"></script>
</body>
<!-- Hier binden wir die externe JavaScript-Datei ein -->

</html>
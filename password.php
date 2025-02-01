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
    <title>Allrisk-Versicherung von Photovoltaikanlagen - Passwort vergessen</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

<div class="icons-container">

    <a href="index.php" class="login-link"><button class="login-btn"><i class="fa-solid fa-house"></i></button></a>

</div>

<div class="center">
    <a href="index.php" class="logo-surendo"><img src="./gfx/Logo_TM.jpg" alt="Surendo.com" /></a>
</div>
<br><br>

<form method="post" action="forget-password.php"> <!-- Action points to the PHP script that handles submission -->

    <div class="box_headline">
        <h1>Anmeldebereich und <br>Benutzer-Login</h1>
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
    
</form>

<br>
        <div class="center">

            <a href="index.php">Neues Projekt</a>

        </div>

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

<?php if (isset($_SESSION["invalid_email"])) { ?>
    <div class="showPass" id="showPass">
        <div class="closeModel" id="closeModel"></div>
        <div class="content">

            <div class="center">

                <h1>Kein Benutzer mit dieser E-Mail-Adresse gefunden</h1>
                <br>
                Bitte überprüfen Sie Ihre E-Mail-Adresse.<br>&nbsp;<br>
                <button id="closeModelButton">OK</button>

            </div>

        </div>
    </div>
<?php }
unset($_SESSION["invalid_email"]); ?>

<script src="js/script.js"></script>
</body>
<!-- Hier binden wir die externe JavaScript-Datei ein -->

</html>
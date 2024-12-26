<?php
if (session_status() === PHP_SESSION_NONE) {

    session_start();

} // Session starten
?>
<!DOCTYPE html>

<html lang="de">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Allrisk-Versicherung Photovoltaikanlagen - Login</title>

    <link rel="stylesheet" href="css/style.css?v=1.1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

<div class="icons-container">

    <a href="login.php" class="login-link"><button class="login-btn"><i class="fa-regular fa-user"></i></button></a>

</div>



<img src="./gfx/Logo_clean_Pfad_Randlos_BIG.jpg" alt="Image" />

<br>

<br>



<form method="post" action="login_logic.php">



    <div class="box_headline"><h1>Allrisk- inkl. Ertragsausfallversicherung <br>für Photovoltaikanlagen</h1></div>



    <br>



    <hr class="blue-line"> <!-- Blaue Linie eingefügt -->



    <div><h2>Benutzer-Login</h2></div>

    <div class="form-container"> <!-- Container damit Input-Felder Date linksbündig angeordnet wird -->



        <label class="label-classic">E-Mail</label>

        <input type="email" name="email" required> <!-- Validierung ob es sich um eine echte E-Mail-Adresse handelt, wird aufgrund HTML5 durchgeführt. -->



        <label class="label-classic">Passwort</label>

        <input type="password" name="password" required>



        <label class="label-classic"><a href="password.php">Passwort vergessen?</a></label>

        <br>&nbsp;

        <br>

    </div>

    <hr class="blue-line"> <!-- Blaue Linie eingefügt -->



    <div class="subsection-save">



        <input type="submit" value="Einloggen"><br>



</form>



<div class="center">

    <a href="load.php">Formular leeren</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="index.php">Neuer Antrag</a>

</div>

</div>

<?php if (isset($_SESSION["wrong_email"])) { ?>

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
unset($_SESSION["wrong_email"]); ?>

<?php if (isset($_SESSION["wrong_password"])) { ?>

    <div class="showPass" id="showPass">

        <div class="closeModel" id="closeModel"></div>

        <div class="content">

            <div class="center">

                <h1>Das Passwort ist falsch</h1>
                <br>
                Bitte überprüfen Sie Ihr Passwort oder verwenden Sie die Funktion <a href="password.php">Passwort vergessen?</a><br>&nbsp;<br>
                <button id="closeModelButton">OK</button>

            </div>

        </div>

    </div>



<?php }
unset($_SESSION["wrong_password"]); ?>


<script src="js/script.js?v=2.8"></script>

</body>

</html>


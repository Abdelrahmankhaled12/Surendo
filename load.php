    <!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Allrisk-Versicherung Photovoltaikanlagen - Gespeicherten Antrag fortsetzen</title>
    <link rel="stylesheet" href="css/style.css?v=1.1">
</head>
<body>
<img src="/gfx/Logo_clean_Pfad_Randlos_BIG.jpg" alt="Image" />
<br>
<br>

<form method="post" action="">

<div class="box_headline"><h1>Allrisk- inkl. Ertragsausfallversicherung <br>für Photovoltaikanlagen</h1></div>

<br>

<hr class="blue-line"> <!-- Blaue Linie eingefügt -->

<div><h2>Gespeicherten Antrag fortsetzen</h2></div>
<div class="form-container"> <!-- Container damit Input-Felder Date linksbündig angeordnet wird --> 
    <label class="label-classic">ID-Nummer des Projekts</label>
    <input type="number" name="id_number" required>

    <label class="label-classic">E-Mail</label>
    <input type="email" name="applicant_email" required> <!-- Validierung ob es sich um eine echte E-Mail-Adresse handelt, wird aufgrund HTML5 durchgeführt. -->

    <label class="label-classic">Passwort</label>
    <input type="password" name="password_load" required>

    <label class="label-classic"><a href="password.php">Passwort vergessen?</a></label>
    <br>&nbsp;
    <br>
</div>
<hr class="blue-line"> <!-- Blaue Linie eingefügt -->

<div class="subsection-save">
    
        <input type="submit" value="Antrag fortsetzen"><br>

        </form>

        <div class="center">
        <a href="load.php">Formular leeren</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="index.php">Neuer Antrag</a>
        </div>
</div>


</body>
</html>

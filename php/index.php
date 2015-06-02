<!DOCTYPE html>
<html>
<title>Kaugummi - DemoCode für glückliche Kunden</title>
<meta charset="UTF-8">
<meta name="description" content="Demo Code für Kaugummiverwaltung">
<meta name="keywords" content="Demo, PHP, MySQL, lecker, Kaugummi">

<!-- CSS auskommentieren um das PLAN Ergebnis zu sehen -->
<link rel="stylesheet" type="text/css" href="style.css">
<body>
<?php

/**
 * Datenbank Struktur und Daten
 * sql-import: 'kaugummisorten.sql'
 */

/*
 * Neue Datenbankverbindung mysqli
 */

/* Konstanten für Datenbank Verbindung */
define ('dbHOST','localhost');
define ('dbUSER','root');
define ('dbPASS','root');
define ('dbSCHEMA','demo');

/**
 * Deklarierung der Formular-Variablen
 * @var string  $_POST[]    Formularfeld name
 * @var string  $form[]     Array Übernahme des $_POST String
 */
$form['id'] = isset($_POST['id']) ? $_POST['id'] : '';
$form['name'] = isset($_POST['name']) ? $_POST['name'] : '';
$form['geschmack'] = isset($_POST['geschmack']) ? $_POST['geschmack'] : '';
$form['farbe'] = isset($_POST['farbe']) ? $_POST['farbe'] : '';
$form['preis'] = isset($_POST['preis']) ? $_POST['preis'] : '';

/* mySQLi Verbindung */
$db_link = mysqli_connect(dbHOST, dbUSER, dbPASS, dbSCHEMA);

/* UTF-8 Konvertierung */
mysqli_set_charset($db_link, "utf8");

/* Verbindungsprüfung */
if ($db_link->connect_error) {
    die("Connection failed: " . $db_link->connect_error);
}

/* Daten Neuanlage */
if ($form['id']=="" && $form['name']!="") {
    /*String Preis für D*/
    $form['preis'] = str_replace(".", ",", $form['preis']);
    $DBinsert="INSERT INTO kaugummisorten
       (id,name,geschmack,farbe,preis)
       VALUES
       ('','".mysqli_real_escape_string($db_link,$form['name'])."',".mysqli_real_escape_string($db_link,$form['geschmack']).",'".mysqli_real_escape_string($db_link,$form['farbe'])."','".mysqli_real_escape_string($db_link,$form['preis'])."')";
    $querry=mysqli_query($db_link,$DBinsert)or die (mysql_error());
}
/* Daten aktualisieren wenn ID und Name übergeben wird, also nicht leer ist */
if ($form['id'] != "" && $form['name'] != "") {
    /* Update des Datensatz*/
    $DBupdate="UPDATE kaugummisorten SET
          name = '".mysqli_real_escape_string($db_link,$form['name'])."',
          geschmack=".mysqli_real_escape_string($db_link,$form['geschmack']).",
          farbe='".mysqli_real_escape_string($db_link,$form['farbe'])."',
          preis='".mysqli_real_escape_string($db_link,$form['preis'])."'
    WHERE id = '".mysqli_real_escape_string($db_link,$form['id'])."'";
    $querry=mysqli_query($db_link,$DBupdate)or die (mysql_error());
}

?>
<main>
<div class="content">
<h1>Kaugummi - Demo Code f&uuml;r gl&uuml;ckliche Kunden</h1>

<!-- Eingabe/Edit Formular -->
<form method="post" action="./">
<input type="hidden" name="id" value="<?php echo $form['id']; ?>">
<table border="0" cellpadding="2" cellspacing="1" width="300">
    <tr>
        <th colspan="2">Kaugummilager bearbeiten <?php if($form['id']!="") echo "(".$form['id'].")"; ?></th>
    </tr>
    <tr>
        <td>Name:</td>
        <td><input type="text" name="name" value="<?php echo $form['name']; ?>"></td>
    </tr>
    <tr>
        <td>Geschmack:</td>
        <td>
            <select name=geschmack>
                <?php
                if ($form['geschmack'] =="")
                {ECHO "<option value ='0' selected>Bitte w&auml;hlen!</option>";}
                ELSE {ECHO "<option value ='0'>Bitte w&auml;hlen!</option>";}

                if ($form['geschmack'] == 1)
                    echo "<option value='1' selected>S&uuml;&szlig</option>";
                else echo "<option value='1'>S&uuml;&szlig</option>";
                if ($form['geschmack'] == 2)
                    echo "<option value='2' selected>Sauer</option>";
                else echo "<option value='2'>Sauer</option>";
                if ($form['geschmack'] != 1 && $form['geschmack'] != 2 && $form['geschmack'] != "")
                    echo "<option value='3' selected>Anders</option>";
                else echo "<option value='3'>Anders</option>";
            ?>
        </td>
    </tr>
    <tr>
        <td>Farbe:</td>
        <td><input type="text" name="farbe" value="<?php echo $form['farbe']; ?>"></td>
    </tr>
    <tr>
        <td>Preis:</td>
        <td><input type="text" name="preis" value="<?php echo $form['preis']; ?>"></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right;">
            <input type="submit" value="speichern">
        </td>
    </tr>
</table>
</form>




<?php
/* Tabellenausgabe*/
/* Variablen deklarieren*/
$tabelle['id'] = isset($tabelle['id']) ? $tabelle['preis'] : '';
$tabelle['name'] = isset($tabelle['name']) ? $tabelle['name'] : '';
$tabelle['geschmack'] = isset($tabelle['geschmack']) ? $tabelle['geschmack'] : '';
$tabelle['farbe'] = isset($tabelle['farbe']) ? $tabelle['farbe'] : '';
$tabelle['preis'] = isset($tabelle['preis']) ? $tabelle['preis'] : '';

/* Einfache Tabellenausgabe mit Tabellen HEAD */
ECHO '<table border="0" cellpadding="2" cellspacing="1" width="600">
            <tr>
            <th>dbID</th>
            <th>Name</th>
            <th>Geschmack</th>
            <th>Farbe</th>
            <th>Preis</th>
            <th>&nbsp;</th>
            </tr>';


/* Hole vorhandene DS aus der DB */
    $res = mysqli_query($db_link,"SELECT * FROM kaugummisorten");
    if (mysqli_num_rows($res)>0) /* Sind Datensätze vorhanden dann stell sie dar */ {
        while ($tabelle = mysqli_fetch_array($res)) {

            /* Schleifendurchlauf für jeden Datensatz */

                /* Ersetze ggfls. Punk im Preis mit Komma */
                $tabelle['preis'] = str_replace(".", ",", $tabelle['preis']);

                /* Zeilenaufbau je Datensatz */
                ECHO "<tr>
                <!-- Neuer Datensatz aus Datenbank -->
                <td>".$tabelle['id']."</td>
                <!-- Name des Produktes -->
                <td>".$tabelle['name']."</td>
                <!-- Geschmak des Produktes @TODO: mit INNER JOIN noch optimieren -->
                <td>";
                /* Setze den Geschmack */
                if ($tabelle['geschmack'] == 1) {
                    ECHO 'S&uuml;&szlig';
                } elseif ($tabelle['geschmack'] == 2) {
                    ECHO 'Sauer';
                } else {
                    ECHO 'Anders';
                }
                ECHO "</td>
                <!-- Farbe des Produktes -->
                <td>".$tabelle['farbe']."</td>
                <!-- CSS td.Class - Formatierung für das Preisfeld -->
                <!-- CSS span.Class - Preisfeld mit Währungszeichen -->
                <td class='preis'><span class='preis'>".$tabelle['preis']."</span></td>
                <!-- Der Edit Button übergibt im 'hidden' einfach noch mal alle Werte -->
                <td>
                <form method='post' action='./'>
                <input type='hidden' name='id' value='".$tabelle['id']."'>
                <input type='hidden' name='name' value='".$tabelle['name']."'>
                <input type='hidden' name='geschmack' value='".$tabelle['geschmack']."'>
                <input type='hidden' name='farbe' value='".$tabelle['farbe']."'>
                <input type='hidden' name='preis' value='".$tabelle['preis']."'>
                <input type='submit' value='&auml;ndern' class='button'>
                </form>
                </td>
        </tr>
        ";
        }
    }   /* Ende WHILE Schleife*/
    ELSE /* Falls keine Datensätze vorhanden sind */
    {
       ECHO'<tr>
                <td colspan="6" style="background-color: #cccccc;">Noch keine Kaugummisorten auf Lager.</td>
            </tr>';
    }
    /* Tabelle schließen */
    ECHO"</table>";

    /* Datenverbindung schließen*/
    mysqli_close($db_link);
?>

</div>
<!-- div-Content-Ende -->
</main>
</body>
</html>
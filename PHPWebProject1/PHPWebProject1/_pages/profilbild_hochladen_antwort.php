<?php
$titel = "Profielbild Hochladen";
$aktueller_anwender_name = $_SESSION['anwender_name'];
$id_anwender             = $_SESSION['id_anwender'];
$verzeichnis_hochgeladener_dateien = 'C:/xampp/htdocs/pictures/profilbilder/';

include '../_module/top.php';
include("../include/funktion_bilder_hochladen.inc.php");

//DB-Verbindung herstellen
$mysqli = mysqli_connect($host, $user, $pwd, $db);
if (mysqli_connect_errno($mysqli))
{
    echo "Anmeldung fehlgeschlagen: " . mysqli_connect_error();
    exit(0);
}
mysqli_set_charset($mysqli, "utf8");

//zur Funktion siehe funktion_bilder_hochladen.inc.php im obigen include
$uploadStatus = fkt_save_upload_image($mysqli, $verzeichnis_hochgeladener_dateien);

//Hier meldet die Funktion fkt_save_upload_image einige Fehler-/Erfolgszustaende zurueck
$successful_upload = $uploadStatus[0];
$upload_filename = $uploadStatus[1];
$id_bilder = $uploadStatus[2];
$upload_filename = $uploadStatus[3];

if($successful_upload!=0)
{
    //Fehlversuch
    echo "Das Hochladen des Bildes ". $upload_filename." ist fehlgeschlagen.<br />";
}
else
{
    $mysqli->query("INSERT INTO tbl_bilder(name,funktion)
		VALUES ('$upload_filename','0')");
    $id_bilder  = $mysqli->insert_id;

    $sql_anweisung = "UPDATE tbl_anwender SET bild_id = $id_bilder WHERE id_anwender= $id_anwender";
    mysqli_query($mysqli,$sql_anweisung);
    //Falls ein Fehler auftritt, wird dieser hier ausgegeben.
    echo mysqli_error($mysqli);

    echo "<div class=\"maincontent-area align-container\"><h3>Angaben zu ihrem hochgeladenen Bild: ".$upload_filename."</h3>\n".
    "<img src=\"../pictures/profilbilder/".$upload_filename."\" alt=\"Hochgeladenes Bild nicht gefunden\"><br />\n";
    echo "<p>Zur&uuml;ck zur <a href=\"./main.php\">Hauptseite</a></p><div />";
}
?>
<?php
include '../_module/top.php';

// ---------------------------------------------Ende Top-------------------------------------------------------------

if (isset($_SESSION["login_error"]))
{
    if ($_SESSION["login_error"] == 2)
    {
		echo "Falsches Passwort oder Username!";
		unset ($_SESSION["login_error"]);
    }
}
if (isset($_SESSION['kunde']) && ($_SESSION['kunde'] != null))
{
    // Redirect auf Hauptseite, da der Kunde bereits eingeloggt ist -------
    header('Location: main.php');
    exit;
}

if (isset($_SESSION["login_error"]) == 1)
{
    echo "Keine SESSIONS gefunden für Kundenname und Passwort";
    unset($_SESSION["login_error"]);
    exit;
}

?>

<!-- Page content -->
  <div class="maincontent-area">
    <div class="container">
		<div id="login">
			<!--<img id="profil_bild" src="../img2/kundenavatar.jpg" alt="Error"></img>-->

			<h3>Registrieren</h3>
			<p">F&uuml;r alle Eink&auml;ufe oder Kundenprofileingaben m&uuml;ssen Sie sich
			 zun&auml;chst hier registrieren.</p>

			<form enctype="multipart/form-data" action="registration_antwort.php" method="POST">
				Nachname:<br>
				<input type="text" name="nachname" class="formkategorie" required>
				<br>
				Vorname:<br>
				<input type="text" name="vorname" class="formkategorie" required>
				<br>
				Email:<br>
				<input type="text" name="email" class="formkategorie" required>
				<br>
				Stra&szlig;e<br>
				<input type="text" name="strasse" class="formkategorie" required>
				<br>
				Hausnummer:<br>
				<input type="text" name="hausnummer" class="formkategorie" required>
				<br>
				Stadt:<br>
				<input type="text" name="stadt" class="formkategorie" required>
				<br>
				Postleitzahl:<br>
				<input type="text" name="plz" class="formkategorie" required>
				<br>
				Kundenname:<br>
				<input type="text" name="kundenname" class="formkategorie" required>
				<br>
				Passwort:<br>
				<input type="password" name="passwort" class="formkategorie" required>
				<br>
				Profilbild:<br>
				<br>

				<br>
                    <!-- Die Encoding-Art enctype MUSS wie dargestellt angegeben werden -->
                    <!-- MAX_FILE_SIZE muss vor dem Dateiupload Input Feld stehen -->

                    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                    <!-- Der Name des Input Felds bestimmt den Namen im $_FILES Array -->
                    Diese Datei hochladen: <input type="file" name="upload_image">
                <br />
				<button type="submit" id="register_button">Registrieren</button>
			</form>

			<br>
			<br>
			</div>
    </div>
  </div>

    <?php
	// --------------------------------------------Bottom------------------------------------------------------------->

	include '../_module/loadscripts.php';
    ?>

<?php
// --------------------------------------------Bottom------------------------------------------------------------->

include '../_module/bottom.php';
?>
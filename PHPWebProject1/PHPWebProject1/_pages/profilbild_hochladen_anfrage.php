<?php
$titel = "Profilbild hochladen";
include '../_module/top.php';
//Die Daten aus der Session werden bereitgestellt
$aktueller_anwender_name = $_SESSION['anwender_name'];
$id_anwender             = $_SESSION['id_anwender'];
?>
	<div class="maincontent-area align-container">
	<h2>Hallo <?php echo $aktueller_anwender_name; ?>!</h2>
	<p>&Uuml;ber den folgenden Auswahldialog k&ouml;nnen Sie ein Profilbild hochladen</p>
	<form enctype="multipart/form-data" method="post" action="profilbild_hochladen_antwort.php">
		<input type="file" name="upload_image" /> <br />
		<input type="submit" value="Lade hoch" name="hochladen" />
	</form>
	<div />
</body>
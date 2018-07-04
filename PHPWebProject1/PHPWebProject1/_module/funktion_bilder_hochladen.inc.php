<?php
include_once("function.php");

//ich brauche hier keine Session zu starten,
//da dieses Include nicht eigenstaendig aufgerufen werden kann/darf/sollte
$anwender_name=$_SESSION['anwender_name'];
$id_anwender=$_SESSION['id_anwender'];

function fkt_save_upload_image($mysqli,$picture_server_path)
{

	//Hier wird auch die Speicherung von Bildinformationen in der tbl_bilder vorbereitet -
	//wenn es schief geht, bekommt der Aufrufer eine $id_bilder = -1 zurueckgemeldet
	$id_bilder = -1;
	$server_dateiname = "Speichern fehlgeschlagen";

	$upload_filename = sichere_eingaben($mysqli,basename($_FILES['upload_image']['name']));
	$successful_upload = $_FILES['upload_image']['error'];

	//moegliche Fehlermeldung an den Aufrufer zurueckgeben
	if($successful_upload!=0)
	{
		// moegliche Bruchteile vom upload-File vom Server loeschen
		@unlink($_FILES['upload_image']['tmp_name']);

		//Der Aufrufer moechte einiges ueber das Scheitern der Aktion wissen:
		//Fehlernummer, Dateiname und eine hier noch fehlende id_bilder = -1
		$uploadStatus = array($successful_upload, $upload_filename, $id_bilder);

		return $uploadStatus;
	}

	//Nur ganz bestimmte Datei-Typen fuer meine Bilder werden akzeptiert
	$upload_image_typ = $_FILES['upload_image']['type'];
	if (
		($upload_image_typ == 'image/gif') ||
		($upload_image_typ == 'image/jpeg') ||
		($upload_image_typ == 'image/png')
		)
	{
		//Nur noch die Datei-Typen-Endung (gif,jpg,png)
		$upload_image_typ = substr($upload_image_typ, 6);

		//Der neue Dateiname wird durch die tbl_bilder.id_bilder bestimmt.
		//Daher wird hier schon einmal ein Eintrag in diese Tabelle vorgenommen, schon bevor die Datei richtig hochgeladen wird
		mysqli_query($mysqli, "INSERT INTO tbl_bilder (pfad,original_dateiname)
								VALUES ('".$picture_server_path."','".$upload_filename."')");

		//Die letzte id_bilder wird aus der DB gelesen
		$id_bilder = mysqli_insert_id($mysqli);

		//Noch in die Zwischentabelle tbl_anwender_bilder den Besitzer des Bildes einfuegen
		mysqli_query($mysqli,"INSERT INTO tbl_anwender_bilder(anwender_id,bilder_id)
						VALUES (".$_SESSION['id_anwender'].",".$id_bilder.")");

		$server_dateiname = $id_bilder."_".date('Ymd_His',time()).".".$upload_image_typ;

		// Fuer die upload-Datei wird ein neuer Dateiname aus Serverpfad+Server_dateiname zum Speichern zusammengesetzen
		$zieldatei = $picture_server_path.$server_dateiname;

		//Das hochgeladene File wird auf dem Server gespeichert
		if(move_uploaded_file($_FILES['upload_image']['tmp_name'], $zieldatei))
		{
			$successful_upload = 0;

			list($width, $height, $type, $attr) = getimagesize($zieldatei);
			mysqli_query($mysqli,
							"UPDATE tbl_bilder SET
							    name = '".$server_dateiname."',
								WHERE id_bild = ".$id_bild);

		}
		else
		{	//-2 steht fuer den Fall, dass das Bild nicht erfolgreich abgespeichert werden konnte
			$successful_upload = -2;
		}
	}
	else
	{
		//Dateityp wird hier nicht akzeptiert
		$successful_upload = -1;
	}

	// temporaeres File vom Server loeschen - wird nicht mehr gebraucht
	@unlink($_FILES['upload_image']['tmp_name']);

	//Der Aufrufer moechte einiges ueber den Verlauf der Aktion wissen
	//insbesondere die neue id_bilder zum Bild
	$uploadStatus = array($successful_upload, $upload_filename, $id_bilder, $server_dateiname);

	return $uploadStatus;

}//Funktionsende

?>
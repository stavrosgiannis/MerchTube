<?php
include_once 'db.php';
include_once 'kunde.php';

class Anwender_DBC
{
	public static function loadByAnwendername($anwendername)
	{

		$anwender = null;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			exit;
		}

		$sql = "SELECT * FROM tbl_anwender WHERE anwender_name='$anwendername';";

		if ($result = $mysqli->query($sql))
		{
			if ($row = $result->fetch_assoc())
			{
				if ($row["geschaeftsanwender_id"] != null)
				{
					$anwender = new Geschaeftsanwender();

					// lese auch die Geschäftsanwenderndaten
					$sql2 = "SELECT * FROM tbl_geschaeftsanwender WHERE id_geschaeftsanwender ='". $row["geschaeftsanwender_id"] ."';";

					if ($result2 = $mysqli->query($sql2))
					{
						if ($row2 = $result2->fetch_assoc())
						{
							$anwender->id_geschaeftsanwender = $row2["id_geschaeftsanwender"];
							$anwender->firmenname = $row2["firmenname"];
							$anwender->umstid = $row2["umstid"];
						}

						$result2->free();
					}
				}
				else
				{
					$anwender = new anwender();
				}

				$anwender->id_anwender = $row["id_anwender"];
				$anwender->anwendernname = $row["anwender_name"];
				$anwender->passwort = $row["passwort"];
				$anwender->salt = $row["salt"];
				$anwender->vorname = $row["vorname"];
				$anwender->nachname = $row["nachname"];
				$anwender->email = $row["email"];

				// Lese profilbild daten vom anwendern
				$sql3 = "SELECT * FROM tbl_profilbild WHERE id_profilbild='". $row['profilbild_id'] ."';";

				if ($result3 = $mysqli->query($sql3))
				{
					while ($row3 = $result3->fetch_assoc())
					{
						$profilbild = new Profilbild();
						$profilbild->id_profilbild = $row3["id_profilbild"];
						$profilbild->dateiname = $row3["name"];
						$anwender->profilbild = $profilbild;
					}
					$result3->free();
				}

				// lese alle zum anwendern gehörigen Liefer- und Rechnungsanschriften
				$sql2 = "SELECT * FROM tbl_adresse WHERE id_adresse='". $row["adresse_id"] ."';";

				if ($result2 = $mysqli->query($sql2))
				{
					while ($row2 = $result2->fetch_assoc())
					{
						$anschrift = new Adresse();
						$anschrift->id_adresse = $row2["id_adresse"];
						$anschrift->strasse = $row2["strasse"];
						$anschrift->hausnummer = $row2["hausnummer"];
						$anschrift->plz = $row2["plz"];
						$anschrift->ort = $row2["ort"];
						$anschrift->land = $row2["land"];

						if ($row2["typ"] == "R")
						{
							$anwender->rechnungsanschriftliste[] = $anschrift;
						}
						else
						{
							$anwender->lieferanschriftliste[] = $anschrift;
						}
					}

					$result2->free();
				}
			}

			$result->free();
		}

		return $anwender;
	}

    public static function registeranwender($vorname,$nachname,$email,$passwort,$anwender_name,$salt,$frage1,$frage2,$frage3)
    {
		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			exit;
		}

		$sql = "INSERT INTO tbl_anwender (`id_anwender`, `vorname`, `nachname`, `email`, `passwort`, `anwender_name`, `profilbild_id`, `adresse_id`, `login`, `rechnung_id`, `geschaeftsanwender_id`, `partner_id`, `bankverbindung_id`, `salt`, `frage1`, `frage2`, `frage3`)
									VALUES (NULL, '$vorname', '$nachname', '$email', '$passwort', '$anwender_name', NULL, NULL, '0', NULL, NULL, NULL, NULL, '$salt', '$frage1', '$frage2', '$frage3')";

		print_r ($sql);
		$result = $mysqli->query($sql);

		if ($result == 1)
		{
			return true;
			exit;
		}
        return false;
    }

    public static function insertOrUpdate($anwender, $isUpdateAnschrift = false)
	{
		if ($anwender == null)
		{
			return;
		}

		if ($anwender->id_anwender < 0)
		{
			return anwender_DBC::insert($anwender);
		}
		else
		{
			return anwender_DBC::update($anwender, $isUpdateAnschrift);
		}
	}

	private static function insert($anwender)
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			return $ergebnis;
		}

		$sql = "INSERT INTO tbl_anwender(anwendernname, email, passwort, nachname, vorname ) values ('".$anwender->anwendernname."','".$anwender->email."','".$anwender->passwort."','".$anwender->nachname."','".$anwender->vorname."')'";

		if ($mysqli->query($sql) === TRUE)
		{
			$ergebnis = true;
			$anwender->id_anwender = $mysqli->insert_id;

		}

		foreach ($anwender->rechnungsanschriftliste as $anschrift)
		{
			anwender_DBC::insertOrUpdateAnschrift($anwender, $anschrift, 'R');
		}

		foreach ($anwender->lieferanschriftliste as $anschrift)
		{
			anwender_DBC::insertOrUpdateAnschrift($anwender, $anschrift, 'L');
		}

		return $ergebnis;

	}

	private static function update($anwender, $isUpdateAnschrift)
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			return $ergebnis;
		}

		$sql = "Update tbl_anwender Set email = '".$anwender->email."', passwort = '".$anwender->passwort."', nachname='".$anwender->nachname."', vorname = '".$anwender->vorname."' WHERE anwendernname = '".$anwender->anwendernname. "' ';";

		if ($mysqli->query($sql) === TRUE)
		{
			$ergebnis = true;
			$anwender->id_anwender = $mysqli->insert_id;

		}

		foreach ($anwender->rechnungsanschriftliste as $anschrift)
		{
			anwender_DBC::insertOrUpdateAnschrift($anwender, $anschrift, 'R');
		}

		foreach ($anwender->lieferanschriftliste as $anschrift)
		{
			anwender_DBC::insertOrUpdateAnschrift($anwender, $anschrift, 'L');
		}

		return $ergebnis;
	}

	private static function delete($anwender)
	{
	}

	public static function insertOrUpdateAnschrift($anwender, $anschrift, $typ = null)
	{
		if (($anwender == null) || ($anschrift == null) || ($anwender->id_anwender < 0))
		{
			return false;
		}

		if ($anschrift->id_anschrift < 0)
		{
			return anwender_DBC::insertAnschrift($anwender, $anschrift, $typ);
		}
		else
		{
			return anwender_DBC::updateAnschrift($anwender, $anschrift);
		}
	}

	private static function insertAdresse($id_anwender,$adresse,$hausnummer,$plz,$ort,$land,$typ)
	{

		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			return $ergebnis;
		}

		$sql = "INSERT INTO tbl_adresse(strasse, hausnummer, plz, ort, typ, anwender_id ) values ('".$anschrift->strasse."','".$anschrift->hausnummer."', '".$anschrift->plz."', '".$anschrift->$ort."','".$typ."','".$anwender->$id_anwender."')';";

		if ($mysqli->query($sql) === TRUE)
		{
			$ergebnis = true;
			$anschrift->id_anschrift = $mysqli->insert_id;

		}

	}

	private static function updateAnschrift($anwender, $anschrift)
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			return $ergebnis;
		}

		$sql = "Update tbl_anschrift Set strasse = '".$anschrift->strasse."', hausnummer = '".$anschrift->hausnummer."', plz ='".$anschrift->plz."', stadt = '".$anschrift->stadt."'';";

		if ($mysqli->query($sql) === TRUE)
		{
			$ergebnis = true;
			$anschrift->id_anschrift = $mysqli->insert_id;

		}
	}

	private static function deleteAnschrift($anwender, $anschrift)
	{
	}

	public static function checkArtikelID($artikelid)
	{
		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
		}

		$sql = "SELECT * FROM tbl_artikel WHERE 'artikelnummer'='".$artikelid."';";

		if ($result = $mysqli->query($sql))
		{
			if ($row = $result->fetch_assoc())
			{
				$artikel = new Artikel();
				$artikel->id_artikel = $row["id_artikel"];
				$artikel->artikelnummer = $row["artikelnummer"];
				$artikel->name = $row["name"];
				$artikel->beschreibung = $row["beschreibung"];
				$artikel->preis = $row["preis"];
				$artikel->bilddatei = $row["bilddatei"];
				$artikel->slogan = $row["slogan"];
			}

			$result->free();
		}
		return $artikel;
	}

	public static function checkPasswort($anwender_name, $passwort)
	{

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
		}

		$sql = "SELECT * FROM tbl_anwender WHERE `anwender_name` = '$anwender_name';";

		if ($result = $mysqli->query($sql))
		{
			if ($row = $result->fetch_assoc())
			{
				$salt = $row['salt'];
				$passwort = hash('sha256', $passwort . $salt);

				if ($passwort == $row['passwort'])
				{

					return true;
				}
			}

			$result->free();
		}

		return false;
	}

	public static function checkIfanwendernnameExists($anwender_name)
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
		}

		$sql = "SELECT * FROM tbl_anwender WHERE `anwender_name` = '$anwender_name' LIMIT 1;";

		$result = $mysqli->query($sql);
		$row_cnt = $result->num_rows;

		if ( $row_cnt > 0)
		{
			$ergebnis = true;
		}
		return $ergebnis;
	}

	static function suche($sucheingabe)
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			return $ergebnis;
		}

		$sql = "SELECT *
				FROM `tbl_artikel`
				WHERE bezeichnug LIKE '%$sucheingabe%';";
		$result = $mysqli->query($sql);
		$row_cnt = $result->num_rows;
        echo"<div class=\"maincontent-area align-container\">";
		if ( $row_cnt< 1)
		{
			$suchergebnis = NULL;
			echo"<h1>Keine Ergebnisse gefunden!!</h1>";
			exit;
		}
		else
		{
			echo "<h1>Suchergebnisse</h1>";
			while($datensatz = $result->fetch_assoc())
			{
				echo "<tr>\r\n";
				if( empty($datensatz['arikel_bild_id']) ){
					echo"<img src=\"../_img/produkte/unset.jpg\" alt=\"Kein Bild Gefunden\" height=\"42px\" width=\"42px\">";
				}
				else{
					echo"<img src=\"../_img/produkte/".$datensatz['	bildpfadname']."\" alt=\"Kein Bild Gefunden\" height=\"42px\" width=\"42px\">";
				}
                echo "<td>".$datensatz['bezeichnug']."</td>".
                "<td>".$datensatz['preis']."</td>".
                "<td>".$datensatz['beschriebung']."</td>";
			}
			echo"</div>";
		}
	}

}